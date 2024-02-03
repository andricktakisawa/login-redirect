<?php
include '../settings/conn.php';

session_start();

$errors = array();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();


    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $stored_hashed_password = $row["password"];

        if (password_verify($password, $stored_hashed_password)) {
            session_start();
            $_SESSION["email"] = $email;
            echo json_encode(array('success' => true, header("location: dashboard.php")));
        } else {
            $errors['login'] = "La contraseña ingresada es incorrecta";
            echo json_encode(array('success' => false, 'errors' => $errors));
        }
    } else {
        $errors['login'] = "Usuario no existente";
        echo json_encode(array('success' => false, 'errors' => $errors));
    }
}

$conn->close();
