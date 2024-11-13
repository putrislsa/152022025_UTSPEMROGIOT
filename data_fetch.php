<?php
// Memasukkan file konfigurasi database untuk koneksi ke database
include 'konfig.php';

// Query SQL untuk mengambil data dari tabel 'tb_cuaca' 
// di mana suhu dan kelembapan (humid) bernilai 36
$query = "SELECT id, suhu, humid, lux, ts FROM tb_cuaca WHERE suhu = 36 AND humid = 36";
$result = mysqli_query($conn, $query); // Menjalankan query SQL

// Inisialisasi array kosong untuk menyimpan data yang diambil
$data = [];

// Mendefinisikan nilai tetap untuk suhu maksimum, minimum, dan rata-rata
// yang digunakan dalam output JSON
$suhu_max = 36; // Nilai suhu maksimal (hardcoded)
$suhu_min = 21; // Nilai suhu minimal (hardcoded, sesuaikan jika diperlukan)
$suhu_rata = 28; // Nilai suhu rata-rata (hardcoded, sesuaikan jika diperlukan)

// Loop untuk memasukkan setiap baris hasil query ke array data
while ($row = mysqli_fetch_assoc($result)) {
    $data['tb_cuaca'][] = $row; // Menyimpan setiap baris ke dalam array 'tb_cuaca'
}

// Menyimpan nilai suhu maksimum, minimum, dan rata-rata ke dalam array data
$data["suhumax"] = $suhu_max;
$data["suhumin"] = $suhu_min;
$data["suhu_rata"] = $suhu_rata;

// Struktur data bulan-tahun untuk nilai maksimum kelembapan
// Nilai hardcoded yang dapat diperbarui sesuai kebutuhan
$data["month_year_max"] = [
    ["month_year" => "2024-01", "humid" => 75],
    ["month_year" => "2024-02", "humid" => 80],
    // Tambahkan data bulan lain sesuai kebutuhan
];

// Mengatur header agar output berupa JSON
header('Content-Type: application/json');

// Mengubah array $data menjadi format JSON dan mencetaknya
echo json_encode($data);
?>
