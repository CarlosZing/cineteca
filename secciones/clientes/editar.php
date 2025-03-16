<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM clientes WHERE id_Cliente = :id_Cliente");
    $sentencia->bindParam(":id_Cliente", $txtID);
    $sentencia->execute();
    
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $Cliente = $registro["Cliente"];
    $Domicilio = $registro["Domicilio"];
    $Celular = $registro["Celular"];
    
    $fotoPath = "../../uploads/" . $txtID . ".jpg";
    if (!file_exists($fotoPath)) {
        $fotoPath = "../../uploads/default.jpg"; // Usa una imagen predeterminada si no se encuentra la foto
    }
}

if ($_POST) {
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
    $Cliente = isset($_POST["Cliente"]) ? $_POST["Cliente"] : "";
    $Domicilio = isset($_POST["Domicilio"]) ? $_POST["Domicilio"] : "";
    $Celular = isset($_POST["Celular"]) ? $_POST["Celular"] : "";

    // Actualizar datos en la base de datos
    $sentencia = $conexion->prepare("UPDATE clientes SET Cliente = :Cliente, Domicilio = :Domicilio, Celular = :Celular WHERE id_Cliente = :id_Cliente");
    $sentencia->bindParam(":Cliente", $Cliente);
    $sentencia->bindParam(":Domicilio", $Domicilio);
    $sentencia->bindParam(":Celular", $Celular);
    $sentencia->bindParam(":id_Cliente", $txtID);
    $sentencia->execute();

    // Si se ha subido una nueva foto, se actualiza
    if (isset($_FILES["Foto"]["name"]) && $_FILES["Foto"]["name"] != "") {
        $fotoNombre = $txtID . ".jpg";
        $fotoTmp = $_FILES["Foto"]["tmp_name"];
        move_uploaded_file($fotoTmp, "../../uploads/" . $fotoNombre);
    }

    $mensaje = "Registro actualizado";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Editar Cliente</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="txtID" class="form-label">ID Cliente</label>
                    <input type="text" value="<?php echo $txtID; ?>" class="form-control" readonly name="txtID" id="txtID"/>
                </div>

                <div class="mb-3">
                    <label for="Cliente" class="form-label">Nombre del Cliente</label>
                    <input type="text" value="<?php echo $Cliente; ?>" class="form-control" name="Cliente" id="Cliente"/>
                </div>

                <div class="mb-3">
                    <label for="Domicilio" class="form-label">Domicilio</label>
                    <input type="text" value="<?php echo $Domicilio; ?>" class="form-control" name="Domicilio" id="Domicilio"/>
                </div>

                <div class="mb-3">
                    <label for="Celular" class="form-label">Celular</label>
                    <input type="text" value="<?php echo $Celular; ?>" class="form-control" name="Celular" id="Celular"/>
                </div>

                <div class="mb-3">
                    <label for="Foto" class="form-label">Foto</label>
                    <!-- Mostrar la imagen si existe, con un timestamp para evitar cachés en el navegador -->
                    <img src="<?php echo $fotoPath . "?v=" . time(); ?>" class="img-thumbnail mt-2" width="300"/>
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
