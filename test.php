<!DOCTYPE html>
<?php
require_once 'dbconfig.php';
require_once 'class.user.php';
$user = new USER();

?>
<html class="no-js">


    <body>
			<?php
      $database = Database::getInstance();
      $rowCount = $database->fetch("SELECT * FROM users WHERE userID=:uid", array(":uid"=>-999), $rows);
      echo ("Users -999 " . count($rows) . "<br/>");
      $rowCount = $database->fetch("SELECT * FROM users WHERE userID=:uid", array(":uid"=>10), $rows);
      echo ("Users 10 " . count($rows) . "<br/>");
      $rowCount = $database->fetch("SELECT * FROM users", array(), $rows);
      echo ("Users All " . count($rows) . " - " . $rows . "<br/>");

      $count=$user->getUserById(10);
      echo ("Users byID " . $count . " - " . $user->userName . "<br/>");
/*
      $username = "utente1";
      $userID = $user->register($username, $username . "@gmail.com", $username, md5(uniqid(rand())));
      $user->getUserByEmail($username . "@gmail.com");
      $user->userStatus="Y";
			$user->update();
      echo ("User with email " . $username . "@gmail.com" . " created.<br/>");

      $username = "utente2";
      $userID = $user->register($username, $username . "@gmail.com", $username, md5(uniqid(rand())));
      $user->getUserByEmail($username . "@gmail.com");
      $user->userStatus="Y";
			$user->update();
      echo ("User with email " . $username . "@gmail.com" . " created.<br/>");
*/

      $startTime = strtotime('2016/03/05 21:33');
      $endTime = strtotime('+60 minutes', $startTime);

      $start = date('Y-m-d H:i:s', $startTime);
      $end = date('Y-m-d H:i:s', $endTime);

      echo ("startTime " . $startTime . "<br/>");
      echo ("endTime " . $endTime . "<br/>");
      echo ("start " . $start . "<br/>");
      echo ("end " . $end . "<br/>");

      $numRows = $database->fetch("SELECT * FROM users WHERE userID=:uid", array(":uid"=>14), $json);
      echo ("json " . $json . "<br/>");
      $numRows = $database->fetchjson("select date_format (departure, '%a, %d %b %Y ore %H:%i') departure, fromLocation, toLocation, availableSeats, concat(format(price,2),' Eur') price  from transfers where userID=:iid", array(":iid"=>16), $json);
      echo ("json " . $json . "<br/>");
       ?>
    </body>
</html>
