<?php
session_start();

//include "database/dbcon.php";
include "dbconnection.php";


if (isset($_POST['signin'])) {
   // $user_email = mysqli_real_escape_string($dbcon, $_POST['email']);
    $user_email = $_POST['email'];

   // $user_pass = mysqli_real_escape_string($dbcon, $_POST['password']);
    $user_pass =  $_POST['password'];
    //$getId = "select index_no, passkey from student WHERE emailAddress='$user_email' AND active='1'";

    $result = DB::query("select index_no, passkey from student WHERE emailAddress='$user_email' AND active='1'");
    if(DB::count()==0){
        echo "<script>alert('Email does not exist')</script>";
    }
    //$result = mysqli_query($dbcon, $getId);

   // $row = mysqli_fetch_array($result);

    foreach ($result as $row) {
    if (password_verify($user_pass, $row['passkey'])) {
            echo "<script>window.open('welcome','_self')</script>";
            $_SESSION['index'] = $row['index_no'];
            $_SESSION['email'] = $user_email; //here session is used and value of $user_email store in $_SESSION.
        } else {
            echo "<script>alert('Password is incorrect!');window.open('','_self')</script>";
        }
    }
}
?>

<html>

<head>
    <title>Welcome</title>
    <meta name="viewport" content="width = device-width, initial-scale = 1">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
    <link rel="icon" href="images/backimages/icon.png">
    <link rel="stylesheet" href="css/materialize.min.css">
    <script type="text/javascript" src="jquery/jquery.js"></script>
    <script src="js/materialize.min.js">
    </script>
</head>

<body class="center-align blue black-text"
      style="background-image: url(images/backimages/back4.jpg);background-attachment: fixed; background-size: cover">
<div class="row">
    <div class="center-block col xl2 m2 l2 zl2 left-align" style="background-attachment: fixed">
        <a href="http://rmu.edu.gh"><img src="images/backimages/logo.jpg" height="80px" width="80px"
                                         style="margin-left: 20px; margin-top: 2px;"></a>
    </div>
</div>

<div class="valign-wrapper">
    <!--    <div class="valign" style="width:100%;">-->
    <div class="container no-pad-bot">
        <div class="row ">
            <div class="col s12 m12 xl6 l6 offset-l off offset-xl3 offset-l3 modal-content">
                <div class="row">
                    <div class="col s12 xl12 l12 m12">
                        <ul class="tabs ">
                            <li class="tab col s6 m6 l6 xl6">
                                <a href="#login">Login</a>
                            </li>
                            <li class="tab col s6 m6 l6 xl6">
                                <a href="#register">Register</a>
                            </li>
                        </ul>
                    </div>
                    <div id="login" class="col s12">
                        <div class="card" style="background: rgba(255,255,255,0.95)">
                            <div class="card-content">
                                <div class="row">
                                    <span class="card-title black-text"> Please Sign With email to proceed</span>

                                    <form action="index" method="post">
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="email" type="email" name="email" class="validate" required>
                                                <label for="email" class="active">Email Address</label>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="input-field col s12">
                                                <input id="password" type="password" name="password" class="validate"
                                                       required>
                                                <label for="password" class="active">Password</label>
                                            </div>
                                        </div>
                                </div>
                                <div class="card-action transparent">
                                    <input type="submit" class="btn" value="Sign In" name="signin">
                                </div>
                                </form>

                            </div>
                        </div>
                    </div>
                    <div id="register" class="col s12">
                        <div class="card" style="background: rgba(255,255,255,0.95)">
                            <div class="card-content">
                                <span class="card-title black-text"> Please Register</span>
                                <form action="reg.php" method="post">
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="index" type="text" name="index" class="validate"
                                                   style="text-transform: uppercase" maxlength="10" minlength="10"
                                                   required>
                                            <label for="index" class="active">Index Number</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="email" type="email" name="email" class="validate" required>
                                            <label for="email" class="active">Provide a Valid Email Address</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password" type="password" name="password" class="validate"
                                                   required>
                                            <label for="password" class="active">Password</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <input id="password2" type="password" name="password2" class="validate"
                                                   required>
                                            <label for="password2" class="active">Retype Password</label>
                                        </div>
                                    </div>
                                    <div class="card-action transparent">
                                        <input type="submit" class="btn" value="Register" name="register">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

<footer class="page-footer blue darken-2" style="
        position: fixed;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #efefef;
        text-align: center;">
    <div class="footer-copyright white-text ">
        <div class="container">© 2018 Copyright ICT Department
            <a class="grey-text text-lighten-4 right" href="#!"></a>
        </div>
    </div>
</footer>

</html>
