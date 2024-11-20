<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participante extends Model
{
    
    //protected $guarded=['id'];
    protected $table='PARTICIPANTE';
    protected $primaryKey='IDPARTICIPANTE';
    protected $fillable = ['IDTIPOIDENTIFICACION','pais','provincia','NOMBRE_COMPLETO','ciudad','CALLE_PRINCIPAL','NUMERO_DOMICILIO', 'CALLE_TRANSVERSAL','REFERENCIA','direccion2','TELEFONO_CASA','TELEFONO_OFICNA','EXT_TELOFICINA','TELEFONO_CELULAR'];
    public $timestamps = false;
    //protected $dateFormat = 'Y-d-m H:i:s';
   use HasFactory;
   //protected $fillable=['cedula', 'nombre_completo'];

   // protected $dateFormat ='Ymd';
}
