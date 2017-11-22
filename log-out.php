<?php
session_start();
?>
<?php  include("../includes/layouts/header.php"); ?>
<link rel="stylesheet" href="css/uikit.min.css">
<script src = "js/uikit.min.js"></script>
<?php 
    $_SESSION["username"] = "";
    $_SESSION["password"] = "";
    $_SESSION["id"] = "";
    header("location: log-in.php");
 ?>
<?php  include("../includes/layouts/footer.php"); ?> 