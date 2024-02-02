<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        include '../settings/conn.php';

        $userId = $_POST['id'];
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $curp = $_POST['curp'];
        $platform_url = $_POST['url'];

        $stmt = $conn->prepare("UPDATE customers SET name=?, email=?, password=?, curp=?, platform_url=? WHERE id=?");
        $stmt->bind_param("sssssi", $name, $email, $password, $curp, $platform_url, $userId);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
