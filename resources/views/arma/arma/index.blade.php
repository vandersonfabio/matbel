@extends('layouts.admin');
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Armas <a href="arma/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('arma.arma.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Tipo</th>
                    <th>Fabricante</th>
                    <th>Calibre</th>
                    <th>Modelo</th>
                    <th>Número de Série</th>
                    <th>Situação</th>
                    <th>Opções</th>				
				</thead>
               @foreach ($listaArmas as $arma)
				<tr>
					<td>{{ $arma->id}}</td>
                    <td>{{ $arma->descricaoTipo}}</td>
					<td>{{ $arma->descricaoFabricante}}</td>
                    <td>{{ $arma->descricaoCalibre}}</td>
                    <td>{{ $arma->descricaoModelo}}</td>
                    <td>{{ $arma->numeroSerie}}</td>
                    <td>{{ $arma->descricaoSituacao}}</td>                    
					<td>
						<a href="{{URL::action('ArmaController@edit',$arma->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$arma->id}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('arma.arma.modal')
				@endforeach
			</table>
		</div>
		{{$listaArmas->render()}}
	</div>
</div>
@stop