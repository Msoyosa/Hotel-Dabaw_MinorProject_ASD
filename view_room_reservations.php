<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
   <div id="page">
        <h2>Manage Reservations</h2>       
    </div>

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
    <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">[Log out]</a> </p>
<?php print_navigation(); ?>
<?php  

$toSearch = "";
    $room_number = "";



?>
 
<div id="tabs">
<ul>
<ul>
<ul><li><a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> View  all Clients</a></li>
<li><a href="view_room_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">View Reservations Per room</a></li> </ul>
</ul>
</ul>
</div>

<div>
<form action ="view_room_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>" method = "post">
        <label>Search Client's Name, Number, or room_number</label>
        <input type="text" name="toSearch" value=""> 
        <input type="submit" name = "submit" value="Submit">
    </form >
</div>
<?php  
$message ="";
echo $message;
if (isset($_POST["submit"])) {
    if (!empty($_POST["toSearch"])) {
       $toSearch = $_POST["toSearch"];
       $sql2 = "SELECT * from client_info WHERE room_number regexp '$toSearch' || client_number regexp '$toSearch+' ||client_fname  regexp '$toSearch+'|| client_lname regexp '$toSearch+' ";
               $message ="";
        if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){  
                         $message =mysqli_num_rows($result2) ." matches found";  
                              ?>
    <h3><?php echo $message  ?></h3>
     <table cellpadding="10" cellspacing="" border="2" align="center">
            <tr>
                <th scope="col">Room Number</th>            
                <th scope="col">Room Type </th>
                <th scope="col">Client Number</th>
                <th scope="col">Client Name</th>
                <th scope="col">Check-in Date</th>
                <th scope="col">Check-out Date</th>
                <th scope="col">NUmber of Occupants</th>            
                <th scope="col">Actions</th>             
            </tr>
    <?php 

                       //  $message =mysqli_num_rows($result) ." matches found"; 
                           
                             ?>
                             <tr>

                          <?php                       //  print_reservations($sql,$message);
                        // var_dump($rooms);
                         
                         if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){  
                            while ($client = mysqli_fetch_assoc($result2)) {

                                ?>            
                        <td><?php  
                        $room_number = $client["room_number"];  echo $room_number;?></td>
                <td><?php     
                $sql = "SELECT room_type FROM rooms where room_number = '$room_number' ";                      
                if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){  
                            while ($rooms = mysqli_fetch_assoc($result)) {
                                $room_type = $rooms["room_type"];
                            }
                        }
                    }

  echo $room_type;?></td>
                <td><?php  $client_number = $client["client_number"]; echo $client_number;?></td>
                <td><?php  $client_fname = $client["client_fname"];
                            $client_lname = $client["client_lname"];  echo $client_fname ." " . $client_lname;?></td>
                <td><?php  $check_in_date = $client["check_in_date"]; echo $check_in_date;?></td>
                <td><?php  $check_out_date = $client["check_out_date"]; echo $check_out_date;?></td>
               <td><?php  $occupants = $client["adult_occupants"]+$client["minor_occupants"] ;  echo $occupants;?></td>
               <td width = 150px>
                <a href="read_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="delete_reservation.php?client_number=<?php echo urlencode($client_number);?>" ><img src="Images/Buttons/delete.ico"></a>
                </td>
            </tr>

            <?php  
                             //   var_dump($clients);
                               //  
                        }
                             }
                             else{

                                ?>

                                <td><?php  $room_number = $rooms["room_number"];  echo $room_number;?></td>
                <td><?php  $room_type = $rooms["room_type"];  echo $room_type;?></td>
                                <td><?php  echo "---";?></td>
                                <td><?php  echo "---";?></td>
                             <td><?php  echo "---";?></td>
                              <td><?php  echo "---";?></td>
                             <td><?php  echo "---";?></td>
                             <td width = 150px>
                <a href="read_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="delete_reservation.php?client_number=<?php echo urlencode($client_number);?>" ><img src="Images/Buttons/delete.ico"></a>
                </td>

               <?php
               
                           
                             }
                             ?>

                             <?php
                         }
                
                
                        
                        ?>
            <br /> <br /> 
        </table>

    <?php
            

                        }
                        elseif (mysqli_num_rows($result2) == 0) {
                                $sql = "SELECT * from client_info ";
                                $message = "No matches found";
                                $toSearch = "";
                        }
                    }

  


    }
}

 
if(empty($toSearch)){
    ?>
    <h3><?php echo $message  ?></h3>
     <table cellpadding="10" cellspacing="" border="2" align="center">
            <tr>
                <th scope="col">Room Number</th>            
                <th scope="col">Room Type </th>
                <th scope="col">Client Number</th>
                <th scope="col">Client Name</th>
                <th scope="col">Check-in Date</th>
                <th scope="col">Check-out Date</th>
                <th scope="col">NUmber of Occupants</th>            
                <th scope="col">Actions</th>             
            </tr>
    <?php 
   $sql = "SELECT * from rooms";
        $message ="";
        if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){  
                            while ($rooms = mysqli_fetch_assoc($result)) {

                       //  $message =mysqli_num_rows($result) ." matches found"; 
                            $room_number = $rooms["room_number"];
                             ?>
                             <tr>

                          <?php
                            $sql2 = "SELECT  * FROM client_info WHERE room_number = '$room_number'";  
                       //  print_reservations($sql,$message);
                        // var_dump($rooms);
                         
                         if($result2 = mysqli_query($link, $sql2)){
                        if(mysqli_num_rows($result2) > 0){  
                            while ($client = mysqli_fetch_assoc($result2)) {
                                ?>            
                        <td><?php  $room_number = $rooms["room_number"];  echo $room_number;?></td>
                <td><?php  $room_type = $rooms["room_type"];  echo $room_type;?></td>
                <td><?php  $client_number = $client["client_number"]; echo $client_number;?></td>
                <td><?php  $client_fname = $client["client_fname"];
                            $client_lname = $client["client_lname"];  echo $client_fname ." " . $client_lname;?></td>
                <td><?php  $check_in_date = $client["check_in_date"]; echo $check_in_date;?></td>
                <td><?php  $check_out_date = $client["check_out_date"]; echo $check_out_date;?></td>
               <td><?php  $occupants = $client["adult_occupants"]+$client["minor_occupants"] ;  echo $occupants;?></td>
               <td width = 150px>
                <a href="read_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="delete_reservation.php?client_number=<?php echo urlencode($client_number);?>" ><img src="Images/Buttons/delete.ico"></a>
                </td>
            </tr>

            <?php  
                             //   var_dump($clients);
                               //  
                        }
                             }
                             else{

                                ?>

                                <td><?php  $room_number = $rooms["room_number"];  echo $room_number;?></td>
                <td><?php  $room_type = $rooms["room_type"];  echo $room_type;?></td>
                                <td><?php  echo "---";?></td>
                                <td><?php  echo "---";?></td>
                             <td><?php  echo "---";?></td>
                              <td><?php  echo "---";?></td>
                             <td><?php  echo "---";?></td>
                             <td width = 150px>
                </td>

               <?php
               
                           
                             }
                             ?>

                             <?php
                         }
                     }
                        }
                        
                        ?>
            <br /> <br /> 
        </table>

    <?php
                    }

                }   
           

     ?>


<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------


            }
            ?>



<?php  include("../includes/layouts/footer.php"); ?> 
