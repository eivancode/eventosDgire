const BASE_URL = "http://localhost/eventosDgire/";
$(document).ready(function () {

    var dataTable = $('#tablaUsuarios').DataTable({

        "ajax": {
            "url": BASE_URL+"usuario/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "nombre" },
            { "data": "email" },
            { "data": "rol" },
            {
                "defaultContent": "<div class='gap-1 d-md-flex justify-content-center'><button class='btn btn-warning btn-sm' id='btnEditar'><i class='fas fa-pen' style='color:white'></i>"
                    + "</button><button class='btn btn-danger btn-sm' id='btnBorrar'><i class='fas fa-trash'></i></button></div>"
            }
        ],
        language: {
            "emptyTable": "No se encontraron datos",
            "lengthMenu": "Mostrar _MENU_ registros",
            "info": "Mostrando del _START_ al _END_. Total: _TOTAL_ entradas",
            "infoEmpty": "No hay datos param mostrar",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeros",
                "last": "Ultimos",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $('#nuevo').on('click', function () {
        $('#userModal').modal("show");
    });

    $('#btnAgregar').on('click', function () {
        var nombre = $('#nombre').val();
        var email = $('#email').val();
        var password = $('#password').val();
        var rol = $('#rol option:selected').val();

        $.ajax({
            url: BASE_URL + "usuario/guardar",
            type: 'POST',
            data: {
                nombre: nombre,
                email: email,
                password: password,
                rol: rol
            },

            success: function () {
                $('#userForm').trigger('reset');
                $('#userModal').modal('hide');
                dataTable.ajax.reload();

                Swal.fire(
                    'Guardado!',
                    'El usuario fue creado con éxito',
                    'success'
                )
            },

            error: function () {

                Swal.fire(
                    'Error!',
                    'No fue posible crear el usuario',
                    'error'
                )
            }
        });
    });

    $(document).on('click', '#btnEditar', function () {
        var id = parseInt($(this).closest('tr').text()); // Obtener la columna
        $('#id').val(id);
        $('#editModal').modal("show");

        $.get(BASE_URL+"usuario/editar&id=" + id, function (data) {
            data = JSON.parse(data);
            $('#editNombre').val(data[0].nombre);
            $('#editEmail').val(data[0].email);
            $('#editRol').val(data[0].idRol);
        })
    });

    $(document).on('click', '#btnActualizar', function () {
        var id = $('#id').val();
        var nombre = $('#editNombre').val();
        var email = $('#editEmail').val();
        var rol = $('#editRol').val();

        $.ajax({
            url: BASE_URL + "usuario/actualizar&id=" + id,
            type: "POST",
            data: {
                nombre: nombre,
                email: email,
                rol: rol
            },
            success: function () {

                $('#editForm').trigger('reset');
                $('#editModal').modal('hide');
                dataTable.ajax.reload();

                Swal.fire(
                    'Guardado!',
                    'El usuario fue actualizado con éxito',
                    'success'
                )
            },

            error: function () {

                Swal.fire(
                    'Error!',
                    'No fue posible actualizar el usuario',
                    'error'
                )
            }
        });
    });

    $(document).on('click', '#btnBorrar', function () {
        var id = parseInt($(this).closest('tr').text());

        Swal.fire({
            title: 'Estás seguro?',
            text: "La acción no se puede revertir!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#191970',
            cancelButtonColor: '#f1bfc3',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: BASE_URL + "usuario/borrar&id=" + id,
                    type: "POST",
                    
                    success: function (result) {

                        dataTable.ajax.reload();

                        Swal.fire(
                            'Eliminado!',
                            'El usuario fue borrado con éxito',
                            'success'
                        )
                    }
                });
            }
        });
    });
});