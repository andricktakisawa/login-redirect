<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $userPassword = $_POST['password'];
    $curp = $_POST['curp'];
    $platformUrl = $_POST['url'];

    include '../settings/conn.php';

    $conn = new mysqli(
        $servername,
        $username,
        $password,
        $dbname
    );

    if ($conn->connect_error) {
        die("Conexión fallida: " . $conn->connect_error);
    }

    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $userPassword = $conn->real_escape_string($userPassword);
    $curp = $conn->real_escape_string($curp);
    $platformUrl = $conn->real_escape_string($platformUrl);

    // Consulta para insertar el nuevo usuario
    $sql = "INSERT INTO customers (name, email, password, curp, platform_url) VALUES ('$name', '$email', '$userPassword', '$curp', '$platformUrl')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo "Error al insertar el usuario: " . $conn->error;
    }

    // Cerrar la conexión
    $conn->close();
}
