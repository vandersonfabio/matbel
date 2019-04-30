<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Calibre;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CalibreFormRequest;
use DB;

class CalibreController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        
        if($request){
            $query = trim($request->get('searchText'));
            $calibreEncontrados = DB::table('calibre')
                ->where('descricao', 'LIKE', $query.'%')
                ->where('isActive', 1)
                ->orderBy('descricao', 'asc')
                ->paginate(7);
            
            return view('arma.calibre.index', [
                "listaCalibres" => $calibreEncontrados, 
                "searchText" => $query
            ]);
        }

    }

    public function create(){
        return view("arma.calibre.create");
    }

    public function store(CalibreFormRequest $request){
        $calibre = new Calibre;
        $calibre->descricao = $request->get('descricao');
        $calibre->save();

        return Redirect::to('arma/calibre');
    }

    public function show($id){
        return view("arma.calibre.show", 
            ["calibre" => Calibre::findOrFail($id)]);
    }

    public function edit($id){
        return view("arma.calibre.edit", 
            ["calibre" => Calibre::findOrFail($id)]);
    }

    public function update(CalibreFormRequest $request, $id){
        $calibre = Calibre::findOrFail($id);
        $calibre->descricao = $request->get('descricao');
        $calibre->update();
        return Redirect::to('arma/calibre');
    }

    public function destroy($id){
        $calibre = Calibre::findOrFail($id);
        $calibre->isActive = 0;
        $calibre->update();
        //Caso queira realmente deletar o registro do banco, use o método DELETE()
        //$calibre->delete();
        return Redirect::to('arma/calibre');
    }
}