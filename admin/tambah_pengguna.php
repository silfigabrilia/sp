<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $nama_lengkap = $_POST['nama_lengkap'];
        $jenis_kelamin = $_POST['jenis_kelamin'];
        $umur = $_POST['umur'];
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Validasi di sisi server untuk memastikan semua input telah diisi
        if (!empty($nama_lengkap) && !empty($jenis_kelamin) && !empty($umur) && !empty($username) && !empty($password)) {
            // data akun
            mysqli_query($conn, "INSERT INTO tb_akun(nama_lengkap, username, password, level) 
                VALUES ('$nama_lengkap', '$username', '$password', 'user')");

            // panggil id akun
            $data = mysqli_query($conn, "SELECT * FROM tb_akun ORDER BY id_akun DESC");
            $a = mysqli_fetch_array($data);

            //in data user
            mysqli_query($conn, "INSERT INTO tb_user(id_akun, nama_lengkap, jenis_kelamin, umur) 
                VALUES ('$a[id_akun]', '$nama_lengkap', '$jenis_kelamin', '$umur')");

            header("location:daftar_pengguna.php");
        } else {
            echo "<script>alert('Semua field harus diisi!');</script>";
        }
    }
}

include 'header.php';
?>

<div class="container">
    <div class="card shadow p-5 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Pengguna</h5>
        </div>

        <div class="card-body">
            <form action="tambah_pengguna.php?aksi=simpan" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" id="nama_lengkap" class="form-control">
                    <div class="error-message" id="nama_error" style="color:red; display:none;">
                        Nama lengkap harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label>Jenis Kelamin</label>
                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control">
                        <option value="" disabled selected>Pilih</option>
                        <option>Laki-Laki</option>
                        <option>Perempuan</option>
                    </select>
                    <div class="error-message" id="jk_error" style="color:red; display:none;">
                        Jenis kelamin harus dipilih!
                    </div>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" name="umur" id="umur" class="form-control">
                    <div class="error-message" id="umur_error" style="color:red; display:none;">
                        Umur harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label>Username</label>
                    <input type="text" name="username" id="username" class="form-control">
                    <div class="error-message" id="username_error" style="color:red; display:none;">
                        Username harus diisi!
                    </div>
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" id="password" class="form-control">
                    <div class="error-message" id="password_error" style="color:red; display:none;">
                        Password harus diisi!
                    </div>
                </div>
                <a href="daftar_pengguna.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        var isValid = true;

        // Ambil nilai input
        var namaLengkap = document.getElementById("nama_lengkap").value;
        var jenisKelamin = document.getElementById("jenis_kelamin").value;
        var umur = document.getElementById("umur").value;
        var username = document.getElementById("username").value;
        var password = document.getElementById("password").value;

        // Ambil elemen pesan error
        var namaError = document.getElementById("nama_error");
        var jkError = document.getElementById("jk_error");
        var umurError = document.getElementById("umur_error");
        var usernameError = document.getElementById("username_error");
        var passwordError = document.getElementById("password_error");

        // Reset pesan error
        namaError.style.display = "none";
        jkError.style.display = "none";
        umurError.style.display = "none";
        usernameError.style.display = "none";
        passwordError.style.display = "none";

        // Validasi Nama Lengkap
        if (namaLengkap === "") {
            namaError.style.display = "block";
            isValid = false;
        }

        // Validasi Jenis Kelamin
        if (jenisKelamin === "") {
            jkError.style.display = "block";
            isValid = false;
        }

        // Validasi Umur
        if (umur === "") {
            umurError.style.display = "block";
            isValid = false;
        }

        // Validasi Username
        if (username === "") {
            usernameError.style.display = "block";
            isValid = false;
        }

        // Validasi Password
        if (password === "") {
            passwordError.style.display = "block";
            isValid = false;
        }

        // Cegah pengiriman form jika tidak valid
        return isValid;
    }
</script>

<?php
include 'footer.php';
?>
