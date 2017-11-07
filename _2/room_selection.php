<!DOCTYPE html>
<html>
<head>
	<title>
	Available Rooms
	</title>
				<link rel="stylesheet" href="css/uikit.min.css">

</head>
	<script src = "js/uikit.min.js"></script>

<body>


	<div id="top">
		<a href="#single"><h3>Single Bedrooms</h3></a>
	</div>
	<div>
		<a href="#double"><h3>Double Bedrooms</h3></a>
	</div>
	<div>
		<a href="#family"><h3>Family / Bunk Bedrooms</h3></a>
	</div>

<div>
	<div>
	<div id="single">
			<?php 
			echo "<h2>Single Bedrooms</h2>";
			echo "Rate: Php 1000/ night";
			?>
		</div>

	<?php 

	include('config.php');
	 $sql = "SELECT * FROM rooms where room_type='Single Bedroom'";
	    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Room Number</th>";
                                        echo "<th>Room Type</th>";
                                        echo "<th>Room Rate</th>";


                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['room_number'] . "</td>";
                                        echo "<td>" . $row['room_type'] . "</td>";
                                        echo "<td>" . $row['room_rate'] . "</td>";
                                        //echo "<td><a href='privacy_policy.php'> Reserve this room </a> </td>";
                               			echo "<td> <img src='".$row['image_link']."' height = 100 width = 150/> </td>";
                               			echo "<td> <button uk-toggle='target: #my-id' type='button'>More Detailed photo</button>

                                        		<div id='my-id' uk-modal>
    											<div class='uk-modal-dialog uk-modal-body'>
        										<h2 class='uk-modal-title'></h2>
        										<button type='button'><a href='reservation_form.php'> Reserve this room.</a></button>
        										<button class='uk-modal-close' type='button'>Close</button>
   												 </div>
												</div></td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } else{
                            echo "<p class='lead'><em>No lodi(s) were found.</em></p>";
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                   
	?>


<a href="#top">Back to Top</a>
	
</div>

	<div>
	<div id="double">
			<?php 
			echo "<h2>Double Bedrooms</h2>";
			echo "Rate: Php 2000/ night";
			?>
		</div>
<?php  
$sql = "SELECT * FROM rooms where room_type='Double Bedroom'";
	    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Room Number</th>";
                                        echo "<th>Room Type</th>";
                                        echo "<th>Room Rate</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                        echo "<td>" . $row['room_number'] . "</td>";
                                        echo "<td>" . $row['room_type'] . "</td>";
                                        echo "<td>" . $row['room_rate'] . "</td>";
                                       // echo "<td><a href='privacy_policy.php'> Reserve this room </a> </td>";
                                        echo "<td> <img src='".$row['image_link']."' height = 100 width = 150/> </td>";
                                        echo "<td> <button uk-toggle='target: #my-id' type='button'>More Detailed photo</button>

                                        		<div id='my-id' uk-modal>
    											<div class='uk-modal-dialog uk-modal-body'>
        										<h2 class='uk-modal-title'></h2>
        										<button type='button'><a href='reservation_form.php'> Reserve this room.</a></button>
        										<button class='uk-modal-close' type='button'>Close</button>
   												 </div>
   												 </div>
												</div></td>";
                                        echo "";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        }
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

?>


<a href="#top">Back to Top</a>
	
</div>

	<div>
	<div id="family">
			<?php 
			echo "<h2>Family / Bunk Bedrooms</h2>";
			echo "Rate: Php 1000/ Adult, Php 500/ Underage ";
			?>
		</div>
<?php  
 $sql = "SELECT * FROM rooms where room_type='Family Bedroom'";
	    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
                                        echo "<th>Room Number</th>";
                                        echo "<th>Room Type</th>";
                                        echo "<th>Room Rate</th>";
                                    echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while($row = mysqli_fetch_array($result)){

                                    echo "<a href <tr>";
                                        echo " <td>" . $row['room_number'] . "</td>";
                                        echo "<td>" . $row['room_type'] . "</td>";
                                        echo "<td>" . $row['room_rate'] . "</td>";
                                        echo "<td> <img src='".$row['image_link']."' height = 100 width = 150/> </td>";
                                        echo "<td> <button uk-toggle='target: #my-id' type='button'>More Detailed photo</button>

                                        		<div id='my-id' uk-modal>
    											<div class='uk-modal-dialog uk-modal-body'>
        										<h2 class='uk-modal-title'></h2>
        										<img src='".$row['image_link']."' height = 100 width = 150/>
        										<button type='button'><a href='reservation_form.php'> Reserve this room.</a></button>
        										<button class='uk-modal-close' type='button'>Close</button>
   												 </div>
   												 </div>
												</div></td>";
                                        
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                            echo "</table>";
                            // Free result set
                            mysqli_free_result($result);
                        } 

                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($link);
                    }

                    // Close connection
                    mysqli_close($link);
?>
	

<a href="#top">Back to Top</a>
	
</div>


</div>





	


</body>
</html>