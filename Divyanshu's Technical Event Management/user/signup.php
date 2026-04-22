<?php
include("../includes/db.php");

if (isset($_POST['signup'])) {
    $name = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pass = md5($_POST['password']);

    mysqli_query($conn, "
        INSERT INTO users(full_name,email,password)
        VALUES('$name','$email','$pass')
    ");

    header("Location: login.php");
    exit();
}
include("../includes/header.php");
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">
                    <h3 class="mb-4 text-center">User Sign Up</h3>

                    <form method="POST">
                        <input type="text" name="full_name" class="form-control mb-3" placeholder="Full Name" required>
                        <input type="email" name="email" class="form-control mb-3" placeholder="Email" required>
                        <input type="password" name="password" class="form-control mb-3" placeholder="Password" required>

                        <button name="signup" class="btn btn-primary w-100">Create Account</button>
                        <a href="login.php" class="btn btn-light border w-100 mt-2">Login</a>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>