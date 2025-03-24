<?php


// require('./vendor/autoload.php');
require ('../includes/saa_credentials.php');

function sendMail($recepientMail, $subject, $mailBody)
{
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
    $mail->addAddress($recepientMail);
    $mail->isHTML(true); // Set email format to HTML
    // $mail->setFrom('admin@saa.ai', 'SAA Admin');
    $mail->setFrom(EMAIL, 'SAA Admin');

    $mail->Subject = $subject;
    $mail->Body    = $mailBody;


    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    //$mail->WordWrap = 100; // "The lenght of the text."  

    if (!$mail->Send()) {
        // print("Error: message not sent\n");
        // print($mail->ErrorInfo . "\n");
        // var_dump($mail->ErrorInfo . "\n");
        // $response = [
        //     'status' => 'ok',
        //     'success' => false,
        //     'message' => 'Oops. Something went wrong. Please try again.'
        // ];
        // print_r(json_encode($response));
    } else {
        // $response = [
        //     'status' => 'ok',
        //     'success' => true,
        //     'message' => '<p>Thank you for contacting us.</p><p class="text-danger">Our team will contact you soon.</p>'
        // ];
        // print_r(json_encode($response));
        // echo "<script>window.location='thankyoupage.php'</script>";
    }
}