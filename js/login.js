$(function () {
    
    $("#login-form").validate({
        rules: {
            user: 'required',
            password: 'required'
        },
        messages: {
            user: 'Ingresa tu usuario',
            password: 'Ingresa tu contraseña'
        }
    });

});

