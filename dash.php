<?php
session_start();
include "dbconnection.php";
if (!$_SESSION['user']) {
    header("Location: adminIndex");
}
?>

<!DOCTYPE html>
<html lang="en">
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Admin DashBoard</title>
    <!-- Favicon-->
    <!-- <link rel="icon" href="favicon.ico" type="image/x-icon">-->

    <!-- Google Fonts -->
    <link href="fonts/material-design-icons-2.2.0/material-design-icons-2.2.0/iconfont/material-icons.css"
          rel="stylesheet">
    <!-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" type="text/css">

    <!-- Materialize Css -->
    <link rel="stylesheet" href="css/materialize.css" type="text/css">
    <link rel="icon" href="images/backimages/icon.png">
</head>
<!--Header-->
<header>
    <!--Nav bar-->
    <div class="navbar-fixed red">
        <nav>
            <div class="nav-wrapper red darken-3">

                <ul class="right">
                    <!--<li><a><i class="material-icons">notifications</i></a></li>-->
                    <!--<li><a><i class="material-icons">forum</i> </a></li>-->
<!--                    <li><a><i class="material-icons">more_vert</i> </a></li>-->
                </ul>
            </div>
        </nav>
    </div>
</header>
<body class="row grey lighten-2">
<?php
DB::query("SELECT * FROM student WHERE application_state LIKE 'pending'");
$pendingCounter = DB::count();
DB::query("SELECT * FROM student WHERE application_state LIKE 'Approved'");
$approvedCounter = DB::count();
DB::query("SELECT * FROM complains WHERE state =0");
$complainCounter = DB::count();
?>

<!--SideNav-->
<div class="col xl1 l2">
    <ul id="slide-out" class="side-nav hide-on-med-and-down fixed">
        <li>
            <div class="user-view">
                <div class="background">
                    <img src="images/backimages/sidenavImage.jpg">
                </div>
                <a href="#" id="logo" rel="Home"><img class="circle" src="images/backimages/logo.jpg"></a>
                <span class="white-text name">Management Console</span>
                <span class="white-text email">Administrator</span>
            </div>
        </li>

        <li class="center-align"><b>Navigation</b></li>


        <ul class="collapsible popout" data-collapsible="accordion">
            <li>
                <a class="collapsible-header" href="#" id="home" rel="Home"><i
                            class="material-icons">home</i>Home</a>
            </li>
            <li>
                <a class="collapsible-header" href="#" id="app"><i class="material-icons">home</i>Applications</a>
                <div class="collapsible-body">
                    <ul>
                        <li class="link"><a href="#!" id="appAp" rel="ApprovedApplications"><i class="material-icons">check</i>Applications
                                Approved</a>
                        </li>
                        <li class="link"><a href="#!" rel="PendingApplications"><i
                                        class="material-icons">all_inclusive</i>Applications
                                Pending</a></li>
                        <li class="link"><a href="#!" rel="RejectedApplications"><i class="material-icons">clear</i>Applications
                                Rejected</a>
                        </li>
                    </ul>
                </div>
            </li>
            <li>
                <a class="collapsible-header" href="#!" id="auth"><i class="material-icons">check</i>Authorize Movement</a>
            </li>

            <li>
                <a class="collapsible-header" href="#!" rel="Complaints" id="comps"><i class="material-icons">forum</i>Complaints</a>
            </li>
            <li>
                <div class="divider"></div>
            </li>
            <li><a class="collapsible-header" href="logawt.php"><i class="material-icons">input</i>Logout</a></li>
        </ul>

        <div class="page-footer grey lighten-2 red-text text-darken-4" style="
        position: fixed;
        right: 0;
        bottom: 0;
        left: 0;
        padding: 1rem;
        background-color: #efefef;
        text-align: center;">
            <p class="section">© 2018 Copyright <a class="red-text text-darken-4" href="http://beta.rmu.edu.gh">RMU </a>ICT
                Department
            </p>
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
        </div>
    </ul>
</div>


<!-- Views -->
<div class="col xl11 l10  hide-on-med-and-down">
    <div id="mainDivHolder" class="container" style="margin-right: 0%; width: 85%">
        <div id="Home" style="display: none;">
            <ul style="margin: 0%">
                <li class="center-align"><b>Dashboard</b></li>
            </ul>
            <div class="row" style="position: relative;">
                <div class="col xl4 l4">
                    <div class="card blue darken-1 center-align">
                        <div class="card-content white-text">
                            <a href="#" class="card-title link white-text" rel="PendingApplications"><i
                                        class="center-align medium material-icons">notifications</i>
                                <h6><span class="new badge flow-text"><?php echo $pendingCounter ?></span>Applications
                                    Pending
                                    Review</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col xl4 l4">
                    <div class="card green darken-4 center-align">
                        <div class="card-content white-text">
                            <a href="#" class="card-title link white-text" rel="ApprovedApplications"><i
                                        class="center-align medium material-icons">done_all</i>
                                <h6>Applications Approved</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col xl4 l4">
                    <div class="card red darken-4 center-align">
                        <div class="card-content white-text">
                            <a href="#" class="card-title link white-text" rel="RejectedApplications"><i
                                        class="center-align medium material-icons">clear</i>
                                <h6>Applications Rejected</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="position: relative;">
                <div class="col xl4 l4">
                    <div class="card orange darken-4 center-align">
                        <div class="card-content white-text">
                            <a href="#" id="complaint" class="card-title link white-text" rel="Complaints"><i
                                        class="center-align medium material-icons">forum</i>
                                <h6><span class="new badge"><?php echo $complainCounter ?></span>Complaints Pending
                                    Review</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col xl4 l4">
                    <div class="card teal darken-4 center-align">
                        <div class="card-content white-text">
                            <a href="#" class="card-title link white-text"><i
                                        class="center-align medium material-icons">swap_horiz</i>
                                <h6><span class="new badge">0</span>Movement Requests</h6></a>
                        </div>
                    </div>
                </div>
                <div class="col xl4 l4">
                    <div class="card blue darken-1 center-align">
                        <div class="card-content white-text">
                            <a href="#" class="card-title link white-text" rel="PendingApplications"><i
                                        class="center-align medium material-icons">layers</i>
                                <h6><!--<span class="new badge">4</span>-->Reports</h6></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row" style="position: relative;">
                <div class="col xl12 l12 section white" id=halls>
                    <br>
                    <div class="row">
                        <div class="col xl10 l10">
                            <ul style="margin: 0%;">
                                <li class="center-align"><b>Hall And Room Management</b></li>
                            </ul>
                        </div>
                        <div class="col xl2 l2">
                            <a class="btn teal darken-4 modal-trigger" href="#addHallModal">Add Hall</a>
                            <!--                            <a class="black-text tooltipped modal-trigger" data-position="left" data-tooltip="Add Hall" href="#addHallModal"><i class="material-icons">add_circle_outline</i></a>-->
                        </div>
                    </div>

                    <div class="white">
                        <ul class="collapsible">
                            <?php
                            $hallQuery = DB::query("SELECT * FROM hall");
                            foreach ($hallQuery as $row) { ?>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons">label_outline</i><b><?php echo $row['hall_name'] ?></b>
                                    </div>
                                    <div class="collapsible-body grey lighten-4"
                                         style="padding-top: 1%;padding-bottom: 1%;">
                                        <?php
                                        $hall_id = $row['hall_id'];
                                        $roomQuery = DB::query("select * from room where hall_id like '$hall_id'");

                                        foreach ($roomQuery as $rooms) {
                                            $currentCount = $rooms['bed_count_current'];
                                            $capacity = $rooms['bed_count_init'];
                                            $difference = $capacity - $currentCount;
                                            $percentage = ($difference / $capacity) * 100;
                                            ?>
                                            <div class="row">
                                                <div class="col xl2 l2">
                                                    <span>Room <?php echo $rooms['room_id'] ?></span>
                                                </div>
                                                <div class="col xl4 l4">
                                                    <div class="progress grey lighten-4">
                                                        <div class="determinate red darken-4"
                                                             style="width: <?php echo $percentage ?>%"></div>
                                                    </div>
                                                </div>
                                                <div class="col xl3 l4">
                                                    <p class="red-text left-align"><?php echo $difference . "/" . $capacity ?></p>
                                                </div>
                                            </div>

                                        <?php } ?>
                                        <div class="row center-align" id="<?php echo $hall_id ?>">
                                            <input type="submit" class="btn addRoomBtn blue modal-trigger"
                                                   href="#addRoomModal"
                                                   value="Add Room" name="updateRoom">
                                        </div>

                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="PendingApplications" style="display: none;">
            <ul>
                <li class="center-align"><b>Pending Applications</b></li>
            </ul>
            <table class="responsive-table white striped">
                <thead class="">
                <tr>
                    <th>Index Number</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>Hall Assigned</th>
                    <th>Room Assigned</th>
                    <th>Image</th>

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
                        $room_id = $applicantRow['room_id'];
                        $hallQ = DB::queryRaw("SELECT hall.hall_name FROM hall WHERE hall.hall_id =( select hall_id from room where room_id='$room_id')");
                        $hallQuery = $hallQ->fetch_assoc();
                        ?>
                        <td><?php echo $hallQuery['hall_name'] ?></td>
                        <td><?php echo $room_id ?></td>

                        <?php $file = "images/studentPasportPics/" . $applicantRow['emailAddress'] . ".jpg";
                        $filename = $file;
                        $indexNu="";

                        if (file_exists($filename)) {
                            $indexNu = $file;
                        } else {
                            $indexNu = "images/studentPasportPics/default.jpeg";
                        }
                        ?>
                        <td><img class="materialboxed" height="50" vspace="1" src="<?php echo $indexNu; ?>"></td>

                        <td>
                            <a href="<?php echo "action.php?action=Approved&email=" . $applicantRow['emailAddress'] . "&room_id=" . $applicantRow['room_id'] ?>"<i
                                    class="material-icons green-text">check</i></a>
                            <a href="<?php echo "action.php?action=Revoked&email=" . $applicantRow['emailAddress'] ?>"<i
                                    class="material-icons red-text">clear</i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row" id="ApprovedApplications" style="display: none;">
            <br>
            <ul style="margin: 0%">
                <li class="center-align"><b>Approved Applications</b></li>
            </ul>
            <br>
            <table class="responsive-table white striped">
                <thead class="">
                <tr>
                    <th>Index Number</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>Hall Assigned</th>
                    <th>Room Assigned</th>
                    <th>Image</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $applicantQuery = DB::query("SELECT * FROM student INNER JOIN program ON student.program_id =program.program_id WHERE student.application_state LIKE 'Approved'");
                foreach ($applicantQuery as $applicantRow) { ?>
                    <tr>
                        <td><?php echo $applicantRow['index_no']; ?></td>
                        <td><?php echo $applicantRow['name']; ?></td>
                        <td><?php echo $applicantRow['program_name']; ?></td>
                        <td><?php echo $applicantRow['nationality']; ?></td>
                        <?php
                        $room_id = $applicantRow['room_id'];
                        $hallQ = DB::queryRaw("SELECT `hall_name` FROM `hall` WHERE `hall_id` = (SELECT  hall_id from room where room_id = '$room_id')");
                        $hallQuery = $hallQ->fetch_assoc();
                        ?>
                        <td><?php echo $hallQuery['hall_name'] ?></td>
                        <td><?php echo $room_id ?></td>


                        <?php $file = "images/studentPasportPics/" . $applicantRow['emailAddress'] . ".jpg";
                        $filename = $file;
                        $indexNu="";

                        if (file_exists($filename)) {
                            $indexNu = $file;
                        } else {
                            $indexNu = "images/studentPasportPics/default.jpeg";
                        }
                        ?>
                        <td><img class="materialboxed" height="50" vspace="1" src="<?php echo $indexNu; ?>"></td>
                        <td>
                            <a href="#0"><i class="material-icons red white-text">clear</i></a>
                            <a href="#0"><i class="material-icons blue white-text">swap_horiz</i></a>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row" id="RejectedApplications" style="display: none;">
            <ul>
                <li class="center-align"><b>Rejected Applications</b></li>
            </ul>
            <table class="responsive-table white striped">
                <thead class="">
                <tr>
                    <th>Index Number</th>
                    <th>Name</th>
                    <th>Program</th>
                    <th>Nationality</th>
                    <th>Hall Assigned</th>
                    <th>Room Assigned</th>
                    <th>Image</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $applicantQuery = DB::query("SELECT * FROM student INNER JOIN program ON student.program_id =program.program_id WHERE student.application_state LIKE 'Rejected'");
                foreach ($applicantQuery as $applicantRow) { ?>
                    <tr>
                        <td><?php echo $applicantRow['index_no']; ?></td>
                        <td><?php echo $applicantRow['name']; ?></td>
                        <td><?php echo $applicantRow['program_name']; ?></td>
                        <td><?php echo $applicantRow['nationality']; ?></td>
                        <?php
                        $room_id = $applicantRow['room_id'];
                        $hallQ = DB::queryRaw("SELECT `hall_name` FROM `hall` WHERE `hall_id` = (SELECT  hall_id from room where room_id = '$room_id')");
                        $hallQuery = $hallQ->fetch_assoc();
                        ?>
                        <td><?php echo $hallQuery['hall_name'] ?></td>
                        <td><?php echo $room_id ?></td>

                        <?php $file = "images/studentPasportPics/" . $applicantRow['emailAddress'] . ".jpg";
                        $filename = $file;
                        $indexNu="";

                        if (file_exists($filename)) {
                            $indexNu = $file;
                        } else {
                            $indexNu = "images/studentPasportPics/default.jpeg";
                        }
                        ?>
                        <td><img class="materialboxed" height="50" vspace="1" src="<?php echo $indexNu; ?>"></td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="row" id="Complaints" style="display: none;">
            <div class="row" style="position: relative;">
                <div class="col xl12 l12 section white">
                    <br>
                    <ul>
                        <li class="center-align"><b>Complaints and Request Pending Review</b></li>
                    </ul>
                    <div class="white">
                        <div class="row">
                            <?php
                            $complains = DB::query("SELECT * FROM complains WHERE state = 0");
                            foreach ($complains
                                     as $row) { ?>
                                <div class="col xl11 l11">
                                    <ul class="collapsible" style="margin: 0%">
                                        <li style="margin: 0%">
                                            <div class="collapsible-header">
                                                <i class="material-icons red-text">mail</i><span>Issue No.:  <b><?php echo $row['issue_no'] . " " ?></b>Issue Date:  <b><?php echo $row['issue_date'] . " " ?></b>Complainant: <b><?php echo $row['student_id'] . " " ?></b></span>
                                            </div>
                                            <div class="collapsible-body grey lighten-4"
                                                 style="padding-top: 1%;padding-bottom: 1%;">
                                                <span><?php echo $row['complain'] ?></span>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col xl1 l1">
                                    <a href="#!" onclick="remove('<?php echo $row['issue_no'] ?>')"><i
                                                class="material-icons small green-text">done_all</i></a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row" style="position: relative;">
                <div class="col xl12 l12 section white">
                    <ul>
                        <li class="center-align"><b>History of Reviewed Complaints</b></li>
                    </ul>
                    <div class="white">
                        <ul class="collapsible">
                            <?php
                            $complains = DB::query("SELECT * FROM complains WHERE state = 1");
                            foreach ($complains
                                     as $row) { ?>
                                <li>
                                    <div class="collapsible-header">
                                        <i class="material-icons green-text">drafts</i><span>Issue No.:  <b><?php echo $row['issue_no'] . " " ?></b>Issue Date:  <b><?php echo $row['issue_date'] . " " ?></b>Complainant: <b><?php echo $row['student_id'] . " " ?></b></span>
                                    </div>
                                    <div class="collapsible-body grey lighten-4"
                                         style="padding-top: 1%;padding-bottom: 1%;">
                                        <span><?php echo $row['complain'] ?></span>
                                    </div>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="col m12 s12 show-on-medium-and-down hide-on-med-and-up white blue-text center-align">
    <i class="material-icons large center-align">info</i>
    <h1 class="red-text text-accent-4">Visit Page on Desktop!!</h1>
</div>


<!-- Modals -->
<div id="addHallModal" class="modal bottom-sheet"
     style="width: 30% !important;overflow-y: hidden !important;  left: 35%">
    <div class="modal-content">
        <p>Add New Hall</p>
        <form class="row" action="additions.php" method="post">
            <div class="input-field col xl7">
                <input id="hallName" name="hallName" style="text-transform: uppercase" class="validate">
                <label for="email" class="active">Hall Name</label>
            </div>
            <div class="input-field col xl4">
                <input type="submit" class="btn red" value="Update" name="updateHall">
            </div>
        </form>
    </div>
</div>

<div id="addRoomModal" class="modal bottom-sheet"
     style="width: 30% !important;height: 25% !important;overflow-y: hidden !important;  left: 35%">
    <div class="modal-content">

        <div class="row">
            <div class="input-field col xl7 l7 ">
                <select name="sex" id="sexModal">Sex
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
            </div>
            <div class="input-field col xl4 l4">
                <input id="capacityModal" name="capacity" class="validate" required>
                <label for="capacityModal" class="active">Capacity</label>
            </div>
        </div>
        <div class="row center-align">
            <div class="input-field offset-xl4 offset-l4 col xl4 l4">
                <input type="submit" onclick="confirm()" class="btn confBtn red" value="Update"
                       name="updateRoom">
            </div>

        </div>
    </div>
</div>


</body>
<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="js/materialize.min.js"></script>
<script src="jquery/button.js"></script>

<script type="text/javascript">

    var check = location.hash;
    console.log(check);

    if (check == "" || check == "#!") {
        $("#Home").fadeIn('fast').siblings("div").hide();

        $(function () {
            $('#home').click();
        })

    }

    if (check == "#applications") {

        $(function () {
            $('#app').click();
            $('#appAp').click();

        })

        $("#ApprovedApplications").fadeIn('fast').siblings("div").hide();
        $("#halls").click();

    }

    if (check == "#rooms") {
        $("#ApprovedApplications").fadeIn('fast').siblings("div").hide();
    }

    if (check == "#comp") {
        $(function () {
            $('#comps').click();
        })
        $("#Complaints").fadeIn('fast').siblings("div").hide();
    }


    var parentId;

    $('.addRoomBtn').on('click', function () {
        parentId = $(this).parent().attr('id');
    });

    function remove(id) {
        window.open("seen?&id=" + id, '_self');
    }


    function confirm() {
        var e = document.getElementById('sexModal');
        var sex = e.options[e.selectedIndex].value;

        var capacity = Number(document.getElementById('capacityModal').value);

        if (capacity > 0) {
            window.open("additions?&parent=" + parentId + "&sex=" + sex + "&capacity=" + capacity, '_self');
        }
        else
            alert('Invalid Room Capacity');
    }

</script>

<script type="text/javascript">
    $(document).ready(function () {

        $(function () {
            // $('#home').click();
        });

        //

        $('.sidenav').sideNav({});


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

        $('#slide-out').sideNav('show');


        $('a').on('click', function (e) {
            var target = $(this).attr('rel');
            $("#" + target).fadeIn('fast').siblings("div").fadeOut('fast');

        });
    });
</script>


</html>


