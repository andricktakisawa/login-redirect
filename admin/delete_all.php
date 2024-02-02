<?php
include '../settings/conn.php';


// Consulta para eliminar todos los usuarios
$sql = "DELETE FROM customers";
if ($conn->query($sql) === TRUE) {
    echo "Todos los usuarios han sido eliminados correctamente";
} else {
    echo "Error al eliminar usuarios: " . $conn->error;
}

$conn->close();
