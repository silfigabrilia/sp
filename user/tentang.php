<?php
include 'header.php';
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'read' && isset($_GET['id_tentang'])) {
        // Query untuk mendapatkan data penyakit berdasarkan ID
        $result = mysqli_query($conn, "SELECT * FROM tb_tentang WHERE id_tentang='$_GET[id_tentang]'");
        // if ($result) {
        //     $penyakit = mysqli_fetch_assoc($result);
            // Jika data ditemukan, arahkan ke halaman detail atau tampilkan detail penyakit
            // Anda bisa menambahkan logika lebih lanjut di sini jika diperlukan
            header("location:tentang.php");
        //}
    }
}
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
        
	<div class="card shadow p-5 mb-5">
		<div class = "card-header">
            <h5 class= "m-0 font-weight-bold text-primary">Tentang</h5>
        </div>

        <div class="card-body">
        <?php
            // Query untuk mendapatkan semua data penyakit
            $data = mysqli_query($conn, "SELECT * FROM tb_tentang ORDER BY id_tentang");

            // Tampilkan data penyakit jika tersedia
            if (mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    echo "<h6 class='m-0 font-weight-bold text-dark'><b>" . $row['judul'] . "</b></h6>";
                    echo "<p>" . $row['keterangan'] . "</p>";
                    echo "<hr>";
                }
            } 
        ?>
        <!-- <h6 class= "m-0 font-weight-bold text-dark">Sistem Pakar Identifikasi Penyakit Pada Pembesaran Udang Menggunakan Metode Certainty Factor</h5>
        <br>
        <div class='text-justify'>
        <h9 class= "text-dark">Cara Penggunaan Aplikasi :</h5>
        <br>
        <div >A. Menu Identifikasi berfungsi untuk mengidentifikasi penyakit pada pembesaran udang vanname, cara penggunaan :
            <br>1. user membuka menu identifikasi.
            <br>2. user memilih gejala dan kondisi berdasarkan keadaan udang di tambak.
            <br>3. sistem akan memproses data gejala yang sudah dipilih sebelumnya.
            <br>4. hasil identifikasi akan keluar menghasilkan penyakit yang dialami oleh udang.
            <br>5. hasil identifikasi akan disimpan oleh sistem dan dapat dilihat pada menu history.
            <br>
            <br>B. Menu Penyakit berfungsi untuk melihat iformasi mengenai penyakit, gejala, dan pengendalian pada pembesran udang vanname.
            <br>
            <br>C. Menu History berfungsi untuk melihat history atau riwayat identifikasi sebelumnya yang telah disimpan oleh sistem.  -->

        </div>
        </div>
        </div>
    </div>
</div>
</div>
</section>
<?php
include 'footer.php';
?>