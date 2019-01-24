<?php
session_start();
if (!$_SESSION['email']) {
    header("Location: index.php"); //redirect to login page to secure the welcome page without login access.
}
$user = $_SESSION['email'];
?>

<!doctype html>
<html lang="en" class="no-js">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css"> <!-- Resource style -->


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

<?php
include 'database/dbcon.php';
$user_email = $_SESSION['email'];
$check_id_query = "select application_state from student WHERE emailAddress='$user_email'";
$run_query = mysqli_query($dbcon, $check_id_query);
$row = mysqli_fetch_array($run_query);

if ($row[0] == "No Applications Found") {
    ?>
    <div class="container center" style="margin-top: 1%">
        <div id="modal1" class="modal modal-fixed-footer">
            <div class="modal-content">
                <h4 style="text-align: center">Terms And Condtions</h4>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborum
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore
                    et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut
                    aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                    cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in
                    culpa qui officia deserunt mollit anim id est laborumt</p>
            </div>
            <div class="modal-footer">
                <a href="summary" class="modal-action modal-close waves-effect waves-green btn-flat">Agree</a>
                <a href="welcome" class="modal-action modal-close waves-effect waves-green btn-flat">Disagree</a>
            </div>
        </div>
    </div>
<?php } else {
    header("Location: summary");
}

?>


<!--Footer-->

<footer class="page-footer blue darken-4" style="
        position: fixed;
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
    <div class="footer-copyright white-text ">
        <div class="container">
            © 2018 Copyright ICT Department
            <a class="grey-text text-lighten-4 right" href="#!"></a>
        </div>
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