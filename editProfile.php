<?php include('./src/header.php'); ?>

<div class="container bg-light shadow rounded mt-5 py-3 px-5" style="min-height: 50vh; width: 1200px; max-width: 90%;">

    <div class="row justify-content-center mb-5">
        <img id="clientImg" class="img-fluid rounded-circle w-50 w-md-25" src="./img/user.png" alt="User Image">
    </div>

    <div class="row mb-5">
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Nombre:</p>
            <p id="clientName" class="fs-5 fw-bold text-muted mb-1 text-center"></p>
        </div>
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Usuario:</p>
            <p id="clientUser" class="fs-5 fw-bold text-muted mb-1 text-center"></p>
        </div>
        <div class="col-12 col-md-4">
            <p class="fs-4 fw-bold mb-1">Correo:</p>
            <p id="clientEmail" class="fs-5 fw-bold text-muted mb-1 text-center"></p>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-3">
            <button class="btn btn-primary w-100" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
        </div>
    </div>
</div>

<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Editar Cliente</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="editForm" class="row mx-2 my-3">
                    <div class="col-12 mb-3">
                        <label for="name" class="form-label text-muted">Nombre completo</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="user" class="form-label text-muted">Usuario</label>
                        <input type="text" class="form-control" id="user" name="user" required>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="email" class="form-label text-muted">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" id="updateData" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="./js/editProfile.js"></script>
</body>

</html>