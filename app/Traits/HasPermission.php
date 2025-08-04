<?php

namespace App\Traits;
use Illuminate\Support\Arr;

trait HasPermission
{
    // pake trait ini di dalam app/Http/Controllers/Controller.php
    // kalo ada route diluar array ini, tambahin lagi biar bisa dihandle otomatis tanpa harus ditulis di dalam route
    protected $abilities = [
        'show' => 'read',
        'index' => 'read',
        'edit' => 'update',
        'update' => 'update',
        'create' => 'create',
        'store' => 'create',
        'destroy' => 'delete',
        'sort' => 'sort',
    ];

    // override method callAction() Laravel Controller
    // method ini bertanggung jawab untuk memanggil method pada controller saat sebuah route dipanggil.

    public function callAction($method, $parameters)
    {
        $action = Arr::get($this->abilities, $method);
        // dd($action);

        if (!$action) {
            return parent::callAction($method, $parameters);
        }

        $staticPath = request()->route()->getCompiled()->getStaticPrefix();
        $urlMenu = urlMenu();
        $staticPathFinal = substr($staticPath, 1);


        // CHeck apakah staticPathFinal ada di dalam daftar urlMenu.  
        // kalo ngga ada, lakukan proses manipulasi URL menggunakan explode() dan str_replace() buat nyocokin URL yang ada.
        // kalo ketemu dan match, loop berhenti dan melanjutkan otorisasi.

        // dd($staticPath, $urlMenu, $staticPathFinal);
        if (!in_array($staticPathFinal, $urlMenu)) {
            // dd("test");
            foreach (array_reverse(explode('/', $staticPathFinal)) as $path) {
                $staticPathFinal = str_replace("/$path", "", $staticPathFinal);
                // dd($staticPathFinal, $urlMenu);
                if (in_array($staticPathFinal, $urlMenu)) {
                    break;
                }
            }
        }

        if (in_array($staticPathFinal, $urlMenu)) {
            $this->authorize("$action $staticPathFinal");
        }

        return parent::callAction($method, $parameters);
    }
}