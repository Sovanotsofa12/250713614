var formDaftar = document.getElementById("formDaftar");
if (formDaftar) {
    formDaftar.onsubmit = function() {
        var nama = document.getElementById("nama_lengkap").value;
        var user = document.getElementById("username").value;
        var pass = document.getElementById("password").value;

        if (nama === "" || user === "" || pass === "") {
            alert("Semua kolom wajib diisi!");
            return false;
        }
        if (pass.length < 6) {
            alert("Password harus minimal 6 karakter!");
            return false;
        }
        return true;
    };
}

var formLogin = document.getElementById("formLogin");
if (formLogin) {
    formLogin.onsubmit = function() {
        var user = document.getElementById("username").value;
        var pass = document.getElementById("password").value;

        if (user === "" || pass === "") {
            alert("Username dan Password tidak boleh kosong!");
            return false;
        }
        return true;
    };
}