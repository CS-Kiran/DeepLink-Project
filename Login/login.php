<?php
include 'connection.php';
session_start();
if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['login']))
{
    function validate($data)
    {
        $data=trim($data);
        $data=stripslashes($data);
        $data=htmlspecialchars($data);
        return $data;
    }

    $username = validate($_POST['username']);
    $email=validate($_POST['email']);
    $pass=validate(md5($_POST['pass']));

    $insert="SELECT * from login_details where username='$username' AND email='$email' AND password='$pass'";

    $r=pg_query($conn,$insert) or die("Error : ".pg_last_error());

    if(pg_num_rows($r)===1)
    {
        $row=pg_fetch_assoc($r) or die("Error : ".pg_last_error());

        // change the location to dashboard ...
        if($row['username']===$username && $row['email']===$email && $row['password']===$pass)
        {
            $_SESSION['username']=$row['username'];
            $_SESSION['email']=$row['email'];
            $_SESSION['pass']=$row['password'];
            $abc=$_SESSION['person_id']=$row['person_id'];
            echo "<script type=\"text/javascript\">
            alert(\"Login Successful!!\");
            window.location='../Dashboard/dashboard.php';  
            </script>";
        }
    }

    
    else{
        echo "<script type=\"text/javascript\">
            alert(\"Invalid Credentials...Check Again\");
            window.location='login.html';
            </script>";
    }
}
?>