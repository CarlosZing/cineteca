<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("SELECT * FROM peliculas WHERE id_Pelicula = :id_Pelicula");
    $sentencia->bindParam(":id_Pelicula", $txtID);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_LAZY);

    $Pelicula = $registro["Pelicula"];
    $Existencia = $registro["Existencia"];
    $Disponible = $registro["Disponible"];
}

if($_POST){
    $txtID = isset($_POST['txtID']) ? $_POST['txtID'] : "";
    $Pelicula = isset($_POST["Pelicula"]) ? $_POST["Pelicula"] : "";
    $Existencia = isset($_POST["Existencia"]) ? $_POST["Existencia"] : "";
    $Disponible = isset($_POST["Disponible"]) ? $_POST["Disponible"] : "";

    $sentencia = $conexion->prepare("UPDATE peliculas SET Pelicula=:Pelicula, Existencia=:Existencia, Disponible=:Disponible WHERE id_Pelicula=:id_Pelicula");
    $sentencia->bindParam(":Pelicula", $Pelicula);
    $sentencia->bindParam(":Existencia", $Existencia);
    $sentencia->bindParam(":Disponible", $Disponible);
    $sentencia->bindParam(":id_Pelicula", $txtID);
    $sentencia->execute();

    $mensaje = "Película actualizada";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit;
}
?>

<?php include ("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Editar Película</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="txtID" class="form-label">ID</label>
                    <input type="text" value="<?php echo htmlspecialchars($txtID); ?>" class="form-control" readonly name="txtID" id="txtID" />
                </div>

                <div class="mb-3">
                    <label for="Pelicula" class="form-label">Nombre de la Película:</label>
                    <input type="text" value="<?php echo htmlspecialchars($Pelicula); ?>" class="form-control" name="Pelicula" id="Pelicula" />
                </div>

                <div class="mb-3">
                    <label for="Existencia" class="form-label">Existencia:</label>
                    <input type="number" value="<?php echo htmlspecialchars($Existencia); ?>" class="form-control" name="Existencia" id="Existencia" />
                </div>

                <div class="mb-3">
                    <label for="Disponible" class="form-label">Disponible:</label>
                    <input type="number" value="<?php echo htmlspecialchars($Disponible); ?>" class="form-control" name="Disponible" id="Disponible" />
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include ("../../templates/footer.php"); ?>
