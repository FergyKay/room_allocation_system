<?php
include "database/dbcon.php";
include "dbconnection.php";
session_start();
use PHPMailer\PHPMailer\PHPMailer;
if (!$_SESSION['email']) {
    header("Location: index");//redirect to login page to secure the welcome page without login access.
}

if (isset($_GET['email']) && isset($_GET['action'])) {


    if ($_GET['action'] == 'Approved') {

        $user_email = $_GET['email'];
        $roomGiven = $_GET['room_id'];

        $update = DB::query("Update student set application_state ='Approved' WHERE emailAddress='$user_email' AND active='1'");

        $query2 = DB::query("update room set bed_count_current=bed_count_current - 1 WHERE room_id = '$roomGiven'");

    } else {

        $user_email = $_GET['email'];
        $query = DB::query("Update student set application_state ='Rejected' WHERE emailAddress='$user_email' AND active='1'");

    }

    sendConfirmationMail($user_email, $_GET['action']);
    header("Location: dash#applications");
}

function sendConfirmationMail($address, $message)
{
    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/phpmailer/phpmailer/src/Exception.php';

    $mail = new PHPMailer;

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );
//Enable SMTP debugging.
    $mail->SMTPDebug = 0;
//Set PHPMailer to use SMTP.
    $mail->isSMTP();
//Set SMTP host name
    $mail->Host = "smtp.gmail.com";
//Set this to true if SMTP host requires authentication to send email
    $mail->SMTPAuth = true;
//Provide username and password
    $mail->Username = "efarthur@st.ug.edu.gh";
    $mail->Password = "1045512739861";
//If SMTP requires TLS encryption then set it
    $mail->SMTPSecure = "tls";
//Set TCP port to connect to
    $mail->Port = 587;

    $mail->From = "efarthur@st.ug.edu.gh";
    $mail->FromName = "Noreply@rmu.edu.gh";

    $mail->addAddress($address,$address);

    $mail->isHTML(true);

    $message = '
    Dear Student, Your Residence Application has been reviewed and has been ' . $message . '. Kindly log in and take any necessary actions required';

    $mail->Subject = "Residence Application";
    $mail->Body = $message;
    // $mail->AltBody = "This is the plain text version of the email content";

    if (!$mail->send()) {
         echo "Mailer Error: " . $mail->ErrorInfo;
    } else {

    }
}

