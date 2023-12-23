<?php
  include_once dirname(__FILE__, 2)."/server/sqlScripts.php";
  
  $name = $_POST['nama'];
  $nisn = $_POST['nisn'];
  $email = $_POST['email'];
  $password = $_POST['password'];

  // check whenever value is exist
  $isNameExist = isset($name) ? $name : null;
  $isNisnExist = isset($nisn) ? $nisn : null;
  $isEmailExist = isset($email) ? $email : null;
  $isPasswordExist = isset($password) ? $password : null;

  $check = $isNameExist && $isNisnExist && $isEmailExist && $isPasswordExist;
  $location = "/index.php";
  if(!$check) {
    $location .= "?halaman=signup";
    if($isNameExist) {
      $location .= "&nama=$name";
    }
    if($isNisnExist) {
      $location .= "&nisn=$nisn";
    }
    if($isEmailExist) {
      $location .= "&email=$email";
    }
    if($isPasswordExist) {
      $location .= "&password=$password";
    }

    header("Location: $location");
  } else {
    header("Location: /index.php");
    createUser($name, $nisn, $email, $password);
  }
?>