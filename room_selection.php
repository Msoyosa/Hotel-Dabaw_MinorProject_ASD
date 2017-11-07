<!DOCTYPE html>
<html>
<head>
	<title>
	Available Rooms
	</title>
</head>
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

                    // Close connection
                    mysqli_close($link);

                     $sql = "SELECT * FROM rooms where room_type='Double Bedroom'";
	    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
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

                    $sql = "SELECT * FROM rooms where room_type='Family Bedroom'";
	    if($result = mysqli_query($link, $sql)){
                        if(mysqli_num_rows($result) > 0){
                            echo "<table class='table table-bordered table-striped'>";
                                echo "<thead>";
                                    echo "<tr>";
                                        echo "<th>#</th>";
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

	<div>
	<div id="double">
			<?php 
			echo "<h2>Double Bedrooms</h2>";
			echo "Rate: Php 2000/ night";
			?>
		</div>


<a href="#top">Back to Top</a>
	
</div>

	<div>
	<div id="family">
			<?php 
			echo "<h2>Family / Bunk Bedrooms</h2>";
			echo "Rate: Php 1000/ Adult, Php 500/ Underage ";
			?>
		</div>

	

<a href="#top">Back to Top</a>
	
</div>


</div>





	<div>
		<div id="single">
			<?php 
			echo "<h2>Single Bedrooms</h2>";
			echo "Rate: Php 1000/ night";
			?>
		</div>
		<div>
		<ul><p>Available Rooms</p>
			<li><img src="Images/Hotel Rooms/single bedroom/100.jpg" width="200" height="100"><br /> Room # 100</li>
			<li><img src="Images/Hotel Rooms/single bedroom/101.jpg" width="200" height="100"><br /> Room # 101</li>
			<li><img src="Images/Hotel Rooms/single bedroom/102.jpg" width="200" height="100"><br /> Room # 102</li>
			<li><img src="Images/Hotel Rooms/single bedroom/103.jpg" width="200" height="100"><br /> Room # 103</li>
			<li><img src="Images/Hotel Rooms/single bedroom/104.jpg" width="200" height="100"><br /> Room # 104</li>
			<li><img src="Images/Hotel Rooms/single bedroom/105.jpg" width="200" height="100"><br /> Room # 105</li>
			<li><img src="Images/Hotel Rooms/single bedroom/106.jpg" width="200" height="100"><br /> Room # 106</li>
			<li><img src="Images/Hotel Rooms/single bedroom/107.jpg" width="200" height="100"><br /> Room # 107</li>
			<li><img src="Images/Hotel Rooms/single bedroom/108.jpg" width="200" height="100"><br /> Room # 108</li>
			<li><img src="Images/Hotel Rooms/single bedroom/109.jpg" width="200" height="100"><br /> Room # 109</li>
		</ul>
		</div>
		<a href="#top">Back to Top</a>
	</div>
	<div>
		<div id="double">
			<?php 
			echo "<h2>Double Bedrooms</h2>";
			echo "Rate: Php 2000/ night";
			?>
		</div>
		<div>
		<ul><p>Available Rooms</p>
			<li><img src="Images/Hotel Rooms/double bedroom/201.jpg" width="200" height="100"><br /> Room # 201</li>
			<li><img src="Images/Hotel Rooms/double bedroom/202.jpg" width="200" height="100"><br /> Room # 202</li>
			<li><img src="Images/Hotel Rooms/double bedroom/203.jpg" width="200" height="100"><br /> Room # 203</li>
			<li><img src="Images/Hotel Rooms/double bedroom/204.jpg" width="200" height="100"><br /> Room # 204</li>
			<li><img src="Images/Hotel Rooms/double bedroom/205.jpg" width="200" height="100"><br /> Room # 205</li>
		</ul>
		</div>
		<a href="#top">Back to Top</a>
	</div>
	<div>
		<div id="family">
			<?php 
			echo "<h2>Family / Bunk Bedrooms</h2>";
			echo "Rate: Php 1000/ night per person";
			?>
		</div>
		<div>
		<ul><p>Available Rooms</p>
			<li><img src="Images/Hotel Rooms/family bedroom/501.jpg" width="200" height="100"><br /> Room # 501</li>
			<li><img src="Images/Hotel Rooms/family bedroom/502.jpg" width="200" height="100"><br /> Room # 502</li>
			<li><img src="Images/Hotel Rooms/family bedroom/503.jpg" width="200" height="100"><br /> Room # 503</li>
		</ul>
		</div>
		<a href="#top">Back to Top</a>
	</div>
	<div>
		<div>
		</div>
		<div>
			<form method="post">


			</form>
		</div>

	</div>

</body>
</html>