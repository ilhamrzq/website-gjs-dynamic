<?php

namespace App\DataTables\Master;

use App\Models\Master\Venue;
use App\Traits\DataTableCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VenueDataTable extends DataTable
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

            

            ->addColumn('photo', function ($row) {
                $images = $row->venueImages;
                if ($images->isEmpty()) {
                    return '<span class="text-muted">No Image</span>';
                }

                $sortedImages = $images->sortByDesc('is_default')->values();
                $carouselId = "carousel_" . $row->id;

                // generate carousel indicators
                $indicators = '';
                foreach ($sortedImages as $index => $image) {
                    $activeClass = $index == 0 ? 'active' : '';
                    $indicators .= '<button type="button" data-bs-target="#' . $carouselId . '" data-bs-slide-to="' . $index . '" class="' . $activeClass . '" aria-label="Slide ' . ($index + 1) . '"></button>';
                }

                // generate carousel items
                $items = '';
                foreach ($sortedImages as $index => $image) {
                    $activeClass = $index == 0 ? 'active' : '';
                    $imagePath = asset($image->file_path);
                    $items .= '
                    <div class="carousel-item ' . $activeClass . '">
                        <img class="d-block img-fluid mx-auto" src="' . $imagePath . '" alt="Venue Image">
                    </div>';
                }

                // buat modal images
                $photoId = "zoomInModal_" . $row->id;
                $imagePath = asset($image->file_path);

                return '
                    <button type="button" class="btn btn-outline-primary btn-icon waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#' . $photoId . '">
                        <i class="ri-image-fill"></i>
                    </button>

                    <div id="' . $photoId . '" class="modal fade zoomIn" tabindex="-1" aria-labelledby="' . $photoId . '_label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="' . $photoId . '_label">' . 'Venue Image' . '</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div id="' . $carouselId . '" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-indicators">
                                            ' . $indicators . '
                                        </div>
                                        <div class="carousel-inner" role="listbox">
                                            ' . $items . '
                                        </div>
                                        <a class="carousel-control-prev" href="#' . $carouselId . '" role="button" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                        <a class="carousel-control-next" href="#' . $carouselId . '" role="button" data-bs-slide="next">
                                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                ';
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
                $query->join('users as updater', 'master_venues.updated_by', '=', 'updater.id')
                    ->select(['master_venues.*', 'updater.name as updater_name'])
                    ->orderBy('updater_name', $order);
            })

            ->addColumn('action', function ($row) {
                $encryptedId = Crypt::encrypt($row->id);
                $actions = $this->basicAction($row);
                $deleteForm = $this->deleteForm($encryptedId);
                return view('layouts.action', compact('actions', 'deleteForm', 'row'));
            })
            
            ->rawColumns(['checkbox', 'venue_name', 'photo'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Venue $model): QueryBuilder
    {
        return $model->newQuery()->with(['user', 'venueImages']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('venue-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('venues.places.index', [], true))
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
            Column::computed('photo')->orderable(false)->searchable(false)->addClass('text-center'),
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
        return 'Venue_' . date('YmdHis');
    }
}
