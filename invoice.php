<?php
include 'db.php';
$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT b.*, u.name, u.email, u.phone FROM billings b JOIN users u ON b.user_id = u.id WHERE b.id = ?");
$stmt->execute([$id]);
$data = $stmt->fetch();

if (!$data) {
    die("Data tidak ditemukan.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Invoice - <?= $data['billing_code'] ?></title>
</head>
<body onload="window.print()">
    <h2>INVOICE</h2>
    <hr>
    <p><strong>Nama:</strong> <?= $data['name'] ?></p>
    <p><strong>Email:</strong> <?= $data['email'] ?></p>
    <p><strong>Telepon:</strong> <?= $data['phone'] ?></p>
    <p><strong>Kode Billing:</strong> <?= $data['billing_code'] ?></p>
    <p><strong>Jumlah:</strong> Rp <?= number_format($data['amount'], 0, ',', '.') ?></p>
    <p><strong>Status:</strong> <?= strtoupper($data['status']) ?></p>
    <hr>
    <p><em>Terima kasih atas pembayaran Anda.</em></p>
</body>
</html>
