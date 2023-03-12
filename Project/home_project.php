<?php
include 'connection.php';
session_start();
?>

<html>

<head>
	<title>Status</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
	<script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
	<h1 style="font-family:monospace,sans-serif; font-size:40px">
		<center>Projects</center>
	</h1>
	<form method="post">
		<div class="actionBtn">
			<button class="up" name="upcoming">UPCOMING</button>
			<button class="on" name="ongoing">ONGOING</button>
			<button class="al" name="all">ALL</button>
			<button class="back"><a href="../home.html">BACK</a></button>
		</div>
	</form>
	<style>

		body {
			color: #120e16;
			background: #f6f6f7;
			font-family: 'Courier New', Courier, monospace;
		}

		a{
			color: #120e16;
			text-decoration: none;
		}

		center {
			position: relative;
			padding: 10px;
			font-weight: 600;
		}

		.actionBtn {
			position: relative;
			display: inline-block;
			text-decoration: none;
			text-align: center;
			margin-top: 30px;
			margin-left: 30%;
			padding: 20px;
			justify-content: center;
		}

		.up,
		.on,
		.al {
			font-size: larger;
			background: #613fe5;
			padding: 10px;
			color: #f6f6f7;
			border-radius: 10px;
			border: 1px solid #613fe5;
			width: 130px;
		}

		.back{
			background: transparent;
			padding: 15px;
			border-radius: 10px;
			border: 1px solid #f6f6f7;
			width: 130px;
			font-size: larger;
			margin-left: 300px;
		}

		.on {
			margin-left: 100px;
		}

		.al {
			margin-left: 100px;
		}

		.up:hover , .on:hover , .al:hover , .back:hover{
			box-shadow: 0 0 20px 0 #613fe5, 0 5px 5px 0 #613fe5;
			transform: scale(1.2);
		}
	</style>
</body>

</html>


<?php

if (isset($_POST['upcoming'])) {
	$query = "SELECT pid, pname,dept_name,pstatus,psdate,pedate,plocation,platitude,plongitude FROM project_details WHERE pstatus='Upcoming'";
	$result = pg_query($conn, $query) or die("failed result");
	echo "<table border='3' cellspacing='0'>

<tr>
<th style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'><b>Project ID</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Department Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px; '><b>Status</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Commencement</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project DeadLine</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Location</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Latitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Longitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Map</b></th>
</tr>";


	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td style='text-align:center;font-weight:800;'>" . $row[0] . "</td>";
		echo "<td style='text-align:center'>" . $row[1] . "</td>";
		echo "<td style='text-align:center'>" . $row[2] . "</td>";
		echo "<td style='text-align:center'>" . $row[3]  . "</td>";
		echo "<td style='text-align:center'>" . $row[4] . "</td>";
		echo "<td style='text-align:center'>" . $row[5] . "</td>";
		echo "<td style='text-align:center'>" . $row[6] . "</td>";
		echo "<td style='text-align:center'>" . $row[7] . "</td>";
		echo "<td style='text-align:center'>" . $row[8] . "</td>";
		echo '<td style="width:15rem;height:15rem;"> <iframe src="https://maps.google.com/maps?q=' . $row[7] . ',' . $row[8] . '&h1=es&z=14&amp;output=embed" style="width:100%;height:100%"></iframe> </td>';
		echo "</tr>";
	}
	echo "</table>";
} else if (isset($_POST['ongoing'])) {
	$query = "SELECT pid, pname,dept_name,pstatus,psdate,pedate,plocation,platitude,plongitude FROM project_details WHERE pstatus='Ongoing'";
	$result = pg_query($conn, $query) or die("failed result");
	echo "<table border='3' cellspacing='0'>

<tr>
<th style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'><b>Project ID</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Department Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px; '><b>Status</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Commencement</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project DeadLine</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Location</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Latitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Longitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Map</b></th>
</tr>";


	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td style='text-align:center;font-weight:800;'>" . $row[0] . "</td>";
		echo "<td style='text-align:center'>" . $row[1] . "</td>";
		echo "<td style='text-align:center'>" . $row[2] . "</td>";
		echo "<td style='text-align:center'>" . $row[3]  . "</td>";
		echo "<td style='text-align:center'>" . $row[4] . "</td>";
		echo "<td style='text-align:center'>" . $row[5] . "</td>";
		echo "<td style='text-align:center'>" . $row[6] . "</td>";
		echo "<td style='text-align:center'>" . $row[7] . "</td>";
		echo "<td style='text-align:center'>" . $row[8] . "</td>";
		echo '<td style="width:15rem;height:15rem;"> <iframe src="https://maps.google.com/maps?q=' . $row[7] . ',' . $row[8] . '&h1=es&z=14&amp;output=embed" style="width:100%;height:100%"></iframe> </td>';
		echo "</tr>";
	}
	echo "</table>";
} else {
	$query = "SELECT pid, pname,dept_name,pstatus,psdate,pedate,plocation,platitude,plongitude FROM project_details";
	$result = pg_query($conn, $query) or die("failed result");
	echo "<table border='3' cellspacing='0'>

<tr>
<th style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'><b>Project ID</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Department Name</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px; '><b>Status</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Commencement</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project DeadLine</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Location</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Latitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Longitude</b></th>
<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Map</b></th>
</tr>";


	while ($row = pg_fetch_row($result)) {
		echo "<tr>";
		echo "<td style='text-align:center;font-weight:800;'>" . $row[0] . "</td>";
		echo "<td style='text-align:center'>" . $row[1] . "</td>";
		echo "<td style='text-align:center'>" . $row[2] . "</td>";
		echo "<td style='text-align:center'>" . $row[3]  . "</td>";
		echo "<td style='text-align:center'>" . $row[4] . "</td>";
		echo "<td style='text-align:center'>" . $row[5] . "</td>";
		echo "<td style='text-align:center'>" . $row[6] . "</td>";
		echo "<td style='text-align:center'>" . $row[7] . "</td>";
		echo "<td style='text-align:center'>" . $row[8] . "</td>";
		echo '<td style="width:15rem;height:15rem;"> <iframe src="https://maps.google.com/maps?q=' . $row[7] . ',' . $row[8] . '&h1=es&z=14&amp;output=embed" style="width:100%;height:100%"></iframe> </td>';
		echo "</tr>";
	}
	echo "</table>";
}

pg_close($con);
session_destroy();
?>	