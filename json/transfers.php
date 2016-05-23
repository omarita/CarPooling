<?php
  require_once '../dbconfig.php';
  $database = Database::getInstance();
  $userID = $_GET["id"];
  $numRows = $database->fetchJson("select date_format (departure, '%a, %d %b %Y ore %H:%i') departure, fromLocation, toLocation, availableSeats, concat(format(price,2),'€') price  from transfers where userID=:id", array(":id"=>$userID), $json);
  echo $json;
?>
