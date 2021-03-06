<?php
session_start();
?>
<?php  
include('config.php');
?>
<?php  include("../includes/layouts/header.php"); 

 ?>
<?php require_once("../includes/functions.php"); ?> 
<div id="page">
        <h2>Create Reservation</h2>
    </div

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
                    <p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=<?php echo urlencode($_SESSION['id']) ?>">[View Account Details]</a> </p>
    <p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>
 <?php print_navigation(); ?>

<div id="tabs">
<ul>
<ul>
<li><a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> View  all Clients</a></li>
<li><a href="view_room_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>">View Reservations Per room</a></li> 
<li><a href="create_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Create Reservation</a></li>
</ul>
</ul>
</div>
<?php 
$adult_occupants = "";

$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 

global $link;
 
if(!isset($_POST['submit'])){
    $room_type = "";
    $adult_occupants = "";
    $minor_occupants = "";
    $meals = "";
}
if (isset($_POST["reset"])) {
$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 


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
    if(empty(trim($_POST['payment_mode']))){
        $payment_mode_err = "Please select a payment scheme.";
    }
    else{
        $payment_mode = trim($_POST['payment_mode']);
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

       
    $selected_room_number = trim($_POST["selected_room_number"]);
   $sql="SELECT client_number, check_in_date,check_out_date FROM client_info where room_number = '$selected_room_number'";
$result = mysqli_query($link, $sql);
confirm_query($result);     
while ($reservations = mysqli_fetch_assoc($result)){

        if((strtotime($check_in_date) >= strtotime($reservations["check_in_date"])) && (strtotime($check_in_date) <= strtotime($reservations["check_out_date"])))  {
            $check_in_date_err="Check-in date reserved for selected room";
        }
        elseif((strtotime($check_out_date) >= strtotime($reservations["check_in_date"])) && (strtotime($check_out_date) <= strtotime($reservations["check_out_date"])))  {
            $check_out_date_err="Check-out date reserved for selected room";
       
        } 
        else{

        }

}
                                                                                                                                                           
   if(empty( $client_fname_err) && empty( $client_lname_err)&& empty($client_address_err) && empty( $client_contact_number_err) && empty( $client_email_err) && empty($payment_mode_err) && empty($check_in_date_err) && empty( $check_out_date_err) && empty( $adult_occupants_err)){  
      $client_fname   = $_POST['client_fname'];    
    $client_lname   = $_POST['client_lname'];
    $client_address  = $_POST['client_address'];
    $client_contact_number = $_POST["client_contact_number"];
    $client_email   = $_POST["client_email"];
    $payment_mode      = $_POST["payment_mode"];
    $check_in_date    =$_POST["check_in_date"];
    $check_out_date      =$_POST["check_out_date"];
    $selected_room_number     = $_POST["selected_room_number"];     
        $adult_occupants = $_POST["adult_occupants"];
        $minor_occupants = $_POST["minor_occupants"];

        $sql = "INSERT INTO client_info (client_fname, client_lname, client_address, contact_number, email_address,check_in_date,check_out_date,payment_mode, room_number, adult_occupants, minor_occupants) values ('$client_fname', '$client_lname' ,'$client_address', '$client_contact_number','$client_email', '$check_in_date','$check_out_date',' $payment_mode','$selected_room_number',  '$adult_occupants', '$minor_occupants')";
        $result = mysqli_query($link, $sql);
        confirm_query($result);
        $sql = "UPDATE rooms SET room_availability= '0' WHERE room_number = '{$selected_room_number}'";
        $result = mysqli_query($link, $sql);
        confirm_query($result);
    header("location: admin.php");
    }
    
}

 ?>

 <form action = 'create_reservations.php?sessionID=<?php echo urlencode($_SESSION['id']);?>' method='post'>
          

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
                            <label>Payment_mode</label>
                            <input type='text' name="payment_mode" class='form-control' value="<?php echo $payment_mode; ?>">
                             <span class="help-block"><?php echo $payment_mode_err; ?></span>
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
                            <input type='int' name="adult_occupants" value=" "> <br />
                             <span class="help-block"><?php echo $adult_occupants_err; ?></span>
                        </div>
                        <div>
                            <label>Number of Underage occupants:</label> 
                            <input type='int' name="minor_occupants" value=" "><br />
                        </div>
                        <div>
                            <label>Room To rent</label>
                          <select name = "selected_room_number">
                            <?php  $sql = "SELECT * FROM rooms ";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){

                              ?>
                              <option value = "<?php echo $row["room_number"]; ?> "><?php echo $row["room_number"]. " = ". $row["room_type"]?></option>
                              <?php
                                                                  
                            }
                        }
                    }
 ?>                     
                          </select>

                        </div>
                   <input type='submit' name = 'submit' value='Submit Reservation' /> 
                   <input type="submit" name = "reset" value = "Reset"/>     
                   <a href="manage_reservations.php?sessionID=<?php echo urlencode($_SESSION["id"]) ?>"> Cancel</a>
   
       </form>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
            }
            ?>
<?php  include("../includes/layouts/footer.php"); ?> 

