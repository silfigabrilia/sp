<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='ubah'){
        $id_tentang = $_POST['id_tentang'];
        $judul = $_POST['judul'];
        $keterangan = $_POST['keterangan'];

        mysqli_query($conn,"UPDATE tb_tentang SET judul='$judul', keterangan='$keterangan' WHERE id_tentang='$id_tentang'");
        header("location:tentang.php");
    }
}
        
include 'header.php';
?>

<div class="container">
	<div class="card shadow p-4 mb-5">
		<div class = "card-header">
            <h5 class= "m-0 font-weight-bold text-primary">Edit Tentang</h5>
        </div>
        <hr>
        <?php
        $data = mysqli_query($conn,"SELECT * FROM tb_tentang WHERE id_tentang='$_GET[id_tentang]'");
        $a = mysqli_fetch_array($data)
        ?>
            <form action="edit_tentang.php?aksi=ubah" method="POST">
            <input type="hidden" name="id_tentang" class="form-control" value="<?=$a['id_tentang']?>">
                <div class="form-group">
                    <label>Judul</label>
                    <input type="text" name="judul" class="form-control" value="<?=$a['judul']?>">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"><?=$a['keterangan']?></textarea>
                </div>
                <hr>
                <a href="tentang.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Ubah" class="btn btn-primary">
            </form>
    </div>
</div>

<?php
include 'footer.php';
?>
