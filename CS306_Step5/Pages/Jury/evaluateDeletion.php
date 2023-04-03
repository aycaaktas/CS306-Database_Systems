<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['jid']) && !empty($_POST['co_id']) )
{

    $jid = $_POST['jid'];
    $co_id = $_POST['co_id'];

    $evaluates_query = "SELECT * FROM evaluates WHERE jid = $jid AND co_id = $co_id";

    $evaluates_query_result = $db->query($evaluates_query);

    $evaluates_query = "SELECT * FROM evaluates WHERE jid = $jid";
    $evaluates_query_result = $db->query($evaluates_query);

    if ($evaluates_query_result->num_rows == 1)
    {
        echo "Each jury must evaluate for at least one competition. Please try again.";
    }

    else if ($evaluates_query_result->num_rows == 0)
    {
        echo "No such jury-competition couple found in database.";
    }
    else
    {
        $result = mysqli_query($db, "DELETE FROM evaluates WHERE co_id = $co_id AND jid = $jid");

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
$sql = " SELECT * FROM evaluates ORDER BY jid DESC ";
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
		<h1>Evaluates</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Competition ID</th>
				<th>Jury ID</th>
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
				<td><?php echo $rows['jid'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>