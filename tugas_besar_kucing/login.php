<?php
session_start();
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password = $_POST['password'];

    $query  = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) === 1) {
        $row = mysqli_fetch_assoc($result);
        if (password_verify($password, $row['password'])) {
            $_SESSION['id_user']  = $row['id_user'];
            $_SESSION['username'] = $row['username'];
            header("Location: index.php");
            exit;
        }
    }
    echo "<script>alert('Username atau password salah!'); window.location='login.xhtml';</script>";
} else {
    header("Location: login.xhtml");
}
?>