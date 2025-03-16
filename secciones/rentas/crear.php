<?php
include("../../bd.php");

if($_POST){
    $Id_Cliente = $_POST["Id_Cliente"] ?? "";
    $Id_Pelicula = $_POST["Id_Pelicula"] ?? "";
    $Id_Usuario = $_POST["Id_Usuario"] ?? "";
    $Solicitado = $_POST["Solicitado"] ?? "";
    $Entregado = $_POST["Entregado"] ?? "";
    $Devuelto = $_POST["Devuelto"] ?? "";
    $Monto = $_POST["Monto"] ?? "";

    $sentencia = $conexion->prepare("INSERT INTO rentas (Id_Cliente, Id_Pelicula, Id_Usuario, Solicitado, Entregado, Devuelto, Monto) 
    VALUES (:Id_Cliente, :Id_Pelicula, :Id_Usuario, :Solicitado, :Entregado, :Devuelto, :Monto)");

    $sentencia->bindParam(":Id_Cliente", $Id_Cliente);
    $sentencia->bindParam(":Id_Pelicula", $Id_Pelicula);
    $sentencia->bindParam(":Id_Usuario", $Id_Usuario);
    $sentencia->bindParam(":Solicitado", $Solicitado);
    $sentencia->bindParam(":Entregado", $Entregado);
    $sentencia->bindParam(":Devuelto", $Devuelto);
    $sentencia->bindParam(":Monto", $Monto);

    $sentencia->execute();
    $mensaje = "Registro agregado";
    header("Location:index.php?mensaje=" . $mensaje);
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Agregar Renta</h4>

    <div class="card shadow-sm">
        <div class="card-body">
            <form action="" method="post">

                <div class="mb-3">
                    <label for="Id_Cliente" class="form-label">ID Cliente</label>
                    <input type="text" class="form-control" name="Id_Cliente" id="Id_Cliente" placeholder="ID Cliente" required>
                </div>

                <div class="mb-3">
                    <label for="Id_Pelicula" class="form-label">ID Película</label>
                    <input type="text" class="form-control" name="Id_Pelicula" id="Id_Pelicula" placeholder="ID Película" required>
                </div>

                <div class="mb-3">
                    <label for="Id_Usuario" class="form-label">ID Usuario</label>
                    <input type="text" class="form-control" name="Id_Usuario" id="Id_Usuario" placeholder="ID Usuario" required>
                </div>

                <div class="mb-3">
                    <label for="Solicitado" class="form-label">Fecha Solicitado</label>
                    <input type="date" class="form-control" name="Solicitado" id="Solicitado" required>
                </div>

                <div class="mb-3">
                    <label for="Entregado" class="form-label">Fecha Entregado</label>
                    <input type="date" class="form-control" name="Entregado" id="Entregado" required>
                </div>

                <div class="mb-3">
                    <label for="Devuelto" class="form-label">Fecha Devuelto</label>
                    <input type="date" class="form-control" name="Devuelto" id="Devuelto" required>
                </div>

                <div class="mb-3">
                    <label for="Monto" class="form-label">Monto</label>
                    <input type="number" step="0.01" class="form-control" name="Monto" id="Monto" placeholder="Monto" required>
                </div>

                <button type="submit" class="btn btn-success">Agregar registro</button>
                <a href="index.php" class="btn btn-primary">Cancelar</a>

            </form>
        </div>
    </div>
</div>

<?php include("../../templates/footer.php"); ?>
