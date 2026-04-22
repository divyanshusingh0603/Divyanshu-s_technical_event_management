<?php
include("../includes/vendor_auth.php");
include("vendor_layout.php");
include("../includes/db.php");

$vendor_id = $_SESSION['vendor_id'];
$id = (int)$_GET['id'];

$product = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT * FROM products 
WHERE id='$id' AND vendor_id='$vendor_id'
"));

if (!$product) {
    header("Location: products.php");
    exit();
}

$cats = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['update'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['product_name']);
    $cat   = (int)$_POST['category_id'];
    $desc  = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $status = $_POST['status'];

    $imageSql = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/products/" . $imageName);
        $imageSql = ", image='$imageName'";
    }

    mysqli_query($conn, "
        UPDATE products SET
        category_id='$cat',
        product_name='$name',
        description='$desc',
        price='$price',
        stock='$stock',
        status='$status'
        $imageSql
        WHERE id='$id' AND vendor_id='$vendor_id'
    ");

    header("Location: products.php");
    exit();
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Edit Product</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="product_name" value="<?= $product['product_name'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select">
                        <?php while ($c = mysqli_fetch_assoc($cats)) { ?>
                            <option value="<?= $c['id'] ?>" <?= $product['category_id'] == $c['id'] ? 'selected' : '' ?>>
                                <?= $c['category_name'] ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" value="<?= $product['price'] ?>" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" value="<?= $product['stock'] ?>" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-select">
                        <option value="available" <?= $product['status'] == 'available' ? 'selected' : '' ?>>Available</option>
                        <option value="out_of_stock" <?= $product['status'] == 'out_of_stock' ? 'selected' : '' ?>>Out of Stock</option>
                        <option value="inactive" <?= $product['status'] == 'inactive' ? 'selected' : '' ?>>Inactive</option>
                    </select>
                </div>

                <div class="col-md-6 mb-3">
                    <label>New Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <?php if ($product['image']) { ?>
                        <img src="../uploads/products/<?= $product['image'] ?>" width="120" class="rounded border">
                    <?php } ?>
                </div>

            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Product</button>
            <a href="products.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>