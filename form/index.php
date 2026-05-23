<!DOCTYPE html>
<html>
<head>
<title>Admin Login</title>
<style>
body{
    margin:0;
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background:#f4f6fb;
    font-family:system-ui;
}
.login-box{
    width:380px;
    background:#fff;
    padding:35px;
    border-radius:14px;
    box-shadow:0 10px 30px rgba(0,0,0,.1);
}
.logo{
    text-align:center;
    margin-bottom:20px;
}
.logo img{
    height:70px;
}
h3{
    text-align:center;
    margin-bottom:20px;
}
input{
    width:100%;
    padding:12px;
    margin-bottom:15px;
    border-radius:8px;
    border:1px solid #ddd;
}
button{
    width:100%;
    padding:12px;
    background:#6c3ef0;
    color:#fff;
    border:none;
    border-radius:8px;
    font-size:16px;
    cursor:pointer;
}
</style>
</head>
<body>

<div class="login-box">
    <div class="logo">
        <img src="../logo.png" alt="College Logo">
    </div>

    <h3>Admin Login</h3>

    <form method="POST" action="login-check.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
    </form>
    <?php if (isset($_GET['error'])) { ?>
    <p style="color:red;">Invalid username or password</p>
<?php } ?>
</div>
    

</body>
</html>
