<!DOCTYPE>
<?php
session_start();
?>
<?php  include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/config.php"); ?>
<style type="text/css">
	 #body { width: 100%; margin: 0 auto;} 
#col1, #col2{
	float: right; margin: 0; width: 100%;
}ul {
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

	<div id="page">
		<h2><b><?php echo $_SESSION["username"] ?>'s Profile</b></h2>		
	</div>
			<?php  
	$sql = "SELECT * FROM admins where username = 'username'";
			global $link;
            if($result = mysqli_query($link, $sql)){
             if(mysqli_num_rows($result) > 0){
              while($row = mysqli_fetch_assoc($result)){
                  $id= $row["id"];
                  $username = $row["username"];
                  $password = $row["password"];
              		}
          		}
      		} 
             ?>
             <div id="body">
             <div id="col2"> 	      
</div>
             <div id="col1"> 



<?php print_navigation(); ?>
                 <center>
                 <h3> Hello, user <b><?php echo $_SESSION["lname"]. ", ".$_SESSION["fname"] ?></b> <?php echo  "(".$_SESSION["username"]. ") "; ?> </h3><br />
 <h3>Your id is <b><?php echo $_SESSION["id"] ?></b></h3>
<div float = "right"> 
	<a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a>
	<a href="edit_profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[Edit your profile] <hr /> <hr /> </a> </div>
	<hr/>
                     </center>
</div>

</div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
