<?php
include("../../bd.php");

$sentencia = $conexion->prepare("SELECT * FROM usuarios");
$sentencia->execute();
$lista_tbl_usuarios = $sentencia->fetchALL(PDO::FETCH_ASSOC);

if (isset($_GET['txtID'])) {
    $txtID = (isset($_GET['txtID'])) ? ($_GET['txtID']) : "";

    $sentencia = $conexion->prepare("DELETE FROM usuarios WHERE id_usuario=:id_usuario");
    $sentencia->bindParam(":id_usuario", $txtID);
    $sentencia->execute();
    $mensaje = "Registro eliminado";
    header("Location:index.php?mensaje=" . $mensaje);
}

if (isset($_GET['reiniciar'])) {
    $id_usuario = $_GET['reiniciar'];
    $sentencia = $conexion->prepare("SELECT cuenta FROM usuarios WHERE id_usuario = :id_usuario");
    $sentencia->bindParam(":id_usuario", $id_usuario);
    $sentencia->execute();
    $usuario = $sentencia->fetch(PDO::FETCH_ASSOC);
    
    // Reiniciar la contraseña a la cuenta cifrada con MD5
    if ($usuario) {
        $cuenta = $usuario['cuenta'];
        $clave = md5($cuenta); // Cifrar con MD5

        $sentencia = $conexion->prepare("UPDATE usuarios SET clave = :clave WHERE id_usuario = :id_usuario");
        $sentencia->bindParam(":clave", $clave);
        $sentencia->bindParam(":id_usuario", $id_usuario);
        $sentencia->execute();
        
        $mensaje = "Contraseña reiniciada correctamente";
        header("Location:index.php?mensaje=" . $mensaje);
    }
}
?>

<?php include("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Usuarios</h4>
    
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <a class="btn btn-primary" href="crear.php" role="button">Agregar usuario</a>
        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered" id="tabla_id">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">ID Usuario</th>
                            <th scope="col">Usuario</th>
                            <th scope="col">Cuenta</th>
                            <th scope="col">Clave</th>
                            <th scope="col">Nivel</th>
                            <th scope="col">Idioma</th>
                            <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_tbl_usuarios as $registro) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($registro['id_usuario']); ?></td>
                                <td><?php echo htmlspecialchars($registro['usuario']); ?></td>
                                <td><?php echo htmlspecialchars($registro['cuenta']); ?></td>
                                <td><?php echo htmlspecialchars($registro['clave']); ?></td>
                                <td>
                                    <?php
                                    // Nivel solo puede ser 1 o 2
                                    $nivel = $registro['nivel'];
                                    echo $nivel == 1 ? '1' : '2'; // Aseguramos que solo se muestre 1 o 2
                                    ?>
                                </td>
                                <td>
                                    <?php
                                    // Idioma solo puede ser 1 o 2
                                    $idioma = $registro['idioma'];
                                    echo $idioma == 1 ? '1' : '2'; // Aseguramos que solo se muestre 1 o 2
                                    ?>
                                </td>
                                <td>
                                    <a class="btn btn-info" href="editar.php?txtID=<?php echo $registro['id_usuario']; ?>" role="button">Editar</a>
                                    |
                                    <a class="btn btn-danger" href="javascript:void(0);" onclick="borrar(<?php echo $registro['id_usuario']; ?>);" role="button">Eliminar</a>
                                    |
                                    <a class="btn btn-warning" href="index.php?reiniciar=<?php echo $registro['id_usuario']; ?>" role="button">Reiniciar contraseña</a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function borrar(id){
        Swal.fire({
            title: '¿Desea eliminar el usuario?',
            showCancelButton: true,
            confirmButtonText: 'Sí',
            cancelButtonText: 'No',
            focusCancel: true
        }).then((result) => {
            if (result.isConfirmed) {
                window.location="index.php?txtID=" + id;
            }
        });
    }
</script>

<?php include("../../templates/footer.php"); ?>
