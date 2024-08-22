<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'imagem',
        'valor',
        'ativo',
        'quantidade'
    ];

    //especificando nome da tabela caso não a ligue diretamente
    protected $table = 'produtos';

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'id_categoria');
    }
}


