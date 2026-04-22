<?php include("../includes/user_auth.php");
include("user_layout.php");
include("../includes/header.php"); ?>

<div class="container py-5">
    <div class="card shadow border-0 rounded-4 text-center">
        <div class="card-body p-5">
            <h1 class="text-success">Thank You 🎉</h1>
            <p>Your order placed successfully.</p>

            <a href="vendors.php" class="btn btn-primary">Continue Shopping</a>
            <a href="order_status.php" class="btn btn-outline-dark">Track Orders</a>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>