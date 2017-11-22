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
    #form{
        margin-left: 400px;
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
            <div id="col1">
        
    <div id="col2">
 <?php print_navigation(); ?>
                <center>  
        <div div="log" style="margin-left:40px;font-size: 15px;">
        <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
    
    </div>
        </center>    
 </div>
 </div>
 </div>
 <div id="form">               
 <form action ="manage_rooms.php<?php echo "?sessionID=$_SESSION[id]" ?>" method = "post">

        <label>Search Room Number or Type</label>
        <input type="text" name="toSearch" value=""> 
        <input type="submit" name = "submit" value="Submit">
    </form >
</div>
<?php  
 $message ="";
if (isset($_POST["submit"])) {
    if (!empty(trim($_POST["toSearch"]))) {
       $toSearch = $_POST["toSearch"];
       $sql = "SELECT * from rooms WHERE room_number regexp '$toSearch+' ||room_type regexp '$toSearch+' ";
        $message ="";
        if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){  
                         $message =mysqli_num_rows($result) ." matches found";   
                        die( print_rooms($sql,$message));
                        }
                        elseif (mysqli_num_rows($result) == 0) {
                                $sql = "SELECT * from rooms ";
                                $message = "No matches found";
                               die( print_rooms($sql,$message));
                        }
                    }
                }   
                             //       mysql_close($link);

    }

else{
    $toSearch = "";

}
 

         $sql = "SELECT * from rooms ";
          $message ="";
     print_rooms($sql, $message);
     


     ?>


<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------

            }
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 