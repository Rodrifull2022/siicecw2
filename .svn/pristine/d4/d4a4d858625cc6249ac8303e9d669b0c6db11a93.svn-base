<div class="modal fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="searchModalLabel">Buscar Representante</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="searchForm">
                    @csrf
                    <div class="form-group">
                        <label for="cedula">Cédula</label>
                        <input type="text" class="form-control" id="cedula" name="cedula" required>
                    </div>
                    <button type="button" class="btn btn-primary" onclick="buscarParticipante()">Buscar</button>
                </form>
                <div id="result" class="mt-3"></div>
            </div>
        </div>
    </div>
</div>

<script>
    function buscarParticipante() {
        const cedula = document.getElementById('cedula').value;
        const token = document.querySelector('input[name="_token"]').value;

        fetch('{{ route('participantes.searchByCedula') }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ cedula: cedula })
        })
        .then(response => response.json())
        .then(data => {
            const resultDiv = document.getElementById('result');
            const nombreCompletoInput = document.getElementById('nombreCompleto');
            if (data.success) {
                resultDiv.innerHTML = `<div class="alert alert-success">Nombre Completo: ${data.nombre_completo}</div>`;
                nombreCompletoInput.value = data.nombre_completo;
                //$('#searchModal').modal('hide');
            } else {
                resultDiv.innerHTML = `<div class="alert alert-danger">${data.message}</div>`;
            }
        })
        .catch(error => console.error('Error:', error));
    }
</script>
