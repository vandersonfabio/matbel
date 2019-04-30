@extends('layouts.admin');
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Modelos <a href="modelo/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('arma.modelo.search')
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
                    <th>Descrição</th>
                    <th>Cano</th>                    
                    <th>Opções</th>				
				</thead>
               @foreach ($listaModelos as $model)
				<tr>
					<td>{{ $model->id}}</td>
                    <td>{{ $model->descricaoTipo}}</td>
					<td>{{ $model->descricaoFabricante}}</td>
                    <td>{{ $model->descricaoCalibre}}</td>
                    <td>{{ $model->descricao}}</td>
                    <td>{{ $model->comprimentoCano}} cm</td>                    
					<td>
						<a href="{{URL::action('ModeloController@edit',$model->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$model->id}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('arma.modelo.modal')
				@endforeach
			</table>
		</div>
		{{$listaModelos->render()}}
	</div>
</div>
@stop