<?php 

include "../../config.php";


include "../../navbar.html";



$sql_statement = "SELECT * FROM technician";

if (!empty($_POST['name']) || !empty($_POST['profession']) ||  !empty($_POST['responsible_at'])) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        $sql_statement .= " name = '$name' AND";
    }

    if (!empty($_POST['profession'])) {
        $profession = strtoupper($_POST['profession']);
        $sql_statement .= " profession = '$profession' AND";
    }

    if (!empty($_POST['responsible_at'])) {

        $responsible_at = strtoupper($_POST['responsible_at']);

        $responsible_at_query = "SELECT * FROM venue WHERE name = '$responsible_at'";

        $responsible_at_query_result = $db->query($responsible_at_query);

        if ($responsible_at_query_result->num_rows != 0)
        {
            $responsible_at_id_query = "SELECT vid FROM venue WHERE name = '$responsible_at'";

            $responsible_at_id_result = $db->query($responsible_at_id_query);

            $row = $responsible_at_id_result->fetch_assoc();
            $vid = $row['vid'];

            $sql_statement .= " responsible_at = $vid";
        }
        else
        {
            $sql_statement .= " responsible_at = 0";
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
		<h1>Technician</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Technician ID</th>
				<th>Name</th>
                <th>Profession</th>
				<th>Contact Info</th>
				<th>Responsible At</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $technician_id = $row['tid']; //reading columns
                    $technician_name = $row['name']; 
                    $profession = $row['profession'];
                    $contact_info = $row['contact_info']; 
                    
                    
                    $responsible_at_id = $row['responsible_at'];
                    $id_query = "SELECT name FROM venue WHERE vid = $responsible_at_id";
                    $name_result = mysqli_query($db, $id_query);
                    $subrow = mysqli_fetch_assoc($name_result);
                    $responsible_at_name = $subrow['name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['tid'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['profession'];?></td>
                <td><?php echo $row['contact_info'];?></td>
                <td><?php echo $subrow['name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>