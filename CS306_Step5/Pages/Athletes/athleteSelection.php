<?php 

include "../../config.php";
include "../../navbar.html";

$sql_statement = "SELECT * FROM athletes";

if (!empty($_POST['name']) || !empty($_POST['profession']) || !empty($_POST['age']) || !empty($_POST['gender']) || !empty($_POST['country'])) {

    $sql_statement .= " WHERE";

    if (!empty($_POST['name'])) {
        $name = strtoupper($_POST['name']);
        $sql_statement .= " name = '$name' AND";
    }

    if (!empty($_POST['profession'])) {
        $profession = strtoupper($_POST['profession']);
        $sql_statement .= " profession = '$profession' AND";
    }

    if (!empty($_POST['age'])) {
        $age = $_POST['age'];
        $sql_statement .= " age < $age AND"; //age smaller than given age
    }

    if (!($_POST['gender'] == "")) {
        $gender = $_POST['gender'];
        $sql_statement .= " gender = '$gender' AND";
    }

    if (!empty($_POST['country'])) {

        $country = strtoupper($_POST['country']);

        $country_query = "SELECT * FROM countries WHERE name = '$country'";

        $country_query_result = $db->query($country_query);

        if ($country_query_result->num_rows != 0)
        {
            $country_id_query = "SELECT coid FROM countries WHERE name = '$country'";

            $country_id_result = $db->query($country_id_query);

            $row = $country_id_result->fetch_assoc();
            $country_id = $row['coid'];

            $sql_statement .= " competes_for = $country_id";
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
		<h1>athletes</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Athelete ID</th>
				<th>Name</th>
                <th>Profession</th>
				<th>Age</th>
				<th>Contact Info</th>
				<th>Gender</th>
                <th>Country name</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $athlete_id = $row['aid']; //reading columns
                    $athlete_name = $row['name']; 
                    $profession = $row['profession'];
                    $age = $row['age']; 
                    $contact_info = $row['contact_info']; 
                    $gender = $row['gender']; 

                    $country_id = $row['competes_for'];
                    $id_query = "SELECT name FROM countries WHERE coid = $country_id";
                    $name_result = mysqli_query($db, $id_query);
                    $subrow = mysqli_fetch_assoc($name_result);
                    $country_name = $subrow['name'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['aid'];?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['profession'];?></td>
                <td><?php echo $row['age'];?></td>
                <td><?php echo $row['contact_info'];?></td>
                <td><?php echo $row['gender'];?></td>
                <td><?php echo $subrow['name'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>