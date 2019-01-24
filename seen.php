<?php
include "dbconnection.php";

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $updateComp = DB::query("UPDATE `complains` SET `state` = '1' WHERE `complains`.`issue_no` = '$id' ");

    header("Location: dash#comp");
}
