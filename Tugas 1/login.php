<?php
session_start();
include("koneksi.php");

if (isset($_SESSION['login_attempts']) && $_SESSION['login_attempts'] >= 3 && time() - $_SESSION['login_time'] < 1800) {
    $time_left = 1800 - (time() - $_SESSION['login_time']);
    echo "Anda telah mencoba login terlalu banyak. Silakan coba lagi dalam " . gmdate("i", $time_left) . " menit.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $sql = "SELECT id, username, password FROM users WHERE username = '$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            $_SESSION["user_id"] = $row["id"];
            $_SESSION['login_attempts'] = 0;
            echo "Login berhasil!";
        } else {
            $_SESSION['login_attempts'] = isset($_SESSION['login_attempts']) ? $_SESSION['login_attempts'] + 1 : 1;
            echo "Kata sandi salah.";
        }
    } else {
        echo "Pengguna tidak ditemukan.";
    }
    
    $_SESSION['login_time'] = time();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="center-box">
            <h2>Login</h2></br>
            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                </br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                </br>
                <input type="submit" value="Login">
            </form>
            <p>Belum punya akun? <a href="signup.php">Daftar di sini</a></p>
        </div>
    </div>
</body>
</html>
