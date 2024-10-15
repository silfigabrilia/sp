<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'simpan') {
        $judul = $_POST['judul'];
        $keterangan = $_POST['keterangan'];

            mysqli_query($conn, "INSERT INTO tb_tentang (judul, keterangan) 
                VALUES ('$judul', '$keterangan')");
            header("location:tentang.php");
    }
}

include 'header.php';
?>

<div class="container">
    <div class="card shadow p-4 mb-5">
        <div class="card-header">
            <h5 class="m-0 font-weight-bold text-primary">Tambah Tentang</h5>
        </div>

        <div class="card-body">
            <form action="tambah_tentang.php?aksi=simpan" method="POST">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" id="judul" class="form-control">
                </div>

                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" id="keterangan" rows="3"></textarea>
                </div>
                <hr>
                <a href="tentang.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
    </div>
</div>

<?php
include 'footer.php';
?>
