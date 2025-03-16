<?php
session_start();
if ($_POST) {
    include("./bd.php");

    $cuenta = $_POST["cuenta"];
    $clave = $_POST["clave"];

    $clave_cifrada = md5($clave);

    $sentencia = $conexion->prepare("SELECT *, COUNT(*) as n_usuarios 
    FROM usuarios 
    WHERE cuenta=:cuenta AND clave=:clave");


    $sentencia->bindParam(":cuenta", $cuenta);
    $sentencia->bindParam(":clave", $clave_cifrada);


    $sentencia->execute();


    $registro = $sentencia->fetch(PDO::FETCH_LAZY);
    
    if ($registro["n_usuarios"] > 0) {

        $_SESSION['usuario'] = $registro["usuario"];
        $_SESSION['logueado'] = true;
        header("Location: index.php");
        exit();
    } else {
        $mensaje = "La cuenta o la clave son incorrectas";
    }
}
?>
<!doctype html>
<html lang="es">
<head>
    <title>Login</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <style>
        /* Limitar el ancho de la tarjeta */
        .card {
            max-width: 400px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <main class="container mt-5">
        <h4 class="text-center">Iniciar sesión</h4>
        
        <div class="card shadow-sm">
            <div class="card-body">

                <?php if (isset($mensaje)): ?>
                    <div class="alert alert-danger text-center" role="alert">
                        <strong><?php echo $mensaje; ?></strong>
                    </div>
                <?php endif; ?>

                <form action="" method="post">

                    <div class="mb-3">
                        <label for="cuenta" class="form-label">Cuenta:</label>
                        <input type="text" class="form-control" name="cuenta" id="cuenta" placeholder="Escriba su cuenta" required/>
                    </div>

                    <div class="mb-3">
                        <label for="clave" class="form-label">Clave:</label>
                        <input type="password" class="form-control" name="clave" id="clave" placeholder="Escriba su clave" required/>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">Ingresar</button>
                    </div>

                </form>

            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
