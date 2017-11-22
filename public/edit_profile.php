<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
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


}
</style>
   <div id="page">
        <h2>Edit Profile</h2>       
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
       <div dir="body"> 
            
   
 <?php print_navigation(); ?>
         <center>
            <div div="log" style="margin-left:40px;font-size: 15px;">
                <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
                <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>

            </div>
        </center>
        </div>
 </div>
 <?php  
if(isset($_SESSION["id"])){
      $adminID = $_SESSION["id"];


     $sql = "SELECT * FROM admins where id = '$adminID'";
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
            <td>Admin ID:</td> 
            <td><?php echo $admin_id;?></td>
            <td></td>
        </tr>
        <tr>
            <td>Name:</td> 
            <td><?php echo $fname. " ". $mname . " - ".  $lname?></td>
            <td><a href="edit_name.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/update.ico"></a><?php ?></td>

        </tr>
        <tr>
            <td>Username:</td> 
            <td><?php echo $username;?></td>
            <td><a href="edit_username.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/update.ico"></a><?php ?></td>
        </tr>
        <tr>
            <td>Password:</td> 
            <td><?php echo "*encrypted";?></td>
            <td><a href="edit_password.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/update.ico"></a><?php ?></td>

        </tr>
    </table>
   
</div>


<?php
}
//Dontats------------------------------------------------------------------------------------------------------------------------------

            }
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 