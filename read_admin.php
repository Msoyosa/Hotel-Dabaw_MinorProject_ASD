<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<link rel="stylesheet" href="css/uikit.min.css">
<script src = "js/uikit.min.js"></script>
<div id="page">
        <h2>View Admin</h2>
    </div

<?php if(empty($_SESSION["username"]) && empty($_SESSION["username"]) && empty($_SESSION["id"])){
		?>
		<h1>You are not Logged in</h1>
		<h3> Already have an account?<a href="log-in.php">Log-in Here</a> or</h3>
		<h3><a href="register.php">Create an account</a> </h3>
		<?php
		}
		else {
//Dontats------------------------------------------------------------------------------------------------------------------------------
			?>
	<p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
	<p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>

<?php 
 print_navigation();
$fname   =  $lname   =$mname   =$username= $admin_id ="";
if(isset($_GET["adminID"])){
    $adminID = $_GET["adminID"];
     $sql = "SELECT * FROM admins where ID = '$adminID'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                
                            $fname   = $row['fname'];    
                            $lname   = $row['lname'];
                            $mname   = $row['mname'];
                            $username= $row['username'];
                            $admin_id = $row['id'];
                        }
                    }
  }
 ?>
<div>
    <table  cellpadding="10" cellspacing="" border="2" align="center">
        <tr>
            <td>Name:</td> 
            <td><?php echo $fname. " ". $mname . " - ".  $lname?></td>
        </tr>
        <tr>
            <td>Username:</td> 
            <td><?php echo $username;?></td>
        </tr>
        <tr>
            <td>Admin ID:</td> 
            <td><?php echo $admin_id;?></td>
        </tr>
    </table>
   
</div>
<div>
                 <a href="update_admin.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/update.ico"></a>
<?php if ($admin_id != 1) {
                        ?>
                <a href="delete_admin.php?adminID=<?php echo urlencode($adminID);?>" ><img src="Images/Buttons/delete.ico"></a>
 
                        <?php
        
    } ?></div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
    }
			?>
<?php  include("../includes/layouts/footer.php"); ?> 