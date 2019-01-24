<?php
session_start();

include "database/dbcon.php";

if (isset($_POST['signin'])) {
    $user_email = mysqli_real_escape_string($dbcon, $_POST['email']);

    $user_pass = mysqli_real_escape_string($dbcon, $_POST['password']);

    $getId = "select index_no, passkey from student WHERE emailAddress='$user_email' AND active='1'";
    $result = mysqli_query($dbcon, $getId);

    $row = mysqli_fetch_array($result);
    if (password_verify($user_pass, $row['passkey'])) {
        echo "<script>window.open('welcome.php','_self')</script>";

        $_SESSION['index'] = $row['index_no'];

        $_SESSION['email'] = $user_email; //here session is used and value of $user_email store in $_SESSION.
    } else {

        echo "<script>alert('Email or password is incorrect!')</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <!--Import Google Icon Font-->
    <!--    <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">-->
    <link href="fonts/material-design-icons-2.2.0/material-design-icons-2.2.0/iconfont/material-icons.css"
          rel="stylesheet">

    <!--Import materialize.css-->
    <link rel="stylesheet" href="css/materialize.min.css">
    <link rel="icon" href="images/logo153x153.jpg" type="image/x-icon"/>
    <!--<link rel="stylesheet" href="css/social.css">-->


    <!--Let browser know website is optimized for mobile-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Home</title>
</head>
<header>

</header>

<body class="center-align blue black-text" style="background-image: url(images/backimages/back4.jpg);background-attachment: fixed; background-size: cover; overflow: hidden">

<div class="row">
    <div class="center-block col x2 left-align" style="background-attachment: fixed">
        <a href="http://rmu.edu.gh"><img src="images/backimages/logo.jpg" height="80px" width="80px"
                                         style="margin-left: 20px; margin-top: 2px"></a>
    </div>
    <div class="col x4 center-align offset-xl2">
        <!--        <div class="flow-text">Room Allocation System</div>-->
    </div>
</div>

<div class="valign-wrapper">
    <!--    <div class="valign" style="width:100%;">-->
    <div class="container no-pad-bot">
        <div class="row ">
            <div class="col s12 m12 xl6 l6 offset-l off offset-xl3 offset-l3 modal-content">
                <div class="card" style="background: rgba(255,255,255,0.95)">
                    <div class="card-content">
                    <div class="row">
        <div class="col s12">
            <ul class="tabs">
                <li class="tab col s3">
                    <a href="#inbox">Inbox</a>
                </li>
                <li class="tab col s3">
                    <a class="active" href="#unread">
                        Unread</a>
                </li>
                <li class="tab col s3 disabled">
                    <a href="#outbox">
                        Outbox (Disabled)</a>
                </li>
                <li class="tab col s3">
                    <a href="#sent">Sent</a>
                </li>
            </ul>
        </div>

        <div id="inbox" class="col s12">Inbox</div>
        <div id="unread" class="col s12">Unread</div>
        <div id="outbox" class="col s12">Outbox (Disabled)</div>
        <div id="sent" class="col s12">Sent</div>
    </div>
                        <span class="card-title black-text"> Please Sign With RMU email to proceed</span>
                        <br>
                        <form action="indexOld.php" method="post">
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" name="email" class="validate" required>
                                    <label for="email" class="active">Email Address</label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password" class="validate" required>
                                    <label for="password" class="active">Password</label>
                                </div>
                            </div>
                    </div>
                    <div class="card-action transparent">
                        <input type="submit" class="btn" value="Sign In" name="signin">
                    </div>
                    </form>
                    <div>
                        <a href="register.html" class=" lighten-2  teal-text">New here? Please
                            register</a>
                        <br><br>
                    </div>
                </div>
            </div>
        </div>
        <!--        </div>-->
    </div>
</div>

<footer class="page-footer blue darken-4" style="position: absolute;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #efefef;
        text-align: center;">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="white-text"></h5>
                <p class="grey-text text-lighten-4"></p>
            </div>
            <div class="col l4 offset-l2 s12">
                <h5 class="white-text"></h5>
                <ul>

                </ul>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">© 2018 Copyright ICT Department
            <a class="grey-text text-lighten-4 right" href="#!"></a>
        </div>
    </div>
</footer>


<script type="text/javascript" src="js/materialize.min.js"></script>
<script type="text/javascript" src="jquery/jquery.js"></script>

<script>
    $(document).ready(function () {
        // Init Carousel
        $('.carousel').carousel();

        // Init Carousel Slider
        $('.carousel.carousel-slider').carousel({fullWidth: true});

        // Fire off toast
        //Materialize.toast('Hello World', 3000);

        // Init Slider
        $('.slider').slider();

        // Init Modal
        $('.modal').modal();

        // Init Sidenav
        $('.button-collapse').sideNav();

        //Init tabs
        $('.tabs').tabs();

        var instance = M.Tabs.init(el, options);
    });

</script>
</body>
</html>
