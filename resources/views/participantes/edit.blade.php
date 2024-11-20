@extends('adminlte::page')
@section('title', 'Editar información de la persona')

@section('content_header')

@stop
@section('content')

<!-- Content Wrapper. Contains page content -->
<div class="container" style="max-width:100%">
    <div class="card">
        <div class="card-header"><h4>Editar persona</h4></div>
    <div class="row" style="margin-left:1px">
        <div class="pull-right mb-2" style="padding-top: 25px; padding-bottom:15px">
        <a class="btn btn-primary" href="{{ route('participantes.index') }}" enctype="multipart/form-data"> Regresar</a>
        </div>
    </div>
    <div id="tabsContainer2" style="font-size:14px" >
    <div class="card card-primary card-tabs" >
            <div class="card-header p-0 pt-1">
              <ul class="nav nav-tabs" id="custom-tabs-one-tab myTab2" role="tablist" >
                <li class="nav-item"><a class="nav-link active" href="#informacion2" data-toggle="tab">Información Personal</a></li>
                <li class="nav-item"><a class="nav-link" href="#dato_ubicacion2" data-toggle="tab">Datos de Ubicación</a></li>
                <li class="nav-item"><a class="nav-link" href="#tipo_cliente2" data-toggle="tab">Tipo de Cliente</a></li>
                <li class="nav-item"><a class="nav-link" href="#dato_familiar2" data-toggle="tab">Datos Familiares</a></li>
                <li class="nav-item"><a class="nav-link" href="#facturacion2" data-toggle="tab">Facturación</a></li>
                <li class="nav-item"><a class="nav-link" href="#autorizacion2" data-toggle="tab">Autorizaciones</a></li>
              </ul>
            </div><!-- /.card-header -->
      <div class="card-body">
              <div class="tab-content" id="myTabContent2">
                <div class="active tab-pane" id="informacion2">
                    <form action="{{ route('participantes.update',$participante->IDPARTICIPANTE) }}" method="POST" enctype="multipart/form-data">


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
                          <input type="text" class="form-control" value="{{ $participante->DIRECCION }}" id="direccion2" required>
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
          </div>

          <div class="row" style="padding:15px;float:right">
              <button type="submit" class="btn btn-primary">Guardar Todo</button>
              </div>
          </form>

    </div>
    </div>
</div>

@stop
@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop
@section('js')
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
<!--Formato para select-->
<script>
    $(document).ready(function() {
    $('.js-example-basic-single').select2();
});
</script>
<script type="text/javascript">
   $(document).ready(function() {
    // Escuchar el evento de cambio en el select
    $('#representantes').change(function() {
        // Obtener el valor seleccionado
        var valorSeleccionado = $(this).val();
        // Asignar el valor al textbox
        $('#representantet').val(valorSeleccionado);
    });
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
@stop
