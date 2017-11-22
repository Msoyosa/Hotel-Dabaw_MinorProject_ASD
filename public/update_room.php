<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<?php include("try.php"); ?>
<style type="text/css">
    
    #body { width: 100%; margin: 0 auto;} 
#col1{
    float: left; margin: 0; width: 75%;
}
#col2{
    float: left; margin: 0; width: 25%;

}
#main{
width: 100%; margin: 0 auto;
}
#image{
       float: left; margin: 0; width: 60%;
 
}
#info{
        float: left; margin: 0; width: 40%;

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
        margin-left: 90px;
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
<?php  
$message = "";
$room_number_err = $room_type_err = $room_rate_err ="";
$image_info = "";
if(isset($_GET["room_number"])){
    $selected_room_number = $_GET["room_number"];
     $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){

                                $image_link = $row["image_link"];
                                $room_number = $row["room_number"];
                                $room_type = $row["room_type"];
                                $room_rate = $row["room_rate"];
                                $old_room_number =  $row["room_number"];

                                $old_room_type =  $room_type;
                                $old_room_rate =  $room_rate ;

                            }

                        }
                    }
                  //  mysql_close($link);
 

  }
 if (isset($_POST["reset"])) {
$room_number_err = $room_type_err = $room_rate_err ="";
 $room_type= $room_rate ="";


}
if(isset($_POST["submit"])){
	
	 $old_room_number =  $_GET["room_number"];
	if(empty($_POST["room_type"])){
		$room_type_err = "Please specify room type";
	}
	else{
		$room_type =$_POST["room_type"];
	}
	if(empty($_POST["room_rate"])){
		$room_rate_err = "Please enter room rate";
	}
	else{
		$room_rate =$_POST["room_rate"];
	}


  if(empty($room_rate_err)  && empty($room_type_err)){
    if ($_FILES["image"]["name"] != "") {
      $image_info = $_FILES["image"] ;
               
      $image_info['name'] = $selected_room_number.".jpg";
      //print_r($image_info);
      if($image_info['error'] > 0){
        die('An error ocurred when uploading.');
      }
      if(!preg_match("/[image]+/", $_FILES["image"]["type"])){
        die('Unsupported filetype uploaded.');
      }

 //rename($image, "/home/user/login/docs/my_file.txt");

switch ($room_type) {
    case 'Single Bedroom':
       if(!move_uploaded_file($image_info['tmp_name'], 'C:/wamp/www/hotel_dabaw/public/Images/Hotel Rooms/single bedroom/' . $image_info['name'])){
    die('Error uploading file - check destination if writeable.');
}
else{
  $dir = "Images/Hotel Rooms/single bedroom/".$image_info['name'];
?>
  <img src="<?php echo $dir; ?>"/>

  <?php
   header("location: manage_rooms.php");
}
        break;
    
   case 'Double Bedroom':
       if(!move_uploaded_file($image_info['tmp_name'], 'C:/wamp/www/hotel_dabaw/public/Images/Hotel Rooms/double bedroom/' . $image_info['name'])){
    die('Error uploading file - check destination if writeable.');
}
else{
  $dir = "Images/Hotel Rooms/double bedroom/".$image_info['name'];
?>
  <img src="<?php echo $dir; ?>"/>

  <?php
   header("location: manage_rooms.php?sessionID=".$_SESSION["id"]);
}
        break;
    case 'Family Bedroom':
       if(!move_uploaded_file($image_info['tmp_name'], 'C:/wamp/www/hotel_dabaw/public/Images/Hotel Rooms/family bedroom/' . $image_info['name'])){
    die('Error uploading file - check destination if writeable.');
}
else{
    $dir = "Images/Hotel Rooms/family bedroom/".$image_info['name'];
?>
  <img src="<?php echo $dir; ?>"/>

  <?php
   header("location: manage_rooms.php?sessionID=".$_SESSION["id"]);
}
        break;
}

}  $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){

                                $image_link = $row["image_link"];
                            }
                        }
                    }
		}
		if ($old_room_type == $_POST["room_type"] && $old_room_rate == $_POST["room_rate"] && $_FILES["image"]["name"] == "") {
			   	$message = "No changes made to room number" .": ".$room_number;

		}
		else{

		$room_number =$_GET["room_number"];
		$room_type =$_POST["room_type"];
		$room_rate =$_POST["room_rate"];
		//echo $room_number ."  .  " . $room_type . "  .  " .$old_room_number;
		$sql = "UPDATE rooms set ";
		$sql .= "room_type = '{$room_type}', "; 
		$sql .= "room_rate = '{$room_rate}' ";
		$sql .= "WHERE room_number ='{$room_number}'";
		  	$result = mysqli_query($link, $sql);
   			confirm_query($result);
             $sql = "SELECT image_link FROM client_info where room_number = '$room_number'";
            if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                               $image_link = $row["image_link"];
                            }
                        }

                    }
   			$message = "Successfully updated room number" .": ".$room_number. ".";
   	                  //  mysql_close($link);

		}
		
   		//	header("location: manage_rooms.php?sessionID=$_SESSION[id]");



 
}

?>
<div id="main">
<div id="image"> 
<div>
    <img src="<?php echo $image_link; ?>" width =750px>
</div>
</div>
<?php 
if (empty($message)) {

 ?>
<div id="info">
<div>
    <div id="form">
	<form action = "update_room.php?room_number=<?php echo urlencode($room_number);?>" method = "post" enctype="multipart/form-data">
	
        <div>
            <label>Room Number: <?php echo $old_room_number; ?> </label>
           <?php /* <input type="disabled" name="room_number" value="<?php echo $room_number; ?>">
             <span class="help-block"><?php echo   $room_number_err; ?></span>*/  ?> 
        </div>

        <div>
            <label>Room Type: </label>
            <input type='text' name="room_type" value="<?php echo  $room_type; ?>">
             <span class="help-block"><?php echo $room_type_err; ?></span>
        </div>
        <div>
        	<label>Upload New Image:</label>
        <p> 
            <label for="file">File to upload:</label> 
            <input id="file"  type="file" name="image"> 
        </p> 
                 
        <?php /*<div>
        	 <input type="file" name="room_image" /><br /> 

        </div>*/ ?>
         <div>
            <label>Room Rate:</label>
            <input type='text' name="room_rate" value="<?php echo  $room_rate; ?>">
             <span class="help-block"><?php echo $room_rate_err; ?></span>
        </div>
        <div>
        	 <input type="submit" class="btn btn-primary" name = "submit" value="Update this room" /> 
        	 <input type="submit" class="btn btn-primary" name = "reset" value = "Reset"/> 
        	 <a href="manage_rooms.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>" class="btn btn-default">Cancel</a>

        </div>

	</form>
        </div>
</div>
</div>
</div>
<?php }
elseif (!empty($message)){
	?>
	<h2> <?php echo $message; ?>. Go back to <a href="manage_rooms.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Managing Rooms</a></h2>
	<?php
	} 
	?>

<?php

//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>

