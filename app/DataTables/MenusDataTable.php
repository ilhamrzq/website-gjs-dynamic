<?php

namespace App\DataTables;

use App\Models\Configuration\Menu as ConfigurationMenu;
use App\Traits\DataTableCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class MenusDataTable extends DataTable
{
    use DataTableCustom;

    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function ($row) {
                return
                    '<div class="form-check text-center">
                        <input class="form-check-input fs-15 checkbox-row" type="checkbox" name="selected_rows[]" value="' . $row->id . '">
                    </div>';
            })

            ->addColumn('action', function ($row) {
                $encryptedId = Crypt::encrypt($row->id);
                $actions = $this->basicAction($row);
                $deleteForm = $this->deleteForm($encryptedId);
                return view('layouts.action', compact('actions', 'deleteForm', 'row'));
            })

            ->addColumn('icon', function ($row) {
                return '<i class="' . $row->icon .'"></i>';
            })

            ->addColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)->translatedFormat('j F Y, H:i');
            })

            ->addColumn('updated_by', function ($row) {
                return optional($row->user)->name ?? "";
            })
            ->filterColumn('updated_by', function ($query, $keyword) {
                // \Log::info("Searching user with keyword: {$keyword}");
                // kalo pake pgsql case-insensitive gunakan ilike, kalo case-sensitive pake like
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'ilike', "%{$keyword}%");
                });
            })

            ->rawColumns(['action', 'icon', 'checkbox'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(ConfigurationMenu $model): QueryBuilder
    {
        // jangan dikasih orderBy atau latest(), karena nanti columnya ngga bisa orderable dan menjadi double orderBy query sehingga conflict
        return $model->newQuery()->with(['user']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    // Fungsi html akan merender table ke view
    // minifiedAjax, mengembalikan absolute URL lengkap https://example.com/folder/file.blade.php
    // mengatur END POINT untuk request AJAX ketika datatable memerlukan data, data yg diambil berdasarkan $newQuery diatas, karena route mengarah ke index

    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('menus-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('configurations.menu.index', [], true))
                    //->dom('Bfrtip')
                    ->orderBy(1)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        // Button::make('reset'),
                        // Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
            ->exportable(false)
            ->printable(false)
            ->orderable(false)
            ->searchable(false)
            ->title('<div class="form-check text-center">
                        <input class="form-check-input" type="checkbox" id="checkAll">
                    </div>'),
            Column::make('DT_RowIndex')->title('No ')->orderable(false)->searchable(false)->addClass('text-lg-center'),
            Column::make('category')->searchable(true)->orderable(true),
            Column::make('name')->searchable(true)->orderable(true), 
            Column::make('orders')->searchable(true)->orderable(true)->addClass('text-lg-center'),
            Column::make('url')->orderable(true)->searchable(true),
            Column::computed('icon')->addClass('text-lg-center'),
            Column::computed('updated_at'),
            Column::computed('updated_by')->orderable(true)->searchable(true),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Menus_' . date('YmdHis');
    }
}
