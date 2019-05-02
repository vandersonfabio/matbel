<div class="modal fade modal-slide-in-right" aria-hidden="true"
role="dialog" tabindex="-1" id="modal-detalhe-{{$cautela->id}}">
	
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" 
				aria-label="Close">
                     <span aria-hidden="true">×</span>
                </button>
                <h4 class="modal-title">Detalhes Cautela - <b>{{ $cautela->nomeRequerente }}</b></h4>
			</div>
			<div class="modal-body">
				<p>Armamento: <b>{{ $cautela->descricaoTipo }} {{ $cautela->descricaoFabricante }} {{ $cautela->descricaoModelo }}</b></p>
                <p>Número de série: <b>{{ $cautela->serialArma }} </b></p>
                <p>Munições: <b>{{ $cautela->qtdMunicao }} </b></p>
                <p>Carregadores: <b>{{ $cautela->qtdCarregador }} </b></p>
                <p>Data de entrega: <b>{{ $cautela->data }} </b></p>                
                <p>Observações: <b>{{ $cautela->observacao }} </b></p>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>				
			</div>
		</div>
	</div>
	

</div>