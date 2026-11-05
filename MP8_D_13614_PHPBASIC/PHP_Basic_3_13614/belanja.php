<?php

if($_POST){
    $bayaran = $_POST['bayaran']??'';
    $kode = $_POST['kode']??'';
    $harga = 50000;
    $message = array();
    $message2 = "";
    $bayaranKembali = 0;

    if(empty($bayaran) || empty($kode)){
        $message[] = "Harap lengkapi semua data.";
    }

    if(!preg_match("/^[0-9]*$/",$bayaran)){
        $message[] = "jumlah bayaran hanya boleh mengandung angka.";
    }

    if(!preg_match("/^[a-zA-Z]*$/",$kode)){
        $message[] = "kode bayaran hanya boleh mengandung huruf.";
    }

    if(!empty($message)){
        foreach($message as $msg){
            echo "<p style='color:red;'>!!". htmlspecialchars($msg) . "!!</p>";
        }
    }else{

        function kodeDiskon($kode){
            switch(strpolower($kode)){
                case 'p':
                    $diskon = 0.05;
                    break;
                case 'w':
                    $diskon = 0.02;
                    break;
                case 'd':
                    $diskon = 0.10;
                    break;
                default:
                    $diskon = 0;
            }
            return $diskon;
        }
        
        $diskon = kodeDiskon($kode);

        function totalBayar($harga, $diskon){
            return $harga - ($harga * $diskon);
        }

        $totalBayar = totalBayar($harga, $diskon);

        function pembayaran($bayaran, $totalBayar){
            if($bayaran < $totalBayar){
                return null;
            } else {
                $bayaranKembali = $bayaran - $totalBayar;
                return $bayaranKembali;
            }
        }

        $bayaranKembali = pembayaran($bayaran, $totalBayar);

        if($bayaranKembali == null){
            $message2 = "jumlah yang dibayar kurang dari total pembayaran. silahkan bayar sesuai dengan jumlah yang di tentukan.";
            $bayaranKembali = 0;
        }

        if(!empty($message2)){
            echo "<p style='color:red;'>!!" . htmlspecialchars($msg) . "!!</p>";
        }else{
            echo "<h2>Informasi Pembayaran</h2>";
            echo "<p><strong>Jumlah yang dibayar: </strong> Rp" . htmlspecialchars($bayaran) . "</p>";
            echo "<p><strong>kode diskon: </strong> Rp" . htmlspecialchars($kode) . "</p>";
        
            if($diskon == 0){
                echo "<p> Maaf kode diskon tidak valid. tidak ada diskon yang diberikan. </p>";
            }else{
                echo "<p>Selamat! anda mendapatkan diskon" . (htmlspecialchars($diskon*100)). "% berkat nomor kode diskon anda.</p>"
            }
            echo <p style="font-weight: bold; font_size: 18px;" >Total Pembayaran: </p>
        }

    }



}

?>