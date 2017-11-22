<!DOCTYPE>

<?php
session_start();
?>
<?php  include("../includes/layouts/header.php"); 
include('config.php');
?>
<style type="text/css">
ul {
        list-style-type: none;
        width: 111%;
        padding: ;
        overflow: hidden;
        background-color: #333;
    }

    li {
        float: left;
    }

    li a {
        display: block;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    li a:hover {
        background-color: #111;
    }
</style>

<?php require_once("../includes/functions.php"); ?> 
<div id="page">
		<h2>Admin Delete</h2>
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
 <?php $confirm = "";
 global $link;
 if (isset($_GET["adminID"])) {
 	$adminID = $_GET["adminID"];

}
 if (isset($_POST["submit"])) {
 	
 		$adminID = $_GET["adminID"];
 		$sql = "DELETE from admins where id = '$adminID'";
 		$result = mysqli_query($link, $sql);
 		confirm_query($result);
 		$confirm = "You successfully deleted admin number ";

 	

 }
 if (empty($confirm)) {
  	?>
   
  <?php   print_navigation(); ?>
<center>
 <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[Log out]</a> </p>
    </center>

<center>
 	<h3>You sure want to delete this </h3>

	<form action = "delete_admin.php?adminID=<?php echo urlencode($adminID);?>" method="post">
		<div>
			<input type="submit" name = "submit" value="Yes, delete this" />
		</div>
	</form>
		<a href="view_admins.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"><button>Cancel</button></a>   </center>

  	<?php
  }
  else{

  	?>
  	<h3> <?php echo $confirm." ".$_GET["adminID"]; ?>. Go back to <a href="view_admins.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Managing Admins</a></h3>
  	<?php
  }

	 ?>

<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
<?php  include("../includes/layouts/footer.php"); ?> 