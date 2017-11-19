<!DOCTYPE>
<?php
session_start();
?>
<?php 
?>
<?php  include("../includes/config.php"); ?>

<?php  include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<div id="page">
		<h2>About Hotel Dabaw</h2>
	</div

	<?php if(empty($_SESSION["username"]) && empty($_SESSION["password"]) && empty($_SESSION["id"])){

		?>
		<h1>You are not Logged in</h1>
		<h3> Already have an account?<a href="log-in.php">Log-in Here</a> or</h3>
		<h3><a href="register.php">Create an account</a> </h3>
		<?php
		}
		else {
//Dontats------------------------------------------------------------------------------------------------------------------------------
			?>

	<p> Welcome to admin area, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
	<p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
<?php print_navigation(); ?>

<p id="paragraph1">
	Hotel Dabaw offers 18 guestrooms for discerning for travellers searching for the best and affordable hotels in Davao City, Southerns Mindanao Island's hud for commerce, tourisn, and industry. Located at Magallanes Street, the hotel is in the downtown area.
</p>
<p id="paragraph2">
	Hotel Dabaw's interriors are sleek, clean and elegant. Design accents feature simplicity and detail at the same time.
</p>
<p id="paragraph3">
	Hotel Dabaw is an easy 20 minute-drive to and from Davao International Airport.
</p>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
<?php  include("../includes/layouts/footer.php"); ?> 