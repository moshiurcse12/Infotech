<?php

$first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $interest = $_POST['interest'];
    $password = $_POST['password'];
    $con_pass = $_POST['con_password'];
    $status = md5($email);

    include_once './config.php';
    $statement = $db->prepare("INSERT INTO user (first_name,last_name,email,password,interest,status) VALUES (?,?,?,?,?,?)");
    $value = $statement->execute(array($first_name, $last_name, $email, $password, $interest, $status));
    
    
    // Import PHPMailer classes 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


//Load composer's autoloader
require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/Exception.php';
require 'PHPMailer/SMTP.php';


$mail = new PHPMailer(true);                             // Passing `true` enables exceptions
try {
    //Server settings
    $mail->SMTPDebug = 0;                                // Disable verbose debug output. To enable give 1, 2
    $mail->isSMTP();                                    // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';                     
    $mail->SMTPAuth = true;                             
    $mail->Username = 'moshiurr986@gmail.com';            // You enter your gamil us
    $mail->Password = 'moshiur123456';                // Gmail password
    $mail->SMTPSecure = 'tls';                          
    $mail->Port = 587;                                    

    $mail->SMTPOptions = array(
        'ssl' => array(
            'verify_peer' => false,
            'verify_peer_name' => false,
            'allow_self_signed' => true
        )
    );

    //Recipients
    $mail->setFrom($mail->Username, 'PSTU eShop');         // Your gmail username and name
    $mail->addAddress('moshiurr986@gmail.com','mosiur');     // Recioient gmail username and name

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Verify your account';
    $mail->Body    = "Thank you for your signup...Please verify your access by clicking the link .... this is your link ... http://localhost/blogproject/account_confirmation.php?status=".$status;
    //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if ($mail->send()) {

        echo ('
                <div>
                <h2 style="text-align:center; background: slateblue; color: white; margin-top: 5% ">Message has been sent to your Email.Please,check it & verify your account.</h2>
                </div>
            ');
        

    };
    
} catch (Exception $e) {
    echo 'Message could not be sent.';
    echo 'Mailer Error: ' . $mail->ErrorInfo;
}

echo '<center><a href="login.php" class="success button" style="margin-top: 5%"> Login Now </a></center>';
    
    

    if ($value) {
        $message = "Please Confirm Your Email";
        header('location: user_login.php');
    } else {
        $error_message = "Something went wrong";
    }

?>

