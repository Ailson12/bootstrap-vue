<?php

namespace App\Services;

use App\Lanche;
use Exception;
use Illuminate\Support\Facades\DB;

class LancheService
{
    public static function store($request)
     {
         DB::beginTransaction();
 
         $lanche = Lanche::create($request->except('foto_atemp'));
 
         if ($request['foto_atemp']) {
             $lanche->update([
                 'foto' => self::uploadImagem($lanche, $request['foto_atemp'])
             ]);
         }
 
         DB::commit();
         try {
             return [
                 'user' => $lanche
             ];
         } catch (Exception $error) {
             DB::rollback();
             return [
                 'error' => $error->getMessage()
             ];
         }
     }
 
     public static function getLanchePorId($id)
     {
         try {
             return [
                 'user' => Lanche::findOrFail($id),
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
             $lanche = Lanche::findOrFail($id);
             $lanche->update($request->except('foto_temp'));
 
             if ($request['foto_atemp']) {
                 $lanche->update([
                     'foto' => self::uploadImagem($lanche, $request['foto_atemp'])
                 ]);
             }
             DB::commit();
             return [
                 'user' => $lanche
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
             $lanche =  Lanche::findOrFail($id);
             $lanche->delete();
             return [
                 'user' => $lanche
             ];
         } catch (Exception $error) {
             return [
                 'error' => $error
             ];
         }
     }
 
     // Imagens
     public static function uploadImagem($lanche, $arquivo)
     {
         $imagem = $lanche->id . time() . "." . $arquivo->getClientOriginalExtension();
         $arquivo->move(public_path() . '/imagens/', $imagem);
 
         return $imagem;
     }
 
     // Vitrine
     public static function listaBebida()
     {
         return Lanche::paginate(8);
     }
}