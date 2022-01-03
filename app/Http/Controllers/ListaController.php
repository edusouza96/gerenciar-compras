<?php

namespace App\Http\Controllers;

use App\Model\Lista;
use App\Model\Produto;
use Illuminate\Http\Request;

class ListaController extends Controller
{
    public function montar(Request $request)
    {
        return view('listas.montar');
    }

    public function salvar(Request $request)
    {
        $produtos = $request->produtos;

        foreach ($produtos as $produto) {
            $quantidadeEstoque = $request->get('quantidade_estoque_'.$produto);
            $quantidadeComprar = $request->get('quantidade_comprar_'.$produto);

            Lista::updateOrCreate(
                [
                    'mes_ano' => date('Y-m'),
                    'produto_id' => $produto,
                ],
                [
                    'quantidade_estoque' => $quantidadeEstoque,
                    'quantidade_comprar' => $quantidadeComprar
                ]
            );
        }

        return redirect()->route('listas.visualizar', [date('Y-m')]);
    }

    public function visualizar($mesAno)
    {
        $listas = Lista::where('mes_ano', $mesAno)->get()->sortBy('produto.nome')->split(2);
        return view('listas.visualizar', compact('listas'));
    }
}
