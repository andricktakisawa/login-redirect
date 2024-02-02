<?php
include 'settings/conn.php';

$email = $_POST['email'];
$password = $_POST['password'];
$curp = $_POST['curp'];

$errors = array();

$sql = "SELECT * FROM customers WHERE email = '$email' AND password = '$password' AND curp = '$curp'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $platform_url = $row['platform_url'];

    echo json_encode(array('success' => true, 'redirect_url' => $platform_url));
} else {
    $errors['login'] = "Credenciales inválidas";
    echo json_encode(array('success' => false, 'errors' => $errors));
}

$conn->close();
