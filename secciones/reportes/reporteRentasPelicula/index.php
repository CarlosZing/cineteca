<?php
include("../../../bd.php");

if (!$conexion) {
    die("Error de conexión a la base de datos.");
}

try {
    // Consulta SQL para obtener la cantidad de rentas por película
    $query = "SELECT Peliculas.pelicula AS Pelicula, COUNT(rentas.id_renta) AS Rentas
              FROM Peliculas
              LEFT JOIN rentas ON Peliculas.id_Pelicula = rentas.id_Pelicula
              GROUP BY Peliculas.pelicula
              ORDER BY Rentas DESC";
    
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $rentasPelicula = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reporte de Rentas por Película</title>
    
    <!-- Agregar el enlace a Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">Reporte de Rentas por Película</h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Película</th>
                            <th scope="col">Cantidad de Rentas</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($rentasPelicula)) { ?>
                            <?php foreach ($rentasPelicula as $fila) { ?>
                                <tr>
                                    <td><?php echo htmlspecialchars($fila['Pelicula'], ENT_QUOTES, 'UTF-8'); ?></td>
                                    <td><?php echo htmlspecialchars($fila['Rentas'], ENT_QUOTES, 'UTF-8'); ?></td>
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

<!-- Agregar el enlace a Bootstrap JS y Popper.js para completar el funcionamiento -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
