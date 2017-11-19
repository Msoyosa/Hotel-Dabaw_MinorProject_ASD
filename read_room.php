<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<link rel="stylesheet" href="css/uikit.min.css">
<script src = "js/uikit.min.js"></script>

<div id="page">
        <h2>View Room</h2>
    </div

<?php if(empty($_SESSION["username"]) && empty($_SESSION["username"]) && empty($_SESSION["id"])){
		?>
		<h1>You are not Logged in</h1>
		<h3> Already have an account?<a href="log-in.php">Log-in Here</a> or</h3>
		<h3><a href="register.php">Create an account</a> </h3>
		<?php
		}
		else {
//Dontats------------------------------------------------------------------------------------------------------------------------------
			?>
	<p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
	<p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
<?php 
print_navigation();
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
                            }
                        }
                    //    mysql_close($link);
                    }
  }
      $selected_room_number = $_GET["room_number"];
     $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                $image_link = $row["image_link"];
                                $room_number = $row["room_number"];
                                $room_type = $row["room_type"];
                                $room_rate = $row["room_rate"];
                            }
                        }
                   //     mysql_close($link);
                    }
 ?>
<div>
    <img src="<?php echo $image_link; ?>" width =750px >
</div>
<div>
	<h3>Room Number : <?php echo $room_number; ?></h3>
	<h3>Room Type : <?php echo $room_type; ?></h3>
	<h3>Room Number : <?php echo $room_rate; ?> per day</h3>

</div>
    <div>

                <h3>This room is reserved on these dates:<h3> 
                <table>
                            <th>Check-in-dates</th>
                            <th>Check-out-dates</th>
                <?php 
                $sql="SELECT check_in_date,check_out_date FROM client_info where room_number = '$selected_room_number'";
                    $result = mysqli_query($link, $sql);
                    confirm_query($result); 

                    while ($reservations = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                        <td><?php echo $reservations["check_in_date"]; ?> </td>
                        <td><?php echo $reservations["check_out_date"]; ?> </td>   
                        </tr>
                                           
                        <?php
                    //var_dump($reservations);
                    }
                     ?>
                       </table>
                </div>
<div>
 	<a href="update_room.php?room_number=<?php echo urlencode($room_number);?>"><img src="Images/Buttons/update.ico">Update this Room</a>
</div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
<?php  include("../includes/layouts/footer.php"); ?> 