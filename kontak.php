<?php
$pesan_status = "";
$data_dikirim = null;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan Sanitasi (Kriteria 7)
    $nama = trim($_POST['nama'] ?? '');
    $email = trim($_POST['email'] ?? '');
    $pesan = trim($_POST['pesan'] ?? '');

    if (empty($nama) || empty($email) || empty($pesan)) {
        $pesan_status = "Semua kolom wajib diisi!";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $pesan_status = "Format email tidak valid!";
    } else {
        // Amankan output
        $nama_bersih = htmlspecialchars($nama);
        $email_bersih = htmlspecialchars($email);
        $pesan_bersih = htmlspecialchars($pesan);

        $pesan_status = "Pesan berhasil dikirim!";
        $data_dikirim = [
            "Nama" => $nama_bersih,
            "Email" => $email_bersih,
            "Pesan" => $pesan_bersih
        ];
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hubungi Kami - Portofolio</title>
    <link rel="stylesheet" href="css/style.css">
    <style>
        .container-kontak {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 18px;
        }
        .form-group label {
            display: block;
            margin-bottom: 6px;
            font-weight: 600;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cbd5e1;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 1rem;
        }
        .form-group textarea {
            height: 120px;
            resize: vertical;
        }
        .btn-submit {
            background-color: #0284c7;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            font-weight: 600;
        }
        .btn-submit:hover {
            background-color: #0369a1;
        }
        .alert {
            padding: 12px;
            border-radius: 6px;
            margin-bottom: 20px;
        }
        .alert-error {
            background-color: #fee2e2;
            color: #991b1b;
        }
        .alert-success {
            background-color: #dcfce7;
            color: #166534;
        }
        .hasil-pesan {
            background-color: #f8fafc;
            padding: 15px;
            border-radius: 6px;
            border-left: 4px solid #0284c7;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Formulir Kontak</h1>
        <nav>
            <a href="index.html">← Kembali ke Beranda</a>
        </nav>
    </header>

    <main class="container-kontak">
        <h2>Kirim Pesan</h2>
        <p style="margin-bottom: 20px; color: #64748b;">Silakan isi formulir di bawah ini untuk menghubungi saya.</p>

        <!-- Pesan Status Validasi/Error -->
        <?php if (!empty($pesan_status)): ?>
            <div class="alert <?= ($data_dikirim) ? 'alert-success' : 'alert-error' ?>">
                <?= $pesan_status ?>
            </div>
        <?php endif; ?>

        <!-- Tampilan Detail Jika Pesan Berhasil Terkirim -->
        <?php if ($data_dikirim): ?>
            <div class="hasil-pesan">
                <h3>Detail Pesan Terkirim:</h3>
                <p><strong>Nama:</strong> <?= $data_dikirim['Nama'] ?></p>
                <p><strong>Email:</strong> <?= $data_dikirim['Email'] ?></p>
                <p><strong>Pesan:</strong> <?= $data_dikirim['Pesan'] ?></p>
            </div>
        <?php endif; ?>

        <!-- Formulir Kontak (POST) -->
        <form action="kontak.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda">
            </div>

            <div class="form-group">
                <label for="email">Alamat Email</label>
                <input type="text" id="email" name="email" placeholder="contoh@email.com">
            </div>

            <div class="form-group">
                <label for="pesan">Pesan / Masukan</label>
                <textarea id="pesan" name="pesan" placeholder="Tuliskan pesan Anda di sini..."></textarea>
            </div>

            <button type="submit" class="btn-submit">Kirim Pesan</button>
        </form>
    </main>

    <footer>
        <p>&copy; 2026 Portofolio Saya. All rights reserved.</p>
    </footer>
</body>
</html>