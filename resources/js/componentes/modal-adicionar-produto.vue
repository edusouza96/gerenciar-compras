<template>
    <div id="modal_adicionar_produto" class="modal fade" tabindex="-1" role="dialog">
		<div class="modal-dialog modal-md" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Adicionar novo produto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Produto</label>
                                <input type="text" class="form-control" v-model="nome">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Quantidade de Referencia</label>
                                <input type="number" class="form-control" v-model="quantidade">
                            </div>
                        </div>
                    </div>
				</div>
				<div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal" @click="salvar()" :disabled="disabled">Salvar</button>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
        props: ['url'],
        data: function(){
            return {
                nome : '',
                quantidade : '',
            }
        },
        methods: {
            salvar(){
                $.post(this.url, {nome: this.nome.toUpperCase(), quantidade: this.quantidade}).done(function(produto){
                    this.$emit('adicionar', produto)
                }.bind(this));
            }
        },
        computed: {
            disabled(){
                return this.nome == '' || this.quantidade == '';
            }
        },
    }
</script>
