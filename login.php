<?php
session_start();

if (isset($_SESSION['id']) && !isset($_SESSION['fail'])) {
    header("Location: ./welcome.php");
    die();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <title>kingdom group</title>

    <style>
        .form-control.error {
            color: black;
        }

        .error {
            color: red;
        }
    </style>
</head>

<body class="d-flex justify-content-center align-items-center" style="background-color: #b2dafa; font-family: 'Roboto', sans-serif; height: 100vh;">
    <div class="container bg-white d-flex align-items-center flex-column rounded shadow" style="max-width: 700px; width: 90%;">
        <div class="row my-5">
            <div class="col-12 d-flex justify-content-center">
                <img class="img-fluid w-25" src="./img/user.png" alt="user placeholder">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-12">
                <h1 class="card-title text-center fs-2 fw-semibold text-uppercase">Log in</h1>
            </div>
        </div>

        <form id="login-form" action="./php/validate.php" method="post" class="row w-50 justify-content-center">
            <div class="mb-3 col-12">
                <label for="user" class="form-label text-muted">Usuario</label>
                <input type="text" class="form-control" id="user" name="user" required>
            </div>
            <div class="mb-3 col-12 ">
                <label for="password" class="form-label text-muted">Contraseña</label>
                <input type="password" class="form-control" id="password" name="password" required>
            </div>
            <div class="col-10 col-md-5 mb-5">
                <input type="submit" value="Iniciar sesión" class="btn btn-primary w-100">
            </div>
        </form>

    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="./js/login.js"></script>

    <?php
    if (isset($_SESSION['fail'])) {
        echo ('
                <script>
                    Swal.fire({
                        title: "Usuario y/o Contraseña incorrectos",
                        text: "verifica que tus datos sean correctos y vulvelo a intentar",
                        icon: "error"
                    });
                </script>
            ');

        session_unset();
        session_destroy();
    }
    ?>
</body>

</html>