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
				<!-- Assets -->
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- DatePicker -->
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
        <!-- Include Bootstrap Timepicker -->
				<link href="bootstrap/css/bootstrap-timepicker.min.css" rel="stylesheet" media="screen">
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
			<!-- Assets -->
			<script src="assets/scripts.js"></script>
			<!-- Include Bootstrap Datepicker -->
			<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>
			<!-- Include Bootstrap Timepicker -->
			<script type="text/javascript" src="bootstrap/js/bootstrap-timepicker.min.js"></script>

			<nav class="navbar navbar-default navbar-fixed-top">
				<div class="container-fluid">
					<!-- Brand and toggle get grouped for better mobile display -->
					<div class="navbar-header">
						<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
						<a class="navbar-brand" href="#">CarPooling</a>
					</div>

					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
						<ul class="nav navbar-nav">
							<li><a href="#">Profilo</a></li>
							<li><a href="#">Messaggi</a></li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
			        <li class="dropdown">
			          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $user_home->userName; ?>
								<span class="caret"></span></a>
								<ul class="dropdown-menu">
										<li>
												<a tabindex="-1" href="logout.php">Logout</a>
										</li>
								</ul>
			        </li>
			      </ul>

					</div><!-- /.navbar-collapse -->
				</div><!-- /.container-fluid -->
			</nav>

			<div class="container">
				<div id="newTransfer" class="popupDiv1">
				<!-- Popup Div Starts Here -->
					<div id="popupContact" class="popupDiv2">
					<!-- Contact Us Form -->
						<form id="newTransferForm" action="#" class="form-horizontal popupForm clearfix" method="post" name="form">
							<input id="userID" name="userID" type="hidden" value="<?php echo $user_home->userID; ?>"/>
							<img id="close" src="assets/3.png" onclick ="div_hide()" />
							<h2>Inserisci passaggio</h2>
							<hr />
							<div class="form-group">
								<input id="fromLocation" name="fromLocation" placeholder="Partenza" type="text" />
							</div>
							<div class="form-group">
								<input id="toLocation" name="toLocation" placeholder="Arrivo" type="text" />
							</div>
							<div class="form-group">
								<input id="availableSeats" name="availableSeats" maxLength="2" placeholder="Numero Posti" type="text" />
							</div>
							<div class="form-group">
								<input id="price" name="price" maxLength="3" placeholder="Prezzo" type="text" />
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
												<input id="timepicker1" name="timepicker1" class="form-control input-small" type="text"/><span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
										</div>
									</div>
								</section>
							</div>
							<hr />
							<button class="btn btn-large btn-primary pull-right" style="margin-bottom:15px" name="btn-insert">Ok</button>
						</form>
					</div>
				<!-- Popup Div Ends Here -->
				</div>
				<div class="shadowbox" id="transfers">
				  <h2>Passaggi offerti</h2>
				  <p>Lista dei passaggi offerti</p>
					<table id="transfersTable" data-toggle="table" data-url="json/transfers.php?id=<?php echo $user_home->userID; ?>" >
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
				<div class="shadowbox" id="requests">
				  <h2>Passaggi richiesti</h2>
				  <p>Lista dei passaggi richiesti</p>
					<table id="requestsTable" data-toggle="table" data-url="json/requests.php?id=<?php echo $user_home->userID; ?>" >
							<thead>
									<tr>
										<th data-field="userName">Utente</th>
										<th data-field="phoneNo">Telefono</th>
										<th data-field="departure">Data e Ora</th>
										<th data-field="fromLocation">Partenza</th>
										<th data-field="toLocation">Destinazione</th>
										<th data-field="price">Prezzo</th>
										<th data-field="seats">Posti</th>
									</tr>
							</thead>
					</table>
					<hr />
						<a class="btn btn-large btn-primary" style="float:right;margin-bottom:15px" href="find.php">Cerca</a>
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

						$(".clickable-row").click(function() {
								window.document.location = $(this).data("href");
						});

						//called when key is pressed in textbox
					  $("#availableSeats").keypress(function (e) {
					     //if the letter is not digit then display error and don't type anything
            	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					        //display error message
					        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
					        	return false;
							}
					  });

						//called when key is pressed in textbox
					  $("#price").keypress(function (e) {
					     //if the letter is not digit then display error and don't type anything
            	if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
					        //display error message
					        //$("#errmsg").html("Digits Only").show().fadeOut("slow");
					        	return false;
							}
					  });

						$('#datePicker')
							.datepicker({
									autoclose: true,
									format: 'dd/mm/yyyy',
									startDate: new Date(),
									endDate: maxDate()
						});

						$('#newTransferForm').on('submit', function (e) {
		          e.preventDefault();
		          $.ajax({
		            type: 'post',
		            url: 'newtransfer.php',
		            data: $('form').serialize(),
		            success: function () {
		              //alert('form was submitted');
									$('#transfersTable').bootstrapTable('refresh');
									div_hide();
		            }
		          });
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
