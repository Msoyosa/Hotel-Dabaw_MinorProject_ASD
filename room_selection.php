
<?php  include("../includes/config.php"); ?>
<?php require_once("../includes/functions.php"); 
?> 
<?php  include("../includes/layouts/public_header.php"); ?>

<!DOCTYPE html>
    <style type="text/css"> 
.title { float: left; width: 100px; text-align: right; padding-right: 10px;} 
.submit { text-align: right;} 
#content{ 
  float: left; 
}


   body{ font-family: Arial, Verdana, sans-serif; color: #665544; background-color: #ffffcc;
 } 
 
 .table {width: 23%; float: left; margin: 5px; padding: 5px; 
     border: 1px solid #665544; background-image: url("Images/BG/room_background.jpg");
background-position: center;
    background-attachment: fixed; opacity: 50%;

      }

    .nav{
    width: 50%; float: left;
    }
    #single, #double, #family{
        float: left; margin: 10px; clear: both;
         border: 1px solid #665544;  
    }
    #dates{
      width: 300px;
    }
.d, .s, .f{
  margin: 10px;
  width: 100%; 
  border: 1px;
    text-align: center;}
p{
  font-size: 25px;
}
form{
  background-color: #cccccc;
}
.after-header{
  width: 500px;
  text-align: center;
  margin-left: 415px;
  top: 50%;
}
.button1, .button2, .button3{
margin-left: 500px;}


</style>

<?php 
//Dontats------------------------------------------------------------------------------------------------------------------------------
    $custcheck_in_date="";
    $custcheck_out_date= "";
    $check_in_date_err="";
    $check_out_date_err="";
 $cmessage ="";
 $client_fname   = "";
    $client_lname   = "";
    $client_address  = "";
    $client_contact_number = "";
    $client_email   = "";
    $payment_mode      = "";
    $check_in_date    = "";;
    $check_out_date      = "";
    $today = time();
if(isset($_POST["submit"])){
     $custcheck_in_date="";
    $custcheck_out_date= "";
    $check_in_date_err="";

    $check_out_date_err="";


    $client_fname   = "";
    $client_lname   = "";
    $client_address  = "";
    $client_contact_number = "";
    $client_email   = "";
    $payment_mode      = "";
    $check_in_date    = "";;
    $check_out_date      = "";
    $today = time();

    $client_fname   = $_POST["client_fname"];
    $client_lname   = $_POST["client_lname"];
    $client_address  = $_POST["client_address"];
    $client_contact_number = $_POST["client_contact_number"];
    $client_email   = $_POST["client_email"];
    $payment_mode      = $_POST["payment_mode"];
    $check_in_date    = $_POST["check_in_date"];
    $check_out_date      = $_POST["check_out_date"];
    $custcheck_in_date= $check_in_date ;
    $custcheck_out_date= $check_out_date ;
    
    $cclient_fname = "client_fname";
    $cclient_lname = "client_lname";
    $cclient_address  ="client_address";
    $cclient_contact_number = "client_contact_number";
    $cclient_email   ="client_email";
    $cpayment_mode  =   "payment_mode" ;
  $ccheck_in_date = "check_in_date";
    $ccheck_out_date = "check_out_date";


        $expire = time()+ (60*60*24*7);
        setcookie($cclient_fname, $client_fname,$expire);
        setcookie($cclient_lname, $client_lname,$expire);
        setcookie($cclient_address, $client_address,$expire);
        setcookie($cclient_contact_number, $client_contact_number,$expire);
        setcookie($cclient_email, $client_email,$expire);
        setcookie($cpayment_mode, $payment_mode,$expire);

     setcookie( $ccheck_in_date, $custcheck_in_date,$expire);
        setcookie( $ccheck_out_date, $custcheck_out_date,$expire);
     
}

            ?>
      
<div class="after-header">

<p> If you want to search available rooms efficiently,<br/> please specify your check-in and check-out dates: </p>

    <form action = "room_selection.php" method="post">
<div>
    <label>Check in:</label> 
    <input type="date" name="custcheck_in_date"/ class="uk-input" value="<?php echo $custcheck_in_date; ?>" > <br />
    <span class="help-block"><?php echo  $custcheck_in_date; ?></span>

</div>
<div>
    <label>Check out:</label> 
    <input type="date" name="custcheck_out_date"/ class="uk-input" value="<?php echo $custcheck_out_date;  ?>"><br />
    <span class="help-block"><?php echo $custcheck_out_date; ?></span>

 </div>  
   
    <input type="submit" name = "datesSubmit" value="Check and Select Available Rooms" class="uk-button uk-button-secondary uk-button-small"/> <br/><br/>

</form> 

</div>
<div></div>

<?php  



if(isset($_GET["room_number"])){
    $selected_room_number = $_GET["room_number"];
    $croom_number = "selected_room_number";
      setcookie($croom_number, $selected_room_number,$expire);


}
if(!isset($_POST["datesSubmit"])){ 
   $custcheck_in_date="";
    $custcheck_out_date= "";
    $check_in_date_err="";

    $check_out_date_err="";
}
if (isset($_POST["datesSubmit"])) {
    if (!empty(trim($_POST["custcheck_in_date"])) && !empty(trim($_POST["custcheck_out_date"]))) {
           $custcheck_in_date= $_POST["custcheck_in_date"];
           $custcheck_out_date= $_POST["custcheck_out_date"];
          $cmessage =  "<p>Check-in dates: ". $custcheck_in_date ." - ". $custcheck_out_date."<p>";

        ?>
        <div class="button1">
        <button type="button" class="uk-button uk-button-secondary uk-button-large">Hover to Show Bedroom Types </button>
<div  uk-dropdown="animation: uk-animation-slide-top-small; duration: 1000"> 
<ul class="uk-nav uk-dropdown-nav">
    <li><a href="room_selection.php#single">Single Bedrooms</a></li>
    <li><a href="room_selection.php#double">Double Bedrooms</a></li>
    <li><a href="room_selection.php#family">Family Bedrooms</a></li>

</ul>
</div>
</div>
<br/>
<div class="s">
      <h2>Single Bedrooms</h2>
    <h4>Rate: Php 1000/ night<br/> Includes: 1 Single Bed, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="single"   class="uk-grid-match" uk-grid>
         

            <?php 
 
$sql = "SELECT * FROM rooms where room_type='Single Bedroom'";
       print_specified_room($sql);           
    ?>

</div>
<div>
<a href="#top">Back to top</a>
</div>
</div>
 </div>
 <div class="d">
      <h2>Double Bedrooms</h2>
    <h4>Rate: Php 2000/ night<br/> Includes: 2 Single Beds, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
<div  class="uk-grid-match" uk-grid>
<div>
  <div id="double"  class="uk-grid-match" uk-grid>
      <?php 
      ?>
      
            <?php  

$sql = "SELECT * FROM rooms where room_type='Double Bedroom'";
       print_specified_room($sql);

?>
      </div>
      <div>
      <a href="#top">Back to top</a>
    </div>
</div>
  
</div>
<div class="f">
      <h2>Family Bedrooms</h2>

    <h4>Rate: Php 3000/ night<br/> Includes: 5 Single Beds/3 Bunk Beds, 2 Bathrooms, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="family"  class="uk-grid-match" uk-grid>


            <?php  

$sql = "SELECT * FROM rooms where room_type='Family Bedroom'";
       print_specified_room($sql);
                    // Close connection
                    mysqli_close($link);
?>
</div>
<div>
<a href="#top">Back to top</a>

    </div>

  </div>
</div>
</div>
  <?php
   

    }   


    else{
    $custcheck_in_date="";
    $custcheck_out_date= "";


    $custcheck_in_date=$check_in_date;
    $custcheck_out_date= $check_out_date;


        ?>
        <div class="button2">
        <button type="button" class="uk-button uk-button-secondary uk-button-large">Hover to Show Bedroom Types </button>
<div  uk-dropdown> 
<ul class="uk-nav uk-dropdown-nav">
    <li><a href="room_selection.php#single">Single Bedrooms</a></li>
    <li><a href="room_selection.php#double">Double Bedrooms</a></li>
    <li><a href="room_selection.php#family">Family Bedrooms</a></li>

</ul>
</div>
</div>
<br/>

<div class="s">
      <h2>Single Bedrooms</h2>
    <h4>Rate: Php 1000/ night<br/> Includes: 1 Single Bed, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="single"   class="uk-grid-match" uk-grid>

            <?php 
     $sql = "SELECT * FROM rooms where room_type='Single Bedroom'";
       print_specified_room($sql);
    ?>

</div>
<div>
<a href="#top">Back to top</a>
</div>
</div>
</div>
<div class="d">
      <h2>Double Bedrooms</h2>
    <h4>Rate: Php 2000/ night<br/> Includes: 2 Single Beds, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
<div  class="uk-grid-match" uk-grid>
<div>
  <div id="double"  class="uk-grid-match" uk-grid>
            <?php  
$sql = "SELECT * FROM rooms where room_type='Double Bedroom'";
       print_specified_room($sql);

?>
      </div>
      <div>
      <a href="#top">Back to top</a>
    </div>
</div>
  </div>
</div>

  <div class="f">
      <h2>Family Bedrooms</h2>
    <h4>Rate: Php 3000/ night<br/> Includes: 5 Single Beds/3 Bunk Beds, 2 Bathrooms, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="family"  class="uk-grid-match" uk-grid>



            <?php  
 $sql = "SELECT * FROM rooms where room_type='Family Bedroom'";
       print_specified_room($sql);
                    // Close connection
                    mysqli_close($link);
?>
</div>
<div>
<a href="#top">Back to top</a>

    </div>

  </div>
</div>
</div>
  <?php
   
        }

    }
elseif(empty($custcheck_in_date) && empty($custcheck_out_date)){
    $custcheck_in_date="";
    $custcheck_out_date= "";


    $custcheck_in_date=$check_in_date;
    $custcheck_out_date= $check_out_date;


        ?>
        <div class="button3">
        <button type="button" class="uk-button uk-button-secondary uk-button-large">Hover to Show Bedroom Types </button>
<div  uk-dropdown> 
<ul class="uk-nav uk-dropdown-nav">
    <li><a href="room_selection.php#single">Single Bedrooms</a></li>
    <li><a href="room_selection.php#double">Double Bedrooms</a></li>
    <li><a href="room_selection.php#family">Family Bedrooms</a></li>

</ul>
</div>
</div>
<br/>

<div class="s">
      <h2>Single Bedrooms</h2>
    <h4>Rate: Php 1000/ night<br/> Includes: 1 Single Bed, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="single"   class="uk-grid-match" uk-grid>

            <?php 
     $sql = "SELECT * FROM rooms where room_type='Single Bedroom'";
       print_room($sql);
    ?>

</div>
<div>
<a href="#top">Back to top</a>
</div>
</div>
</div>
<div class="d">
      <h2>Double Bedrooms</h2>

    <h4>Rate: Php 2000/ night<br/> Includes: 2 Single Beds, 1 Bathroom, Visitor's lounge, Free access to the swimming pool </h4>

      </div>
<div  class="uk-grid-match" uk-grid>
<div>
  <div id="double"  class="uk-grid-match" uk-grid>
            <?php  
$sql = "SELECT * FROM rooms where room_type='Double Bedroom'";
       print_room($sql);

?>
      </div>
      <div>
      <a href="#top">Back to top</a>
    </div>

  </div>
</div>

 <div class="f">
      <h2>Family Bedrooms</h2>
    <h4>Rate: Php 3000/ night<br/> Includes: 5 Single Beds/3 Bunk Beds, 2 Bathrooms, Visitor's lounge, Free access to the swimming pool </h4>
      </div>
  <div  class="uk-grid-match" uk-grid>
  <div>
  <div id="family"  class="uk-grid-match" uk-grid>

            <?php  
 $sql = "SELECT * FROM rooms where room_type='Family Bedroom'";
       print_room($sql);
                    // Close connection
                    mysqli_close($link);
?>
</div>
<div>
<a href="#top">Back to top</a>

    </div>
</div>
  
</div>
</div>
  <?php
   
     }


     ?>


<?php
//Dontats------------------------------------------------------------------------------------------------------------------------------

      
            ?>

<?php  
function print_specified_room($sql){
    global $link;
        $custcheck_in_date="";
    $custcheck_out_date= "";
    $check_in_date_err="";

    $check_out_date_err="";

    $custcheck_in_date = $_POST["custcheck_in_date"];
    $custcheck_out_date = $_POST["custcheck_out_date"];

$result = mysqli_query($link, $sql);
confirm_query($result);      
while($rooms = mysqli_fetch_assoc($result)){


//var_dump($rooms); 
//echo "<hr/>";
$rm = $rooms["room_number"];
//echo $rm."----";
?>


                <div class="table">
                <h5><?php  echo "<img src='".$rooms['image_link']."'width=100%  />";?><br/>
                Room Number: <?php  echo $rooms["room_number"]?><br/>
                Room Type:<?php  echo $rooms["room_type"]?><br/>
                Room Rate:<?php  echo $rooms["room_rate"]?><br/> 
<?php
$sql2="SELECT client_number, check_in_date,check_out_date FROM client_info where room_number = '$rm'";
$result2 = mysqli_query($link, $sql2);
confirm_query($result2);     
if (mysqli_num_rows($result2)==0) {
    ?>
     <a href="reservation_form_processing.php?room_number=<?php echo urlencode($rooms["room_number"]);?>" class="uk-button uk-button-secondary uk-button-medium" > View and Reserve This Room</a>

    <?php

}
else{


while ($reservations = mysqli_fetch_assoc($result2)){
        if((strtotime($custcheck_in_date) >= strtotime($reservations["check_in_date"])) && (strtotime($custcheck_in_date) <= strtotime($reservations["check_out_date"])))  {
            ?>
                
                            
                  <button class="uk-button uk-button-default" disabled> This room is not available on your check in date</h5></button>
                         <h5><?php 
                            if(isset($_GET["room_number"])){
                                $selected_room_number =$_GET["room_number"];                                                    
                            }
                            else{
                                $selected_room_number =null;
                            }    
                                ?></h5>
                
                
               
            <?php
            break;
        }
        if((strtotime($custcheck_out_date) >= strtotime($reservations["check_in_date"])) && (strtotime($custcheck_out_date) <= strtotime($reservations["check_out_date"])))  {
           ?>
              
                  <button class="uk-button uk-button-default" disabled> This room is not available on your check in date</h5></button>
                         <?php 
                            if(isset($_GET["room_number"])){
                                $selected_room_number =$_GET["room_number"];                                                    
                            }
                            else{
                                $selected_room_number =null;
                            }    
                                ?>
                
            
           <?php
       break;
        } 
        if ((strtotime($custcheck_in_date) <= strtotime($reservations["check_in_date"])) && (strtotime($custcheck_out_date) >= strtotime($reservations["check_out_date"]))) {
          ?>
                  <button class="uk-button uk-button-default" disabled> This room is not available on your check in date</h5></button>
                         <?php 
                            if(isset($_GET["room_number"])){
                                $selected_room_number =$_GET["room_number"];                                                    
                            }
                            else{
                                $selected_room_number =null;
                            }    
                                ?>
          <?php
          break;
        }
        else{
?>
    
                  
                  <a href="reservation_form_processing.php?room_number=<?php echo urlencode($rooms["room_number"]);?>" class="uk-button uk-button-secondary uk-button-medium" > View and Reserve This Room</a></h5>
                         <?php 
                            if(isset($_GET["room_number"])){
                                $selected_room_number =$_GET["room_number"];                                                    
                            }
                            else{
                                $selected_room_number =null;
                            }    
                                ?>
                


<?php
break;
        }
       
}
}
?>
 </div>

<?php
}

        
}

function print_room($sql){
    global $link;
        $custcheck_in_date="";
    $custcheck_out_date= "";
    $check_in_date_err="";

    $check_out_date_err="";

    $custcheck_in_date = "";
    $custcheck_out_date ="";
$result = mysqli_query($link, $sql);
confirm_query($result);      
while($rooms = mysqli_fetch_assoc($result)){


//var_dump($rooms); 
//echo "<hr/>";
$rm = $rooms["room_number"];
//echo $rm."----";
?>

             
                <div class="table">
                <h5><?php  echo "<img src='".$rooms['image_link']."'width=100%  />";?><br/>
                Room Number: <?php  echo $rooms["room_number"]?><br/>
                Room Type:<?php  echo $rooms["room_type"]?><br/>
                Room Rate:<?php  echo $rooms["room_rate"]?><br/>  
                  <a href="reservation_form_processing.php?room_number=<?php echo urlencode($rooms["room_number"]);?>" class="uk-button uk-button-secondary uk-button-medium" > View and Reserve This Room</a></h5>
                         <?php 
                            if(isset($_GET["room_number"])){
                                $selected_room_number =$_GET["room_number"];                                                    
                            }
                            else{
                                $selected_room_number =null;
                            }    
                                ?>
            </div>

<?php
}

        
}
?>

<?php  include("../includes/layouts/footer.php"); ?> 