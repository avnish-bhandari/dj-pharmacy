<?php
require __DIR__ . "/config.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: https://test-phar.22web.org/contact.php#contact");
    exit;
}

$name    = trim($_POST['full_name'] ?? '');
$email   = trim($_POST['email'] ?? '');
$phone   = trim($_POST['phone'] ?? '');
$message = trim($_POST['message'] ?? '');

if (!$name || !$email || !$phone || !$message) {
    header("Location: https://test-phar.22web.org/contact.php#contact?error=1");
    exit;
}

/* 🔒 SAME DAY DUPLICATE CHECK */
$checkSql = "
    SELECT id FROM enquiries
    WHERE (email='$email' OR phone='$phone')
    AND DATE(created_at)=CURDATE()
    LIMIT 1
";
$check = mysqli_query($conn, $checkSql);

if (mysqli_num_rows($check) > 0) {
    header("Location: https://test-phar.22web.org/contact.php#contact?already=1");
    exit;
}

/* ✅ INSERT */
$insertSql = "
    INSERT INTO enquiries (full_name,email,phone,message)
    VALUES ('$name','$email','$phone','$message')
";
mysqli_query($conn, $insertSql);

/* 🔁 REDIRECT (NO RESUBMIT ISSUE) */
header("Location: https://test-phar.22web.org/contact.php#contact?success=1");
exit;
