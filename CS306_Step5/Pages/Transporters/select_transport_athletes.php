<?php 

include "../../config.php";


include "../../navbar.html";



//transports_athlete tablosundaki idlerden isim gosterebilmek icin join yapılıyor
$sql_statement = "SELECT transporters.transid AS transporter_id, transporters.driver AS transporter_driver, athletes.aid AS athlete_id, athletes.name AS athlete_name FROM (transports_athlete JOIN transporters ON transports_athlete.transid = transporters.transid) JOIN athletes ON transports_athlete.aid = athletes.aid";

//diger filtrelere benziyor geri kalani
if (!empty($_POST['transid']) || !empty($_POST['aid']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['transid']))
    {
        $transid = $_POST['transid'];
        $sql_statement .= " transporters.transid = $transid AND";
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
		<h1>Transport-Athlete</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Transporter ID</th>
				<th>Transporter Driver</th>
                <th>Athlete ID</th>
				<th>Athlete Name</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $transporter_id = $row['transporter_id'];
                    $transporter_driver = $row['transporter_driver'];
                    $athlete_id = $row['athlete_id'];
                    $athlete_name = $row['athlete_name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['transporter_id'];?></td>
                <td><?php echo $row['transporter_driver'];?></td>
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