<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}</title>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" type="imagex/png" href="/images/icon.png">
        <meta name="csrf-token" content="{{ csrf_token() }}">
    </head>
    <body>
        <header>
            <div class="container">
                <h2>Montar Lista de Mercado</h2>
            </div>
        </header>
        <main id="app" v-cloak>

            <modal-adicionar-produto url="{{ route('produtos.salvar.json') }}" @adicionar="adicionarProduto"></modal-adicionar-produto>
            <form action="{{ route('listas.salvar') }}" method="POST">
                @csrf
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                           <td scope="col" class="col-1 text-center checkbox-toggle" @click="toogleCheckbox = !toogleCheckbox">
                                               <input type="checkbox" class="">
                                            </td>
                                           <td scope="col">Produto</td>
                                           <td scope="col" class="col-1">Quantidade Referencia</td>
                                           <td scope="col" class="col-2">Quantidade Estoque</td>
                                           <td scope="col" class="col-2">Quantidade Comprar</td>
                                           <td scope="col" class="text-center" colspan="2">Ações</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="produto in produtos">
                                            <td class="text-center">
                                                <input type="checkbox" name="produtos[]" :value="produto.id" :checked="toogleCheckbox">
                                            </td>
                                            <td>@{{ produto.nome }}</td>
                                            <td>@{{ produto.quantidade }}</td>
                                            <td class="text-center">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-icon" type="button" @click="diminuirEstoque(produto)">
                                                            <i class="fas fa-minus-circle text-danger"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" v-model="produto.quantidade_estoque" @change="setarValorComprar(produto)" class="form-control text-center" :name="'quantidade_estoque_' + produto.id">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-icon" type="button" @click="adicionarEstoque(produto)">
                                                            <i class="fas fa-plus-circle text-success"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-icon" type="button" @click="diminuirComprar(produto)">
                                                            <i class="fas fa-minus-circle text-danger"></i>
                                                        </button>
                                                    </div>
                                                    <input type="number" v-model="produto.quantidade_comprar" class="form-control text-center" :name="'quantidade_comprar_' + produto.id">
                                                    <div class="input-group-prepend">
                                                        <button class="btn btn-icon" type="button" @click="adicionarComprar(produto)">
                                                            <i class="fas fa-plus-circle text-success"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-success btn-sm" type="button" @click="completarComprar(produto)">Comprar @{{ produto.quantidade }}</button>
                                            </td>
                                            <td class="text-center">
                                                <button class="btn btn-danger btn-sm" type="button" @click="zerarComprar(produto)">Zerar</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7" class="text-end">
                                                <a href="{{ route('listas.visualizar', date('Y-m')) }}" class="btn btn-warning">Ver Lista</a>
                                                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#modal_adicionar_produto">Adicionar Produto</button>
                                                <input type="submit" value="Salvar" class="btn btn-primary">
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </main>
    </body>

    <script src="{{ asset('js/app.js') }}"></script>
    <script>
        new Vue({
            el:'#app',
            data() {
                return {
                    toogleCheckbox: false,
                    produtos: []
                }
            },
            methods: {
                buscarLista(){
                    $.get(@json(route('produtos.lista.json'))).done(function(produtos){
                        this.produtos = produtos;
                    }.bind(this));
                },
                adicionarProduto(produto){
                    this.produtos.push(produto);
                },
                setarValorComprar(produto){
                    produto.quantidade_comprar = produto.quantidade - produto.quantidade_estoque;
                },
                completarComprar(produto){
                    produto.quantidade_comprar = produto.quantidade;
                },
                zerarComprar(produto){
                    produto.quantidade_comprar = 0;
                },
                diminuirEstoque(produto){
                    produto.quantidade_estoque --;
                    this.setarValorComprar(produto);
                },
                adicionarEstoque(produto){
                    produto.quantidade_estoque ++;
                    this.setarValorComprar(produto);
                },
                diminuirComprar(produto){
                    produto.quantidade_comprar --;
                },
                adicionarComprar(produto){
                    produto.quantidade_comprar ++;
                },
            },
            created() {
                this.buscarLista();
            },
        })
    </script>
</html>
