<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<style type="text/css">
    
    #body { width: 100%; margin: 0 auto;} 
#col1{
    float: left; margin: 0; width: 75%;
}
#col2{
    float: left; margin: 0; width: 25%;

}
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
            <div dir="body"> 
            
 <?php print_navigation(); ?>
                <center>
<div div="log" style="margin-left:200px;font-size: 15px;">
 <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
  
    </div>
                    </center>
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

<div class="card" style="width: 500px; margin-left:440px; margin-bottom:90px;">
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

    
    <input class="btn btn-primary"type = "submit" name="submit" value="Update Profile"/>
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