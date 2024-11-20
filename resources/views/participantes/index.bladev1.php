
@extends('adminlte::page')
@section('title', 'Administración de Participantes')
@section('content_header')
    <h1>Gestión de requerimientosssss</h1>
@stop
    <!--<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM=" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>-->

@section('content')
    <div class="container" style="max-width:100%">

        <div class="card">
            <div class="card-header"><h4>Administración de Personas</h4></div>
            <div class="row">
                <div class="col-lg-12 margin-tb" style="padding-left: 30px">

                    <div class="pull-right mb-2" style="padding-top: 25px">
                        <!--Interfaz Nuevo-->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#idModal">
                            Nuevo
                        </button>

                    </div>
                </div>
            </div>
            <!-- Modal que se activa al dar clic en el botón nuevo -->
            <div class="modal fade" id="idModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ingrese su Cédula o Pasaporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="idForm">
                    <div class="form-group">
                        <label for="identification">Número de Cédula o Pasaporte</label>
                        <input type="text" class="form-control" id="identification" required>
                        <div class="invalid-feedback">
                            Por favor ingrese un número válido.
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary" id="pasar-texto">Enviar</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Tab de opciones (oculto inicialmente) -->
<div class="container" id="tabsContainer" style="display: display; max-width:100%;font-size:14px">
    <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab myTab" role="tablist" >
              <li class="nav-item"><a class="nav-link active" href="#informacion" data-toggle="tab">Información Personal</a></li>
              <li class="nav-item"><a class="nav-link" href="#dato_ubicacion" data-toggle="tab">Datos de Ubicación</a></li>
              <li class="nav-item"><a class="nav-link" href="#tipo_cliente" data-toggle="tab">Tipo de Cliente</a></li>
              <li class="nav-item"><a class="nav-link" href="#dato_familiar" data-toggle="tab">Datos Familiares</a></li>
              <li class="nav-item"><a class="nav-link" href="#facturacion" data-toggle="tab">Facturación</a></li>
              <li class="nav-item"><a class="nav-link" href="#autorizacion" data-toggle="tab">Autorizaciones</a></li>
            </ul>
          </div><!-- /.card-header -->
    <div class="card-body">
    <form id="ajaxFormDatos">
            <div class="tab-content" id="myTabContent">
              <div class="active tab-pane" id="informacion">

    


            <div class="row invoice-info">
                <!-- Campos del formulario de registro -->
                    <div class="col-sm-4 invoice-col">
                        <label for="name">Idparticipante</label>
                        <input type="text" class="form-control" id="idparticipante" required value="0" disabled>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Tipo</label>
                        <select class="form-control" id="idtipoidentificacion" name="idtipoidentificacion">
                            <option value="0">Escoja el tipo de identificación</option>
                            @foreach($iden as $id => $nombre)
                            <option value="{{ $id }}" {{ old('IDTIPOIDENTIFICACION') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                      </select>
                      <span id="idtipoidentificacionError" class="text-danger error-messages"></spam>

                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Identificación</label>
                        <input type="text" class="form-control" id="IDENTIFICACION" name="IDENTIFICACION" readonly required>
                    </div>

            </div>
            <div class="row invoice-info">

                    <div class="col-sm-4 invoice-col" >
                        <label for="text">Apellidos y Nombres</label>
                        <input type="text" class="form-control" id="NOMBRE_COMPLETO" name="NOMBRE_COMPLETO" >
                        <span id="NOMBRE_COMPLETOError" class="text-danger error-messages"></spam>
                        
                    </div>

                    <div class="col-sm-4 invoice-col">
                        <label for="text">Título</label>
                        <input type="text" class="form-control" id="TITULOP" name="TITULOP" required>
                        <span id="TITULOPError" class="text-danger error-messages"></spam>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Fecha Nacimiento</label>
                        <div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" id="FECHA_NAC" name="FECHA_NAC"/>
                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        </div>
                        <span id="FECHA_NACError" class="text-danger error-messages"></spam>
                    </div>
            </div>

            <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Edad</label>
                        <input type="text" class="form-control" id="EDAD" nombre="EDAD" >
                        <span id="EDADError" class="text-danger error-messages"></spam>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="EMAIL" name="EMAIL" >
                        <span id="EMAILError" class="text-danger error-messages"></spam>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Auto Definición Étnica</label>
                        <select class="form-control" id="ID_DEFET" name="ID_DEFET" required>
                            <option value="0">Escoja el tipo de AutoDefinicion</option>
                            @foreach($definicion as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_DEFET') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_DEFETError" class="text-danger error-messages"></spam>
                    </div>

            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <label for="text">Género</label>
                    <select class="form-control" id="ID_GEN" name="ID_GEN" required>
                        <option value="">Escoja el género</option>
                            @foreach($genero as $id => $nombre)
                            <option value="{{ $id }}" {{ old('IDGEN') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_GENError" class="text-danger error-messages"></spam>
                </div>


                <div class="col-sm-4 invoice-col">
                    <label for="text">Nacionalidad</label>
                    <select class="selectpicker form-control" id="ID_NACIONALIDAD" name="ID_NACIONALIDAD" data-live-search="true" required>
                        <option value="0">Escoja la nacionalidad</option>
                            @foreach($nacionalidad as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_PAIS') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_NACIONALIDADError" class="text-danger error-messages"></spam>
                </div>
                <div class="col-sm-4 invoice-col">
                    <label for="text">Estado Migratorio</label>
                    <select class="form-control" id="ID_MOVILH" name="ID_MOVILH" >
                        <option value="0">Escoja el estado migratorio</option>
                            @foreach($movilidad as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_MOVILH') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_MOVILHError" class="text-danger error-messages"></spam>
                </div>

            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <label for="text">¿Alguna discapacidad?</label>

                    <!--<div class="custom-control custom-switch">

                        <input type="checkbox" class="custom-control-input" id="discapacidad" name="discapacidad">

                        <label class="custom-control-label" for="discapacidad">Si</label>
                        </div>-->

                        <div class="custom-control custom-checkbox">
                            <input type="checkbox" class="custom-control-input" id="discapacidad" name="discapacidad" value="1">
                            <label class="custom-control-label" for="discapacidad">¿Tiene discapacidad?</label>
                        </div>
                </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="text">#Carnet</label>
                        <input type="text" class="form-control" id="CARNET_NUM_CONADIS" name="CARNET_NUM_CONADIS" disabled>
                        <div class="invalid-feedback"></div>
                        <span id="CARNET_NUM_CONADISError" class="text-danger error-messages"></spam>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">%Discapacidad</label>
                        <input type="text" class="form-control" id="IND_DISCAPACIDAD" name="IND_DISCAPACIDAD" value="0" disabled>
                        <div class="invalid-feedback"></div>
                        <span id="IND_DISCAPACIDADError" class="text-danger error-messages"></spam>
                    </div>

            </div>
            <div class="row invoice-info">
                <div class="col-sm-4 invoice-col">
                    <label for="text">¿Acepta la política de Datos Personales?</label>

                    <div class="custom-control custom-switch">

                        <input type="checkbox" class="custom-control-input" id="ACEPTACION_DP" name="ACEPTACION_DP">

                        <label class="custom-control-label" for="ACEPTACION_DP">Si</label>
                    </div>
                </div>
            <div class="col-sm-4 invoice-col">

                        <label for="text">Observaciones</label>
                        <input type="text" class="form-control" id="OBSERVACIONES" name="OBSERVACIONES">

            </div>
            </div>
              </div>
<!-- FORMULARIO DE PRUAB LUEGO SE BORRA Y SE ACOGE AL GENERAL -->
              <div class="tab-pane" id="dato_ubicacion">
                   
                   <!-- @csrf-->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                
                                <div class="form-group">
                                    <label for="pais">País:</label>
                                    <select id="ID_PAIS" name="ID_PAIS" class="form-control" required>
                                        <option value="0">Seleccione un país</option>
                                        @foreach($paises as $pais)
                                        <!-- <option value="{{ $pais->ID_PAIS }}">{{ $pais->NOMBRE_PAIS }}</option>-->
                                        <option value="{{ $pais->ID_PAIS}}" {{ old('ID_PAIS') == $id ? 'selected' : '' }}>{{ $pais->NOMBRE_PAIS }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <span id="ID_PAISError" class="text-danger error-messages"></spam>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="form-group">
                                    <label for="provincia">Provincia:</label>
                                    <select id="provincia" name="provincia" class="form-control" disabled>
                                        <option value="">Seleccione una provincia</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <div class="form-group">
                                    <label for="ciudad">Ciudad:</label>
                                    <select id="ciudad" name="ciudad" class="form-control" disabled>
                                        <option value="">Seleccione una ciudad</option>
                                    </select>
                                </div>
                            </div>

                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">C.Principal</label>
                                <input class="form-control" type="text" name="CALLE_PRINCIPAL" id="CALLE_PRINCIPAL"  value="{{ old('CALLE_PRINCIPAL') }}">
                                <span id="CALLE_PRINCIPALError" class="text-danger error-messages"></spam>
                            </div>
                            
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Número</label>
                                <input class="form-control" type="text" name="NUMERO_DOMICILIO" id="NUMERO_DOMICILIO"  value="{{ old('NUMERO_DOMICILIO') }}" required>
                                <span id="NUMERO_DOMICILIOError" class="text-danger error-messages"></spam>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Transversal</label>
                                <input class="form-control" type="text" name="CALLE_TRANSVERSAL" id="CALLE_TRANSVERSAL"  value="{{ old('CALLE_TRANSVERSAL') }}" required>
                                <span id="CALLE_TRANSVERSALError" class="text-danger error-messages"></spam>
                            </div>


                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Sector</label>
                                <input class="form-control" type="text" name="REFERENCIA" id="REFERENCIA"  value="{{ old('REFERENCIA') }}" required>
                                <span id="REFERENCIAError" class="text-danger error-messages"></spam>
                                        
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Dirección</label>
                                <input type="text" class="form-control" id="direccion2" name="direccion2" readonly required>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Telf. Casa</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input class="form-control" type="text" name="TELEFONO_CASA" id="TELEFONO_CASA"  value="{{ old('TELEFONO_CASA') }}" required>
                                    <span id="TELEFONO_CASAError" class="text-danger error-messages"></spam>
                                
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Telf. Oficina</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input class="form-control" type="text" name="TELEFONO_OFICNA" id="TELEFONO_OFICNA"  value="{{ old('TELEFONO_OFICNA') }}">
                                    <span id="TELEFONO_OFICNAError" class="text-danger error-messages"></spam>
                                </div>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Extensión</label>
                                <input class="form-control" type="text" name="EXT_TELOFICINA" id="EXT_TELOFICINA"  value="{{ old('EXT_TELOFICINA') }}">
                                <span id="EXT_TELOFICINAError" class="text-danger error-messages"></spam>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Celular</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" name="TELEFONO_CELULAR" id="TELEFONO_CELULAR"  value="{{ old('TELEFONO_CELULAR') }}" required>
                                    <span id="TELEFONO_CELULARError" class="text-danger error-messages"></spam>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <fieldset>
                            <legend style="font-size: 12px; font-weight: bold;">IINFORMACIÓN DEL AUTOMOTOR DEL CLIENTE </legend>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Placa</label>
                                    <div class="input-group-prepend">
                                        <input class="form-control" type="text" name="PLACA_AUTO" id="PLACA_AUTO"  value="{{ old('PLACA_AUTO') }}">
                                        <span id="PLACA_AUTOError" class="text-danger error-messages"></spam>
                                    </div>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Color</label>
                                    <input class="form-control" type="text" name="COLOR_AUTO" id="COLOR_AUTO"  value="{{ old('COLOR_AUTO') }}">
                                    <span id="COLOR_AUTOError" class="text-danger error-messages"></spam>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Marca</label>
                                    <div class="input-group-prepend">
                                        <input type="text" class="form-control" name="MARCA_AUTO" id="MARCA_AUTO"  value="{{ old('MARCA_AUTO') }}" required>
                                        <span id="MARCA_AUTOError" class="text-danger error-messages"></spam>
                                    </div>

                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Sticker</label>
                                    <div class="input-group-prepend">
                                        <select  name="STICKER" id="STICKER" class="form-control" >
                                            <option value="0">No</option>
                                            <option value="1">Si</option>
                                        </select>
                                        
                                    </div>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">N°.</label>
                                    <input class="form-control" type="text" name="NUM_STICKER" id="NUM_STICKER"  value="{{ old('NUM_STICKER') }}">
                                    <span id="NUM_STICKERError" class="text-danger error-messages"></spam>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    

                                </div>
                            </div>
                        </fieldset>
                    
              </div>
      


              <div class="tab-pane" id="tipo_cliente">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Tipo de Cliente</label>
                        <select class="form-control" id="TIPOCLIENTE" name="TIPOCLIENTE">
                            <option value="0">Escoja el tipo de cliente</option>
                            @foreach($tipo as $id => $nombre)
                             <option value="{{ $id }}" {{ old('IDTIPOCLIENTE') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                            @endforeach
                        </select>
                        <span id="TIPOCLIENTEError" class="text-danger error-messages"></spam>
                    </div> 
                 
                 
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Facultad</label>
                        <select class="form-control" id="FACULTAD" name="FACULTAD">
                            <option value="0">Escoja la facultad</option>
                            @foreach($facultades as $id => $facultad)
                             <option value="{{ $id }}" {{ old('IDFACULTAD') == $id ? 'selected' : '' }}>{{ $facultad }}</option>
                            @endforeach
                        </select>
                        <span id="FACULTADError" class="text-danger error-messages"></spam>
                    </div> 
                    <div class="col-sm-4 invoice-col">
                      <label for="text">Carrera</label>
                        <input type="text" class="form-control" name="CARRERA_EPN" id="CARRERA_EPN"  value="{{ old('CARRERA_EPN') }}" readonly>
                        <span id="CARRERA_EPNError" class="text-danger error-messages"></spam>
                    </div> 
                  </div>     
                
                <div class="row invoice-info">
                    
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Regimen estudios</label>
                        <input type="text" class="form-control" id="REGIMEN_ESTUDIOS_EPN" name="REGIMEN_ESTUDIOS_EPN" readonly >
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">valor</label>
                        <input type="test" class="form-control" id="" name="" readonly>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        
                    </div>
                </div>

                <div class="row invoice-info">
                    
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Entrada</label>
                        <input type="time" class="form-control" id="HORA_ENTRADA" name="HORA_ENTRADA" >
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Salida</label>
                        <input type="time" class="form-control" id="HORA_SALIDA" name="HORA_SALIDA" >
                    </div>
                    <div class="col-sm-4 invoice-col">
                        
                    </div>
                </div>
                    <div class="row invoice-info">
                        <div class="col-sm-4 invoice-col">
                            <label for="text">Entrada Sab.</label>
                            <input type="time" class="form-control" id="HORA_ENTRADA_SAB" name="HORA_ENTRADA_SAB" >
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <label for="text">Sale Sab.</label>
                            <input type="time" class="form-control" id="HORA_SALIDA_SAB" name="HORA_SALIDA_SAB" >
                        </div>
                        <div class="col-sm-4 invoice-col">
                            <label for="text">Convenio, Acuerdo asociado al Cliente</label>
                            <select class="form-control" id="convenio" required>
                                <option value="">Escoja el convenio</option>
                            @foreach($convenio as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_CONVENIOS_EXTERNOS') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        @error('ID_CONVENIOS_EXTERNOS')
            <div class="text-danger">{{ $message }}</div>
        @enderror
                        </div>
                    </div>
              </div>

              <div class="tab-pane" id="dato_familiar">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
<!-- Botón para abrir el popup de búsqueda -->
<!--<button type="button" class="btn btn-link" data-toggle="modal" data-target="#searchModal" style="position: absolute; right: 10px; top: 73%; transform: translateY(-50%);">
        <i class="fa fa-search"></i>
    </button>-->

<!-- Textbox para mostrar el nombre completo -->

 <label for="nombreCompleto">Nombre del Representante</label>
 <input type="text" class="form-control" id="IDREP" name="IDREP">
 <span id="IDREPError" class="text-danger error-messages"></spam>
 


<!-- Incluir el popup de búsqueda -->
@include('participantes.search_popup')

 </div>
 <div class="col-sm-4 invoice-col">
                         <!-- Botón para abrir el popup de búsqueda -->
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#searchModal" style="position: absolute; right: 10px; top: 73%; transform: translateY(-50%);">
<i class="fa fa-search"></i>
</button>

<!-- Textbox para mostrar el nombre completo -->

<label for="nombreCompleto">Nombre del Conyuge</label>
<input type="text" class="form-control" id="ID_PARTICIPANTE_CONYUGE" name="ID_PARTICIPANTE_CONYUGE">
<span id="ID_PARTICIPANTE_CONYUGEError" class="text-danger error-messages"></spam>


<!-- Incluir el popup de búsqueda -->
@include('participantes.search_popup')

                    </div>
                    <div class="col-sm-4 invoice-col">
                         <!-- Botón para abrir el popup de búsqueda -->
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#searchModal" style="position: absolute; right: 10px; top: 73%; transform: translateY(-50%);">
<i class="fa fa-search"></i>
</button>

<!-- Textbox para mostrar el nombre completo -->

<label for="nombreCompleto">Nombre del Hermano</label>
<input type="text" class="form-control" id="ID_PARTICIPANTE_HERMANO" name="ID_PARTICIPANTE_HERMANO">
<span id="ID_PARTICIPANTE_HERMANOError" class="text-danger error-messages"></spam>


<!-- Incluir el popup de búsqueda -->
@include('participantes.search_popup')
                    </div>
                </div>
              </div>
              <div class="tab-pane" id="facturacion">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Factura a nombre de:</label>
                        <select class="form-control" id="ID_NOMBREFACTURA" name="ID_NOMBREFACTURA">
                            <option  value="0">-Escoja una opcion-</option>
                            <option  value="1">Particular</option>
                            <option  value="2">Estudiante EPN</option>
                            <option  value="3">Representante</option>
                        </select>
                        <span id="ID_NOMBREFACTURAError" class="text-danger error-messages"></spam>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Beneficiario Factura</label>
                        <input type="text" class="form-control" id="ID_BENFACTURA" name="ID_BENFACTURA">
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Empresa Unipersonal</label>
                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="IND_EMP_UNIPERSONAL" name="IND_EMP_UNIPERSONAL">

                            <label class="custom-control-label" for="IND_EMP_UNIPERSONAL"">Si</label>
                        </div>
                    </div>
                </div>

                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Empresa:</label>
                        <input type="text" class="form-control" id="IDEMPRESA" name="IDEMPRESA">
                        <span id="IDEMPRESAError" class="text-danger error-messages"></spam>
                    </div>
                    
                    <div class="col-sm-4 invoice-col">
                    
                    </div>
                    <div class="col-sm-4 invoice-col">
                    
                    </div>
                </div>
              </div>
              <div class="tab-pane" id="autorizacion">
                <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Autorizado tercera matrícula</label>

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="DESBLOQUEO_TERCERA_MATRICULA" named="DESBLOQUEO_TERCERA_MATRICULA">

                            <label class="custom-control-label" for="DESBLOQUEO_TERCERA_MATRICULA">Si</label>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Autorizado tomar condición</label>

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="DESBLOQUEO_CONDICION" name="DESBLOQUEO_CONDICION">

                            <label class="custom-control-label" for="DESBLOQUEO_CONDICION">Si</label>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Autorizado tomar 2 niveles </label>

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="DESBLOQUEO_DOS_NIVELES" name="DESBLOQUEO_DOS_NIVELES">

                            <label class="custom-control-label" for="DESBLOQUEO_DOS_NIVELES">Si</label>
                        </div>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Autorizado reagendar examen</label>

                        <div class="custom-control custom-switch">

                            <input type="checkbox" class="custom-control-input" id="DESBLOQUEO_REAGENDAMIENTO_EXAMEN" name="DESBLOQUEO_REAGENDAMIENTO_EXAMEN">

                            <label class="custom-control-label" for="DESBLOQUEO_REAGENDAMIENTO_EXAMEN">Si</label>
                        </div>
                    </div>

                </div>
              </div>

            </div>

          </div>
        </div>

        <div  style="padding:15px;float:right">
            <!--<button type="submit" class="btn btn-primary">Guardar Todo</button>-->
            <button type="submit" id="cancelar"class="btn btn-danger" style="margin-left:10px" onclick="showHide('tabsContainer')">Cancelar</button>
            <button type="button" class="btn btn-primary" id="saveBtn"> Guardar todo</button>
        </div>
        </form>
</div>
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush

@section('css')

<style>
.tab-error {
    background-color: #ffebee !important; /* Rojo claro */
}
.tab-normal {
    background-color: #fff !important; /* Blanco normal */
}
</style>
@stop
@section('js')
<!--Validación de cedula no se encuentre vacia-->
<script>
    $(document).ready(function() {
        $('#idForm').on('submit', function(event) {
            event.preventDefault();
            var identification = $('#identification').val();
            if (identification) {
                $('#tabsContainer').show();
            } else {
                $('#identification').addClass('is-invalid');
            }
        });

            $('#saveBtn').on('click', function(e) {
            e.preventDefault(); // Prevenir comportamiento por defecto
            
            // Resetear mensajes de error previos
            $('.error-messages').html('');
            $('.nav-link').parent().removeClass('tab-error').addClass('tab-normal');
            
            // Deshabilitar botón y cambiar texto
            $(this).html('Guardando...');
            $(this).attr('disabled', true);

            // Obtener el formulario y sus datos
            var formData = new FormData($('#ajaxFormDatos')[0]);

            // Configurar CSRF token
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // Realizar la petición AJAX
            $.ajax({
                url: '{{ route("participantes.store") }}',
                method: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(response) {
                    // Habilitar botón y restaurar texto
                    $('#saveBtn').attr('disabled', false);
                    $('#saveBtn').html('Guardar participante');

                    // Limpiar formulario si fue exitoso
                    if (response.success) {
                        // Limpiar todos los campos
                        limpiarFormulario();
                        swal("¡Éxito!", response.success, "success");
                    }
                    
                    if (response.warning) {
                        swal("Atención", response.warning, "warning");
                    }
                },
                error: function(error) {
                    // Habilitar botón y restaurar texto
                    $('#saveBtn').attr('disabled', false);
                    $('#saveBtn').html('Guardar participante');

                    if (error.responseJSON && error.responseJSON.errors) {
                        manejarErrores(error.responseJSON.errors);
                    }
                }
            });
        });    



    });    

////* agregado RP

    $('#ID_PAIS').change(function() {
        var paisId = $(this).val();
        if(paisId) {
            $.ajax({
                url: '/get-provincias',
                type: 'POST',
                data: {
                    pais_id: paisId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#provincia').prop('disabled', false);
                    $('#provincia').empty();
                    $('#provincia').append('<option value="">Seleccione una provincia</option>');
                    $.each(data, function(key, value) {
                        $('#provincia').append('<option value="' + value.ID + '">' + value.PROVINCIA_NOMBRE + '</option>');
                    });
                    $('#ciudad').prop('disabled', true);
                    $('#ciudad').empty();
                    $('#ciudad').append('<option value="">Seleccione una ciudad</option>');
                }
            });
        } else {
            $('#provincia').prop('disabled', true);
            $('#ciudad').prop('disabled', true);
        }
    });

    $('#provincia').change(function() {
        var provinciaId = $(this).val();
        if(provinciaId) {
            $.ajax({
                url: '/get-ciudades',
                type: 'POST',
                data: {
                    provincia_id: provinciaId,
                    _token: '{{ csrf_token() }}'
                },
                success: function(data) {
                    $('#ciudad').prop('disabled', false);
                    $('#ciudad').empty();
                    $('#ciudad').append('<option value="">Seleccione una ciudad</option>');
                    $.each(data, function(key, value) {
                        $('#ciudad').append('<option value="' + value.id + '">' + value.CIUDAD_NOMBRE + '</option>');
                    });
                }
            });
        } else {
            $('#ciudad').prop('disabled', true);
        }
    });



// Función para manejar la visibilidad y validación de los campos
        function toggleDiscapacidadFields() {
            
                const tieneDiscapacidad = $('#discapacidad').is(':checked');
                const carnetField = $('#CARNET_NUM_CONADIS');
                const porcentajeField = $('#IND_DISCAPACIDAD');

                // Habilitar/deshabilitar campos
                carnetField.prop('disabled', !tieneDiscapacidad);
                porcentajeField.prop('disabled', !tieneDiscapacidad);

                // Limpiar campos si se desmarca el checkbox
                if (!tieneDiscapacidad) {
                    carnetField.val('');
                    porcentajeField.val('');
                    // Remover clases de validación si existen
                    carnetField.removeClass('is-invalid');
                    porcentajeField.removeClass('is-invalid');
                }
            }

            // Ejecutar al cargar la página
            toggleDiscapacidadFields();

            // Ejecutar cuando cambie el checkbox
            $('#discapacidad').change(toggleDiscapacidadFields);


            function toggleNumSticker() {
                const stickerValue = $('#STICKER').val();
                const numStickerField = $('#NUM_STICKER');
                
                // Habilitar si es "1" (Sí) y deshabilitar si es "0" (No)
                numStickerField.prop('disabled', stickerValue !== '1');
                
                // Limpiar el campo si se deshabilita
                if (stickerValue !== '1') {
                    numStickerField.val('');
                    numStickerField.removeClass('is-invalid');
                }
            }

            // Ejecutar al cargar la página
            toggleNumSticker();

            // Ejecutar cuando cambie el select
            $('#STICKER').change(toggleNumSticker);

        

        

</script>
<script>
    var element = document.getElementById("#tabsContainer");
    if(element != null){
        element.style.display = "none";
    }
    function showHide(elementId) {
        var element = document.getElementById(elementId);
        if (element != null) {
            if(element.style.display != "none"){
                element.style.display = "none";
            }else{
                element.style.display = "block";
            }
        }
    }
</script>
<!--Formato de calendario-->
<script type="text/javascript">
    $(function () {
        $('#datetimepicker4').datetimepicker({
            format: 'L'
        });
    });
</script>
<script>
    document.getElementById('pasar-texto').addEventListener('click', function() {
        let textoOrigen = document.getElementById('identification').value;
        document.getElementById('identificacion').value = textoOrigen;
    });
    </script>

    /*agregados RP*/


<script>
document.addEventListener('DOMContentLoaded', function() {
    const direccionInput = document.getElementById('direccion2');
    const callePrincipalInput = document.getElementById('CALLE_PRINCIPAL');
    const numeroDomicilioInput = document.getElementById('NUMERO_DOMICILIO');
    const calleTransversalInput = document.getElementById('CALLE_TRANSVERSAL');

    function actualizarDireccion() {
        const callePrincipal = callePrincipalInput.value.trim();
        const numeroDomicilio = numeroDomicilioInput.value.trim();
        const calleTransversal = calleTransversalInput.value.trim();

        let direccionCompleta = callePrincipal;
        
        if (numeroDomicilio) {
            direccionCompleta += (direccionCompleta ? ' ' : '') + numeroDomicilio;
        }
        
        if (calleTransversal) {
            direccionCompleta += (direccionCompleta ? ' y ' : '') + calleTransversal;
        }

        direccionInput.value = direccionCompleta;
    }

    direccionInput.addEventListener('focus', actualizarDireccion);
});
</script>


<script>
 
 function manejarErrores(errors) {
    // Objeto para mapear campos a sus respectivos tabs
    const tabMapping = {
        // Tab Información Personal
        'idtipoidentificacion': 'informacion',
        'NOMBRE_COMPLETO': 'informacion',
        'TITULOP': 'informacion',
        'FECHA_NAC': 'informacion',
        // ... resto del mapping ...
    };

    // Set para almacenar tabs con errores
    const tabsWithErrors = new Set();

    // Mostrar errores y marcar tabs
    Object.keys(errors).forEach(field => {
        $(`#${field}Error`).html(errors[field][0]); // Mostrar primer mensaje de error
        
        if (tabMapping[field]) {
            tabsWithErrors.add(tabMapping[field]);
        }
    });

    // Marcar tabs con errores
    tabsWithErrors.forEach(tabId => {
        $(`a[href="#${tabId}"]`).parent().removeClass('tab-normal').addClass('tab-error');
    });

    // Mostrar primer tab con errores
    const firstTabWithError = tabsWithErrors.values().next().value;
    if (firstTabWithError) {
        $(`a[href="#${firstTabWithError}"]`).tab('show');
    }
}

// Función para limpiar el formulario
function limpiarFormulario() {
    // Limpiar campos de información personal
    $('#idtipoidentificacion').val('0').trigger('change');
    $('#NOMBRE_COMPLETO').val('');
    $('#TITULOP').val('');
    $('#FECHA_NAC').val('');
    // ... resto de campos a limpiar ...

    // Restaurar todos los tabs a estado normal
    $('.nav-link').parent().removeClass('tab-error').addClass('tab-normal');
    
    // Limpiar todos los mensajes de error
    $('.error-messages').html('');
}

// Manejar cambios en los campos para limpiar errores
$(document).on('change keyup', 'input, select', function() {
    const fieldName = $(this).attr('id');
    const errorSpan = $(`#${fieldName}Error`);
    
    if (errorSpan.html()) {
        errorSpan.html('');
        
        // Verificar si el tab actual ya no tiene errores
        const tabId = $(this).closest('.tab-pane').attr('id');
        const tabPane = $(`#${tabId}`);
        const hasErrors = tabPane.find('.error-messages').filter(function() {
            return $(this).html() !== '';
        }).length > 0;
        
        if (!hasErrors) {
            $(`a[href="#${tabId}"]`).parent().removeClass('tab-error').addClass('tab-normal');
        }
    }
});
          

</script>


    /* fin agregados RP*/
@stop
