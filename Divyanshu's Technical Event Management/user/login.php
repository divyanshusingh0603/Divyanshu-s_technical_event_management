<?php
session_start();
include("../includes/db.php");

$error = "";

if (isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    $q = mysqli_query($conn, "
        SELECT * FROM users
        WHERE email='$email'
        AND password='$pass'
        AND status='active'
    ");

    if (mysqli_num_rows($q) > 0) {
        $row = mysqli_fetch_assoc($q);

        $_SESSION['user_id'] = $row['id'];
        $_SESSION['user_name'] = $row['full_name'];

        header("Location: dashboard.php");
        exit();
    } else {
        $error = "Invalid Login";
    }
}
include("../includes/header.php");
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">

                    <h3 class="text-center mb-4">User Login</h3>

                    <?php if ($error != "") { ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php } ?>

                    <form method="POST">
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email">
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password">

                        <button name="login" class="btn btn-success w-100">Login</button>
                        <a href="signup.php" class="btn btn-light border w-100 mt-2">Create Account</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>