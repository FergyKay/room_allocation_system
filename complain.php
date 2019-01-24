<?php
/**
 * Created by PhpStorm.
 * User: Kobby
 * Date: 4/18/2018
 * Time: 3:22 PM
 */
session_start();
include "dbconnection.php";
$user = $_SESSION['email'];
if (isset($_POST['submit'])) {



    $id=DB::queryRaw("select index_No from student where emailaddress like '$user'");
    $row = $id->fetch_assoc();
    $index= $row['index_No'];
    $complain = $_POST['comp'];
    $date = $_POST['date'];

    $query = DB::query("insert into `complains` (`issue_date`,`student_id`,`complain`) VALUES ('$date','$index','$complain')");

    echo "<script>alert('Complaint Submitted!');window.open('welcome','_self')</script>";
    //header("Location: welcome");

}