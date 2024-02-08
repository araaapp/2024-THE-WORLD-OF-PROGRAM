<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

// Memeriksa apakah ID pemesanan sudah ada
if (isset($_GET['id'])) {
    // Memilih record yang akan dihapus
    $stmt = $pdo->prepare('SELECT * FROM daftar_booking WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$booking) {
        exit('Pemesanan dengan ID tersebut tidak ditemukan!');
    }

    // Memastikan pengguna mengonfirmasi sebelum dihapus
    if (isset($_GET['confirm'])) {
        if ($_GET['confirm'] == 'yes') {
            // Pengguna mengklik tombol "Ya", hapus record
            $stmt = $pdo->prepare('DELETE FROM daftar_booking WHERE id = ?');
            $stmt->execute([$_GET['id']]);
            $msg = 'Anda telah menghapus pemesanan!';
        } else {
            // Pengguna mengklik tombol "Tidak", redirect kembali ke halaman baca
            header('Location: read.php');
            exit;
        }
    }
} else {
    exit('ID tidak spesifik!');
}
?>

<?=template_header('Hapus')?>

<div class="content delete">
    <h2>Hapus Pemesanan #<?=$booking['id']?></h2>
    <?php if ($msg): ?>
        <p><?=$msg?></p>
    <?php else: ?>
        <p>Apakah Anda yakin ingin menghapus pemesanan #<?=$booking['id']?>?</p>
        <div class="yesno">
            <a href="delete.php?id=<?=$booking['id']?>&confirm=yes">Ya</a>
            <a href="delete.php?id=<?=$booking['id']?>&confirm=no">Tidak</a>
        </div>
    <?php endif; ?>
</div>

<?=template_footer()?>
