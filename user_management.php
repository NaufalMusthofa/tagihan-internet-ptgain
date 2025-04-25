<?php
session_start();
include 'db.php';
include 'views/header.php';

$stmt = $pdo->query("SELECT * FROM users");
$users = $stmt->fetchAll();
?>
<h2>User Management</h2>
<a href="create_user.php">+ Tambah User</a>
<table border="1">
<tr><th>ID</th><th>Nama</th><th>Email</th></tr>
<?php foreach ($users as $u): ?>
<tr>
    <td><?= $u['id'] ?></td>
    <td><?= $u['name'] ?></td>
    <td><?= $u['email'] ?></td>
</tr>
<?php endforeach; ?>
</table>
<?php include 'views/footer.php'; ?>
