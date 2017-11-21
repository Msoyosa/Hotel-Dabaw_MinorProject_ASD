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
    #form{
        margin-left: 390px;
    }
</style>
   <div id="page">
        <h2>Manage Reservations</h2>       
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
    
    </div>
   
 <?php print_navigation(); ?>
 <div id="tabs">
<ul>
<ul>
<ul>
<li><a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> View  all Clients</a></li>
<li><a href="view_room_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">View Reservations Per room</a></li> </ul>
</ul>
</ul>
</div>

 </div>

<?php  

$toSearch = "";

if (isset($_POST["submit"])) {
    if (isset($_POST["toSearch"])) {
       $toSearch = $_POST["toSearch"];
       $sql = "SELECT * from client_info WHERE client_number regexp '$toSearch+' ||client_fname  regexp '$toSearch+'|| client_lname regexp '$toSearch+' ";
    }
}
else{
    $toSearch = "";
}

?>
 

<div>
    <div id="form">
<form action ="manage_reservations.php<?php echo "?sessionID=$_SESSION[id]" ?>" method = "post">
        <label>Search Client's Name, Number, or room_number</label>
        <input type="text" name="toSearch" value=""> 
        <input type="submit" name = "submit" value="Submit">
    </form >
</div>
<?php  
$message ="";
echo $message;

if (isset($_POST["submit"])) {
    if (!empty(trim($_POST["toSearch"]))) {
       $toSearch = $_POST["toSearch"];
            $sql = "SELECT * from client_info WHERE client_number regexp '$toSearch+' || client_fname  regexp '$toSearch+'|| client_lname regexp '$toSearch+' || room_number  regexp '$toSearch+'";
        $message ="";
        if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){  
                         $message =mysqli_num_rows($result) ." matches found"; 
                            $sql = "SELECT * from client_info WHERE client_number regexp '$toSearch+' || client_fname  regexp '$toSearch+'|| client_lname regexp '$toSearch+' || room_number  regexp '$toSearch+'";
  
                         die(print_client($sql,$message));
                        }
                        elseif (mysqli_num_rows($result) == 0) {
                               $sql = "SELECT * from client_info ";
                                $message = "No matches found";
                                die(print_client($sql,$message));
                        }
                    }
                }   
    }

else{
    $toSearch = "";

}
 
if(empty($toSearch)){
         $sql = "SELECT * from client_info ";
          $message ="";
         print_client($sql, $message);
     }


     ?>


<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------

            }
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 