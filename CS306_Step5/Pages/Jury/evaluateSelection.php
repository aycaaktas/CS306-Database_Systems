<?php 

include "../../config.php";

include "../../navbar.html";



$sql_statement = "SELECT jury.jid AS jid, jury.name AS jury_name, competitions.co_id AS co_id, competitions.title AS title, competitions.sport AS sport FROM (evaluates JOIN Jury ON evaluates.jid = jury.jid) JOIN competitions ON evaluates.co_id = competitions.co_id";


if (!empty($_POST['jid']) || !empty($_POST['co_id']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['jid'])) {
        $jid = $_POST['jid'];
        $sql_statement .= " jury.jid = $jid AND";

    }
    if (!empty($_POST['co_id']))
    {
        $co_id = $_POST['co_id'];
        $sql_statement .= " competitions.co_id = $co_id";
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
		<h1>Evaluates</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Jury ID</th>
				<th>Jury Name</th>
                <th>Competition ID</th>
				<th>Title</th>
				<th>Sport Info</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result

                    $jid = $row['jid'];
                    $jury_name = $row['jury_name'];
                    $co_id = $row['co_id'];
                    $title = $row['title'];
                    $sport = $row['sport'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['jid'];?></td>
                <td><?php echo $row['jury_name'];?></td>
                <td><?php echo $row['co_id'];?></td>
                <td><?php echo $row['title'];?></td>
                <td><?php echo $row['sport'];?></td>
            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>