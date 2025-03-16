<?php
$url_base="http://localhost/Cineteca/";
?>

<!doctype html>
<html lang="es">
<head>
    <title>Cambiar Contraseña</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <main class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow-sm">
                    <div class="card-header text-center">Cambiar Contraseña</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="contraseña_actual" class="form-label">Contraseña Actual:</label>
                                <input type="password" class="form-control" name="contraseña_actual" id="contraseña_actual" placeholder="Ingrese su contraseña actual" required/>
                            </div>
                            
                            <div class="mb-3">
                                <label for="nueva_contraseña" class="form-label">Nueva Contraseña:</label>
                                <input type="password" class="form-control" name="nueva_contraseña" id="nueva_contraseña" placeholder="Ingrese su nueva contraseña" required/>
                            </div>

                            <div class="mb-3">
                                <label for="repetir_contraseña" class="form-label">Repetir Nueva Contraseña:</label>
                                <input type="password" class="form-control" name="repetir_contraseña" id="repetir_contraseña" placeholder="Repita su nueva contraseña" required/>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Actualizar Contraseña</button>
                                
                                <a class="btn btn-primary" href="<?php echo $url_base; ?>index.php" role="button">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
