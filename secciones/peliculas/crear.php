<?php
include("../../bd.php");

if($_POST){
    // Recolectar datos del método POST
    $pelicula = isset($_POST["Pelicula"]) ? $_POST["Pelicula"] : "";
    $existencia = isset($_POST["Existencia"]) ? $_POST["Existencia"] : 0;
    $disponible = isset($_POST["Disponible"]) ? $_POST["Disponible"] : 0;

    // Preparar inserción de datos
    $sentencia = $conexion->prepare("INSERT INTO peliculas (Pelicula, Existencia, Disponible) VALUES (:Pelicula, :Existencia, :Disponible)");
    
    // Asignando los valores que vienen del formulario
    $sentencia->bindParam(":Pelicula", $pelicula);
    $sentencia->bindParam(":Existencia", $existencia);
    $sentencia->bindParam(":Disponible", $disponible);
    $sentencia->execute();
    
    $mensaje = "Película agregada";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit;
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Agregar Película</h4>

    <div class="card shadow-sm">
        <div class="card-body">
        
            <form action="" method="post" enctype="multipart/form-data">

                <div class="mb-3">
                    <label for="Pelicula" class="form-label">Nombre de la Película:</label>
                    <input type="text" class="form-control" name="Pelicula" id="Pelicula" placeholder="Nombre de la Película" required/>
                </div>
                
                <div class="mb-3">
                    <label for="Existencia" class="form-label">Existencia:</label>
                    <input type="number" class="form-control" name="Existencia" id="Existencia" placeholder="Cantidad en existencia" required/>
                </div>
                
                <div class="mb-3">
                    <label for="Disponible" class="form-label">Disponible:</label>
                    <input type="number" class="form-control" name="Disponible" id="Disponible" placeholder="Cantidad disponible" required/>
                </div>
                
                <button type="submit" class="btn btn-success">Agregar</button>
                <a name="" id="" class="btn btn-primary" href="index.php" role="button">Cancelar</a>
            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
