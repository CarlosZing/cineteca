<?php

$servidor = getenv('MYSQLHOST'); // No uses 'localhost', Railway asigna un host diferente
$baseDeDatos = getenv('MYSQLDATABASE'); // Nombre de la BD en Railway
$usuario = getenv('MYSQLUSER'); // Usuario asignado por Railway
$contrasenia = getenv('MYSQLPASSWORD'); // Contraseña generada
$puerto = getenv('MYSQLPORT'); // Puerto asignado dinámicamente

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
