<?php 

include "../../config.php"; 


include "../../navbar.html";



if (!empty($_POST['name']) &&  !empty($_POST['contact_info']) && !empty($_POST['aid']))
{
    $name = strtoupper($_POST['name']); 
    $contact_info = $_POST['contact_info']; 
    $aid = ($_POST['aid']);

    $aid_query = "SELECT * FROM athletes WHERE aid = '$aid'";

    $aid_query_result = $db->query($aid_query);

    if ($aid_query_result->num_rows == 0)
    {
        echo "There is no such athlete in the database at the moment. Please insert the athlete into database first. Manager cannot exist in the database without an athlete.";
    }
    else
    {
        $aid_id_query = "SELECT aid FROM athletes WHERE aid = '$aid'";

        $aid_id_result = $db->query($aid_id_query);

        $row = $aid_id_result->fetch_assoc();
        $aid_id = $row['aid'];

        $sql_statement = "INSERT INTO manager_manages(name, contact_info, aid) VALUES ('$name' ,'$contact_info',  '$aid_id' )"; 

        $result = mysqli_query($db, $sql_statement);
        if ($result == 1)
        {
            echo "Insertion succeded.";
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
$sql = " SELECT * FROM manager_manages ORDER BY man_id DESC ";
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
		<h1>Managers</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Manager ID</th>
				<th>Manager Name</th>
				<th>Contact Info</th>
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
				<td><?php echo $rows['man_id'];?></td>
				<td><?php echo $rows['name'];?></td>
				<td><?php echo $rows['contact_info'];?></td>
                <td><?php echo $rows['aid'];?></td>
			</tr>
			<?php
				}
			?>
		</table>
	</section>
</body>

</html>