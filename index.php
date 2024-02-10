<?php
include 'functions.php';

// Kode PHP Anda di sini.

// Note: Anda bisa menambahkan fungsi-fungsi PHP Anda di sini untuk mengelola pemesanan tiket kereta.

// Template Halaman Utama di bawah ini.

?>
<link rel="stylesheet" href="styles.css">

<?=template_header('Pemesanan Tiket Kereta - KAI')?>

<div class="content">
    <h2>Home</h2>
    <p>Selamat datang di halaman utama pemesanan tiket kereta - KAI!</p>
    <!-- Note: Anda dapat menambahkan informasi atau promosi khusus di sini untuk menarik perhatian pengunjung -->
    <div class="note">
        <p><strong>Info Penting:</strong> Pastikan setelah anda menentukan Jam Pemberangkatan anda harus sudah diStasiun 30 menit sebelum Jam Pemberangkatan yang sudah anda tentukan!</p>
    </div>
    <h3>Jadwal Kereta</h3>
    <table>
        <tr>
            <th>Stasiun Asal - Stasiun Tujuan</th>
            <th>Harga (IDR)</th>
        </tr>
        <!-- Data jadwal kereta -->
        <tr>
            <td>1. Sukabumi - Bogor</td>
            <td>Rp 75.000/1 penumpang</td>
        </tr>
        <tr>
            <td>2. Sukabumi - Bandung</td>
            <td>Rp 85.000/1 penumpang</td>
        </tr>
        <tr>
            <td>3. Sukabumi - Jakarta</td>
            <td>Rp 85.000/1 penumpang</td>
        </tr>
		<tr>
            <td>4. Bogor - Sukabumi</td>
            <td>Rp 75.000/1 penumpang</td>
        </tr>
        <tr>
            <td>5. Bogor - Bandung</td>
            <td>Rp 70.000/1 penumpang</td>
        </tr>
        <tr>
            <td>6. Bogor - Jakarta</td>
            <td>Rp 75.000/1 penumpang</td>
        </tr>
        <tr>
            <td>7. Jakarta - Bogor</td>
            <td>Rp 50.000/1 penumpang</td>
        </tr>
        <tr>
            <td>8. Jakarta - Bandung</td>
            <td>Rp 90.000/1 penumpang</td>
        </tr>
		<tr>
            <td>9. Jakarta - Sukabumi</td>
            <td>Rp 85.000/1 penumpang</td>
        </tr>
    </table>
    <h3>Destinasi Populer</h3>
    <ul>
        <li>Sukabumi: Taman Nasional Gunung Gede Pangrango, tempat yang ideal untuk hiking dan menikmati alam pegunungan yang hijau.</li>
        <li>Bogor: Nikmati udara segar dan keindahan alam di Kebun Raya Bogor.</li>
        <li>Bandung: Jelajahi kota kreatif dengan banyak tempat wisata menarik seperti Tangkuban Perahu dan Farm House.</li>
        <li>Jakarta: Jangan lewatkan Monumen Nasional (Monas) dan Kota Tua Jakarta yang penuh sejarah.</li>
    </ul>
    <h3>Tips Perjalanan</h3>
    <p>Berikut adalah beberapa tips untuk perjalanan kereta yang nyaman:</p>
    <ul>
        <li>Sebaiknya memesan tiket dengan beberapa hari sebelum tanggal keberangkatan untuk mendapatkan harga terbaik.</li>
        <li>Jangan lupa untuk membawa identitas diri yang sah saat melakukan perjalanan.</li>
        <li>Periksa jadwal keberangkatan dan tiba dengan teliti agar tidak ketinggalan kereta.</li>
        <li>Siapkan makanan dan minuman ringan untuk menikmati perjalanan.</li>
    <!-- Tambahkan tombol Read Bookings di sini -->
	<a</a></a>
    <a href="read.php" class="btn-read-bookings">PESAN TIKET SEKARANG</a>
</div>

<?=template_footer()?>
