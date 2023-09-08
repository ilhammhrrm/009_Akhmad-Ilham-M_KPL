<?php
include("koneksi.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

    if ($conn->query($sql) === TRUE) {
        echo "Pendaftaran berhasil!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="center-box">
            <h2>Sign Up</h2></br>
            <form action="" method="POST">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
                </br>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                </br>
                <input type="submit" value="Sign Up">
            </form>
            <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
        </div>
    </div>
</body>
</html>
