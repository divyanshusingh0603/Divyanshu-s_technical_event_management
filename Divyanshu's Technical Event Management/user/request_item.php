<?php
include("../includes/user_auth.php");
include("user_layout.php");
include("../includes/db.php");

$user_id = $_SESSION['user_id'];

if (isset($_POST['send'])) {
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $desc = mysqli_real_escape_string($conn, $_POST['description']);
    $budget = $_POST['budget'];

    mysqli_query($conn, "
        INSERT INTO request_items(user_id,title,description,budget)
        VALUES('$user_id','$title','$desc','$budget')
    ");

    $msg = "Request Submitted";
}

include("../includes/header.php");
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow border-0 rounded-4">
                <div class="card-body p-4">

                    <h3 class="mb-4">Request Custom Item</h3>

                    <?php if (isset($msg)) { ?>
                        <div class="alert alert-success"><?= $msg ?></div>
                    <?php } ?>

                    <form method="POST">
                        <input type="text" name="title" class="form-control mb-3" placeholder="Item Title" required>
                        <textarea name="description" class="form-control mb-3" placeholder="Description"></textarea>
                        <input type="number" name="budget" class="form-control mb-3" placeholder="Budget">

                        <button name="send" class="btn btn-primary w-100">Submit Request</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include("../includes/footer.php"); ?>