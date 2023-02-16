const BASE_URL = "http://localhost/eventosDgire/";
$(document).ready(function () {

    var dataTable = $('#tablaAulas').DataTable({

        "ajax": {
            "url": BASE_URL + "aula/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idAula" },
            { "data": "nombre" },
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
        $('#aulaModal').modal("show");
    });

    $('#btnAgregar').on('click', function () {
        var nombre = $('#nombre').val();

        $.ajax({
            url: BASE_URL + "aula/guardar",
            type: 'POST',
            data: {
                nombre: nombre,
            },

            success: function () {
                $('#aulaForm').trigger('reset');
                $('#aulaModal').modal('hide');
                dataTable.ajax.reload();

                Swal.fire(
                    'Guardado!',
                    'El aula fue creada con éxito',
                    'success'
                )
            },

            error: function () {

                Swal.fire(
                    'Error!',
                    'No fue posible crear el aula',
                    'error'
                )
            }
        });
    });

    $(document).on('click', '#btnEditar', function () {
        var id = parseInt($(this).closest('tr').text()); // Obtener la columna
        $('#id').val(id);
        $('#editModal').modal("show");

        $.get(BASE_URL + "aula/editar&id=" + id, function (data) {
            data = JSON.parse(data);
            $('#editNombre').val(data[0].nombre);
        })
    });

    $(document).on('click', '#btnActualizar', function () {
        var id = $('#id').val();
        var nombre = $('#editNombre').val();

        $.ajax({
            url: BASE_URL + "aula/actualizar&id=" + id,
            type: "POST",
            data: {
                nombre: nombre,
            },
            success: function () {

                $('#editForm').trigger('reset');
                $('#editModal').modal('hide');
                dataTable.ajax.reload();

                Swal.fire(
                    'Actualizado!',
                    'El aula fue actualizada con éxito',
                    'success'
                )
            },

            error: function () {

                Swal.fire(
                    'Error!',
                    'No fue posible actualizar el aula',
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
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, eliminar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: BASE_URL + "aula/borrar&id=" + id,
                    type: "POST",

                    success: function (result) {

                        dataTable.ajax.reload();

                        Swal.fire(
                            'Eliminado!',
                            'El aula fue borrada con éxito',
                            'success'
                        )
                    }
                });
            }
        });
    });
});