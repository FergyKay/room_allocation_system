<?php
session_start();
include "dbconnection.php";
if (!$_SESSION['email']) {
    header("Location: index");//redirect to login page to secure the welcome page without login access.
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
    <link rel="icon" href="images/backimages/icon.png">
    <!--<link rel="stylesheet" href="css/social.css">-->
    <title>Welcome</title>
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
                        <li><a href="status">View Application Status</a></li>
                        <li><a class="modal-trigger comp"> Write A Complaint</a></li>
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
                <a class="flow-text" href="logout">Log out</a>
            </li>
        </ul>

</header>
<ul id="nav-mobile" class="side-nav" style="margin-right: 20px">
    <li><a href="status">View Application Status</a></li>
    <li><a class="modal-trigger comp"> Write A Complaint</a></li>
    <li><a href="logout.php">Logout</a></li>
</ul>

<!--Body of page-->
<body class="white rounded parallax" style="background-size: cover;background-attachment: fixed"
      background="images/backimages/back4.jpg">

<div class="container center white" style="margin-top: 1%">
    <div class="card-panel">
    <div class="row">
        <div class="col xl9 m12 l12 s12 white">
            <br>
            <br>
            <span class="center"><b> Please provide required Information</b></span>
            <br>
            <br>
            <?php

            $check_id_query = DB::query("SELECT * FROM student INNER JOIN program on student.program_id = program.program_id WHERE emailAddress='$user'");
            //$run_query = mysqli_query($dbcon, $check_id_query);
            // $row = mysqli_fetch_array($run_query);
            foreach ($check_id_query

            as $row){
            ?>
            <form method="post" role="form" disabled="true" action="update.php">
                <div class="row center">
                    <div class="col xl2 l2 m6 s12 input-field">
                        <input id="indexNumber" type="text" name="indexNumber" class="validate"
                               value="<?php echo $row['index_no'] ?>"
                               required readonly disabled>
                        <label for="indexNumber" class="active ">Index Number</label>
                    </div>
                    <div class="col xl4 l4 m6 s12  input-field">
                        <input id="Name" type="text" name="Name" class="validate"
                               value="<?php echo $row['name'] ?>"
                               required readonly disabled>
                        <label for="Name" class="active ">Name</label>
                    </div>
                    <div class="col xl6 l6 m12 s12  input-field">
                        <input id="Program" type="text" name="Program" class="validate"
                               value="<?php echo $row['program_name'] ?>"
                               required readonly disabled>
                        <label for="Program" class="active ">Program Of Study</label>
                    </div>
                </div>
                <div class="row center">
                    <div class="col xl2  m4 s4  input-field">
                        <input id="level" type="text" name="level" class="validate"
                               value="<?php echo $row['level'] ?>"
                               required readonly disabled>
                        <label for="level" class="active ">Level</label>
                    </div>
                    <div class="col xl3 m4 s4 input-field black-text">
                        <input id="nationality" name="nationality" class="validate" required disabled
                               value="<?php echo $row['nationality'] ?>">
                        <label for="nationality" class="active">Nationality</label>
                    </div>
                    <div class="col xl2 m4 s4 input-field black-text ">
                        <?php
                        $check_id_query = DB::queryRaw("SELECT sex.name FROM sex INNER JOIN student ON sex.id = student.sex WHERE student.emailAddress LIKE '$user'");
                        $ro = $check_id_query->fetch_array();
                        ?>
                        <input id="sex" type="text" name="sex" class="validate"
                               value="<?php echo $ro[0] ?>" required disabled>
                        <label for="sex" class="active">Sex</label>
                    </div>
                    <div class="col xl2 s6 m6 input-field disabled">
                        <input id="contact" type="text" name="contact" class="validate"
                               value="<?php echo $row['contact'] ?>" required>
                        <label for="contact" class="active">Contact</label>
                    </div>
                    <div class="col xl3 s6 m6 input-field disabled">
                        <input id="contactE" type="text" name="contactE" class="validate"
                               value="<?php echo $row['alt_contact'] ?>" required>
                        <label for="contactE" class="active">Emergency Contact</label>
                    </div>
                    <div class="col xl4 l4 m4 s12 offset-xl4 offset-l4 offset-m4">
                            <input type="submit" class="btn blue darken-4" value="Apply For Room" name="update">
                    </div>
                    <?php } ?>
                </div>
            </form>
            <!-- <ul class="pagination">
                <li class="active teal"><a href="#!">1</a></li>
                <li class="waves-effect"><a href="#!">2</a></li>
                <li class="waves-effect"><a href="#!">3</a></li>
            </ul> -->
        </div>
        <div class="col xl3 m12 l12 s12 white">
            <div style="text-align: center; margin-top: 0%">
                <?php $file = "images/studentPasportPics/" . $_SESSION['email'] . ".jpg";
                $filename = $file;
                $indexNu="";

                if (file_exists($filename)) {
                    $indexNu = $file;
                } else {
                    $indexNu = "images/studentPasportPics/default.jpeg";
                }
                ?>
                <img height="180" width="150" vspace="5" src="<?php echo $indexNu; ?>">
            </div>
            <div>
                <p class="">Upload passport sized Image (.jpeg,.jpg) </p>
                <b>(Max size <span id="max-size"></span> KB)<b>

                        <form id="upload-image-form" action="" method="post" enctype="multipart/form-data">
                            <div id="image-preview-div" style="display: none">
                                <label for="exampleInputFile">Selected image:</label>
                                <br>
                                <img id="preview-img" src="noimage">
                            </div>
                            <div class="form-group">
                                <input type="file" name="file" id="file" required>
                            </div>
                            <br>
                            <button class="btn blue btn-small white-text" id="upload-button" name="image" type="submit">Upload
                                image
                            </button>
                            <br>
                            <div class="alert alert-info" id="loading" style="display: none;" role="alert">
                                Uploading image...
                                <div class="progress">
                                    <div class="progress" role="progressbar"
                                         aria-valuenow="45"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    </div>
                                </div>
                            </div>
                            <div id="message" class="green-text"></div>
                        </form>
            </div>
        </div>
    </div>
    </div>


    <div id="modal1" class="modal" style="overflow-y: hidden !important;">
        <div class="modal-content">
            <div class="row">
                <form action="complain" method="post">
                    <div class="input-field col s12">
                        <textarea id="complaint" type="text" name="comp" class="materialize-textarea"
                                  required></textarea>
                        <label for="complaint" class="active">Type complaint here</label>
                    </div>
                    <input id="date" type="hidden" name="date">
                    <label for="date"></label>
                    <div class="modal-fixed-footer">
                        <input type="submit" class="btn blue" value="Submit" name="submit">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();

    if (dd < 10) {
        dd = '0' + dd
    }

    if (mm < 10) {
        mm = '0' + mm
    }

    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById('date').value = today;
</script>

<!--Footer-->

<footer class="page-footer blue darken-2 hide-on-small-and-down" style="
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


<!--Scripts-->
<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="js/materialize.min.js"></script>
<script src="jquery/button.js"></script>


<script>
    $(document).ready(function () {

        $('.comp').on('click', function (e) {
            $('#modal1').modal('open');

        });
        // Init Carousel
        $('.carousel').carousel();

        // Init Carousel Slider
        $('.carousel.carousel-slider').carousel({fullWidth: true});

        // Fire off toast
        //Materialize.toast('Hello World', 3000);

        // Init Slider
        $('.slider').slider();

        // Init Modal
        $('.modal').modal('');

        // Init Sidenav
        $('.button-collapse').sideNav();


        $('select').material_select();
    });
</script>
<script src="upload-image.js"></script>

<script>
    jQuery('a[href^="#"]').click(function (e) {

        jQuery('html,body').animate({scrollTop: jQuery(this.hash).offset().top}, 1000);

        return false;

        e.preventDefault();

    });

</script>
</body>
</html>