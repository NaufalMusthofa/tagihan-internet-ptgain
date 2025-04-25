<?php
include 'db.php';
session_start();
// $snapToken = \Midtrans\Snap::getSnapToken($transaction);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'];
    $amount = $_POST['amount'];
    $billing_code = 'BILL' . time(); // contoh kode unik

    $stmt = $pdo->prepare("INSERT INTO billings (user_id, billing_code, amount) VALUES (?, ?, ?)");
    $stmt->execute([$user_id, $billing_code, $amount]);

    header("Location: dashboard.php");
    exit;
}

$users = $pdo->query("SELECT id, name FROM users")->fetchAll();
?>
<h2>Buat Tagihan Baru</h2>
<form method="POST">
    Pilih User:
    <select name="user_id" required>
        <?php foreach ($users as $user): ?>
            <option value="<?= $user['id'] ?>"><?= $user['name'] ?></option>
        <?php endforeach; ?>
    </select><br><br>
    
    Jumlah Tagihan:
    <input type="number" name="amount" required><br><br>
    
    <button type="submit">Buat Tagihan</button>
</form>


<!-- ?> -->
<!-- <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="YOUR_CLIENT_KEY"></script>
<button onclick="pay()">Bayar Sekarang</button>
<script>
function pay() {
    snap.pay("<?= $snapToken ?>", {
        onSuccess: function(result){ alert("Berhasil!"); location.href='tagihan.php'; },
        onPending: function(result){ alert("Pending"); },
        onError: function(result){ alert("Gagal"); },
    });
}
</script> -->