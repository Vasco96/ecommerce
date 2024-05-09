<?php

namespace App\DataTables;

use App\Models\Product;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class VendorProductDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
        ->addColumn('action', function ($query) {
            $editBtn = "<a href='" . route('vendor.products.edit', $query->id) . "' class='btn btn-primary'><i class='far fa-edit'></i></a>";
            $deleteBtn = "<a href='" . route('vendor.products.destroy', $query->id) . "' class='btn btn-danger ml-2 delete-item'><i class='far fa-trash-alt'></i></a>";
            $moreBtn = '<div class="dropdown dropleft d-inline">
            <button class="btn btn-primary dropdown-toggle ml-1" type="button" id="dropdownMenuButton2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <i class="fas fa-cog"></i>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item has-icon" href="'.route('admin.products-image-gallery.index', ['product' => $query->id]).'"><i class="far fa-heart"></i> Image Gallery</a>
              <a class="dropdown-item has-icon" href="'.route('admin.products-variant.index', ['product' => $query->id]).'"><i class="far fa-file"></i> Variants</a>
              <a class="dropdown-item has-icon" href="#"><i class="far fa-clock"></i> Something else here</a>
            </div>
          </div>';
            return $editBtn . $deleteBtn. $moreBtn;
        })
        ->addColumn('image', function ($query) {
            return $img = "<img width='50px' src='" . asset($query->thumb_image) . "'></img>";
        })
        ->addColumn('type', function ($query) {
            switch ($query->product_type) {
                case 'new_arrival':
                    return '<i class="badge bg-success">New Arrival</i>';
                    break;
                case 'featured_product':
                    return '<i class="badge bg-warning">Featured</i>';
                    break;
                case 'top_product':
                    return '<i class="badge bg-info">Top</i>';
                    break;
                case 'best_product':
                    return '<i class="badge bg-danger">Best</i>';
                    break;
                default:
                    return '<i class="badge gb-dark">None</i>';
                    break;
            }
        })
        ->addColumn('status', function ($query) {
            if ($query->status == 1) {


                $button ='<div class="form-check form-switch">
                <input class="form-check-input change-status" type="checkbox" checked  role="switch" id="flexSwitchCheckDefault" data-id="' . $query->id . '">
              </div>';
            } else {
                $button ='<div class="form-check form-switch">
                <input class="form-check-input change-status" type="checkbox" role="switch" id="flexSwitchCheckDefault" data-id="' . $query->id . '">
              </div>';
            }
            return $button;
        })
        ->rawColumns(['action', 'image', 'type', 'status'])
        ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Product $model): QueryBuilder
    {
        return $model->where('vendor_id', Auth::user()->vendor->id)->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                    ->setTableId('vendorproduct-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    //->dom('Bfrtip')
                    ->orderBy(0)
                    ->selectStyleSingle()
                    ->buttons([
                        Button::make('excel'),
                        Button::make('csv'),
                        Button::make('pdf'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::make('id')->width(100),
            Column::make('image')->width(200),
            Column::make('name'),
            Column::make('price'),
            Column::make('type')->width(150),
            Column::make('status')->width(100),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(200)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'VendorProduct_' . date('YmdHis');
    }
}