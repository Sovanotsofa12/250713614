<?php
session_start();
if (!isset($_SESSION['id_user'])) {
    header("Location: login.xhtml");
    exit;
}
include 'koneksi.php';

// crud kucing
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['tambah_kucing'])) {
    $nama   = mysqli_real_escape_string($conn, trim($_POST['nama_kucing']));
    $ciri   = mysqli_real_escape_string($conn, trim($_POST['ciri_fisik']));
    $lokasi = mysqli_real_escape_string($conn, trim($_POST['lokasi_nongkrong']));
    $status = mysqli_real_escape_string($conn, $_POST['status_kucing']);

    if (!empty($nama) && !empty($ciri) && !empty($lokasi)) {
        mysqli_query($conn, "INSERT INTO kucing (nama_kucing, ciri_fisik, lokasi_nongkrong, status_kucing) 
                             VALUES ('$nama', '$ciri', '$lokasi', '$status')");
        header("Location: index.php");
        exit;
    }
}

header("Content-Type: application/xhtml+xml; charset=UTF-8");
?>
<!DOCTYPE html  PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtmll1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="id" lang="id">
<head>
    <meta http-equiv="Content-Type" content="application/xhtml+xml; charset=UTF-8" />
    <title>Dashboard - CatTracker Local</title>
</head>
<body>
    <div class="navbar">
        <span>Halo, <strong><?php echo htmlspecialchars($_SESSION['username'], ENT_QUOTES, 'UTF-8'); ?></strong></span>
        <div>
            <a href="index.php">Dashboard</a> |
            <a href="profil.php">Profil Saya</a> |
            <a href="logout.php">Logout</a>
        </div>
    </div>

    <div class="container">
        <div class="card">
            <h2>1. Data Kucing Area Sekitar </h2>
            <form action="index.php" method="post">
                <div>
                    <label for="nama_kucing">Nama / Alias Kucing:</label><br />
                    <input type="text" name="nama_kucing" id="nama_kucing" /><br />

                    <label for="ciri_fisik">Ciri Fisik (Warna/Pola):</label><br />
                    <input type="text" name="ciri_fisik" id="ciri_fisik" /><br />

                    <label for="lokasi_nongkrong">Lokasi Nongkrong Utama:</label><br />
                    <input type="text" name="lokasi_nongkrong" id="lokasi_nongkrong" /><br />

                    <label for="status_kucing">Status:</label><br />
                    <select name="status_kucing" id="status_kucing">
                        <option value="Liar / Belum Steril">Liar / Belum Steril</option>
                        <option value="Sudah Steril">Sudah Steril</option>
                        <option value="Diadopsi">Diadopsi</option>
                    </select><br /><br />

                    <input type="submit" name="tambah_kucing" value="Tambah Kucing" class="btn" />
                </div>
            </form>

            <table class="data-table">
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Ciri Fisik</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $q_kucing = mysqli_query($conn, "SELECT * FROM kucing ORDER BY id_kucing DESC");
                    while ($k = mysqli_fetch_assoc($q_kucing)):
                    ?>
                    <tr>
                        <td><?php echo htmlspecialchars($k['nama_kucing'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($k['ciri_fisik'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($k['lokasi_nongkrong'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><?php echo htmlspecialchars($k['status_kucing'], ENT_QUOTES, 'UTF-8'); ?></td>
                        <td><em>  Edit / Hapus ( still work On Progress)</em></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <div class="card">
            <h2>2. Transaksi Log Penampakan &amp; Beri Makan </h2>
            <div class="status-wip">
                <strong>Status Pengerjaan:</strong> wip.
            </div>
        </div>
    </div>
</body>
</html>