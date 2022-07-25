<?php
include('./conexion.php');

header("Access-Control-Allow-Origin: *");
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header("Access-Control-Allow-Headers: X-Requested-With");
header('Content-Type: text/html; charset=utf-8');
header('P3P: CP="IDC DSP COR CURa ADMa OUR IND PHY ONL COM STA"');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':

        $conn = conectar();

        if ($_GET['action'] == 'getClient') {

            $stm = $conn->prepare('Select u.name, u.user, u.email, i.type, i.image from users u, images i where u.img_id = i.id and u.id = :id');
            $stm->bindParam(':id', $_GET['id']);

            $stm->execute();

            $result = $stm->fetchAll(PDO::FETCH_ASSOC);

            $result[0]['image'] = base64_encode($result[0]['image']);

            $conn = null;

            echo json_encode($result);
            break;
        }

        break;

    case 'POST':

        $conn = conectar();

        if ($_POST['action'] == 'register') {

            $tipoArchivo = $_FILES['photo']['type'];
            $tamanoArchivo = $_FILES['photo']['size'];
            $imagenSubida = fopen($_FILES['photo']['tmp_name'], 'r');
            $binariosImagen = fread($imagenSubida, $tamanoArchivo);

            $idImage = randomid('id', 'images');
            $dataTime = date("Y-m-d H:i:s");


            $stm = $conn->prepare('INSERT INTO images VALUES (:idImage, :img, :type, :dataTime)');
            $stm->bindParam(':idImage', $idImage);
            $stm->bindParam(':img', $binariosImagen);
            $stm->bindParam(':type', $tipoArchivo);
            $stm->bindParam(':dataTime', $dataTime);

            if ($stm->execute()) {
                $name = $_POST['name'];
                $user = $_POST['user'];
                $password = $_POST['password'];
                $email = $_POST['email'];

                $stm = $conn->prepare('INSERT INTO users VALUES (null, :name, :user, :password, :email, 2, :idImage)');
                $stm->bindParam(':name', $name);
                $stm->bindParam(':user', $user);
                $stm->bindParam(':password', $password);
                $stm->bindParam(':email', $email);
                $stm->bindParam(':idImage', $idImage);

                $stm->execute();
            }

            $conn = null;

            $response = array(
                'message' => 'El registro fue exitoso',
                'icon' => 'success'
            );

            echo json_encode($response);
            break;
        }

        if ($_POST['action'] == 'update') {

            $name = $_POST['name'];
            $user = $_POST['user'];
            $email = $_POST['email'];
            $id = $_POST['id'];

            $stm = $conn->prepare('update users set name = :name, user = :user, email = :email where id = :id');
            $stm->bindParam(':name', $name);
            $stm->bindParam(':user', $user);
            $stm->bindParam(':email', $email);
            $stm->bindParam(':id', $id);

            $stm->execute();

            $conn = null;

            $response = array(
                'message' => 'la actualización fue exitosa',
                'icon' => 'success'
            );

            echo json_encode($response);
            break;
        }


        break;

    default:

        break;
}


function randomid($idTable, $table)
{
    $id = rand(1, 99999);
    $conn = conectar();
    $sql = "select $idTable from $table";
    $stm = $conn->prepare($sql);
    $stm->execute();
    $result = $stm->fetchAll(PDO::FETCH_ASSOC);
    $conn = null;

    foreach ($result as $row) {
        if ($row[$idTable] == $id) {
            $id = randomid($idTable, $table);
        }
    }

    return $id;
}
