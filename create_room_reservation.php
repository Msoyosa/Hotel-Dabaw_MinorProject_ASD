<!DOCTYPE>
<?php
session_start();
?>
<?php 
?>
<?php  include("../includes/config.php"); ?>

<?php  include("../includes/layouts/header.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<div id="page">
		<h2>Admin Menu</h2>
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
 <?php 

$adult_occupants = "";

$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 

global $link;
    $selected_room_number     = $_GET["room_number"]; 

if(isset($_COOKIE["client_fname"]) ||isset($_COOKIE["client_lname"]) || isset($_COOKIE["client_address"]) || isset($_COOKIE["client_contact_number"]) || isset($_COOKIE["client_email"]) || isset($_COOKIE["payment_mode"])){
    $client_fname   = $_COOKIE['client_fname'];    
    $client_lname   = $_COOKIE['client_lname'];
    $client_address  = $_COOKIE['client_address'];
    $client_contact_number = $_COOKIE["client_contact_number"];
    $client_email   = $_COOKIE["client_email"];
    $payment_mode      = $_COOKIE["payment_mode"];
    $check_in_date    = date("d/m/y");
    $check_out_date      = date("d/m/y");
}
if(!isset($_POST['submit'])){
    $room_type = "";
    $adult_occupants = "";
    $minor_occupants = "";
    $meals = "";
}
if (isset($_POST["reset"])) {
$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date  = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err  = $adult_occupants_err = ""; 


}
if(isset($_POST['submit'])){

    if(empty(trim($_POST["client_fname"]))){
        $client_fname_err = "Please enter your first name.";
    } 
    else{
        $client_fname = trim($_POST["client_fname"]);    
    }
    if(empty(trim($_POST["client_lname"]))){
        $client_lname_err = "Please enter your last name.";
    } 
    else{
        $client_lname = trim($_POST["client_lname"]);    
    }
    if(empty(trim($_POST['client_address']))){
        $client_address_err = "Please enter your complete address.";
    }
    else{
        $client_address = trim($_POST['client_address']); 
    }
    if(empty(trim($_POST['client_contact_number']))){
        $client_contact_number_err = "Please enter your complete address.";
    }
    else{
        $client_contact_number = trim($_POST['client_contact_number']);
    }
    if(empty(trim($_POST['client_email']))){
        $client_email_err = "Please enter your email.";
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
    if(strtotime($check_in_date)>=strtotime($check_out_date)){
        $check_out_date_err = "Check out date should be later than check in date";

    }
    if(empty(trim($_POST['room_number']))){
        $selected_room_number_err = "Please select a room number.";
    }
    else{
        $selected_room_number = trim($_POST['room_number']);
    }
    if(empty(trim($_POST['adult_occupants']))){
        $adult_occupants_err = "Please enter number of occupants.";
    }
    else{
        $adult_occupants = trim($_POST['adult_occupants']);
        
    }
        $check_in_date = trim($_POST['check_in_date']);   

        $check_out_date = trim($_POST['check_out_date']);   

    $selected_room_number = trim($_POST["room_number"]);
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
        $adult_occupants = $_POST["adult_occupants"];
        $minor_occupants = $_POST["minor_occupants"];

        $sql = "INSERT INTO client_info (client_fname, client_lname, client_address, contact_number, email_address,check_in_date,check_out_date,payment_mode, room_number, adult_occupants, minor_occupants) values ('$client_fname', '$client_lname' ,'$client_address', '$client_contact_number','$client_email', '$check_in_date','$check_out_date',' $payment_mode','$selected_room_number',  '$adult_occupants', '$minor_occupants')";
        $result = mysqli_query($link, $sql);
        $name = "notif";
        $sulod =  admin_confirm_query($result);
        
        setcookie($name, $sulod, time()+3600);


    $cclient_name = "";
    $cclient_address  ="";
    $cclient_contact_number = "";
    $cclient_email   ="";
    $cpayment_mode  =   "" ;
    $ccheck_in_date   = "";
    $ccheck_out_date  =  ""  ; 

    }
    
}

 ?>
    <?php
                   $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_array($result)){
                                $image_link = $row["image_link"];
                                
                            }
                        }
                    }
 ?> 
<div>
    <img src="<?php echo $image_link; ?>" width =50%>
</div>

 <form action = "create_room_reservation.php?room_number=<?php echo urlencode($selected_room_number);?>" method='post'>
          

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
                            <input type='text' name="room_number" value='<?php echo $selected_room_number; ?>'>
                             <span class="help-block"><?php echo  $selected_room_number_err; ?></span>
                            <?php  $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_array($result)){
                                $room_type = $row["room_type"];
                                echo $room_type;
                            }
                        }
                    }
 ?>                     
                        </div>
                   <input type='submit' name = 'submit' value='Submit Reservation' /> 
                    <input type="submit" name = "reset" value = "Reset"/> 
        </form>
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
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
			?>
<?php  include("../includes/layouts/footer.php"); ?> 
