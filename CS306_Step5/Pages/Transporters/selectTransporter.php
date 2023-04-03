<?php 

include "../../config.php";


include "../../navbar.html";

$sql_statement = "SELECT * FROM transporters";

if (!empty($_POST['driver']) || !empty($_POST['plate'])) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['driver'])) {
        $driver = strtoupper($_POST['driver']);
        $sql_statement .= " driver = '$driver' AND";
    }

    if (!empty($_POST['plate'])) {
        $plate = strtoupper($_POST['plate']);
        $sql_statement .= " plate = '$plate' AND";
    }

    if (str_ends_with($sql_statement, " AND")) {
        $sql_statement = rtrim($sql_statement, " AND");
    }  

}

$result = mysqli_query($db, $sql_statement);

if($result->num_rows == 0) {
    echo "There is no such transporter or driver exist";
}
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
		<h1>Transporters</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Transporter ID</th>
				<th>Driver Name</th>
                <th>Plate</th>

			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $transporter_id = $row['transid']; //reading columns
                    $driver = $row['driver']; 
                    $plate = $row['plate'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['transid'];?></td>
                <td><?php echo $row['driver'];?></td>
                <td><?php echo $row['plate'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>