<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class produto extends Model
{
    use HasFactory;

    //especificando nome da tabela caso não a ligue diretamente
    protected $table = 'produtos';
}
