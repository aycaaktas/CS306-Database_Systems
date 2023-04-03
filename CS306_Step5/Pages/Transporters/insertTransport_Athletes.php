<?php 

include "../../config.php"; 


include "../../navbar.html";


if (!empty($_POST['transid']) && !empty($_POST['aid']) )
{

    $transid = $_POST['transid'];
    $aid = $_POST['aid'];


    //verilen idlerin varligini kontrol ediyor
    $transid_query = "SELECT * FROM transporters WHERE transid = $transid";

    $transid_query_result = $db->query($transid_query); 

    $aid_query = "SELECT * FROM athletes WHERE aid = $aid";

    $aid_query_result = $db->query($aid_query);

    if ($aid_query_result->num_rows == 0 || $transid_query_result->num_rows == 0)
    {
        echo "One of Coach ID or Athlete ID you have entered was not found in database. Please try again.";
    }
    else 
    {
        //trains tablosuna yerlestiriyor 
        $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($db, $foreign_key_query);

        $transport_athletes_command = "INSERT INTO transports_athlete(transid, aid) VALUES ($transid, $aid)";

        try
		{
			$result = mysqli_query($db, $transport_athletes_command);

			mysqli_query($db, "DELETE FROM transports_athlete WHERE aid = 0 OR transid = 0");

			if ($result == 1)
			{
				echo "Insertion succeded.";
			}
		}
		catch(Exception $e)
        {
            echo "This couple already exists in database!";
        }

    }
}
else 
{
    //bunu yerine form fieldları required olabilir
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
$sql = " SELECT * FROM transports_athlete ORDER BY transid DESC ";
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
		<h1>Transport-Athlete</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Transportation ID</th>
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
				<td><?php echo $rows['transid'];?></td>
				<td><?php echo $rows['aid'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>