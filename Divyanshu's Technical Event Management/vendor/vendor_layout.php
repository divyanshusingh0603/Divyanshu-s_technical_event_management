<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Vendor Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f4f7fb;
            font-family: Segoe UI, sans-serif;
        }

        .vendor-sidebar {
            width: 270px;
            height: 100vh;
            /* fixed full screen height */
            position: fixed;
            left: 0;
            top: 0;
            background: linear-gradient(180deg, #0d6efd, #0b5ed7);
            color: white;
            z-index: 999;
            padding: 25px 18px;

            overflow-y: auto;
            /* vertical scroll */
            overflow-x: hidden;
            /* hide horizontal scroll */
        }

        .vendor-logo {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 25px;
        }

        .vendor-user {
            background: rgba(255, 255, 255, .12);
            padding: 15px;
            border-radius: 18px;
            margin-bottom: 25px;
        }

        .vendor-user h6 {
            margin: 0;
            font-weight: 600;
        }

        .vendor-user small {
            opacity: .8;
        }

        .vendor-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 13px 15px;
            color: white;
            text-decoration: none;
            border-radius: 14px;
            margin-bottom: 8px;
            transition: .3s;
        }

        .vendor-link:hover,
        .vendor-link.active {
            background: white;
            color: #0d6efd;
            transform: translateX(4px);
        }

        .vendor-content {
            margin-left: 270px;
        }

        .vendor-topbar {
            background: white;
            padding: 18px 28px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .vendor-page {
            padding: 30px;
        }

        @media(max-width:991px) {
            .vendor-sidebar {
                position: relative;
                width: 100%;
                min-height: auto;
            }

            .vendor-content {
                margin-left: 0;
            }
        }
         
    </style>
</head>

<body>

    <!-- Sidebar -->
    <div class="vendor-sidebar">

        <div class="vendor-logo">
            <i class="fa-solid fa-store"></i> Vendor Panel
        </div>

        <!-- <div class="vendor-user">
            <h6><?= $_SESSION['vendor_name'] ?? 'Vendor'; ?></h6>
            <small>Business Dashboard</small>
        </div> -->

        <a href="dashboard.php" class="vendor-link">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <a href="products.php" class="vendor-link">
            <i class="fa-solid fa-box"></i> Products
        </a>

        <a href="add_product.php" class="vendor-link">
            <i class="fa-solid fa-plus"></i> Add Product
        </a>

        <a href="orders.php" class="vendor-link">
            <i class="fa-solid fa-cart-shopping"></i> Orders
        </a>

        <a href="product_status.php" class="vendor-link">
            <i class="fa-solid fa-signal"></i> Product Status
        </a>

        <a href="membership.php" class="vendor-link">
            <i class="fa-solid fa-crown"></i> Membership
        </a>

        <a href="request_items.php" class="vendor-link">
            <i class="fa-solid fa-envelope"></i> Requests
        </a>

        <a href="profile.php" class="vendor-link">
            <i class="fa-solid fa-user"></i> Profile
        </a>

        <a href="logout.php" class="vendor-link">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>

    </div>

    <!-- Main Content -->
    <div class="vendor-content">

        <div class="vendor-topbar">
            <div>
                <h5 class="mb-0 fw-bold">Vendor Dashboard</h5>
                <small class="text-muted">Manage your business smoothly</small>
            </div>

            <div class="text-end">
                <small class="text-muted">Logged in as</small><br>
                <strong><?= $_SESSION['vendor_name'] ?? ''; ?></strong>
            </div>
        </div>

        <div class="vendor-page">