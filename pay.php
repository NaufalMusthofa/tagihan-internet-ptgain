<?php
require_once 'vendor/autoload.php';
include 'db.php';

\Midtrans\Config::$serverKey = 'SB-Mid-server-PSWB9o2r972l7ryrMYv0EjZ0';
\Midtrans\Config::$isProduction = false;

$id = $_GET['id'];
$stmt = $pdo->prepare("SELECT b.*, u.name, u.email FROM billings b JOIN users u ON b.user_id = u.id WHERE b.id = ?");
$stmt->execute([$id]);
$bill = $stmt->fetch();

if (!$bill) {
    die("Tagihan tidak ditemukan.");
}

$params = [
    'transaction_details' => [
        'order_id' => $bill['billing_code'],
        'gross_amount' => (int)$bill['amount']
    ],
    'customer_details' => [
        'first_name' => $bill['name'],
        'email' => $bill['email'],
    ],
    // Tampilkan metode pembayaran yang aktif
    'enabled_payments' => [
        'gopay', 'qris', 'bank_transfer', 'shopeepay', 'permata_va', 'bca_va', 'bni_va'
    ],
];

try {
    $snapUrl = \Midtrans\Snap::createTransaction($params)->redirect_url;
    header("Location: " . $snapUrl);
    exit;
} catch (Exception $e) {
    echo "Gagal membuat transaksi: " . $e->getMessage();
}
