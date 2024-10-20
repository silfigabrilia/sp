<?php
date_default_timezone_set('Asia/Jakarta');
include '../assets/conn/config.php';

// untuk membuat nomor registrasi
function generateRandomString($Lenght){
    $characters = '123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i=0; $i < $Lenght; $i++){
        $randomString .= $characters[rand(0, strlen($characters) -1)];
    }
    return $randomString;
}
$panjangString = 10;
if (isset($_GET['aksi'])) {
    if ($_GET['aksi']=='identifikasi'){
        $no_regidentifikasi = generateRandomString($panjangString);
        $tgl_identifikasi = date('Y-m-d');
        $id_akun = $_POST['id_akun'];

        $query = "INSERT INTO tb_identifikasi(no_regidentifikasi, tgl_identifikasi, id_akun, id_gejala, nilai_user) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $query)) {
            mysqli_stmt_bind_param($stmt,"ssiss", $no_regidentifikasi, $tgl_identifikasi, $id_akun, $id_gejala, $kondisi);

            foreach ($_POST['id_gejala'] as $key => $value) {
                if ($_POST['kondisi'][$value]) {
                    //untuk menampung nilai cf user
                    $kondisi = $_POST['kondisi'][$value];  //nilai cf user
                    $id_gejala = $value;
                    mysqli_stmt_execute($stmt);
                }
            }
            // foreach ($_POST['kondisi'] as $key => $value) {
            //     //untuk menampung nilai cf user
            //     $kondisi = $value;  //nilai cf user
            //     $id_gejala = $_POST['id_gejala'][$key];
            //     mysqli_stmt_execute($stmt);

            // }
            mysqli_stmt_close($stmt);
            
        }

        mysqli_close($conn);
            header("location:identifikasi.php?no_regidentifikasi=$no_regidentifikasi");
            exit();

        // mysqli_query($conn,"DELETE FROM tb_gejala WHERE id_gejala='$_GET[id_gejala]'");
        
        // header("location:gejala.php");
    }elseif ($_GET['aksi']=='simpan') {
        $id_akun = $_POST['id_akun'];
        $no_regidentifikasi = $_POST['no_regidentifikasi'];
        $tgl_identifikasi = date('Y-m-d');
        $penyakit_cf = $_POST['penyakit_cf'];
        $nilai_cf = $_POST['nilai_cf'];

        mysqli_query($conn,"INSERT INTO tb_hasil (id_akun,no_regidentifikasi,tgl_identifikasi,penyakit_cf,nilai_cf) VALUES ('$id_akun','$no_regidentifikasi','$tgl_identifikasi','$penyakit_cf','$nilai_cf')");
        header("location:history.php?pesan=berhasil");
        
        # code...
    }
}
        
include 'header.php';
$username = $_SESSION['username'];
$pass = mysqli_query($conn,"SELECT * FROM tb_akun WHERE username='$username'");
$p = mysqli_fetch_array($pass);
$id_akun = $p['id_akun'];
?>

<style scoped>
#header {
    background: rgba(40, 58, 90, 0.9);
}
section {
    padding: 0;
    padding-top: 100px;
}
</style>

<section id="portfolio" class="portfolio">
    <div class="container" data-aos="fade-up">

        <div class="section-title">
        </div>

        <div id="portfolio-flters" class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="100">

<div class="container">
	<div class="card shadow p-5 mb-5">
        <?php if (empty($_GET['no_regidentifikasi'])){?>

		<div class = "card-header">
            <h5 class= "m-0 font-weight-bold text-primary">Identifikasi</h5>
        </div>
            <?php }else{}?>



        <?php if (empty($_GET['no_regidentifikasi'])){?>

        <div class="card-body">
            <!-- <form action="identifikasi.php?aksi=identifikasi" method="POST" enctype="multipart/form-data"> -->
            <form action="identifikasi.php?aksi=identifikasi" id="form-identifikasi" method="POST" enctype="multipart/form-data">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Gejala</th>
                            <th class="text-center">Kondisi</th>
                        </tr>
                <?php
                $data = mysqli_query($conn,"SELECT * FROM tb_gejala ORDER BY id_gejala");
                $i=0;
                while($a=mysqli_fetch_array($data)){
                    $i++;
                    echo "
                    <tr>
                    <td class='text-center'>$i</td>
                    <td class='text-justify'>Apakah Udang Anda Mengalami Gejala <b>$a[nama_gejala]</b> ?</td>
                    <td >
                    <select class='form-control' name='kondisi[$i]'>
                    <option selected disabled>Pilih kondisi</option>
                    <option value='0'>Tidak</option>
                    <option value='0.2'>Tidak Tahu</option>
                    <option value='0.4'>Sedikit Yakin</option>
                    <option value='0.6'>Cukup Yakin</option>
                    <option value='0.8'>Yakin</option>
                    <option value='1'>Sangat Yakin</option>
                    </select>
                    </td>
                    </tr>

                    <input type='hidden' name='id_gejala[$i]' value='$a[id_gejala]'>
                    ";
                }
                ?>
                
                    </table>
                </div>
                    <input type="hidden" name="id_akun" value="<?= $id_akun ?>">
                    <a href="index.php" class="btn btn-secondary">Batal</a>
                    <input type="submit" value="Proses Identifikasi" class="btn btn-primary">
            </form>
        </div>
        <br>
        <br>

        <?php }else{?>

        <center>
            <h2 class="m-0 font-weight-bold text-primary"> Hasil Analisa Metode Certainty Factor</h2>
        </center>
        <hr>

        <h5 class="font-weight-bold text-primary">Rule</h5>
        <div class="table-responsive">
            <table class="table table-bordered">
                <tr>
                    <th class="text-center">No</th>
                    <th class="text-center">Penyakit</th>
                    <th class="text-center">Gejala</th>
                    <th class="text-center">CF Pakar</th>
                    <th class="text-center">CF User</th>
                    <th class="text-center">Nilai CF</th>
                </tr>
                <?php
                $sql = mysqli_query($conn,"SELECT * FROM tb_penyakit p, tb_gejala g, tb_identifikasi i, 
                tb_aturan a WHERE g.id_gejala=i.id_gejala AND g.id_gejala=a.id_gejala AND 
                p.id_penyakit=a.id_penyakit AND i.id_akun='$id_akun' AND i.no_regidentifikasi='$_GET[no_regidentifikasi]' 
                ORDER BY p.id_penyakit");
                $i=0;
                while($r = mysqli_fetch_array($sql)){
                    // cf = h * e ... CF pakar-CF user
                    $nilai_cf = $r['nilai_gejala']*$r['nilai_user'];
                    $i++;
                    echo "
                    <tr>
                    <td class='text-center'>$i</td>
                    <td class='text-center'>$r[nama_penyakit]</td>
                    <td class='text-center'>$r[nama_gejala]</td>
                    <td class='text-center'>$r[nilai_gejala]</td>
                    <td class='text-center'>$r[nilai_user]</td>
                    <td class='text-center'>$nilai_cf</td>
                    </tr>
                    ";
                }?>
            </table> 
        </div>
        <br>
        <br>

        <div class="border p-3">
            <h5 class="font-weight-bold text primary">Detail Perhitungan </h5>
            <h6>
                <?php
                $highestPercentage = 0;
                $penyakitTerbesar = "";
                $data = mysqli_query($conn,"SELECT * FROM tb_penyakit ORDER BY id_penyakit");
                while($a=mysqli_fetch_array($data)){

                    $sql1 = mysqli_query($conn,"SELECT * FROM tb_gejala g, 
                        tb_identifikasi i, tb_aturan a WHERE g.id_gejala=i.id_gejala 
                        AND g.id_gejala=a.id_gejala AND a.id_penyakit='$a[id_penyakit]' AND i.id_akun='$id_akun' 
                        AND i.no_regidentifikasi='$_GET[no_regidentifikasi]'");

                $jml_data = mysqli_num_rows($sql1);

                $cflama = 0;
                $no=1;
                $lastPercentage = 0;
                while ($result=mysqli_fetch_array($sql1)){
                    $cf_he = $result['nilai_gejala']*$result['nilai_user'];

                    if($jml_data>0){
                        $cf1 = $cflama ;
                        $cf2 = $cf_he;
                        //rumus cf combine cf=cf1+cf2*(1-cf1)
                        $cfcombine = $cf1+$cf2 * (1-$cf1);
                        $cflama = $cfcombine;

                        echo "<div class='text-justify'>
                        CFcombine = " . $cf1 . " + " . $cf2 . " x (1-" . $cf1 . "
                        ) = " . $cfcombine . "<br></div>
                        ";
                        
                        if($result['id_penyakit'] == $a['id_penyakit']) {
                            $persentage = $cfcombine * 100;
                            $lastPercentage = number_format($persentage,2);

                        }
                        $no++;
                    }
                }
                if($no>1) {
                    echo "<p><b>Persentage combine pada penyakit (" . $a['nama_penyakit'] . ") : " . $lastPercentage . "%</b></p>";
                    if($lastPercentage > $highestPercentage){
                        $highestPercentage = $lastPercentage;
                        $penyakitTerbesar = $a['nama_penyakit'];

                    }
                }

            }
            echo "
            <b class='text-primary'>Nilai Terbesar " . $highestPercentage . "
            %<br></b>
            <b class='text-primary'> Penyakit dengan nilai terbesar : " . $penyakitTerbesar . "<br></b>";
            //$pembulatan = number_format($highestPersentage,2);
            
                ?>
            </h6>
        </div>

        <br>
        <div class="border p-3">
            <h5 class="font-weight-bold text primary">Keterangan</h5>
            <h6>
            <?php
            $data = mysqli_query($conn,"SELECT * FROM tb_penyakit WHERE nama_penyakit='$penyakitTerbesar'");
            $a=mysqli_fetch_array($data);
            // echo "
            // <div class='text-justify'>
            // $a[keterangan];
            // </div>
            // ";
            if ($a) {
                echo "
                <div class='text-justify'>
                $a[keterangan];
                </div>
                ";
            }
            else {
                echo "Tidak diketahui.";
            }
                ?>
            </h6>
        </div>
  
        <br>
        <div class="border p-3">
            <h5 class="font-weight-bold text primary">Pengendalian</h5>
            <h6>
            <?php
            $data = mysqli_query($conn,"SELECT * FROM tb_penyakit WHERE nama_penyakit='$penyakitTerbesar'");
            $a=mysqli_fetch_array($data);
            // echo "
            // <div class='text-justify'>
            // $a[pengendalian];
            // </div>
            // ";
            if ($a) {
                echo "
                <div class='text-justify'>
                $a[pengendalian];
                </div>
                ";
            }
            else {
                echo "Tidak diketahui.";
            }
                ?>
            </h6>
    </div>
    <br>

    <div class="border p-3">
            <h5 class="font-weight-bold text primary">Kesimpulan</h5>
            <h6>
            <?php
            
            // echo "
            // <div class='text-justify'>
            // Berdasarkan hasil perhitungan metode <b>Certainty Factor</b> diatas, dapat disimpulkan bahwa udang anda kemungkinan besar terjangkit penyakit <b class='text-primary' style='font-size:25px;'>$penyakitTerbesar</b> dengan tingkat kepercayaan <b class='text-primary' style='font-size:25px;'>$highestPercentage%</b>
            // $a[pengendalian];
            // </div>
            // ";
            if ($a) {
                echo "
                <div class='text-justify'>
                Berdasarkan hasil perhitungan metode <b>Certainty Factor</b> diatas, dapat disimpulkan bahwa udang anda kemungkinan besar terjangkit penyakit <b class='text-primary' style='font-size:25px;'>$penyakitTerbesar</b> dengan tingkat kepercayaan <b class='text-primary' style='font-size:25px;'>$highestPercentage%</b>
                $a[pengendalian];
                </div>
                ";
            }
            else {
                echo "Tidak diketahui.";
            }
                ?>
            </h6>
    </div>
    <br>
    <hr>

    <form action="identifikasi.php?aksi=simpan" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_akun" value="<?= $id_akun ?>">
        <input type="hidden" name="no_regidentifikasi" value="<?= $_GET['no_regidentifikasi'] ?>">
        <input type="hidden" name="penyakit_cf" value="<?= $penyakitTerbesar ?>">
        <input type="hidden" name="nilai_cf" value="<?= $highestPercentage ?>">
        
        <div class='text-left'>
            <a href="identifikasi.php" class="btn btn-secondary"><span class="fa fa-reply">&emsp; Identifikasi Ulang</span></a>
            <input type="submit" class="btn btn-primary" value="Simpan Hasil Identifikasi">
        </div>
    </form>
    
    <?php } //endpengecheckan no regidentifikasi
    ?>
</div>
</div>
    </div>
</section>
<?php
include 'footer.php';
?>

<script>
    $('#form-identifikasi').on('submit', function (e) {
        e.preventDefault()
        var selected = 0;
        var select = $('#form-identifikasi select');

        select.each(function () {
            if ($(this).val() !== null) {
                selected++;
            }
        });

        if (selected < 1) {
            alert('Harap pilih minimal 1 kondisi gejala!')
        } else {
            this.submit();
        }
    })
</script>