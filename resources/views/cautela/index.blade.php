@extends('layouts.admin');
@section('conteudo')
<div class="row">
	<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
		<h3>Lista de Cautelas Ativas <a href="cautela/create"><button class="btn btn-success">Nova cautela</button></a></h3>
		@include('cautela.search')
	</div>
</div>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive">
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th>Id</th>
					<th>Data</th>
                    <th>Número de Série</th>
                    <th>Requerente</th>                    
                    <th>Opções</th>				
				</thead>
               @foreach ($listaCautelas as $cautela)
				<tr>
					<td>{{ $cautela->id }}</td>
                    <td>{{ $cautela->data }}</td>
					<td>{{ $cautela->serialArma }}</td>
                    <td>{{ $cautela->nomeRequerente }}</td>                                        
					<td>						
                        <a href="" data-target="#modal-detalhe-{{$cautela->id}}" data-toggle="modal"><button class="btn btn-basic">Detalhes</button></a>
                        <a href="" data-target="#modal-baixa-{{$cautela->id}}" data-toggle="modal"><button class="btn btn-info">Efetuar baixa</button></a>
					</td>
				</tr>
				@include('cautela.detalhe')
                @include('cautela.modal')
				@endforeach
			</table>
		</div>
		{{$listaCautelas->render()}}
	</div>
</div>
@stop