<?php

namespace App\DataTables\CMS;


use App\Models\CMS\Video;
use App\Traits\DataTableCustom;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Crypt;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class VideoDataTable extends DataTable
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

            ->addColumn('video', function ($row) {
                if (!$row->file_path) {
                    return '<span class="text-muted">No Video</span>';
                }

                $videoPath = asset($row->file_path);
                $videoId = "zoomInModal_" . $row->id;

                return '
                    <button type="button" class="btn btn-outline-primary btn-icon waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#' . $videoId . '">
                        <i class="ri-play-fill"></i>
                    </button>

                    <div id="' . $videoId . '" class="modal fade zoomIn" tabindex="-1" aria-labelledby="' . $videoId . '_label" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="' . $videoId . '_label">Preview Video</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body text-center">
                                    <video controls style="max-width: 100%; height: auto;">
                                        <source src="' . $videoPath . '" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video>
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
                $query->join('users as updater', 'cms_videos.updated_by', '=', 'updater.id')
                    ->select(['cms_videos.*', 'updater.name as updater_name'])
                    ->orderBy('updater_name', $order);
            })

            ->addColumn('action', function ($row) {
                $encryptedId = Crypt::encrypt($row->id);
                $actions = $this->basicAction($row);
                $deleteForm = $this->deleteForm($encryptedId);
                return view('layouts.action', compact('actions', 'deleteForm', 'row'));
            })
            
            ->rawColumns(['checkbox', 'video'])
            ->addIndexColumn();
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Video $model): QueryBuilder
    {
        return $model->newQuery()->with(['user']);
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('video-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax(route('cms.videos.index', [], true))
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
            Column::computed('video_title_id')->title("Video Title ID")->orderable(true)->searchable(true),
            Column::computed('video_title_en')->title("Video Title EN")->orderable(true)->searchable(true),
            Column::computed('video')->orderable(false)->searchable(false)->addClass('text-center'),
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
        return 'Video_' . date('YmdHis');
    }
}
