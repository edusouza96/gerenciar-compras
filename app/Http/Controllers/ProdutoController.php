<?php

namespace App\Http\Controllers;

use App\Model\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function listaJson()
    {
        $produtos = Produto::orderBy('nome')->get();
        return response()->json($produtos);
    }

    public function salvarJson(Request $request)
    {
        $produto = Produto::create($request->all());
        return response()->json($produto);
    }
}
