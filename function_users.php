<?php

session_start();
require "functions.php";
function
authorization ($email, $password) {
    $pdo = new PDO('mysql:host=localhost;dbname=my_project;', "root", "");
    $hash_password = password_hash($password, PASSWORD_DEFAULT);
    $sql = "SELECT * FROM users WHERE email=:email";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['email' => $email]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['msg'] = "Авторизация успешна";
    } else{
        $_SESSION['error'] = 'Такой пользователь не найден';
    }
}

function login($email, $password) {
    $user =[
        "id" => 1,
        "email" => "selitskiiroman@mail.ru",
        "role" => "admin"
    ];
    $_SESSION['user'] = $user;
}

function is_logged_in() {
    if(isset($_SESSION['user'])) {
        return true;
    }

    return false;
}
function is_not_logged_in() {
return !is_logged_in();
}


function get_users() {
$pdo = new PDO ("mysql:host=localhost;dbname=my_project", "root", "");
$statement = $pdo->query("SELECT * FROM users");
return $statement->fetchAll(PDO::FETCH_ASSOC);
}

function get_authenticated_user() {
    if(is_logged_in()) {
        return $_SESSION['user'];
    }

    return false;
}

function is_admin($user) {
if (is_logged_in()) {
    if ($user["role"] === "admin") {
        return true;
    }
    return false;
}

}

function is_equal($user, $current_user) {

    return $user["id"] === $current_user["id"];
}