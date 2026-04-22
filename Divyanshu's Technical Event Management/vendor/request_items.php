<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("../includes/header.php");
include("vendor_layout.php");
$data = mysqli_query($conn, "
SELECT r.*, u.full_name
FROM request_items r
JOIN users u ON u.id = r.user_id
ORDER BY r.id DESC
");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">
        <h3 class="mb-4">Requested Items</h3>

        <table class="table table-bordered">
            <tr>
                <th>User</th>
                <th>Title</th>
                <th>Description</th>
                <th>Budget</th>
                <th>Status</th>
            </tr>

            <?php while ($row = mysqli_fetch_assoc($data)) { ?>
                <tr>
                    <td><?= $row['full_name'] ?></td>
                    <td><?= $row['title'] ?></td>
                    <td><?= $row['description'] ?></td>
                    <td>₹<?= $row['budget'] ?></td>
                    <td><?= $row['request_status'] ?></td>
                </tr>
            <?php } ?>

        </table>

        <a href="dashboard.php" class="btn btn-secondary">Back</a>
    </div>
</div>

<?php include("../includes/footer.php"); ?>