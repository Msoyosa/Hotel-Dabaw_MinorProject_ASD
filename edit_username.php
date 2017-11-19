<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
   <div id="page">
        <h2>Manage Rooms</h2>       
    </div>

<?php if(empty($_SESSION["username"]) && empty($_SESSION["username"])){
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
 <?php print_navigation(); ?>
 <?php  

$username = "";
$message = "";

if(isset($_SESSION["id"])){
      $adminID = $_SESSION["id"];

     $sql = "SELECT * FROM admins where id = '$adminID'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                
                            
                           $old_username= $row['username'];
                            $admin_id = $row['id'];
                        }
                    }
  }
}
if (isset($_POST["reset"])) {

$username = "";

}
if (isset($_POST["submit"])) {
    if (empty(trim($_POST["username"]))) {
       $message = "No changes has been made to admin number" .$admin_id." for user ".$old_username.".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
    }
    if (trim($_POST["username"]) == $old_username) {
         $message = "No changes has been made to admin number" .$admin_id." for user ".$old_username.".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";

    }
    if (!empty(trim($_POST["username"]))) {
        $username = trim($_POST["username"]);
        $sql = "UPDATE admins SET username = '$username' WHERE id = '$adminID'";
                            $result = mysqli_query($link, $sql);
                        $checking = admin_confirm_query($result);
                        if($checking ==1){
                            $message = "Successfully updated admin ".$_SESSION["username"]. " for user ". $username .".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
                            $_SESSION["username"]= $username;
    }

  
}
echo $message;

}

else{




 ?>

<div>
    <table  cellpadding="10" cellspacing="" >
        <tr>
            <td>Admin ID:</td> 
            <td><?php echo $admin_id;?></td>
            <td></td>
        </tr>
        <tr>
            <td>Old Username:</td> 
            <td><?php echo $old_username;?></td>
            <td></td>
        </tr>
    </table>
 <form action = 'edit_username.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>' method='post'>

    <div>
    <label>New Username:</label>
    <input type="text" name="username" value="<?php echo $username; ?>">
    </div>

    
    <input type = "submit" name="submit" value="Update Profile"/>
    <input type="submit" name = "reset" value = "Reset"/>   
    <a href="edit_profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">Cancel</a>  
</form>
</div>


<?php
}
}

//Dontats------------------------------------------------------------------------------------------------------------------------------

            
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 