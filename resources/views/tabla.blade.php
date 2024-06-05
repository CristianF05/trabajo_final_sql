<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listado de Estudiantes</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Listado de Estudiantes</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Salón</th>
                    <th>Grado</th>
                    <th>DNI</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($estudiantes as $estudiante)
                    <tr>
                        <td>{{ $estudiante->nombre }}</td>
                        <td>{{ $estudiante->apellido }}</td>
                        <td>{{ $estudiante->salon }}</td>
                        <td>{{ $estudiante->grado }}</td>
                        <td>{{ $estudiante->dni }}</td>
                        <td>
                            <button class="btn btn-info" data-toggle="modal" data-target="#viewModal" data-id="{{ $estudiante->id }}" data-nombre="{{ $estudiante->nombre }}" data-apellido="{{ $estudiante->apellido }}" data-salon="{{ $estudiante->salon }}" data-grado="{{ $estudiante->grado }}" data-dni="{{ $estudiante->dni }}">Ver</button>
                            <button class="btn btn-warning" data-toggle="modal" data-target="#editModal" data-id="{{ $estudiante->id }}" data-nombre="{{ $estudiante->nombre }}" data-apellido="{{ $estudiante->apellido }}" data-salon="{{ $estudiante->salon }}" data-grado="{{ $estudiante->grado }}" data-dni="{{ $estudiante->dni }}">Editar</button>
                            <form action="{{ route('estudiantes.destroy', $estudiante->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- View Modal -->
    <div class="modal" id="viewModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Detalles del Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <p><strong>Nombre:</strong> <span id="viewNombre"></span></p>
                    <p><strong>Apellido:</strong> <span id="viewApellido"></span></p>
                    <p><strong>Salón:</strong> <span id="viewSalon"></span></p>
                    <p><strong>Grado:</strong> <span id="viewGrado"></span></p>
                    <p><strong>DNI:</strong> <span id="viewDni"></span></p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal" id="editModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar Estudiante</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form action="" method="POST" id="editForm">
                    @csrf
                    @method('PUT')
                    <div class="modal-body">
                        <input type="hidden" name="id" id="editId">
                        <div class="form-group">
                            <label for="editNombre">Nombre:</label>
                            <input type="text" class="form-control" id="editNombre" name="nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="editApellido">Apellido:</label>
                            <input type="text" class="form-control" id="editApellido" name="apellido" required>
                        </div>
                        <div class="form-group">
                            <label for="editSalon">Salón:</label>
                            <input type="text" class="form-control" id="editSalon" name="salon" required>
                        </div>
                        <div class="form-group">
                            <label for="editGrado">Grado:</label>
                            <input type="text" class="form-control" id="editGrado" name="grado" required>
                        </div>
                        <div class="form-group">
                            <label for="editDni">DNI:</label>
                            <input type="text" class="form-control" id="editDni" name="dni" required>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Guardar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        $('#viewModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var nombre = button.data('nombre');
            var apellido = button.data('apellido');
            var salon = button.data('salon');
            var grado = button.data('grado');
            var dni = button.data('dni');

            var modal = $(this);
            modal.find('#viewNombre').text(nombre);
            modal.find('#viewApellido').text(apellido);
            modal.find('#viewSalon').text(salon);
            modal.find('#viewGrado').text(grado);
            modal.find('#viewDni').text(dni);
        });

        $('#editModal').on('show.bs.modal', function (event) {
            var button = $(event.relatedTarget);
            var id = button.data('id');
            var nombre = button.data('nombre');
            var apellido = button.data('apellido');
            var salon = button.data('salon');
            var grado = button.data('grado');
            var dni = button.data('dni');

            var modal = $(this);
            modal.find('#editId').val(id);
            modal.find('#editNombre').val(nombre);
            modal.find('#editApellido').val(apellido);
            modal.find('#editSalon').val(salon);
            modal.find('#editGrado').val(grado);
            modal.find('#editDni').val(dni);

            var form = modal.find('#editForm');
            form.attr('action', '{{ url("tabla") }}/' + id);
        });
    </script>
</body>
</html>