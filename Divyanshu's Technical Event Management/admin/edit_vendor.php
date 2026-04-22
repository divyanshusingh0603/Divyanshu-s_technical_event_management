<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/admin_layout.php");
$id = (int)$_GET['id'];
$vendor = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM vendors WHERE id='$id'"));

if (!$vendor) {
    header("Location: vendors.php");
    exit();
}

if (isset($_POST['update'])) {
    $business = mysqli_real_escape_string($conn, $_POST['business_name']);
    $owner    = mysqli_real_escape_string($conn, $_POST['owner_name']);
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $phone    = mysqli_real_escape_string($conn, $_POST['phone']);
    $address  = mysqli_real_escape_string($conn, $_POST['address']);
    $status   = $_POST['status'];

    mysqli_query($conn, "UPDATE vendors SET
        business_name='$business',
        owner_name='$owner',
        email='$email',
        phone='$phone',
        address='$address',
        status='$status'
        WHERE id='$id'
    ");

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        mysqli_query($conn, "UPDATE vendors SET password='$password' WHERE id='$id'");
    }

    header("Location: vendors.php");
    exit();
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="main-card rounded shadow">

        <h3 class="mb-4">Edit Vendor</h3>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Business Name</label>
                    <input type="text" name="business_name" value="<?= $vendor['business_name'] ?>" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Owner Name</label>
                    <input type="text" name="owner_name" value="<?= $vendor['owner_name'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $vendor['email'] ?>" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= $vendor['phone'] ?>" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="pending" <?= $vendor['status'] == 'pending' ? 'selected' : ''; ?>>Pending</option>
                        <option value="approved" <?= $vendor['status'] == 'approved' ? 'selected' : ''; ?>>Approved</option>
                        <option value="blocked" <?= $vendor['status'] == 'blocked' ? 'selected' : ''; ?>>Blocked</option>
                    </select>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?= $vendor['address'] ?></textarea>
                </div>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update Vendor</button>
            <a href="vendors.php" class="btn btn-secondary">Cancel</a>
        </form>

    </div>
</div>

<?php include("../includes/footer.php"); ?>