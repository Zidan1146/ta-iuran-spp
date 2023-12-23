<?php
  include_once dirname(__FILE__, 2)."/server/sqlScripts.php";

  $userId = $_GET['id'];

  if(isset($userId)) {
    generateSPPData($userId);
  }
?>