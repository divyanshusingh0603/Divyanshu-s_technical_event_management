<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");

$vendor_id = $_SESSION['vendor_id'];

$totalProducts = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT COUNT(*) as total FROM products WHERE vendor_id='$vendor_id'
"))['total'];

$totalOrders = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT COUNT(DISTINCT order_id) as total
FROM order_items WHERE vendor_id='$vendor_id'
"))['total'];

$stockLow = mysqli_fetch_assoc(mysqli_query($conn, "
SELECT COUNT(*) as total FROM products
WHERE vendor_id='$vendor_id' AND stock < 5
"))['total'];
?>

<style>
    .card-box {
        border: none;
        border-radius: 20px;
        transition: .3s;
    }

    .card-box:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.19);
    }

    .hero {
        background: linear-gradient(135deg, #0dd1fd, #c142a8);
        color: white;
        padding: 35px;
        border-radius: 24px;
    }

    .icon-circle {
        width: 55px;
        height: 55px;
        border-radius: 15px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 20px;
    }
</style>

<!-- <div class="hero mb-4">
    <div class="row align-items-center">
        <div class="col-md-8">
            <h2 class="fw-bold">
                Welcome, <?= $_SESSION['vendor_name']; ?> 👋
            </h2>
            <p class="mb-0 opacity-75">
                Manage products, orders, stock and grow your event business.
            </p>
        </div>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="add_product.php" class="btn btn-light px-4 rounded-pill fw-semibold">
                + Add Product
            </a>
        </div>
    </div>
</div> -->

<div class="row g-4">

    <div class="col-md-4">
        <div class="card card-box p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Total Products</small>
                    <h2 class="fw-bold"><?= $totalProducts ?></h2>
                </div>
                <div class="icon-circle bg-primary">
                    <i class="fa-solid fa-box"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Orders</small>
                    <h2 class="fw-bold"><?= $totalOrders ?></h2>
                </div>
                <div class="icon-circle bg-success">
                    <i class="fa-solid fa-cart-shopping"></i>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card card-box p-4 h-100">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">Low Stock</small>
                    <h2 class="fw-bold"><?= $stockLow ?></h2>
                </div>
                <div class="icon-circle bg-danger">
                    <i class="fa-solid fa-triangle-exclamation"></i>
                </div>
            </div>
        </div>
    </div>

</div>

<div class="row g-4 mt-2">

    <div class="col-md-3">
        <a href="products.php" class="text-decoration-none">
            <div class="card card-box p-4 text-center">
                <i class="fa-solid fa-box-open fa-2x text-primary mb-3"></i>
                <h6 class="fw-bold">Manage Products</h6>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="orders.php" class="text-decoration-none">
            <div class="card card-box p-4 text-center">
                <i class="fa-solid fa-truck fa-2x text-success mb-3"></i>
                <h6 class="fw-bold">Manage Orders</h6>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="membership.php" class="text-decoration-none">
            <div class="card card-box p-4 text-center">
                <i class="fa-solid fa-crown fa-2x text-warning mb-3"></i>
                <h6 class="fw-bold">Membership</h6>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="profile.php" class="text-decoration-none">
            <div class="card card-box p-4 text-center">
                <i class="fa-solid fa-user fa-2x text-dark mb-3"></i>
                <h6 class="fw-bold">My Profile</h6>
            </div>
        </a>
    </div>

</div>

</div>
</div>
</body>

</html>