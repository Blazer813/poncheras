<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class colaborador extends Model
{
    use HasFactory;

    protected $table = 'colaboradors';
    protected $primaryKey = 'idcolaborador';
    protected $fillable = [
        'nombrecompleto',
        'documentoid',
        'telefono',
        'fotoperfil',
        'correo',
        'fcnacimiento',
    ]; 
}
