<?php
// config/db.php - Secure PDO database connection
define('DB_HOST', 'localhost');
define('DB_NAME', 'klinikaplus');
define('DB_USER', 'root');        // Change in production
define('DB_PASS', '');           // Change in production

try {
    $pdo = new PDO(
        "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8mb4",
        DB_USER,
        DB_PASS,
        [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    );
} catch (PDOException $e) {
    die("Database connection failed. Please check configuration.");
}
?>