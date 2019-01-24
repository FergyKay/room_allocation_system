<?php
/**
 * Created by PhpStorm.
 * User: Kobby
 * Date: 4/23/2018
 * Time: 9:02 AM
 */
session_start();
if (!$_SESSION['email']) {
    header("Location: index");//redirect to login page to secure the welcome page without login access.
}
$user = $_SESSION['email'];

include 'dbconnection.php';

$user_email = $_SESSION['email'];
$check_id_query = DB::queryRaw("select application_state from student WHERE emailAddress='$user_email'");
//
$row = $check_id_query->fetch_array();
?>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->
    <link rel="icon" href="images/backimages/icon.png">


    <link href="fonts/material-design-icons-2.2.0/material-design-icons-2.2.0/iconfont/material-icons.css"
          rel="stylesheet">
    <!--Import materialize.css-->
    <link rel="stylesheet" href="css/materialize.css">
    <link rel="icon" href="images/" type="image/x-icon"/>
    <!--<link rel="stylesheet" href="css/social.css">-->
    <title>Apply For Room</title>
</head>

<header>
    <!--Nav bar Desktop-->
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper grey darken-3">
                <div class="nav-wrapper blue darken-4">
                    <a href="" class="brand-logo large rounded" style="margin-left: 20px">
                        <!--<img src="images/logo153x153.jpg" alt="">-->
                    </a>

                    <a href="" data-activates="nav-mobile" class="button-collapse"><i
                                class="material-icons">menu</i></a>

                    <ul class="left hide-on-med-and-down large" style="margin-right: 20px">

                        <li><a href="#">View Application Status</a></li>
                        <li><a href="#"> Write A Complaint</a></li>
                    </ul>

                    <ul class="right hide-on-med-and-down large">
                        <li>
                            <a class="dropdown-button" data-activates="more" data-beloworigin="true"
                               href="#"><?php echo $user ?><i
                                        class="material-icons right">arrow_drop_down</i></a>
                        </li>
                    </ul>
                </div>
                <!-- Dropdown Trigger -->

            </div>
        </nav>
        <!--        <!-- Dropdown Structure -->-->
        <ul id="more" class="dropdown-content collection" style="background: rgba(255,255,255,0.9)">
            <li>
                <a class="flow-text" href="logout.php">Log out</a>
            </li>
        </ul>
        <!---->
        <!--        <ul id="servicesDropDown" class="dropdown-content collection"-->
        <!--            style="background: rgba(255,255,255,0.9);width: 200px !important;">-->
        <!--            <li>-->
        <!--                <a class="flow-text" href="services.html#hrms">Health Record Management System</a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a class="flow-text" href="services.html#hams">Health Account Management System</a>-->
        <!--            </li>-->
        <!--            <li>-->
        <!--                <a class="flow-text" href="services.html#hcs">Health Care Client Service</a>-->
        <!--            </li>-->
        <!--        </ul>-->
        <!--    </div>-->

        <!--Nav for mobile-->
        <ul id="nav-mobile" class="side-nav" style="margin-right: 20px">
            <!--            <li><a class="red  disabled pulse" style="position: center" href="#">Site Under Construction</a>-->
            <!--            </li>-->
            <!--            <li><a href="#">Home</a></li>-->
            <!--            <li><a href="#">Our Services</a></li>-->
            <!--            <li><a href="#">Testimonials</a></li>-->
            <!--            <li><a href="#">Contact Us</a></li>-->
        </ul>

</header>

<!--Body of page-->
<body class="white rounded parallax" style="background-size: cover;background-attachment: fixed"
      background="images/backimages/back4.jpg">
<div class="container center" style="margin-top: 1%">
    <div id="modal1" class="modal modal-fixed-footer"
         style="width: 50% !important;height: 40% !important;top: 30% !important; overflow-y: hidden !important;  left: 5% !important;">
        <div class="modal-content">
            <div class="row">
                <h5><?php echo $row[0] ?></h5>
                <?php if ($row[0] == "Approved") {
                ?><br><br><a href="summary" class="waves-effect waves-light blue btn">Print Letter</a></div
            <?php
            } ?>
        </div>
    </div>
</div>
<footer class="page-footer blue darken-4" style="
        position: fixed;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #efefef;
        text-align: center;">
    <div class="footer-copyright white-text "> © 2018 Copyright ICT Department
<!--        <div class="container">-->
<!--           -->
<!--            <a class="grey-text text-lighten-4 right" href="#!"></a>-->
<!--        </div>-->
    </div>
</footer>


<!--Scripts-->
<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="js/materialize.min.js"></script>
<script src="jquery/button.js"></script>
<script>


</script>


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
        $('.modal').modal({
            complete: function () {
                window.location.replace("welcome");
            }
        });

        // Init Sidenav
        $('.button-collapse').sideNav();

        $('select').material_select();

        $('#modal1').modal('open');


    });
</script>
<script src="upload-image.js"></script>

<script>
    jQuery('a[href^="#"]').click(function (e) {

        jQuery('html,body').animate({scrollTop: jQuery(this.hash).offset().top}, 1000);


        e.preventDefault();
        return false;

    });

</script>
</body>
</html>





