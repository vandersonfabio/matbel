@extends('layouts.admin');
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Calibres <a href="calibre/create"><button class="btn btn-success">Novo</button></a></h3>
		@include('arma.calibre.search')
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
               @foreach ($listaCalibres as $cal)
				<tr>
					<td>{{ $cal->id}}</td>
					<td>{{ $cal->descricao}}</td>
					<td>
						<a href="{{URL::action('CalibreController@edit',$cal->id)}}"><button class="btn btn-info">Editar</button></a>
                         <a href="" data-target="#modal-delete-{{$cal->id}}" data-toggle="modal"><button class="btn btn-danger">Excluir</button></a>
					</td>
				</tr>
				@include('arma.calibre.modal')
				@endforeach
			</table>
		</div>
		{{$listaCalibres->render()}}
	</div>
</div>
@stop