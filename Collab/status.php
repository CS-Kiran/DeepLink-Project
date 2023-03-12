<?php
include("../connection.php");
session_start();

$id=$_REQUEST['id'];

if(isset($_REQUEST['approve'])) {
    $query1="SELECT * FROM collab_req_details WHERE request_id=$id";
    $result1 = pg_query($conn, $query1);
    while ($row1 = pg_fetch_array($result1)) {
        $pid=$row1['project_id'];
        $dept_name1=$row1['from_department_name'];
        $budget1 = $row1['budget_in_lakh'];
        $date1=$row1['duration'];
    }

    $query2="SELECT * FROM project_details WHERE pid=$pid";
    $result2 = pg_query($conn, $query2);
    while ($row2 = pg_fetch_array($result2)) {
        $dept_name2=$row2['dept_name'];
        $budget2= (float) $row2['budget_in_lakh'];
        $date2=$row2['pedate'];
    }

    $dept_name = $dept_name1 ." & ". $dept_name2;
    
    if($date1 > $date2)
    {
        $date= $date1;
    }
    else {
        $date= $date2;
    }

    $update1="UPDATE project_details SET dept_name='$dept_name' , pedate='$date' WHERE pid=$pid";
    $q1=pg_query($conn,$update1) or die("Failed q1 ".pg_last_error());
    
    $u3="UPDATE collab_req_details SET req_status='t' WHERE request_id=$id";
    $q3=pg_query($conn,$u3) or die("Failed q3 ".pg_last_error());

    if(!$update1 || !$q1 || !$u3 || !$q3){
        echo "<script type=\"text/javascript\">
            alert(\"Could Not Accept...Please Try Again\");
            window.location='notification.php';
            </script>";
    }
    else {
        echo "<script type=\"text/javascript\">
            alert(\"Accept Request Successful\");
            window.location='notification.php';
            </script>";
    }

}

if(isset($_REQUEST['decline'])) {
    $update2="UPDATE collab_req_details SET req_status='t' WHERE request_id=$id";
    $q2=pg_query($conn,$update2);
    if(!$update2 || !$q2){
        echo "<script type=\"text/javascript\">
            alert(\"Could Not Decline...Please Try Again\");
            window.location='notification.php';
            </script>";
    }
    else {
        echo "<script type=\"text/javascript\">
            alert(\"Decline Request Successful\");
            window.location='notification.php';
            </script>";
    }
}

?>