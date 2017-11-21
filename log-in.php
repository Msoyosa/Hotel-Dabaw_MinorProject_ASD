<?php  session_start(); 
?>
<?php  include("../includes/layouts/header.php"); 
include('config.php');

?>
<style type="text/css">
    .wrapper {
        vertical-align: center;
        width: 100%;
    }

</style>

<?php
if(!empty($_SESSION["username"]) && !empty($_SESSION["password"]) && !empty($_SESSION["id"])){
    echo "<h3> You are already logged in. <br /> Go to <a href = 'admin.php?sessionID=$_SESSION[id]'> Admin Homepage</a> </h3>";
}
// Processing form data when form is submitted
else{
    //Dontats------------------------------------------------------------------------------------------------------------------------------
    // Include config file
require_once 'config.php';
require_once("../includes/functions.php");

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";


    ?>
    <?php
if (!isset($_POST["submit"])) {
$username = $password = "";
$username_err = $password_err = "";

}
 if (isset($_POST["reset"])) {

$username = $password = "";
$username_err = $password_err = "";
}
if(isset($_POST["submit"])){
	$username_err = $password_err = "";
	
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = 'Please enter username.';
    } 
    else{
       $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    } else{
        $password = (trim($_POST["password"]));
    }
    if(empty(trim($_POST["username"])) && empty(trim($_POST['password']))){
        $username_err = 'Please enter username.';
        $password_err = 'Please enter your password.';

    }
     if(empty(trim($_POST["username"])) && !empty(trim($_POST['password']))){
        $username_err = 'Please enter username.';
    }
    elseif (!empty(trim($_POST["username"])) && !empty(trim($_POST['password']))) {
       $username = trim($_POST["username"]);
       $password = (trim($_POST["password"]));

        $sql = "SELECT * FROM admins WHERE username = '$username'" ;
  		$result = mysqli_query($link, $sql);
        confirm_query($result);      
    	$user = mysqli_fetch_assoc($result);  
    if($user==null){
            $username_err= "Username does not belong to any account";        
        }
        else{
        	$username = trim($_POST["username"]);
        		$username_err = $password_err = "";
        if(empty(trim($_POST['password']))){
        $password_err = 'Please enter your password.';
    	} else{
        $password = (trim($_POST["password"]));
    	}
        if(!empty(trim($_POST['password']))){
        $username_err = $password_err = "";

        $username = trim($_POST["username"]);
        $password = md5(trim($_POST["password"]));     
        $sql = "SELECT * FROM admins WHERE username = '$username' && password = '$password'" ;
  		$result = mysqli_query($link, $sql);
        confirm_query($result);      
    	$row = mysqli_fetch_assoc($result);    
        if($password !=$row["password"]){
        	$password_err= "Password incorrect";
        	$username_err = "";   	
        }
        else{
        	$password = md5(trim($_POST["password"]));  
        }
        if($username ==$row["username"] && $password =$row["password"]){
        	$_SESSION["username"] = $username;
            $_SESSION["password"] = $password;
        	$_SESSION["id"] = $row["id"];
            $_SESSION["fname"]= $row["fname"];
            $_SESSION["lname"]= $row["lname"];
        	header("Location: admin.php?sessionID=$_SESSION[id]");

        }
        }
        } 
     
    }

   /*
   <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="log-in.php" method="post">
            <div >
                <label>Username:<sup>*</sup></label>
                <input type="text" name="username"class="form-control" value="<?php echo $username; ?>">
        <span class="help-block"><?php echo $username_err; ?></span>
        </div>
        <div>
            <label>Password:<sup>*</sup></label>
            <input type="password" name="password" class="form-control" value="">
            <span class="help-block"><?php echo $password_err; ?></span>
        </div>
        <div>
            <input type="submit" name="submit" value="Log in">
            <input type="submit" name="reset" value="Reset" />
        </div>
        </form>
        */ } ?>
<center>
        <div class="wrapper">
            
            <div class="card" style="width: 20rem; margin-top:90px;">
                <div class="card-body">
                    <form action="log-in.php" method="post">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Username</label>
                            <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email" value="<?php echo $username; ?>"><span class="help-block"><?php echo $username_err; ?></span>
                            
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password<sup>*</sup></label>
                            <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Password" value=""><span class="help-block"><?php echo $password_err; ?></span>
                        </div>
                        <div class="form-check">
                           
                        </div>
                        <input class="btn btn=primary" type="submit" name="submit" value="Log in">
                        <input class="btn btn=primary" type="submit" name="reset" value="Reset" />
                    </form>
                </div>
            </div>



        </div>
    </center>
    
<center>   
    <p>Don't have an account yet? <a href="register.php">Create Account</a>.</p>
             <div id="index">
            <a href="../public/index.php" target="_blank">
                <p>Visit as a Customer</p>
            </a>
    </div>
                 </center>   
    
        <?php 
   
//Dontats------------------------------------------------------------------------------------------------------------------------------

     }
     