<?php 

include "../../config.php"; 
include "../../navbar.html";

$sql_statement = "SELECT competitions.co_id AS co_id, competitions.title AS competition_title, competitions.sport AS sport, channel.chid AS chid, channel.channel_name AS channel_name FROM (broadcasts JOIN channel ON broadcasts.chid = channel.chid) JOIN competitions ON broadcasts.co_id = competitions.co_id";


if (!empty($_POST['chid']) || !empty($_POST['co_id']))
{
    $sql_statement .= " WHERE";

    if (!empty($_POST['chid']))
    {
        $chid = $_POST['chid'];
        $sql_statement .= " channel.chid = $chid AND";
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
		<h1>athletes</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
                <th>Channel ID</th>
				<th>Channel Name</th>
				<th>Competition ID</th>
                <th>Competition Title</th>
				<th>Sport</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                while($row = mysqli_fetch_assoc($result)) { // Iterating the result
                    $channel_name = $row['channel_name'];
                    $co_id = $row['co_id'];
                    $competition_title = $row['competition_title'];
                    $sport = $row['sport'];
                    $chid = $row['chid'];
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $row['chid'];?></td>    
                <td><?php echo $row['channel_name'];?></td>
                <td><?php echo $row['co_id'];?></td>
                <td><?php echo $row['competition_title'];?></td>
                <td><?php echo $row['sport'];?></td>

            </tr>
            <?php
                }
            ?>
        </table>
    </section>
</body>

</html>
