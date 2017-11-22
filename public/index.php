<?php  include("../includes/layouts/public_header.php"); ?>
<?php 
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
    
    $client_fname= "";
    $client_lname = "";
    $client_address  ="";
    $client_contact_number = "";
    $client_email   ="";
    $payment_mode  =   "" ;
    $check_in_date   = "";
    $check_out_date  =  ""  ;
    $adult_occupants = "";
    $minor_occupants = "";
    $total_days = "";
    $total_fees = "";

       $expire = time()-86400;
        setcookie($cclient_fname, $client_fname,$expire);
        setcookie($cclient_lname,$client_lname,$expire);
        setcookie($cclient_address, $client_address,$expire);
        setcookie($cclient_contact_number, $client_contact_number,$expire);
        setcookie($cclient_email, $client_email,$expire);
        setcookie($cpayment_mode, $payment_mode,$expire);
        setcookie($ccheck_in_date, $check_in_date,$expire);
        setcookie($ccheck_out_date, $check_out_date,$expire);
        setcookie($aadult_occupants,$adult_occupants,$expire);
        setcookie($mminor_occupants, $minor_occupants,$expire);
        setcookie($ttotal_days, $total_days,$expire);
        setcookie($ttotal_fees, $total_fees,$expire); 
 ?>
<style type="text/css">
  label{
    color: black;
  }
  form{
    background-color: #cccccc;
    width: 20%;
    margin: 10px;
  }
  label{

    color: white;
    background-color: #330000;
  }
  aside{
    text-align: right;
    width: 18%;
    border: 2px;
  }
  .center{
    width: 50%;
  }

</style>
<div uk-grid>
  

            <form action="room_selection.php" method="post" >
            <div>
                        <input type="submit" name = "submit" value="Check and Select Available Rooms"  class="uk-button uk-button-secondary"  /> 
                        </div>
                    <div >
                            <label class="title">First Name:</label> <br/>
                            <input type="text" name="client_fname" class="uk-input" value=" "><br/>
                        </div>
                        <div >
                            <label class="title">Last Name</label><br/>
                            <input type="text" name="client_lname" class="uk-input" value=" "><br/>
                        </div>
                        <div >
                            <label  class="title">Address</label><br/>
                             <input type="text" name="client_address" class="uk-input" value=" "><br/>
                        </div>
                        <div >
                            <label class="title">Contact Number</label><br/>
                            <input type="text" name="client_contact_number" class="uk-input" value=" "><br/>
                        </div>
                        <div>
                            <label class="title">E-mail</label><br/>
                            <input type="text" name="client_email" class="uk-input" value=" "><br/>
                        </div>

                        <div>
                            <label class="title">Payment mode</label><br/>
                            <select name="payment_mode" class="uk-select">
                            <option value="1">PayMaya</option>
                            <option value="2">Paypal</option>
                            <option value="3">Credit Card</option>
                            <option value="4">Bank</option>
                            </select>
                        </div>

                        <div>
                         <label class="title">Check in:</label> <br/>
                     <input type="date" name="check_in_date" class="uk-input" value=" " ><br/>
                        </div>
                        <div>
                          <label class="title">Check out:</label><br/>
                     <input type="date" name="check_out_date" class="uk-input" value=" "> <br/>
                        </div>                      
                        
    </form>
    <div class="uk-width-expand@m">
        

<div class="uk-flex-center" uk-grid>
<div class="uk-animation-toggle">
    <div class="uk-flex-first"> 
            <img class="uk-animation-fade uk-transform-origin-bottom-right" width=200px height = 150px src="Images/slideshow_images/1.jpg">
   </div>
   </div>
   <div class="uk-animation-toggle">
       <div class="uk-flex-second"> 
        <img class="uk-animation-fade uk-transform-origin-top-center" width=200px height = 150px src="Images/slideshow_images/2.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-third"> 
        <img class="uk-animation-fade uk-transform-origin-bottom-center" width=200px height = 150px src="Images/slideshow_images/3.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-fourth"> 
        <img class="uk-animation-fade uk-transform-origin-top-center" width=200px height = 150px src="Images/slideshow_images/4.jpg">
        </div>
        </div>
<div class="uk-animation-toggle">
    <div class="uk-flex-fifth"> 
        <img class="uk-animation-fade uk-transform-origin-bottom-right" width=200px height = 150px src="Images/slideshow_images/5.jpg">
        </div>
        </div>
 
</div>
</div>
 <aside>
            <h2>Nice people taking care of nice people.</h2>
        Welcome to your residence.
          
          
            <p>Change your view.</p>
      <p>Stay you.</p>
      <p>Relax, it's Hotel Dabaw.</p>
      <p>Stay with someone you know.</p>
      <p>The best surprise is no surprise.</p> 
          
          </aside>    
</div>
<?php  include("../includes/layouts/footer.php"); ?> 
