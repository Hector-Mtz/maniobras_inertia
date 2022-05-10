<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class asistencia extends Model
{
    use HasFactory;

    public function turno(){ //vamos a traer los datos de turnos con la llave foranea
        return $this->belongsTo(turno::class, 'turno_id','id');
        //retorna los datos del modelo, pasando como parametro el modelo, la foreingkey de la tabla y la id
        //de la tabla a donde apuntaremos
     }

     public function user(){
         return $this->belongsTo(User::class, 'user_id', 'id');
     }

     public function monto(){
         return $this->belongsTo(monto::class,'monto_id', 'id');
     }


}
