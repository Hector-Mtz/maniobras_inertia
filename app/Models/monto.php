<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class monto extends Model
{
    use HasFactory;
    protected $fillable =
    ['cantidad',
     'turno_id'
    ];


    public function turno(){
        return $this->belongsTo(turno::class,'turno_id', 'id');
    }
}
