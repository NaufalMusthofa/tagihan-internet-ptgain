<?php
session_start();
if (!isset($_SESSION['user'])) {
    header("Location: login.php");
    exit();
}

include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['billing_id'])) {
    $billing_id = $_POST['billing_id'];
    $user_id = $_SESSION['user']['id'];

    // Hapus hanya jika billing milik user dan status masih 'waiting'
    $stmt = $pdo->prepare("DELETE FROM billings WHERE id = ? AND user_id = ? AND status = 'waiting'");
    $stmt->execute([$billing_id, $user_id]);
}

header("Location: dashboard.php");
exit();
