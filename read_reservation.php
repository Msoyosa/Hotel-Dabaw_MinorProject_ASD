<?php session_start(); ?>
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); ?> 
<?php  include("../includes/layouts/header.php"); ?>
<link rel="stylesheet" href="css/uikit.min.css">
<script src = "js/uikit.min.js"></script>
<div id="page">
        <h2>View Reservation</h2>
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
	<p> You are logged in, user <b><?php echo $_SESSION["username"];?> </b> <a href="profile.php?sessionID=$_SESSION[id]">[View Account Details]</a> </p>
	<p><a href="log-out.php?sessionID=$_SESSION[id]">[Log out]</a> </p>

<?php 
 print_navigation();
if(isset($_GET["client_number"])){
    $client_number = $_GET["client_number"];
     $sql = "SELECT * FROM client_info where client_number = '$client_number'";
                           if($result = mysqli_query($link, $sql)){
                            if(mysqli_num_rows($result) > 0){
                             while($row = mysqli_fetch_assoc($result)){
                                
    $client_fname   = $row['client_fname'];    
    $client_lname   = $row['client_lname'];
    $client_address  = $row['client_address'];
    $client_contact_number = $row["contact_number"];
    $client_email   = $row["email_address"];
    $payment_mode      = $row["payment_mode"];
    $check_in_date    =$row["check_in_date"];
    $check_out_date      =$row["check_out_date"];
    $room_number     = $row["room_number"];     
    $adult_occupants = $row["adult_occupants"];
    $minor_occupants = $row["minor_occupants"];
    $payment_account_number = $row["payment_account_number"];
    $credit_company = $row["credit_company"];
    $total_days = $row["total_days"];
    $total_fees = $row["total_fees"];
                        }
                    }
  }
 ?>
<div>
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
            <td> <?php echo $room_number; ?></td>
        </tr>
        <tr>
            <th>Room type :</th>
            <td> <?php  $sql = "SELECT * FROM rooms where room_number = '$room_number'";
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

</div>
<div>
                <a href="update_reservation.php?client_number=<?php echo urlencode($client_number);?>"><img src="Images/Buttons/update.ico"></a>
                <a href="delete_reservation.php?client_number=<?php echo urlencode($client_number);?>" ><img src="Images/Buttons/delete.ico"></a>
</div>
<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------
			}
    }
			?>
<?php  include("../includes/layouts/footer.php"); ?> 