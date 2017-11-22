<?php 
function reload_image($dir){
	
	header($dir);

	
	 header("location: manage_rooms.php?sessionID=".$_SESSION["id"]);
}

 ?>

