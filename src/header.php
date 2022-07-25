<?php
session_start();

include('./php/conexion.php');

if (!isset($_SESSION['id'])) {
    header("Location: ./login.php");
    die();
}

// Esta linea se hizo por la ruta que estaba manejando, en el host ya no es necesario
// if ($_SESSION['rol'] == 2 && $_SERVER["REQUEST_URI"] != '/kingdom-group-sistema/profile.php') {
if ($_SESSION['rol'] == 2 && $_SERVER["REQUEST_URI"] != '/profile.php') {
    // TODO: Creación del archivo y su logica
    header("Location: ./profile.php");
    die();
}

$conn = conectar();

$stm = $conn ->prepare('select * from users where id = :id');
$stm -> bindParam(':id', $_SESSION['id']);
$stm -> execute();

$resultName = $stm->fetchAll(PDO::FETCH_ASSOC);

$stm = $conn ->prepare('select i.image, i.type from users u, images i where u.img_id = i.id and u.id = :id');
$stm -> bindParam(':id', $_SESSION['id']);
$stm -> execute();

$resultImg = $stm->fetchAll(PDO::FETCH_ASSOC);

$conn = null; 

$imgUri = empty($resultImg[0]['image']) ? './img/user.png' : 'data:' . $resultImg[0]['type'] . ';base64,' . base64_encode($resultImg[0]['image']);


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://drive.google.com/uc?export=view&id=1yTLwNiCZhIdCWolQldwq4spHQkgZDqkG">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
    <script src="./js/wheater.js"></script>

    <title>Kingdom Group</title>
</head>

<body style="background-color: #b2dafa; font-family: 'Roboto', sans-serif; height: 100vh;">

    <nav class="navbar navbar-expand-lg px-3" style="background-color: #ccc;">
        <div class="container-fluid justify-content-center justify-content-md-between">

            <div id="wheater" class="d-flex align-items-center gap-3">
            </div>

            <li class="nav-item dropdown d-flex">
                <p class="my-auto d-none d-md-block me-3"><?php echo($resultName[0]['name']); ?></p>
                <img
                  class="nav-link dropdown-toggle img-fluid rounded-circle"
                  id="navbarDropdown"
                  role="button"
                  data-bs-toggle="dropdown"
                  aria-expanded="false"
                  src="<?php echo $imgUri ?>"
                  style="max-width: 45px;">
                </img>
                <ul class="dropdown-menu dropdown-menu-end list-items" aria-labelledby="navbarDropdown" style="font-size: 13px;">
                    <?php
                        if($_SESSION['rol'] == 1){
                            echo('
                                <li class="text-center fs-5"> 
                                    <a class="text-decoration-none text-dark" href="./welcome.php">Inicio</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li class="text-center fs-5"> 
                                    <a class="text-decoration-none text-dark" href="./clients.php">Clientes</a>
                                </li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                            ');
                        }
                    ?>
                    <li class="text-center fs-5">
                        <a class="text-decoration-none text-dark" href="./php/destroySession.php">Cerrar Sesión</a>
                    </li>
                </ul>
            </li>

        </div>
    </nav>