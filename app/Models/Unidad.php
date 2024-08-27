<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unidad extends Model
{
    use HasFactory;

    protected $table = 'unidades';
    protected $primaryKey = 'idunidad';
    protected $fillable = ['unidad'];

    public function usuario()
    {
        return $this->hasMany(Usuario::class, 'idunidad', 'idunidad');
    }

    public function local()
    {
        return $this->belongsTo(Local::class, 'idlocal');
    }
}
