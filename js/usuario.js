const BASE_URL = "http://localhost/eventosDgire/";
$(document).ready(function () {

    var dataTable = $('#tablaUsuarios').DataTable({

        "ajax": {
            "url": BASE_URL + "usuario/listar",
            "dataSrc": ""
        },
        "columns": [
            { "data": "idUsuario" },
            { "data": "nombre" },
            { "data": "usuario" },
            { "data": "email" },
            { "data": "rol" },
            {
                "defaultContent": "<div class='gap-1 d-md-flex justify-content-center'><button class='btn btn-warning btn-sm' id='btnEditar'><span class='fas fa-pen' style='color:white'></span>"
                    + "</button><button class='btn btn-danger btn-sm' id='btnBorrar'><span class='fas fa-trash-alt'></span></button></div>"
            }
        ],
        language: {
            "emptyTable": "No se encontraron datos",
            "lengthMenu": "Mostrar _MENU_ registros",
            "info": "Mostrando del _START_ al _END_. Total: _TOTAL_ registros",
            "infoEmpty": "No hay datos para mostrar",
            "search": "Buscar:",
            "paginate": {
                "first": "Primeros",
                "last": "Ultimos",
                "next": "Siguiente",
                "previous": "Anterior"
            }
        }
    });

    $(document).ready(function formValidate() {

        $('#userForm').validate({
            rules: {
                nombre: {
                    required: true,
                },

                usuario: {
                    required: true,
                    minlength: 5,
                    remote: {
                        type: "POST",
                        url: BASE_URL + "usuario/comprobarUsuario",
                        data: {
                            nombre: function () {
                                return $('#usuario').val();
                            }
                        }
                    }
                },

                email: {
                    required: true,
                    email: true,
                    remote: {
                        type: "POST",
                        url: BASE_URL + "usuario/comprobarEmail",
                        data: {
                            email: function () {
                                return $('#email').val();
                            }
                        }
                    }
                },

                password: {
                    required: true
                },

                rol: {
                    required: true
                }
            },

            messages: {
                nombre: {
                    required: "Ingrese un nombre", maxlength: "Ingrese menos de 60",
                },

                usuario: {
                    required: "Ingrese un nombre de usuario", minlength:"Mínimo 5 caracteres", maxlength: "Ingrese menos de 20",
                },

                email: {
                    required: "Ingrese un email",
                    email: "Formato de email inválido",
                },

                password: {
                    required: "Ingrese una contraseña",
                },

                rol: {
                    required: "Seleccione un rol",
                }
            },

            submitHandler: function () {

                var nombre = $('#nombre').val();
                var usuario = $('#usuario').val();
                var email = $('#email').val();
                var password = $('#password').val();
                var rol = $('#rol option:selected').val();


                $.ajax({
                    url: BASE_URL + "usuario/guardar",
                    type: 'POST',
                    data: {
                        nombre: nombre,
                        usuario: usuario,
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
                })
            }
        })
    });

    $('#nuevo').on('click', function () {
        $('#userModal').modal("show");
    });

    $(document).on('click', '#btnEditar', function () {
        var id = parseInt($(this).closest('tr').text()); // Obtener la columna
        $('#id').val(id);
        $('#editModal').modal("show");

        $.get(BASE_URL + "usuario/editar&id=" + id, function (data) {
            data = JSON.parse(data);
            $('#editNombre').val(data[0].nombre);
            $('#editUsuario').val(data[0].usuario);
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