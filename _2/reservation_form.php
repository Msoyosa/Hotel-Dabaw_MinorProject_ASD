<!DOCTYPE>
<?php  
require_once'index.php';

?>
<html>
<head>
	<title>
		Reservation Form
	</title>
</head>
<body>
	<div>
		<div>
			<?php echo "Reservation Details (Required)" 
			?>
		</div>
		<div>
	    <form method="post">

 				<div class="form-group <?php echo (!empty($client_name_err)) ? 'has-error' : ''; ?>">
                            <label>Name</label>
                            <input type="text" name="client_name" class="form-control" value="<?php echo $client_name; ?>">
                        </div>
                        <div class="form-group <?php echo (!empty($client_address_err)) ? 'has-error' : ''; ?>">
                            <label>Address</label>
                             <input type="text" name="client_address" class="form-control" value="<?php echo $client_address; ?>">
                        </div>
                        <div class="form-group <?php echo (!empty($client_contact_number_err)) ? 'has-error' : ''; ?>">
                            <label>Contact Number</label>
                            <input type="text" name="client_contact_number" class="form-control" value="<?php echo $client_contact_number; ?>">
                        </div>
                        <div class="form-group <?php echo (!empty($client_email_err)) ? 'has-error' : ''; ?>">
                            <label>E-mail</label>
                            <input type="text" name="client_email" class="form-control" value="<?php echo $client_email; ?>">
                        </div>

                        <div class="form-group <?php echo (!empty($payment_mode_err)) ? 'has-error' : ''; ?>">
                            <label>Payment_mode</label>
                            <input type="text" name="payment_mode" class="form-control" value="<?php echo $payment_mode; ?>">
                        </div>

                        <div>
                        	<label>Check in:</label> 
							<input type="date" name="check_in_date"/ class="form-control" value="<?php echo $check_in_date; ?>"> <br />
                        </div>
                        <div>
                        	<label>Check out:</label> 
							<input type="date" name="check_out_date"/ class="form-control" value="<?php echo $check_out_date; ?>"><br />
                        </div>
			
			
			<input type="submit" value="Check and Select Available Rooms" /> 
			<a href="index.php" class="btn btn-default">Cancel</a>


		</form>
			<form method="post">


			</form>
		</div>
	</div>
</body>
</html>