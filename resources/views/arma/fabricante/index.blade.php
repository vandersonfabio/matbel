@extends('layouts.admin');
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Fabricantes <a href="fabricante/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('arma.fabricante.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Descrição</th>
                    <th>Opções</th>				
				</thead>
               @foreach ($listaFabricantes as $fab)
				<tr>
					<td>{{ $fab->id}}</td>
					<td>{{ $fab->descricao}}</td>
					<td>
						<a href="{{URL::action('FabricanteController@edit',$fab->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$fab->id}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('arma.fabricante.modal')
				@endforeach
			</table>
		</div>
		{{$listaFabricantes->render()}}
	</div>
</div>
@stop