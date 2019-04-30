<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelo;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ModeloFormRequest;
use DB;

class ModeloController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        
        if($request){
            $query = trim($request->get('searchText'));
            $modelosEncontrados = DB::table('modelo as m')
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
                ->orderBy('m.descricao', 'asc')
                ->paginate(10);
            
            return view('arma.modelo.index', [
                "listaModelos" => $modelosEncontrados, 
                "searchText" => $query
            ]);
        }

    }

    public function create(){
        $fabricantes = DB::table('fabricante')
                        ->where('isActive',1)
                        ->orderBy('descricao','asc')
                        ->get();
        $tipos = DB::table('tipo')
                        ->where('isActive',1)
                        ->orderBy('descricao','asc')
                        ->get();
        $calibres = DB::table('calibre')
                        ->where('isActive',1)
                        ->orderBy('descricao','asc')
                        ->get();
        return view("arma.modelo.create",[
            "fabricantes"=>$fabricantes,
            "tipos"=>$tipos,
            "calibres"=>$calibres
        ]);
    }

    public function store(ModeloFormRequest $request){
        $modelo = new Modelo;
        $modelo->descricao = $request->get('descricao');
        $modelo->comprimentoCano = $request->get('comprimentoCano');
        $modelo->idTipo = intval($request->get('idTipo'));
        $modelo->idFabricante = intval($request->get('idFabricante'));
        $modelo->idCalibre = intval($request->get('idCalibre'));
        
        $modelo->save();

        return Redirect::to('arma/modelo');
    }

    public function show($id){
        return view("arma.modelo.show", 
            ["modelo" => Modelo::findOrFail($id)]);
    }

    public function edit($id){

        $modelo = Modelo::findOrFail($id);
        $fabricantes = DB::table('fabricante')->where('isActive',1)->get();
        $tipos = DB::table('tipo')->where('isActive',1)->get();
        $calibres = DB::table('calibre')->where('isActive',1)->get();

        return view("arma.modelo.edit", 
            [
                "modelo" => $modelo,
                "fabricantes" => $fabricantes,
                "tipos" => $tipos,
                "calibres" => $calibres
            ]
        );
    }

    public function update(ModeloFormRequest $request, $id){
        $modelo = Modelo::findOrFail($id);
        
        $modelo->descricao = $request->get('descricao');
        $modelo->comprimentoCano = $request->get('comprimentoCano');
        $modelo->idTipo = intval($request->get('idTipo'));
        $modelo->idFabricante = intval($request->get('idFabricante'));
        $modelo->idCalibre = intval($request->get('idCalibre'));

        $modelo->update();
        return Redirect::to('arma/modelo');
    }

    public function destroy($id){
        $modelo = Modelo::findOrFail($id);
        $modelo->isActive = 0;
        $modelo->update();
        //Caso queira realmente deletar o registro do banco, use o método DELETE()
        //$modelo->delete();
        return Redirect::to('arma/modelo');
    }    
}
