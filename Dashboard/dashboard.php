<?php
session_start();
include '../connection.php';
?>
<html>

<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="./dashboard.css">
</head>

<body>
    <?php

    $pid = $_SESSION['person_id'];

    $s1 = "SELECT first_name , last_name , dept_id , designation FROM personal_details WHERE person_id = $pid";
    $r1 = pg_query($conn, $s1) or die("Failed " . pg_last_error());

    $row1 = pg_fetch_assoc($r1) or die("Failed " . pg_last_error());
    if ($row1) {
        $dept_id = $row1['dept_id'];
        $_SESSION['dept_id'] = $dept_id;
        $_SESSION['first_name'] = $row1['first_name'];
        $_SESSION['last_name'] = $row1['last_name'];
        $_SESSION['designation'] = $row1['designation'];
    }



    $s2 = "SELECT department_name FROM department_details WHERE dept_id = $dept_id";
    $r2 = pg_query($conn, $s2) or die("Failed " . pg_last_error());

    $row2 = pg_fetch_assoc($r2) or die("Failed " . pg_last_error());
    if ($row2) {
        $_SESSION['department_name'] = $row2['department_name'];
    }


    ?>
    <div class="logo">
        <h3>Deep Link</h3>
        <img src="../Assets/link.png">
    </div>
    <form action="../Login/logout.php" method="post">
        <div class="navigation">
            <nav>
                <a href="../Collab/all_projects.php">All Projects</a>
                <a href="../Project/proj_details.html">Post Projects</a>
                <a href="../Collab/notification.php">Notifications</a>
                <a href="../Collab/collab_form.html">Collaboration</a>
                <button id="logout">LOGOUT</button>
            </nav>
        </div>

        <p id="intro2">
            <?php
            echo $_SESSION['department_name'];
            echo "<br>";
            ?>
        </p>
        <h1>Welcome!
            <p id="intro">
                <?php
                echo $_SESSION['designation'];
                echo "  :&nbsp;";
                echo $_SESSION['first_name'];
                echo "&nbsp;";
                echo $_SESSION['last_name'];
                echo "<br>";
                ?>
            </p>
        </h1>

        <!-- ------------------------------------------------------------------------------------------------- -->
        <div class="tab">
            <h1 style="margin-top:450px; text-align:center; color : #613fe5; font-weight:600; font-size: 30px; padding:15px; font-family:'Courier New', Courier, monospace;">
                Your Projects
            </h1>
            <?php
            include 'connection.php';

            error_reporting(0);

            $query = "SELECT pid, pname,dept_name,pstatus,psdate,pedate,plocation,platitude,plongitude FROM project_details WHERE dept_id=$dept_id ORDER BY pid ASC";

            $result = pg_query($conn, $query);

            echo "<table border='3' cellspacing='0' style='position:absolute; margin-top:520px;' >

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
            <br><br>
        </div>
        <div class="space">
        </div>
    </form>
</body>

</html>