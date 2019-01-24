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


} else
    echo "<script>window.location('summary',self)</script>";


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
    echo "<script>alert('Successfully Registered!')</script>";
    header("Location: summary");//

}

function putBackToDB($user, $roomId)
{
    $query = DB::queryRaw("UPDATE `student` SET `room_id` = '$roomId', `application_state` = 'Pending' WHERE `student`.`emailAddress` = '$user'");

}


