@extends('layouts.admin')
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Nova Arma</h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::open(array('url'=>'arma/arma','method'=>'POST','autocomplete'=>'off'))!!}
            {{Form::token()}}
            
            <div class="form-group">
                <label for="idModelo">Modelo</label>
				<select class="form-control" name="idModelo">
					@foreach ($modelos->all() as $m)
						<option value = "{{ $m->id }}">{{$m->descricaoTipo}} {{$m->descricaoFabricante}} {{$m->descricao}}</option>
					@endforeach
				</select>
            </div>

            <div class="form-group">
            	<label for="numeroSerie">Número de Série</label>
            	<input type="text" name="numeroSerie" class="form-control" placeholder="Número de série do armamento...">
            </div>

            <div class="form-group">
                <label for="idSituacao">Situação</label>
				<select class="form-control" name="idSituacao">
					@foreach ($situacoes->all() as $s)
						<option value = "{{ $s->id }}">{{$s->descricao}}</option>
					@endforeach
				</select>
            </div>
            
            <div class="form-group">
            	<button class="btn btn-primary" type="submit">Salvar</button>
            	<button class="btn btn-cancel" type="reset">Desfazer</button>
                <button class="btn btn-danger" type="button" onClick="history.go(-1)">Cancelar</button>
            </div>

			{!!Form::close()!!}		
            
		</div>
	</div>
@stop