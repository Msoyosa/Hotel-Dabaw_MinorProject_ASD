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

$old_password = $new_password =  "";
$old_password_err = $new_password_err ="";

$message = "";

if(isset($_SESSION["id"])){
      $adminID = $_SESSION["id"];

     $sql = "SELECT * FROM admins where id = '$adminID'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){                              
                            $right_old_password = $row["password"];
                        }
                    }
  }
}
if (isset($_POST["reset"])) {

$old_password = $new_password = $confirm_password= "";
$old_password_err = $new_password_err = $confirm_password_err ="";

$message = "";


}
if (isset($_POST["submit"])) {
    if (empty(trim($_POST["old_password"])) && !empty(trim($_POST["new_password"]))) {
       $old_password_err = "Please enter old password";
    }
    else{
       $old_password = trim($_POST["old_password"]);
    }
    if (empty(trim($_POST["new_password"])) && !empty(trim($_POST["old_password"]))) {
       $new_password_err = "Please enter new password";
    }
    else{
       $new_password = trim($_POST["new_password"]);
    }
    if (empty(trim($_POST["old_password"])) && empty(trim($_POST["new_password"]))) {
        $message = "No changes made to ".$_SESSION["username"]. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
    }
    elseif (empty($new_password_err) && empty($old_password_err)) {
        if(strlen(trim($_POST["new_password"])) < 6) {
         $new_password_err = "Password must be at least 6 characters";
        }
        elseif (strlen(trim($_POST["new_password"])) >=6 ) {
            if (md5(trim($_POST["new_password"]))==$right_old_password) {
        $message = "No changes made to ".$_SESSION["username"]. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
            }
            else{
                if (md5(trim($_POST["old_password"])) != $right_old_password) {
                    $old_password_err = "Old Password Incorrect";
                }
                else{
                $new_password = md5(trim($_POST["new_password"]));
                 $sql = "UPDATE admins SET password = '$new_password' WHERE id = '$adminID'";
                            $result = mysqli_query($link, $sql);
                        $checking = admin_confirm_query($result);
                        if($checking ==1){
                            $message = "Successfully updated admin ".$_SESSION["username"]. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
                            $_SESSION["password"]= $new_password;
                    }
             }

            }

    }
}
echo $message;

}






 ?>

<div>
    <table  cellpadding="10" cellspacing="" >
        <tr>
            <td>Admin ID:</td> 
            <td><?php echo $adminID;?></td>
            <td></td>
        </tr>
    </table>
 <form action = 'edit_password.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>' method='post'>
    <div>
    <label>Old Password:</label>
    <input type="password" name="old_password" value="">
    <span class="help-block"><?php echo $old_password_err; ?></span>

    </div>
    <div>
    <label>New Password:</label>
    <input type="password" name="new_password" value="">
    <span class="help-block"><?php echo $new_password_err; ?></span>

    </div>
    <div>
  
    <input type = "submit" name="submit" value="Update Profile"/>
    <input type="submit" name = "reset" value = "Reset"/>   
    <a href="edit_profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">Cancel</a>  
</form>
</div>


<?php
}


//Dontats------------------------------------------------------------------------------------------------------------------------------

            
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 