<?php
include 'functions.php';

$pdo = pdo_connect_mysql();

$page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;

$records_per_page = 5;

$stmt = $pdo->prepare('SELECT * FROM daftar_booking ORDER BY id LIMIT :current_page, :records_per_page');
$stmt->bindValue(':current_page', ($page - 1) * $records_per_page, PDO::PARAM_INT);
$stmt->bindValue(':records_per_page', $records_per_page, PDO::PARAM_INT);
$stmt->execute();

$bookings = $stmt->fetchAll(PDO::FETCH_ASSOC);

$num_bookings = $pdo->query('SELECT COUNT(*) FROM daftar_booking')->fetchColumn();
?>

<?=template_header('Pemesanan Tiket')?>

<div class="content read">
    <h2>Read Bookings</h2>
    <a href="create.php" class="create-booking">PESAN TIKET KERETA ANDA DISINI..</a>
    <table>
        <thead>
            <tr>
                <td>#</td>
                <td>No. Booking</td>
                <td>Tanggal Booking</td>
                <td>Tanggal Keberangkatan</td>
                <td>Nama Pelanggan</td>
                <td>Alamat</td>
                <td>Nomor HP</td>
                <td>Tujuan</td>
                <td>Kelas</td>
                <td>Jam Keberangkatan</td>
                <td>Jam Kedatangan</td>
                <td>Jumlah Pesan</td>
                <td>Total Biaya</td>
                <td></td>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($bookings as $booking): ?>
            <tr>
                <td><?=$booking['id']?></td>
                <td><?=$booking['no_booking']?></td>
                <td><?=$booking['tgl_booking']?></td>
                <td><?=$booking['tgl_keberangkatan']?></td>
                <td><?=$booking['nama_pelanggan']?></td>
                <td><?=$booking['alamat']?></td>
                <td><?=$booking['no_hp']?></td>
                <td><?=$booking['tujuan']?></td>
                <td><?=$booking['kelas']?></td>
                <td><?=$booking['jam_keberangkatan']?></td>
                <td><?=$booking['jam_kedatangan']?></td>
                <td><?=$booking['jumlah_pesan']?></td>
                <td><?= 'Rp ' . number_format($booking['total_biaya'], 2, ',', '.') ?></td>
                <td class="actions">
                    <a href="update.php?id=<?=$booking['id']?>" class="edit"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="delete.php?id=<?=$booking['id']?>" class="trash"><i class="fas fa-trash fa-xs"></i></a>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="pagination">
        <?php if ($page > 1): ?>
        <a href="read.php?page=<?=$page-1?>"><i class="fas fa-angle-double-left fa-sm"></i></a>
        <?php endif; ?>
        <?php if ($page * $records_per_page < $num_bookings): ?>
        <a href="read.php?page=<?=$page+1?>"><i class="fas fa-angle-double-right fa-sm"></i></a>
        <?php endif; ?>
    </div>
</div>

<?=template_footer()?>
