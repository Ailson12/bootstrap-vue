<?php

namespace App\DataTables;

use App\Bebida;
use Collective\Html\FormFacade;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class BebidaDataTable extends DataTable
{

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', function($bebida) {
                $acoes = link_to(
                    route('bebida.edit', $bebida),
                    '',
                    ['class' => 'btn btn-sm btn-primary far fa-edit']
                );
                $acoes .= FormFacade::button(
                    '<i class="fas fa-trash"></i>',
                    [
                        'class' => 'btn btn-sm btn-danger ml-2',
                        'onclick' => "excluir('". route('bebida.destroy', $bebida) ."')"
                    ]
                );
                return $acoes;
            })
            ->editColumn('preco', function($bebida) {
                return 'R$ ' .number_format($bebida->preco, 2, ',', '.');
            })
            ->editColumn('categoria', function($bebida) {
                return Bebida::CATEGORIA_BEBIBAS[$bebida->categoria];
            })
            ->editColumn('foto', function($bebida) {
                return '<img style="height: 50px;" src="'.asset('/imagens/' .$bebida->foto).'"/>';
            })
            ->rawColumns(['action', 'foto']);
    }

    public function query(Bebida $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('bebida-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create')
                                ->text('<b>Adicionar Bebida</b> <i class="fas fa-glass-cheers"></i>'),
                        Button::make('export')
                                ->text('<b>Exportar</b> <i class="fas fa-download"></i>'),
                        Button::make('print')
                                ->text('<b>Imprimir</b> <i class="fas fa-print"></i>')
                    )
                    ->parameters([
                        'language' => ['url' => '//cdn.datatables.net/plug-ins/1.10.21/i18n/Portuguese-Brasil.json']
                    ]);
    }


    protected function getColumns()
    {
        return [
            Column::make('id'),
            Column::make('nome'),
            Column::make('categoria'),
            Column::make('preco')
                ->title('Preço'),
            Column::make('foto'),
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->title('Ações')
        ];
    }

    protected function filename()
    {
        return 'Bebida_' . date('YmdHis');
    }
}
