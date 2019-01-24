<?php
/**
 * Created by PhpStorm.
 * User: Kobby
 * Date: 4/16/2018
 * Time: 2:56 PM
 */
session_start();

//include "database/dbcon.php";
include "dbconnection.php";


if (isset($_POST['signin'])) {

    $adminUserName = $_POST['username'];

    $adminPassWord = $_POST['password'];

    $result = DB::query("SELECT username, password FROM administrator");


    foreach ($result as $row) {

        if (password_verify($adminUserName, $row['username']) && password_verify($adminPassWord, $row['password'])) {
            $_SESSION['user'] = $adminUserName;
            echo "<script>window.open('dash','_self')</script>";
        } else {
            echo "<script>alert('Incorrect credentials!');window.open('adminIndex','_self')</script>";
        }
    }
}
