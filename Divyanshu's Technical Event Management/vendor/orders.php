<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");
include("../includes/header.php");

$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['update_status'])) {
    $order_id = (int)$_POST['order_id'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE orders SET order_status='$status'
        WHERE id='$order_id'
    ");
}

$data = mysqli_query($conn, "
SELECT oi.*, o.id as oid, o.order_no, o.order_status, u.full_name
FROM order_items oi
JOIN orders o ON o.id = oi.order_id
JOIN users u ON u.id = o.user_id
WHERE oi.vendor_id='$vendor_id'
ORDER BY oi.id DESC
");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">

        <h3 class="mb-4">My Orders</h3>

        <table class="table table-bordered align-middle">
            <tr>
                <th>Order</th>
                <th>User</th>
                <th>Subtotal</th>
                <th>Status</th>
                <th>Update</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['order_no'] ?></td>
                    <td><?= $row['full_name'] ?></td>
                    <td>₹<?= $row['subtotal'] ?></td>
                    <td><span class="badge bg-info"><?= $row['order_status'] ?></span></td>
                    <td>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="order_id" value="<?= $row['oid'] ?>">
                            <select name="status" class="form-select form-select-sm">
                                <option>placed</option>
                                <option>confirmed</option>
                                <option>processing</option>
                                <option>completed</option>
                                <option>cancelled</option>
                            </select>
                            <button type="submit" name="update_status" class="btn btn-sm btn-success">Save</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>

        <a href="dashboard.php" class="btn btn-secondary">Back</a>

    </div>
</div>

<?php include("../includes/footer.php"); ?>