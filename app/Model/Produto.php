<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    protected $table = 'produtos';
    protected $fillable = ['nome', 'quantidade'];
    protected $appends = ['quantidade_estoque', 'quantidade_comprar', 'checked'];
    public $timestamps  = false;

    public function getQuantidadeEstoqueAttribute()
    {
        return $this->quantidade;
    }
    public function getQuantidadeComprarAttribute()
    {
        return 0;
    }
    public function getCheckedAttribute()
    {
        return false;
    }
}
