function fn_valrom(){
    var sMsg="";
    var info;
    var pilihan;

    if (document.getElementById("nama").value==""){
        sMsg += "\n* Anda belum mengisikan nama";
    }

    if (document.getElementById("email").value==""){
         sMsg += "\n* Anda belum mengisikan email";
    }

    if (document.getElementById("umur").value==""){
        sMsg += "\n* Anda belum mengisikan pertanyaan";
    }

    if (document.getElementById("kategori").value==""){
        sMsg += "\n* Anda belum mengisikan kategori";
    }

    

    if (document.getElementById("umur").value <=25) {
        info = " Peserta Mahasiswa";
    }else{
        info = " Peserta Umum";
    }

    switch (document.getElementById("kategori").value) {
            case "W":
                pilihan = " Workshop";
                break;
            case "S":
                pilihan = " Seminar";
                break;
            
            case "L":
                pilihan = " Lomba Coding";
            
                break;
            
            default:
                 pilihan = " tidak tersedia";
                break;
        }
    
    if (sMsg != ""){
        alert("peringatan:\n" + sMsg);
        return false;
    }else{
         alert("Terima kasih " + document.getElementById("nama").value + " ! Anda terdaftar di acara" + pilihan + info);
        return true;;
    }
 
}


