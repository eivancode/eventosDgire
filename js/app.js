$('#btnLogin').on('click', function () {
    login();
})

$("#user, #password").keypress(function (e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
        login();
    }
});

function login() {
    var usuario = $('#user').val();
    var password = $('#password').val();

    $.ajax({
        url: 'http://localhost/eventosDgire/usuario/login',
        type: 'POST',
        data: {
            usuario: usuario,
            password: password
        },
        success: function () {

            window.location.href = 'http://localhost/eventosDgire/evento/index';

        },

        error: function () {
            Swal.fire(
                'Error!',
                'Usuario y/o contraseña incorrecto',
                'error'
            )
        }
    })
}


