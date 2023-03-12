<?php
include 'connection.php';
session_start();


if(isset($_POST['send'])) {
    $_SESSION['pname']=$_POST['pname'];
    $_SESSION['deptname']=$_POST['deptname'];
    $department_name = $_SESSION['deptname'];
    $_SESSION['pdescription']=$_POST['pdescription'];
    $_SESSION['pmoney']=$_POST['pmoney'];
    $_SESSION['psdate']=$_POST['psdate'];
    $_SESSION['pedate']=$_POST['pedate'];
    $_SESSION['pstatus']=$_POST['pstatus'];
    $_SESSION['plocation']=$_POST['plocation'];
    $_SESSION['plongitude']=$_POST['plongitude'];
    $_SESSION['platitude']=$_POST['platitude'];

    $create = "CREATE TABLE IF NOT EXISTS project_details (pid SERIAL PRIMARY KEY,
    pname varchar(100), dept_name varchar(100), pdescription varchar(300), budget_in_lakh money, psdate date, pedate date,
    pstatus varchar(50),plocation varchar(100), plongitude float, platitude float, dept_id int REFERENCES department_details)";

    // select query to fetch foreign keys
    // ------------------------------------------
                // dept_id
                $select = "SELECT dept_id from department_details WHERE department_name = '$department_name' ";
                $result = pg_query($conn,$select) or die("Failed select" .pg_last_error());
        
                $row = pg_fetch_assoc($result) or die("Failed row" .pg_last_error());
                if($row) {
                        $id3 = $row['dept_id'];
                }

    //--------------------------------------------

    $insert = "INSERT INTO project_details (pname,dept_name,pdescription,budget_in_lakh,psdate,pedate,pstatus,plocation,plongitude,platitude,dept_id) VALUES 
                ('".$_SESSION['pname']."','".$_SESSION['deptname']."','".$_SESSION['pdescription']."','".$_SESSION['pmoney']."','".$_SESSION['psdate']."','".$_SESSION['pedate']."',
                '".$_SESSION['pstatus']."','".$_SESSION['plocation']."','".$_SESSION['plongitude']."','".$_SESSION['platitude']."',$id3)";

    $q1=pg_query($conn,$create) or die("Failed q1" .pg_last_error());
    $q2=pg_query($conn,$insert) or die("Failed q2" .pg_last_error());

    if(!$q1 || !$q2) {
        echo "<script type=\"text/javascript\">
            alert(\"Error Storing Data\");
            window.location='../Dashboard/dashboard.php';
            </script>";
    }
    else {
        echo "<script type=\"text/javascript\">
            alert(\"Details Posted Successful\");
            window.location='../Dashboard/dashboard.php';
            </script>";
    }
}

?>