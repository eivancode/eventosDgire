$('#btnLogin').on('click', function () {
    login();
})

$("#user, #password").keypress(function (e) {
    var code = (e.keyCode ? e.keyCode : e.which);
    if (code == 13) {
        login();
    }
});

function loginValidate() {

    if ($('#user').val() == "" && $('#password').val() == "") {
        $('.alert').removeClass('d-none');
        $('.alert').text('Ingrese usuario y contraseña');
        return false;

    } else if ($('#user').val() == "") {
        $('.alert').removeClass('d-none');
        $('.alert').text(' Ingrese un usuario');
        return false;

    } else if ($('#password').val() == "") {
        $('.alert').removeClass('d-none');
        $('.alert').text('Ingrese una contraseña');
        return false;
    } else {
        return true;
    }
}

function login() {

    if (loginValidate()) {
        var usuario = $('#user').val();
        var password = $('#password').val();

        $.ajax({
            url: 'http://localhost/eventosDgire/usuario/autenticar',
            type: 'POST',
            data: {
                usuario: usuario,
                password: password
            },

            success: function () {

                $('.alert').hide();
                window.location.href = 'http://localhost/eventosDgire/evento/index';

            },

            error: function () {
                $('.alert').removeClass('d-none');
                $('.alert').text('Usuario o contraseña incorrectos');
            }
        })
    }

    
}


