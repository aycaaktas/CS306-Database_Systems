<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['mid']) && !empty($_POST['aid']) )
{

    $mid = $_POST['mid'];
    $aid = $_POST['aid'];

    $responsible_query = "SELECT * FROM responsible_for WHERE mid = $mid AND aid = $aid";

    $responsible_query_result = $db->query($responsible_query);

    $medic_query = "SELECT * FROM responsible_for WHERE mid = $mid";
    $medic_query_result = $db->query($medic_query);

    if ($medic_query_result->num_rows == 1)
    {
        echo "Each medic must be responsible for at least one athlete. Please try again.";
    }

    else if ($responsible_query_result->num_rows == 0)
    {
        echo "No such medic-athlete couple found in database.";
    }
    else
    {
        $result = mysqli_query($db, "DELETE FROM responsible_for WHERE aid = $aid AND mid = $mid");

        if ($result == 1)
        {
            echo "Deletion succeded.";
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
$sql = " SELECT * FROM responsible_for ORDER BY mid DESC ";
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
		<h1>Responsible</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Medic ID</th>
				<th>Athlete ID</th>
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
				<td><?php echo $rows['mid'];?></td>
				<td><?php echo $rows['aid'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>