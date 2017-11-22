<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?>
<?php  include("../includes/layouts/header.php"); ?>
<style type="text/css">
    #body {
        width: 100%;
        margin: 0 auto;
    }

    #col1 {
        float: left;
        margin: 0;
        width: 100%;
    }

    #col2 {
        float: left;
        margin: 0;
        width: 100%;
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
    <h2>Edit Name</h2>
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
        <div id="col1">

            <div id="col2">
                <?php print_navigation(); ?>
            </div>
        </div>
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
     $message = "No changes made to admin ".$_SESSION["username"]. " the account for ". $lname .", ". $fname. ".<br/>Go back to <a href = 'edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>"; } if (empty(trim($_POST["fname"]))) { $fname_err = "Please Enter First Name"; } else{ $fname = trim($_POST["fname"]); } if (empty(trim($_POST["lname"]))) { $lname_err = "Please Enter Last Name"; } else{ $lname = trim($_POST["lname"]); } if (empty(trim($_POST["mname"]))) { $mname_err = "Please Enter Middle Name"; } else{ $mname = trim($_POST["mname"]); } if(empty($fname_err) && empty($lname_err) && empty($mname_err)) { $fname = $_POST['fname']; $lname = $_POST['lname']; $mname = $_POST['mname']; $sql = "UPDATE admins SET fname = '$fname', lname = '$lname', mname = '$mname' WHERE id = '$adminID'"; $result = mysqli_query($link, $sql); $checking = admin_confirm_query($result); if($checking ==1){ $message = "Successfully updated admin ".$_SESSION["username"]. " the account for ". $lname .", ". $fname. ".<br/>Go back to <a href='edit_profile.php?sessionID=<?php echo urlencode($_SESSION[id]) ?>'> Editing Profile</a>"; $_SESSION["fname"]= $fname; $_SESSION["lname"]= $lname; $fname =$lname =$mname = $adminID = ""; $fname_err =$lname_err =$mname_err = ""; } } echo $message; /*

        */ } else{ ?>
        <center>
            <div div="log" style="margin-left:200px;font-size: 15px;">
                <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
                <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>

            </div>
        </center>


        <div>

            <div class="card" style="width: 500px; margin-left:440px; margin-bottom:90px;">
                <div class="card-body">
                <center>
                    <table cellpadding="10" cellspacing="">
                        <td>Admin ID:</td>
                        <td>
                            <?php echo $admin_id;?>
                        </td>
                        <td></td>

                    </table>
                    <form action='edit_name.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>' method='post'>
                        <div class="form-group">
                            <label>First Name</label>
                            <input name="fname" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="<?php echo $fname; ?>">
                            <span class="help-block"><?php echo $fname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Last Name</label>
                            <input name="lname" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $lname; ?>">
                            <span class="help-block"><?php echo $lname_err; ?></span>
                        </div>
                        <div class="form-group">
                            <label>Middle Name</label>
                            <input name="mname" type="text" class="form-control" id="exampleInputPassword1" value="<?php echo $mname; ?>">
                            <span class="help-block"><?php echo $mname_err; ?></span>
                        </div>

                        <input class="btn btn-primary" type="submit" name="submit" value="Update Profile" />
                        <input class="btn btn-primary" type="submit" name="reset" value="Reset" />
                        <a href="edit_profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">Cancel</a>
                    </form>
                    </center>
                </div>
            </div>
        </div>


        <?php
}

}
//Dontats------------------------------------------------------------------------------------------------------------------------------

            
            ?>



            <?php  include("../includes/layouts/footer.php"); ?>
