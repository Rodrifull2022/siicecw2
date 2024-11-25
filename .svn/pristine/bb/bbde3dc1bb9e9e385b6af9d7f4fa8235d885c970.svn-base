<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog"  
   role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="searchModalLabel">Buscar  
   Participante</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>  

        </div>
        <div class="modal-body">
          <div class="form-group">
            <label for="cedula">Cédula:</label>
            <input type="text" class="form-control"  
   id="cedula">
          </div>
          <div class="form-group">
            <label for="nombreCompleto">Nombre Completo:</label>
            <input type="text" class="form-control" id="nombreCompleto"  
   disabled>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
          <button type="button" class="btn btn-primary"  
   id="buscarParticipante">Buscar</button>
        </div>
      </div>
    </div>
  </div>
  @section('js')
  <script>
    $(document).ready(function() {
      $('#buscarParticipante').click(function(event) {
        var cedula = $('#cedula').val();
        $.ajax({
          url: "{{ route('buscar.participante') }}",
          data: { cedula: cedula },
          success: function(response) {
            $('#nombreCompleto').val(response.nombre_completo);
          }
        });
      });
    });
  </script>
  @stop
