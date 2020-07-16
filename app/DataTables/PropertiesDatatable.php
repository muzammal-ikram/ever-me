<?php

namespace App\DataTables;

use App\Property;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertiesDatatable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        
        return datatables()
            ->eloquent($query)
            ->addColumn('createdAt', function ($property) {
                if ($property->created_at == $property->updated_at){
                    $created_at = '<p class="small">Published<br>'.$property->created_at->format('M-d-Y').'</p>';
                }else{
                    $created_at = '<p class="small">Last Modified<br>'.$property->updated_at->format('M-d-Y').'</p>';
                }
                return $created_at;
            })->editColumn('action', function($property){
                return view('properties.datatable_partials.action', ['property'=>$property]);
            })->addColumn('property_name', function($property){
                return view('properties.datatable_partials.property_image', ['property'=>$property]);
            })->rawColumns(['createdAt', 'action', 'property_image']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\PropertiesDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Property $model)
    {
        if(auth()->user()->hasRole('Admin')){
            return $model->newQuery();
        }
        else{
            return $model->where('user_id', auth()->user()->id)->newQuery();
        }


    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('properties-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->searching(false)
            ->dom('Bfrtip')
            ->orderBy(1)
            ->parameters([
                'buttons' => [
                    [],
                ],
//                'order' => [
//                    0,  // here is the column number
//                    'desc'
//                ]
            ]);
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            'property name' =>[
                'name'=>'property_name',
                'data' => 'property_name',
                'searchable' => false,
                'orderable' => false
            ],
                
            'createdAt' => [
                'name'=>'created_at',
                'searchable' => false
            ],
            'action' => [
                
                'name'=>'action',
                'searchable' => false,
                'orderable' => false
            ],
            
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Properties_' . date('YmdHis');
    }
}
