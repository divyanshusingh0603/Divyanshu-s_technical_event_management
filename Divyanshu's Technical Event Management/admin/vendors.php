<?php
include("../includes/auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("../includes/admin_layout.php");
$vendors = mysqli_query($conn, "SELECT * FROM vendors ORDER BY id DESC");

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    mysqli_query($conn, "DELETE FROM vendors WHERE id='$id'");
    header("Location: vendors.php");
}
?>

<div class="container py-4">
    <div class="main-card rounded shadow">

        <div class="d-flex justify-content-between mb-3">
            <h3>Vendor Management</h3>
            <a href="add_vendor.php" class="btn btn-success">+ Add Vendor</a>
        </div>

        <table class="table table-bordered bg-white">
            <tr>
                <th>ID</th>
                <th>Business</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Status</th>
                <th>Action</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($vendors)) { ?>
                <tr>
                    <td><?= $row['id']; ?></td>
                    <td><?= $row['business_name']; ?></td>
                    <td><?= $row['email']; ?></td>
                    <td><?= $row['phone']; ?></td>
                    <td><?= $row['status']; ?></td>
                    <td>
                        <a href="edit_vendor.php?id=<?= $row['id']; ?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="?delete=<?= $row['id']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</div>

<?php include("../includes/footer.php"); ?>