<?php
session_start();
require "functions.php";

$email = $_POST['email'];
$password = $_POST['password'];

$username = $_POST['username'];
$job_title = $_POST['job_title'];
$phone = $_POST['phone'];
$address = $_POST['address'];

$status = $_POST['status'];
$avatar = $_FILES['avatar'];

$vk = $_POST['vk'];
$telegram = $_POST['telegram'];
$instagram =$_POST['instagram'];

$user_id = add_user($email,$password);

edit_information($username,$job_title,$phone,$address,$user_id);

set_status($status,$user_id);


