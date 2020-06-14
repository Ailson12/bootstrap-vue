<?php

namespace App\Services;

use App\Bebida;
use Exception;
use Illuminate\Support\Facades\DB;

class BebidaService
{
    // Salvar
    public static function store($request)
    {
        DB::beginTransaction();

        $bebida = Bebida::create($request->except('foto_atemp'));

        if ($request['foto_atemp']) {
            $bebida->update([
                'foto' => self::uploadImagem($bebida, $request['foto_atemp'])
            ]);
        }

        DB::commit();
        try {
            return [
                'user' => $bebida
            ];
        } catch (Exception $error) {
            DB::rollback();
            return [
                'error' => $error->getMessage()
            ];
        }
    }

    public static function getBebidaPorId($id)
    {
        try {
            return [
                'user' => Bebida::findOrFail($id),
                'categoria' => Bebida::CATEGORIA_BEBIBAS 
            ];
        } catch (Exception $error) {
            return [
                'error' => $error
            ];
        }
    }

    public static function update($request, $id)
    {
        try {
            DB::beginTransaction();
            $bebida = Bebida::findOrFail($id);
            $bebida->update($request->except('foto_temp'));

            if ($request['foto_atemp']) {
                $bebida->update([
                    'foto' => self::uploadImagem($bebida, $request['foto_atemp'])
                ]);
            }
            DB::commit();
            return [
                'user' => $bebida
            ];
        } catch (Exception $error) {
            return [
                'error' => $error->getMessage()
            ];
        }
    }

    public static function destroy($id)
    {
        try {
            $bebida =  Bebida::findOrFail($id);
            $bebida->delete();
            return [
                'user' => $bebida
            ];
        } catch (Exception $error) {
            return [
                'error' => $error
            ];
        }
    }

    // Imagens
    public static function uploadImagem($bebida, $arquivo)
    {
        $imagem = $bebida->id . time() . "." . $arquivo->getClientOriginalExtension();
        $arquivo->move(public_path() . '/imagens/', $imagem);

        return $imagem;
    }

    // Vitrine
    public static function listaBebida()
    {
        return Bebida::paginate(8);
    }
}