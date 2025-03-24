<?php
include("conn.php");


$firstName =  mysqli_real_escape_string($conn,trim($_POST['firstName']));
$lastName =  mysqli_real_escape_string($conn,trim($_POST['lastName']));
$email =  mysqli_real_escape_string($conn,trim($_POST['email']));
$phone =  mysqli_real_escape_string($conn,trim($_POST['phone']));
$country =  mysqli_real_escape_string($conn,trim($_POST['country']));
$role =  mysqli_real_escape_string($conn,trim($_POST['role']));

$sql = "INSERT INTO `vibe_demo_requests`(`firstname`, `lastname`, `email`, `phone`, `country`, `role`) VALUES ('{$firstName}','{$lastName}','{$email}','{$phone}','{$country}','{$role}')";

if (mysqli_query($conn, $sql)) {
    $response = [
        'status' => 'ok',
        'success' => true,
        'message' => 'Request created successfully! Out team will reach out to you soon.'
    ];
    print_r(json_encode($response));
} else {
    $response = [
        'status' => 'ok',
        'success' => false,
        'message' => 'Request creation failed!'
    ];
    print_r(json_encode($response));
}