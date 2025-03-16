<?php include ("templates/header.php"); ?>

<div class="p-5 mb-4 rounded-3 min-vh-100 d-flex align-items-center justify-content-center">
    <div class="container-fluid text-center" style="color: black;">
        <img src="uploads/logoCineteca.png" class="img-fluid mb-4" alt="Logo Cineteca" style="max-width: 300px; height: auto;" />
        
        <h1 class="display-5 fw-bold">¡Bienvenid@ al sistema!</h1>

        <div class="d-flex justify-content-center">
            <p class="fs-4"><strong>Usuario: <?php echo $_SESSION['usuario']; ?></strong></p>
        </div>
    </div>
</div>

<?php include ("templates/footer.php"); ?>
