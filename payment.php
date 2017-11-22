<?php  include("../includes/layouts/public_header.php"); ?>
<?php 
require_once("../includes/functions.php"); ?>
<style type="text/css"> 
table{
  font-size: 20px;
  background-image: url("Images/BG/rooms_background.jpg");
    background-attachment: fixed;
    background-repeat: no-repeat;
    background-size: 100%;
    text-align: left;
}
</style>
  <style type="text/css">
 aside{
    text-align: left;
    width: 18%;
    border: 2px;
  }
   </style>
    
<div uk-grid>



          <aside>
            <h2>Nice people.Taking care of nice people</h2>
            <div class="img-box">
          
              
            </div>Welcome to your residence.
          
          
            <p>Change your view.</p>
      <p>Stay you.</p>
      <p>Relax, it's Hotel Dabaw.</p>
      <p>Stay with someone you know.</p>
      <p>The best surprise is no surprise.</p> 
          
          </aside>
          <!-- content -->
          <section class="uk-width-expand@m">
    <?php     $payment_account_number_err = "";
    $selected_room_number = $_GET["room_number"]; 
 $adult_occupants = "";

$client_fname = $client_lname= $client_address = $client_contact_number = $client_email = $payment_mode = $check_in_date = $check_out_date = $selected_room_number = $adult_occupants = ""; 
$client_fname_err =$client_lname_err = $client_address_err = $client_contact_number_err = $client_email_err = $payment_mode_err = $check_in_date_err = $check_out_date_err = $selected_room_number_err = $adult_occupants_err = ""; 
$credit_company = $payment_account_number="";
 $payment_account_number_err="";
$total_days = $total_fees= "";
$room_rate = "";
    $payment_mode      = $_COOKIE["payment_mode"];
    $bank_message = " ";

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
    $check_in_date    =$_COOKIE["check_in_date"];
    $check_out_date      =$_COOKIE["check_out_date"];
    $minor_occupants      =$_COOKIE["minor_occupants"];
    $adult_occupants      =$_COOKIE["adult_occupants"];
    $total_days = $_COOKIE["total_days"];
    $total_fees = $_COOKIE["total_fees"];
    $selected_room_number     = $_GET["room_number"]; 

  
}

include('config.php');
require_once("../includes/functions.php");
    if (isset($_POST["submit_payment"])) {
   switch ($payment_mode) {
       case "PayMaya":
            if (empty(trim($_POST["payment_account_number"]))) {
              $payment_account_number_err = "Please enter your 10-digit paymaya account number";
            }
           elseif (strlen(trim($_POST["payment_account_number"])) != 10) {
              $payment_account_number_err = "Your paymaya account number should be 10 digits.";
           }
           else{
              	 $payment_account_number = trim($_POST["payment_account_number"]);
                die(print_reservation($client_fname, $client_lname , $client_address , $client_contact_number , $client_email , $check_in_date , $check_out_date ,  $payment_mode , $selected_room_number , $adult_occupants , $minor_occupants , $credit_company , $payment_account_number , $total_days , $total_fees));

           }

           break;
       
       case "Paypal":
            if (empty(trim($_POST["payment_account_number"]))) {
              $payment_account_number_err = "Please enter your 10-digit Paypal account number";
            }
           elseif (strlen(trim($_POST["payment_account_number"])) !=10) {
              $payment_account_number_err = "Your Paypal account number should be 10 digits.";
           }
           else{
   	 $payment_account_number = trim($_POST["payment_account_number"]);
      
        die(print_reservation($client_fname, $client_lname , $client_address , $client_contact_number , $client_email , $check_in_date , $check_out_date ,  $payment_mode , $selected_room_number , $adult_occupants , $minor_occupants , $credit_company , $payment_account_number , $total_days , $total_fees));
           }

           break;
        case "Credit Card":
         switch ($_POST["credit_company"]) {
            case "1":
                $credit_company = "BPI";
                break;
            case "2":
                $credit_company = "BDO";
                break;
             case "3":
                $credit_company = "China Bank";
                break;
            
            default:
                # code...
                break;
        }
            if (empty(trim($_POST["payment_account_number"]))) {
              $payment_account_number_err = "Please enter your 16-digit Credit card number";
            }
           elseif (strlen(trim($_POST["payment_account_number"])) !=16) {
              $payment_account_number_err = "Your Credit card number should be 16 digits.";
           }
           else{
   	 $payment_account_number = trim($_POST["payment_account_number"]);
                die(print_reservation($client_fname, $client_lname , $client_address , $client_contact_number , $client_email , $check_in_date , $check_out_date ,  $payment_mode , $selected_room_number , $adult_occupants , $minor_occupants , $credit_company , $payment_account_number , $total_days , $total_fees));

         }


           break;
           case "4":

                break;
           default:
           break;
   }
}
 ?>


    <div> 
            <form action = 'payment.php?room_number=<?php echo $selected_room_number;?>' method='post' class="uk-form-horizontal">
            <div>
    <?php
switch ($payment_mode) {
        case "PayMaya":
            ?>
                <label class="uk-form-label">Please Enter your Paymaya account number: </label>
                 <input type="text" name="payment_account_number" class="uk-input" value="">
                <span class="help-block"><?php echo $payment_account_number_err; ?></span>
                </div>
            <div>
                   <input type='submit' name = 'submit_payment'  value='Submit Reservation' class="uk-button uk-button-primary uk-button-small" /> 
                   <input type="submit" name = "reset" value = "Reset" class="uk-button uk-button-primary uk-button-small"/> 
                   <a href="room_selection.php" class="uk-button uk-button-primary uk-button-small">Cancel</a>
            </div>
            </form>

            </div>
            <?php
            break;
        
        case "Paypal":
           ?>
                <label class="uk-form-label">Please Enter your PayPal account number: </label>
               <input type="text" name="payment_account_number" class="uk-input" value="">
                <span class="help-block"><?php echo $payment_account_number_err; ?></span>
                </div>
            <div>
                   <input type='submit' name = 'submit_payment'  value='Submit Number' class="uk-button uk-button-primary uk-button-small" /> 
                   <input type="submit" name = "reset" value = "Reset" class="uk-button uk-button-primary uk-button-small"/> 
                   <a href="room_selection.php" class="uk-button uk-button-primary uk-button-small">Cancel</a>
            </div>
            </form>

            </div>
            <?php
            break;
        case "Credit Card":
           ?>
            <div>
                <label class="uk-form-label">Please Select Credit Company</label>
                <select name="credit_company" class="uk-select">
                <option value="1">BPI</option>
                <option value="2">BDO</option>
                <option value="3">China Bank</option>
                </select>
            </div>
            <div>
                <label class="uk-form-label">Please Enter your credit card number: </label>
                 <input type="text" name="payment_account_number" class="uk-input" value="">
                <span class="help-block"><?php echo $payment_account_number_err; ?></span>
                </div>
            <div>
                   <input type='submit' name = 'submit_payment' value='Submit Number' class="uk-button uk-button-primary uk-button-small" /> 
                   <input type="submit" name = "reset" value = "Reset" class="uk-button uk-button-primary uk-button-small"/> 
                   <a href="room_selection.php" class="uk-button uk-button-primary uk-button-small">Cancel</a>

            </div>
            </form>

            </div>
            </div>
            <?php
            break;
        case "Bank":
        $sql = "INSERT INTO client_info (client_fname, client_lname, client_address, contact_number, email_address,check_in_date,check_out_date,payment_mode, room_number, adult_occupants, minor_occupants,total_days, total_fees) values ('$client_fname', '$client_lname' ,'$client_address', '$client_contact_number','$client_email', '$check_in_date','$check_out_date',' $payment_mode','$selected_room_number',  '$adult_occupants', '$minor_occupants', '$total_days', '$total_fees')";
        $result = mysqli_query($link, $sql);
        confirm_query($result);

         $bank_message = "Please deposit your fees to this BPI account number: <br />  589561 - 7526 - 0726 - 55 and present the receipt or bank notification during check-in";

        die(print_reservation($client_fname, $client_lname , $client_address , $client_contact_number , $client_email , $check_in_date , $check_out_date ,  $payment_mode , $selected_room_number , $adult_occupants , $minor_occupants , $credit_company , $payment_account_number , $total_days , $total_fees));

             break;       

    }    


//-----------------------------------------------------------------------------------------
  ?>

<?php function print_reservation($client_fname, $client_lname , $client_address , $client_contact_number , $client_email , $check_in_date , $check_out_date ,  $payment_mode , $selected_room_number , $adult_occupants , $minor_occupants , $credit_company , $payment_account_number , $total_days , $total_fees){
	global $link;
	global $bank_message;
	?>
	 <table>
        <tr>
            <th>Name:</th>
            <td> <?php echo $client_fname. " ".$client_lname; ?></td>
        </tr>
        <tr>
            <th>Address:</th>
            <td> <?php echo $client_address; ?></td>
        </tr>
        <tr>
            <th>Contact Number:</th>
            <td> <?php echo $client_contact_number; ?></td>
        </tr>
        <tr>
            <th>Email Address :</th>
            <td> <?php echo $client_email; ?></td>
        </tr>
        <tr>
            <th>Room to rent :</th>
            <td> <?php echo $selected_room_number; ?></td>
        </tr>
        <tr>
            <th>Room type :</th>
            <td> <?php  $sql = "SELECT * FROM rooms where room_number = '$selected_room_number'";
            if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                $room_type = $row["room_type"];
                                echo $room_type;
                            }
                        }
                    }; ?></td>
        </tr>
        <tr>
            <th>Check-in date :</th>
            <td> <?php echo $check_in_date; ?></td>
        </tr>
        <tr>
            <th>Check-out date :</th>
            <td> <?php echo $check_out_date; ?></td>
        </tr>
        <tr>
            <th>Number of Occupants :</th>
            <td> <?php echo $adult_occupants + $minor_occupants; ?></td>
        </tr>
        <tr>
            <th>Total Days to check in :</th>
            <td> <?php echo $total_days; ?></td>
        </tr>
        <tr>
            <th>Total Fees :</th>
            <td> <?php echo "Php ".$total_fees.".00"; ?></td>
        </tr>
        <tr>
            <th>Payment Scheme :</th>
            <td> <?php echo $payment_mode; ?></td>
        </tr>
       <?php if ($payment_mode !="Bank") {
       	if ($payment_mode == "Credit Card") {
       		?>
       	<tr>
            <th>Credit Company :</th>
            <td> <?php echo $credit_company; ?></td>
        </tr>
        <?php
       	}
       	?>
       	 <tr>
            <th>Account Number:</th>
            <td> <?php echo $payment_account_number; ?></td>
        </tr>
       	<?php
       } ?>
       
    </table>


	<?php
echo "<p>".$bank_message."</p>";
?>
 <div>
 <p>Reservation Successful. Thank you for trusting us!</p>
 </div>
<?php
         $sql = "SELECT * FROM client_info where room_number = '$selected_room_number' && client_fname = '$client_fname' && client_lname = '$client_lname' && check_in_date = '$check_in_date' && check_out_date = '$check_out_date'";
            if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result)  > 0){
                             die("<p>You have already made a reservation for this room on this date. Please <a href='room_selection.php'> Select another room</a><br/>  Go back to <a href='index.php'>Hotel Dabaw Home</a> page or go back to <a href='room_selection.php'> Selecting Rooms</a>.</p>
");
                        }
                        else{
                        	  $sql = "INSERT INTO client_info (client_fname, client_lname, client_address, contact_number, email_address,check_in_date,check_out_date,payment_mode, room_number, adult_occupants, minor_occupants,credit_company, payment_account_number,total_days, total_fees) values ('$client_fname', '$client_lname' ,'$client_address', '$client_contact_number','$client_email', '$check_in_date','$check_out_date',' $payment_mode','$selected_room_number',  '$adult_occupants', '$minor_occupants', '$credit_company', '$payment_account_number', '$total_days', '$total_fees')";
     
        $result = mysqli_query($link, $sql);
        confirm_query($result);    
                        }

                    }

         $sql = "SELECT * FROM client_info where room_number = '$selected_room_number' && client_fname = '$client_fname' && client_lname = '$client_lname' && check_in_date = '$check_in_date' && check_out_date = '$check_out_date'";
            if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                $client_number = $row["client_number"];
                                echo "<p>Your reservation number is ". $client_number."<br/>  Go back to <a href='index.php'>Hotel Dabaw Home</a> page or go back to <a href='room_selection.php'> Selecting Rooms</a>.</p>";
                            }
                        }

                    }

?>

</section>

</div>
<?php

}

 ?>

<?php  include("../includes/layouts/footer.php"); ?> 
