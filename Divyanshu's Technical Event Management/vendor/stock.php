<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");

$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['update_stock'])) {
    $id = (int)$_POST['product_id'];
    $stock = (int)$_POST['stock'];

    mysqli_query($conn, "
        UPDATE products 
        SET stock='$stock'
        WHERE id='$id' AND vendor_id='$vendor_id'
    ");
}

$data = mysqli_query($conn, "
SELECT * FROM products
WHERE vendor_id='$vendor_id'
ORDER BY id DESC
");

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Maintain Stock</h3>

        <table class="table table-bordered align-middle">
            <tr>
                <th>Product</th>
                <th>Current Stock</th>
                <th>Update</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td>
                        <form method="POST" class="d-flex gap-2">
                            <input type="hidden" name="product_id" value="<?= $row['id'] ?>">
                            <input type="number" name="stock" class="form-control" value="<?= $row['stock'] ?>" style="max-width:120px;">
                            <button name="update_stock" class="btn btn-success">Save</button>
                        </form>
                    </td>
                </tr>
            <?php } ?>

        </table>

        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>