<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/admin_layout.php");
$id = (int)$_GET['id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM users WHERE id='$id'"));

if (!$user) {
    header("Location: users.php");
    exit();
}

if (isset($_POST['update'])) {
    $name    = mysqli_real_escape_string($conn, $_POST['full_name']);
    $email   = mysqli_real_escape_string($conn, $_POST['email']);
    $phone   = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $status  = $_POST['status'];

    mysqli_query($conn, "UPDATE users SET
        full_name='$name',
        email='$email',
        phone='$phone',
        address='$address',
        status='$status'
        WHERE id='$id'
    ");

    if (!empty($_POST['password'])) {
        $password = md5($_POST['password']);
        mysqli_query($conn, "UPDATE users SET password='$password' WHERE id='$id'");
    }

    header("Location: users.php");
    exit();
}

include("../includes/header.php");
?>

<div class="container py-4">
    <div class="main-card rounded shadow">
        <h3 class="mb-4">Edit User</h3>

        <form method="POST">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label>Name</label>
                    <input type="text" name="full_name" value="<?= $user['full_name'] ?>" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Email</label>
                    <input type="email" name="email" value="<?= $user['email'] ?>" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>New Password (optional)</label>
                    <input type="password" name="password" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Phone</label>
                    <input type="text" name="phone" value="<?= $user['phone'] ?>" class="form-control">
                </div>

                <div class="col-md-12 mb-3">
                    <label>Address</label>
                    <textarea name="address" class="form-control"><?= $user['address'] ?></textarea>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Status</label>
                    <select name="status" class="form-control">
                        <option value="active" <?= $user['status'] == 'active' ? 'selected' : ''; ?>>Active</option>
                        <option value="blocked" <?= $user['status'] == 'blocked' ? 'selected' : ''; ?>>Blocked</option>
                    </select>
                </div>
            </div>

            <button type="submit" name="update" class="btn btn-primary">Update User</button>
            <a href="users.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include("../includes/footer.php"); ?>