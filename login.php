<?php
include 'settings/conn.php';

$email = $_POST['email'];
$password = $_POST['password'];
$curp = $_POST['curp'];

$sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password' AND curp = '$curp'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $platform_url = $row['platform_url'];
    header("Location: $platform_url");
} else {
    echo "Credenciales inválidas";
}

// Cerrar la conexión
$conn->close();
