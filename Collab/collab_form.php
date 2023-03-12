<?php
include("../connection.php");

session_start();

if (isset($_POST['submit'])) {

    $_SESSION['dept_name'] = $_POST['department_name'];
    $dept_name = $_SESSION['dept_name'];

    $_SESSION['pid'] =   $_POST['pid'];
    $_SESSION['subject'] = $_POST['subject'];
    $_SESSION['budget'] = $_POST['budget'];
    $_SESSION['duration'] = $_POST['duration'];
    $_SESSION['content'] =   $_POST['content'];
    $_SESSION['status'] = 0;


    // add NOT NULL statements to boolean and also look for unique in other tables

    
    $create1 = "CREATE TABLE IF NOT EXISTS collab_req_details (request_id SERIAL PRIMARY KEY ,sender_dept_id int,
        from_department_name varchar(100),to_department_name varchar(100), 
        project_id int REFERENCES project_details, subject varchar(100), 
        budget_in_lakh money, duration date ,content varchar(300),
        req_status boolean,receiver_dept_id int, posted_on date )";
    $c1 = pg_query($conn, $create1) or die("Failed c1" . pg_last_error());

    $a = $_SESSION['dept_id'];

    $select1 = "SELECT dept_id from department_details where department_name = '$dept_name' ";
    $s1 = pg_query($conn, $select1) or die("Failed s1" . pg_last_error());
    $r1 = pg_fetch_assoc($s1) or die("Failed r1" . pg_last_error());
    if ($r1) {
        $receiver_dept_id = $r1['dept_id'];
    }

    $insert1 = "INSERT INTO collab_req_details (sender_dept_id,from_department_name,to_department_name,project_id,
    subject,budget_in_lakh, duration,content,req_status,receiver_dept_id,posted_on) VALUES ($a,'" . $_SESSION['department_name'] . "',
    '" . $_SESSION['dept_name'] . "','" . $_SESSION['pid'] . "','" . $_SESSION['subject'] . "','" . $_SESSION['budget'] . "',
    '" . $_SESSION['duration'] . "','" . $_SESSION['content'] . "','" . $_SESSION['status'] . "',$receiver_dept_id, now())";
    $i1 = pg_query($conn, $insert1) or die("Failed r1" . pg_last_error());

    if (!$c1 || !$s1 || !$r1 || !$i1) {
        echo "<script type=\"text/javascript\">
            alert(\"Error Sending Message\");
            window.location='collab_form.html';
            </script>";
    } else {
        echo "<script type=\"text/javascript\">
            alert(\"Request Send\");
            window.location='collab_form.html';
            </script>";
    }
}
