<?php
session_start();
unset($_SESSION['vendor_id']);
unset($_SESSION['vendor_name']);
session_destroy();

header("Location: login.php");
exit();
