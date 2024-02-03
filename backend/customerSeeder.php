<?php

require_once '../vendor/autoload.php';
require_once '../settings/conn.php';

use Faker\Factory as FakerFactory;

$faker = FakerFactory::create();

$host = 'localhost';
$dbname = 'tumediclogin';
$username = 'root';
$password = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error: " . $e->getMessage());
}

$registerNumbers = 50;

for ($i = 0; $i < $registerNumbers; $i++) {
    $name = $faker->name;
    $email = $faker->unique()->email;
    $password = 'TuMedic2024**';
    $curp = $faker->regexify('[A-Z]{4}[0-9]{6}[HM][A-Z]{5}[0-9A-Z]{2}');
    $platformUrl = 'https://' . $faker->firstName . '.tumedic.mx';

    // Inserta los datos en la base de datos
    $stmt = $pdo->prepare("INSERT INTO customers (name, email, password, curp, platform_url) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$name, $email, $password, $curp, $platformUrl]);
}

echo "Seeder ejecutado con éxito.\n";
