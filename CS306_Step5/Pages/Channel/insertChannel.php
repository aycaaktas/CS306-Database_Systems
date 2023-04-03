<?php 

include "../../config.php"; 
include "../../navbar.html";


if (!empty($_POST['channel_name']) && !empty($_POST['Competitions']))
{
    $channel_name = strtoupper($_POST['channel_name']); 
    $co_id = $_POST['Competitions'];

    $Competitions_array = explode("\n", $co_id);

    $unfound_Competitions = ""; 
    $found_Competitions = "";

    foreach ($Competitions_array as $Competitions) 
    {
	if (is_numeric($Competitions))
	{
        $Competitions_query = "SELECT * FROM competitions WHERE co_id = $Competitions";

        $Competitions_query_result = $db->query($Competitions_query);

    if ($Competitions_query_result->num_rows == 0)
    {
        $unfound_Competitions .= $Competitions . "\n";
    }
    else
    {
        $found_Competitions .= $Competitions ."\n"; 
    }
	}
	else
	{
		$unfound_Competitions .= $Competitions . "\n";
	}

    }

    if ($unfound_Competitions == "")
    {
        $channel_insertion_command = "INSERT INTO channel(channel_name) VALUES ('$channel_name')";

        $channel_result = mysqli_query($db, $channel_insertion_command);

        $chid = mysqli_insert_id($db);

        $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($db, $foreign_key_query);

        $found_id = explode("\n", $found_Competitions);
        foreach($found_id as $id)
        {
            $id = intval($id);
            $Competitions_command = "INSERT INTO broadcasts(chid, co_id) VALUES ($chid , $id)";

			try {
            mysqli_query($db, $Competitions_command);
			}
			catch(Exception $e)
			{}
        }


        mysqli_query($db, "DELETE FROM broadcasts WHERE co_id = 0");
        echo "Insertion completed. Channel ID is $chid.";
    }
    else
    {
        echo "Competitions below can't be found in database. Please register them first:\n$unfound_Competitions";
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
$sql = " SELECT * FROM channel ORDER BY chid DESC ";
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
		<h1>Channels</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Channel ID</th>
				<th>Channel Name</th>
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
				<td><?php echo $rows['chid'];?></td>
				<td><?php echo $rows['channel_name'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>
