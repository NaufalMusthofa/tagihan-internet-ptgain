<?php
session_start();
if (!isset($_SESSION['user'])) header("Location: login.php");
include 'views/header.php';
include 'db.php';

$user_id = $_SESSION['user']['id'];

$stmt = $pdo->prepare("SELECT * FROM billings WHERE user_id = ?");
$stmt->execute([$user_id]);
$billings = $stmt->fetchAll();
?>
<h2>Selamat Datang, <?= $_SESSION['user']['name'] ?></h2>
<ul>
    <li><a href="tagihan.php">Daftar Tagihan</a></li>
    <li><a href="create_billing.php">Buat billing</a></li>
    <li><a href="user_management.php">User Management</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<h3>Status Pembayaran</h3>
<table border="1" cellpadding="8">
    <tr>
        <th>Kode Billing</th>
        <th>Jumlah</th>
        <th>Status</th>
        <th>Action</th>
    </tr>
    <?php foreach ($billings as $b): ?>
        <tr>
            <td><?= $b['billing_code'] ?></td>
            <td>Rp <?= number_format($b['amount'], 0, ',', '.') ?></td>
            <td><?= ucfirst($b['status']) ?></td>
            <td>
                <?php if ($b['status'] == 'waiting'): ?>
                    <a href="pay.php?id=<?= $b['id'] ?>">Bayar</a> |
                    <form action="delete_billing.php" method="POST" style="display:inline;" onsubmit="return confirm('Yakin ingin menghapus billing ini?');">
                        <input type="hidden" name="billing_id" value="<?= $b['id'] ?>">
                        <button type="submit">Hapus</button>
                    </form>
                <?php elseif ($b['status'] == 'paid'): ?>
                    <span>Paid</span>
                <?php endif; ?>
            </td>

        </tr>
    <?php endforeach; ?>
</table>

<?php include 'views/footer.php'; ?>
