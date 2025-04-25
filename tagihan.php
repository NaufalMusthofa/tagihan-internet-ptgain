<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
include 'views/header.php';
include 'db.php';

$stmt = $pdo->prepare("SELECT * FROM billings WHERE user_id = ?");
$stmt->execute([$_SESSION['user']['id']]);
$billings = $stmt->fetchAll();
?>
<h2>Daftar Tagihan Internet</h2>
<table border="1">
<tr><th>Kode</th><th>Jumlah</th><th>Status</th><th>Action</th></tr>
<?php foreach ($billings as $b): ?>
<tr>
    <td><?= $b['billing_code'] ?></td>
    <td>Rp <?= number_format($b['amount']) ?></td>
    <td><?= $b['status'] ?></td>
    <td>
        <?php if ($b['status'] == 'waiting'): ?>
            <a href="create_billing.php?code=<?= $b['billing_code'] ?>">Bayar</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
<?php include 'views/footer.php'; ?>
