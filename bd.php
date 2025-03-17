<?php

$servidor = $_ENV('MYSQLHOST'); // No uses 'localhost', Railway asigna un host diferente
$baseDeDatos = $_ENV('MYSQLDATABASE'); // Nombre de la BD en Railway
$usuario = $_ENV('MYSQLUSER'); // Usuario asignado por Railway
$contrasenia = $_ENV('MYSQLPASSWORD'); // Contraseña generada
$puerto = $_ENV('MYSQLPORT'); // Puerto asignado dinámicamente

try {
    // Incluye el puerto en la conexión
    $conexion = new PDO("mysql:host=$servidor;port=$puerto;dbname=$baseDeDatos", $usuario, $contrasenia);

    // Configurar PDO para lanzar excepciones en caso de error
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    echo "Conexión exitosa a la base de datos.";
} catch (Exception $ex) {
    echo "Error de conexión: " . $ex->getMessage();
}

?>
