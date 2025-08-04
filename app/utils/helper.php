<?php

use App\Models\Configuration\Menu;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Crypt;

if (!function_exists('menus')) {
    function menus()
    {
        Cache::forget('menus');
        if (!Cache::has('menus')) {
            $menus = Menu::getMenus()->groupBy('category');
            Cache::forever('menus', $menus);
        } else {
            $menus = Cache::get('menus');
        }
        // dd($menus);
        return $menus;
    }
}

if (!function_exists('urlMenu')) {
    function urlMenu()
    {
        Cache::forget('urlMenu');
        if (!Cache::has('urlMenu')) {
            $menus = menus()->flatMap(fn($item) => $item);
            $url = [];
            foreach ($menus as $mm) {
                $url[] = $mm->url;

                foreach ($mm->subMenus as $sm) {
                    $url[] = $sm->url;
                }
            }
            Cache::forever('urlMenu', $url);
        } else {
            $url = Cache::get('urlMenu');
        }
        // dd($url);
        return $url;
    }
}

if (!function_exists('responseSuccess')) {
    function responseSuccess(string $action, string $routeRedirect)
    {
        if ($action == 'store') {
            $message = "Data added successfully";
        } elseif ($action == 'update') {
            $message = "Data saved successfully";
        } elseif ($action == 'delete') {
            $message = "Data deleted successfully";
        } 
        
        return redirect()->to(url($routeRedirect))->with('success', $message);
    }
}

if (!function_exists('responseError')) {
    function responseError(\Throwable | string $th)
    {
        $message = '';
        $stackTrace = '';

        if (config('app.debug')) {
            if ($th instanceof \Illuminate\Database\QueryException) {
                $message = 'SQL Error: ' . $th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine();
                $stackTrace = $th->getTraceAsString();
            } elseif ($th instanceof Throwable) {
                $message = 'Message: ' . $th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine();
                $stackTrace = $th->getTraceAsString();
            }
        } else {
            $message = 'An error occurred. Please contact support.';
        }

        \Log::error("Error Details: " . $message . "\nStack Trace: " . ($stackTrace ?? ''));
        return redirect()->back()
            ->withInput(request()->all())
            ->with('error', $message);
    }
}

if (!function_exists('responseJsonError')) {
    function responseJsonError(\Throwable | string $th) 
    {
        if (config('app.debug')) {
            if ($th instanceof Throwable) {
                $message = 'Something Error: ' . $th->getMessage() . ' File: ' . $th->getFile() . ' Line: ' . $th->getLine();
            }
        } else {
            $message = "An error occured. Please contact support.";
        }
    
        return response()->json([
            'status' => 'error',
            'status_code' => 500,
            'message' => $message
        ]);
    }
}

if (!function_exists('responseJsonSuccess')) {
    function responseJsonSuccess(string $message) {
        return response()->json([
            'status' => 'success',
            'status_code' => 200,
            'message' => $message
        ], 200);
    }
}

if (!function_exists('getDecryptedModelId')) {
    function getDecryptedModelId($encryptedId, $modelClass)
    {
        try {
            $id = Crypt::decrypt($encryptedId);
            $model = $modelClass::find($id);
            return $model;
        } catch (DecryptException $e) {
            return responseError($e);
        } catch (\Throwable $th) {
            return responseError($th);
        }
    }
}

if (!function_exists('getInventoryTransactionTypes')) {
    function getInventoryTransactionTypes()
    {
        return [
            ['id' => 1, 'inventories_transaction_type' => 'OPENING'],
            ['id' => 2, 'inventories_transaction_type' => 'IN'],
            ['id' => 3, 'inventories_transaction_type' => 'OUT'],
            ['id' => 4, 'inventories_transaction_type' => 'ADJUSTMENT'],
        ];
    }
}