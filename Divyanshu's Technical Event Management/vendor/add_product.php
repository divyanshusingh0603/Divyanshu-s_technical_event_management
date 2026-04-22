<?php
include("../includes/vendor_auth.php");
include("vendor_layout.php");
include("../includes/db.php");

$vendor_id = $_SESSION['vendor_id'];
$cats = mysqli_query($conn, "SELECT * FROM categories");

if (isset($_POST['save'])) {
    $name  = mysqli_real_escape_string($conn, $_POST['product_name']);
    $cat   = (int)$_POST['category_id'];
    $desc  = mysqli_real_escape_string($conn, $_POST['description']);
    $price = $_POST['price'];
    $stock = $_POST['stock'];

    $imageName = "";
    if (!empty($_FILES['image']['name'])) {
        $imageName = time() . "_" . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], "../uploads/products/" . $imageName);
    }

    mysqli_query($conn, "
        INSERT INTO products
        (vendor_id,category_id,product_name,description,price,stock,image)
        VALUES
        ('$vendor_id','$cat','$name','$desc','$price','$stock','$imageName')
    ");

    header("Location: products.php");
    exit();
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Add Product</h3>

        <form method="POST" enctype="multipart/form-data">
            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="product_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Category</label>
                    <select name="category_id" class="form-select" required>
                        <option value="">Select</option>
                        <?php while ($c = mysqli_fetch_assoc($cats)) { ?>
                            <option value="<?= $c['id'] ?>"><?= $c['category_name'] ?></option>
                        <?php } ?>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Description</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Price</label>
                    <input type="number" step="0.01" name="price" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Stock</label>
                    <input type="number" name="stock" class="form-control" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Image</label>
                    <input type="file" name="image" class="form-control">
                </div>

            </div>

            <button type="submit" name="save" class="btn btn-success">Save Product</button>
            <a href="products.php" class="btn btn-secondary">Cancel</a>

        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>