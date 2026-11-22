<?php
include 'koneksi.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_lengkap = mysqli_real_escape_string($conn, trim($_POST['nama_lengkap']));
    $username     = mysqli_real_escape_string($conn, trim($_POST['username']));
    $password_raw = $_POST['password'];

    if (empty($nama_lengkap) || empty($username) || strlen($password_raw) < 6) {
        echo "<script>alert('Data tidak lengkap atau password kurang dari 6 karakter!'); window.location='pendaftaran.xhtml';</script>";
        exit;
    }

    // kalo nama user sama, balik pendaftaran.xhtml
    $cek = mysqli_query($conn, "SELECT id_user FROM users WHERE username = '$username'");
    if (mysqli_num_rows($cek) > 0) {
        echo "<script>alert('Username sudah dipakai, silakan gunakan username lain!'); window.location='pendaftaran.xhtml';</script>";
        exit;
    }

    // Enkripsi 
    $password_hash = password_hash($password_raw, PASSWORD_DEFAULT);
    $bio_default   = "Pecinta kucing lokal.";

    $query = "INSERT INTO users (username, password, nama_lengkap, bio) 
              VALUES ('$username', '$password_hash', '$nama_lengkap', '$bio_default')";

    if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registrasi berhasil! Silakan login.'); window.location='login.xhtml';</script>";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    header("Location: pendaftaran.xhtml");
}
?>