<?php

include '../settings/conn.php';

$users = [
    ['name' => 'Andrick Takisawa', 'email' => 'andrick@incote.click', 'password' => 'admin'],
    ['name' => 'José Rivera', 'email' => 'jriver@cwa.mx', 'password' => 'admin'],
];

foreach ($users as $user) {
    $name = $user['name'];
    $email = $user['email'];
    $plain_password = $user['password'];

    $hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO admins (name, email, password) VALUES ('$name', '$email', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario insertado correctamente: $name\n";
    } else {
        echo "Error al insertar usuario: " . $conn->error . "\n";
    }
}

$conn->close();
