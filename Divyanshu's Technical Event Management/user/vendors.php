<?php
include("../includes/user_auth.php");
include("../includes/db.php");

$data = mysqli_query($conn, "
SELECT * FROM vendors
WHERE status='approved'
ORDER BY id DESC
");

include("../includes/header.php");
include("user_layout.php");
?>

<div class="container py-4">
    <h3 class="mb-4">Browse Vendors</h3>

    <div class="row g-4">
        <?php while ($row = mysqli_fetch_assoc($data)) { ?>
            <div class="col-md-4">
                <div class="card shadow border-0 rounded-4 h-100">
                    <div class="card-body text-center">
                        <h5><?= $row['business_name'] ?></h5>
                        <p class="text-muted"><?= $row['email'] ?></p>
                        <a href="products.php?vendor=<?= $row['id'] ?>" class="btn btn-primary">View Products</a>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<?php include("../includes/footer.php"); ?>