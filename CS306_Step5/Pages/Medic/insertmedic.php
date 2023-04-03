<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['name']) && !empty($_POST['profession']) && !empty($_POST['contact_info'])&& !empty($_POST['responsible_for']))
{
    $name = strtoupper($_POST['name']); 
    $profession = strtoupper($_POST['profession']); 
    $contact_info = $_POST['contact_info']; 
    $responsible_for = $_POST['responsible_for'];

    $athlete_array = explode("\n", $responsible_for);

    $unfound_athletes = ""; 
    $found_athletes = "";

    foreach ($athlete_array as $athlete) 
    {
	if (is_numeric($athlete))
	{
        $athlete_query = "SELECT * FROM athletes WHERE aid = $athlete";

        $athlete_query_result = $db->query($athlete_query);

    if ($athlete_query_result->num_rows == 0)
    {
        $unfound_athletes .= $athlete . "\n";
    }
    else
    {
        $found_athletes .= $athlete ."\n"; 
    }
	}
	else
	{
		$unfound_athletes .= $athlete . "\n";
	}

    }

    if ($unfound_athletes == "")
    {
        $medic_insertion_command = "INSERT INTO medic(name, contact_info, profession) VALUES ('$name', '$contact_info', '$profession')";

        $medic_result = mysqli_query($db, $medic_insertion_command);

        $medic_id = mysqli_insert_id($db);

        $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($db, $foreign_key_query);

        $found_id = explode("\n", $found_athletes);
        foreach($found_id as $id)
        {
            $id = intval($id);
            $responsible_command = "INSERT INTO responsible_for(mid, aid) VALUES ($medic_id, $id)";

			try 
			{
            	mysqli_query($db, $responsible_command);
			}
			catch(Exception $e)
			{}
        }


        mysqli_query($db, "DELETE FROM responsible_for WHERE mid = 0");
        echo "Insertion completed. Medic ID is $medic_id.";
        mysqli_query($db, "DELETE FROM responsible_for WHERE aid = 0");
 
    }
    else
    {
        echo "Athletes below can't be found in database. Please register them first:\n$unfound_athletes";
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
$sql = " SELECT * FROM medic ORDER BY mid DESC ";
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
		<h1>Medics</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Medic Name</th>
				<th>Medic ID</th>
				<th>Contact Info</th>
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
				<td><?php echo $rows['mid'];?></td>
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
