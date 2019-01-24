<?php
include "dbconnection.php";


session_start();
//
//if (!$_SESSION['email_admin']) {
//    header("Location: index.php");//redirect to login page to secure the welcome page without login access.
//}
//$user = $_SESSION['email_admin'];
//
//
//?>


<!DOCTYPE html>
<html>
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
    <title>Welcome</title>

    <style>
        nav ul li a {
            color: navy;
        }
    </style>
</head>

<header>
    <!--Nav bar Desktop-->
    <div class="navbar-fixed">
        <nav>
            <div class="nav-wrapper white darken-3">
                <div class="nav-wrapper">
                    <a href="" class="brand-logo large rounded" style="margin-left: 20px">
                    </a>

                    <a href="" data-activates="nav-mobile" class="button-collapse"><i
                                class="material-icons">menu</i></a>

                    <ul class="left hide-on-med-and-down large blue-text darken-4" style="margin-right: 20px">
                        <li style="color: darkblue"><a href="summary.php">Applications</a></li>
                        <li><a href="#">Authorize Movement</a></li>
                        <li><a href="summary.php">Deregister Student</a></li>
                        <li><a href="#">Review Complaint</a></li>
                    </ul>

                    <ul class="right hide-on-med-and-down large">
                        <li>
                            <a class="dropdown-button" data-activates="more" data-beloworigin="true"
                               href="#"><?php echo $_SESSION['email'] ?><i
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


<body class="white">
<div class="" style="margin-left: 10px; margin-right: 10px">
    <div class="block-header">

    </div>
    <div class="row">


    </div>
    <table class="responsive-table striped">
        <thead class="">
        <tr>
            <th>Index Number</th>
            <th>Name</th>
            <th>Program</th>
            <th>Nationality</th>
            <th>Hall Assigned</th>
            <th>Room Assigned</th>
            <th>Image</th>
            <th>Application State</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $applicantQuery = DB::query("SELECT * FROM student INNER JOIN program ON student.program_id =program.program_id WHERE student.application_state LIKE 'Pending'");
        foreach ($applicantQuery as $applicantRow) { ?>
            <tr>
                <td><?php echo $applicantRow['index_no']; ?></td>
                <td><?php echo $applicantRow['name']; ?></td>
                <td><?php echo $applicantRow['program_name']; ?></td>

                <td><?php echo $applicantRow['nationality']; ?></td>

                <?php
                $hallQuery = DB::query("SELECT * FROM HALL");
                ?>

                <td><select id="hall" onchange="updateCombo(this)">
                        <option selected></option>
                        <?php
                        foreach($hallQuery as $hallRow) {
                            ?>
                            <option value="<?php echo $hallRow['hall_name']; ?>"><?php echo $hallRow['hall_name']; ?></option>
                        <?php }
                        ?>
                    </select></td>
                <script>

                    function updateCombo(e) {
                        var options = e.options;
                         console.log(options[options.selectedIndex].value);
                         $('#room').load(document.URL + '#room');

                    }
                </script>


                <td><select id="room">
                        <?php
                        $hallId = $hallRow['hall_id'];
                        $sex = $applicantRow['sex'];
                        $roomQuery = DB::query("SELECT room.room_id FROM `room` WHERE room.hall_id = $hallId and room.sextype = $sex and room.bed_count_current > 0");

                        foreach ($roomQuery as $roomRow) {
                            ?>
                            <option value="<?php echo $roomRow['room_id']; ?>"><?php echo $roomRow['room_id']; ?></option>
                        <?php }
                        ?>

                    </select></td>


                <?php $indexNu = "images/studentPasportPics/" . $applicantRow['emailAddress'] . ".jpg"; ?>
                <td><img class="materialboxed" height="50" vspace="1" src="<?php echo $indexNu; ?>"></td>
                <td><?php echo $applicantRow['application_state']; ?></td>
                <td>
                    <a href="<?php echo "action.php?action=approve&email=" . $applicantRow['emailAddress'] ?>"<i
                            class="material-icons green-text">check</i></a>
                    <a href="<?php echo "action.php?action=revoke&email=" . $applicantRow['emailAddress'] ?>"<i
                            class="material-icons red-text">clear</i></a>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>




<!-- </section> -->
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
        <div class="container">© 2018 Copyright ICT Department
            <a class="grey-text text-lighten-4 right" href="#!"></a>
        </div>
    </div>
</footer>


<!--Scripts-->
<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="js/materialize.min.js"></script>
<script src="jquery/button.js"></script>


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

        $('select').material_select();

        //tooltip
        $('.tooltipped').tooltip();

        //materialized Box
        $('.materialboxed').materialbox();
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
</body>

</html>
