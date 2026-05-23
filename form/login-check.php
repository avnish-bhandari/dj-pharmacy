<?php
require __DIR__ . "/config.php";

/* Agar direct open kare to login page bhej do */
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

if ($username === ADMIN_USER && $password === ADMIN_PASS) {

    $_SESSION['admin_logged'] = true;

    // ✅ POST ke baad REDIRECT (MOST IMPORTANT)
    header("Location: dashboard.php");
    exit;

} else {

    // ❌ Wrong login → back to index.php
    header("Location: index.php?error=1");
    exit;
}
