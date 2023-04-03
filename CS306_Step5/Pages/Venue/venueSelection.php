
<?php 

include "../../config.php";


include "../../navbar.html";



$sql_statement = "SELECT * FROM venue";

if (!empty($_POST['name']) || !empty($_POST['address']) ) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        $sql_statement .= " name = '$name' AND";
    }

    if (!empty($_POST['address'])) {
        $address = strtoupper($_POST['address']);
        $sql_statement .= " address = '$address'";
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
		<h1>Venue</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Venue ID</th>
				<th>Venue Name</th>
                <th>Address</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $venue_id = $row['vid']; //reading columns
                    $venue_name = $row['name']; 
                    $address = $row['address'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['vid'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['address'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>