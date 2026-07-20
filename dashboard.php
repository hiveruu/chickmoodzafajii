<?php
$base = "";
require_once __DIR__ . "/auth/cek_login.php";
require_once __DIR__ . "/config/koneksi.php";

$judul = "Dashboard";

$totalMenu     = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM menu"))['jml'];
$totalKategori = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM kategori_menu"))['jml'];
$totalTransaksi= mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS jml FROM pesanan"))['jml'];
$pendapatan    = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COALESCE(SUM(total_bayar),0) AS total FROM pesanan WHERE DATE(tanggal) = CURDATE()"))['total'];

$menuTerlaris = mysqli_query($koneksi, "
    SELECT m.nama_menu, SUM(d.qty) AS total_terjual
    FROM detail_pesanan d
    JOIN menu m ON m.id_menu = d.id_menu
    GROUP BY d.id_menu
    ORDER BY total_terjual DESC
    LIMIT 5
");

include __DIR__ . "/includes/header.php";
?>

<div class="row g-3 mb-4">
    <div class="col-md-3">
        <div class="card card-menu p-3">
            <div class="text-muted">Total Menu</div>
            <h3><?= $totalMenu ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-menu p-3">
            <div class="text-muted">Total Kategori</div>
            <h3><?= $totalKategori ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-menu p-3">
            <div class="text-muted">Total Transaksi</div>
            <h3><?= $totalTransaksi ?></h3>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card card-menu p-3">
            <div class="text-muted">Pendapatan Hari Ini</div>
            <h3>Rp <?= number_format($pendapatan, 0, ',', '.') ?></h3>
        </div>
    </div>
</div>

<div class="card card-menu p-3">
    <h5>Menu Terlaris</h5>
    <table class="table table-sm">
        <thead><tr><th>Nama Menu</th><th>Total Terjual</th></tr></thead>
        <tbody>
        <?php if (mysqli_num_rows($menuTerlaris) === 0): ?>
            <tr><td colspan="2" class="text-center text-muted">Belum ada transaksi</td></tr>
        <?php else: while ($row = mysqli_fetch_assoc($menuTerlaris)): ?>
            <tr>
                <td><?= htmlspecialchars($row['nama_menu']) ?></td>
                <td><?= $row['total_terjual'] ?></td>
            </tr>
        <?php endwhile; endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__ . "/includes/footer.php"; ?>
