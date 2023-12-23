<?php
  include_once dirname(__FILE__, 2)."/server/sqlScripts.php";
  
  $nameOrEmail = $_POST['nama'];
  $password = $_POST['password'];
  $isRemembered = $_POST['remember'];

  // check whenever value is exist
  $isNameExist = isset($nameOrEmail) ? $nameOrEmail : null;
  $isPasswordExist = isset($password) ? $password : null;

  $check = $isNameExist && $isPasswordExist;
  $location = "/index.php";
  if(!$check) {
    $location .= "?halaman=login";
    if($isNameExist) {
      $location .= "&nama=$nameOrEmail";
    }
    if($isPasswordExist) {
      $location .= "&password=$password";
    }

    header("Location: $location");
  } else {
    $result = loginCheck($nameOrEmail, $password, $isRemembered);
    if(isset($result)) {
      header("Location: /index.php");
    }
    else {
      $location .= "?halaman=login&nama=$nameOrEmail&password=$password";
      header("Location: $location");
    }
  }
?>