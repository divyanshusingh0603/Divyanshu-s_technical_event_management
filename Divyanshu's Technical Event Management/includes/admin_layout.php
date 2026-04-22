<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$current = basename($_SERVER['PHP_SELF']);
$adminName = $_SESSION['admin_name'] ?? 'Admin';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            background: #f4f7fb;
            font-family: Segoe UI, sans-serif;
        }

        .admin-sidebar {
            width: 270px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background: linear-gradient(180deg, #111827, #1f2937);
            color: #fff;
            padding: 22px 16px;
            overflow-y: auto;
            z-index: 999;
        }

        .admin-brand {
            font-size: 24px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .admin-user {
            background: rgba(255, 255, 255, .08);
            border-radius: 18px;
            padding: 15px;
            margin-bottom: 20px;
        }

        .admin-link {
            display: flex;
            gap: 12px;
            align-items: center;
            color: #fff;
            text-decoration: none;
            padding: 13px 15px;
            border-radius: 14px;
            margin-bottom: 8px;
            transition: .3s;
        }

        .admin-link:hover,
        .admin-link.active {
            background: #fff;
            color: #111827;
            transform: translateX(4px);
        }

        .admin-content {
            margin-left: 270px;
        }

        .admin-topbar {
            background: #fff;
            padding: 18px 28px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, .05);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .admin-page {
            padding: 30px;
        }

        .stat-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
        }

        @media(max-width:991px) {
            .admin-sidebar {
                position: relative;
                width: 100%;
                height: auto;
            }

            .admin-content {
                margin-left: 0;
            }
        }
    </style>
</head>

<body>

    <div class="admin-sidebar">

        <div class="admin-brand">
            <i class="fa-solid fa-shield-halved"></i> Admin Panel
        </div>
        <!-- 
        <div class="admin-user">
            <div class="fw-bold"><?= $adminName ?></div>
            <small class="text-light opacity-75">System Administrator</small>
        </div> -->

        <a href="dashboard.php" class="admin-link <?= $current == 'dashboard.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-chart-line"></i> Dashboard
        </a>

        <a href="users.php" class="admin-link <?= $current == 'users.php' || $current == 'add_user.php' || $current == 'edit_user.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-users"></i> Manage Users
        </a>

        <a href="vendors.php" class="admin-link <?= $current == 'vendors.php' || $current == 'add_vendor.php' || $current == 'edit_vendor.php' ? 'active' : '' ?>">
            <i class="fa-solid fa-store"></i> Manage Vendors
        </a>

        <a href="logout.php" class="admin-link">
            <i class="fa-solid fa-right-from-bracket"></i> Logout
        </a>

    </div>

    <div class="admin-content">

        <div class="admin-topbar">
            <div>
                <h5 class="mb-0 fw-bold">Welcome, <?= $adminName ?></h5>
                <small class="text-muted">Manage platform users & vendors</small>
            </div>

            <div>
                <span class="badge bg-dark px-3 py-2">Admin Access</span>
            </div>
        </div>

        <div class="admin-page">