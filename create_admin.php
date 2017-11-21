<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<style type="text/css">
    
    #body { width: 100%; margin: 0 auto;} 
#col1{
    float: left; margin-top: -10px; width: 100%;
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
    #para {
  border: 4px solid black;
        width:454px;
        margin-top: 180px;
}
</style>
   <div id="page">
        <h2>Manage Admins</h2>       
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
      
    <div id="col2">
 <?php print_navigation(); ?>
 </div>
 </div><?php  ?>
<?php 


 ?><center>
<div id="col1">
        <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
    </div>
    </center>
<center>
<form action = 'create_admin.php?sessionID=<?php echo urlencode($_SESSION['id']);?>' method='post'>
    <div id="para">
<h3>Create an admin ID? Or <br /><a href="create_admin_full.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">  Create admin through full form?</a></h3><br />
    <p>If you want to create an admin account, you will fill up the full form for the admin.</p>
    <p>However, if you choose to create an id, you will only create an ID for admin, and he or she will fill up the rest of the form when he/she wants.</p>
</div>
</form>


    <?php 
                     $success_id= "";
$admin_id_err = $admin_id  = $message =  "";
$admin_username = "emp";

    if(isset($_POST["submit"])){
    $admin_id = $admin_id_err="";
     if(empty(trim($_POST['admin_id']))){
        $admin_id_err = "Please enter admin's id.";
    }
    else{
        $admin_id = trim($_POST['admin_id']);
    }
    if(empty($admin_id_err)){

   $sql = "SELECT * FROM admins WHERE id = '$admin_id'";
   if($result = mysqli_query($link, $sql)){
    if(mysqli_num_rows($result) == 0){
    $admin_id = trim($_POST['admin_id']);
        $sql = "INSERT INTO admins (id,username) values ('$admin_id','$admin_username')";
         $result = mysqli_query($link, $sql);
        if ( admin_confirm_query($result) == 1) {
            $message = "You successfully created id number ";
         }
         else{
            $message = "There was an error in creating id number ";
         }
          $success_id=$admin_id;
        $admin_id = $admin_id_err="";

    }
    else{

        $admin_id_err = "ID already created";
        
    }

   } 
       
    }
 }
        ?>
  
<h2><?php echo $message ." ". $success_id; ?> </h2>
  <form action = 'create_admin.php?sessionID=<?php echo urlencode($_SESSION['id']);?>' method='post'>
                        <div>
                            <label>Please Type in Admin ID</label>
                            <input type='text' name="admin_id" value="<?php echo $admin_id; ?>">
                             <span class="help-block"><?php echo   $admin_id_err; ?></span>
                        </div>
                   <input type='submit' name = 'submit' value='Create ID' />             
        </form>

 
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 