<?php 

include "../../config.php";
include "../../navbar.html";


$sql_statement = "SELECT * FROM manager_manages";

if (!empty($_POST['name']) ||  !empty($_POST['aid'])) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        $sql_statement .= " name = '$name' AND";
    }

    if (!empty($_POST['aid'])) {

        $aid = $_POST['aid'];
        $sql_statement .= " aid = $aid";
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
		<h1>Managers</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Manager ID</th>
				<th>Manager Name</th>
                <th>Contact Info</th>
				<th>Athlete ID</th>
				<th>Athlete Name</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $manager_id = $row['man_id']; //reading columns
                    $manager_name = $row['name'];  
                    $contact_info = $row['contact_info'];  
                    
                    $aid_id = $row['aid'];
                
                    $id_query = "SELECT name FROM athletes WHERE aid = $aid_id";
                    $name_result = mysqli_query($db, $id_query);
                    $subrow = mysqli_fetch_assoc($name_result);
                    $athlete_name = $subrow['name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['man_id'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['contact_info'];?></td>
                <td><?php echo $row['aid'];?></td>
                <td><?php echo $subrow['name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>

