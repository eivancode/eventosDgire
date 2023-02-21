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
        $('.error').text('Ingrese usuario y contraseña');
        return false;

    } else if ($('#user').val() == "") {
        $('.error').text('Ingrese un usuario');
        return false;

    } else if ($('#password').val() == "") {
        $('.error').text('Ingrese una contraseña');
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

                $('.error').hide();
                window.location.href = 'http://localhost/eventosDgire/evento/index';

            },

            error: function () {
                $('.error').text('Usuario o contraseña incorrectos');
            }
        })
    }

}


