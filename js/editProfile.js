const input_string = window.location.href;
const url = new URL(input_string);

$(async () => {

    const [{ name, email, user, image, type }] = await getData();

    $('#clientImg').attr('src', `data:${type};base64,${image}`);
    $('#clientName').text(name);
    $('#clientUser').text(user);
    $('#clientEmail').text(email);

    $('#editModal').on('show.bs.modal', async() => {

        const [{ name, email, user, image, type }] = await getData();
        
        $('#name').val(name);
        $('#user').val(user);
        $('#email').val(email);
    });

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
        }
    });

    $('#updateData').click(function (e) {
        e.preventDefault();

        $('#editForm').trigger('submit');

    });

    $('#editForm').submit(function (e) {
        e.preventDefault();

        const id = url.searchParams.get("id");

        if ($("#editForm").valid()) {

            let form_data = new FormData($('#editForm')[0]);
            form_data.append('action', 'update');
            form_data.append('id', id);

            $.ajax({
                type: "POST",
                url: "./php/endpoint.php",
                data: form_data,
                dataType: "json",
                contentType: false,
                processData: false,
                success: async({ message, icon }) => {

                    const [{ name, email, user, image, type }] = await getData();

                    $('#clientImg').attr('src', `data:${type};base64,${image}`);
                    $('#clientName').text(name);
                    $('#clientUser').text(user);
                    $('#clientEmail').text(email);

                    Swal.fire({
                        title: message,
                        icon: icon
                    });

                    $('#editModal').modal('hide');
                },
                error: function (error) {
                    console.log(error);

                    Swal.fire({
                        title: 'Error al actualizar',
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


const getData = async () => {

    const id = url.searchParams.get("id");

    const data = await $.ajax({
        type: "GET",
        url: `./php/endpoint.php?id=${id}&action=getClient`,
        dataType: "json",
    });

    return data;
}
