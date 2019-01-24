<?php
include "dbconnection.php";
if (isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])) {
    // Verify data
    $email = $_GET['email']; // Set email variable
    $hash = $_GET['hash']; // Set hash variable

    $search = DB::query("SELECT emailaddress, hash, active FROM student WHERE emailaddress='" . $email . "' AND hash='" . $hash . "' AND active='0'");

    if (DB::count() == 1) {
        $query = DB::query("UPDATE student SET active='1' WHERE emailaddress='" . $email . "' AND hash='" . $hash . "' AND active='0'") or die(mysqli_error());

        echo "<script>alert('Account Activated! Proceed to Log in')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('The url is either invalid or you already have activated your account.')</script>";
        echo "<script>window.open('index.php','_self')</script>";
    }
} else {
    echo "<script>alert('Activate Account from Email link sent to you')</script>";
    echo "<script>window.open('index.php','_self')</script>";
}
