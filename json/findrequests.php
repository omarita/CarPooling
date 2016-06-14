<?php
  require_once '../dbconfig.php';
  $database = Database::getInstance();
  $userID = $_GET["id"];
  $fromLocation = $_GET["fromlocation"];
  $toLocation = $_GET["tolocation"];
  $date = $_GET["date"];
  $numRows = $database->fetchJson("select U.userName, U.phoneNo, date_format (T.departure, '%a, %d %b %Y ore %H:%i') departure,
    R.message, T.fromLocation, T.toLocation, T.price, R.seats from requests R inner join transfers T on R.transferID = T.transferID
    inner join users U on T.userID = U.userID where R.userID <> :iid", array(":iid"=>$userID), $json);
  echo $json;
?>
