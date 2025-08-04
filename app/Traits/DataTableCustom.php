<?php

namespace App\Traits;

use Illuminate\Support\Facades\Crypt;

trait DataTableCustom
{
    protected string $routePrefix;

    /**
     * Set route prefix berdasarkan request path.
     */
    public function setRoutePrefix(): void
    {
        $this->routePrefix = str_replace('/', '.', request()->path());
    }

    /**
     * Ambil nilai route prefix
     */
    public function getRoutePrefix(): string
    {
        if (!isset($this->routePrefix)) {
            $this->setRoutePrefix();
        }
        return $this->routePrefix;
    }

    /**
     * Generate action button untuk datatable
     */
    public function basicAction($row): array
    {
        $actions = [];
        $user = request()->user();
        $encryptedId = Crypt::encrypt($row->id);
        $routePrefix = $this->getRoutePrefix();

        // Tombol Detail
        
        // Tombol Edit jika memiliki izin
        if ($user->can('update ' . request()->path())) {
            $actions['Detail'] = route($routePrefix . '.show', $encryptedId);
            $actions['Edit'] = route($routePrefix . '.edit', $encryptedId);
        }

        // Tombol Delete jika memiliki izin dan route tersedia
        if ($user->can('delete ' . request()->path()) && $this->routeExists($routePrefix . '.destroy')) {
            $actions['Delete'] = route($routePrefix . '.destroy', $encryptedId);
        }

        return $actions;
    }

    /**
     * Cek apakah route tersedia
     */
    private function routeExists($routeName): bool
    {
        return app('router')->has($routeName);
    }

    /**
     * Generate form hapus data
     */
    public function deleteForm($encryptedId): string
    {
        $routePrefix = $this->getRoutePrefix();
        if (!$this->routeExists($routePrefix . '.destroy')) {
            return '';
        }

        return '<form action="' . route($routePrefix . '.destroy', $encryptedId) . '" method="post" id="deleteForm' . $encryptedId . '">
                ' . csrf_field() . '
                <a role="button" type="submit" class="dropdown-item remove-item-btn" onclick="confirmDelete(event, \'' . $encryptedId . '\')">
                    <i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>Delete
                </a>
            </form>';
    }
}
