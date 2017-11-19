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

$fname   =$lname  =$mname =  $adminID = "";
$fname_err   =$lname_err  =$mname_err =  "";
$message = "";

if(isset($_SESSION["id"])){
      $adminID = $_SESSION["id"];

     $sql = "SELECT * FROM admins where id = '$adminID'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                
                            $fname   = $row['fname'];    
                            $lname   = $row['lname'];
                            $mname   = $row['mname'];    
                         //  $mname   = $row['mname'];
                          //  $username= $row['username'];
                            $admin_id = $row['id'];
                        }
                    }
  }
}
if (isset($_POST["reset"])) {

$fname   =$lname  =$mname =  $adminID = "";
$fname_err   =$lname_err  =$mname_err =  "";

$message = "";


}
if (isset($_POST["submit"])) {
    if (empty(trim($_POST["fname"])) && empty(trim($_POST["lname"])) && empty(trim($_POST["mname"]))) {

$fname   =$lname  =$mname =  $adminID = "";
$fname_err   =$lname_err  =$mname_err =  "";
     $message = "No changes made to admin ".$_SESSION["username"]. " the account for ". $lname .", ". $fname. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";

    }

    if (empty(trim($_POST["fname"]))) {
       $fname_err = "Please Enter First Name";
    }
    else{
        $fname = trim($_POST["fname"]);
    }
    if (empty(trim($_POST["lname"]))) {
       $lname_err = "Please Enter Last Name";
    }
    else{
        $lname = trim($_POST["lname"]);
    }
    if (empty(trim($_POST["mname"]))) {
       $mname_err = "Please Enter Middle Name";
    }
    else{
        $mname = trim($_POST["mname"]);
    }

    if(empty($fname_err) && empty($lname_err) && empty($mname_err)) {



                         $fname   = $_POST['fname'];    
                            $lname   = $_POST['lname'];
                            $mname   = $_POST['mname'];    
                            $sql = "UPDATE admins SET fname = '$fname', lname = '$lname', mname = '$mname' WHERE id = '$adminID'";
                            $result = mysqli_query($link, $sql);
                        $checking = admin_confirm_query($result);
                        if($checking ==1){
                            $message = "Successfully updated admin ".$_SESSION["username"]. " the account for ". $lname .", ". $fname. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>";
                            $_SESSION["fname"]= $fname;
                            $_SESSION["lname"]= $lname;

$fname   =$lname  =$mname =  $adminID = "";
$fname_err   =$lname_err  =$mname_err =  "";
    }
                        

}
echo $message;
}
else{




 ?>

<div>
    <table  cellpadding="10" cellspacing="" >
            <td>Admin ID:</td> 
            <td><?php echo $admin_id;?></td>
            <td></td>
        </tr>
    </table>
 <form action = 'edit_name.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>' method='post'>

    <div>
    <label> First Name:</label>
    <input type="text" name="fname" value="<?php echo $fname; ?>">
    <span class="help-block"><?php echo $fname_err; ?></span>
    </div>
        <div>
    <label> Last Name:</label>
    <input type="text" name="lname"  value="<?php echo $lname; ?>">
    <span class="help-block"><?php echo $lname_err; ?></span>
    </div>
        <div>
    <label> Middle Name:</label>
    <input type="text" name="mname"  value="<?php echo $mname; ?>" >
    <span class="help-block"><?php echo $mname_err; ?></span>
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