<?php
// Memanggil file pendukung (Saran Peningkatan 5 & 6)
include 'includes/fungsi.php';

// Data dummy (Array PHP)
$semua_proyek = [
    ["judul" => "Pembuatan Website E-Commerce", "kategori" => "Web Dev"],
    ["judul" => "Desain UI/UX Aplikasi Mobile", "kategori" => "Design"],
    ["judul" => "Sistem Informasi Perpustakaan PHP", "kategori" => "Web Dev"],
    ["judul" => "Portfolio Personal HTML & CSS", "kategori" => "Frontend"]
];

$keyword = "";
$hasil_pencarian = [];

if (isset($_GET['keyword'])) {
    // 1. Panggil fungsi bersihkanInput() untuk keamanan
    $keyword = bersihkanInput($_GET['keyword']);

    // 2. Panggil fungsi cariProyek() untuk memfilter data
    $hasil_pencarian = cariProyek($semua_proyek, $keyword);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hasil Pencarian</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>

    <?php include 'includes/header.php'; ?>
    <?php include 'includes/nav.php'; ?>

    <main>
        <div id="content" style="padding: 20px;">
            <h2>Hasil Pencarian untuk: "<?= $keyword ?>"</h2>
            <a href="index.php">← Kembali ke Beranda</a>
            <hr style="margin: 15px 0;">

            <?php if (empty($keyword)): ?>
                <p>Silakan masukkan kata kunci pencarian pada form.</p>
            <?php elseif (count($hasil_pencarian) > 0): ?>
                <ul>
                    <!-- Perulangan (foreach) untuk menampilkan hasil -->
                    <?php foreach ($hasil_pencarian as $item): ?>
                        <li style="margin-bottom: 10px;">
                            <strong><?= $item['judul'] ?></strong> — 
                            <span style="color: #666;"><?= $item['kategori'] ?></span>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p style="color: red;">Proyek dengan kata kunci tersebut tidak ditemukan.</p>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'includes/footer.php'; ?>

</body>
</html>