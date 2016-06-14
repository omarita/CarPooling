<?php
  require_once 'dbconfig.php';
  $database = Database::getInstance();
  //
  $stmt = $database->conn->prepare("INSERT INTO transfers(userID, departure, fromLocation, toLocation, availableSeats, price)
                                               VALUES(:userID, :departure, :fromLocation, :toLocation,:availableSeats, :price)");
  //
  //for php > 5.2
  //$departure = DateTime::createFromFormat ("d/m/Y H:i" , $_POST["date"] . " " . $_POST["timepicker1"]);
  //$departureStr = $departure->format("Y/m/d H:i:s");
  $departure = strtotime ($_POST["date"] . " " . $_POST["timepicker1"]);
  $departureStr = date("Y/m/d H:i:s", $departure);

  $stmt->bindparam(":userID", $_POST["userID"]);
  $stmt->bindparam(":departure", $departureStr);
  $stmt->bindparam(":fromLocation",$_POST["fromLocation"]);
  $stmt->bindparam(":toLocation",$_POST["toLocation"]);
  $stmt->bindparam(":availableSeats",$_POST["availableSeats"]);
  $stmt->bindparam(":price",$_POST["price"]);
  $stmt->execute();

  //echo $departureStr;

?>
