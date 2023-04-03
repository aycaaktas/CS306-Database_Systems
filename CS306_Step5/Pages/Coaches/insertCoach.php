<?php 

include "../../config.php"; 
include "../../navbar.html";

if (!empty($_POST['name']) && !empty($_POST['profession']) && !empty($_POST['contact_info']) && !empty($_POST['trainees']))
{

    $name = strtoupper($_POST['name']); 
    $profession = strtoupper($_POST['profession']); 
    $contact_info = $_POST['contact_info']; 
    $trainees = $_POST['trainees'];

    //formda koçun train ettigi atletlerin idsi de giriliyor, bu kisim idleri barindiran stringi boluyor
    $athlete_array = explode("\n", $trainees);


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

    //eger bulunamayan atlet yoksa insertion yap
    if ($unfound_athletes == "")
    {
        $coach_insertion_command = "INSERT INTO coaches(name, contact_info, profession) VALUES ('$name', '$contact_info', '$profession')";

        $coach_result = mysqli_query($db, $coach_insertion_command);

        //son insert querysinden sonra coach id donduruluyor
        $coach_id = mysqli_insert_id($db);

        //burasi database in kendiliginden foreign key kontrolu yapmaması icin, garip bir sekilde hata veriyor yoksa
        $foreign_key_query = "SET FOREIGN_KEY_CHECKS=0";
        mysqli_query($db, $foreign_key_query);

        //database de olan atletlerin idleri ile trains tablosuna yerlestirme yapılıyor
        $found_id = explode("\n", $found_athletes);
        foreach($found_id as $id)
        {
            $id = intval($id);
            $trains_command = "INSERT INTO trains(cid, aid) VALUES ($coach_id, $id)";

			try
			{
				mysqli_query($db, $trains_command);
			}
			catch(Exception $e)
			{}
            
        }

        //bu kisim da foreign key hatasi ile ilgili
        mysqli_query($db, "DELETE FROM trains WHERE aid = 0");
        echo "Insertion completed. Coach ID is $coach_id.";
    }
    else
    {
        echo "Athletes below can't be found in database. Please register them first:\n$unfound_athletes";
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
$sql = " SELECT * FROM coaches ORDER BY cid DESC ";
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
		<h1>Coaches</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Coach Name</th>
				<th>Coach ID</th>
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
				<td><?php echo $rows['cid'];?></td>
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