<?php

function connection_pdo() {
    $pdo = new PDO ('mysql:host=localhost;dbname=my_project', "root", "");
    return $pdo;
}
function get_user_by_email($email) {
    $pdo = new PDO("mysql:host=localhost;dbname=my_project", "root", "");
    $sql = "SELECT * FROM users WHERE email=:email";
    $statement = $pdo->prepare($sql);
    $statement->execute(["email"=> $email]);
    $user = $statement->fetch(PDO::FETCH_ASSOC);
    return $user;
}
function set_flash_message($name, $message) {
    $_SESSION[$name] = $message;
}
function redirect_to($path) {
    header("Location: {$path}");
    exit;
}
function add_user($email, $password){

    $pdo = new PDO ("mysql:host=localhost;dbname=my_project", "root", "" );
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

    $statement = $pdo->prepare($sql);
    $result = $statement->execute([
        "email" => $email,
        "password" => password_hash($password, PASSWORD_DEFAULT)
    ]);

    return $pdo->lastInsertId();
}
function display_flash_message($name)
{
    if (isset($_SESSION[$name])) {
        echo "<div class=\"alert alert-{$name} text - dark\" role=\"alert\">{$_SESSION[$name]}</div>";
        unset($_SESSION[$name]);
    }
}
function edit_information($username, $job_title, $phone, $address, $user_id)
{
    $conn = connection_pdo();
    $sql = "SELECT * FROM users_information WHERE user_id=:user_id";
    $stmt = $conn->prepare($sql);
    $stmt->execute(["user_id" => $user_id]);
    $result = $stmt->fetchAll();
    if (empty($result)) {
        $sql = "INSERT INTO users_information (username, job_title, phone, address, user_id) VALUES (:username,:job_title, :phone, :address, :user_id) ";
    }
    else {
        $sql = "UPDATE users_information SET username=:username, job_title=:job_title, phone=:phone, address=:address WHERE user_id=:user_id";
    }
    $stmt = $conn->prepare($sql);
    $stmt->execute(["username" => $username, "job_title" => $job_title, "phone" => $phone, "address" => $address, "user_id" => $user_id]);
}

function set_status($status, $user_id){
$conn = connection_pdo();
$sql = "SELECT * FROM status WHERE user_id=:user_id";
$stmt = $conn->prepare($sql);
$stmt->execute(["user_id" => $user_id]);
$result = $stmt->fetchAll();

if (empty($result)) {
    $sql = "INSERT INTO status (status, user_id) VALUES (:status, :user_id)";
}
else {
    $sql = "UPDATE status SET status=:status WHERE user_id=:user_id";
}
    $stmt = $conn->prepare($sql);
    $stmt->execute(["status" => $status, "user_id" => $user_id]);
}









