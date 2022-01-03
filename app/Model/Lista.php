<?php

namespace App\Model;

use App\Model\Produto;
use Illuminate\Database\Eloquent\Model;

class Lista extends Model
{
    protected $table = 'listas';
    protected $fillable = ['mes_ano', 'produto_id', 'quantidade_estoque', 'quantidade_comprar'];

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}
