<?php include ("../../templates/header.php"); ?>

<div class="container mt-5">
    <h4 class="text-center">Reportes</h4>
    
    <div class="card shadow-sm">
        <div class="card-header">
            <!-- Aquí puedes agregar algún contenido si lo necesitas -->
        </div>

        <div class="card-body">
            <div class="table-responsive-sm">
                <table class="table table-striped table-bordered" id="tabla_id">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Reporte</th>
                            <th scope="col">Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    // Definir reportes con rutas a sus respectivas carpetas
                    $reportes = [
                        "Reporte de clientes" => "reporteClientes/index.php",
                        "Reporte de películas" => "reportePeliculas/index.php",
                        "Reporte de rentas" => "reporteRentas/index.php",
                        "Reporte de rentas por cliente" => "reporteRentasCliente/index.php",
                        "Reporte de rentas por película" => "reporteRentasPelicula/index.php",
                        "Reporte de rentas por usuario" => "reporteRentasUsuario/index.php",
                        "Reporte de usuarios" => "reporteUsuarios/index.php"
                    ];
                    
                    foreach ($reportes as $nombre => $ruta) { ?>
                        <tr>
                            <td><?php echo htmlspecialchars($nombre); ?></td>
                            <td>
                                <a class="btn btn-primary" href="<?php echo htmlspecialchars($ruta); ?>" role="button">Generar</a>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php include ("../../templates/footer.php"); ?>
