<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

/* ========= DB CONFIG (INFINITYFREE) ========= */
$host = "sql100.infinityfree.com";
$user = "if0_40471633";
$pass = "Test543210";   // ✅ NEW PASSWORD
$db   = "if0_40471633_djpharm";


/* ========= CONNECT ========= */
$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Database connection failed");
}

/* ========= CREATE TABLE ========= */
mysqli_query($conn, "
CREATE TABLE IF NOT EXISTS enquiries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(150) NOT NULL,
    email VARCHAR(150) NOT NULL,
    phone VARCHAR(30) NOT NULL,
    message TEXT NOT NULL,
    created_at DATETIME DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
");

/* ========= ADMIN LOGIN ========= */
define("ADMIN_USER", "admin");
define("ADMIN_PASS", "admin123");
