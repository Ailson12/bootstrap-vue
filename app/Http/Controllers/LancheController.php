<?php

namespace App\Http\Controllers;

use App\DataTables\LancheDataTable;
use App\Http\Requests\LancheRequest;
use App\Lanche;
use App\Services\LancheService;
use Illuminate\Http\Request;

class LancheController extends Controller
{
    public function index(LancheDataTable $datatable)
    {
        return $datatable->render("admin.lanches.index");
    }

    public function create()
    {
        return view('admin.lanches.create', [
            'categoria' => Lanche::CATEGORIA_LANCHES
        ]);
    }

    public function store(LancheRequest $request)
    {
        $retorno = LancheService::store($request);
        if ($retorno['user']) {
            return redirect()->route('lanche.index')
                    ->withSucesso('Lanche salvo com sucesso!');
        }
        return back()->withInput()->withFalha('Lanche salvo com sucesso!');
    }

    public function edit($id)
    {
        $retorno = LancheService::getLanchePorId($id);
        if ($retorno['user']) {
            return view("admin.lanches.create", [
                'bebidas' => $retorno['user'],
                // 'categoria' => $retorno['categoria']
            ]);
        } else {
            return redirect()->back()->withInput()
                                    ->withFalha($retorno['error']);
        }
        
    }

    public function update(LancheRequest $request, $id)
    {
        $retorno = LancheService::update($request, $id);
        if ($retorno['user']) {
            return redirect()->route('lanche.index')
                                ->withSucesso('Bebida Atualizada com sucesso!');
        }  
        return redirect()->back()->withInput()->withFalha($retorno['error']);
    }

    public function destroy($id)
    {
        $retorno = LancheService::destroy($id);
    }
}
