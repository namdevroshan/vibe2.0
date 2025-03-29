<?php

// require ('../includes/saa_credentials.php');
require('../includes/conn.php');


$firstName =  mysqli_real_escape_string($conn,trim($_POST['firstName']));
$lastName =  mysqli_real_escape_string($conn,trim($_POST['lastName']));
$email =  mysqli_real_escape_string($conn,trim($_POST['email']));
$phone =  mysqli_real_escape_string($conn,trim($_POST['phone']));
$countryCodeNumber =  mysqli_real_escape_string($conn,trim($_POST['countryCodeNumber']));
$country =  mysqli_real_escape_string($conn,trim($_POST['country']));
$role =  mysqli_real_escape_string($conn,trim($_POST['role']));


    $phoneNumber =  $countryCodeNumber . ' ' . $phone;
    $name = $firstName . ' ' . $lastName;
    // var_dump($email);

    $sql = "INSERT INTO `vibe_demo_requests`(`firstname`, `lastname`, `email`, `phone`, `country`, `role`, `product_name`) VALUES ('{$firstName}','{$lastName}','{$email}','{$phoneNumber}','{$country}','{$role}', 'vibe')";
    $result = mysqli_query($conn, $sql);

    require('./vendor/autoload.php');


    

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
    $mail->Host     = "mail.saa.ai"; // SMTP server
    // $mail->Host     = "smtp.gmail.com";


    $mail->Username = EMAIL; // "The account"
    $mail->Password = PASS; //a@1 "The password"
    $mail->Port = 465; // "The port".

    $mail->From = '';
    $mail->addAddress(EMAIL);
    $mail->addAddress('info@saa.ai');
    $mail->addAddress('accounts@saa.ai');
    $mail->addAddress('AmitSaxena@saa.ai');
    // $mail->addAddress('roshannamdevbpl@gmail.com');
    $mail->isHTML(true); // Set email format to HTML
    // $mail->setFrom('admin@saa.ai', 'SAA Admin');
    $mail->setFrom(EMAIL, 'SAA Admin');

    $mail->Subject = 'VIBE Demo Request';
    $mail->Body    = "Hello Admin,<br><br>
              $name has tried to contact you for VIBE demo. Below are the request details.<br>
              <table>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>From: </th>
                      <td style='border: 1px solid'>$name</td>
                  </tr>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>Email: </th>
                      <td style='border: 1px solid'>$email</td>
                  </tr>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>Mobile: </th>
                      <td style='border: 1px solid'>$phoneNumber</td>
                  </tr>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>Country: </th>
                      <td style='border: 1px solid'>$country</td>
                  </tr>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>Role: </th>
                      <td style='border: 1px solid'>$role</td>
                  </tr>
                  <tr>
                      <th style='border: 1px solid; text-align: left;'>Demo requested for product: </th>
                      <td style='border: 1px solid'>Vibe</td>
                  </tr>
              </table><br><br>
              Regards,<br>
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
            'message' => '<p>Your request has been received! Our team will reach out to you shortly to schedule your VIBE demo session.</p>'
        ];
        print_r(json_encode($response));
        // echo "<script>window.location='thankyoupage.php'</script>";
    }