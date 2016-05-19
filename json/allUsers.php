<?php
  require_once '../dbconfig.php';
  $database = Database::getInstance();
  $numRows = $database->fetchJson("select * from users", array(), $json);
  echo $json;
?>
