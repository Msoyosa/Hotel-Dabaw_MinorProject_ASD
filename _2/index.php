<!DOCTYPE>
<?php 
	include('config.php');
	 $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = "";
	 $client_name = "guest";

	if($_SERVER["REQUEST_METHOD"] == "POST")
{
    $client_name   = $_POST["client_name"];
    $client_address  = $_POST["client_address"];
    $client_contact_number = $_POST["client_contact_number"];
    $client_email   = $_POST["client_email"];
    $payment_mode      = $_POST["payment_mode"];
    $check_in_date    = $_POST["check_in_date"];
    $check_out_date      = $_POST["check_out_date"];
  // $number     = $_POST['number'];
if ($client_name == "guest") {
header("location: room_selection.php");

}
else {

$sql = "INSERT INTO client_info (client_name, client_address, contact_number, email_address, check_in_date, check_out_date, payment_mode ) VALUES ('$client_name' , '$client_address' , '$client_contact_number', '$client_email' , '$check_in_date' , '$check_out_date',  '$payment_mode')";
 mysqli_query($link, $sql);
 header("location: room_selection.php");
	}
	   exit();
}



	
	 ?>

<html>
	<head>
		<title> Hotel Dabaw</title>
			<link rel="stylesheet" href="css/uikit.min.css">
	</head>
	<script src = "js/uikit.min.js"></script>
	<body>
	<div id="header" align="center">
		<?php
		echo "<h1>Hotel Dabaw</h1>";
		echo "<h2>Maayong Adlaw!</h2>";
		 ?>
	</div>
	<div id="slideshow_images" align="center">
	
		<div>
	     	<img class="mySlides" width="1000" height="500" src="Images/slideshow_images/1.jpg">
	   	</div>
   		<div>
     		<img class="mySlides" width="1000" height="500" src="Images/slideshow_images/2.jpg">
   		</div>
   		<div>
	     	<img class="mySlides" width="1000" height="500" src="Images/slideshow_images/3.jpg">
	   	</div>
   		<div>
     		<img class="mySlides" width="1000" height="500" src="Images/slideshow_images/4.jpg">
   		</div>
   		<div>
     		<img class="mySlides" width="1000" height="500" src="Images/slideshow_images/5.jpg">
   		</div>

	</div>
	<script>
				var slideIndex = 0;
		carousel();

		function carousel() {
		    var i;
		    var x = document.getElementsByClassName("mySlides");
		    for (i = 0; i < x.length; i++) {
		      x[i].style.display = "none"; 
		    }
		    slideIndex++;
		    if (slideIndex > x.length) {slideIndex = 1} 
		    x[slideIndex-1].style.display = "block"; 
		    setTimeout(carousel, 2000); // Change image every 2 seconds
		}
</script>
	
	<div id="navigation">
	<ul>
		<li><a href="about.html"> About Hotel Dabaw </a></li>
		<li><a href="contact.php"> Contact Us </a></li>
	</ul>
	</div>

	<div id="initial_form">

<button uk-toggle="target: #my-id" type="button">Modal</button>

<!-- This is the modal -->
<div id="my-id" uk-modal>
    <div class="uk-modal-dialog uk-modal-body">
        <h2 class="uk-modal-title"></h2>
        <button class="uk-modal-close" type="button"></button>
    </div>
</div>
	    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">

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
	</div>

	<div id="footer">
		<ul>
			<li><a href="terms_of_service.php"> Terms of Service </a></li>
			<li><a href="privacy_policy.php"> Privacy Policy </a> </li>
		</ul>
	</div>
</body>

</html>