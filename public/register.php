<?php  session_start(); 
?>
<?php  include("../includes/layouts/header.php"); 
include('config.php');

?>
<?php require_once("../includes/functions.php"); ?>


<?php
if(!empty($_SESSION["username"]) && !empty($_SESSION["password"]) && !empty($_SESSION["id"])){
    echo "<h3> You are already logged in. <br /> Go to <a href = 'admin.php?sessionID=$_SESSION[id]'> Admin Homepage</a> </h3>";
}
// Processing form data when form is submitted
else{
//Dontats------------------------------------------------------------------------------------------------------------------------------
            ?>

    <?php //print_navigation(); ?>
    <?php 
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
$message = "";

global $link;
 
 if (isset($_POST["reset"])) {
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
 }
if(!isset($_POST['submit'])){
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";

}
if(isset($_POST['submit'])){
     if(empty(trim($_POST["fname"]))){

        $fname_err = "Please enter admin's first name.";
    } 
    else{
        $fname = trim($_POST["fname"]);    
    }
    if(empty(trim($_POST["lname"]))){
        $lname_err = "Please enter admin's last name.";
    } 
    else{
        $lname = trim($_POST["lname"]);    
    }
    if(empty(trim($_POST["mname"]))){
        $mname_err = "Please enter admin's middle name.";
    } 
    else{
        $mname = trim($_POST["mname"]);    
    }
   if(empty(trim($_POST["admin_username"]))){
        $admin_username_err = "Please enter admin's username.";
    } 
    if(strlen(trim($_POST["admin_username"])) < 8 ){
        $admin_username_err = "Username must be more than 8 characters long.";
    } 
    else{
        $admin_username = trim($_POST["admin_username"]);    
    }
    if(empty(trim($_POST['admin_id']))){
        $admin_id_err = "Please enter admin's id.";
    }
    else{
        $admin_id = trim($_POST['admin_id']);
    }
     if(strlen(trim($_POST['admin_password'])) <6){
        $admin_password_err = "Password must be at least 6 characters";
        $admin_password = "";
        $confirm_password = "";
    }
    if(empty(trim($_POST['admin_password']))){
        $admin_password_err = "Please enter admin's password.";
    }

    else{
        
    if (!preg_match("/[0-9]+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must contain a number";
        $admin_password = "";
        $confirm_password = "";
    }
    
    if (preg_match("/$fname+ /", trim($_POST["admin_password"])) || preg_match("/$fname+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must not contain your name";
        $admin_password = "";
        $confirm_password = "";
    }
    if (preg_match("/$lname+/", trim($_POST["admin_password"])) || preg_match("/$lname+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must not contain your name";
        $admin_password = "";
        $confirm_password = "";
    }
    if(trim($_POST["admin_password"]) != trim($_POST["confirm_password"])){
        $admin_password_err = "Passwords do not match";
        $admin_password = "";
        $confirm_password = "";
    }
  
    
    else{
        $admin_password = trim($_POST['admin_password']);

        $confirm_password = trim($_POST['confirm_password']);
    }
    }
   

    if(empty(trim($_POST['confirm_password']))){
        $confirm_password_err = "Please confirm admin's password.";
    }
    else{

        $confirm_password = trim($_POST['confirm_password']);
    }    

    if (trim($_POST['admin_password']) != trim($_POST['confirm_password'])) {
                $admin_password_err = "Passwords do not match";

    }



    
                                                                                                                                                           
   if(empty($fname_err) && empty($lname_err) && empty($mname_err) && empty($admin_username_err) && empty($admin_id_err) && empty($admin_password_err) & empty($confirm_password_err)) {
        $fname = $_POST["fname"];    

        $lname = trim($_POST["lname"]);    

        $mname = trim($_POST["mname"]);    

        $admin_username = trim($_POST["admin_username"]);    

        $admin_id = trim($_POST['admin_id']);

        $admin_password = trim($_POST['admin_password']);


        $sql = "SELECT * FROM admins WHERE id= '$admin_id'" ;
        $result = mysqli_query($link, $sql);
        confirm_query($result);      
        $id = mysqli_fetch_assoc($result);  
        $default_username="emp";
        if($id["id"]==$admin_id){
            if( $id['username'] == $default_username){
                 $sql = "SELECT * FROM admins WHERE username= '$admin_username'" ;
            $result = mysqli_query($link, $sql);
            confirm_query($result);      
            $username = mysqli_fetch_assoc($result);
            if ($username==null) {
                $fname = trim($_POST["fname"]);    

                            $lname = trim($_POST["lname"]);    

                            $mname = trim($_POST["mname"]);    

                            $admin_username = trim($_POST["admin_username"]);    

                            $admin_id = trim($_POST['admin_id']);


                            $admin_password = md5(trim($_POST['admin_password'])); 

                        $sql = "UPDATE admins SET username = '$admin_username' ,password = '$admin_password' , fname = '$fname', lname = '$lname', mname = '$mname' WHERE id = '$admin_id'";
                        $result = mysqli_query($link, $sql);
                        $checking = admin_confirm_query($result);
                        if($checking ==1){
                        	                            $_SESSION["id"] = $id["id"];
                            $message = "Successfully created admin ".$admin_username. " the account for ". $lname .", ". $fname. ".<br/>Go to <a href = 'admin.php?sessionID=$_SESSION[id]'> Admin Homepage</a>";
                            $_SESSION["username"] = $admin_username;
                            $_SESSION["password"] = $admin_password;
                            $_SESSION["id"] = $id["id"];
                            $_SESSION["fname"]= $fname;
                            $_SESSION["lname"]= $lname;
                        $admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

                        $admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
                        echo $message;


            }
            
        }
        else{
                $admin_username_err = "username already taken";

            }
    
            }
            elseif($id['username'] != $default_username){
            $admin_id_err = "Oops! Somebody else has already made an account with this ID. Please contact your manager.";
        }
     

        
   } 
  


       }
    
}

 ?>
    <div class="card" style="width: 20rem; margin-left: 500px;">
        <div class="card-body">
          
<form action = 'register.php' method='post'>
                
                    <div>
                        <label>First Name</label>
                        <input name="fname" type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                        <span class="help-block"><?php echo $fname_err; ?></span>

                    </div>
                    <div>
                        <label>Last Name</label>
                        <input name="lname" type="text" class="form-control" value="<?php echo $lname; ?>">
                        <span class="help-block"><?php echo $lname_err; ?></span>

                    </div>
                    <div>
                        <label>Middle Name</label>
                        <input name="mname" type="text" class="form-control" value="<?php echo $mname; ?>">
                        <span class="help-block"><?php echo $mname_err; ?></span>

                    </div>
                    <div>
                        <label>Username</label><br>
                        <input name="admin_username" type='text' class='form-control'value="<?php echo $admin_username; ?>">
                        <span class="help-block"><?php echo $admin_username_err; ?></span>
                    </div>
                    <div>
                        <label>Admin ID</label><br>
                        <input name="admin_id" type='text'class='form-control' value="<?php echo $admin_id; ?>">
                        <span class="help-block"><?php echo $admin_id_err
; ?></span>
                    </div>
                    <div>
                        <label>Password</label><br>
                        <input name="admin_password" type='password' class='form-control'value="<?php echo $admin_password; ?>">
                        <span class="help-block"><?php echo   $admin_password_err; ?></span>
                    </div>

                    <div>
                        <label>Confirm Password</label><br>
                        <input name="confirm_password" type='password' class='form-control' value="<?php echo $confirm_password; ?>">
                        <span class="help-block"><?php echo $confirm_password_err; ?></span>
                    </div>
<br>
<input class="btn btn-primary" type='submit' name='submit' value='Create Admin' />
        <input class="btn btn-primary" type="submit" name="reset" value="Reset" />
        <a href="register.php">Cancel</a>
        
        </form>
    </div>
</div>
      <center>  
        <p style="margin-left: 140px;">Already have an account? <a href="log-in.php">Log-in now</a>.</p>
</center>
        <?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
            <?php  include("../includes/layouts/footer.php"); ?>
