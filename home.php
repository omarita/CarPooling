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
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">
        <!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
        <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

    </head>

    <body>
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

        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
				<script src="bootstrap/js/bootstrap.min.js"></script>
				<script src="bootstrap/js/bootstrap-table.min.js"></script>
        <script src="assets/scripts.js"></script>

				<div class="container">
					<div class="shadowbox">
					  <h2>Passaggi offerti</h2>
					  <p>Lista dei passaggi offerti</p>
						<table data-toggle="table" data-url="json/transfers.php" >
								<thead>
										<tr>
												<th data-field="fromLocation">Da</th>
												<th data-field="toLocation">A</th>
												<th data-field="availableSeats">Posti disponibili</th>
												<th data-field="price">Costo</th>
										</tr>
								</thead>
						</table>
						<p/>
					  <table class="table table-hover">
					    <thead>
					      <tr>
					        <th>Firstname</th>
					        <th>Lastname</th>
					        <th>Email</th>
					      </tr>
					    </thead>
					    <tbody>
					      <tr class='clickable-row' data-href='http://www.google.it'>
					        <td>John</td>
					        <td>Doe</td>
					        <td>john@example.com</td>
					      </tr>
					      <tr>
					        <td>Mary</td>
					        <td>Moe</td>
					        <td>mary@example.com</td>
					      </tr>
					      <tr>
					        <td>July</td>
					        <td>Dooley</td>
					        <td>july@example.com</td>
					      </tr>
					    </tbody>
					  </table>
					</div>
				</div>
				<script>
				jQuery(document).ready(function($) {
				    $(".clickable-row").click(function() {
				        window.document.location = $(this).data("href");
				    });
				});
				</script>
    </body>

</html>
