<?php include('./src/header.php'); ?>

<div class="container bg-light shadow rounded mt-5 py-3 px-5" style="min-height: 50vh; width: 1200px; max-width: 90%;">
    <h1 class="text-center fs-2 fw-semibold">Clientes Recientes</h1>
    <div class="row gap-3">
        <?php
        $conn = conectar();

        $stm = $conn->prepare('select u.name, u.user, u.email, i.image, i.type from users u, images i where u.img_id = i.id and u.role_id = 2 order by u.id DESC limit 3');
        $stm -> execute();

        $result = $stm->fetchAll(PDO::FETCH_ASSOC);

        foreach ($result as $key => $value) {
            $imgSrc = 'data:' . $value['type'] . ';base64,' . base64_encode($value['image']);

            echo('
            <div class="col-12 col-md-4 border border-secondary border-2 rounded py-3 px-2 d-flex flex-column align-items-center">
                <img class="img-fluid rounded-circle w-50" src="'.$imgSrc.'" alt="User Image">
            
                <h2 class="text-center">'.$value['name'].'</h2>
                <p class="fw-bold">Usuario: <span class="text-muted">'.$value['user'].'</span></p>
                <p class="fw-bold">Correo: <span class="text-muted">'.$value['email'].'</span></p>
            </div>
            ');
        }

        ?>
    </div>
</div>

</body>

</html>