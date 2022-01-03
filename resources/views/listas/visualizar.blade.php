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
        <main class="imprimir-lista">
            <div class="container">
                <div class="row pb-3 d-print-none text-end">
                    <div class="col-md-12">
                        <div class="">
                            <a href="{{ route('listas.montar') }}" class="btn btn-warning">Montar Lista</a>

                            <button type="button" onclick="window.print()" class="btn btn-primary">Imprimir</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($listas as $lista)
                        <div class="col-md-6">
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
                                        @foreach ($lista as $item)
                                            <tr>
                                                <td>{{ $item->produto->nome }}</td>
                                                <td>{{ $item->quantidade_estoque }}</td>
                                                <td>{{ $item->quantidade_comprar }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </main>
    </body>

    <script src="{{ mix('/js/app.js') }}"></script>
</html>
