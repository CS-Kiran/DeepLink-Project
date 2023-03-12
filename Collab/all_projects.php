<?php
include("../connection.php");
session_start();
?>

<html>

<head>
    <title>All Projects</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.3/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <h1 style="font-family:monospace,sans-serif;">
        <center>Projects</center>
    </h1>
    <div class="actionBtn">
        <a href="../Dashboard/dashboard.php"><button class="back">BACK</button></a>
    </div>
    <style>
        body {
            color: #120e16;
            background: #f6f6f7;
            font-family: 'Courier New', Courier, monospace;
        }

        a {
            color: #f6f6f7;
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
            margin-top: 10px;
            margin-left: 70%;
            padding: 20px;
            justify-content: center;
        }

        .back {
            font-size: larger;
            background: #613fe5;
            padding: 10px;
            color: #f6f6f7;
            border-radius: 5px;
            border: 1px solid #613fe5;
            width: 130px;
            margin-left: 100%;
        }

        .back:hover {
            transform: scale(1.3);
            box-shadow: 0 0 20px 0 #613fe5, 0 5px 5px 0 #613fe5;
        }
    </style>
</body>

</html>


<?php

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


pg_close($con);
?>