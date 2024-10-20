<?php
include '../assets/conn/config.php';
$error_message = '';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $nama_gejala = $_POST['nama_gejala'];

        // Validasi di sisi server
        if (empty($nama_gejala)) {
            $error_message = "Nama gejala tidak boleh kosong!";
        } else {
            mysqli_query($conn, "INSERT INTO tb_gejala (nama_gejala) VALUES ('$nama_gejala')");
            header("location:gejala.php");
            exit();
        }
    }
}

include 'header.php';
?>

<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Gejala</h5>
        </div>

        <div class="card-body">
            <form action="tambah_gejala.php?aksi=simpan" method="POST" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Nama Gejala</label>
                    <input type="text" name="nama_gejala" class="form-control" id="nama_gejala" value="<?php echo isset($_POST['nama_gejala']) ? $_POST['nama_gejala'] : ''; ?>">
                    <small id="nama_gejala_error" class="text-danger"><?php echo $error_message; ?></small>
                </div>
                <hr>
                <a href="gejala.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
// Validasi di sisi klien
function validateForm() {
    var namaGejala = document.getElementById("nama_gejala").value;
    var errorMessage = document.getElementById("nama_gejala_error");
    
    if (namaGejala == "") {
        errorMessage.textContent = "Nama gejala tidak boleh kosong!";
        return false;
    } else {
        errorMessage.textContent = ""; // Hapus pesan error jika sudah diisi
    }
    return true;
}

// Menampilkan pesan error dari server jika ada
<?php if (!empty($error_message)): ?>
    document.getElementById("nama_gejala_error").textContent = "<?php echo $error_message; ?>";
<?php endif; ?>
</script>

<?php
include 'footer.php';
?>
