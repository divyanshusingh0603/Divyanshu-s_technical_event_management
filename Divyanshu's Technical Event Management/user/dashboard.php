<?php
include("../includes/user_auth.php");
include("user_layout.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

$cartCount   = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM cart WHERE user_id='$user_id'"))['total'];
$orderCount  = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders WHERE user_id='$user_id'"))['total'];
$vendorCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vendors WHERE status='approved'"))['total'];
?>

<style>
    .dashboard-card {
        border: none;
        border-radius: 20px;
        transition: 0.3s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 20px 35px rgba(0, 0, 0, .08);
    }

    .icon-box {
        width: 55px;
        height: 55px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 22px;
        color: #fff;
    }

    .quick-link {
        text-decoration: none;
    }

    .hero-box {
        background: linear-gradient(135deg, #0d6efd, #6f42c1);
        color: #fff;
        border-radius: 24px;
        padding: 35px;
    }

    .mini-stat {
        background: #fff;
        border-radius: 18px;
        padding: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
    }
</style>

<div class="container-fluid">

    <!-- STATS -->
    <div class="row g-4 mb-4">
        <div class="col-md-4">
            <div class="mini-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Cart Items</small>
                        <h3 class="fw-bold mb-0"><?= $cartCount; ?></h3>
                    </div>
                    <div class="icon-box bg-success">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="mini-stat">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <small class="text-muted">Total Orders</small>
                        <h3 class="fw-bold mb-0"><?= $orderCount; ?></h3>
                    </div>
                    <div class="icon-box bg-warning">
                        <i class="fas fa-box"></i>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- QUICK ACTIONS -->
    <div class="row g-4">

        <div class="col-md-3">
            <a href="vendors.php" class="quick-link">
                <div class="card dashboard-card h-100 p-4">
                    <div class="icon-box bg-primary mb-3">
                        <i class="fas fa-store"></i>
                    </div>
                    <h5 class="fw-bold">Browse Vendors</h5>
                    <p class="text-muted mb-0">Find decorators, catering, lighting & more.</p>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="cart.php" class="quick-link">
                <div class="card dashboard-card h-100 p-4">
                    <div class="icon-box bg-success mb-3">
                        <i class="fas fa-cart-shopping"></i>
                    </div>
                    <h5 class="fw-bold">My Cart</h5>
                    <p class="text-muted mb-0">Review items and continue checkout.</p>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="order_status.php" class="quick-link">
                <div class="card dashboard-card h-100 p-4">
                    <div class="icon-box bg-warning mb-3">
                        <i class="fas fa-truck"></i>
                    </div>
                    <h5 class="fw-bold">Track Orders</h5>
                    <p class="text-muted mb-0">See live order and delivery status.</p>
                </div>
            </a>
        </div>

        <div class="col-md-3">
            <a href="request_item.php" class="quick-link">
                <div class="card dashboard-card h-100 p-4">
                    <div class="icon-box bg-dark mb-3">
                        <i class="fas fa-paper-plane"></i>
                    </div>
                    <h5 class="fw-bold">Custom Request</h5>
                    <p class="text-muted mb-0">Need something special? Send request.</p>
                </div>
            </a>
        </div>

    </div>

</div>

</div>
</div>
</body>

</html>