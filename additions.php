<?php
include "dbconnection.php";

if (isset($_POST['updateHall'])) {
    $hallName = strtoupper($_POST['hallName']);
    $query = DB::query("insert into  `hall` (`hall_name`) VALUES ('$hallName')");

}
if (isset($_GET['parent'])) {
    $id = $_GET['parent'];
    $sex = (($_GET['sex'] == 'Male') ? 0 : 1);
    $capacity = $_GET['capacity'];
    $query = DB::query("insert into `room` (`sextype`,`hall_id`,`bed_count_init`,`bed_count_current`) VALUES ('$sex','$id','$capacity','$capacity')");

}
header("Location: dash#");