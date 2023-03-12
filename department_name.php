<?php
include 'connection.php';
session_start();
?>

<html>

<head>
	<title>Departments</title>
</head>

<body>
	<h1 style="font-family:monospace,sans-serif; font-size:50px">
		<center>Departments</center>
	</h1>
	<form method="post">
		<div class="actionBtn">
			<button class="back"><a href="./home.html">BACK</a></button>
		</div>
	</form>
	<style>

		body {
			color: #120e16;
			background: #f6f6f7;
            font-family: 'Courier New', Courier, monospace;
		}

		a{
			color: #f6f6f7;
			text-decoration: none;
		}

		center {
			position: relative;
			padding: 10px;
			font-weight: 600;
		}

        button{
            border: 1px solid #613fe5;
            position: relative;
            margin-left: 85%;
            background: #613fe5;
            padding:10px;
            min-width: max-content;
            font-size: 20px;
            margin-bottom: 30px;
            border-radius: 10px;
        }
        button:hover {
            transform: scale(1.1);
			box-shadow: 0 0 20px 0 #613fe5, 0 5px 5px 0 #613fe5;
        }
	</style>
</body>

</html>


<?php

	$query = "SELECT * FROM department_details";
	$result = pg_query($conn, $query) or die("failed result");
	echo "<table border='3' cellspacing='0'>

<tr>
<th style='padding: 15px;text-align:center; font-size:20px; border: 2px solid; padding: 10px'><b>Department ID</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Department Name</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Ministry Name</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px; '><b>Description</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Department Head</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Department Email</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Department Contact</b></th>
<th style='padding: 15px;text-align:center;font-size:20px; border: 2px solid;padding: 10px'><b>Department Address</b></th>
</tr>";


	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td style='font-size:20px;padding: 20px;text-align:center;font-weight:800;'>" . $row[0] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[1] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[2] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[3]  . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[4] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[5] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[6] . "</td>";
		echo "<td style='font-size:18px;padding: 20px;text-align:center'>" . $row[7] . "</td>";
		echo "</tr>";
	}
	echo "</table>";


pg_close($con);

?>	