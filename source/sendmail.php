<?php



if (isset($_POST['gRecaptchaResponse'])) {
    require('../includes/conn.php');
    require ('../includes/saa_credentials.php');

    
    $secret_key = "6LfLx7ElAAAAAM7INSXCEfgussa-cm1zZ-FzfZW1";
    $ip = $_SERVER['REMOTE_ADDR'];
    $response = $_POST['gRecaptchaResponse'];
    $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secret_key&response=$response&remoteip=$ip";
    $fire = file_get_contents($url);
    $data = json_decode($fire);
    if ($data->success == true) {
        $email = mysqli_real_escape_string($conn, $_POST['email']);
        $name = mysqli_real_escape_string($conn, $_POST['name']);
        $country_dial_code = $_POST['countryCode'];
        $phone = mysqli_real_escape_string($conn, $_POST['phone']);
        $msg = mysqli_real_escape_string($conn, $_POST['message']);

        $phoneNumber = '+' . $country_dial_code . ' ' . $phone;

        // var_dump($email);

        $sql = "INSERT INTO `enquiries`(`name`, `email`, `phone`, `message`) VALUES ('$name','$email','$phoneNumber','$msg')";
        $result = mysqli_query($conn, $sql);

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
        $mail->addAddress(EMAIL);
        $mail->isHTML(true); // Set email format to HTML
        // $mail->setFrom('admin@saa.ai', 'SAA Admin');
        $mail->setFrom(EMAIL, 'SAA Admin');

        $mail->Subject = 'SAA Consultancy';
        $mail->Body    = "Hello Admin,<br><br>
                  $name has tried to contact you. Below are the request details.<br>
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
                          <th style='border: 1px solid; text-align: left;'>Message: </th>
                          <td style='border: 1px solid'>$msg</td>
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
                'message' => '<p>Thank you for contacting us. Our team will contact you soon.</p>'
            ];
            print_r(json_encode($response));
            // echo "<script>window.location='thankyoupage.php'</script>";
        }

        // try {
        // } catch (Exception $e) {
        //     // print 'Exception detected : ' . $e->getMessage() . "\n";

        //     $response = [
        //         'status' => 'ok',
        //         'success' => false,
        //         'message' => 'Oops. Something went wrong. Please try again.'
        //     ];
        //     print_r(json_encode($response));
        // }
    } else {
        $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Captcha not verified. Please contact administrator.'
    ];
    print_r(json_encode($response));
    }
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Captcha not validated/expired. Please try again.'
    ];
    print_r(json_encode($response));
}