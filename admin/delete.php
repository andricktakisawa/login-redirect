<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {

        include '../settings/conn.php';

        $userId = $_POST['id'];

        $stmt = $conn->prepare("DELETE FROM customers WHERE id = ?");
        $stmt->bind_param("i", $userId);
        $stmt->execute();

        $stmt->close();
        $conn->close();

        header("Location: dashboard.php");
        exit();
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}
