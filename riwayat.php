<?php
include 'db.php';
session_start();

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM billings WHERE user_id = ? AND status = 'paid'");
$stmt->execute([$user_id]);
$data = $stmt->fetchAll();
?>

<h2>Riwayat Pembayaran</h2>
<table border="1" cellpadding="8">
    <tr>
        <th>Kode Billing</th>
        <th>Jumlah</th>
        <th>Status</th>
        <!-- <th>Invoice</th> -->
    </tr>
    <?php foreach ($data as $d): ?>
        <tr>
            <td><?= $d['billing_code'] ?></td>
            <td>Rp <?= number_format($d['amount'], 0, ',', '.') ?></td>
            <td><?= ucfirst($d['status']) ?></td>
            <!-- <td><a href="invoice.php?id=<?= $d['id'] ?>" target="_blank">Cetak</a></td> -->
        </tr>
    <?php endforeach; ?>
</table>
