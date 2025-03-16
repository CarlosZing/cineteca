<?php
include("../../bd.php");

if ($_POST) {
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $cuenta = (isset($_POST["cuenta"]) ? $_POST["cuenta"] : "");
    $clave = md5($cuenta); // La clave será la misma que "cuenta" cifrada con MD5
    $nivel = (isset($_POST["nivel"]) ? $_POST["nivel"] : "");
    $idioma = (isset($_POST["idioma"]) ? $_POST["idioma"] : "");

    // Verificar que el nivel e idioma estén entre 1 o 2
    if ($nivel != 1 && $nivel != 2) {
        die("El nivel debe ser 1 o 2");
    }
    if ($idioma != 1 && $idioma != 2) {
        die("El idioma debe ser 1 o 2");
    }

    // Preparar la sentencia SQL
    $sentencia = $conexion->prepare("INSERT INTO usuarios (usuario, cuenta, clave, nivel, idioma)
    VALUES (:usuario, :cuenta, :clave, :nivel, :idioma)");

    // Enlazar los parámetros
    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":cuenta", $cuenta);
    $sentencia->bindParam(":clave", $clave);
    $sentencia->bindParam(":nivel", $nivel);
    $sentencia->bindParam(":idioma", $idioma);
    
    // Ejecutar la sentencia
    $sentencia->execute();

    // Mensaje de éxito
    $mensaje = "Registro agregado";
    header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Agregar Usuario</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="usuario" class="form-label">Nombre del Usuario:</label>
                    <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario" required />
                </div>

                <div class="mb-3">
                    <label for="cuenta" class="form-label">Cuenta:</label>
                    <input type="text" class="form-control" name="cuenta" id="cuenta" placeholder="Cuenta de usuario" required />
                </div>

                <!-- La contraseña no es necesaria, se genera automáticamente -->
                <div class="mb-3">
                    <label for="clave" class="form-label">Clave:</label>
                    <input type="text" class="form-control" name="clave" id="clave" placeholder="Clave generada automáticamente" disabled />
                </div>

                <div class="mb-3">
                    <label for="nivel" class="form-label">Nivel:</label>
                    <select class="form-control" name="nivel" id="nivel" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idioma" class="form-label">Idioma:</label>
                    <select class="form-control" name="idioma" id="idioma" required>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Agregar</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
