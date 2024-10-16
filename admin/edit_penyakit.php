<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='ubah'){
        $id_penyakit = $_POST['id_penyakit'];
        $nama_penyakit = $_POST['nama_penyakit'];
        $keterangan = $_POST['keterangan'];
        $pengendalian = $_POST['pengendalian'];

        $result = mysqli_query($conn, "SELECT gambar FROM tb_penyakit WHERE id_penyakit='$id_penyakit'");
        $row = mysqli_fetch_assoc($result);
        $current_image = $row['gambar'];

        if (!empty($_FILES['gambar']['name'])) {
            $gambar = $_FILES['gambar']['name'];
            $target_dir = "../uploads/";
            $target_file = $target_dir . basename($gambar);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
            $valid_extensions = array("jpg", "jpeg", "png", "gif");

            if (in_array($imageFileType, $valid_extensions)) {
                if (!empty($current_image) && file_exists($target_dir . $current_image)) {
                    unlink($target_dir . $current_image);
                }

                if (move_uploaded_file($_FILES['gambar']['tmp_name'], $target_file)) {
                    mysqli_query($conn, "UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit', keterangan='$keterangan', pengendalian='$pengendalian', gambar='$gambar' WHERE id_penyakit='$id_penyakit'");
                } else {
                    echo "<script>alert('Gagal mengunggah gambar.')</script>";
                }
            } else {
                echo "<script>alert('Tipe file tidak valid. Hanya menerima JPG, JPEG, PNG, dan GIF.');</script>";
            }
        } else {
            mysqli_query($conn, "UPDATE tb_penyakit SET nama_penyakit='$nama_penyakit', keterangan='$keterangan', pengendalian='$pengendalian' WHERE id_penyakit='$id_penyakit'");
        }
        header("location: penyakit.php");
    }
}
        
include 'header.php';
?>

<div class="container">
	<div class="card shadow p-4 mb-5">
		<div class = "card-header">
            <h5 class= "m-0 font-weight-bold text-primary">Edit Penyakit</h5>
        </div>
        <hr>
        <?php
        $data = mysqli_query($conn,"SELECT * FROM tb_penyakit WHERE id_penyakit='$_GET[id_penyakit]'");
        $a = mysqli_fetch_array($data)
        ?>
            <form action="edit_penyakit.php?aksi=ubah" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="id_penyakit" class="form-control" value="<?=$a['id_penyakit']?>">
                <div class="form-group">
                    <label>Nama Penyakit</label>
                    <input type="text" name="nama_penyakit" class="form-control" value="<?=$a['nama_penyakit']?>">
                </div>
                <div class="form-group">
                    <label>Gambar</label>
                    <br>
                    <?php if (!empty($a['gambar'])) { ?>
                        <img src="../uploads/<?= $a['gambar'] ?>" class="img-thumbnail mb-2" width="200">
                    <?php } ?>
                    <input type="file" name="gambar" class="form-control">
                </div>
                <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" name="keterangan" rows="3"><?=$a['keterangan']?></textarea>
                </div>
                <div class="form-group">
                    <label>Pengendalian</label>
                    <textarea class="form-control" name="pengendalian" rows="3"><?=$a['pengendalian']?></textarea>
                </div>
                <hr>
                <a href="penyakit.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Ubah" class="btn btn-primary">
            </form>
    </div>
</div>

<?php
include 'footer.php';
?>
