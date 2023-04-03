<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['name']) && !empty($_POST['address']) ){  
    $name = strtoupper($_POST['name']); 
    $address = strtoupper($_POST['address']); 
    
    $sql_statement = "INSERT INTO venue(name, address) VALUES ('$name', '$address' )"; 

	try
	{
		$result = mysqli_query($db, $sql_statement);

		if ($result == 1)
			{
				$venue_id = mysqli_insert_id($db);
				echo "Insertion succeded. Venue ID is $venue_id.";
			}
	}
	catch(Exception $e)
	{
		echo "Venue names must be unique!";
	}
} 

else 
{
    echo "You have to enter all fields!";
}

?>

<?php

// Username is root
$user = 'root';
$password = '';

// Database name is olympics
$database = 'olympics';

// Server is localhost with
// port number 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
				$password, $database);

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
$sql = " SELECT * FROM venue ORDER BY vid DESC ";
$result = $mysqli->query($sql);
$mysqli->close();
?>
<!-- HTML code to display data in tabular format -->
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<title>GFG User Details</title>
	<!-- CSS FOR STYLING THE PAGE -->
	<style>
		table {
			margin: 0 auto;
			font-size: large;
			border: 1px solid black;
		}

		h1 {
			text-align: center;
			color: #006600;
			font-size: xx-large;
			font-family: 'Gill Sans', 'Gill Sans MT',
			' Calibri', 'Trebuchet MS', 'sans-serif';
		}

		td {
			background-color: #E4F5D4;
			border: 1px solid black;
		}

		th,
		td {
			font-weight: bold;
			border: 1px solid black;
			padding: 10px;
			text-align: center;
		}

		td {
			font-weight: lighter;
		}
	</style>
</head>

<body>
	<section>
		<h1>Venue</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Venue Name</th>
				<th>Venue ID</th>
				<th>Address</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
				// LOOP TILL END OF DATA
				while($rows=$result->fetch_assoc())
				{
			?>
			<tr>
				<!-- FETCHING DATA FROM EACH
					ROW OF EVERY COLUMN -->
				<td><?php echo $rows['name'];?></td>
				<td><?php echo $rows['vid'];?></td>
				<td><?php echo $rows['address'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>