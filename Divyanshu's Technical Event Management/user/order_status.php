<?php
include("../includes/user_auth.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$data = mysqli_query($conn, "
SELECT * FROM orders
WHERE user_id='$user_id'
ORDER BY id DESC
");

include("../includes/header.php");
include("user_layout.php");
?>

<div class="container py-4">
    <h3 class="mb-4">My Orders</h3>

    <table class="table table-bordered bg-white">
        <tr>
            <th>Order No</th>
            <th>Total</th>
            <th>Payment</th>
            <th>Status</th>
            <th>Date</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
            <tr>
                <td><?= $row['order_no'] ?></td>
                <td>₹<?= $row['total_amount'] ?></td>
                <td><?= $row['payment_method'] ?></td>
                <td><span class="badge bg-primary"><?= $row['order_status'] ?></span></td>
                <td><?= $row['created_at'] ?></td>
            </tr>
        <?php } ?>

    </table>
</div>

<?php include("../includes/footer.php"); ?>