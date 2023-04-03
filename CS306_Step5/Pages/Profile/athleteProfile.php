<?php 

include "../../config.php";

include "../../navbar.html";

$flag = 0;

if (empty($_POST['aid']))
{
    echo "Please enter an athlete ID to profile!";
    $flag = 1;
}
else
{
    $aid = $_POST['aid'];
    $aid_query = "SELECT * FROM athletes WHERE aid = $aid";
    $aid_result = $db->query($aid_query);

    if ($aid_result->num_rows == 0)
    {
        echo "No athlete found with this ID. Please try again.";
    }
    else
    {
        $athlete_profile = "";

        $row = $aid_result->fetch_assoc();
        $gender = $row['gender'];
        $contact_info = $row['contact_info'];
        $age = $row['age'];
        $name = $row['name'];
        $profession = $row['profession'];
        $competes_for = $row['competes_for'];

        $country_query = "SELECT name FROM countries WHERE coid = $competes_for";
        $country_result = $db->query($country_query);
        $country_row = $country_result->fetch_assoc();
        $country_name = $country_row['name'];

        $athlete_profile .= "Athlete Name: " . $name ."<br>". 
        "Age: " . $age . "<br>" . "Gender: " . $gender . "<br>". "Profession: " . $profession . "<br>" . "Competese for: " . $country_name . "<br>" . "Contact information: " . $contact_info;

        $coach_query = "SELECT coaches.name AS coach_name, coaches.cid AS coach_id, trains.aid AS athlete_aid FROM coaches JOIN trains ON coaches.cid = trains.cid WHERE trains.aid = $aid";

        $athlete_profile .= "<br>"."Coaches: ". "<br>";

        $coaches = "";

        $coach_result = $db->query($coach_query);
        while ($coach_row = $coach_result->fetch_assoc())
        {
            $coach_name = $coach_row['coach_name'];
            $coaches .= $coach_name . "<br>";
        }

        $managers_query = "SELECT name FROM manager_manages WHERE aid = $aid";

        $athlete_profile .= "Managers: "."<br>";

        $managers_result = $db->query($managers_query);
        $managers = "";
        while ($managers_row = $managers_result->fetch_assoc())
        {
            $managers .= $managers_row['name'] . "<br>";
        }
       

        $competition_query = "SELECT competitions.co_id, competitions.date, competitions.sport, competitions.title FROM competitions JOIN competes_in ON competitions.co_id = competes_in.co_id WHERE competes_in.aid = $aid";

        $athlete_profile .= "Competitions: " . "<br>";

        $competition_result = $db->query($competition_query);
        $competitions = "";
        while ($competition_row = $competition_result->fetch_assoc())
        {
            $cr = $competition_row['co_id'] . " " . $competition_row['sport'] . " " . $competition_row['title'] . " " . $competition_row['date'];

            $competitions .= $cr . "<br>";
        }

        //echo $athlete_profile;
    }
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
		<h1>Athlete Profile</h1>
		<!-- TABLE CONSTRUCTION -->
		<table>
			<tr>
				<th>Athelete Name</th>
				<th>Age</th>
                <th>Gender</th>
                <th>Profession</th>
                <th>Competes For</th>
				<th>Contact Information</th>
                <th>Coaches</th>
                <th>Managers</th>
                <th>Competitions</th>
			</tr>
			<!-- PHP CODE TO FETCH DATA FROM ROWS -->
			<?php
                if ($flag == 0 && $aid_result->num_rows != 0) {
            ?>
            <tr>
                <!-- FETCHING DATA FROM EACH
                    ROW OF EVERY COLUMN -->
                <td><?php echo $name;?></td>
                <td><?php echo $age;?></td>
                <td><?php echo $gender;?></td>
                <td><?php echo $profession;?></td>
                <td><?php echo $country_name;?></td>
                <td><?php echo $contact_info;?></td>
                <td><?php echo $coaches;?></td>
                <td><?php echo $managers;?></td>
                <td><?php echo $competitions;?></td>
            </tr>
            <?php
               } 
            ?>
        </table>
    </section>
</body>

</html>