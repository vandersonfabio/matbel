<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Arma;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ArmaFormRequest;
use DB;

class ArmaController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        
        if($request){
            $query = trim($request->get('searchText'));
            $armasEncontradas = DB::table('arma as a')
                ->join('situacao as s', 'a.idSituacao', '=', 's.id')
                ->join('modelo as m', 'a.idModelo', '=', 'm.id')
                ->join('tipo as t', 'm.idTipo', '=', 't.id')
                ->join('fabricante as f', 'm.idFabricante', '=', 'f.id')
                ->join('calibre as c', 'm.idCalibre', '=', 'c.id')
                ->select(
                    'a.id',
                    'a.numeroSerie',
                    'a.idSituacao',
                    'a.idModelo',
                    'm.descricao as descricaoModelo',
                    's.descricao as descricaoSituacao',
                    't.descricao as descricaoTipo',
                    'f.descricao as descricaoFabricante',
                    'c.descricao as descricaoCalibre'
                )             
                ->where('a.numeroSerie', 'LIKE', "%".$query.'%')                
                ->orderBy('a.id', 'desc')
                ->paginate(10);
            
            return view('arma.arma.index', [
                "listaArmas" => $armasEncontradas, 
                "searchText" => $query
            ]);
        }

    }

    public function create(){
        $situacoes = DB::table('situacao')
                        ->where('isActive',1)
                        ->orderBy('id','asc')
                        ->get();
        $modelos = DB::table('modelo as m')
                        ->join('calibre as c', 'm.idCalibre', '=', 'c.id')
                        ->join('tipo as t', 'm.idTipo', '=', 't.id')
                        ->join('fabricante as f', 'm.idFabricante', '=', 'f.id')   
                        ->select(
                            'm.id',
                            'm.descricao',
                            'm.comprimentoCano',
                            'm.isActive',                    
                            'm.idTipo',
                            'm.idFabricante',
                            'm.idCalibre',
                            't.descricao as descricaoTipo',
                            'f.descricao as descricaoFabricante',
                            'c.descricao as descricaoCalibre'
                        )                        
                        ->where('m.isActive', 1)
                        ->orderBy('t.descricao', 'asc')
                        ->orderBy('f.descricao', 'asc')
                        ->orderBy('c.descricao', 'asc')
                        ->orderBy('m.descricao', 'asc')
                        ->get();
        return view("arma.arma.create",[
            "situacoes"=>$situacoes,
            "modelos"=>$modelos
        ]);
    }

    public function store(ArmaFormRequest $request){
        $arma = new Arma;
        $arma->numeroSerie = $request->get('numeroSerie');        
        $arma->idSituacao = intval($request->get('idSituacao'));
        $arma->idModelo = intval($request->get('idModelo'));
                
        $arma->save();

        return Redirect::to('arma/arma');
    }

    public function show($id){
        return view("arma.arma.show", 
            ["arma" => Arma::findOrFail($id)]);
    }

    public function edit($id){

        $arma = Arma::findOrFail($id);
        $situacoes = DB::table('situacao')
                        ->where('isActive',1)
                        ->orderBy('id','asc')
                        ->get();
        $modelos = DB::table('modelo as m')
                        ->join('calibre as c', 'm.idCalibre', '=', 'c.id')
                        ->join('tipo as t', 'm.idTipo', '=', 't.id')
                        ->join('fabricante as f', 'm.idFabricante', '=', 'f.id')   
                        ->select(
                            'm.id',
                            'm.descricao',
                            'm.comprimentoCano',
                            'm.isActive',                    
                            'm.idTipo',
                            'm.idFabricante',
                            'm.idCalibre',
                            't.descricao as descricaoTipo',
                            'f.descricao as descricaoFabricante',
                            'c.descricao as descricaoCalibre'
                        )
                        ->where('m.descricao', 'LIKE', "%".$query.'%')
                        ->where('m.isActive', 1)
                        ->orderBy('m.descricaoTipo', 'asc')
                        ->orderBy('m.descricaoFabricante', 'asc')
                        ->orderBy('m.descricaoCalibre', 'asc')
                        ->orderBy('m.descricao', 'asc')
                        ->get();

        return view("arma.arma.edit", 
            [
                "arma" => $arma,
                "situacoes" => $situacoes,
                "modelos" => $modelos
            ]
        );
    }

    public function update(ModeloFormRequest $request, $id){
        $arma = Arma::findOrFail($id);
        
        $arma->numeroSerie = $request->get('numeroSerie');        
        $arma->idSituacao = intval($request->get('idSituacao'));
        $arma->idModelo = intval($request->get('idModelo'));

        $arma->update();
        return Redirect::to('arma/arma');
    }

    public function destroy($id){
        $arma = Arma::findOrFail($id);
        $arma->idSituacao = 2;
        $arma->update();
        //Caso queira realmente deletar o registro do banco, use o método DELETE()
        //$modelo->delete();
        return Redirect::to('arma/arma');
    }    
}
