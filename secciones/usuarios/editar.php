<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = (isset($_GET['txtID'])) ? ($_GET['txtID']) : "";

    $sentencia = $conexion->prepare("SELECT * FROM usuarios WHERE id_usuario=:id_usuario");
    $sentencia->bindParam(":id_usuario", $txtID);
    $sentencia->execute();

    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $usuario = $registro["usuario"];
    $cuenta = $registro["cuenta"];
    $nivel = $registro["nivel"];
    $idioma = $registro["idioma"];
}

if ($_POST) {
    $txtID = (isset($_POST["txtID"]) ? $_POST["txtID"] : "");
    $usuario = (isset($_POST["usuario"]) ? $_POST["usuario"] : "");
    $cuenta = (isset($_POST["cuenta"]) ? $_POST["cuenta"] : "");
    $nivel = (isset($_POST["nivel"]) ? $_POST["nivel"] : "");
    $idioma = (isset($_POST["idioma"]) ? $_POST["idioma"] : "");

    $sentencia = $conexion->prepare("UPDATE usuarios SET
        usuario=:usuario,
        cuenta=:cuenta,
        nivel=:nivel,
        idioma=:idioma
        WHERE id_usuario=:id_usuario
    ");

    $sentencia->bindParam(":usuario", $usuario);
    $sentencia->bindParam(":cuenta", $cuenta);
    $sentencia->bindParam(":nivel", $nivel);
    $sentencia->bindParam(":idioma", $idioma);
    $sentencia->bindParam(":id_usuario", $txtID);
    $sentencia->execute();

    $mensaje = "Registro actualizado";
    header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Editar Usuario</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="txtID" class="form-label">ID</label>
                    <input type="text" value="<?php echo htmlspecialchars($txtID); ?>" class="form-control" readonly name="txtID" id="txtID" />
                </div>

                <div class="mb-3">
                    <label for="usuario" class="form-label">Nombre del usuario:</label>
                    <input type="text" value="<?php echo htmlspecialchars($usuario); ?>" class="form-control" name="usuario" id="usuario" placeholder="Nombre del usuario" />
                </div>

                <div class="mb-3">
                    <label for="cuenta" class="form-label">Cuenta:</label>
                    <input type="text" value="<?php echo htmlspecialchars($cuenta); ?>" class="form-control" name="cuenta" id="cuenta" placeholder="Cuenta" />
                </div>

                <div class="mb-3">
                    <label for="nivel" class="form-label">Nivel:</label>
                    <select class="form-control" name="nivel" id="nivel">
                        <option value="1" <?php echo $nivel == 1 ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo $nivel == 2 ? 'selected' : ''; ?>>2</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="idioma" class="form-label">Idioma:</label>
                    <select class="form-control" name="idioma" id="idioma">
                        <option value="1" <?php echo $idioma == 1 ? 'selected' : ''; ?>>1</option>
                        <option value="2" <?php echo $idioma == 2 ? 'selected' : ''; ?>>2</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-success">Guardar cambios</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
