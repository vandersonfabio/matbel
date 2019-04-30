@extends('layouts.admin');
@section('conteudo')
<div class="row">
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<h3>Editar arma: <b>{{ $arma->numeroSerie }}</b></h3>
			@if (count($errors)>0)
			<div class="alert alert-danger">
				<ul>
				@foreach ($errors->all() as $error)
					<li>{{$error}}</li>
				@endforeach
				</ul>
			</div>
			@endif

			{!!Form::model($arma, ['method'=>'PATCH', 'route'=>['arma.update', $arma->id]])!!}
			{{Form::token()}}
            
            <div class="form-group">
                <label for="idTipo">Tipo</label>
				<select class="form-control" name="idTipo">
					@foreach ($tipos->all() as $t)
					<option 
							value = "{{ $t->id }}"
							@if ($t->id == $modelo->idTipo)
        						selected="selected"
							@endif>
								{{$t->descricao}}
						</option>
					@endforeach
				</select>
            </div>
            <div class="form-group">
                <label for="idFabricante">Fabricante</label>
				<select class="form-control" name="idFabricante">
					@foreach ($fabricantes->all() as $f)
					<option 
							value = "{{ $f->id }}"
							@if ($f->id == $modelo->idFabricante)
        						selected="selected"
							@endif>
								{{$f->descricao}}
						</option>
					@endforeach
				</select>
            </div>
            <div class="form-group">
                <label for="idCalibre">Calibre</label>
				<select class="form-control" name="idCalibre">
					@foreach ($calibres->all() as $c)
						<option 
							value = "{{ $c->id }}"
							@if ($c->id == $modelo->idCalibre)
        						selected="selected"
							@endif>
								{{$c->descricao}}
						</option>
					@endforeach
				</select>
            </div>
            <div class="form-group">
            	<label for="descricao">Descrição</label>
            	<input type="text" name="descricao" value="{{ $modelo->descricao }}" class="form-control" placeholder="Descrição do modelo...">
            </div>
            <div class="form-group">
            	<label for="comprimentoCano">Comprimento do Cano</label>
            	<input type="text" name="comprimentoCano" value="{{ $modelo->comprimentoCano }}" class="form-control" placeholder="Comprimento do cano do modelo (em cm)...">
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