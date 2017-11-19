<!DOCTYPE>
<?php
session_start();
?>
<?php  include("../includes/layouts/header.php"); 
include('config.php');
?>
<?php require_once("../includes/functions.php"); ?> 
<div id="page">
        <h2>Update Reservation</h2>
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
   <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[Log out]</a> </p>
   
 <?php
 print_navigation();
  $message = "";
 global $link;

$adminID = $_GET["adminID"];
$admin_username =$fname = $lname = $mname=$confirm_password=  $admin_password = "";
 $admin_username_err = $fname_err = $lname_err = $mname_err= $confirm_password_err= $admin_password_err ="";
$message = "";
$old_admin_username = "";
                  $old_fname = "";
                  $old_lname = "";
                  $old_mname = "";

global $link;

   $sql = "SELECT * from admins WHERE id = '$adminID'";

     if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){     
         while($row = mysqli_fetch_assoc($result)){ 
$admin_username =$row["username"];
$fname = $row["fname"];
$lname = $row["lname"];
$mname=$row["mname"];

$old_admin_username = $row["username"];
                  $old_fname = $row["fname"];
                  $old_lname = $row["lname"];
                  $old_mname = $row["mname"];

 // var_dump($row);
  //echo "<hr />";
  //    $sql = "SELECT * from rooms WHERE room_number = $selected_room_number";


        }
    }
}
if(!isset($_POST['submit'])){
 $sql = "SELECT * from admins WHERE id = '$adminID'";

     if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){     
         while($row = mysqli_fetch_assoc($result)){ 
$admin_username =$row["username"];
$fname = $row["fname"];
$lname = $row["lname"];
$mname=$row["mname"];

$old_admin_username = $row["username"];
                  $old_fname = $row["fname"];
                  $old_lname = $row["lname"];
                  $old_mname = $row["mname"];

 // var_dump($row);
  //echo "<hr />";
  //    $sql = "SELECT * from rooms WHERE room_number = $selected_room_number";


        }
    }
}
}
elseif(isset($_POST['submit'])){

  $new_password = $_POST["admin_password"];
  $admin_username= $_POST["admin_username"];
  $sql = "SELECT * FROM admins WHERE username= '$admin_username' && id != '$adminID'";
   if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                    
                            $admin_username_err = "Username already taken";
                        }
           }

    if(empty(trim($_POST["admin_username"]))){
        $admin_username_err = "Please enter admin's username.";
    } 
    else{
        $admin_username = trim($_POST["admin_username"]);    
    }
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
     if(empty(trim($_POST["admin_password"])) && !empty(trim($_POST["confirm_password"]))){
        $admin_password_err = "Want to change the password? Please populate the password and messageation password textboxes";
    } 
    if(!empty(trim($_POST["admin_password"])) && empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Want to change the password? Please populate the password and messageation password textboxes";
    } 
    if(!empty(trim($_POST["admin_password"])) && !empty(trim($_POST["confirm_password"]))){
      if (trim($_POST["admin_password"]) != trim($_POST["confirm_password"])) {
        $admin_password_err = "Passwords are not matched";
      }
      elseif (trim($_POST["admin_password"]) == trim($_POST["confirm_password"])) {
          if((strlen(trim($_POST["admin_password"]))) < 6 ){ 
         $admin_password_err = "Passwords must be at least 6 characters long";
        }

        if(empty($fname_err)&& empty($lname_err)&& empty($mname_err)&& empty($admin_username_err)&& empty($admin_password_err)&&empty($confirm_password_err)){
          $admin_password= trim($_POST["admin_password"]);
         echo $admin_password;
                  $admin_username = trim($_POST["admin_username"]);    

                  $fname = trim($_POST["fname"]);    

                  $lname = trim($_POST["lname"]);    

                  $mname = trim($_POST["mname"]);    

                  $admin_password = md5(trim($_POST["admin_password"]));
                $sql= "UPDATE admins set fname = '$fname',lname = '$lname',mname = '$mname',username = '$admin_username',password = '$admin_password' WHERE id = '$adminID'";
                  $result = mysqli_query($link, $sql);
                  $message = "Successfully updated admin number".$adminID."(". $admin_username.")".", the account for ". $lname .", ". $fname;
                $admin_username_err = $fname_err = $lname_err = $mname_err= $confirm_password_err= $admin_password_err ="";
        }

      }
    }
    if(empty($fname)&& empty($lname)&& empty($mname)&& empty($admin_username)&& empty($admin_password)&&empty($confirm_password)){
          $admin_username= $fname= $lname= $mname= $confirm_password= $admin_password ="";

          $message = " No changes has been made to admin number ".$adminID. ".";
        } 
    elseif (empty(trim($_POST["admin_password"])) && empty(trim($_POST["confirm_password"]))) {
     if(empty($fname_err)&& empty($lname_err)&& empty($mname_err)&& empty($admin_username_err)&& empty($admin_password_err)&&empty($confirm_password_err)){

        if($old_admin_username ==$_POST["admin_username"] && $old_fname  == $_POST["fname"] && $old_lname == $_POST["lname"] &&
          $old_mname == $_POST["mname"]){
                        //  $admin_username= $fname= $lname= $mname= $confirm_password= $admin_password ="";
                           
                           $message = " No changes has been made to admin number ".$adminID. ".";

         } 
         else{
                            $admin_username = trim($_POST["admin_username"]);    

                  $fname = trim($_POST["fname"]);    

                  $lname = trim($_POST["lname"]);    

                  $mname = trim($_POST["mname"]);                
                $sql= "UPDATE admins set fname = '$fname',lname = '$lname',mname = '$mname',username = '$admin_username' WHERE id = '$adminID'";
                  $result = mysqli_query($link, $sql);
                  $message = "Successfully updated admin number".$adminID."(". $admin_username.")".", the account for ". $lname .", ". $fname;
                $admin_username_err = $fname_err = $lname_err = $mname_err= $confirm_password_err= $admin_password_err ="";
         }

        }

    }

   
}

 if (empty($message)) {
    ?>
    <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[Log out]</a> </p>

    <form action = 'update_admin.php?adminID=<?php echo urlencode("$adminID"); ?>' method='post'>
                        <div>
                            <label>Admin ID :<?php echo $adminID; ?> </label>
                            
                        </div>

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
                            <label>New Password (LEAVE BLANK if not to be changed)<br /></label>
                            <input type='password' name="admin_password" value="<?php echo $admin_password; ?>">
                             <span class="help-block"><?php echo   $admin_password_err; ?></span>
                        </div>

                        <div>
                            <label>Confirm Password(LEAVE BLANK along with New password field if not to be changed)<br /></label>
                            <input type='password' name="confirm_password" class='form-control' value="<?php echo $confirm_password; ?>">
                             <span class="help-block"><?php echo $confirm_password_err; ?></span>
                        </div>                 
                       

                        </div>
                   <input type='submit' name = 'submit' value='Create Admin' /> 
                  <a href="view_admins.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>" class="btn btn-default">Cancel</a>

        </form>
    <?php
  }
  else{
    ?>
    <h3> <?php echo $message; ?>. Go back to <a href="view_admins.php?session_ID=<?php echo urlencode($_SESSION['id']) ?>"> Managing Admins</a></h3>
    <table  cellpadding="10" cellspacing="" border="2" align="center">

        <th>Information</th>
        <th>First Name:</th> 
        <th>Last Name:</th> 
        <th>Middle Name:</th> 
        <th>User Name:</th> 
        <th>Pasword: </th> 

        <tr>
            <td>Old</td>
            <td><?php echo $old_fname?></td>
            <td><?php echo $old_lname;?></td>
            <td><?php echo $old_mname;?></td>
            <td><?php echo $old_admin_username;?></td>
            <td><?php echo " ";?></td>
        </tr>
        <tr>
            <td>Updated</td>
            <td><?php echo $fname?></td>
            <td><?php echo $lname;?></td>
            <td><?php echo $mname;?></td>
            <td><?php echo $admin_username;?></td>
            <td><?php echo $new_password;?></td>
          
        </tr>
    </table>
   

    <?php
  }

     ?>

<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 