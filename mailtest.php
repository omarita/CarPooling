<?php

require_once 'dbconfig.php';
require_once('mailer/class.phpmailer.php');

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->SMTPDebug  = 1;
//$mail->SMTPAuth   = true;
//$mail->SMTPSecure = "";
$mail->Host       = "mail.libraro.it";
$mail->Port       = 25;
$mail->AddAddress("facebook@libraro.it");
$mail->Username="facebook@libraro.it";
$mail->Password="ImmortalMemory2!";
$mail->SetFrom('circumradiantdawn@gmail.com','CarPooling System');
$mail->AddReplyTo("circumradiantdawn@gmail.com","CarPooling System");
$mail->Subject    = "This is a test";
$mail->MsgHTML("Test Message");
$mail->Send();
?>

<!DOCTYPE html>
<html>
  <head>
    <title>SMTP Configuration Test</title>
    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
    <link href="assets/styles.css" rel="stylesheet" media="screen">
     <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
  </head>
  <body id="login">
    <div class="container">Mail Test</div>
  </body>
</html>
