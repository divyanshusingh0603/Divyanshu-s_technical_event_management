<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/admin_layout.php");
if (isset($_POST['save'])) {
    $business = mysqli_real_escape_string($conn, $_POST['business_name']);
    $owner    = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = md5($_POST['password']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $status   = $_POST['status'];

    $check = mysqli_query($conn, "SELECT id FROM vendors WHERE email='$email'");
    if (mysqli_num_rows($check) > 0) {
        $error = "Email already exists.";
    } else {
        mysqli_query($conn, "INSERT INTO vendors
        (business_name,owner_name,email,password,phone,address,status)
        VALUES
        ('$business','$owner','$email','$password','$phone','$address','$status')");
        header("Location: vendors.php");
        exit();
    }
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="main-card rounded shadow">

        <h3 class="mb-4">Add Vendor</h3>

        <?php if (isset($error)) { ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php } ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Business Name</label>
                    <input type="text" name="business_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Owner Name</label>
                    <input type="text" name="owner_name" class="form-control">
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

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="blocked">Blocked</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"></textarea>
                </div>
            </div>

            <button type="submit" name="save" class="btn btn-success">Save Vendor</button>
            <a href="vendors.php" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</div>

<?php include("../includes/footer.php"); ?>