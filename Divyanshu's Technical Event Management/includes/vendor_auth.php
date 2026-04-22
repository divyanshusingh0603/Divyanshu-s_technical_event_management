<?php
session_start();

if (!isset($_SESSION['vendor_id'])) {
    header("Location: login.php");
    exit();
}
