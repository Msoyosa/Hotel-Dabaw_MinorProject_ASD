<!DOCTYPE>
<?php
session_start();
?>

<?php 
?>
<?php  include("../includes/config.php"); ?>

<?php  include("../includes/layouts/header.php"); ?>
   <link rel="stylesheet" href="css/uikit-rtl.min.css" type="text/css" media="all">
   <link rel="stylesheet" href="css/uikit-rtl.css" type="text/css" media="all">
   <link rel="stylesheet" href="css/uikit.min.css" type="text/css" media="all">
   <link rel="stylesheet" href="css/uikit.css" type="text/css" media="all">


  <script type="text/javascript" src="js/uikit.js"></script>
  <script type="text/javascript" src="js/uikit.min.js"></script>
  <script type="text/javascript" src="js/uikit-icons.js"></script>
  <script type="text/javascript" src="js/uikit-icons.min.js"></script>
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
aside{
    text-align: center;
}
</style>
        <?php require_once("../includes/functions.php"); ?>
    </div>
    <center>
        <div id="page">

            <h2>Admin Menu</h2>


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
                <div id="contento">
                    <div id="admin_body">
                        <div id="welcome">
                            <p> Welcome to admin area, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
                            <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
                            <hr/>
                        </div>
                        <div id="navi">
                            <?php print_navigation(); ?>
                        </div>
                    </div>

                </div>


<div class="uk-flex-center" uk-grid>
<div class="uk-animation-toggle">
    <div class="uk-flex-first"> 
            <img class="uk-animation-fade uk-transform-origin-bottom-right" width=200px height = 150px src="Images/slideshow_images/1.jpg">
   </div>
   </div>
   <div class="uk-animation-toggle">
       <div class="uk-flex-second"> 
        <img class="uk-animation-fade uk-transform-origin-top-center" width=200px height = 150px src="Images/slideshow_images/2.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-third"> 
        <img class="uk-animation-fade uk-transform-origin-bottom-center" width=200px height = 150px src="Images/slideshow_images/3.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-fourth"> 
        <img class="uk-animation-fade uk-transform-origin-top-center" width=200px height = 150px src="Images/slideshow_images/4.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-fifth"> 
        <img class="uk-animation-fade uk-transform-origin-bottom-right" width=200px height = 150px src="Images/slideshow_images/5.jpg">
        </div>
        </div>
 
</div>
 <aside>
            <h2>Nice people taking care of nice people.</h2>
        Welcome to your residence.
          
          
            <p>Change your view.</p>
      <p>Stay you.</p>
      <p>Relax, it's Hotel Dabaw.</p>
      <p>Stay with someone you know.</p>
      <p>The best surprise is no surprise.</p> 
          
          </aside>    
        </div>
    </center>
    <?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
         
?>

<?php  include("../includes/layouts/footer.php"); ?>

