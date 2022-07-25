<?php

session_start();

include('./conexion.php');

$user = $_POST['user'];
$password = $_POST['password'];


$conn = conectar();

$stm = $conn->prepare("SELECT id, role_id rol FROM users WHERE user = :user && password = :password");
$stm->bindParam(':user', $user);
$stm->bindParam(':password', $password);
$stm->execute();

$result = $stm->fetchAll(PDO::FETCH_ASSOC);

if ( !empty($result) ) {
    $_SESSION['id'] = $result[0]['id'];
    $_SESSION['rol'] = $result[0]['rol'];
} else {
    $_SESSION['fail'] = true;
}

header("Location: ./../login.php");
    die();
