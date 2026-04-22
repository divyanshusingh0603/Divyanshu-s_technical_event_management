<?php
include("../includes/user_auth.php");
include("user_layout.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

if (isset($_GET['add'])) {
    $pid = (int)$_GET['add'];

    mysqli_query($conn, "
        INSERT INTO cart(user_id,product_id,quantity)
        VALUES('$user_id','$pid','1')
    ");
}

if (isset($_GET['remove'])) {
    $id = (int)$_GET['remove'];
    mysqli_query($conn, "DELETE FROM cart WHERE id='$id' AND user_id='$user_id'");
}

if (isset($_GET['clear'])) {
    mysqli_query($conn, "DELETE FROM cart WHERE user_id='$user_id'");
}

$data = mysqli_query($conn, "
SELECT c.*, p.product_name,p.price,p.image
FROM cart c
JOIN products p ON p.id=c.product_id
WHERE c.user_id='$user_id'
");

$total = 0;
include("../includes/header.php");
?>

<div class="container py-4">
    <h3 class="mb-4">Shopping Cart</h3>

    <table class="table table-bordered bg-white">
        <tr>
            <th>Product</th>
            <th>Price</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($data)) {
            $sub = $row['price'] * $row['quantity'];
            $total += $sub;
        ?>
            <tr>
                <td><?= $row['product_name'] ?></td>
                <td>₹<?= $row['price'] ?></td>
                <td><?= $row['quantity'] ?></td>
                <td>₹<?= $sub ?></td>
                <td>
                    <a href="?remove=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Remove</a>
                </td>
            </tr>
        <?php } ?>

        <tr>
            <th colspan="3">Grand Total</th>
            <th>₹<?= $total ?></th>
            <th>
                <a href="?clear=1" class="btn btn-dark btn-sm">Delete All</a>
            </th>
        </tr>

    </table>

    <a href="checkout.php" class="btn btn-success">Proceed Checkout</a>
</div>

<?php include("../includes/footer.php"); ?>