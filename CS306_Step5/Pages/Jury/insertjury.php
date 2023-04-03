<?php 

include "../../config.php"; 


include "../../navbar.html";


if (!empty($_POST['name']) && !empty($_POST['contact_info']) && !empty($_POST['title']) && !empty($_POST['evaluates']))
{
    $name = strtoupper($_POST['name']); 
    $contact_info = $_POST['contact_info'];
    $title = $_POST['title'];   
    $evaluates = $_POST['evaluates'];

    $competitions_array = explode("\n", $evaluates);

    $unfound_Competitions = ""; 
    $found_Competitions = "";

    foreach ($competitions_array as $competitions) 
    {
	if (is_numeric($competitions))
	{
        $competitions_query = "SELECT * FROM competitions WHERE co_id = $competitions";

        $competitions_query_result = $db->query($competitions_query);

    if ($competitions_query_result->num_rows == 0)
    {
        $unfound_Competitions .= $competitions . "\n";
    }
    else
    {
        $found_Competitions .= $competitions ."\n"; 
    }
	}	

	else
	{
		$unfound_Competitions .= $competitions . "\n";
	}
    }

    if ($unfound_Competitions == "")
    {
        $jury_insertion_command = "INSERT INTO jury(name, contact_info, title) VALUES ('$name', '$contact_info', '$title')";

        $jury_result = mysqli_query($db, $jury_insertion_command);

        $jury_id = mysqli_insert_id($db);

        $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($db, $foreign_key_query);

        $found_id = explode("\n", $found_Competitions);
        foreach($found_id as $id)
        {
            $id = intval($id);
            $evaluates_command = "INSERT INTO evaluates(jid, co_id) VALUES ($jury_id, $id)";

			try
			{
				mysqli_query($db, $evaluates_command);
			}
			catch(Exception $e)
			{}
            
        }


        mysqli_query($db, "DELETE FROM evaluates WHERE co_id = 0");
        echo "Insertion completed. Jury ID is $jury_id.";
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
$sql = " SELECT * FROM jury ORDER BY jid DESC ";
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
		<h1>Jury</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Jury Name</th>
				<th>Jury ID</th>
				<th>Contact Info</th>
                <th>Title</th>
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
				<td><?php echo $rows['jid'];?></td>
				<td><?php echo $rows['contact_info'];?></td>
                <td><?php echo $rows['title'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>