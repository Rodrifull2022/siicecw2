<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participante;
use App\DataTables\ParticipantesDataTable;

//agregados 
use App\Models\Pais;
use App\Models\Provincia;
use App\Models\Ciudad;
//
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
//agregadop RP
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DataTables;

class ParticipanteController extends Controller
{
    public function index(ParticipantesDataTable $dataTable)
    {
        $iden=DB::table('TIPOIDENTIFICACION')->pluck('NOMBRETIPO','IDTIPOIDENTIFICACION');
        $tipo=DB::table('TIPOCLIENTE')->where('ACTIVO', 1)->pluck('NOMBRE','IDTIPOCLIENTE');
        $definicion=DB::table('DEF_ETNICA')->where('ACTIVO',1)->pluck('DESC_DEFET', 'ID_DEFET');
        $genero=DB::table('GENERO_PER')->pluck('DES_GEN', 'IDGEN');
        $nacionalidad=DB::table('PAISES')->pluck('NACIONALIDAD', 'ID_PAIS');
        //$paises = DB::table('PAISES')->pluck('NOMBRE_PAIS', 'ID_PAIS');
        $paises = pais::orderBy('NOMBRE_PAIS')->get(['ID_PAIS', 'NOMBRE_PAIS']);
        $movilidad=DB::table('MOVILIDAD_HUMANA')->pluck('DESC_MOVILH', 'ID_MOVILH');
        $convenio= DB::table('CONVENIOS_EXTERNOS')->where('ACTIVO',1)->pluck('INSTITUCION','ID_CONVENIOS_EXTERNOS');
        $facultades= DB::table('FACULTAD')->pluck('NOMBRE','IDFACULTAD');
        return $dataTable->render('participantes.index',compact('iden','tipo','definicion','genero','nacionalidad','paises','movilidad','convenio','facultades'));
        
    }

    public function showSearchPopup()
    {
        return view('participantes.search_popup');
    }

    public function searchByCedula(Request $request)
    {

        //$cedula = $request->cedula;
        $request->validate([
            'cedula' => 'required|string|max:255',
        ]);

        $participante = Participante::where('IDENTIFICACION', $request->cedula)->first();

        if ($participante) {
            return response()->json([
                'success' => true,
                'nombre_completo' => $participante->NOMBRE_COMPLETO,
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Participante no encontrado',
            ]);
        }
    }

    public function store(Request $request)
    {



    $validator = Validator::make($request->all(), [
        //'idtipoidentificacion' => ['required', 'not_in:0,""', 'exists:TIPOIDENTIFICACION,IDTIPOIDENTIFICACION'],
        ///'IDENTIFICACION'=> 'min:10 | max:13',
        'NOMBRE_COMPLETO'=> 'min:2 | max:55 | required ',
        'TITULOP'=> 'min:2 | max:13',
        'EDAD' => ' numeric | digits_between:1,3',
        'EMAIL' => 'email | required | max:55',
        'ID_PAIS' => ['exists:PAISES,ID_PAIS'],
        'CALLE_PRINCIPAL' => 'max:24',
        'NUMERO_DOMICILIO' => 'max:8',
        'CALLE_TRANSVERSAL' => 'max:23',
        'TELEFONO_CASA' => ' max:9',
        'TELEFONO_OFICNA' => 'max:15',
        'TELEFONO_CELULAR' => 'max:10',
        'EXT_TELOFICINA' => ' max:9',
        'REFERENCIA' => 'max:50',
        //'ID_NOMBREFACTURA' => ['required', 'not_in:0,""', 'exists:PARTICIPANTE,ID_NOMBREFACTURA'],
        'IDEMPRESA' => ['not_in:0,""', 'exists:EMPRESA,IDEMPRESA'],
        
    ]);
    
    // Validaciones condicionales
    
    $validator->sometimes('CARNET_NUM_CONADIS', 'required|numeric|digits_between:1,13', function ($input) {
        return $input->discapacidad == 1;
    }, [
        'CARNET_NUM_CONADIS.required' => 'El número de carnet CONADIS es obligatorio',
        'CARNET_NUM_CONADIS.numeric' => 'El número de carnet debe contener solo números',
        'CARNET_NUM_CONADIS.digits_between' => 'El número de carnet debe tener entre 1 y 13 dígitos'
    ]);
    
    $validator->sometimes('IND_DISCAPACIDAD', 'required|numeric|digits_between:1,13', function ($input) {
        return $input->discapacidad == 1;
    }, [
        'IND_DISCAPACIDAD.required' => 'El porcentaje de discapacidad es obligatorio',
        'IND_DISCAPACIDAD.numeric' => 'El porcentaje debe ser un número',
        'IND_DISCAPACIDAD.digits_between' => 'El porcentaje debe tener entre 1 y 13 dígitos'
    ]);

    // Aplicar validacion condicional si el tipo cliente seleccionado es Estudiante EPN
    $validator->sometimes('FACULTAD', 'required|not_in:0,""'|'exists:FACULTAD,IDFACULTAD', function ($input) {
        return $input->TIPOCLIENTE == 1; // Activar si el checkbox está marcado
    });
    

    // Aplicar validación condicional si el checkbox discapacidad está marcado
    $validator->sometimes('CARNET_NUM_CONADIS', 'required|numeric|digits_between:1,13', function ($input) {
        return $input->discapacidad == 1; // Activar si el checkbox está marcado
    });

    $validator->sometimes('IND_DISCAPACIDAD', 'required|numeric|digits_between:1,13', function ($input) {
        return $input->discapacidad == 1; // Activar si el checkbox está marcado
    });

    $validator->sometimes('NUM_STICKER', 'required|numeric|digits_between:1,5', function ($input) {
        return $input->STICKER == 1; // Activar si el checkbox está marcado
    });
    if ($validator->fails()) {
        return response()->json(['errors' => $validator->errors()], 422);
    }
    
    try {
        $participante = new Participante();
        
        // Datos personales
        $participante->IDTIPOIDENTIFICACION = $request->IDTIPOIDENTIFICACION;
        $participante->NOMBRE_COMPLETO = $request->NOMBRE_COMPLETO;
        $participante->TITULOP = $request->TITULOP;
        $participante->FECHA_NAC = $request->FECHA_NAC;
        $participante->EMAIL = $request->EMAIL;
        $participante->ID_DEFET = $request->ID_DEFET;
        $participante->ID_GEN = $request->ID_GEN;
        $participante->ID_NACIONALIDAD = $request->ID_NACIONALIDAD;
        $participante->ID_MOVILH = $request-> ID_MOVILH;
        
        // Datos de discapacidad
        if ($request->has('discapacidad') && $request->discapacidad == 1) {
            $participante->CARNET_NUM_CONADIS = $request->CARNET_NUM_CONADIS;
            $participante->IND_DISCAPACIDAD = $request->IND_DISCAPACIDAD;
        }
        
        // Datos de ubicación
        $participante->ID_PAIS = $request->ID_PAIS;
        $participante->PROVINCIA = $request->provincia;
        $participante->CIUDAD = $request->ciudad;
        $participante->CALLE_PRINCIPAL = $request->CALLE_PRINCIPAL;
        $participante->NUMERO_DOMICILIO = $request->NUMERO_DOMICILIO;
        $participante->CALLE_TRANSVERSAL = $request->CALLE_TRANSVERSAL;
        $participante->DIRECCION = $request->DIRECCION;
        $participante->REFERENCIA = $request->REFERENCIA;
        
        // Datos de contacto
        $participante->TELEFONO_CASA = $request->TELEFONO_CASA;
        $participante->TELEFONO_OFICNA = $request->TELEFONO_OFICNA;
        $participante->EXT_TELOFICINA = $request->EXT_TELOFICINA;
        $participante->TELEFONO_CELULAR = $request->TELEFONO_CELULAR;
        $participante->PLACA_AUTO = $request->PLACA_AUTO;
        $participante->COLOR_AUTO = $request->COLOR_AUTO;
        $participante->MARCA_AUTO = $request->MARCA_AUTO;
        $participante->NUM_STICKER = $request->NUM_STICKER;

       /* if ($request->has('sticker') && $request->sticker == 1) {
            $participante->NUM_STICKER = $request->NUM_STICKER;
            
        }*/

        
        // Datos de tipo cliente y horarios
        $participante->TIPOCLIENTE = $request->TIPOCLIENTE;
        $participante->FACULTAD = $request-> FACULTAD;
        $participante->HORA_ENTRADA = $request->HORA_ENTRADA;
        $participante->HORA_SALIDA = $request->HORA_SALIDA;
        $participante->HORA_ENTRADA_SAB = $request->HORA_ENTRADA_SAB;
        $participante->HORA_SALIDA_SAB = $request->HORA_SALIDA_SAB;
        $participante->IDEMPRESA = $request->IDEMPRESA;
        
        // Datos familiares
        if ($request->filled('IDREP')) {
            $participante->IDREP = $request->IDREP;
        }

        // Campos de autorización
        $participante->DESBLOQUEO_TERCERA_MATRICULA = $request->has('DESBLOQUEO_CONDICION') ? 1 : 0;
        $participante->DESBLOQUEO_CONDICION = $request->has('DESBLOQUEO_CONDICION') ? 1 : 0;
        $participante->DESBLOQUEO_DOS_NIVELES = $request->has('DESBLOQUEO_DOS_NIVELES') ? 1 : 0;
        $participante->DESBLOQUEO_REAGENDAMIENTO_EXAMEN = $request->has('DESBLOQUEO_REAGENDAMIENTO_EXAMEN') ? 1 : 0;

        $participante->save();

        return response()->json([
            'success' => 'Participante guardado exitosamente.',
            'data' => $participante
        ], 200);
    } catch (\Exception $e) {
        return response()->json(['error' => 'Error al guardar el participante: ' . $e->getMessage()], 500);
    }
    
    }

    public function show(Participante $participante)
    {
        return view('participantes.show',compact('participante'));
    }

    public function edit($IDPARTICIPANTE)
    {
        $participante = DB::table('participante')
        ->select([
            'IDPARTICIPANTE', 'APELLIDOS', 'NOMBRES', 'IDENTIFICACION', 'DIRECCION', 'TELEFONO_CASA', 'TELEFONO_OFICNA', 'OBSERVACIONES',
                                    'TIPOCLIENTE', 'FACULTAD', 'IDTIPOIDENTIFICACION', 'TELEFONO_CELULAR', DB::raw('convert(varchar, FECHA_NAC, 103) as FECHA_NAC'), 'EMAIL',
                                    'IDREP', 'IDEMPRESA', 'COD_INICIAL', 'TITULOP', 'EXT_TELOFICINA', 'PAIS', 'CIUDAD', 'NOMBRE_COMPLETO', 'ID_DEFET', 'ID_GEN', 'ID_PAIS', 'ID_NACIONALIDAD',
                                    'ID_MOVILH', 'CARNET_NUM_CONADIS', 'IND_DISCAPACIDAD', 'PROVINCIA', 'CALLE_PRINCIPAL', 'CALLE_TRANSVERSAL', 'NUMERO_DOMICILIO', 'REFERENCIA', 'POBOX',
                                    'DESCUENTO_CONADIS', 'DESCUENTO', 'ID_DESCUENTO', DB::raw('DATEDIFF(YEAR, FECHA_NAC, GETDATE()) AS EDAD'), 'ID_NOMBREFACTURA', 'ID_CONVENIO_EXTERNO',
                                    'IND_DTO_TIPOCLIENTE_EPN','IND_PARENTEZCO_PRIMER_GRADO_REP','IND_ENVIO_INFORMACION',
                                    DB::raw('CONVERT(NVARCHAR, HORA_ENTRADA, 108) AS HORA_ENTRADA'), DB::raw('CONVERT(NVARCHAR, HORA_SALIDA, 108) AS HORA_SALIDA'), DB::raw('CONVERT(NVARCHAR, HORA_ENTRADA_SAB, 108) AS HORA_ENTRADA_SAB'),
                                    DB::raw('CONVERT(NVARCHAR, HORA_SALIDA_SAB, 108) AS HORA_SALIDA_SAB'), 'REGIMEN_ESTUDIOS_EPN', 'CARRERA_EPN', 'CODIGO_CARRERA_EPN', 'DESBLOQUEO_TERCERA_MATRICULA', 'DESBLOQUEO_CONDICION', 'DESBLOQUEO_DOS_NIVELES',
                                    'ID_BENFACTURA', 'DESBLOQUEO_REAGENDAMIENTO_EXAMEN',
                                    'ID_PARTICIPANTE_HERMANO','ID_PARTICIPANTE_CONYUGE',DB::raw('(SELECT s.NOMBRE_COMPLETO FROM participante s WHERE s.IDPARTICIPANTE = participante.IDREP) AS nombre_representante'), DB::raw('(SELECT s.NOMBRE_COMPLETO FROM participante s WHERE s.IDPARTICIPANTE = participante.ID_PARTICIPANTE_CONYUGE) AS nombre_conyuge'),DB::raw('(SELECT s.NOMBRE_COMPLETO FROM participante s WHERE s.IDPARTICIPANTE = participante.ID_PARTICIPANTE_HERMANO) AS nombre_hermano'),
                                    'IND_EMP_UNIPERSONAL'
            ])->where('IDPARTICIPANTE', $IDPARTICIPANTE)
        ->first();
        $genero = DB::table('GENERO_PER')
        ->select('IDGEN','DES_GEN')
        ->get();
        $currentYear = Carbon::now()->year;
        $busqueda=DB::table('participante')
        ->select(['IDPARTICIPANTE','IDENTIFICACION','NOMBRE_COMPLETO','FECHA_CRE'])
        ->whereYear('FECHA_CRE', $currentYear)
        ->get();

           $movilidad=DB::table('MOVILIDAD_HUMANA')
           ->select('ID_MOVILH','DESC_MOVILH')
           ->get();

           $pais=DB::table('PAISES')
           ->select('ID_PAIS','NOMBRE_PAIS')
           ->get();



            $nacionalidad=DB::table('PAISES')
            ->select('ID_PAIS','NACIONALIDAD')
            ->get();


            $definicion=DB::table('DEF_ETNICA')
            ->select('ID_DEFET','DESC_DEFET')->where('ACTIVO',1)
            ->get();

            $iden= DB::table('TIPOIDENTIFICACION')
            ->select('IDTIPOIDENTIFICACION','NOMBRETIPO')
            ->get();

            $tipo=DB::table('TIPOCLIENTE')
            ->select('IDTIPOCLIENTE','NOMBRE')->where('ACTIVO',1)
            ->get();

            $convenio=DB::table('CONVENIOS_EXTERNOS')
            ->select('ID_CONVENIOS_EXTERNOS','INSTITUCION')->where('ACTIVO',1)
            ->get();

       return view('participantes.edit',compact('participante','pais','movilidad','nacionalidad','definicion','iden','tipo','convenio', 'genero', 'busqueda'));

    }

    public function update(Request $request, $IDPARTICIPANTE)
    {
        dd("entre");
        $request->validate([
            
            'IDENTIFICACION' => 'required',
            'NOMBRE_COMPLETO' => 'required',
            //campos RP
            'TELEFONO_CASA' => 'required|string|max:40',
            'TELEFONO_OFICNA' => 'required|string|max:20',
            'TELEFONO_CELULAR' => 'required|string|max:20',
            'EMAIL' => 'required|email|max:255',
            'DIRECCION' => 'required|string|max:150',
            'EXT_TELOFICINA' => 'required|string|max:10',
            'REFERENCIA' => 'required|string|max:50',
            'NUMERO_DOMICILIO' => 'required|string|max:50',
            'CALLE_TRANSVERSAL' => 'required|string|max:50',
            'CALLE_PRINCIPAL' => 'required|string|max:50',
            'PAIS' => 'required|string|max:50',
            'PROVINCIA' => 'required|string|max:50',
            'CIUDAD' => 'required|string|max:50',
            'PLACA_AUTO' => 'required|string|max:50',
            'COLOR_AUTO' => 'required|string|max:50',
            'MARCA_AUTO' => 'required|string|max:50',
            'num_sticker' => 'required|string|max:50'
        ]);

        $participante = Participante::find($IDPARTICIPANTE);

        $participante->IDENTIFICACION = $request->input('identificacion');
        $participante->NOMBRE_COMPLETO = $request->input('nombre_completo');
        $participante->save();

        //borrado de campos para que quede para insertar nuevo participante
        //campos anteriores
        /*$participante->TELEFONO_CASA = null;
        $participante->TELEFONO_OFICNA = null;
        $participante->TELEFONO_CELULAR = null;
        $participante->EMAIL = null;
        $participante->DIRECCION = null;
        $participante->EXT_TELOFICINA = null;
        $participante->REFERENCIA = null;
        $participante->NUMERO_DOMICILIO = null;
        $participante->CALLE_TRANSVERSAL = null;
        $participante->CALLE_PRINCIPAL = null;
        $participante->PAIS = null;
        $participante->PROVINCIA = null;
        $participante->CIUDAD = null;
        $participante->PLACA_AUTO = null;
        $participante->COLOR_AUTO = null;
        $participante->MARCA_AUTO = null;
        $participante->num_sticker = null;*/
        //campos siguientes

        return redirect()->route('participantes.index')
                        ->with('success','El participante ha sido actualizado satisfactoriamente');
    }

    public function destroy(Request $request)
    {
       
        $usr = Participante::where('IDPARTICIPANTE',$request->idparticipante)->delete();

        return Response()->json($usr);
    }

    //agregadas RP
    public function tuMetodo()
    {
        $paises = pais::orderBy('NOMBRE_PAIS')->get(['ID_PAIS', 'NOMBRE_PAIS']);
        
        // Otros datos que necesites para tu vista
        
        return view('tu.vista', compact('paises'));
    }   
    public function getProvincias(Request $request)
    {
        $provincias = Provincia::where('ID_PAIS', $request->pais_id)->orderBy('PROVINCIA_NOMBRE', 'asc')->get();
        return response()->json($provincias);
    }

    public function getCiudades(Request $request)
    {
        $ciudades = Ciudad::where('provincia_id', $request->provincia_id)->get();
        return response()->json($ciudades);
    }

}
