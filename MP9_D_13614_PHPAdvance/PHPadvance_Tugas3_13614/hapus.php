<?php
    require 'koneksi.php';

        $id = (['id'] ?? '');

        if( $id === '' || !ctype_digit($id)){
            echo  '<p style="color: red;">Id tidak valid. </p>';
        }  else{
            $query = 'DELETE FROM film WHERE id = ?';
            $stmt = mysqli_prepare($conn, $query );
            mysqli_stmt_bind_param($stmt, 'i', $id);
            mysqli_stmt_execute($stmt);
            if(mysqli_stmt_affected_rows($stmt)===1){
                echo '<p> Data berhasil dihapus</p>';
            }else{
                echo '<p> Data ridak ketemu</p>';
            }

            
        }

    echo '<a href="index.php">kembali</a>';
?>