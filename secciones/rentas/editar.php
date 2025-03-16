<?php
include("../../bd.php");

// Inicializar variables vacías
$id_renta = $id_cliente = $id_pelicula = $id_usuario = $solicitado = $entregado = $devuelto = $monto = "";

// Verificar si se recibió un id_renta por GET
if (isset($_GET['txtID']) && !empty($_GET['txtID'])) {
    $id_renta = $_GET['txtID'];

    // Obtener la información de la renta desde la base de datos
    $sentencia = $conexion->prepare("SELECT * FROM rentas WHERE id_Renta = :id_renta");
    $sentencia->bindParam(":id_renta", $id_renta, PDO::PARAM_INT);
    $sentencia->execute();
    $registro = $sentencia->fetch(PDO::FETCH_ASSOC);

    // Si se encontró el registro, asignar los valores a las variables
    if ($registro) {
        $id_cliente = $registro["id_Cliente"];
        $id_pelicula = $registro["id_Pelicula"];
        $id_usuario = $registro["id_Usuario"];
        $solicitado = $registro["Solicitado"];
        $entregado = $registro["Entregado"];
        $devuelto = $registro["Devuelto"];
        $monto = $registro["Monto"];
    }
}

// Si se envía el formulario por POST, actualizar los datos
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id_renta'])) {
    $id_renta = $_POST['id_renta'];
    $id_cliente = $_POST['id_cliente'];
    $id_pelicula = $_POST['id_pelicula'];
    $id_usuario = $_POST['id_usuario'];
    $solicitado = $_POST['solicitado'];
    $entregado = $_POST['entregado'];
    $devuelto = $_POST['devuelto'];
    $monto = $_POST['monto'];

    // Validar que los campos principales no estén vacíos
    if (!empty($id_renta) && !empty($id_cliente) && !empty($id_pelicula) && !empty($id_usuario)) {
        // Actualizar la renta en la base de datos
        $sentencia = $conexion->prepare("UPDATE rentas SET 
            id_Cliente = :id_cliente, 
            id_Pelicula = :id_pelicula, 
            id_Usuario = :id_usuario, 
            Solicitado = :solicitado, 
            Entregado = :entregado, 
            Devuelto = :devuelto, 
            Monto = :monto 
            WHERE id_Renta = :id_renta");

        $sentencia->bindParam(":id_cliente", $id_cliente, PDO::PARAM_INT);
        $sentencia->bindParam(":id_pelicula", $id_pelicula, PDO::PARAM_INT);
        $sentencia->bindParam(":id_usuario", $id_usuario, PDO::PARAM_INT);
        $sentencia->bindParam(":solicitado", $solicitado);
        $sentencia->bindParam(":entregado", $entregado);
        $sentencia->bindParam(":devuelto", $devuelto);
        $sentencia->bindParam(":monto", $monto, PDO::PARAM_STR);
        $sentencia->bindParam(":id_renta", $id_renta, PDO::PARAM_INT);
        $sentencia->execute();

        $mensaje = "Registro actualizado correctamente";
        header("Location: index.php?mensaje=" . urlencode($mensaje));
        exit;
    }
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Editar Renta</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post">

                <div class="mb-3">
                    <label for="id_renta" class="form-label">ID Renta</label>
                    <input type="text" class="form-control" name="id_renta" value="<?php echo htmlspecialchars($id_renta); ?>" readonly>
                </div>

                <div class="mb-3">
                    <label for="id_cliente" class="form-label">ID Cliente</label>
                    <input type="text" class="form-control" name="id_cliente" value="<?php echo htmlspecialchars($id_cliente); ?>">
                </div>

                <div class="mb-3">
                    <label for="id_pelicula" class="form-label">ID Película</label>
                    <input type="text" class="form-control" name="id_pelicula" value="<?php echo htmlspecialchars($id_pelicula); ?>">
                </div>

                <div class="mb-3">
                    <label for="id_usuario" class="form-label">ID Usuario</label>
                    <input type="text" class="form-control" name="id_usuario" value="<?php echo htmlspecialchars($id_usuario); ?>">
                </div>

                <div class="mb-3">
                    <label for="solicitado" class="form-label">Fecha Solicitado</label>
                    <input type="date" class="form-control" name="solicitado" value="<?php echo htmlspecialchars($solicitado); ?>">
                </div>

                <div class="mb-3">
                    <label for="entregado" class="form-label">Fecha Entregado</label>
                    <input type="date" class="form-control" name="entregado" value="<?php echo htmlspecialchars($entregado); ?>">
                </div>

                <div class="mb-3">
                    <label for="devuelto" class="form-label">Fecha Devuelto</label>
                    <input type="date" class="form-control" name="devuelto" value="<?php echo htmlspecialchars($devuelto); ?>">
                </div>

                <div class="mb-3">
                    <label for="monto" class="form-label">Monto</label>
                    <input type="number" step="0.01" class="form-control" name="monto" value="<?php echo htmlspecialchars($monto); ?>">
                </div>

                <button type="submit" class="btn btn-success">Guardar Cambios</button>
                <a href="index.php" class="btn btn-primary">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
