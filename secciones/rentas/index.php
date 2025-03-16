<?php
include("../../bd.php");

if (isset($_GET['txtID'])) {
    $txtID = isset($_GET['txtID']) ? $_GET['txtID'] : "";

    $sentencia = $conexion->prepare("DELETE FROM rentas WHERE id_Renta = :id_Renta");
    $sentencia->bindParam(":id_Renta", $txtID);
    $sentencia->execute();

    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . urlencode($mensaje));
    exit();
}

$sentencia = $conexion->prepare("SELECT * FROM rentas");
$sentencia->execute();
$lista_rentas = $sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Rentas</h4>

    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar renta</a>
        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered" id="tabla_id">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Id Renta</th>
                            <th scope="col">Id Cliente</th>
                            <th scope="col">Id Pelicula</th>
                            <th scope="col">Id Usuario</th>
                            <th scope="col">Solicitado</th>
                            <th scope="col">Entregado</th>
                            <th scope="col">Devuelto</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_rentas as $registro) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registro['id_Renta']); ?></td>
                                <td><?php echo htmlspecialchars($registro['id_Cliente']); ?></td>
                                <td><?php echo htmlspecialchars($registro['id_Pelicula']); ?></td>
                                <td><?php echo htmlspecialchars($registro['id_Usuario']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Solicitado']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Entregado']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Devuelto']); ?></td>
                                <td><?php echo htmlspecialchars($registro['Monto']); ?></td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id_Renta']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="javascript:void(0);" onclick="borrar(<?php echo $registro['id_Renta']; ?>);" role="button">Eliminar</a>
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
    if (confirm("¿Seguro que deseas eliminar esta renta?")) {
        window.location.href = "index.php?txtID=" + id;
    }
}
</script>
