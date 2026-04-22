<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/admin_layout.php");
if (isset($_POST['save'])) {
    $name     = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $status   = $_POST['status'];

    $check = mysqli_query($conn, "SELECT id FROM users WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists.";
    } else {
        mysqli_query($conn, "INSERT INTO users(full_name,email,password,phone,address,status)
        VALUES('$name','$email','$password','$phone','$address','$status')");
        header("Location: users.php");
        exit();
    }
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="main-card rounded shadow">
        <div class="d-flex justify-content-between mb-4">
            <a href="users.php" class="top-box text-decoration-none">Back</a>
            <a href="logout.php" class="top-box text-decoration-none">Logout</a>
        </div>

        <h3 class="mb-4">Add User</h3>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="full_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active">Active</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>
            </div>

            <button type="submit" name="save" class="btn btn-success">Save User</button>
        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>