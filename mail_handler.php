<?php
use PHPMailer\PHPMailer\PHPMailer;
if(isset($_POST['submit'])) {
    $name = $_POST['name'];
    $occupation = $_POST['job'];
    $contact = $_POST['contact'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $residence = $_POST['residence'];

    $message = "Name: " . $name . "\n\nJob: " . $occupation . "\n\nPhone Number 1: " . $contact . "\n\nPhone Number 1: " .
        $phone . "\n\nemail: " . $email . "\n\nAddress: " . $residence;


    require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
    require 'vendor/phpmailer/phpmailer/src/SMTP.php';
    require 'vendor/phpmailer/phpmailer/src/Exception.php';

    $mail = new PHPMailer;

//Enable SMTP debugging.
    $mail->SMTPDebug = 3;
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

    $mail->From = "info@nfmatix.com.gh";
    $mail->FromName = "NFMATIX";

    $mail->addAddress("nfmatix@gmail.com", "Admin@nfmatix");

    $mail->isHTML(true);

    $mail->Subject = "Subject Text";
    $mail->Body = $message;
    // $mail->AltBody = "This is the plain text version of the email content";

    if (!$mail->send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
    } else {
        echo "Message has been sent successfully";
    }
    header('Location: services.html');
    exit;
}
?>