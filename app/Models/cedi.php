<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cedi extends Model
{
    use HasFactory;
    protected $fillable =
    ['nombreCEDIS',
     'coordenadas',
     'cliente_id'
    ];

    public function cliente(){
        return $this->belongsTo(cliente::class, 'cliente_id', 'id');
    }
}
