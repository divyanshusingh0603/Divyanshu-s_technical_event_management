<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current = basename($_SERVER['PHP_SELF']);
$userName = $_SESSION['user_name'] ?? 'User';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <style>
        body {
            background: #f4f7fb
        }

        .sidebar {
            width: 260px;
            min-height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #0b57d0);
            position: fixed;
            left: 0;
            top: 0;
            color: #fff
        }

        .brand {
            padding: 22px;
            font-size: 22px;
            font-weight: 700;
            border-bottom: 1px solid rgba(255, 255, 255, .15)
        }

        .sidebar a {
            color: #fff;
            text-decoration: none;
            display: flex;
            gap: 12px;
            align-items: center;
            padding: 12px 20px;
            border-radius: 12px;
            margin: 6px 12px
        }

        .sidebar a:hover,
        .sidebar a.active {
            background: rgba(255, 255, 255, .18)
        }

        .main {
            margin-left: 260px
        }

        .topbar {
            background: #fff;
            padding: 16px 24px;
            box-shadow: 0 4px 18px rgba(0, 0, 0, .06)
        }

        .content {
            padding: 24px
        }

        .avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 700
        }

        @media(max-width:991px) {
            .sidebar {
                position: relative;
                width: 100%;
                min-height: auto
            }

            .main {
                margin-left: 0
            }
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <div class="brand"><i class="fa-solid fa-calendar-check me-2"></i>User Panel</div>
        <div class="py-3">
            <a class="" .($current=='dashboard.php' ?'active':'')."" href="dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a>
            <a class="" .($current=='vendors.php' ?'active':'')."" href="vendors.php"><i class="fa-solid fa-store"></i> Vendors</a>
            <a class="" .($current=='cart.php' ?'active':'')."" href="cart.php"><i class="fa-solid fa-cart-shopping"></i> Cart</a>
            <!-- <a class="" .($current=='checkout.php' ?'active':'')."" href="checkout.php"><i class="fa-solid fa-credit-card"></i> Checkout</a> -->
            <a class="" .($current=='order_status.php' ?'active':'')."" href="order_status.php"><i class="fa-solid fa-box"></i> Orders</a>
            <a class="" .($current=='request_item.php' ?'active':'')."" href="request_item.php"><i class="fa-solid fa-paper-plane"></i> Request Item</a>
            <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
        </div>
    </div>
    <div class="main">
        <div class="topbar d-flex justify-content-between align-items-center">
            <div>
                <h5 class="mb-0">Welcome, <?php echo htmlspecialchars($userName); ?></h5>
                <small class="text-muted">Manage your bookings, cart and orders</small>
            </div>
            <div class="d-flex align-items-center gap-2">
                <div class="avatar"><?php echo strtoupper(substr($userName, 0, 1)); ?></div>
            </div>
        </div>
        <div class="content">
            <!-- Page Content Starts -->