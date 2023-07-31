<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class movimiento extends Model
{
    use HasFactory;

    /**
 * Get the user that owns the phone.
 */
    public function colaborador()
        {
            return $this->belongsTo(colaborador::class, 'idcolaborador', 'idcolaborador');
        }
    
    public function User()
        {
            return $this->belongsTo(User::class, 'id', 'id');
        }

    public function tipoPonchera()
        {
            return $this->belongsTo(tiposPonchera::class, 'idponches', 'idponches');
        }
    
    public function estadoPago()
        {
            return $this->belongsTo(estadoPago::class, 'idestadopago', 'idestadopago');
        }

    public function estado()
        {
            return $this->belongsTo(estado::class, 'idestado', 'idestado');
        }
}
