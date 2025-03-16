<?php
include("../../../bd.php");

if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

try {
    // Consulta SQL para obtener las rentas por usuario
    $query = "SELECT Usuario, total 
              FROM Usuarios 
              JOIN (SELECT id_usuario, COUNT(id_renta) AS total 
                    FROM rentas 
                    GROUP BY id_usuario) t 
              ON Usuarios.id_usuario = t.id_usuario";
    
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $rentasUsuario = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Rentas por Usuario</title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Reporte de Rentas por Usuario</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Total de Rentas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rentasUsuario)) { ?>
                            <?php foreach ($rentasUsuario as $renta) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($renta['Usuario'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($renta['total'], ENT_QUOTES, 'UTF-8'); ?></td>
                                </tr>
                            <?php } ?>
                        <?php } else { ?>
                            <tr>
                                <td colspan="2" class="text-center">No hay datos disponibles</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Incluir jQuery, Popper.js y Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
