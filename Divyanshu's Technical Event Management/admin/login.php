<?php
session_start();
include("../includes/db.php");

if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $query = mysqli_query($conn, "SELECT * FROM admins WHERE email='$email' AND password='$password'");

    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
        $_SESSION['admin_id'] = $row['id'];
        $_SESSION['admin_name'] = $row['full_name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Login Credentials";
    }
}
?>

<?php include("../includes/header.php"); ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow p-4">
                <h3 class="text-center mb-4">Admin Login</h3>

                <?php if (isset($error)) { ?>
                    <div class="alert alert-danger"><?= $error; ?></div>
                <?php } ?>

                <form method="POST">
                    <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                    <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
                    <button type="submit" name="login" class="btn btn-primary w-100">Login</button>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>