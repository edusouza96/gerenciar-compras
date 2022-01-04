<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ env('APP_NAME') }}</title>
        <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
        <link rel="shortcut icon" type="imagex/png" href="/images/icon.png">
    </head>
    <body>
        <header>
            <div class="container d-print-none">
                <h2>Lista de Mercado</h2>
            </div>
        </header>
        <main class="imprimir-lista" id="app">
            <div class="container">
                <div class="row pb-3 d-print-none">
                    <div class="col-md-6 text-center">
                        <div class="form-group">
                            <label>Listas Disponiveis</label>
                            <select class="form-control">
                                <option v-for="lista in listasDisponiveis" :value="lista.mes_ano" class="text-center">@{{ lista.mes_ano }}</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="">
                            <a href="{{ route('listas.montar') }}" class="btn btn-warning">Montar Lista</a>

                            <button type="button" onclick="window.print()" class="btn btn-primary">Imprimir</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                        <div class="col-md-6" v-for="lista in listas">
                            <div class="table-responsive">
                                <table class="table table-striped table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">Produto</th>
                                            <th scope="col" class="col-1">Estoque</th>
                                            <th scope="col" class="col-1">Comprar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <tr v-for="item in lista">
                                                <td>@{{ item.produto.nome }}</td>
                                                <td>@{{ item.quantidade_estoque }}</td>
                                                <td>@{{ item.quantidade_comprar }}</td>
                                            </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
        </main>
    </body>

    <script src="{{ mix('/js/app.js') }}"></script>
    <script>
        new Vue({
            el:'#app',
            data() {
                return {
                    listas: [],
                    listasDisponiveis: [],
                }
            },
            methods: {
                buscarLista(){
                    $.get(@json(route('listas.lista.json', $mesAno))).done(function(listas){
                        this.listas = listas;
                    }.bind(this));
                },
                popularComboListasDisponiveis(){
                    $.get(@json(route('listas.listas-disponiveis.json'))).done(function(listas){
                        this.listasDisponiveis = listas;
                    }.bind(this));
                }
            },
            created() {
                this.popularComboListasDisponiveis();
                this.buscarLista();
            },
        })
    </script>
</html>
