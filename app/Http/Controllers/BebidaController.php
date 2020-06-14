<?php

namespace App\Http\Controllers;

use App\Bebida;
use App\DataTables\BebidaDataTable;
use App\Http\Requests\BebidaRequest;
use App\Services\BebidaService;
use Illuminate\Http\Request;

class BebidaController extends Controller
{
    public function index(BebidaDataTable $datatable)
    {
        return $datatable->render("admin.bebidas.index");
    }

    public function create()
    {
        return view("admin.bebidas.create", [
            'categoria' => Bebida::CATEGORIA_BEBIBAS 
        ]);
    }

    public function store(BebidaRequest $request)
    {
        $retorno = BebidaService::store($request);
        if ($retorno['user']) {
            return redirect()->route('bebida.index')
                    ->withSucesso('Bebida salva com sucesso!');
        }
        return back()->withInput()->withFalha('Bebida salva com sucesso!');
    }

    public function edit($id)
    {
        $retorno = BebidaService::getBebidaPorId($id);
        if ($retorno['user']) {
            return view("admin.bebidas.create", [
                'bebidas' => $retorno['user'],
                'categoria' => $retorno['categoria']
            ]);
        } else {
            return redirect()->back()->withInput()
                                    ->withFalha($retorno['error']);
        }
        
    }

    public function update(BebidaRequest $request, $id)
    {
        $retorno = BebidaService::update($request, $id);
        if ($retorno['user']) {
            return redirect()->route('bebida.index')
                                ->withSucesso('Bebida Atualizada com sucesso!');
        }  
        return redirect()->back()->withInput()->withFalha($retorno['error']);
    }

    public function destroy($id)
    {
        $retorno = BebidaService::destroy($id);
    }
}
