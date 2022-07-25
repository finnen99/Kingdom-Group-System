
$(document).ready(function () {

    $.validator.addMethod('regexp', function (value, element, param) {
        return this.optional(element) || value.match(param);
    }, 'Carteres Invalidos');

    $("#register-form").validate({
        rules: {
            name: {
                required: true,
                minlength: 3,
                regexp: /^[a-zA-ZÀ-ÿ\s]+$/,
            },
            email: {
                required: true,
                email: true
            },
            user: {
                required: true,
                minlength: 3,
                regexp: /^[a-zA-Z_-\d\S]+$/,
            },
            password: {
                required: true,
                minlength: 8,
                regexp: /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[$@$!%*?&#.$($)$-$_])[A-Za-z\d$@$!%*?&#.$($)$-$_]{8,15}$/

            },
            photo: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Ingresa un Nombre",
                minlength: "Debe de tener más de 3 caracteres"
            },
            email: {
                required: "Ingresa un Email",
                email: "La estructura no es valida"
            },
            user: {
                required: 'Ingresa un Usuario',
                minlength: 'Debe de tener más de 3 caracteres',
            },
            password: {
                required: 'Ingresa un acontraseña',
                minlength: 'Debe de ser mayor a 8 caracteres',
                regexp: 'Debe de contener Mayusculas, Minusculas, Números y Caracteres Especiales'
            },
            photo: {
                required: 'Ingresa una imagen'
            }
        }
    });

    $("#send-form").on('click', () => {
        $("#register-form").trigger('submit')
    });

    $('#register-form').on('submit', (e) => {
        e.preventDefault();

        if ($("#register-form").valid()) {
            // TODO: Envio de datos por ajax

            let form_data = new FormData($('#register-form')[0]);
            form_data.append('action', 'register');

            $.ajax({
                type: "POST",
                url: "./php/endpoint.php",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: function ({message, icon}) {
                    Swal.fire({
                        title: message,
                        icon: icon
                    });

                    $('#register-form').trigger('reset')
                },
                error: function ( error ) {
                    console.log(error);

                    Swal.fire({
                        title: 'Error al registrar',
                        text: 'Vuelve a intentarlo nuevamente  o cambia de usuario',
                        icon: 'error'
                    });
                }
            });

        } else {
            return
        }
    });




});