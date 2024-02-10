<?php
include 'functions.php';
$pdo = pdo_connect_mysql();
$msg = '';

if (isset($_GET['id'])) {
    if (!empty($_POST)) {
        $id = isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != 'auto' ? $_POST['id'] : NULL;
        $no_booking = generateRandomString(10); // Generate a random alphanumeric string of length 10
        $tgl_booking = date('Y-m-d');// Tanggal booking diambil dari tanggal hari ini
        $tgl_keberangkatan = isset($_POST['tgl_keberangkatan']) ? $_POST['tgl_keberangkatan'] : '';
        $nama_pelanggan = isset($_POST['nama_pelanggan']) ? $_POST['nama_pelanggan'] : '';
        $alamat = isset($_POST['alamat']) ? $_POST['alamat'] : '';
        $no_hp = isset($_POST['no_hp']) ? $_POST['no_hp'] : '';
        $tujuan = isset($_POST['tujuan']) ? $_POST['tujuan'] : '';
        $kelas = isset($_POST['kelas']) ? $_POST['kelas'] : '';
        $jam_keberangkatan = isset($_POST['jam_keberangkatan']) ? $_POST['jam_keberangkatan'] : '';
        $jam_kedatangan = isset($_POST['jam_kedatangan']) ? $_POST['jam_kedatangan'] : '';
        $jumlah_pesan = isset($_POST['jumlah_pesan']) ? $_POST['jumlah_pesan'] : '';
        $total_biaya = isset($_POST['total_biaya']) ? $_POST['total_biaya'] : '';

        $stmt = $pdo->prepare('UPDATE daftar_booking SET id = ?, no_booking = ?, tgl_booking = ?, tgl_keberangkatan = ?, nama_pelanggan = ?, alamat = ?, no_hp = ?, tujuan = ?, kelas = ?, jam_keberangkatan = ?, jam_kedatangan = ?, jumlah_pesan = ?, total_biaya = ? WHERE id = ?');
        $stmt->execute([$id, $no_booking, $tgl_booking, $tgl_keberangkatan, $nama_pelanggan, $alamat, $no_hp, $tujuan, $kelas, $jam_keberangkatan, $jam_kedatangan, $jumlah_pesan, $total_biaya, $_GET['id']]);
        $msg = 'Pesanan Anda Berhasil di Update!';
    }

    $stmt = $pdo->prepare('SELECT * FROM daftar_booking WHERE id = ?');
    $stmt->execute([$_GET['id']]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$booking) {
        exit('Booking doesn\'t exist with that ID!');
    }
} else {
    exit('No ID specified!');
}

function generateRandomString($length = 3) {
    $characters = '0123456789ABCDEFGHIJKLMNOP';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}
?>

<?=template_header('Update Pemesanan Tiket Kereta Api KAI')?>

<style>
    .content.update form {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 15px;
    }

    .content.update form label {
        text-align: left;
        grid-column: span 1;
    }

    .content.update form input,
    .content.update form select {
        grid-column: span 1;
    }

    .content.update form input[type="submit"] {
        grid-column: span 2;
    }
</style>

<div class="content update">
    <h2>Update Booking #<?=$booking['id']?></h2>
    <form action="update.php?id=<?=$booking['id']?>" method="post">
        <label for="id">ID</label>
        <input type="text" name="id" value="<?=$booking['id']?>" id="id" readonly>

        <label for="no_booking">No. Booking</label>
        <input type="text" name="no_booking" value="<?=$no_booking?>" id="no_booking" readonly>
        
        <label for="tgl_booking">Tanggal Booking</label>
        <input type="text" value="<?=$booking['tgl_booking']?>" readonly>
        
        <label for="tgl_keberangkatan">Tanggal Keberangkatan</label>
        <input type="date" name="tgl_keberangkatan" value="<?=$booking['tgl_keberangkatan']?>" id="tgl_keberangkatan">
        
        <label for="nama_pelanggan">Nama Pelanggan</label>
        <input type="text" name="nama_pelanggan" value="<?=$booking['nama_pelanggan']?>" id="nama_pelanggan">
        
        <label for="alamat">Alamat</label>
        <input type="text" name="alamat" value="<?=$booking['alamat']?>" id="alamat">
        
        <label for="no_hp">Nomor HP</label>
        <input type="text" name="no_hp" value="<?=$booking['no_hp']?>" id="no_hp">
        
        <label for="tujuan">Tujuan</label>
        <select name="tujuan" value="<?=$booking['tujuan']?>" id="tujuan">
            <option value="Sukabumi - Bogor">1.Sukabumi - Bogor Rp 75.000/1 penumpang</option>
            <option value="Sukabumi - Bandung">2.Sukabumi - Bandung Rp 85.000/1 penumpang</option>
            <option value="Sukabumi - Jakarta">3.Sukabumi - Jakarta Rp 85.000/1 penumpang</option>
            <option value="Bogor - Sukabumi">4.Bogor - Sukabumi Rp 75.000/1 penumpang</option>
            <option value="Bogor - Bandung">5.Bogor - Bandung Rp 70.000/1 penumpang</option>
            <option value="Bogor - Jakarta">6.Bogor - Jakarta Rp 75.000/1 penumpang</option>
            <option value="Jakarta - Bogor">7.Jakarta - Bogor Rp 50.000/1 penumpang</option>
            <option value="Jakarta - Bandung">8.Jakarta - Bandung Rp 90.000/1 penumpang</option>
            <option value="Jakarta - Sukabumi">9.Jakarta - Sukabumi Rp 85.000/1 penumpang</option>
        </select>
        
        <label for="kelas">Kelas</label>
        <select name="kelas" value="<?=$booking['kelas']?>" id="kelas">
            <option value="Ekonomi">1.Ekonomi</option>
            <option value="Bisnis">2.Bisnis</option>
            <option value="Eksekutif">3.Eksekutif</option>
        </select>
        
        <label for="jam_keberangkatan">Jam Keberangkatan</label>
        <input type="time" name="jam_keberangkatan" value="<?=$booking['jam_keberangkatan']?>" id="jam_keberangkatan">
        
        <label for="jam_kedatangan">Jam Kedatangan</label>
        <input type="time" name="jam_kedatangan" value="<?=$booking['jam_kedatangan']?>" id="jam_kedatangan" readonly>
        
        <label for="jumlah_pesan">Jumlah Pesan</label>
        <input type="number" name="jumlah_pesan" value="<?=$booking['jumlah_pesan']?>" id="jumlah_pesan">
        
        <label for="total_biaya">Total Biaya</label>
        <input type="teks" name="total_biaya" value="<?=$booking['total_biaya']?>" id="total_biaya" readonly>
        
        <input type="submit" value="Update Pesanan">
    </form>
    <?php if ($msg): ?>
    <p><?=$msg?></p>
    <?php endif; ?>
</div>

<script>
// Auto-fill jam_kedatangan 30 menit sebelum jam_keberangkatan
document.getElementById('jam_keberangkatan').addEventListener('change', function() {
    var jam_keberangkatan = document.getElementById('jam_keberangkatan').value;
    var jam_kedatangan = new Date('1970-01-01T' + jam_keberangkatan);
    jam_kedatangan.setMinutes(jam_kedatangan.getMinutes() - 30);
    var formattedJamKedatangan = jam_kedatangan.toTimeString().slice(0, 5);
    document.getElementById('jam_kedatangan').value = formattedJamKedatangan;
});

// Auto-calculate total_biaya based on selected tujuan and kelas
document.getElementById('tujuan').addEventListener('change', function() {
    updateTotalBiaya();
});

document.getElementById('kelas').addEventListener('change', function() {
    updateTotalBiaya();
});

document.getElementById('jumlah_pesan').addEventListener('change', function() {
    updateTotalBiaya();
});

function updateTotalBiaya() {
    var tujuan = document.getElementById('tujuan').value;
    var kelas = document.getElementById('kelas').value;
    var jumlah_pesan = document.getElementById('jumlah_pesan').value;
    var hargaDasar = getHargaDasar(tujuan);

    var totalBiaya = calculateTotalBiaya(hargaDasar, kelas, jumlah_pesan);
    
    document.getElementById('total_biaya').value = totalBiaya;
}

function getHargaDasar(tujuan) {
    var hargaDasar = 0;

    switch(tujuan) {
        case 'Sukabumi - Bogor':
            hargaDasar = 75000;
            break;
        case 'Sukabumi - Bandung':
            hargaDasar = 85000;
            break;
        case 'Sukabumi - Jakarta':
            hargaDasar = 85000;
            break;
        case 'Bogor - Sukabumi':
            hargaDasar = 75000;
            break;
        case 'Bogor - Bandung':
            hargaDasar = 70000;
            break;
        case 'Bogor - Jakarta':
            hargaDasar = 75000;
            break;
        case 'Jakarta - Bogor':
            hargaDasar = 50000;
            break;
        case 'Jakarta - Bandung':
            hargaDasar = 90000;
            break;
        case 'Jakarta - Sukabumi':
            hargaDasar = 85000;
            break;
        default:
            hargaDasar = 0;
    }

    return hargaDasar;
}

function calculateTotalBiaya(hargaDasar, kelas, jumlah_pesan) {
    var totalBiaya = 0;

    switch(kelas) {
        case 'Ekonomi':
            totalBiaya = hargaDasar * jumlah_pesan;
            break;
        case 'Bisnis':
            totalBiaya = hargaDasar * 1.1 * jumlah_pesan; // Ditambah 10%
            break;
        case 'Eksekutif':
            totalBiaya = hargaDasar * 1.25 * jumlah_pesan; // Ditambah 25%
            break;
        default:
            totalBiaya = 0;
    }

    // Menambahkan format Rupiah (Rp) dan menggunakan fungsi toLocaleString() untuk memformat nominal
    return totalBiaya.toFixed(2);
}

</script>

<?=template_footer()?>
