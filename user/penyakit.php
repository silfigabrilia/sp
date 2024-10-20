<?php
include 'header.php';
include '../assets/conn/config.php';

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'read' && isset($_GET['id_penyakit'])) {
        // Query untuk mendapatkan data penyakit berdasarkan ID
        $result = mysqli_query($conn, "SELECT * FROM tb_penyakit WHERE id_penyakit='$_GET[id_penyakit]'");
        if ($result) {
            $penyakit = mysqli_fetch_assoc($result);
            // Jika data ditemukan, arahkan ke halaman detail atau tampilkan detail penyakit
            // Anda bisa menambahkan logika lebih lanjut di sini jika diperlukan
            header("location:penyakit.php");
        }
    }
}
?>

<style scoped>
#header {
    background: #37517E;
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
            <div class="card-header">
                <h5 class="m-0 font-weight-bold text-primary">Penyakit Pada Pembesaran Udang Vanname</h5>
            </div>

        <div class="card-body">
        <?php
        // Query untuk mendapatkan semua data penyakit
        $data = mysqli_query($conn, "SELECT * FROM tb_penyakit ORDER BY id_penyakit");

        // Tampilkan data penyakit jika tersedia
        if (mysqli_num_rows($data) > 0) {
            while ($row = mysqli_fetch_assoc($data)) {
                $idPenyakit = $row['id_penyakit'];
                $file = '../uploads/' . $row['gambar']; // Path ke file gambar

                // Cek apakah file gambar ada
                if (!empty($row['gambar'])) {
                    $imgSrc = $file; // Set gambar jika ada
                } else {
                     $imgSrc = 'path/to/default/image.jpg'; // Set gambar default jika tidak ada gambar
                }
                ?>
        <div class="penyakit-info">
            <h6 class='m-0 font-weight-bold text-dark'><?= $row['nama_penyakit'] ?></h6>
            <img src="<?= $imgSrc ?>" alt="<?= $row['nama_penyakit'] ?>" width="200" height="200">
            <p><strong>Keterangan:</strong> <?= $row['keterangan'] ?></p>
            
            <p class="mb-0"><strong>Gejala:</strong></p>
            <?php 
            // Query untuk mendapatkan data gejala berdasarkan tabel aturan
            $det = mysqli_query($conn, "
                SELECT p.id_penyakit, p.nama_penyakit, p.keterangan, p.pengendalian, g.id_gejala, g.nama_gejala
                FROM tb_aturan a 
                LEFT JOIN tb_gejala g ON a.id_gejala = g.id_gejala 
                LEFT JOIN tb_penyakit p ON a.id_penyakit = p.id_penyakit 
                WHERE a.id_penyakit = $idPenyakit
            ");
            if (mysqli_num_rows($det) > 0) { ?>
                <ul>
                    <?php while ($row2 = mysqli_fetch_assoc($det)) { ?>
                        <li><?= $row2['nama_gejala'] ?></li>
                    <?php } ?>
                </ul>
            <?php } else { ?>
                <p><strong>Tidak ada gejala</strong></p>
            <?php } ?>
            
            <p><strong>Pengendalian:</strong> <?= $row['pengendalian'] ?></p>
            <hr>
        </div>
        <?php
    }
} else { ?>
    <p>Tidak ada data penyakit yang tersedia.</p>
<?php } ?>

                    <!-- if (!empty($row['gambar'])) {
                        echo "<img src='$file' class='img-thumbnail' width='200'>";
                    }
                    echo "<h6 class='m-0 font-weight-bold text-dark'>" . $row['nama_penyakit'] . "</h6><br>";
                    echo "<p><strong>Keterangan:</strong> " . $row['keterangan'] . "</p>";
                    echo "<p><strong>Pengendalian:</strong> " . $row['pengendalian'] . "</p>";
                    echo "<hr>";
                }
            } else {
                echo "<p>Tidak ada data penyakit yang tersedia.</p>";
            }
            ?> -->
        </div>
    </div>
</div>
</section>
<?php
include 'footer.php';
?>
