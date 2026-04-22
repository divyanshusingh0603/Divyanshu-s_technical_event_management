<?php
include("../includes/user_auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$cart = mysqli_query($conn, "
SELECT c.*,p.price,p.vendor_id,p.id as pid
FROM cart c
JOIN products p ON p.id=c.product_id
WHERE c.user_id='$user_id'
");

$total = 0;
$items = [];

while ($r = mysqli_fetch_assoc($cart)) {
    $sub = $r['price'] * $r['quantity'];
    $total += $sub;
    $items[] = $r + ['subtotal' => $sub];
}

if (isset($_POST['order'])) {
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $payment = $_POST['payment_method'];
    $order_no = "ORD" . time();

    mysqli_query($conn, "
        INSERT INTO orders(order_no,user_id,total_amount,payment_method,payment_status,address)
        VALUES('$order_no','$user_id','$total','$payment','paid','$address')
    ");

    $order_id = mysqli_insert_id($conn);

    foreach ($items as $i) {
        mysqli_query($conn, "
        INSERT INTO order_items(order_id,product_id,vendor_id,price,quantity,subtotal)
        VALUES(
        '$order_id',
        '{$i['pid']}',
        '{$i['vendor_id']}',
        '{$i['price']}',
        '{$i['quantity']}',
        '{$i['subtotal']}'
        )");
    }

    mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");

    header("Location: success.php?id=$order_id");
    exit();
}

include("../includes/header.php");
include("user_layout.php");
?>

<div class="container py-5">
    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <h3 class="mb-4">Checkout</h3>

            <form method="POST">
                <textarea name="address" class="form-control mb-3" placeholder="Delivery Address" required></textarea>

                <select name="payment_method" class="form-select mb-3">
                    <option value="cod">Cash On Delivery</option>
                    <option value="upi">UPI</option>
                </select>

                <button name="order" class="btn btn-primary w-100">Order Now ₹<?= $total ?></button>
            </form>

        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>