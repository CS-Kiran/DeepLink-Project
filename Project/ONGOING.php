<html>
<head>
  <title>Project with Ongoing Status </title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>
    <title></title>
    <h1 style="color : #613fe5; font-weight:600; font-size: 50px; padding:15px; font-family:'Courier New', Courier, monospace;"><center>Ongoing Projects</center></h1>
	<body style="margin-left: 0.1%; background:#120e16; color:#f5f5f6; font-family:'Courier New', Courier, monospace;">
<?php
	include 'connection.php';

	error_reporting(0);
	
	$query="SELECT pid, pname,dept_name,pstatus,psdate,pedate,plocation,platitude,plongitude FROM project_details WHERE pstatus = 'Ongoing' ORDER BY pstatus ASC";
	
	$result=pg_query($conn,$query);

	echo "<table border='3' cellspacing='0'>

		<tr>
		<th style='text-align:center; font-size:18px; border: 2px solid; padding: 10px'><b>Project ID</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Name</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Type</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px; '><b>Status</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Commencement</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project DeadLine</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Project Location</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Latitude</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Longitude</b></th>
		<th style='text-align:center;font-size:18px; border: 2px solid;padding: 10px'><b>Map</b></th>
		</tr>";
		

	while($row=pg_fetch_row($result))
	{
	 echo"<tr>";
	echo"<td style='text-align:center;font-weight:800;'>" . $row[0] . "</td>";
	echo"<td style='text-align:center'>" . $row[1] . "</td>";
	echo"<td style='text-align:center'>" . $row[2] . "</td>";
	echo"<td style='text-align:center'>" .$row[3]  . "</td>";
	echo"<td style='text-align:center'>" . $row[4] . "</td>";
	echo"<td style='text-align:center'>" . $row[5] . "</td>";
	echo"<td style='text-align:center'>" . $row[6] . "</td>";
	echo"<td style='text-align:center'>" . $row[7] . "</td>";
	echo"<td style='text-align:center'>" . $row[8] . "</td>";
	echo'<td style="width:15rem;height:15rem;"> <iframe src="https://maps.google.com/maps?q='. $row[7].','. $row[8].'&h1=es&z=14&amp;output=embed" style="width:100%;height:100%"></iframe> </td>';
	echo "</tr>";
	
	}
	echo "</table>";
	pg_close($con);
?>
<br><br>
<a href="./UPCOMING.php" style="position:relative; padding:25px; color:aqua; font-size: 18px;">Show Upcoming Projects</a>
<a href="../home.html" style="position:relative; margin-left:75%; color:aqua; font-size: 18px;">Home</a>
</body>
</html>