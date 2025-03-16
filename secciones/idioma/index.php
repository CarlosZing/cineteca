<?php
$url_base="http://localhost/Cineteca/";
?>

<!doctype html>
<html lang="es">
<head>
    <title>Cambiar Idioma</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" />
</head>
<body>
    <main class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <br/><br/>
                <div class="card">
                    <div class="card-header text-center">Cambiar Idioma</div>
                    <div class="card-body">
                        <form action="" method="post">
                            <div class="mb-3">
                                <label for="contraseña" class="form-label">Introduce tu contraseña:</label>
                                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Ingrese su contraseña" required/>
                            </div>
                            
                            <div class="mb-3">
                                <label for="idioma" class="form-label">Selecciona el idioma:</label>
                                <select class="form-control" name="idioma" id="idioma" required>
                                    <option value="es">Español</option>
                                    <option value="en">Inglés</option>
                                </select>
                            </div>

                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-success">Actualizar Idioma</button>
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
