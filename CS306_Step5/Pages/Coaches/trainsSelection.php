<?php 

include "../../config.php";
include "../../navbar.html";

//trains tablosundaki idlerden isim gosterebilmek icin join yapılıyor
$sql_statement = "SELECT coaches.cid AS coach_id, coaches.name AS coach_name, athletes.aid AS athlete_id, athletes.name AS athlete_name FROM (trains JOIN coaches ON trains.cid = coaches.cid) JOIN athletes ON trains.aid = athletes.aid";

//diger filtrelere benziyor geri kalani
if (!empty($_POST['cid']) || !empty($_POST['aid']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['cid']))
    {
        $cid = $_POST['cid'];
        $sql_statement .= " coaches.cid = $cid AND";
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
		<h1>athletes</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Coach ID</th>
				<th>Coach Name</th>
                <th>Athlete ID</th>
				<th>Athlete Name</th>

			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $coach_id = $row['coach_id'];
                    $coach_name = $row['coach_name'];
                    $athlete_id = $row['athlete_id'];
                    $athlete_name = $row['athlete_name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['coach_id'];?></td>
                <td><?php echo $row['coach_name'];?></td>
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
