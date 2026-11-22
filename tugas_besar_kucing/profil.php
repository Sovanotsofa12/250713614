<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.xhtml");
    exit;
}
include 'koneksi.php';
$id_user = $_SESSION['id_user'];

$res  = mysqli_query($conn, "SELECT * FROM users WHERE id_user = $id_user");
$user = mysqli_fetch_assoc($res);

header("Content-Type: application/xhtml+xml; charset=UTF-8");
?>
<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtmll1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Profil Pengguna - CatTracker Local</title>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
</head>
<body>
    <div class="navbar">
        <span>Profil: <strong>@<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></strong></span>
        <div>
            <a href="index.php">Dashboard</a> |
            <a href="profil.php">Profil Saya</a> |
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container auth-box">
        <h2>Profil Saya</h2>
        <p><strong>Username:</strong> @<?php echo htmlspecialchars($user['username'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Nama Lengkap:</strong> <?php echo htmlspecialchars($user['nama_lengkap'], ENT_QUOTES, 'UTF-8'); ?></p>
        <p><strong>Bio:</strong> <?php echo htmlspecialchars($user['bio'], ENT_QUOTES, 'UTF-8'); ?></p>
        <div class="status-wip">
            Fitur update profil dan ganti password sedang wip.
        </div>
    </div>
</body>
</html>