<?php 

include "../../config.php";
include "../../navbar.html";

//bu dosya diger selectler ile benzer 
$sql_statement = "SELECT * FROM coaches";

if (!empty($_POST['name']) || !empty($_POST['profession'])) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        $sql_statement .= " name = '$name' AND";
    }

    if (!empty($_POST['profession'])) {
        $profession = strtoupper($_POST['profession']);
        $sql_statement .= " profession = '$profession'";
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
		<h1>Coaches</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Coach ID</th>
				<th>Name</th>
				<th>Profession</th>
				<th>Contact Info</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $coach_id = $row['cid']; //reading columns
                    $coach_name = $row['name']; 
                    $profession = $row['profession']; 
                    $contact_info = $row['contact_info'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['cid'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['profession'];?></td>
                <td><?php echo $row['contact_info'];?></td>

            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>