<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ciudad extends Model
{
    use HasFactory;
    protected $table = 'CIUDAD';
    protected $primaryKey = 'ID';
    public $timestamps = false;

    protected $fillable = ['provincia_id', 'NOMBRE_CIUDAD'];

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'provincia_id');
    }
}
