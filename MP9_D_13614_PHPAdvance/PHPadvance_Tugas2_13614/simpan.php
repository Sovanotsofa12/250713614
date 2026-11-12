<?php
    require 'koneksi.php';

    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $judul = trim($_POST['judul'] ?? '');
        $genre = trim($_POST['genre'] ?? '');
        $rating = trim($_POST['rating'] ?? '');

        if($judul === '' || $genre === '' || $rating === ''){
            echo  '<p style="color: red;">HARAp lengkapis smeua data. </p>';
        } elseif (!ctype_digit($rating) || $rating < 1 || $rating > 10){
            echo '<p style="color: red;">rating harus 1-10. </p>';
        } else{
            $stmt = mysqli_prepare($conn, 'INSERT INTO film(judul, genre, rating) VALUES (?,?,?)');
            mysqli_stmt_bind_param($stmt, 'ssi', $judul, $genre, $rating);
            mysqli_stmt_execute($stmt);

            echo '<p> Data berhasil disimpan ('. mysqli_stmt_affected_rows($stmt) . 'baris)</p>';
        }
    }else{
        echo '<p>silahkan isi formulir terlebih dahulu .</p>';
    }

    echo '<a href="index.xhtml">kembali</a>';
?>