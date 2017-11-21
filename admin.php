<!DOCTYPE>
<?php
session_start();
?>
<?php 
?>
<?php  include("../includes/config.php"); ?>

<html>

<head>
    <title>Hotel Dabaw</title>
    <link rel="stylesheet" href="css/uikit.min.css">
    <script src="js/uikit.min.js"></script>
    <style type="text/css">
        body {
            width: 90%;
            margin: 0 auto;
            background-color: ;
            color: black;
        }

        #header {
            width: 100%;
            text-align: center;

        }

        #contento {
            width: 100%;
            margin: 0 auto;
            vertical-align: center;
        }

        #page {
            background-color: antiquewhite;
            width: 400px;

        }

    </style>

</head>

<body>

    <div id="header">

        <div id="index">
            <a href="../public/index.php" target="_blank">
                <h2>Visit as a Customer</h2>
            </a>
        </div>
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

        </div>
    </center>
    <?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
          /*  <!-- footer -->
    <footer>
        <div class="container">
            <div class="wrapper">
                <div class="fleft">Copyright - All Right Reserved to Hotel Dabaw 2017</div>
                <div class="fright"></div>
            </div>
        </div>
    </footer>
    <script type="text/javascript">
        Cufon.now();

    </script>*/
?>

    
</body>

</html>
