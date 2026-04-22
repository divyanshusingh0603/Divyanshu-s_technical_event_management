<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/admin_layout.php");

$userCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$vendorCount = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vendors"))['total'];
$activeUsers = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users WHERE status='active'"))['total'];
$approvedVendors = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM vendors WHERE status='approved'"))['total'];
?>

<div class="row g-4">

    <div class="col-md-3">
        <div class="card stat-card p-4">
            <small class="text-muted">Total Users</small>
            <h2><?= $userCount ?></h2>
            <a href="users.php" class="btn btn-sm btn-primary">Open</a>
        </div>
    </div>

    <!-- -->

    <div class="col-md-3">
        <div class="card stat-card p-4">
            <small class="text-muted">Total Vendors</small>
            <h2><?= $vendorCount ?></h2>
            <a href="vendors.php" class="btn btn-sm btn-success">Open</a>
        </div>
    </div>
    <!--  -->

</div>

<div class="row g-4 mt-1">

    <div class="col-md-6">
        <a href="add_user.php" class="text-decoration-none">
            <div class="card stat-card p-4 h-100">
                <h5><i class="fa-solid fa-user-plus text-primary me-2"></i>Add New User</h5>
                <p class="text-muted mb-0">Create and manage customer accounts.</p>
            </div>
        </a>
    </div>

    <div class="col-md-6">
        <a href="add_vendor.php" class="text-decoration-none">
            <div class="card stat-card p-4 h-100">
                <h5><i class="fa-solid fa-store text-success me-2"></i>Add New Vendor</h5>
                <p class="text-muted mb-0">Approve and onboard new businesses.</p>
            </div>
        </a>
    </div>

</div>

</div>
</div>
</body>

</html>