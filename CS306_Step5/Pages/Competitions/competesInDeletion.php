<?php 

include "../../config.php"; 

include "../../navbar.html";


if (!empty($_POST['co_id']) && !empty($_POST['aid']))
{
    $co_id = $_POST['co_id'];
    $aid = $_POST['aid'];

    $competesIn_query = "SELECT * FROM competes_in WHERE co_id = $co_id AND aid = $aid";

    $competesIn_query_result = $db->query($competesIn_query);

    $competition_query = "SELECT * FROM competes_in WHERE co_id = $co_id";
    $competition_query_result = $db->query($competition_query);

    if ($competition_query_result->num_rows == 1)
    {
        echo "A competition must have at least 1 competitor in it!";
    }
    else if ($competesIn_query_result->num_rows == 0)
    {
        echo "No such competitor found in such competition.";
    }
    else
    {
        $result = mysqli_query($db, "DELETE FROM competes_in WHERE aid = $aid AND co_id = $co_id");

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
$sql = " SELECT * FROM competes_in ORDER BY co_id DESC ";
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
		<h1>Competes In</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Competition ID</th>
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
				<td><?php echo $rows['co_id'];?></td>
				<td><?php echo $rows['aid'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>