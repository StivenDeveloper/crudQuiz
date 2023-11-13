<?php
session_start(); // Inicia la sesión para poder acceder a las variables de sesión

// Elimina todas las variables de sesión
session_unset();

// Destruye la sesión
session_destroy();

echo 'Debe cerrar sesión';

// Redirecciona a la página de inicio o a donde desees después del cierre de sesión
header("Location: ../login.php"); // Cambia "index.php" por la página a la que quieras redirigir
exit();
?>