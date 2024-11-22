
@extends('adminlte::page')
@section('title', 'Administración de Participantes')
@section('content')
    <div class="container" style="max-width:100%">

        <div class="card">
            <div class="card-header"><h4>Administración de Personas "rama estilos"</h4></div>
            <div class="card-body">

                {{ $dataTable->table()}}
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
<div class="card container" id="tabsContainer" style="display: none; max-width:100%;font-size:14px">



    <div class="card-body" style="padding-bottom: 10px"><h4>{{ isset($participante) ? 'Editar Participante' : 'Crear Participante' }}</h4>
    </div>
    <div class="card card-primary card-tabs">
          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab myTab" role="tablist" >
              <li class="nav-item"><a class="menu nav-link active" href="#informacion" data-toggle="tab">Información Personal</a></li>
              <li class="nav-item"><a class="menu nav-link" href="#dato_ubicacion" data-toggle="tab">Datos de Ubicación</a></li>
              <li class="nav-item"><a class="menu nav-link" href="#tipo_cliente" data-toggle="tab">Tipo de Cliente</a></li>
              <li class="nav-item"><a class="menu nav-link" href="#dato_familiar" data-toggle="tab">Datos Familiares</a></li>
              <li class="nav-item"><a class="menu nav-link" href="#facturacion" data-toggle="tab">Facturación</a></li>
              <li class="nav-item"><a class="menu nav-link" href="#autorizacion" data-toggle="tab">Autorizaciones</a></li>
            </ul>
          </div><!-- /.card-header -->
    <div class="card-body">
    <form id="ajaxFormDatos">
            <div class="tab-content" id="myTabContent">
              <div class="active tab-pane" id="informacion">

                <form action="{{ isset($participante) ? route('participantes.update', $participante->IDPARTICIPANTE) : route('participantes.store') }}" method="POST">
                    @csrf
                    @if (isset($participante))
                     @method('PUT')
                     @endif

            <div class="row invoice-info">
                <!-- Campos del formulario de registro -->
                    <div class="col-sm-4 invoice-col">
                        <label for="name">Idparticipante</label>
                        <input type="text" class="form-control" id="idparticipante" required value="0" disabled>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Tipo</label>
                        <select class="form-control" id="IDTIPOIDENTIFICACION" name="IDTIPOIDENTIFICACION">
                            <option value="0">Escoja el tipo de identificación</option>
                            @foreach($iden as $id => $nombre)
                            <option value="{{ $id }}" {{ old('IDTIPOIDENTIFICACION') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                      </select>
                      <span id="idtipoidentificacionError" class="text-danger error-messages"></span>

                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Identificación</label>
                        <input type="text" class="form-control" id="IDENTIFICACION" name="IDENTIFICACION" required>
                        <span id="IDENTIFICACIONError" class="text-danger error-messages"></span>
                    </div>

            </div>
            <div class="row invoice-info">

                    <div class="col-sm-4 invoice-col" >
                        <label for="text">Apellidos y Nombres</label>
                        <input type="text" class="form-control" id="NOMBRE_COMPLETO" name="NOMBRE_COMPLETO" >
                        <span id="NOMBRE_COMPLETOError" class="text-danger error-messages"></span>

                    </div>

                    <div class="col-sm-4 invoice-col">
                        <label for="text">Título</label>
                        <input type="text" class="form-control" id="TITULOP" name="TITULOP" required>
                        <span id="TITULOPError" class="text-danger error-messages"></span>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Fecha Nacimiento</label>
                        <div class="input-group mb-4">
                            <i class="bi bi-calendar-date input-group-text"></i>
                            <input type="text" class="datepicker_input form-control" id="FECHA_NAC" name="FECHA_NAC" >
                          </div>

                        <!--<div class="input-group date" id="datetimepicker4" data-target-input="nearest">
                        <input type="text" class="form-control datetimepicker-input" data-target="#datetimepicker4" id="FECHA_NAC" name="FECHA_NAC"/>
                        <div class="input-group-append" data-target="#datetimepicker4" data-toggle="datetimepicker">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                        </div>-->
                        <span id="FECHA_NACError" class="text-danger error-messages"></span>
                    </div>
            </div>

            <div class="row invoice-info">
                    <div class="col-sm-4 invoice-col">
                        <label for="text">Edad</label>
                        <input type="text" class="form-control" id="EDAD" nombre="EDAD" >
                        <span id="EDADError" class="text-danger error-messages"></span>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="email">Correo Electrónico</label>
                        <div class="input-group-prepend">
                        <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                        <input type="email" class="form-control" id="EMAIL" name="EMAIL" >
                        <span id="EMAILError" class="text-danger error-messages"></span>
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
                        <span id="ID_DEFETError" class="text-danger error-messages"></span>
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
                        <span id="ID_GENError" class="text-danger error-messages"></span>
                </div>


                <div class="col-sm-4 invoice-col">
                    <label for="text">Nacionalidad</label>
                    <select class="selectpicker form-control" id="ID_NACIONALIDAD" name="ID_NACIONALIDAD" data-live-search="true" required>
                        <option value="0">Escoja la nacionalidad</option>
                            @foreach($nacionalidad as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_PAIS') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_NACIONALIDADError" class="text-danger error-messages"></span>
                </div>
                <div class="col-sm-4 invoice-col">
                    <label for="text">Estado Migratorio</label>
                    <select class="form-control" id="ID_MOVILH" name="ID_MOVILH" >
                        <option value="0">Escoja el estado migratorio</option>
                            @foreach($movilidad as $id => $nombre)
                            <option value="{{ $id }}" {{ old('ID_MOVILH') == $id ? 'selected' : '' }}>{{ $nombre }}</option>
                        @endforeach
                        </select>
                        <span id="ID_MOVILHError" class="text-danger error-messages"></span>
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
                        <span id="CARNET_NUM_CONADISError" class="text-danger error-messages"></span>
                    </div>
                    <div class="col-sm-4 invoice-col">
                        <label for="text">%Discapacidad</label>
                        <input type="text" class="form-control" id="IND_DISCAPACIDAD" name="IND_DISCAPACIDAD" value="0" disabled>
                        <div class="invalid-feedback"></div>
                        <span id="IND_DISCAPACIDADError" class="text-danger error-messages"></span>
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
                                <span id="ID_PAISError" class="text-danger error-messages"></span>
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
                                <span id="CALLE_PRINCIPALError" class="text-danger error-messages"></span>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Número</label>
                                <input class="form-control" type="text" name="NUMERO_DOMICILIO" id="NUMERO_DOMICILIO"  value="{{ old('NUMERO_DOMICILIO') }}" required>
                                <span id="NUMERO_DOMICILIOError" class="text-danger error-messages"></span>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Transversal</label>
                                <input class="form-control" type="text" name="CALLE_TRANSVERSAL" id="CALLE_TRANSVERSAL"  value="{{ old('CALLE_TRANSVERSAL') }}" required>
                                <span id="CALLE_TRANSVERSALError" class="text-danger error-messages"></span>
                            </div>


                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Sector</label>
                                <input class="form-control" type="text" name="REFERENCIA" id="REFERENCIA"  value="{{ old('REFERENCIA') }}" required>
                                <span id="REFERENCIAError" class="text-danger error-messages"></span>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Dirección</label>
                                <input type="text" class="form-control" id="DIRECCION" name="DIRECCION" readonly required>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Telf. Casa</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input class="form-control" type="text" name="TELEFONO_CASA" id="TELEFONO_CASA"  value="{{ old('TELEFONO_CASA') }}" required>
                                    <span id="TELEFONO_CASAError" class="text-danger error-messages"></span>
                                </div>

                            </div>
                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Telf. Oficina</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input class="form-control" type="text" name="TELEFONO_OFICNA" id="TELEFONO_OFICNA"  value="{{ old('TELEFONO_OFICNA') }}">
                                    <span id="TELEFONO_OFICNAError" class="text-danger error-messages"></span>
                                </div>

                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Extensión</label>
                                <input class="form-control" type="text" name="EXT_TELOFICINA" id="EXT_TELOFICINA"  value="{{ old('EXT_TELOFICINA') }}">
                                <span id="EXT_TELOFICINAError" class="text-danger error-messages"></span>
                            </div>
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Celular</label>
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                    <input type="text" class="form-control" name="TELEFONO_CELULAR" id="TELEFONO_CELULAR"  value="{{ old('TELEFONO_CELULAR') }}" required>
                                    <span id="TELEFONO_CELULARError" class="text-danger error-messages"></span>
                                </div>

                            </div>
                        </div>
                        <hr>
                        <fieldset>
                            <legend style="font-size: 12px; font-weight: bold;">IINFORMACIÓN DEL AUTOMOTOR DEL CLIENTE </legend>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Placas</label>
                                    <div class="input-group-prepend">
                                        <input class="form-control" type="text" name="PLACA_AUTO" id="PLACA_AUTO"  value="{{ old('PLACA_AUTO') }}">
                                        <span id="PLACA_AUTOError" class="text-danger error-messages"></span>
                                    </div>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Color</label>
                                    <input class="form-control" type="text" name="COLOR_AUTO" id="COLOR_AUTO"  value="{{ old('COLOR_AUTO') }}">
                                    <span id="COLOR_AUTOError" class="text-danger error-messages"></span>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Marca</label>
                                    <div class="input-group-prepend">
                                        <input type="text" class="form-control" name="MARCA_AUTO" id="MARCA_AUTO"  value="{{ old('MARCA_AUTO') }}" required>
                                        <span id="MARCA_AUTOError" class="text-danger error-messages"></span>
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
                                    <span id="NUM_STICKERError" class="text-danger error-messages"></span>
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
                        <span id="TIPOCLIENTEError" class="text-danger error-messages"></span>
                    </div>


                    <div class="col-sm-4 invoice-col">
                        <label for="text">Facultad</label>
                        <select class="form-control" id="FACULTAD" name="FACULTAD">
                            <option value="0">Escoja la facultad</option>
                            @foreach($facultades as $id => $facultad)
                             <option value="{{ $id }}" {{ old('IDFACULTAD') == $id ? 'selected' : '' }}>{{ $facultad }}</option>
                            @endforeach
                        </select>
                        <span id="FACULTADError" class="text-danger error-messages"></span>
                    </div>
                    <div class="col-sm-4 invoice-col">
                      <label for="text">Carrera</label>
                        <input type="text" class="form-control" name="CARRERA_EPN" id="CARRERA_EPN"  value="{{ old('CARRERA_EPN') }}" readonly>
                        <span id="CARRERA_EPNError" class="text-danger error-messages"></span>
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
<button type="button" class="btn btn-link" data-toggle="modal" data-target="#searchModal" style="position: absolute; right: 10px; top: 73%; transform: translateY(-50%);">
        <i class="fa fa-search"></i>
    </button>

<!-- Textbox para mostrar el nombre completo -->

 <label for="nombreCompleto">Nombre del Representante</label>
 <input type="text" class="form-control" id="IDREP" name="IDREP">
 <span id="IDREPError" class="text-danger error-messages"></span>



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
<span id="ID_PARTICIPANTE_CONYUGEError" class="text-danger error-messages"></span>


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
<span id="ID_PARTICIPANTE_HERMANOError" class="text-danger error-messages"></span>


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
                        <span id="ID_NOMBREFACTURAError" class="text-danger error-messages"></span>
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
                        <span id="IDEMPRESAError" class="text-danger error-messages"></span>
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

        </div>
    </div>
    <!--Test--->
    @if(session('editParticipante'))
    @php
        $participante = session('editParticipante');
        $pais = session('pais');
        $movilidad = session('movilidad');
        $nacionalidad = session('nacionalidad');
        $definicion = session('definicion');
        $iden = session('iden');
        $tipo = session('tipo');
        $convenio = session('convenio');
        $genero = session('genero');
        $busqueda = session('busqueda');
    @endphp

    <div class="modal fade show d-block" tabindex="-1" role="dialog" style="display: block; background: rgba(0,0,0,0.5);">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Participante</h5>
                    <a href="{{ route('participantes.index') }}" class="close" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </a>
                </div>
                <div class="card card-primary card-tabs" >
                    <div class="card-header p-0 pt-1">
                      <ul class="nav nav-tabs" id="custom-tabs-one-tab myTab2" role="tablist" >
                        <li class="nav-item"><a class="menu nav-link active" href="#informacion2" data-toggle="tab">Información Personal</a></li>
                        <li class="nav-item"><a class="menu nav-link" href="#dato_ubicacion2" data-toggle="tab">Datos de Ubicación</a></li>
                        <li class="nav-item"><a class="menu nav-link" href="#tipo_cliente2" data-toggle="tab">Tipo de Cliente</a></li>
                        <li class="nav-item"><a class="menu nav-link" href="#dato_familiar2" data-toggle="tab">Datos Familiares</a></li>
                        <li class="nav-item"><a class="menu nav-link" href="#facturacion2" data-toggle="tab">Facturación</a></li>
                        <li class="nav-item"><a class="menu nav-link" href="#autorizacion2" data-toggle="tab">Autorizaciones</a></li>
                      </ul>
                    </div>
                <div class="modal-body">
                    <div class="tab-content" id="myTabContent2">
                        <div class="active tab-pane" id="informacion2">


                    <form action="{{ route('participantes.update', $participante->IDPARTICIPANTE) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- Campos del formulario de registro -->
                                <div class="col-sm-4 invoice-col">
                                    <label for="name">Idparticipante</label>
                                    <input type="text" class="form-control" value="{{ $participante->IDPARTICIPANTE }}"
                                    id="idparticipante2" required value="0" disabled>
                                    <label for="text">Identificación</label>
                                    <input type="text" class="form-control" value="{{ $participante->IDENTIFICACION }}" id="identificacion2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Tipo</label>
                                    <select class="form-control" id="idtipoidentificacion" name="idtipoidentificacion">
                                      @foreach($iden as $p)
                              <option value="{{ $p->IDTIPOIDENTIFICACION }}" {{ $p->IDTIPOIDENTIFICACION == $participante->IDTIPOIDENTIFICACION ? 'selected' : '' }}>
                                  {{ $p->NOMBRETIPO }}
                              </option>
                          @endforeach
                                  </select>
                                  <label for="text">Apellidos y Nombres</label>
                                    <input type="text" class="form-control" value="{{ $participante->NOMBRE_COMPLETO }}" id="apellido_nombre2" required>
                                </div>

                                <div class="col-sm-4 invoice-col">


                                    <div class="col-md-4">
                                      <div id="container-photo" style="display: none">
                                          <div style="padding-bottom: 10px">
                                              <!-- Imagen del usuario -->

                                              <img id="user-photo" src="{{ asset('fotos/default-avatar.png') }}" alt="Foto del Usuario" style="display:none;">


                                          </div>
                                      </div>

                                      <div class="mt-3" style="padding-bottom: 5px">
                                          <!-- Botón para mostrar la imagen -->
                                          <button id="toggle-photo-btn" class="btn btn-primary">Ver Foto</button>
                                      </div>
                                  </div>


                                  </div>



                        </div>

                        <div class="row invoice-info">

                                <div class="col-sm-4 invoice-col" >
                                  <label for="text">Título</label>
                                  <input type="text" class="form-control" id="titulo2" value="{{ $participante->TITULOP }}" required>
                                </div>

                                <div class="col-sm-4 invoice-col">
                                  <label for="text">Fecha Nacimiento</label>
                                  <div class="input-group mb-4">
                                    <i class="bi bi-calendar-date input-group-text"></i>
                                    <input type="text" value="{{ $participante->FECHA_NAC}}" class="datepicker_input form-control" data-target="#datetimepicker4"/>
                                  </div>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                  <label for="text">Auto Definición Étnica</label>
                                    <select class="form-control" id="auto_definicion_etnica2" name="auto_definicion_etnica2">
                                      @foreach($definicion as $p)
                              <option value="{{ $p->ID_DEFET }}" {{ $p->ID_DEFET == $participante->ID_DEFET ? 'selected' : '' }}>
                                  {{ $p->DESC_DEFET }}
                              </option>
                          @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Edad</label>
                                    <input type="text" class="form-control" value="{{ $participante->EDAD }}" id="edad2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="email">Correo Electrónico</label>
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                    <input type="email" class="form-control" value="{{ $participante->EMAIL }}"id="email2" required>
                                    </div>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                  <label for="text">Estado Migratorio</label>

                                    <select class="form-control" id="movilidad" name="movilidad">
                                      @foreach($movilidad as $p)
                              <option value="{{ $p->ID_MOVILH }}" {{ $p->ID_MOVILH == $participante->ID_MOVILH ? 'selected' : '' }}>
                                  {{ $p->DESC_MOVILH }}
                              </option>
                          @endforeach
                                  </select>
                                </div>

                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">Género</label>
                               <select class="form-control" id="genero" name="genero">
                               @foreach($genero as $p)
                              <option value="{{ $p->IDGEN }}" {{ $p->IDGEN == $participante->ID_GEN ? 'selected' : '' }}>
                                  {{ $p->DES_GEN }}
                              </option>
                          @endforeach
                               </select>
                            </div>



                            <div class="col-sm-4 invoice-col">
                                <label for="text">Nacionalidad</label>
                                    <select class="form-control" id="nacionalidad" name="nacionalidad">
                                      @foreach($nacionalidad as $p)
                              <option value="{{ $p->ID_PAIS }}" {{ $p->ID_PAIS == $participante->ID_NACIONALIDAD ? 'selected' : '' }}>
                                  {{ $p->NACIONALIDAD }}
                              </option>
                          @endforeach
                                  </select>
                            </div>
                            <div class="col-sm-4 invoice-col">
                              <label for="text">%Discapacidad</label>
                                    <input type="text" class="form-control" id="porcentaje_discapacidad2" value="{{$participante->IND_DISCAPACIDAD}}" >
                            </div>

                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">¿Alguna discapacidad?</label>

                                <div class="custom-control custom-switch">

                                    <input type="checkbox" class="custom-control-input" id="customSwitch2">

                                    <label class="custom-control-label" for="customSwitch2">Si</label>
                                </div>
                            </div>


                                <div class="col-sm-4 invoice-col">
                                    <label for="text">#Carnet</label>
                                    <input type="text" class="form-control" id="carnet2" value="{{$participante->CARNET_NUM_CONADIS}}" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                  <label for="text">Observaciones</label>
                                    <input type="text" class="form-control" id="observacion2">
                                </div>

                        </div>
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <label for="text">¿Acepta la política de Datos Personales?</label>

                                <div class="custom-control custom-switch">

                                    <input type="checkbox" class="custom-control-input" id="customSwitch3">

                                    <label class="custom-control-label" for="customSwitch3">Si</label>
                                </div>
                            </div>
                        <div class="col-sm-4 invoice-col">



                        </div>
                        </div>




                          </div>

                          <div class="tab-pane" id="dato_ubicacion2">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">País</label>
                                    <select class="form-control" id="PAIS" name="PAIS">
                                      @foreach($pais as $p)
                              <option value="{{ $p->ID_PAIS }}" {{ $p->ID_PAIS == $participante->ID_PAIS ? 'selected' : '' }}>
                                  {{ $p->NOMBRE_PAIS }}
                              </option>
                          @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Provincia</label>
                                    <input type="text" class="form-control" value="{{ $participante->PROVINCIA }}" id="provincia2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Ciudad</label>
                                    <input type="text" class="form-control" id="ciudad2" value="{{ $participante->CIUDAD }}" required>
                                </div>

                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">C.Principal</label>
                                    <input type="text" class="form-control" value="{{ $participante->CALLE_PRINCIPAL }}" id="c_principal2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Número</label>
                                    <input type="text" class="form-control" value="{{ $participante->NUMERO_DOMICILIO }}" id="numero2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Transversal</label>
                                    <input type="text" class="form-control" value="{{ $participante->CALLE_TRANSVERSAL }}" id="transversal2" required>
                                </div>


                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Sector</label>
                                    <input type="text" class="form-control" value="{{ $participante->REFERENCIA }}" id="sector2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Dirección</label>
                                    <input type="text" class="form-control" value="{{ $participante->DIRECCION }}" id="DIRECCION" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Telf. Casa</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>

                                        <input type="text" class="form-control" value="{{ $participante->TELEFONO_CASA }}" id="telf_casa2">
                                    </div>

                                </div>
                            </div>
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Telf. Oficina</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>

                                        <input type="text" class="form-control" value="{{ $participante->TELEFONO_OFICNA }}" id="telf_oficina2">
                                    </div>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Extensión</label>
                                    <input type="text" class="form-control" value="{{ $participante->EXT_TELOFICINA }}" id="extension2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Celular</label>
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-phone"></i></span>

                                        <input type="text" class="form-control" value="{{ $participante->TELEFONO_CELULAR }}" id="celular2">
                                    </div>

                                </div>
                            </div>

                          </div>


                          <div class="tab-pane" id="tipo_cliente2">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Tipo de Cliente</label>
                                    <select class="form-control" id="tipo" name="id_tipo">
                                      @foreach($tipo as $p)
                              <option value="{{ $p->IDTIPOCLIENTE }}" {{ $p->IDTIPOCLIENTE == $participante->TIPOCLIENTE ? 'selected' : '' }}>
                                  {{ $p->NOMBRE }}
                              </option>
                          @endforeach
                                  </select>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Entrada</label>
                                    <input type="text" class="form-control" value="{{ $participante->HORA_ENTRADA }}" id="entrada2" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Salida</label>
                                    <input type="text" class="form-control" value="{{ $participante->HORA_SALIDA }}" id="salida2" required>
                                </div>
                            </div>
                                <div class="row invoice-info">
                                    <div class="col-sm-4 invoice-col">
                                        <label for="text">Entrada Sab.</label>
                                        <input type="text" class="form-control" value="{{ $participante->HORA_ENTRADA_SAB }}" id="entrada_sab2" required>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <label for="text">Sale Sab.</label>
                                        <input type="text" class="form-control" value="{{ $participante->HORA_SALIDA_SAB }}" id="sale_sab2" required>
                                    </div>
                                    <div class="col-sm-4 invoice-col">
                                        <label for="text">Convenio, Acuerdo asociado al Cliente</label>
                                        <select class="form-control" id="cliente" name="cliente">
                                          @foreach($convenio as $p)
                              <option value="{{ $p->ID_CONVENIOS_EXTERNOS }}" {{ $p->ID_CONVENIOS_EXTERNOS == $participante->ID_CONVENIO_EXTERNO ? 'selected' : '' }}>
                                  {{ $p->INSTITUCION }}
                              </option>
                          @endforeach
                                      </select>
                                    </div>
                                </div>

                          </div>

                          <div class="tab-pane" id="dato_familiar2">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">

                                    <label for="text">Representante Madre/Padre/Estudiante</label>
                                    <input type="text" class="form-control" value="{{ $participante->nombre_representante }}" id="representantet" required>
                                </br>
                                    <select class="selectpicker form-control" name="representante" id="representantes" data-live-search="true">
                                    <option>Escoja al representante</option>
                                      @foreach($busqueda as $p)
                                      <option value="{{ $p->IDPARTICIPANTE }}">
                                          {{$p->IDENTIFICACION}} {{ $p->NOMBRE_COMPLETO }}
                                      </option>
                                  @endforeach
                                      </select>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Conyuge</label>
                                    <input type="text" class="form-control" value="{{ $participante->nombre_conyuge }}" id="conyuge">

                                  </br>
                                    <select class="selectpicker form-control" name="conyuge" id="conyuge" data-live-search="true">
                                      <option value="selected">Escoja al conyuge</option>
                                      @foreach($busqueda as $p)
                                      <option value="{{ $p->IDPARTICIPANTE }}">
                                          {{$p->IDENTIFICACION}} {{ $p->NOMBRE_COMPLETO }}
                                      </option>
                                  @endforeach
                                      </select>

                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Hermano</label>
                                    <input type="text" class="form-control" value="{{ $participante->nombre_hermano }}" id="hermano">

                                </br>
                                    <select class="selectpicker form-control" name="hermano" id="hermano" data-live-search="true">
                                      <option value="selected">Escoja al hermano</option>
                                        @foreach($busqueda as $p)
                                      <option value="{{ $p->IDPARTICIPANTE }}">
                                          {{$p->IDENTIFICACION}} {{ $p->NOMBRE_COMPLETO }}
                                      </option>
                                  @endforeach
                                      </select>
                                </div>
                            </div>

                          </div>
                          <div class="tab-pane" id="facturacion2">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Factura a nombre de:</label>
                                    <select class="form-control" id="factura" required>
                                        <option>Particular</option>
                                        <option>Estudiante EPN</option>
                                        <option>Representante</option>
                                    </select>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Beneficiario Factura</label>
                                    <input type="text" class="form-control" id="beneficiario" required>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Empresa Unipersonal</label>
                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="customSwitch7">

                                        <label class="custom-control-label" for="customSwitch7">Si</label>
                                    </div>
                                </div>
                            </div>

                          </div>
                          <div class="tab-pane" id="autorizacion2">
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Autorizado tercera matrícula</label>

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="customSwitch3">

                                        <label class="custom-control-label" for="customSwitch3">Si</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Autorizado tomar condición</label>

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="customSwitch4">

                                        <label class="custom-control-label" for="customSwitch4">Si</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Autorizado tomar 2 niveles </label>

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="customSwitch5">

                                        <label class="custom-control-label" for="customSwitch5">Si</label>
                                    </div>
                                </div>
                                <div class="col-sm-4 invoice-col">
                                    <label for="text">Autorizado reagendar examen</label>

                                    <div class="custom-control custom-switch">

                                        <input type="checkbox" class="custom-control-input" id="customSwitch6">

                                        <label class="custom-control-label" for="customSwitch6">Si</label>
                                    </div>
                                </div>

                            </div>

                          </div>

                        </div>

                      </div>
                      <div class="row" style="padding:15px;float:right">
                        <button type="submit" class="btn btn-primary">Guardar Todo</button>
                        </div>
                    </div>

    </div>

                    </form>
                </div>
            </div>
        </div>

    </div>
@endif
<!--fin Test--->
@endsection

@section('css')
<style>
    .error-count {
        margin-left: 3px;
        font-weight: bold;
    }
    
    .tab-error {
        background-color: red !important; /* Rojo claro */
    }
    
    .tab-normal {
        background-color: #007bff !important; /* Azul normal */
    }

     /* Estilo para inputs con error */
     .error-input {
        border: 1px solid #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }

    /* Estilo para el mensaje de error */
    .text-danger {
        color: #dc3545;
        font-size: 0.875em;
        margin-top: 0.25rem;
    }

    /* Estilo para el ícono de error (opcional) */
    .error-input:focus {
        border-color: #dc3545 !important;
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
    }
</style>
@stop

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        // Utilizar event delegation para capturar clics en el botón
        document.body.addEventListener('click', function (e) {
            if (e.target && e.target.id === 'btnCrearParticipante') {
                const formCrearParticipante = document.getElementById('tabsContainer');
                if (formCrearParticipante) {
                    formCrearParticipante.style.display = 'block'; // Mostrar el formulario
                } else {
                    console.error('No se encontró el formulario de creación de participante.');
                }
            }
        });
    });

</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Utilizar event delegation para capturar clics en el botón
        document.body.addEventListener('click', function (e) {
            if (e.target && e.target.id === 'btnEditarParticipante') {
                const formCrearParticipante = document.getElementById('tabsContainer');
                if (formCrearParticipante) {
                    formCrearParticipante.style.display = 'block'; // Mostrar el formulario
                } else {
                    console.error('No se encontró el formulario de creación de participante.');
                }
            }
        });
    });

</script>
@endpush

@section('js')

<script>

////* agregado RP

// Función para manejar la visibilidad y validación de los campos
document.addEventListener('DOMContentLoaded', function() {
    const direccionInput = document.getElementById('DIRECCION');
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

    // Agregar evento blur (pérdida de foco) a cada campo
    callePrincipalInput.addEventListener('blur', actualizarDireccion);
    numeroDomicilioInput.addEventListener('blur', actualizarDireccion);
    calleTransversalInput.addEventListener('blur', actualizarDireccion);

    // También podemos agregar el evento change para capturar cambios por selección
    callePrincipalInput.addEventListener('change', actualizarDireccion);
    numeroDomicilioInput.addEventListener('change', actualizarDireccion);
    calleTransversalInput.addEventListener('change', actualizarDireccion);
});

            
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
<script>
const getDatePickerTitle = elem => {
    // From the label or the aria-label
    const label = elem.nextElementSibling;
    let titleText = '';
    if (label && label.tagName === 'LABEL') {
      titleText = label.textContent;
    } else {
      titleText = elem.getAttribute('aria-label') || '';
    }
    return titleText;
  }

  const elems = document.querySelectorAll('.datepicker_input');
  for (const elem of elems) {
    const datepicker = new Datepicker(elem, {
      'format': 'dd/mm/yyyy', // UK format
      title: getDatePickerTitle(elem)
    });
  }
</script>

<script>
    document.getElementById('pasar-texto').addEventListener('click', function() {
        let textoOrigen = document.getElementById('identification').value;
        document.getElementById('identificacion').value = textoOrigen;
    });
    </script>
<!-- Script para alternar entre mostrar y esconder la imagen -->
<script>
    document.getElementById('toggle-photo-btn').addEventListener('click', function() {
        var userPhoto = document.getElementById('user-photo');
        var toggleBtn = document.getElementById('toggle-photo-btn');
        var containerPhoto=document.getElementById('container-photo')

        if (userPhoto.style.display === 'none') {
            // Mostrar la imagen
            userPhoto.style.display = 'block';
            containerPhoto.style.display='block'
            toggleBtn.textContent = 'Ocultar Foto'; // Cambiar el texto del botón
        } else {
            // Esconder la imagen
            userPhoto.style.display = 'none';
            containerPhoto.style.display='none'
            toggleBtn.textContent = 'Ver Foto'; // Cambiar el texto del botón
        }
    });
</script>
   <!--agregados RP-->
 <script>
$(document).ready(function() {

    function clearErrors() {
        $('.error-messages').text('');
        $('input, select, textarea').removeClass('error-input');
    }

    // Función para mostrar errores
    function showErrors(errors) {
        clearErrors();
        $.each(errors, function(field, messages) {
            // Agregar clase de error al input
            $('#' + field).addClass('error-input');
            // Mostrar mensaje de error
            $('#' + field + 'Error').text(messages[0]);
        });
    }

    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('error-input');
        $('#' + $(this).attr('id') + 'Error').text('');
    });


     // Convertir a mayúsculas solo los inputs type="text", excluyendo el email
    $('input[type="text"]').not('#EMAIL').on('input', function() {
        $(this).val($(this).val().toUpperCase());
    });

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
});
</script>

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
function clearErrors() {
        $('.error-messages').text('');
        $('input, select, textarea').removeClass('error-input');
    }

    // Función para mostrar errores
    function showErrors(errors) {
        clearErrors();
        $.each(errors, function(field, messages) {
            $('#' + field).addClass('error-input');
            $('#' + field + 'Error').text(messages[0]);
        });
    }


    $('#saveBtn').click(function(e) {
        e.preventDefault();
        $(this).html('Guardando...');
        $(this).attr('disabled', true);

        clearErrors(); // Limpiar errores previos

     // Función para contar errores
    function contarErroresTab(campos) {
        let contador = 0;
        campos.forEach(campo => {
            if($('#' + campo + 'Error').text().trim() !== '') {
                contador++;
            }
        });
        return contador;
    }


        
        var formDatos = document.getElementById('ajaxFormDatos');
        var formData = new FormData(formDatos);

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            url: '{{ route ("participantes.store") }}',
            method: 'POST',
            processData: false,
            contentType: false,
            data: formData,
            success: function(response) {
                $('#saveBtn').attr('disabled', false);
                $('#saveBtn').html('Guardar participante');

                // ... resto del código de éxito ...

                if(response.success) {
                    swal("Registro guardado", response.success, "success");
                }
                if(response.warning) {
                    swal("Atención", response.warning, "warning");
                }
                tabla_empresa.ajax.reload(null, false);
            },
            error: function(error) {
                $('#saveBtn').attr('disabled', false);
                $('#saveBtn').html('Guardar');

                if(error.status === 422) {
                    showErrors(error.responseJSON.errors);
                    
                    // Revisar cada tab para errores
                    Object.entries(camposPorTab).forEach(([tabId, campos]) => {
                        let numErrores = contarErroresTab(campos);
                        
                        if(numErrores > 0) {
                            let tabLink = $(`a[href="#${tabId}"]`);
                            tabLink.removeClass('tab-normal').addClass('tab-error');
                            tabLink.append(
                                `<span class="error-count" style="color: white; font-size: 12px;">
                                    <sub>(${numErrores})</sub>
                                </span>`
                            );
                        }
                    });
                }
            }
        });
    });

    // Limpiar errores cuando el usuario comience a escribir
    $('input, select, textarea').on('input change', function() {
        $(this).removeClass('error-input');
        $('#' + $(this).attr('id') + 'Error').text('');
    });

</script>


    <!--fin agregados RP-->
@stop
