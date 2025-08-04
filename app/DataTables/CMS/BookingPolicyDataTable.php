<?php

namespace App\DataTables\CMS;

use App\Models\CMS\BookingPolicy;
use App\Traits\DataTableCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class BookingPolicyDataTable extends DataTable
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

            ->addColumn('language_name', function ($row) {
                return optional($row->language)->language_name ?? '-';
            })
            ->filterColumn('language_name', function ($query, $keyword) {
                $query->whereHas('language', function ($q) use ($keyword) {
                    $q->where('language_name', 'ilike', "%{$keyword}%");
                });
            })
            ->orderColumn('language_name', function ($query, $order) {
                $query->join('master_languages as lang', 'cms_booking_policy.lang_id', '=', 'lang.id')
                    ->select(['cms_booking_policy.*', 'lang.language_name as language_name'])
                    ->orderBy('language_name', $order);
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
                $query->join('users as updater', 'cms_booking_policy.updated_by', '=', 'updater.id')
                    ->select(['cms_booking_policy.*', 'updater.name as updater_name'])
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
    public function query(BookingPolicy $model): QueryBuilder
    {
        return $model->newQuery()->with('user');
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('bookingpolicy-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('cms.booking-policies.index', [], true))
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
            Column::computed('language_name')->title("Language")->orderable(true)->searchable(true),
            Column::computed('policy_description')->title("Policy Description")->orderable(true)->searchable(true),
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
        return 'BookingPolicy_' . date('YmdHis');
    }
}
