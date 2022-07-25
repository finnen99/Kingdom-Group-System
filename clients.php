<?php include('./src/header.php'); ?>

<div class="container bg-light shadow rounded mt-5 py-3 px-5" style="min-height: 50vh; width: 1200px; max-width: 90%;">

    <h1 class="text-center fs-2 fw-semibold mb-3">Lista de Clientes</h1>
    <div class="row w-100 w-md-50 mx-auto">
        <?php
        
        $conn = conectar();

        $stm = $conn->prepare('select u.name, u.id, i.image, i.type from users u, images i where u.img_id = i.id and u.role_id = 2');
        $stm -> execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $imgSrc = 'data:' . $value['type'] . ';base64,' . base64_encode($value['image']);

            echo('
                <div class="col-12 d-flex align-items-center justify-content-between mb-3">
                    <img class="img-fluid rounded-circle" src="'.$imgSrc.'" alt="User Image" style="height: 100px;">
                    <h1 class="fs-5">'.$value['name'].'</h1>
                    <a href="./editProfile.php?id='.$value['id'].'"><button class="btn btn-primary d-block" style="height: fit-content;"> Ver </button></a>
                </div>
            ');
        }
        
        ?>
    </div>


</div>

</body>

</html>