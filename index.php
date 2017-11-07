<!DOCTYPE>

<html>
	<head>
		<title> Hotel Dabaw</title>

	</head>
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
	    <form action="room_selection.php" method="post">
			<label>Check in:</label> 
			<input type="date" name="check_in"/ value="yyyy-mm-dd"> <br />
			<label>Check out:</label> 
			<input type="date" name="check_out"/ value="yyyy-mm-dd"><br />
			<input type="submit" value="Check and Select Available Rooms" /> 

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