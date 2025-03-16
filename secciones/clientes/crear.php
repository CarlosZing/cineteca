<?php
include("../../bd.php");

if ($_POST) {
    $cliente = isset($_POST["cliente"]) ? $_POST["cliente"] : "";
    $domicilio = isset($_POST["domicilio"]) ? $_POST["domicilio"] : "";
    $celular = isset($_POST["celular"]) ? $_POST["celular"] : "";

    // Preparar sentencia para insertar el cliente en la base de datos
    $sentencia = $conexion->prepare("INSERT INTO clientes (Cliente, Domicilio, Celular) VALUES (:cliente, :domicilio, :celular);");
    $sentencia->bindParam(":cliente", $cliente);
    $sentencia->bindParam(":domicilio", $domicilio);
    $sentencia->bindParam(":celular", $celular);
    
    $sentencia->execute();

    // Obtener el ID del cliente recién insertado para asociar la foto
    $lastID = $conexion->lastInsertId();

    // Manejo de la foto
    if (isset($_FILES["Foto"]["name"]) && $_FILES["Foto"]["name"] != "") {
        // Si se sube una foto, se usa el ID del cliente como nombre de archivo
        $fotoNombre = $lastID . ".jpg";  // Usar el ID del cliente como nombre del archivo
        $fotoTmp = $_FILES["Foto"]["tmp_name"];
        
        // Mover la foto cargada a la carpeta de imágenes
        move_uploaded_file($fotoTmp, "../../uploads/" . $fotoNombre);
    } else {
        // Si no se selecciona una foto, asignar una foto predeterminada
        $fotoNombre = "default.jpg";  // Nombre de la foto por defecto
    }

    // Aquí puedes guardar el nombre de la foto (si es personalizada o predeterminada) en la base de datos si es necesario
    // $sentencia = $conexion->prepare("UPDATE clientes SET foto = :foto WHERE id_Cliente = :id_Cliente");
    // $sentencia->bindParam(":foto", $fotoNombre);
    // $sentencia->bindParam(":id_Cliente", $lastID);
    // $sentencia->execute();

    $mensaje = "Cliente agregado correctamente";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit();
}
?>

<?php include ("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Agregar Cliente</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="cliente" class="form-label">Nombre del Cliente</label>
                    <input type="text" class="form-control" name="cliente" id="cliente" required />
                </div>

                <div class="mb-3">
                    <label for="domicilio" class="form-label">Domicilio</label>
                    <input type="text" class="form-control" name="domicilio" id="domicilio" required />
                </div>

                <div class="mb-3">
                    <label for="celular" class="form-label">Celular</label>
                    <input type="text" class="form-control" name="celular" id="celular" required />
                </div>

                <div class="mb-3">
                    <label for="Foto" class="form-label">Foto</label>
                    <input type="file" class="form-control" name="Foto" id="Foto" />
                </div>

                <button type="submit" class="btn btn-success">Agregar Cliente</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include ("../../templates/footer.php"); ?>
