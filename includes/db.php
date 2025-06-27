<?php
$host = 'localhost';
$db   = 'testimonial_app';
$user = 'root'; // change if using hosting
$pass = '';     // change if using hosting

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
?>
