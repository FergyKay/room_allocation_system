<?php
include "dbconnection.php"; //make connection here
use PHPMailer\PHPMailer\PHPMailer;

if (isset($_POST['register'])) {
    $user_email = $_POST['email'];
    $user_index = strtoupper($_POST['index']);
    $user_password = $_POST['password'];
    $user_passwordRetyped = $_POST['password2'];


    if (validateMemberPasswordRepeat($user_passwordRetyped, $user_password) == true) {

        $check_id_query = DB::queryRaw("select * from student WHERE index_no='$user_index' and passkey LIKE '-'");
        $row = $check_id_query->fetch_assoc();


        if (DB::count() < 1) {
            echo "<script> alert('Index Number already Registered or account does not Exist');window.location='index.php'</script>";
        } else {

            $hash = password_hash($user_email, PASSWORD_BCRYPT);
            $user_passwordHashed = password_hash($user_password, PASSWORD_DEFAULT);


            $insert_user = DB::query("UPDATE student SET passkey = '$user_passwordHashed', hash ='$hash', emailAddress ='$user_email' WHERE index_no LIKE '$user_index'");

            if (DB::affectedRows() == 1) {
                sendVerificationMail($user_email, $hash);
            } else ?>
                <script> console.log("Errors in update statement"); </script>
                <?php
        }

    } else {
        echo "<script>alert('Passwords do not match')</script>";
        echo "<script>window.open('register.html','_self')</script>";
    }

//here query check weather if user already registered so can't register again.

}

function validateMemberPasswordRepeat($memberPasswordRepeat, $memberPassword)
{
    if ($memberPasswordRepeat === $memberPassword) {
        return true;
    } else {
        return false;
    }
}

function sendVerificationMail($emailaddress, $hash)
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

    $mail->addAddress($emailaddress, $emailaddress);

    $mail->isHTML(true);

    $message = '
Your account has been verified and activated, you can login with your email address and password after you have activated your account by clicking this url: 
http://localhost/rmu/verify.php?email=' . $emailaddress . '&hash=' . $hash . '
';

    $mail->Subject = "Verify Account For Residence Registration";
    $mail->Body = $message;
    // $mail->AltBody = "This is the plain text version of the email content";

    if (!$mail->send()) {
        echo "<script>alert('Your account has not been made');
               window.open('index.php','_self')</script>";
    } else {
        echo "<script>alert('Your account has been made, Please verify it by clicking the activation link that has been sent to your email.');
               window.open('index.php','_self')</script>";
    }


}

?>

