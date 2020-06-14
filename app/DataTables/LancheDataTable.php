<?php

namespace App\DataTables;

use App\Lanche;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class LancheDataTable extends DataTable
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
            ->editColumn('preco', function($lanche) {
                return 'R$ ' . number_format($lanche->preco, 2, ',', '.');
            })
            ->editColumn('categoria', function($lanche) {
                return Lanche::CATEGORIA_LANCHES[$lanche->categoria];
            })
            ->editColumn('foto', function($lanche) {
                return '<img width="100px" height="100px" src="'.asset('/imagens/' . $lanche->foto).'">';
            })
            ->addColumn('action', function($lanche) {
                $acoes = link_to(
                    route('lanche.edit', $lanche),
                    '',
                    ['class' => 'btn btn-sm btn-primary far fa-edit']
                );
                $acoes .= FormFacade::button(
                    '<i class="fas fa-trash"></i>',
                    [
                        'class' => 'btn btn-sm btn-danger ml-2',
                        'onclick' => "excluir('". route('lanche.destroy', $lanche) ."')"
                    ]
                );
                return $acoes;
            })
            ->RawColumns(['action', 'foto']);
    }

    public function query(Lanche $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('lanche-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                                ->text('<b>Adicionar Lanche</b> <i class="fas fa-utensils"></i>'),
                        Button::make('export')
                                ->text('<b>Exportar</b> <i class="fas fa-download"></i>'),
                        Button::make('print')
                                ->text('<b>Imprimir</b> <i class="fas fa-print"></i>')
                    )
                    ->parameters([
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json']
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
            Column::make('nome'),
            Column::make('descricao'),
            Column::make('foto'),
            Column::make('categoria'),
            Column::make('preco'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Lanche_' . date('YmdHis');
    }
}
