<?php  include("../includes/layouts/public_header.php"); ?>
  <style type="text/css"> 
  body { width: 100%; margin: 0 auto;} 
#image, #form, #table {float: left; margin: 10px;} 
h3{
    color: black;
}
th, td{
text-align: center;
color: black;
}
form{
    width: 400px;
    margin-left: 10px;
        background-color: #cccccc;
}

table{
    font-size: 20px;
}
#reserved_dates{
    width: 100%;
    text-align: left;
    vertical-align: center;
}
#image_container{
    width: 700px;
background-image: url("Images/BG/room_background.jpg");
background-position: center;
    background-attachment: fixed; opacity: 50%;
}

  </style>
   <div>
    <h2>Reservation</h2>
    </div>

<?php 
include('config.php');
require_once("../includes/functions.php");

$adult_occupants = "";
$minor_occupants = "";
$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 
$credit_company = $payment_account_number="";
 $payment_account_number_err="";
$total_days = $total_fees= "";
$room_rate = "";
global $link;
if (isset($_GET["room_number"])) {
   $selected_room_number = $_GET["room_number"];
}
if(isset($_COOKIE["client_fname"]) ||isset($_COOKIE["client_lname"]) || isset($_COOKIE["client_address"]) || isset($_COOKIE["client_contact_number"]) || isset($_COOKIE["client_email"]) || isset($_COOKIE["payment_mode"])){
    $client_fname   = $_COOKIE['client_fname'];    
    $client_lname   = $_COOKIE['client_lname'];
    $client_address  = $_COOKIE['client_address'];
    $client_contact_number = $_COOKIE["client_contact_number"];
    $client_email   = $_COOKIE["client_email"];
    $payment_mode      = $_COOKIE["payment_mode"];
    if(empty($_COOKIE["check_in_date"]) || empty($_COOKIE["check_out_date"])){
        $check_in_date = date("d/m/Y");
        $check_out_date = date("d/m/Y");
    }
    else{
         $check_in_date =$_COOKIE["check_in_date"];
        $check_out_date = $_COOKIE["check_out_date"];
    }
    $selected_room_number     = $_GET["room_number"]; 
}
if(!isset($_POST['submit'])){
    $room_type = "";
    $adult_occupants = "0";
    $minor_occupants = "";
}
 if (isset($_POST["reset"])) {
$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 


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
        $client_contact_number_err = "Please enter your contact number.";
    }
    else{
        $client_contact_number = trim($_POST['client_contact_number']);
    }
    if(empty(trim($_POST['client_email']))){
        $client_email_err = "Please enter your email.";
    }
    if (!preg_match("/^.+@.+\.com$/", trim($_POST['client_email']))) {
        $client_email_err = "Please enter a valid email address.";
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
    if(strtotime($check_in_date) <= strtotime(date("d/m/Y"))){
        $check_in_date_err = "Check-in date must not be later than today.";
    }
    else{
        $check_in_date = trim($_POST['check_in_date']);   
    }

    if(empty(trim($_POST['check_out_date']))){
        $check_out_date_err = "Please select a check-out date.";
    }
    if(strtotime($check_out_date) <= strtotime(date("d/m/Y"))){
        $check_out_date_err = "Check-out date must not be later than today.";
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
        $check_in_date = trim($_POST['check_in_date']);   

        $check_out_date = trim($_POST['check_out_date']);   
        }

}
if(empty( $client_fname_err) && empty( $client_lname_err)&& empty($client_address_err) && empty( $client_contact_number_err) && empty( $client_email_err) && empty($payment_mode_err) && empty($check_in_date_err) && empty( $check_out_date_err) && empty( $adult_occupants_err)){
        switch ($_POST["payment_mode"]) {
            case "1":
                $payment_mode = "PayMaya";
                break;
            case "2":
                $payment_mode = "Paypal";
                break;
             case "3":
                $payment_mode = "Credit Card";
                break;
            case "4":
                $payment_mode = "Bank";
                break;
            default:
                # code...
                break;
        }
 $adult_occupants = $_POST["adult_occupants"];
        $minor_occupants =trim( $_POST["minor_occupants"]);
        $client_fname = trim($_POST["client_fname"]);    

        $client_lname = trim($_POST["client_lname"]);    

        $client_address = trim($_POST['client_address']); 

        $client_contact_number = trim($_POST['client_contact_number']);

        $client_email = trim($_POST['client_email']);


        $check_in_date = trim($_POST['check_in_date']);   

        $check_out_date = trim($_POST['check_out_date']);   

        $selected_room_number = trim($_POST['room_number']);

        $check_in_date = trim($_POST['check_in_date']);   

        $check_out_date = trim($_POST['check_out_date']);   
        $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                $room_rate = $row["room_rate"];
                            }
                        }
                    }

    $total_days = (strtotime($_POST["check_out_date"]) - strtotime($_POST["check_in_date"]))/86400;
    $total_fees = $total_days * $room_rate;

    $cclient_fname = "client_fname";
    $cclient_lname = "client_lname";
    $cclient_address  ="client_address";
    $cclient_contact_number = "client_contact_number";
    $cclient_email   ="client_email";
    $cpayment_mode  =   "payment_mode" ;
    $ccheck_in_date   = "check_in_date";
    $ccheck_out_date  =  "check_out_date"  ;
    $aadult_occupants = "adult_occupants";
    $mminor_occupants = "minor_occupants";
    $ttotal_days = "total_days";
    $ttotal_fees = "total_fees";


        $expire = time()+ (60*60*24*7);
        setcookie($cclient_fname, $client_fname,$expire);
        setcookie($cclient_lname, $client_lname,$expire);
        setcookie($cclient_address, $client_address,$expire);
        setcookie($cclient_contact_number, $client_contact_number,$expire);
        setcookie($cclient_email, $client_email,$expire);
        setcookie($cpayment_mode, $payment_mode,$expire);
        setcookie($ccheck_in_date, $check_in_date,$expire);
        setcookie($ccheck_out_date, $check_out_date,$expire);
        setcookie($aadult_occupants, $adult_occupants,$expire);
        setcookie($mminor_occupants, $minor_occupants,$expire);
        setcookie($ttotal_days, $total_days,$expire);
        setcookie($ttotal_fees, $total_fees,$expire);

header("location: payment.php?room_number=$selected_room_number");
      
  //  header("location: create_reservation_message.php");
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

<div uk-grid>

 <form action = 'reservation_form_processing.php?room_number=<?php echo ($selected_room_number);?>' method='post'  >
          
                   
                        <div >
                            <label class="title" >First Name</label>
                            <input type="text" name="client_fname"class="uk-input" value="<?php echo $client_fname; ?>">
                            <span class="help-block"><?php echo $client_fname_err; ?></span><br/>

                        </div>
                        <div >
                            <label class="title">Last Name</label>
                            <input type="text" name="client_lname" class="uk-input" value="<?php echo $client_lname; ?>">
                            <span class="help-block"><?php echo $client_lname_err; ?></span><br/>

                        </div>
                        

                        <div>
                            <label class="title">Address</label>
                             <input type='text' name="client_address" class="uk-input" value="<?php echo $client_address; ?>">
                              <span class="help-block"><?php echo $client_address_err; ?></span><br/>
                        </div>

                        <div>
                            <label class="title">E-mail</label>
                            <input type='text' name="client_email" class="uk-input" value="<?php echo $client_email; ?>">
                             <span class="help-block"><?php echo   $client_email_err; ?></span><br/>
                        </div>

                        <div>
                            <label>Contact Number</label>
                            <input type='text' name="client_contact_number" class="uk-input" value="<?php echo $client_contact_number; ?>">
                             <span class="help-block"><?php echo $client_contact_number_err
; ?></span><br/>
                        </div>

                        <div>
                            <label class="title">Payment mode</label>
                            <select name="payment_mode" class="uk-select">
                            <option value="1">PayMaya</option>
                            <option value="2">Paypal</option>
                            <option value="3">Credit Card</option>
                            <option value="4">Bank</option>
                            </select>
                        </div><br/>
                        <div uk-grid>
                        <div class="uk-width-expand@m">
                            <label class="title">Check in:</label> 
                            <input type='date' name="check_in_date" class="uk-input" value="<?php echo $check_in_date; ?>"> 
                             <span class="help-block"><?php echo  $check_in_date_err; ?></span>
                        </div>
                        <div  class="uk-width-expand@m">
                            <label class="title">Check out:</label> 
                            <input type='date' name="check_out_date" class="uk-input" value="<?php echo $check_out_date; ?>">
                             <span class="help-block"><?php echo  $check_out_date_err; ?></span><br/>
                        </div>
                        </div>
                        <div uk-grid>
                        <div class="uk-width-expand@m">
                            <label class="title">Number of Adult Occupants </label> 
                            <input type='int' name="adult_occupants" class="uk-input" value=" "> <br/>
                             <span class="help-block"><?php echo $adult_occupants_err; ?></span><br />
                        </div>
                        <div class="uk-width-expand@m">
                            <label class="title">Number of Underage occupants:</label> 
                            <input type='int' name="minor_occupants" class="uk-input" value="0"><br />
                        </div>
                        </div>
                        <div>
                            <label class="title">Room To rent</label>
                            <input type='disabled' name="room_number" class="uk-input" value='<?php echo $selected_room_number; ?>'>
                             <span class="help-block"><?php echo  $selected_room_number_err; ?></span><label>
                            <?php  $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                $room_type = $row["room_type"];
                                $room_rate = $row["room_rate"];
                            }
                        }
                    }
 ?>                     </label>
                        </div id="submit">
                        <p>By clicking on "Submit", you have read and agreed to Hotel Dabaw's terms of service. If not, read the <a href="terms_of_service.php">terms of service here</a>.</p>
                   <input type='submit' name = 'submit' value='Submit Reservation' class="uk-button uk-button-primary uk-button-small" /> 
                   <input type="submit" name = "reset" value = "Reset" class="uk-button uk-button-primary uk-button-small"/> 
                   <a href="room_selection.php" class="uk-button uk-button-primary uk-button-small">Cancel</a>

        </form>
<div></div>
    <div id= "image_container">  
<div id="image">
<div class="uk-background-blend-multiply uk-background-primary">
    <img src="<?php echo $image_link; ?>" width =750px padding = 10px  class="uk-animation-scale-up">
    <div uk-grid>
         <h4>Room Type: <?php echo $room_type; ?></h4>
         <?php 
        if (preg_match("/(ingle)+/", $room_type)) {
            ?>
    <h4>Rate: Php 1000/ night<br/> Includes: 1 Single Bed, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
    <?php
         } 
        if (preg_match("/(ouble)+/", $room_type)) {
            ?>
    <h4>Rate: Php 2000/ night<br/> Includes: 2 Single Beds, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
           <?php
        }
        if (preg_match("/(amily)+/", $room_type)) {
            ?>
    <h4>Rate: Php 3000/ night<br/> Includes: 5 Single Beds/3 Bunk Beds, 2 Bathrooms, Visitor's lounge, Free access to the swimming pool </h4>
           <?php
        }
        ?>
    </div>

</div>
    <div class = "reserved_dates">

                <h3>This room is reserved on these dates:</h3> 
                <table cellpadding="10" cellspacing="2">
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
          </div>   

</div>
</div>
<?php  include("../includes/layouts/footer.php"); ?> 

