<?php

session_start();

require "function_users.php";

$email = $_POST['email'];
$password = $_POST['password'];

login($email,$password);
authorization($email, $password);

redirect_to("/create_user.php");








