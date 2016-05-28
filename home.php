<?php
session_start();
require_once 'class.user.php';
$user_home = new USER();

if(!$user_home->is_logged_in())
{
	$user_home->redirect('index.php');
}

$user_home->getUserById($_SESSION['userSession']);

?>

<!DOCTYPE html>
<html class="no-js">

    <head>
        <title>CarPooling</title>
				<!-- Bootstrap -->
				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
				<link href="bootstrap/css/bootstrap-table.min.css" rel="stylesheet" media="screen">
				<link href="bootstrap/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
        <!-- Assets -->
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- DatePicker -->
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
			<!--/.fluid-container-->
			<script src="bootstrap/js/jquery-1.9.1.min.js"></script>
			<script src="bootstrap/js/bootstrap.min.js"></script>
			<script src="bootstrap/js/bootstrap-table.min.js"></script>
			<script src="assets/scripts.js"></script>
			<!-- Include Bootstrap Datepicker -->
			<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
			<!-- Include Bootstrap Timepicker -->
			<script type="text/javascript" src="bootstrap/js/bootstrap-timepicker.min.js"></script>

      <div class="navbar navbar-fixed-top">
          <div class="navbar-inner">
              <div class="container-fluid">
                  <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"> <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                  </a>
                  <a class="brand" href="#">Welcome in CarPooling</a>
                  <div class="nav-collapse collapse">
                      <ul class="nav pull-right">
                          <li class="dropdown">
                              <a href="#" role="button" class="dropdown-toggle" data-toggle="dropdown"> <i class="icon-user"></i>
																<?php echo $user_home->userEmail; ?> <i class="caret"></i>
                              </a>
                              <ul class="dropdown-menu">
                                  <li>
                                      <a tabindex="-1" href="logout.php">Logout</a>
                                  </li>
                              </ul>
                          </li>
                      </ul>
											<!--
                      <ul class="nav">
                          <li class="active">
                              <a href="http://www.codingcage.com/">CarPooling</a>
                          </li>
                          <li class="dropdown">
                              <a href="#" data-toggle="dropdown" class="dropdown-toggle">Tutorials <b class="caret"></b>

                              </a>
                              <ul class="dropdown-menu" id="menu1">
																	<li><a href="http://xxx">Item 1</a></li>
																	<li><a href="http://yyy">Item 2</a></li>
                              </ul>
                          </li>
                          <li>
                              <a href="http://zzzz">Main Link</a>
                          </li>
                      </ul>
										-->
                  </div>
                  <!--/.nav-collapse -->
              </div>
          </div>
      </div>

			<div class="container">
				<div id="newTransfer" class="popupDiv1">
				<!-- Popup Div Starts Here -->
				<div id="popupContact" class="popupDiv2">
				<!-- Contact Us Form -->
					<form id="newTransferForm" action="#" class="form-horizontal popupForm clearfix" method="post" name="form">
						<img id="close" src="assets/3.png" onclick ="div_hide()">
						<h2>Inserisci passaggio</h2>
						<hr />
						<div class="form-group">
							<input id="name" name="name" placeholder="Nome" type="text">
						</div>
						<div class="form-group">
							<input id="email" name="email" placeholder="Email" type="text">
						</div>
						<div class="form-group">
							<div class="date">
									<div class="input-group input-append date" id="datePicker">
											<input type="text" class="form-control" placeholder="Data" name="date" />
											<span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
									</div>
							</div>
						</div>
						<div class="form-group">
							<section id="timepicker">
								<div class=" date">
									<div class="input-group bootstrap-timepicker timepicker">
											<input id="timepicker1" class="form-control input-small" type="text"/><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
									</div>
								</div>
							</section>
						</div>
						<hr />
						<button class="btn btn-large btn-primary pull-right" style="margin-bottom:15px" onclick="div_show()" name="btn-insert">Ok</button>
					</form>
				</div>
				<!-- Popup Div Ends Here -->
				</div>
				<div class="shadowbox" id="transfers">
				  <h2>Passaggi offerti</h2>
				  <p>Lista dei passaggi offerti</p>
					<table data-toggle="table" data-url="json/transfers.php?id=<?php echo $user_home->userID; ?>" >
							<thead>
									<tr>
										<th data-field="departure">Data e ora</th>
										<th data-field="fromLocation">Da</th>
										<th data-field="toLocation">A</th>
										<th data-field="availableSeats">Posti disponibili</th>
										<th data-field="price">Costo</th>
									</tr>
							</thead>
					</table>
					<hr />
						<button class="btn btn-large btn-primary" style="float:right;margin-bottom:15px" onclick="div_show()" name="btn-login">Nuovo</button>
					<div style="clear:both;" />
					<p />
				</div>
			</div>
			<script>
				jQuery(document).ready(function($) {
						$('#timepicker1').timepicker({
							minuteStep: 10,
							showMeridian: false
						});

						$('#timepicker1').on('changeTime.timepicker', function(e) {
							$('#timeDisplay').text(e.time.value);
						});

						$(".clickable-row").click(function() {
								window.document.location = $(this).data("href");
						});

						$('#datePicker')
							.datepicker({
									autoclose: true,
									format: 'dd/mm/yyyy',
									startDate: new Date(),
									endDate: maxDate()
							});
				});
				function maxDate(){
					var max = new Date();
					max.setDate ((max.getDate() + 30));
					return max;
				}

				//Function To Display Popup
				function div_show() {
					document.getElementById('newTransfer').style.display = "block";
					document.getElementById('transfers').style.display = "none";
				}
				//Function to Hide Popup
				function div_hide(){
					document.getElementById('newTransfer').style.display = "none";
					document.getElementById('transfers').style.display = "block";
				}
			</script>
    </body>
</html>
