<?php 

include "../../config.php"; 
 

include "../../navbar.html";


if (!empty($_POST['driver']) && !empty($_POST['plate']) && !empty($_POST['athletes']))
{
    $driver = strtoupper($_POST['driver']); 
    $plate = strtoupper($_POST['plate']);
    $athletes = $_POST['athletes']; 


    $plate_query = "SELECT * FROM transporters WHERE plate = '$plate'";

    $plate_query_result = $db->query($plate_query);

    if ($plate_query_result->num_rows > 0)
    {
        echo "Select Another Plate Please. This car is belongst to someone else";
    }
    else
    {

        $athlete_array = explode("\n", $athletes);


        //allatki kisimda girilen athlete idleri kontrol ediliyor
        $unfound_athletes = ""; //bulunamayan atletler
        $found_athletes = ""; //bulunan atletler

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
            $sql_statement = "INSERT INTO transporters(driver, plate) VALUES ('$driver' ,'$plate')"; 

            $result = mysqli_query($db, $sql_statement);
            $driver_id = mysqli_insert_id($db);

            $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
            mysqli_query($db, $foreign_key_query);
    
            //database de olan atletlerin idleri ile trains tablosuna yerlestirme yapılıyor
            $found_id = explode("\n", $found_athletes);
            foreach($found_id as $id)
            {
                $id = intval($id);
                $transports_command = "INSERT INTO transports_athlete(transid, aid) VALUES ($driver_id, $id)";
    

                try
				{
					mysqli_query($db, $transports_command);
				}
				catch(Exception $e)
				{}
            }
    
            //bu kisim da foreign key hatasi ile ilgili
            mysqli_query($db, "DELETE FROM transports_athlete WHERE aid = 0");
                
            if ($result == 1)
            {
                echo "Insertion succeded. Transporter ID is $driver_id.";
            }  
            
            
        } 
        else
        {
            echo "Athletes below can't be found in database. Please register them first:\n$unfound_athletes";
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
$sql = " SELECT * FROM transporters ORDER BY transid DESC ";
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
		<h1>Transporters</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Transporter ID</th>
				<th>Driver</th>
				<th>Plate</th>
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
				<td><?php echo $rows['driver'];?></td>
				<td><?php echo $rows['plate'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>