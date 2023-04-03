<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['sport']) && !empty($_POST['title']) && !empty($_POST['date']) && !empty($_POST['held_in']) && !empty($_POST['competitor_id']))
{
    $sport = strtoupper($_POST['sport']);
    $title = strtoupper($_POST['title']);
    $date = $_POST['date'];
    $competitors = $_POST['competitor_id'];

    $held_in = strtoupper($_POST['held_in']);
    $venue_query = "SELECT * FROM venue WHERE name = '$held_in'";
    $venue_query_result = $db->query($venue_query);

    if ($venue_query_result->num_rows == 0)
    {
        echo "There is no such venue in the database. Please insert the venue first.";
    }
    else
    {
        $row = $venue_query_result->fetch_assoc();
        $venue_id = $row['vid'];

        $competition_insert = "INSERT INTO competitions(sport, title, date, held_in) VALUES ('$sport', '$title', '$date', $venue_id)";

        //competitor things below
        $competitor_array = explode("\n", $competitors);

        $unfound_competitors = "";
        $found_competitors = "";

        foreach($competitor_array as $athlete)
        {
        if (is_numeric($athlete))
        {
            $athlete_query = "SELECT * FROM athletes WHERE aid = $athlete";

            $athlete_query_result = $db->query($athlete_query);
    
            if ($athlete_query_result->num_rows == 0)
            {
                $unfound_competitors .= $athlete . "\n";
            }
            else
            {
                $found_competitors .= $athlete ."\n"; 
            }
        }
        else
        {
            $unfound_competitors .= $athlete . "\n";
        }
    
        }

        if ($unfound_competitors == "")
        {
            $competition_result = mysqli_query($db, $competition_insert);

            $competition_id = mysqli_insert_id($db);

            $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
            mysqli_query($db, $foreign_key_query);

            $found_ids = explode("\n", $found_competitors);
            foreach($found_ids as $id)
            {
                $id = intval($id);
                $competes_in_command = "INSERT INTO competes_in(co_id, aid) VALUES ($competition_id, $id)";

                try
                {
                mysqli_query($db, $competes_in_command);
                }
                catch(Exception $e)
                {}
            }
            mysqli_query($db, "DELETE FROM competes_in WHERE aid = 0");
            echo "Insertion completed. Competition ID is $competition_id.";
        }
        else
        {
            echo "Athletes below can't be found in database. Please register them first:\n$unfound_competitors";
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
$sql = " SELECT * FROM competitions ORDER BY co_id DESC ";
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
		<h1>Competitions</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Sport Name</th>
				<th>Competition ID</th>
                <th>title</th>
                <th>Date</th>
                <th>Held In</th>
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
				<td><?php echo $rows['sport'];?></td>
				<td><?php echo $rows['co_id'];?></td>
                <td><?php echo $rows['title'];?></td>
                <td><?php echo $rows['date'];?></td>
                <td><?php echo $rows['held_in'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>