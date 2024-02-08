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
	<p>Selamat datang di halaman utama pemesanan tiket kereta KAI!</p>
	<!-- Note: Anda dapat menambahkan informasi atau promosi khusus di sini untuk menarik perhatian pengunjung -->
	<div class="note">
		<p><strong>Info Penting:</strong> Pastikan setelah anda menentukan Jam Pemberangkatan anda harus sudah ditempat 30 menit sebelum Jam Pemberangkatan yang sudah anda tentukan!</p>
	</div>
</div>

<?=template_footer()?>
