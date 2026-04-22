<?php
session_start();
include("../includes/db.php");

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "
        SELECT * FROM vendors 
        WHERE email='$email' 
        AND password='$password'
        AND status='approved'
    ");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);

        $_SESSION['vendor_id'] = $row['id'];
        $_SESSION['vendor_name'] = $row['business_name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid credentials or account not approved.";
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-5">
                    <h2 class="text-center mb-4">Vendor Login</h2>

                    <?php if (isset($error)) { ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php } ?>

                    <form method="POST">
                        <div class="mb-3">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control form-control-lg" required>
                        </div>

                        <div class="mb-3">
                            <label>Password</label>
                            <input type="password" name="password" class="form-control form-control-lg" required>
                        </div>

                        <div class="d-grid">
                            <button type="submit" name="login" class="btn btn-primary btn-lg">
                                Login
                            </button>
                        </div>

                        <div class="text-center mt-3">
                            <a href="../index.php">Back to Home</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>