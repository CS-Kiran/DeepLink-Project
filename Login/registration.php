<?php
include 'connection.php';
session_start();

if(isset($_POST['register'])) {
    $_SESSION['department_name']=$_POST['department_name'];
    $_SESSION['department_type']=$_POST['department_type'];
    $_SESSION['department_description']=$_POST['department_description'];
    $_SESSION['department_head']=$_POST['department_head'];
    $_SESSION['department_email']=$_POST['department_email'];
    $_SESSION['department_phone']=$_POST['department_phone'];
    $_SESSION['department_address']=$_POST['department_address'];
    
    $_SESSION['first_name']=$_POST['first_name'];
    $_SESSION['last_name']=$_POST['last_name'];
    $_SESSION['dob']=$_POST['dob'];
    $_SESSION['personal_address']=$_POST['personal_address'];
    $_SESSION['designation']=$_POST['designation'];
    $_SESSION['department_uid']=$_POST['department_uid'];
    
    $_SESSION['username']=$_POST['username'];
    $_SESSION['email']=$_POST['email'];
    $_SESSION['pass']=$_POST['pass'];

    $create1 = "CREATE TABLE IF NOT EXISTS department_details (dept_id SERIAL PRIMARY KEY,
            department_name varchar(100), department_type varchar(100), department_description varchar(300),
            department_head varchar(100), department_email varchar(100), department_phone varchar(10), department_address varchar(100))" ;

    $create2 = "CREATE TABLE IF NOT EXISTS personal_details (person_id SERIAL PRIMARY KEY, first_name varchar(30), 
            last_name varchar(30), dob date, personal_address varchar(100), designation varchar(100), department_uid varchar(5),
            dept_id int REFERENCES department_details)" ;

    $create3 = "CREATE TABLE IF NOT EXISTS login_details (username varchar(20), email varchar(50), password varchar(100), person_id int REFERENCES personal_details)";
    

    $insert1 = "INSERT INTO department_details (department_name, department_type, department_description, department_head, department_email, department_phone, department_address) VALUES 
    ('".$_SESSION['department_name']."','".$_SESSION['department_type']."','".$_SESSION['department_description']."','".$_SESSION['department_head']."','".$_SESSION['department_email']."',
    '".$_SESSION['department_phone']."','".$_SESSION['department_address']."') ";


    $q1 = pg_query($conn,$create1) or die("failed q1");
    $i1 = pg_query($conn,$insert1) or die ("failed i1");

    $q2 = pg_query($conn,$create2) or die ("failed q2");

    

    
    // select query to fetch foreign keys
    // ------------------------------------------
                // dept_id
                $select1 = "SELECT dept_id from department_details ORDER BY dept_id  DESC LIMIT 1" ;
                $result1 = pg_query($conn,$select1) or die("Failed " .pg_last_error());
        
                $row1 = pg_fetch_assoc($result1) or die("Failed " .pg_last_error());
                if($row1) {
                        $id1 = $row1['dept_id'];
                }
                  
    //--------------------------------------------

    $insert2 = "INSERT INTO personal_details (first_name, last_name, dob, personal_address, designation, department_uid, dept_id) VALUES 
    ('".$_SESSION['first_name']."','".$_SESSION['last_name']."','".$_SESSION['dob']."','".$_SESSION['personal_address']."',
    '".$_SESSION['designation']."','".$_SESSION['department_uid']."',$id1)";

    $i2 = pg_query($conn,$insert2) or die ("failed i2 : ".pg_last_error());

    $q3 = pg_query($conn,$create3);

        // select query to fetch foreign keys
    // ------------------------------------------
                // person_id
        $select2 = "SELECT person_id from personal_details ORDER BY person_id  DESC LIMIT 1" ;
        $result2 = pg_query($conn,$select2) or die("Failed " .pg_last_error());

        $row2 = pg_fetch_assoc($result2) or die("Failed " .pg_last_error());
        if($row2) {
                $id2 = $row2['person_id'];
        }

    //--------------------------------------------

    $insert3 = "INSERT INTO login_details (username,email,password, person_id) VALUES ('".$_POST['username']."','".$_POST['email']."',
    '".md5($_POST['pass'])."',$id2)";

    $i3 = pg_query($conn,$insert3) or die ("failed i3".pg_last_error());

    if(!$q1 || !$q2 || !$q3 || !$i1 || !$i2 || !$i3) {
        echo "<script type=\"text/javascript\">
            alert(\"Error Storing Data...Please try Again\");
            window.location='registration.html';
            </script>";
    }
    else {
        echo "<script type=\"text/javascript\">
            alert(\"Registration Successful\");
            window.location='login.html';
            </script>";
    }
}
?>