<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $nama_penyakit = $_POST['nama_penyakit'];
        $keterangan = $_POST['keterangan'];
        $pengendalian = $_POST['pengendalian'];
        $gambar = $_FILES['gambar']['name'];
        $target_dir = "../uploads/";

        // Validasi di sisi server untuk mencegah penyimpanan jika nama penyakit kosong
        // if (!empty($nama_penyakit)) {
        //     mysqli_query($conn, "INSERT INTO tb_penyakit (nama_penyakit, keterangan, pengendalian) 
        //         VALUES ('$nama_penyakit', '$keterangan', '$pengendalian')");
        //     // header("location:penyakit.php");
        // } else 
        if (!is_dir($target_dir)){
            // if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }
    
            $target_file = $target_dir . basename($_FILES["gambar"]["name"]);
    
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_extensions = array("jpg", "jpeg", "png", "gif");
    
            if (in_array($imageFileType, $valid_extensions)) {
                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                    mysqli_query($conn, "INSERT INTO tb_penyakit (nama_penyakit, keterangan, pengendalian, gambar) VALUES ('$nama_penyakit', '$keterangan', '$pengendalian', '$gambar')");
                    header("location: penyakit.php");
                } else {
                    echo "<script>alert('Gagal mengunggah gambar.')</script>";
                }
            } else {
                echo "<script>alert('Tipe file tidak valid. Hanya menerima JPG, JPEG, PNG, dan GIF.');</script>";
            }
            echo "<script>alert('Nama Penyakit tidak boleh kosong!');</script>";
        }
    }


include 'header.php';
?>

<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Penyakit</h5>
        </div>

        <div class="card-body">
            <form action="tambah_penyakit.php?aksi=simpan" method="POST"  enctype="multipart/form-data" onsubmit="return validateForm()">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" id="nama_penyakit" class="form-control">
                    <div class="error-message" id="nama_penyakit_error" style="color:red; display:none;">
                        Nama Penyakit tidak boleh kosong!
                    </div>
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                </div>

                <div class="form-group">
                    <label>Pengendalian</label>
                    <textarea class="form-control" name="pengendalian" id="pengendalian" rows="3"></textarea>
                </div>
                
                <hr>
                <a href="penyakit.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<script>
    function validateForm() {
        // Ambil elemen input untuk Nama Penyakit
        var namaPenyakit = document.getElementById("nama_penyakit").value;

        // Ambil elemen pesan error untuk Nama Penyakit
        var namaPenyakitError = document.getElementById("nama_penyakit_error");

        // Reset pesan error
        namaPenyakitError.style.display = "none";

        var isValid = true;

        // Validasi Nama Penyakit
        if (namaPenyakit == "") {
            namaPenyakitError.style.display = "block";
            isValid = false;
        }

        // Jika validasi gagal, mencegah form untuk disubmit
        return isValid;
    }
</script>

<?php
include 'footer.php';
?>
