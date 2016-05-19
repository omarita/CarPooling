<?php
  require_once '../dbconfig.php';
  $database = Database::getInstance();
  //TODO make parametric by user
  $numRows = $database->fetchJson("select * from transfers", array(), $json);
  echo $json;
?>
