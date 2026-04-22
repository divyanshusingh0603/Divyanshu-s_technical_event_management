<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");

$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['save'])) {
    $business = mysqli_real_escape_string($conn, $_POST['business_name']);
    $owner    = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);

    mysqli_query($conn, "
        UPDATE vendors SET
        business_name='$business',
        owner_name='$owner',
        email='$email',
        phone='$phone',
        address='$address'
        WHERE id='$vendor_id'
    ");

    if (!empty($_POST['password'])) {
        $pass = md5($_POST['password']);
        mysqli_query($conn, "UPDATE vendors SET password='$pass' WHERE id='$vendor_id'");
    }

    $_SESSION['vendor_name'] = $business;
    $msg = "Profile Updated Successfully";
}

$data = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vendors WHERE id='$vendor_id'"));
include("../includes/header.php");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Vendor Profile</h3>

        <?php if (isset($msg)) { ?>
            <div class="alert alert-success"><?= $msg ?></div>
        <?php } ?>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Business Name</label>
                    <input type="text" name="business_name" value="<?= $data['business_name'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Owner Name</label>
                    <input type="text" name="owner_name" value="<?= $data['owner_name'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $data['email'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= $data['phone'] ?>" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?= $data['address'] ?></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>New Password</label>
                    <input type="password" name="password" class="form-control">
                </div>
            </div>

            <button class="btn btn-primary" name="save">Update Profile</button>
            <a href="dashboard.php" class="btn btn-secondary">Back</a>
        </form>

    </div>
</div>

<?php include("../includes/footer.php"); ?>