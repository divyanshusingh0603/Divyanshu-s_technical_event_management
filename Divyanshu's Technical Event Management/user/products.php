<?php
include("../includes/user_auth.php");
include("user_layout.php");
include("../includes/db.php");

$vendor = (int)$_GET['vendor'];

$data = mysqli_query($conn, "
SELECT * FROM products
WHERE vendor_id='$vendor'
AND status='available'
");

include("../includes/header.php");
?>

<div class="container py-4">
    <h3 class="mb-4">Products</h3>

    <div class="row g-4">

        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
            <div class="col-md-3">
                <div class="card shadow rounded-4 border-0 h-100">
                    <?php if ($row['image'] != "") { ?>
                        <img src="../uploads/products/<?= $row['image'] ?>" class="card-img-top" style="height:200px;object-fit:cover;">
                    <?php } ?>

                    <div class="card-body text-center">
                        <h6><?= $row['product_name'] ?></h6>
                        <p class="fw-bold text-primary">₹<?= $row['price'] ?></p>

                        <a href="cart.php?add=<?= $row['id'] ?>" class="btn btn-success w-100">Add To Cart</a>
                    </div>
                </div>
            </div>
        <?php } ?>

    </div>
</div>

<?php include("../includes/footer.php"); ?>