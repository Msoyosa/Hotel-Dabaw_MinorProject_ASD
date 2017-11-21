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
    #para{
      
        margin-top: 97px;
        margin-left: 197px;
        margin-bottom: 100px;
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
            <div div="log" style="margin-left:40px;font-size: 15px;">
                <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
                <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>

            </div>
        </center>
<div id="para">
<p id="paragraph1">
	Hotel Dabaw offers 18 guestrooms for discerning for travellers searching for the best and affordable hotels in Davao City, Southerns Mindanao Island's hud for commerce, tourisn, and industry. Located at Magallanes Street, the hotel is in the downtown area.
</p>
<p id="paragraph2">
	Hotel Dabaw's interriors are sleek, clean and elegant. Design accents feature simplicity and detail at the same time.
</p>
<p id="paragraph3">
	Hotel Dabaw is an easy 20 minute-drive to and from Davao International Airport.
</p>
    </div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
<?php  include("../includes/layouts/footer.php"); ?> 