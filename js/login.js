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


