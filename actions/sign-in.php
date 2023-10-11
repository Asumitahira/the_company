<?php
// ../ -go outside the current folder | .../ -root
include '../classes/User.php';

// object
$user = new User;

// $password = password_hash($_POST['password'],PASSWORD_DEFAULT);
//User.phpの情報取得
$user->signIn($_POST);

// print_r($_POST);




