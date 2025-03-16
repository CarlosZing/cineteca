<?php
include("../../bd.php");

if(isset($_GET['txtID'])){
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM peliculas WHERE id_Pelicula = :id_Pelicula");
    $sentencia->bindParam(":id_Pelicula", $txtID);
    $sentencia->execute();
    
    $mensaje = "Película eliminada";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit;
}

$sentencia = $conexion->prepare("SELECT * FROM peliculas");
$sentencia->execute();
$lista_peliculas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Películas</h4>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar Película</a>
        </div>
        
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered" id="tabla_id">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Película</th>
                            <th scope="col">Existencia</th>
                            <th scope="col">Disponible</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_peliculas as $registro) { ?>
                            <tr>
                                <td scope="row"><?php echo htmlspecialchars($registro['id_Pelicula']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Pelicula']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Existencia']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Disponible']); ?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id_Pelicula']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="javascript:void(0);" onclick="borrar(<?php echo $registro['id_Pelicula']; ?>);" role="button">Eliminar</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>

<!-- Modal para confirmar eliminación -->
<script>
    function borrar(id) {
        if (confirm("¿Seguro que deseas eliminar esta película?")) {
            window.location.href = "index.php?txtID=" + id;
        }
    }
</script>
