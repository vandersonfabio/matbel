<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Fabricante;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\FabricanteFormRequest;
use DB;

class FabricanteController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        
        if($request){
            $query = trim($request->get('searchText'));
            $fabricantesEncontrados = DB::table('fabricante')
                ->where('descricao', 'LIKE', $query.'%')
                ->where('isActive', 1)
                ->orderBy('descricao', 'asc')
                ->paginate(7);
            
            return view('arma.fabricante.index', [
                "listaFabricantes" => $fabricantesEncontrados, 
                "searchText" => $query
            ]);
        }

    }

    public function create(){
        return view("arma.fabricante.create");
    }

    public function store(FabricanteFormRequest $request){
        $fabricante = new Fabricante;
        $fabricante->descricao = $request->get('descricao');
        $fabricante->save();

        return Redirect::to('arma/fabricante');
    }

    public function show($id){
        return view("arma.fabricante.show", 
            ["fabricante" => Fabricante::findOrFail($id)]);
    }

    public function edit($id){
        return view("arma.fabricante.edit", 
            ["fabricante" => Fabricante::findOrFail($id)]);
    }

    public function update(FabricanteFormRequest $request, $id){
        $fabricante = Fabricante::findOrFail($id);
        $fabricante->descricao = $request->get('descricao');
        $fabricante->update();
        return Redirect::to('arma/fabricante');
    }

    public function destroy($id){
        $fabricante = Fabricante::findOrFail($id);
        $fabricante->isActive = 0;
        $fabricante->update();
        //Caso queira realmente deletar o registro do banco, use o método DELETE()
        //$fabricante->delete();
        return Redirect::to('arma/fabricante');
    }
}
