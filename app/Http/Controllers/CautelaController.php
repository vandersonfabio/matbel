<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Cautela;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CautelaFormRequest;
use DB;

class CautelaController extends Controller
{
    public function __construct(){
        //
    }

    public function index(Request $request){
        
        if($request){
            $query = trim($request->get('searchText'));
            $cautelasEncontradas = DB::table('cautela as caut')
                ->join('policial as req', 'caut.idRequerente', '=', 'req.id')
                ->join('policial as sig', 'caut.idSignatario', '=', 'sig.id')
                ->join('arma as a', 'caut.idArma', '=', 'a.id')
                ->join('situacao as s', 'a.idSituacao', '=', 's.id')
                ->join('modelo as m', 'a.idModelo', '=', 'm.id')
                ->join('tipo as t', 'm.idTipo', '=', 't.id')
                ->join('fabricante as f', 'm.idFabricante', '=', 'f.id')
                ->join('calibre as c', 'm.idCalibre', '=', 'c.id')
                ->select(
                    'caut.id',
                    'caut.data',
                    'caut.validade',
                    'caut.qtdMunicao',
                    'caut.qtdCarregador',
                    'caut.observacao',
                    'caut.isOpen',
                    'caut.idArma',
                    'caut.idRequerente',
                    'caut.idSignatario',
                    'req.nome as nomeRequerente', 'req.matricula as matriculaRequerente', 'req.cpf as cpfRequerente',
                    'sig.nome as nomeSignatario', 'sig.matricula as matriculaSignatario', 'sig.cpf as cpfSignatario',
                    'a.numeroSerie as serialArma',
                    'a.idSituacao',
                    'a.idModelo',
                    'm.descricao as descricaoModelo',
                    's.descricao as descricaoSituacao',
                    't.descricao as descricaoTipo',
                    'f.descricao as descricaoFabricante',
                    'c.descricao as descricaoCalibre'
                )             
                ->where('a.numeroSerie', 'LIKE', "%".$query.'%')                
                ->orderBy('caut.id', 'desc')
                ->paginate(7);
            
            return view('cautela.index', [
                "listaCautelas" => $cautelasEncontradas, 
                "searchText" => $query
            ]);
        }

    }

    public function create(){
        $requerentes = DB::table('policial')                        
                        ->orderBy('nome','asc')
                        ->get();
        
        $armas = DB::table('arma as a')
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
                            's.permiteCautela as permissaoCautela',
                            't.descricao as descricaoTipo',
                            'f.descricao as descricaoFabricante',
                            'c.descricao as descricaoCalibre'
                        )             
                        ->where('s.permiteCautela', 1)                
                        ->orderBy('a.numeroSerie', 'asc')
                        ->get();
        return view("cautela.create",[
            "policiais"=>$policiais,
            "armas"=>$armas
        ]);
    }

    public function store(CautelaFormRequest $request){
        $cautela = new Cautela;
        $cautela->data = $request->get('data');
        $cautela->validade = $request->get('validade');
        $cautela->qtdMunicao = $request->get('qtdMunicao');
        $cautela->qtdCarregador = $request->get('qtdCarregador');
        $cautela->observacoes = $request->get('observacoes');
        $cautela->idArma = intval($request->get('idArma'));
        $cautela->idRequerente = intval($request->get('idRequerente'));
        $cautela->idSignatario = intval($request->get('idSignatario'));        
                
        $arma->save();

        return Redirect::to('cautela');
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
