<?php
/**
 * Fungsi untuk memfilter data proyek berdasarkan kata kunci pencarian
 * 
 * @param array $daftar_proyek Array berisi kumpulan proyek
 * @param string $keyword Kata kunci pencarian
 * @return array Array berisi proyek yang cocok
 */
function cariProyek(array $daftar_proyek, string $keyword): array {
    $hasil = [];
    
    // Validasi sederhana: jika keyword kosong, kembalikan array kosong
    if (empty(trim($keyword))) {
        return $hasil;
    }

    // Melakukan perulangan untuk mengecek setiap proyek
    foreach ($daftar_proyek as $proyek) {
        // stripos berguna untuk mencari teks tanpa peduli huruf besar/kecil (case-insensitive)
        if (stripos($proyek['judul'], $keyword) !== false || stripos($proyek['kategori'], $keyword) !== false) {
            $hasil[] = $proyek;
        }
    }

    return $hasil;
}

/**
 * Fungsi untuk melakukan pembersihan data input (Sanitasi Keamanan)
 * Memenuhi Kriteria Wajib Validasi & Keamanan (Kriteria 7)
 * 
 * @param string $data Teks inputan user
 * @return string Teks yang sudah aman
 */
function bersihkanInput(string $data): string {
    $data = trim($data);                  // Menghapus spasi berlebih di awal/akhir
    $data = stripslashes($data);          // Menghapus backslash (\)
    $data = htmlspecialchars($data);      // Mengubah karakter khusus HTML jadi entity (Mencegah XSS)
    return $data;
}
?>