<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM clientes WHERE id_Cliente = :id_Cliente");
    $sentencia->bindParam(":id_Cliente", $txtID);
    $sentencia->execute();

    $mensaje = "Cliente eliminado";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit();
}

$sentencia = $conexion->prepare("SELECT * FROM clientes");
$sentencia->execute();
$lista_clientes = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Clientes</h4>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <a name="" id="" class="btn btn-primary" href="crear.php" role="button">Agregar Cliente</a>
        </div>
    
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered" id="tabla_id">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Domicilio</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_clientes as $registro) { ?>
                            <tr>
                                <td scope="row"><?php echo htmlspecialchars($registro['id_Cliente']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Cliente']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Domicilio']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Celular']); ?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id_Cliente']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="javascript:void(0);" onclick="borrar(<?php echo $registro['id_Cliente']; ?>);" role="button">Eliminar</a>
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
    if (confirm("¿Seguro que deseas eliminar este cliente?")) {
        window.location.href = "index.php?txtID=" + id;
    }
}
</script>
