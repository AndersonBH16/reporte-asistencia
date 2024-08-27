<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Local extends Model
{
    use HasFactory;

    protected $table = "locales";
    protected $primaryKey = 'idlocal';
    protected $fillable = ['descripcion', 'abreviatura'];

    public function unidad()
    {
        return $this->hasMany(Unidad::class, 'idlocal', 'idlocal');
    }
}
