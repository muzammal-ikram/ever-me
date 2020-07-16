<?php

namespace App\DataTables;

use App\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
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
            ->addColumn('createdAt', function ($user) {
                if ($user->created_at == $user->updated_at){
                    $created_at = '<p class="small">Published<br>'.$user->created_at->format('M-d-Y').'</p>';
                }else{
                    $created_at = '<p class="small">Last Modified<br>'.$user->updated_at->format('M-d-Y').'</p>';
                }
                return $created_at;
            })->editColumn('action', function($user){
                return view('users.datatable_partials.action', ['user'=>$user]);
            })->rawColumns(['createdAt', 'action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\User $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->where('id', '!=', auth()->user()->id)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                ->setTableId('users-table')
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
            'name',
            'email',
            'phone',
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
        return 'User_' . date('YmdHis');
    }
}
