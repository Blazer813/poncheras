<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tiposPonchera extends Model
{
    use HasFactory;

    protected $table = 'tipos_poncheras';
    protected $primaryKey = 'idponches';
    protected $fillable = [
        'nombreponche',
        'valor',
    ]; 
}
