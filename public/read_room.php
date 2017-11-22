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
#main{
width: 100%; margin: 0 auto;
}
#image{
       float: left; margin: 0; width: 60%;
 
}
#info{
        float: left; margin-top: 5px; width: 40%;
     
        
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
      
   
    </div>
   
 <?php print_navigation(); ?>
 </div>

 <center>
 <div div="log" style="margin-left:40px;font-size: 15px;">
<p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
    
    </div>
</center>
<?php 

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
 <div id="main">
<div id="image">
    <img src="<?php echo $image_link; ?>" width =750px >
</div>
<div id="info">
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
</div>
</div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
