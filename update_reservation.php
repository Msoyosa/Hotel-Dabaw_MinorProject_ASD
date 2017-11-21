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
    
    form{
        width:20%;
        text-align: center;
        margin-left: 50px;
        
    }
    #room{
        margin-left: 50px;
    }
</style>
   <div id="page">
        <h2>Manage Reservations</h2>       
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
 <?php
           
  $confirm = "";
 global $link;

$client_number = $_GET["client_number"];
$adult_occupants = "";

$client_fname = $client_lname= $client_address = $client_contact_number = $client_email  = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 

    $room_type = "";
    $adult_occupants = "";
    $minor_occupants = "";
    $meals = "";
global $link;
    
  $sql = "SELECT * from client_info WHERE client_number = $client_number";

     if($result = mysqli_query($link, $sql)){
        if(mysqli_num_rows($result) > 0){     
         while($row = mysqli_fetch_assoc($result)){ 


    $client_fname   = $row['client_fname'];    
    $client_lname   = $row['client_lname'];
    $client_address  = $row['client_address'];
    $client_contact_number = $row["contact_number"];
    $client_email   = $row["email_address"];
    $check_in_date    =$row["check_in_date"];
    $check_out_date      =$row["check_out_date"];
    $selected_room_number     = $row["room_number"];     
    $adult_occupants = $row["adult_occupants"];
    $minor_occupants = $row["minor_occupants"];

    $old_client_fname   = $client_fname ;    
    $old_client_lname   = $client_lname;
    $old_client_address  = $client_address;
    $old_client_contact_number = $client_contact_number;
    $old_client_email   = $client_email ;
    $old_check_in_date    =$check_in_date;
    $old_check_out_date      = $check_out_date ;
    $old_selected_room_number     = $selected_room_number;     
    $old_adult_occupants = $adult_occupants;
    $old_minor_occupants =  $minor_occupants;
    
        }
    }
}


 if (isset($_POST["reset"])) {

$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $check_in_date = $check_out_date = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err  = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 


}


if(isset($_POST['submit'])){
    if(empty(trim($_POST["client_fname"]))){
        $client_fname_err = "Please enter client's first name.";
    } 
    else{
        $client_fname = trim($_POST["client_fname"]);    
    }
    if(empty(trim($_POST["client_lname"]))){
        $client_lname_err = "Please enter client's last name.";
    } 
    else{
        $client_lname = trim($_POST["client_lname"]);    
    }
    if(empty(trim($_POST['client_address']))){
        $client_address_err = "Please enter client's complete address.";
    }
    else{
        $client_address = trim($_POST['client_address']); 
    }
    if(empty(trim($_POST['client_contact_number']))){
        $client_contact_number_err = "Please enter client's complete address.";
    }
    else{
        $client_contact_number = trim($_POST['client_contact_number']);
    }
    if(empty(trim($_POST['client_email']))){
        $client_email_err = "Please enter client's email.";
    }
    else{
        $client_email = trim($_POST['client_email']);
    }
    
    if(empty(trim($_POST['check_in_date']))){
        $check_in_date_err = "Please select a check-in date.";
    }
    else{
        $check_in_date = trim($_POST['check_in_date']);   
    }
    if(empty(trim($_POST['check_out_date']))){
        $check_out_date_err = "Please select a check-out date.";
    }
    else{
        $check_out_date = trim($_POST['check_out_date']);   
        
    }
    if(empty(trim($_POST['selected_room_number']))){
        $selected_room_number_err = "Please select a room number.";
    }
    else{
        $selected_room_number = trim($_POST['selected_room_number']);
    }
    if(empty(trim($_POST['adult_occupants']))){
        $adult_occupants_err = "Please enter number of occupants.";
    }
    else{
        $adult_occupants = trim($_POST['adult_occupants']);
        
    }
    if(strtotime($check_in_date) == strtotime(trim($_POST['check_in_date'])))   {
        if ( strtotime($check_out_date) == strtotime(trim($_POST['check_out_date']))) {
       
        $check_in_date = trim($_POST['check_in_date']);
        $check_out_date = trim($_POST['check_out_date']);
         }
    }
    else{
               $sql="SELECT client_number, check_in_date,check_out_date FROM client_info where room_number = '$selected_room_number'";
                $result = mysqli_query($link, $sql);
                confirm_query($result);     
                while ($reservations = mysqli_fetch_assoc($result)){
            //var_dump($reservations); 
                    if((strtotime($check_in_date) >= strtotime($reservations["check_in_date"])) && (strtotime($check_in_date) <= strtotime($reservations["check_out_date"])))  {
            $check_in_date_err="Check-in date reserved";
        }
        elseif((strtotime($check_out_date) >= strtotime($reservations["check_in_date"])) && (strtotime($check_out_date) <= strtotime($reservations["check_out_date"])))  {
            $check_out_date_err="Check-out date reserved";
       
        } 
        else{

        }

}
   
    }
    
                                                                                                                                                        
   if(empty( $client_fname_err) && empty( $client_lname_err)&& empty($client_address_err) && empty( $client_contact_number_err) && empty( $client_email_err)  && empty($check_in_date_err) && empty( $check_out_date_err) && empty( $adult_occupants_err)){  
    
    if ($old_client_fname   == $_POST['client_fname'] && $old_client_lname   == $_POST['client_lname'] &&  $old_client_address  == $_POST['client_address'] &&  
        $old_client_contact_number == $_POST["client_contact_number"] &&  $old_client_email   == $_POST["client_email"]  &&  $old_check_in_date    ==$_POST["check_in_date"] &&  $old_check_out_date      ==$_POST["check_out_date"] && $old_selected_room_number     == $_POST["selected_room_number"] 
        && $old_adult_occupants == $_POST["adult_occupants"] && $old_minor_occupants == $_POST["minor_occupants"]) {
         $confirm = "No changes has been made to number";


    }
    else{

    $client_fname   = $_POST['client_fname'];    
    $client_lname   = $_POST['client_lname'];
    $client_address  = $_POST['client_address'];
    $client_contact_number = $_POST["client_contact_number"];
    $client_email   = $_POST["client_email"];
    $check_in_date    =$_POST["check_in_date"];
    $check_out_date      =$_POST["check_out_date"];
    $selected_room_number     = $_POST["selected_room_number"];     
    $adult_occupants = $_POST["adult_occupants"];
    $minor_occupants = $_POST["minor_occupants"];

        $sql = "UPDATE client_info SET client_fname = '$client_fname', client_lname = '$client_lname', client_address = '$client_address', contact_number = '$client_contact_number', email_address = '$client_email', check_in_date = '$check_in_date',check_out_date = '$check_out_date', room_number = '$selected_room_number', adult_occupants = '$adult_occupants', minor_occupants = '$minor_occupants' where client_number = $client_number";

        $result = mysqli_query($link, $sql);
        confirm_query($result);
        $confirm = "You successfully updated client number ";
    //header("location: update_reservation.php?client_number=$client_number");

    }
    }
    
}
echo $confirm;
 if (empty($confirm)) {
    ?>
<div id="form">
    <form action = 'update_reservation.php?client_number=<?php echo urlencode($client_number);?>' method='post'>
          <h3><?php echo $_GET["client_number"]; ?></h3>

                        <div >
                            <label>First Name</label>
                            <input type="text" name="client_fname" class="form-control" value="<?php echo $client_fname; ?>">
                            <span class="help-block"><?php echo $client_fname_err; ?></span>

                        </div>
                        <div >
                            <label>Last Name</label>
                            <input type="text" name="client_lname" class="form-control" value="<?php echo $client_lname; ?>">
                            <span class="help-block"><?php echo $client_lname_err; ?></span>

                        </div>
                        <div>
                            <label>Address</label>
                             <input type='text' name="client_address" value="<?php echo $client_address; ?>">
                              <span class="help-block"><?php echo $client_address_err; ?></span>
                        </div>
                        <div>
                            <label>Contact Number</label>
                            <input type='text' name="client_contact_number" value="<?php echo $client_contact_number; ?>">
                             <span class="help-block"><?php echo $client_contact_number_err
; ?></span>
                        </div>
                        <div>
                            <label>E-mail</label>
                            <input type='text' name="client_email" value="<?php echo $client_email; ?>">
                             <span class="help-block"><?php echo   $client_email_err; ?></span>
                        </div>
                        <div>
                            <label>Check in:</label> 
                            <input type='date' name="check_in_date"value="<?php echo $check_in_date; ?>"> <br />
                             <span class="help-block"><?php echo  $check_in_date_err; ?></span>
                        </div>
                        <div>
                            <label>Check out:</label> 
                            <input type='date' name="check_out_date" value="<?php echo $check_out_date; ?>"><br />
                             <span class="help-block"><?php echo  $check_out_date_err; ?></span>
                        </div>
                        <div>
                            <label>Number of Adult Occupants </label> 
                            <input type='int' name="adult_occupants" value=" <?php echo $adult_occupants; ?>"> <br />
                             <span class="help-block"><?php echo $adult_occupants_err; ?></span>
                        </div>
                        <div>
                            <label>Number of Underage occupants:</label> 
                            <input type='int' name="minor_occupants" value="<?php echo $minor_occupants; ?>"><br />
                        </div>
                        <div>
                            <label>Room To rent<br/>:<?php echo $old_selected_room_number; ?></label>
                                <input type='text' name="selected_room_number" value="<?php echo $selected_room_number; ?>">

                        </div>
                   <input type='submit' name = 'submit' value='Submit Reservation' /> 
                   <input type="submit" name = "reset" value = "Reset"/> 
                    <a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>" class="btn btn-default">Cancel</a>

        </form>
    <div id="room"> 

                <h3>This room is reserved on these dates:<h3> 
                <table>
                            <th>Client Number</th>
                            <th>Client Name</th>
                            <th>Check-in-dates</th>
                            <th>Check-out-dates</th>
                <?php 
                $sql="SELECT * FROM client_info where room_number = '$selected_room_number'";
                    $result = mysqli_query($link, $sql);
                    confirm_query($result); 

                    while ($reservations = mysqli_fetch_assoc($result)){
                        ?>
                        <tr>
                        <td><?php echo $reservations["client_number"]; ?> </td>
                        <td><?php echo $reservations["client_fname"]." ".$reservations["client_lname"] ; ?> </td>
                        <td><?php echo $reservations["check_in_date"]; ?> </td>
                        <td><?php echo $reservations["check_out_date"]; ?> </td>   
                        </tr>
                                           
                        <?php
                    //var_dump($reservations);
                    }
                     ?>
                       </table>
                </div>
                    </div>
    <?php
  }
  else{
    ?>
    <h3> <?php echo $confirm." ".$_GET["client_number"]; ?>. Go back to <a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?> "> Managing reservations</a></h3>
    <table  cellpadding="10" cellspacing="" border="2" align="center">
        <th>Information</th>
        <th>Old</th>
        <th>Updated</th>
        <tr>
            <td>Name:</td> 
            <td s><?php echo $old_client_fname. " ".  $old_client_lname?></td>
            <td><?php echo $client_fname. " ".  $client_lname?></td>
        </tr>
        <tr>
            <td>Address:</td> 
            <td><?php echo $old_client_address;?></td>
            <td><?php echo $client_address;?></td>
        </tr>
        <tr>
            <td>Contact Number:</td> 
            <td><?php echo $old_client_contact_number;?></td>
            <td><?php echo $client_contact_number;?></td>
        </tr>
        <tr>
            <td>Email Address:</td> 
            <td><?php echo$old_client_email;?></td>
            <td><?php echo$client_email;?></td>
        </tr>
        <tr>
            <td>Check-in date and check-out dates:</td> 
            <td><?php echo $old_check_in_date . " to ".  $old_check_out_date?></td>
            <td><?php echo $check_in_date . " to ".  $check_out_date?></td>
        </tr>
        <tr>
            <td>Room Number:</td> 
            <td><?php echo $old_selected_room_number;?></td>
            <td><?php echo $selected_room_number;?></td>
        </tr>
         <tr>
            <td>Number of adult occupants:</td> 
            <td><?php echo $old_adult_occupants;?></td>
            <td><?php echo $adult_occupants;?></td>
        </tr>
         <tr>
            <td>Number of minor occupants:</td> 
            <td><?php echo $old_minor_occupants;?></td>
            <td><?php echo $minor_occupants;?></td>
        </tr>
    </table>
   

    <?php
  }

     ?>

<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 