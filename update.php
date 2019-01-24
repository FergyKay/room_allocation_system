<?php
session_start();
include "database/dbcon.php";
$user_email=$_SESSION['email'];

if (isset($_POST['update'])) {


    $contact1 = mysqli_real_escape_string($dbcon, $_POST['contact']);
    $contact2 = mysqli_real_escape_string($dbcon, $_POST['contactE']);
    // $nationality = mysqli_real_escape_string($dbcon, $_POST['nationality']);
    // $sex = mysqli_real_escape_string($dbcon, $_POST['sex']);

    $update = "Update student set contact ='$contact1', alt_contact='$contact2', updated = 'disabled' WHERE emailAddress='$user_email' AND active='1'";
    $result = mysqli_query($dbcon, $update);

    if (mysqli_query($dbcon, $update)) {
         header("Location: apply");
    } else {
        echo "<script>alert('Check Information!!');window.open('welcome','_self')</script>";
        // header("Location: apply.php");

    }
}


