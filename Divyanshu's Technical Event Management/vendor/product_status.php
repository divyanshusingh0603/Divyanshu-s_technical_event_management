<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");
$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['save'])) {
    $id = (int)$_POST['product_id'];
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE products 
        SET status='$status'
        WHERE id='$id' AND vendor_id='$vendor_id'
    ");
}

$data = mysqli_query($conn, "
SELECT * FROM products
WHERE vendor_id='$vendor_id'
");

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Product Status</h3>

        <table class="table table-bordered">
            <tr>
                <th>Name</th>
                <th>Status</th>
                <th>Change</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <select name="status" class="form-select">
                                <option value="available">Available</option>
                                <option value="out_of_stock">Out of Stock</option>
                                <option value="inactive">Inactive</option>
                            </select>
                            <button name="save" class="btn btn-primary">Update</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>

        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>