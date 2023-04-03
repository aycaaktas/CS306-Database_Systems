<?php 

include "../../config.php";


include "../../navbar.html";


$sql_statement = "SELECT competitions.co_id AS competition_id, competitions.sport AS sport, competitions.title AS title, athletes.aid AS athlete_id, athletes.name AS athlete_name FROM (competes_in JOIN competitions ON competes_in.co_id = competitions.co_id) JOIN athletes ON competes_in.aid = athletes.aid";

if (!empty($_POST['co_id']) || !empty($_POST['aid']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['co_id']))
    {
        $co_id = $_POST['co_id'];
        $sql_statement .= " competitions.co_id = $co_id AND";
    }

    if (!empty($_POST['aid']))
    {
        $aid = $_POST['aid'];
        $sql_statement .= " athletes.aid = $aid";
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
		<h1>Competes In</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Competition ID</th>
				<th>Sport</th>
                <th>Title</th>
				<th>Athlete ID</th>
				<th>Athlete Name</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $competition_id = $row['competition_id'];
                    $sport = $row['sport'];
                    $title = $row['title'];
                    $athlete_id = $row['athlete_id'];
                    $athlete_name = $row['athlete_name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['competition_id'];?></td>
                <td><?php echo $row['sport'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['athlete_id'];?></td>
                <td><?php echo $row['athlete_name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>
