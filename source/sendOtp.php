<?php

require('../includes/conn.php');
// require ('../includes/saa_credentials.php');

$email = mysqli_real_escape_string($conn, $_POST['email']);
$otp = mysqli_real_escape_string($conn, $_POST['userotp']);
// var_dump($email);

require('./vendor/autoload.php');


/*print ("Thank You For Contact Us :-)\n");*/

$mail = new PHPMailer();
$mail->IsSMTP();  // Telling the class to use SMTP  
$mail->SMTPOptions = array(
    'ssl' => array(
        'verify_peer' => false,
        'verify_peer_name' => false,
        'allow_self_signed' => true
    )
);

$mail->SMTPAuth = true;
$mail->SMTPSecure = "ssl"; // or ssl: check your SMTP server configuration
// $mail->Host     = "mail.saa.ai"; // SMTP server
$mail->Host     = "smtp.gmail.com";

// $mail->Username = "admin@saa.ai"; // "The account"
// $mail->Password = "&cts592G2"; //a@1 "The password"
// $mail->Port = 587; // "The port".

$mail->Username = EMAIL; // "The account"
$mail->Password = PASS; //a@1 "The password"
$mail->Port = 465; // "The port".

$mail->From = '';
$mail->addAddress(mysqli_real_escape_string($conn, $_POST['email']));
$mail->isHTML(true); // Set email format to HTML
// $mail->setFrom('admin@saa.ai', 'SAA Admin');
$mail->setFrom('itsbunty12398@gmail.com', 'SAA Admin');

$mail->Subject = 'Email Verification - One-Time Password (OTP)';
$mail->Body    = "Dear User,<br><br>
                    We hope this email finds you well. Thank you for choosing SAA Consultancy!.
                    <br>
                    
                    To complete the registration process and ensure the security of your account, we kindly request you to verify your email address by entering the One-Time Password (OTP) provided below:
                        
                    <br><br>
                    <span style='font-size: 14px; magin-right: 20px'>Your OTP:</span> <span style='font-size: 24px'>$otp</span>
                    <br><br>
                    
                    Please use the provided OTP within the next 10 minutes to complete the email verification process. If you did not initiate this registration or if you believe this is an error, please disregard this email.
                    <br>
                    
                    For any assistance or concerns, please feel free to contact our customer support at info@saa.ai.
                    <br>
                    
                    Thank you for choosing [Your Company Name]. We look forward to working with you.
                    <br><br>
                    Best regards,<br>
                  SAA Consultancy<br>
                  Email: info@saa.ai | hr@saa.ai";


// $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//$mail->WordWrap = 100; // "The lenght of the text."  

if (!$mail->Send()) {
    // print("Error: message not sent\n");
    // print($mail->ErrorInfo . "\n");
    // var_dump($mail->ErrorInfo . "\n");
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Oops. Something went wrong. Please try again.'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => '<p>An OTP has been sent to your email. Kindly enter the OTP to complete verification.</p>'
    ];
    print_r(json_encode($response));
    // echo "<script>window.location='thankyoupage.php'</script>";
}