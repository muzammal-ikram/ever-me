<?php

namespace App\DataTables;

use App\PropertySection;
use App\PropertyResource;
use App\Property;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class PropertySectionsDatatable extends DataTable
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
            ->addColumn('createdAt', function ($property_section) {
                if ($property_section->created_at == $property_section->updated_at){
                    $created_at = '<p class="small">Published<br>'.$property_section->created_at->format('M-d-Y').'</p>';
                }else{
                    $created_at = '<p class="small">Last Modified<br>'.$property_section->updated_at->format('M-d-Y').'</p>';
                }
                return $created_at;
            })->addColumn('description', function($property_section) {
                if(strlen($property_section->description) > 30){

                    $property_section_description = substr($property_section->description, 0, 30).'...';
                }
                else{
                    $property_section_description =  $property_section->description;
                }
                return $property_section_description;
            })->addColumn('property_section_image', function($property_section){
                return view('property_sections.datatable_partials.property_section_image', ['property_section'=>$property_section]);
            })->addColumn('property_section_video', function($property_section){
                if($property_section->video_url){
                    $video_url = $property_section->video_url;
                }
                else{
                    $video_url = 'No Video url';
                }
                return $video_url;
            })->editColumn('action', function($property_section) {
                return view('property_sections.datatable_partials.action', ['property_section' => $property_section]);
            })->rawColumns(['createdAt' , 'property_section_video']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\PropertySectionsDatatable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query()
    {
        $property_resource = PropertyResource::findOrFail($this->property_resource_id);
        return $property_resource->property_property_sections();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
            ->setTableId('property-sections-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->dom('Bfrtip')
            ->searching(false)
            ->parameters([
                'buttons' => [
                    [],
                ],
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
            'id',
            'title',
            'description' => [
                'name'=>'description',
                'data' => 'description',
                'orderable' => false,
                'searchable' => false,
            ],
            'property section image' =>[
                'name'=>'property_section_image',
                'data' => 'property_section_image',
                'searchable' => false,
                'orderable' => false
            ],
            'property_section_video' =>[
                'name'=>'property_section_video',
                'searchable' => false,
                'orderable' => false
            ],
            'createdAt' => [
                'name'=>'created_at',
                'searchable' => false,
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
        return 'PropertySections_' . date('YmdHis');
    }
}
