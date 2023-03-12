<?php
session_destroy();

echo "<script type=\"text/javascript\">
            alert(\"LogOut Successful!\");
            window.location='../home.html';  
            </script>";
?>
