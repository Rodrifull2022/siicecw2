<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class provincia extends Model
{
    use HasFactory;
    protected $table = 'PROVINCIA';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['ID_PAIS', 'NOMBRE_PROVINCIA'];

    public function pais()
    {
        return $this->belongsTo(Pais::class, 'ID_PAIS');    
    }

    public function ciudades()
    {
        return $this->hasMany(Ciudad::class, 'provincia_id');
    }       
}
