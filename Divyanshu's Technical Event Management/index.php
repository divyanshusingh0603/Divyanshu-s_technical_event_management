<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Technical Event Management System</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0d6efd, #6f42c1, #0dcaf0);
            background-size: 300% 300%;
            animation: bgMove 12s ease infinite;
            font-family: Segoe UI, sans-serif;
        }

        @keyframes bgMove {
            0% {
                background-position: 0% 50%;
            }

            50% {
                background-position: 100% 50%;
            }

            100% {
                background-position: 0% 50%;
            }
        }

        .glass-card {
            background: rgba(255, 255, 255, .14);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: 24px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .15);
        }

        .login-card {
            background: #fff;
            border: none;
            border-radius: 20px;
            transition: .3s;
            height: 100%;
        }

        .login-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, .12);
        }

        .icon-box {
            width: 70px;
            height: 70px;
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #fff;
            margin: auto;
        }

        .hero-title {
            font-size: 2.3rem;
            font-weight: 800;
        }

        .small-text {
            color: rgba(255, 255, 255, .85);
        }
    </style>
</head>

<body>

    <div class="container py-5">

        <div class="glass-card p-4 p-md-5">

            <!-- Header -->
            <div class="text-center mb-5 text-white">
                <h1 class="hero-title">Technical Event Management System</h1>
                <p class="small-text mb-0">
                    Manage users, vendors, products, orders & custom requests from one smart platform.
                </p>
            </div>

            <!-- Login Options -->
            <div class="row g-4">

                <!-- Admin -->
                <div class="col-md-4">
                    <div class="login-card p-4 text-center">
                        <div class="icon-box bg-dark mb-3">
                            <i class="fa-solid fa-shield-halved"></i>
                        </div>

                        <h4 class="fw-bold">Admin Panel</h4>
                                              <a href="admin/login.php" class="btn btn-dark w-100 rounded-pill">
                            Admin Login
                        </a>
                    </div>
                </div>

                <!-- Vendor -->
                <div class="col-md-4">
                    <div class="login-card p-4 text-center">
                        <div class="icon-box bg-primary mb-3">
                            <i class="fa-solid fa-store"></i>
                        </div>

                        <h4 class="fw-bold">Vendor Panel</h4>
                       

                        <a href="vendor/login.php" class="btn btn-primary w-100 rounded-pill">
                            Vendor Login
                        </a>
                    </div>
                </div>

                <!-- User -->
                <div class="col-md-4">
                    <div class="login-card p-4 text-center">
                        <div class="icon-box bg-success mb-3">
                            <i class="fa-solid fa-user"></i>
                        </div>

                        <h4 class="fw-bold">User Panel</h4>
                       
                        <div class="d-grid gap-2">
                            <a href="user/login.php" class="btn btn-success rounded-pill">
                                User Login
                            </a>

                            <a href="user/signup.php" class="btn btn-outline-success rounded-pill">
                                Sign Up
                            </a>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>