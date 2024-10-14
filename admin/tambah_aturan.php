<?php
include '../assets/conn/config.php';
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='simpan'){
        $id_aturan = $_POST['id_aturan'];
        $id_gejala = $_POST['id_gejala'];
        $id_penyakit = $_POST['id_penyakit'];
        $nilai_gejala = $_POST['nilai_gejala']; 
        
        mysqli_query($conn,"INSERT INTO tb_aturan (id_aturan,id_gejala,id_penyakit,nilai_gejala)VALUES('$id_aturan','$id_gejala','$id_penyakit','$nilai_gejala')");
        header("location:aturan.php");
    }
}
        
include 'header.php';
?>

<div class="container">
	<div class="card shadow p-4 mb-5">
		<div class = "card-header">
            <h5 class= "m-0 font-weight-bold text-primary">Tambah aturan</h5>
        </div>
            
            <form action="tambah_aturan.php?aksi=simpan" method="POST">
                <div class="form-group">
                    <label>Gejala</label>
                    <select name="id_gejala" class="form-control">
                        <?php
                        $gejala = mysqli_query($conn,"SELECT * FROM tb_gejala ORDER BY id_gejala");
                        while($dtG = mysqli_fetch_array($gejala)){
                            echo "<option value='".$dtG['id_gejala']."'>".$dtG['nama_gejala']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label>Nilai Gejala</label>
                    <select name="nilai_gejala" class="form-control">
                        <option selected disabled>Pilih</option>
                        <option>-0.2</option>
                        <option>0</option>
                        <option>0.2</option>
                        <option>0.4</option>
                        <option>0.6</option>
                        <option>0.8</option>
                        <option>1</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Penyakit</label>
                    <select name="id_penyakit" class="form-control">
                    <option selected disabled>Pilih Penyakit</option>
                        <?php
                        $penyakit = mysqli_query($conn,"SELECT * FROM tb_penyakit ORDER BY id_penyakit");
                        while($dtP = mysqli_fetch_array($penyakit)){
                            echo "<option value='".$dtP['id_penyakit']."'>".$dtP['nama_penyakit']."</option>";
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <a href="aturan.php" class="btn btn-secondary">Batal</a>
                <input type="submit" value="Simpan" class="btn btn-primary">
            </form>
        </div>
    </div>


<?php
include 'footer.php';
?>
