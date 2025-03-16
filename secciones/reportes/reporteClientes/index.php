<?php
include("../../../bd.php");

$reporte = "Reporte de Clientes";
$tabla = "clientes";

// Obtener los datos usando PDO
try {
    $query = "SELECT * FROM $tabla";
    $stmt = $conexion->prepare($query);
    $stmt->execute();
    $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    die("Error en la consulta: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $reporte; ?></title>

    <!-- Incluir Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center"><?php echo $reporte; ?></h2>

    <div class="card shadow-sm">
        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered">
                    <thead class="thead-dark">
                        <tr>
                            <?php 
                            // Encabezados
                            if (!empty($resultado)) {
                                foreach (array_keys($resultado[0]) as $columna) {
                                    echo "<th>" . htmlspecialchars($columna) . "</th>";
                                }
                            } 
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        // Datos
                        if (!empty($resultado)) {
                            foreach ($resultado as $fila) {
                                echo "<tr>";
                                foreach ($fila as $valor) {
                                    echo "<td>" . htmlspecialchars($valor) . "</td>";
                                }
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='100%' class='text-center'>No hay datos disponibles</td></tr>";
                        }
                        ?>
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
