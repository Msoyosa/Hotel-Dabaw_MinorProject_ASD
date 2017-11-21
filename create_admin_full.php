<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<style type="text/css">
    
#body { width: 100%; margin: 0 auto;} 
#col1{
    float: left; margin: 0; width: 100%;
}
#col2{
    float: left; margin: 0; width: 100%;

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
 

<?php if(empty($_SESSION["username"]) && empty($_SESSION["username"])){
        ?>
        <h1>You are not Logged infloat
        <h3> Already have an account?<a href="log-in.php">Log-in Here</a> or</h3>
        <h3><a href="register.php">Create an account</a> </h3>
        <?php
        }
        else {
//Dontats------------------------------------------------------------------------------------------------------------------------------
            ?>
            
            <div id="body"> 
                <div id="col20"  >
                 <?php print_navigation(); ?>
                   </div>
    
 </div>
            <center>
             <div dir="body" style="margin-left:140px;font-size: 15px;"> 
            <div id="col1">
        <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
    
    </div>
                 </div>
                 </center>
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
    if(empty(trim($_POST['admin_password']))){
        $admin_password_err = "Please enter admin's password.";
    }
    if(strlen(trim($_POST['admin_password'])) <6){
        $admin_password_err = "Password must be at least 6 characters";
        $admin_password = "";
        $confirm_password = "";
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
        if (!preg_match("/[0-9]+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must contain a number";
        $admin_password = "";
        $confirm_password = "";
    }
    
    if (preg_match("/$fname+ /", trim($_POST["admin_password"])) || preg_match("/$fname+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must not contain admin's name";
        $admin_password = "";
        $confirm_password = "";
    }
    if (preg_match("/$lname+/", trim($_POST["admin_password"])) || preg_match("/$lname+/", trim($_POST["admin_password"]))) {
        $admin_password_err = "Password must not contain admin's name";
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

    <div class="card" style="width: 500px; margin-left:440px; margin-bottom: 90px; ">
        <div class="card-body"style="width:500px;">
            <form action = 'create_admin_full.php?sessionID=<?php echo urlencode($_SESSION['id']);?>' method='post'>
                <div class="form-group">
                    <label>First Name</label>
                    <input name="fname" type="text" class="form-control" id="exampleInputEmail1"   value="<?php echo $fname; ?>" style="">
                    <span class="help-block"><?php echo $fname_err; ?></span>
                </div>
                <div class="form-group">
                    <label >Last Name</label>
                    <input name="lname" type="text" class="form-control" id="exampleInputPassword1"  value="<?php echo $lname; ?>">
                    <span class="help-block"><?php echo $lname_err; ?></span>
                </div>
                 <div class="form-group">
                    <label >Middle Name</label>
                    <input name="mname" type="text" class="form-control" id="exampleInputPassword1"  value="<?php echo $mname; ?>">
                     <span class="help-block"><?php echo $mname_err; ?></span>
                </div>
                 <div class="form-group">
                    <label >Username</label>
                    <input name="admin_username" type="text" class="form-control" id="exampleInputPassword1"  value="<?php echo $admin_username; ?>">
                     <span class="help-block"><?php echo $admin_username_err; ?></span>
                </div>
                <div class="form-group">
                    <label >Admin ID</label>
                    <input name="admin_id" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $admin_id; ?>">
                     <span class="help-block"><?php echo $admin_id_err; ?></span>
                </div>
                 <div class="form-group">
                    <label >Password</label>
                    <input name="admin_password" type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $confirm_password; ?>">
                     <span class="help-block"><?php echo   $admin_password_err; ?></span>
                </div>
                 <div class="form-group">
                    <label >Confirm Password</label>
                    <input name="confirm_password" type="password" class="form-control" id="exampleInputPassword1" value="<?php echo $confirm_password; ?>">
                    <span class="help-block"><?php echo $confirm_password_err; ?></span>
                </div>
               
                <input class="btn btn-primary" type='submit' name = 'submit' value='Create Admin' /> 
                <input class="btn btn-primary" type="submit" name = "reset" value = "Reset"/>     
                <a href="view_admins.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Cancel</a>
            </form>
        </div>
    </div>
 
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 

