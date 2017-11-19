<?php
session_start();
?>
<?php  include("../includes/layouts/header.php"); 

 ?>
<?php  
include('config.php');
?>
<?php require_once("../includes/functions.php"); ?> 
<div id="page">
        <h2>Create Admin</h2>
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
     <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
 <?php print_navigation(); ?>
<?php 
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
$message = "";

global $link;
 
 
if(!isset($_POST['submit'])){
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";

}
if (isset($_POST["reset"])) {
$admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

$admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
$message = "";


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
    else{
        $admin_username = trim($_POST["admin_username"]);    
    }
    if(empty(trim($_POST['admin_id']))){
        $admin_id_err = "Please enter admin's id.";
    }
    else{
        $admin_id = trim($_POST['admin_id']);
    }
    if(empty(trim($_POST['admin_password']))){
        $admin_password_err = "Please enter admin's password.";
    }
     else{
        if(trim($admin_password) != trim($confirm_password)){
        $admin_password_err = "Passwords do not match";
        $admin_password = "";
        $confirm_password = "";
    }
    else{
        if(strlen(trim($_POST['admin_password'])) <6){
        $admin_password_err = "Password must be at least 6 characters";
        $admin_password = "";
        $confirm_password = "";
    }
    else{
        $admin_password = trim($_POST['admin_password']);

        $confirm_password = trim($_POST['confirm_password']);
    }
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

    
                                                                                                                                                           
   if(!empty($fname) && !empty($lname) && !empty($mname) && !empty($admin_username) && !empty($admin_id) && !empty($admin_password) & !empty($confirm_password)) {
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
        if($id==null){
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

                        $sql = "INSERT INTO admins (id,username,password,fname,lname,mname) values ('$admin_id', '$admin_username', '$admin_password', '$fname', '$lname','$mname')";
                        $result = mysqli_query($link, $sql);
                        $checking = admin_confirm_query($result);
                        if($checking ==1){
                            $message = "Successfully created admin ".$admin_username. " the account for ". $lname .", ". $fname;
                        $admin_id = $admin_username = $admin_password = $fname = $lname = $mname=$confirm_password= "";

                        $admin_id_err = $admin_username_err = $admin_password_err = $fname_err = $lname_err = $mname_err= $confirm_password_err="";
                        echo $message;


            }
            
        }
        else{
                $admin_username_err = "username already taken";

            }
         //   var_dump($username);
         //   echo "<hr/>";
   } 
   else{
            $admin_id_err = "ID already taken";
        }
   // var_dump($id);



       }
    
}

 ?>

 <form action = 'create_admin_full.php?sessionID=<?php echo urlencode($_SESSION['id']);?>' method='post'>
          

                        <div >
                            <label>First Name</label>
                            <input type="text" name="fname" class="form-control" value="<?php echo $fname; ?>">
                            <span class="help-block"><?php echo $fname_err; ?></span>

                        </div>
                        <div >
                            <label>Last Name</label>
                            <input type="text" name="lname" class="form-control" value="<?php echo $lname; ?>">
                            <span class="help-block"><?php echo $lname_err; ?></span>

                        </div>
                         <div >
                            <label>Middle Name</label>
                            <input type="text" name="mname" class="form-control" value="<?php echo $mname; ?>">
                            <span class="help-block"><?php echo $mname_err; ?></span>

                        </div>
                        <div>
                            <label>Username</label>
                             <input type='text' name="admin_username" value="<?php echo $admin_username; ?>">
                              <span class="help-block"><?php echo $admin_username_err; ?></span>
                        </div>
                        <div>
                            <label>Admin ID</label>
                            <input type='text' name="admin_id" value="<?php echo $admin_id; ?>">
                             <span class="help-block"><?php echo $admin_id_err
; ?></span>
                        </div>
                        <div>
                            <label>Password</label>
                            <input type='password' name="admin_password" value="<?php echo $admin_password; ?>">
                             <span class="help-block"><?php echo   $admin_password_err; ?></span>
                        </div>

                        <div>
                            <label>Confirm Password</label>
                            <input type='password' name="confirm_password" class='form-control' value="<?php echo $confirm_password; ?>">
                             <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>                 
                       

                        </div>
                   <input type='submit' name = 'submit' value='Create Admin' /> 
                    <input type="submit" name = "reset" value = "Reset"/>     
                   <a href="view_admins.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Cancel</a>
        </form>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 

