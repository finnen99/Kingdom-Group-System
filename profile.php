<?php 
include('./src/header.php'); 


?>

<div class="container bg-light shadow rounded mt-5 py-3 px-5" style="min-height: 50vh; width: 1200px; max-width: 90%;">

    <div class="row justify-content-center mb-5">
        <img id="clientImg" class="img-fluid rounded-circle w-50 w-md-25" src="<?php echo $imgUri ?>" alt="User Image">
    </div>

    <div class="row mb-5">
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Nombre:</p>
            <p id="clientName" class="fs-5 fw-bold text-muted mb-1 text-center"><?php echo $resultName[0]['name'] ?></p>
        </div>
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Usuario:</p>
            <p id="clientUser" class="fs-5 fw-bold text-muted mb-1 text-center"> <?php echo $resultName[0]['user'] ?> </p>
        </div>
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Correo:</p>
            <p id="clientEmail" class="fs-5 fw-bold text-muted mb-1 text-center"> <?php echo $resultName[0]['email'] ?> </p>
        </div>
    </div>
</div>

</body>

</html>