<?php
/**
 * Created by PhpStorm.
 * User: Kobby
 * Date: 4/16/2018
 * Time: 3:37 PM
 */
session_start();
session_destroy();
header("Location: adminIndex");//use for the redirection to some page
?>