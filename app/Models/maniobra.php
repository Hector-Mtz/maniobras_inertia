<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class maniobra extends Model
{
    use HasFactory;
    protected $fillable =
    ['nombreManiobra',
     'cedis_id',
     'activo'
    ];

    public function scopeCedis($query, $idCedis) {
    	if ($idCedis) {
    		return $query->where('idCEDISFk','like',"%$idCedis%");
    	}
    }
}
