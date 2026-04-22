<?php
include("../includes/vendor_auth.php");
include("vendor_layout.php");
include("../includes/db.php");
include("../includes/header.php");

$vendor_id = $_SESSION['vendor_id'];

if (isset($_POST['buy'])) {
    $membership_id = (int)$_POST['membership_id'];

    $plan = mysqli_fetch_assoc(mysqli_query($conn, "
        SELECT * FROM memberships WHERE id='$membership_id'
    "));

    $start = date('Y-m-d');
    $end = date('Y-m-d', strtotime("+" . $plan['duration_months'] . " months"));

    mysqli_query($conn, "
        INSERT INTO vendor_memberships
        (vendor_id,membership_id,start_date,end_date,payment_status)
        VALUES
        ('$vendor_id','$membership_id','$start','$end','paid')
    ");

    mysqli_query($conn, "
        UPDATE vendors SET membership_id='$membership_id'
        WHERE id='$vendor_id'
    ");

    $success = "Membership Activated Successfully!";
}

$plans = mysqli_query($conn, "SELECT * FROM memberships");
?>

<div class="container py-4">
    <div class="bg-white shadow rounded-4 p-4">

        <h3 class="mb-4">Membership Plans</h3>

        <?php if (isset($success)) { ?>
            <div class="alert alert-success"><?= $success ?></div>
        <?php } ?>

        <div class="row g-4">
            <?php while ($p = mysqli_fetch_assoc($plans)) { ?>
                <div class="col-md-4">
                    <div class="card shadow-sm border-0 rounded-4 h-100">
                        <div class="card-body text-center">
                            <h4><?= $p['membership_name'] ?></h4>
                            <h2 class="text-primary">₹<?= $p['price'] ?></h2>
                            <p><?= $p['duration_months'] ?> Months</p>
                            <p><?= $p['features'] ?></p>

                            <form method="POST">
                                <input type="hidden" name="membership_id" value="<?= $p['id'] ?>">
                                <button type="submit" name="buy" class="btn btn-success w-100">
                                    Choose Plan
                                </button>
                            </form>

                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>

        <a href="dashboard.php" class="btn btn-secondary mt-4">Back</a>

    </div>
</div>

<?php include("../includes/footer.php"); ?>