<?php
include("../includes/vendor_auth.php");
include("../includes/db.php");
include("vendor_layout.php");

$order_id = (int)$_GET['id'];

if (isset($_POST['save'])) {
    $status = $_POST['status'];

    mysqli_query($conn, "
        UPDATE orders SET order_status='$status'
        WHERE id='$order_id'
    ");

    header("Location: orders.php");
    exit();
}

include("../includes/header.php");
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="bg-white shadow rounded-4 p-4">

                <h3 class="mb-4 text-center">Update Order Status</h3>

                <form method="POST">
                    <div class="mb-3">
                        <label>Status</label>
                        <select name="status" class="form-select form-select-lg">
                            <option value="placed">Placed</option>
                            <option value="confirmed">Confirmed</option>
                            <option value="processing">Processing</option>
                            <option value="ready for shipping">Ready for Shipping</option>
                            <option value="out for delivery">Out For Delivery</option>
                            <option value="completed">Completed</option>
                            <option value="cancelled">Cancelled</option>
                        </select>
                    </div>

                    <button class="btn btn-primary w-100" name="save">Update Status</button>
                    <a href="orders.php" class="btn btn-secondary w-100 mt-2">Back</a>
                </form>

            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>