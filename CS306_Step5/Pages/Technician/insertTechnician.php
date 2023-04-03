<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['name']) && !empty($_POST['contact_info']) && !empty($_POST['profession']) && !empty($_POST['responsible_at']))
{
    $name = strtoupper($_POST['name']); 
    $contact_info = $_POST['contact_info'];
    $profession = strtoupper($_POST['profession']);
    $responsible_at = strtoupper($_POST['responsible_at']);

    $venue_query = "SELECT * FROM venue WHERE name = '$responsible_at'";

    $venue_query_result = $db->query($venue_query);

    if ($venue_query_result->num_rows == 0)
    {
        echo "There is no such venue in the database at the moment. Please insert the venue into database first.";
    }
    else
    {
        $venue_id_query = "SELECT vid FROM venue WHERE name = '$responsible_at'";

        $venue_id_result = $db->query($venue_id_query);

        $row = $venue_id_result->fetch_assoc();
        $venue_id = $row['vid'];

        $sql_statement = "INSERT INTO technician(name,  contact_info, profession,  responsible_at) VALUES ('$name' , '$contact_info', '$profession', $venue_id )"; 

        $result = mysqli_query($db, $sql_statement);
        if ($result == 1)
        {
            $technician_id = mysqli_insert_id($db);
            echo "Insertion succeded. Technician ID is $technician_id.";
        }
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
$sql = " SELECT * FROM technician ORDER BY tid DESC ";
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
		<h1>Technicians</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Technician Name</th>
				<th>Technician ID</th>
                <th>Contact Information</th>
                <th>Profession</th>
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
				<td><?php echo $rows['tid'];?></td>
                <td><?php echo $rows['contact_info'];?></td>
                <td><?php echo $rows['profession'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>