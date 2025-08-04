<?php

namespace App\DataTables\Master;


use App\Models\Master\BilliardTableCategory;
use App\Traits\DataTableCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BilliardTableCategoryDataTable extends DataTable
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

            ->addColumn('venue_name', function ($row) {
                return optional($row->venue)->venue_name ?? "";
            })
            ->filterColumn('venue_name', function ($query, $keyword) {
                $query->whereHas('venue', function ($q) use ($keyword) {
                    $q->where('venue_name', 'ilike', "%{$keyword}%");
                });
            })
            ->orderColumn('venue_name', function ($query, $order) {
                $query->join('master_venues', 'master_billiard_table_categories.venue_id', '=', 'master_venues.id')
                    ->select(['master_billiard_table_categories.*', 'master_venues.venue_name'])
                    ->orderBy('master_venues.venue_name', $order);
            })

            ->addColumn('updated_at', function ($row) {
                return Carbon::parse($row->updated_at)
                    ->setTimezone('Asia/Jakarta')
                    ->translatedFormat('j F Y, H:i');
            })

            ->addColumn('updated_by', function ($row) {
                return optional($row->user)->name ?? "";
            })->filterColumn('updated_by', function ($query, $keyword) {
                $query->whereHas('user', function ($q) use ($keyword) {
                    $q->where('name', 'ilike', "%{$keyword}%");
                });
            })->orderColumn('updated_by', function ($query, $order) {
                $query->join('users as updater', 'master_billiard_table_categories.updated_by', '=', 'updater.id')
                    ->select(['master_billiard_table_categories.*', 'updater.name as updater_name'])
                    ->orderBy('updater_name', $order);
            })
            
            ->addColumn('action', function ($row) {
                $encryptedId = Crypt::encrypt($row->id);
                $actions = $this->basicAction($row);
                $deleteForm = $this->deleteForm($encryptedId);
                return view('layouts.action', compact('actions', 'deleteForm', 'row'));
            })
            
            ->rawColumns(['checkbox'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(BilliardTableCategory $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'venue']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('billiardtablecategory-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('tables.categories.index', [], true))
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
                    ->title(
                '<div class="form-check text-center">
                            <input class="form-check-input" type="checkbox" id="checkAll">
                        </div>'
                    ),
            Column::make('DT_RowIndex')->title('No ')->orderable(false)->searchable(false)->addClass('text-lg-center'),
            Column::make('venue_name')->orderable(true)->searchable(true),
            Column::make('table_category_name')->orderable(true)->searchable(true),
            Column::computed('updated_at'),
            Column::make('updated_by')->orderable(true)->searchable(true),
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
        return 'BilliardTableCategory_' . date('YmdHis');
    }
}
