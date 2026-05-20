<?php

$host = 'localhost';      // Servidor de base de datos
$dbname = 'shoponline_huila';  // Nombre de nuestra BD
$username = 'root';       // Usuario de MySQL (por defecto en XAMPP es 'root')
$password = '';           // Contraseña (por defecto está vacía)

try {
    // Crear conexión usando PDO
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    
    // Configurar PDO para que muestre errores
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    
} catch(PDOException $e) {
    // Si hay error, mostrar mensaje y detener ejecución
    die("Error de conexión a la base de datos: " . $e->getMessage());
}
?>