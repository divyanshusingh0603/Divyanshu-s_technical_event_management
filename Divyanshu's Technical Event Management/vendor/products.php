<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");
include("../includes/header.php");

$vendor_id = $_SESSION['vendor_id'];

if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    mysqli_query($conn, "
        DELETE FROM products 
        WHERE id='$id' AND vendor_id='$vendor_id'
    ");
    header("Location: products.php");
    exit();
}

$data = mysqli_query($conn, "
SELECT p.*, c.category_name
FROM products p
LEFT JOIN categories c ON c.id = p.category_id
WHERE p.vendor_id='$vendor_id'
ORDER BY p.id DESC
");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">

        <div class="d-flex justify-content-between mb-4">
            <h3>My Products</h3>
            <a href="add_product.php" class="btn btn-primary">+ Add Product</a>
        </div>

        <table class="table table-bordered align-middle">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Category</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td>
                        <?php if ($row['image']) { ?>
                            <img src="../uploads/products/<?= $row['image'] ?>" width="60" class="rounded">
                        <?php } else {
                            echo "No Image";
                        } ?>
                    </td>
                    <td><?= $row['product_name'] ?></td>
                    <td><?= $row['category_name'] ?></td>
                    <td>₹<?= $row['price'] ?></td>
                    <td><?= $row['stock'] ?></td>
                    <td><?= $row['status'] ?></td>
                    <td>
                        <a href="edit_product.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-warning">Edit</a>
                        <a href="?delete=<?= $row['id'] ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>

        <a href="dashboard.php" class="btn btn-secondary">Back</a>

    </div>
</div>

<?php include("../includes/footer.php"); ?>