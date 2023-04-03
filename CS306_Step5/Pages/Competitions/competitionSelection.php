<?php 

include "../../config.php";


include "../../navbar.html";



$sql_statement = "SELECT * FROM competitions";

if (!empty($_POST['sport']) || !empty($_POST['title']) || !empty($_POST['date']) || !empty($_POST['held_in']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['sport'])) {
        $sport = strtoupper($_POST['sport']);
        $sql_statement .= " sport = '$sport' AND";
    }

    if (!empty($_POST['title'])) {
        $title = strtoupper($_POST['title']);
        $sql_statement .= " title = '$title' AND";
    }

    if (!empty($_POST['date'])) {
        $date = strtoupper($_POST['date']);
        $sql_statement .= " date > '$date' AND";
    }

    if (!empty($_POST['held_in'])) {

        $venue = strtoupper($_POST['held_in']);
        $venue_query = "SELECT * FROM venue WHERE name = '$venue'";
        $venue_result = $db->query($venue_query);
        
        if ($venue_result->num_rows != 0)
        {
            $row = $venue_result->fetch_assoc();
            $venue_id = $row['vid'];
            $sql_statement .= " held_in = $venue_id";
        }
    }

    if (str_ends_with($sql_statement, " AND")) {
        $sql_statement = rtrim($sql_statement, " AND");
    }  
}

$result = mysqli_query($db, $sql_statement);

?>

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
                <th>Competition ID</th>
				<th>Sport</th>
				<th>Title</th>
				<th>Date</th>
				<th>Venue Name</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $competition_id = $row['co_id']; //reading columns
                    $sport = $row['sport']; 
                    $title = $row['title'];
                    $date = $row['date']; 
                    
                    $venue_id = $row['held_in'];
                    $id_query = "SELECT name FROM venue WHERE vid = $venue_id";
                    $name_result = mysqli_query($db, $id_query);
                    $subrow = mysqli_fetch_assoc($name_result);
                    $venue_name = $subrow['name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['co_id'];?></td>
                <td><?php echo $row['sport'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['date'];?></td>
                <td><?php echo $subrow['name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>