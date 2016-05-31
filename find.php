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

        <div class="shadowbox" id="find">
          <h2>Cerca un passaggio</h2>
            <form class="form-horizontal" role="form">
              <input type="hidden" id="userID" value="<?php echo $user_home->userID; ?>">
              <div class="form-group">
                <label class="control-label col-sm-2" for="fromLocation">Partenza:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="fromLocation" placeholder="Inserisci partenza">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="toLocation">Destinazione:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" id="toLocation" placeholder="Inserisci destinazione">
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="toLocation">Data:</label>
                <div class="col-sm-10">
                    <div class="input-group input-append date" id="datePicker">
                        <input type="text" class="form-control" placeholder="Data" name="date" id="date"/>
                        <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
                    </div>
                </div>
              </div>
              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button id="findbutton" type="submit" class="btn btn-default">Cerca</button>
                </div>
              </div>
            </form>
          </div>
          <div class="shadowbox" id="requests">
            <h2>Risultato ricerca</h2>
            <table id="requestsTable" >
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
              <div style="clear:both;" />
            <p />
          </div>
      </div>
      <script>
				jQuery(document).ready(function($) {
          $('#datePicker')
            .datepicker({
                autoclose: true,
                format: 'dd/mm/yyyy',
                startDate: new Date(),
                endDate: maxDate()
          });

          $('#findbutton').click(function(){
            var data = {};
            data.id = $("#userID").val();
            data.fromLocation = $("#fromLocation").val();
            data.toLocation = $("#toLocation").val();
            data.date = $("#date").val();

            $.ajax({
                type: 'GET',
                url: 'json/findrequests.php',
                data: data,
                success: function(response) {
                  //alert(response);
                  $('#requestsTable').bootstrapTable({
                    data: response
                  });
                }
            });
            return false;
          });
				});

        function maxDate(){
					var max = new Date();
					max.setDate ((max.getDate() + 30));
					return max;
				}

				//Function To Display
				function div_show() {
					document.getElementById('xxx').style.display = "block";
				}
				//Function to Hide
				function div_hide(){
					document.getElementById('xxx').style.display = "none";
				}
			</script>
    </body>
</html>
