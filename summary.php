<?php
session_start();
if (!$_SESSION['email']) {
    header("Location: index");//redirect to login page to secure the welcome page without login access.
}
$user = $_SESSION['email'];

include 'dbconnection.php';
include 'Room.php';
$user_email = $_SESSION['email'];
$check_id_query = DB::queryRaw("select application_state from student WHERE emailAddress='$user_email'");
//
$row = $check_id_query->fetch_array();

if ($row[0] == "No Applications Found") {

    $user_email = $_SESSION['email'];
    $getRooms = DB::query("select room.room_id, room.bed_count_current FROM room INNER JOIN student ON student.sex = room.sextype WHERE student.emailAddress LIKE '$user_email'");

    $rooms = array();

    foreach ($getRooms as $row) {
        $room = new Room($row['room_id'], $row['bed_count_current']);
        $rooms[] = $room;

    }
    allocateRoom($rooms);
    echo "<script>alert('Application Submitted!');window.open('welcome','_self')</script>";


} elseif ($row[0] == "Pending")
    header("Location: status");//

else
    echo "";


function allocateRoom(&$roomArray)
{

    $user = $_SESSION['email'];
    $min = 0;
    $max = count($roomArray) - 1;

    do {
        $selectedIndex = mt_rand($min, $max);
    } while ($roomArray{$selectedIndex}->getBedCountCurrent() == 0);

    $roomGiven = $roomArray{$selectedIndex}->getRoomId();
    $bedCount = $roomArray{$selectedIndex}->getBedCountCurrent();


    //
    putBackToDB($user, $roomGiven);
    echo "<script>alert('Application Received!');window.open('welcome','_self')</script>";

}

function putBackToDB($user, $roomId)
{
    $query = DB::queryRaw("UPDATE `student` SET `room_id` = '$roomId', `application_state` = 'Pending' WHERE `student`.`emailAddress` = '$user'");

}

?>
<!doctype html>
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
    <title>Residence Allocation Letter</title>
</head>


<body class="white rounded parallax" style="background-size: cover;background-attachment: fixed"
      background="images/backimages/back4.jpg">



<div id=printout class="container white center" style="margin-top: 1%; width: 905px;height: 920px;">
    <div id=toNewWindow>
        <div class="section white">

            <img src="images/backimages/logo.jpg" height="100px" width="100px">
            <h4>Regional Maritime University</h4>
            <p><h5>Residence Allocation Letter</h5></p>
        </div>
        <div style="text-align: left; margin-left: 2%">
            <p id=date></p>
            <p><span class="left-align">This serves to confirm that</span></p>
        </div>
        <div class="section grey lighten-5" style="margin-top: -2%">
            <?php $file = "images/studentPasportPics/" . $user . ".jpg";
            $filename = $file;
            $indexNu="";

            if (file_exists($filename)) {
              $indexNu = $file;
            } else {
                $indexNu = "images/studentPasportPics/default.jpeg";
            }
            ?>

            <img height="150" width="150" vspace="5" src="<?php echo $indexNu; ?>">


            <?php
            $applicantQuery = DB::queryRaw("SELECT * FROM student INNER JOIN program ON student.program_id =program.program_id Where emailAddress Like '$user_email'");
            $applicantDetails = $applicantQuery->fetch_assoc();

            $name = $applicantDetails['name'];
            $program = $applicantDetails['program_name'];
            $level = $applicantDetails['level'];
            $idNumber = $applicantDetails['index_no'];
            $room = $applicantDetails['room_id'];
            $appState = $applicantDetails['application_state'];

            $hallQ = DB::queryRaw("SELECT hall.hall_name FROM hall WHERE hall.hall_id =( select hall_id from room where room_id='$room')");
            $applicantHallDetails = $hallQ->fetch_assoc();

            $hallName = $applicantHallDetails['hall_name'];

            ?>

            <p class="left-align" style="margin-left: 5%">FULL NAME OF STUDENT: <b><?php echo $name ?></b></p>
            <p class="left-align" style="margin-left: 5%">PROGRAMME, LEVEL:
                <b><?php echo $program . ", " . $level ?></b></p>
            <p class="left-align" style="margin-left: 5%">STUDENT NUMBER: <b><?php echo $idNumber ?></b></p>

            <p class="left-align" style="margin-left: 5%">Has registered for:</p>

            <p class="left-align" style="margin-left: 5%">NAME OF HALL: <b><?php echo $hallName ?></b></p>
            <p class="left-align" style="margin-left: 5%">ROOM NUMBER: <b><?php echo $room ?></b></p>
            <br>
            <p class="left-align" style="margin-left: 5%">And application is: <b><?php echo $appState ?></b></p>

            <p class="left-align" style="margin-left: 5%">Please present this proof to the Office of the Coordinator of
                Student Affairs and proceed with any necessary actions.</p>
        </div>
    </div>
</div>

<script>

</script>


<!--Footer-->

<!--<footer class="page-footer blue darken-2" style="-->
<!--        position: fixed;-->
<!--        right: 0;-->
<!--        bottom: 0;-->
<!--        left: 0;-->
<!--        padding: 1rem;-->
<!--        background-color: #efefef;-->
<!--        text-align: center;">-->
<!--    <div class="footer-copyright white-text ">-->
<!--        <div class="container">© 2018 Copyright ICT Department-->
<!--            <a class="grey-text text-lighten-4 right" href="#!"></a>-->
<!--        </div>-->
<!--    </div>-->
<!--</footer>-->


<!--Scripts-->
<script type="text/javascript" src="jquery/jquery.js"></script>
<script src="js/materialize.min.js"></script>
<script src="jquery/button.js"></script>


<script>

    $(document).ready(function () {

        print();

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

        $('#modal1').modal('open');
    });
</script>
<script src="upload-image.js"></script>
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

    today = 'DATE PRINTED: ' + dd + '/' + mm + '/' + yyyy;
    document.getElementById('date').innerText = today;


</script>

<script>
    jQuery('a[href^="#"]').click(function (e) {

        jQuery('html,body').animate({scrollTop: jQuery(this.hash).offset().top}, 1000);


        e.preventDefault();
        return false;

    });

</script>
</body>
</html>