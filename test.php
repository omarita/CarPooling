<!DOCTYPE html>
<html class="no-js">
    <head>
        <title>CarPooling</title>
        <!-- Bootstrap -->
				<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
				<link href="bootstrap/css/bootstrap-table.min.css" rel="stylesheet" media="screen">
        <link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" media="screen">
        <link href="assets/styles.css" rel="stylesheet" media="screen">

				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.min.css" />
				<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker3.min.css" />
    </head>
    <body>
        <!--/.fluid-container-->
        <script src="bootstrap/js/jquery-1.9.1.min.js"></script>
				<script src="bootstrap/js/bootstrap.min.js"></script>
				<script src="bootstrap/js/bootstrap-table.min.js"></script>
        <script src="assets/scripts.js"></script>

				<!-- Include Bootstrap Datepicker -->
				<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.min.js"></script>

				<div class="container">
					<div id="newTransfer" class="popupDiv1">
					<!-- Popup Div Starts Here -->
						<div id="popupContact" class="popupDiv2">
						<!-- Contact Us Form -->
							<form id="newTransferForm" action="#" class="popupForm clearfix" method="post" name="form">
								<img id="close" src="assets/3.png" onclick ="div_hide()">
								<h2>Inserisci passaggio</h2>
								<hr>
								<input id="name" name="name" placeholder="Name" type="text">
								<input id="email" name="email" placeholder="Email" type="text">

								<div class="form-group">
						        <label class="col-xs-3 control-label">Date</label>
						        <div class="col-xs-5 date">
						            <div class="input-group input-append date" id="datePicker">
						                <input type="text" class="form-control" name="date" />
						                <span class="input-group-addon add-on"><span class="glyphicon glyphicon-calendar"></span></span>
						            </div>
						        </div>
						    </div>

								<hr />
								<button class="btn btn-large btn-primary pull-right" style="margin-bottom:15px" onclick="div_show()" name="btn-insert">Ok</button>
							</form>
						</div>
					<!-- Popup Div Ends Here -->
					</div>
					<div class="shadowbox" id="transfers">
							<button class="btn btn-large btn-primary" style="float:right;margin-bottom:15px" onclick="div_show()" name="btn-login">Nuovo</button>
						<div style="clear:both;" />
						<p />
					</div>
				</div>

				<script>
					jQuery(document).ready(function($) {
					    $(".clickable-row").click(function() {
					        window.document.location = $(this).data("href");
					    });
							$('#datePicker')
				        .datepicker({
				            autoclose: true,
				            format: 'dd/mm/yyyy',
				            startDate: '10/10/2016',
            				endDate: '30/10/2016'
				        })
				        .on('changeDate', function(e) {
				            // Revalidate the date field
				            $('#newTransferForm').formValidation('revalidateField', 'date');
				        });
								$('#newTransferForm').formValidation({
					        framework: 'bootstrap',
					        icon: {
					            valid: 'glyphicon glyphicon-ok',
					            invalid: 'glyphicon glyphicon-remove',
					            validating: 'glyphicon glyphicon-refresh'
					        },
					        fields: {
					            date: {
					                validators: {
					                    notEmpty: {
					                        message: 'The date is required'
					                    },
					                    date: {
					                        format: 'dd/mm/yyyy',
					                        min: '10/01/2016',
					                        max: '30/12/2016',
					                        message: 'The date is not a valid'
					                    }
					                }
					            }
					        }
					    });
					});
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
