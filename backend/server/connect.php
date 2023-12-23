<?php
  include_once dirname(__FILE__, 2)."/constants.php";
  define('conn', mysqli_connect(
    DB_HOST,
    DB_USERNAME,
    DB_PASSWORD,
    DB_DATABASE,
    DB_PORT
  ));
?>