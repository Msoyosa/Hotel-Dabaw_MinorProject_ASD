<?php
function confirm_query($result_set){
	global $link;
   
	if(!$result_set){
       
		die("Database query failed.".mysqli_error($link));
	}
	else{
		 

	}
}
function admin_confirm_query($result_set){
    global $link;
    $message = "";
    if(!$result_set){
        $message = 0;
  //      die("Database query failed.".mysqli_error($link));
    }
    else{
         $message = 1;
    }
    return $message;
}

function find_all_pages(){
global $link;
$query = "SELECT * FROM manage_content_pages";
$pages_set = mysqli_query($link,$query);
confirm_query($pages_set);
return $pages_set;
}
?>




<?php 
function print_navigation(){
    ?>
    <div id="navigation"> 
    <ul> 
    

       
<?php 
global $link;
$query = "SELECT * FROM manage_content_pages";
$pages_set = mysqli_query($link,$query);
confirm_query($pages_set);
    while ($pages = mysqli_fetch_assoc($pages_set)) {
     ?>
     <li>
     <a href="<?php echo $pages['file_name']; echo"?sessionID=$_SESSION[id]" ?>"> <?php echo $pages["menu_name"]; ?></a> </li>

<?php  }?>
       
        
    <?php if ($_SESSION["id"] <=10 ){
        ?>
 <li><a href="create_admin.php?session_ID=<?php echo urlencode($_SESSION['id']) ?>">Create Admin</a></li> 
        <li><a href="view_admins.php?session_ID=<?php echo urlencode($_SESSION['id']) ?>">View Admins</a> </li>
   
       <?php
        } ?> 
    </ul>
     
    </div>  
    <?php
    mysqli_free_result($pages_set);

}

?>
<?php
function print_rooms($sql, $message){
    global $link;
    ?>
    <h3><?php echo $message  ?></h3>
     <table cellpadding="10" cellspacing="" border="2" align="center"style="margin-top:-30px; margin-left:250px;">
            <tr>
                <th scope="col">Image <br /></th>            
                <th scope="col">Room Number <br /></th>
                <th scope="col">Room Type</th>
                <th scope="col">Room Rate</th>
                <th scope="col">Actions<br /></th>
            </tr>
    <?php  
   
     if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){     
                        while($row = mysqli_fetch_assoc($result)){
    ?>
            <tr>
               
                <td><?php  echo "<img src='".$row['image_link']."' height = 200 width = 250/>";?></td>
                <td><?php 
                $room_number = $row["room_number"];
                echo $room_number?></td>
                <td><?php  echo $row["room_type"]?></td>
                <td><?php  echo $row["room_rate"]?></td>
                <td width="200px">
                <a href="read_room.php?room_number=<?php echo urlencode($room_number);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_room.php?room_number=<?php echo urlencode($room_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="reservation_form_processing.php?room_number=<?php echo urlencode($room_number);?>" target = "_blank">Reserve this Room</a>

                </td> 
                <?php  
               
                                ?>
                
            </tr>

            <?php  
        }
    }
    
}
            ?>
            <br /> <br /> 
        </table>

    <?php

}
?>

<?php
function print_client($sql, $message){
    global $link;
    ?>
    <h3><?php echo $message  ?></h3>
     <table cellpadding="10" cellspacing="" border="2" align="center"style="margin-top:-10px; margin-left:200px;">
            <tr>
                <th scope="col">Client Number</th>            
                <th scope="col">Client Name </th>
                <th scope="col">Room Number</th>
                <th scope="col">Contact Number</th>
                <th scope="col">E-mail Address</th>
                <th scope="col">Check in Date</th>
                <th scope="col">Check out Date </th>            
                <th scope="col">Actions</th>
            </tr>
    <?php  
   
     if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){     
                        while($row = mysqli_fetch_assoc($result)){
    ?>
         
         <tr>
               
                <td><?php  $client_number = $row["client_number"];  echo $client_number;?></td>
                <td><?php  $client_fname = $row["client_fname"];  $client_lname = $row["client_lname"]; echo $client_fname. " ". $client_lname;?></td>
                <td><?php  $selected_room_number = $row["room_number"];  echo $selected_room_number;?></td>
                <td><?php  $client_contact_number = $row["contact_number"];  echo $client_contact_number;?></td>
                <td><?php  $client_email = $row["email_address"];  echo $client_email;?></td>
                <td><?php  $check_in_date = $row["check_in_date"];  echo $check_in_date;?></td>
                <td><?php  $check_out_date = $row["check_out_date"];  echo $check_out_date;?></td>
                <td width = 150px>
                <a href="read_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="delete_reservation.php?client_number=<?php echo urlencode($client_number);?>" ><img src="Images/Buttons/delete.ico"></a>
                </td>
            </tr>
            

            <?php  
        }
    }
    
}
            ?>
            <br /> <br /> 
        </table>

    <?php

}
?>
<?php
function print_admins($sql, $message){
    global $link;
    ?>
    <h3><?php echo $message  ?></h3>
     <table cellpadding="10" cellspacing="" border="2" style="margin-top:-10px; margin-left:300px;">
            <tr>
                <th scope="col">ID Number <br /></th>            
                <th scope="col">Username<br /></th>
                <th scope="col">First Name</th>
                <th scope="col">Middle Name</th>
                <th scope="col">Last Name<br /></th>
                <th scope="col">Actions<br /></th>
            </tr>
    <?php  
   
     if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){     
                        while($row = mysqli_fetch_assoc($result)){
                           


    ?>
            <tr>
               
                <td><?php  $adminID =  $row['id']; echo $row['id'];?></td>
                <td><?php  echo $row["username"];?></td>
                <td><?php  echo $row["fname"]?></td>
                <td><?php  echo $row["mname"]?></td>
                <td><?php  echo $row["lname"]?></td>

                <td width = 150px>
                <a href="read_admin.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/view.ico"></a>
                <a href="update_admin.php?adminID=<?php echo urlencode($adminID);?>"><img src="Images/Buttons/update.ico"></a>
                    <?php if ($row["id"] != 1) {
                        ?>
                <a href="delete_admin.php?adminID=<?php echo urlencode($adminID);?>" ><img src="Images/Buttons/delete.ico"></a>
 
                        <?php
        
    } ?>
                </td>
                <?php  
               
                                ?>
                
            </tr>

            <?php  
                                       
        }
    }
    
}
            ?>
            <br /> <br /> 
        </table>

    <?php

}
?>