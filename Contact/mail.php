<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require './vendor/autoload.php';
$mail = new PHPMailer(true);

if(isset($_POST['send'])) {
    $sender=$_POST['sender'];
    $password=$_POST['password'];
    $receiver=$_POST['receiver'];
    $subject=$_POST['subject'];
    $message=$_POST['message'];
    
    $mail->SMTPDebug = 2;									
	$mail->isSMTP();											
	$mail->Host	 = 'smtp.gmail.com;';					
	$mail->SMTPAuth = true;													
	$mail->SMTPSecure = 'tls';							
	$mail->Port	 = 587;

    $mail->Username = $sender;				
	$mail->Password = $password;
	$mail->setFrom($sender);		
	$mail->addAddress($receiver);
	
	$mail->isHTML(true);								
	$mail->Subject = $subject;
	$mail->Body = $message;
	$result=$mail->send();
    if($result) {
        $_POST = array();
        echo "<script type=\"text/javascript\">
            alert(\"SEND\");
            window.location='email.html';
            </script>";   
    }
    else {
        $_POST = array();
        echo "<script type=\"text/javascript\">
            alert(\"Error Encountered!!\");
            window.location='email.html';
            </script>";
    }
}
?>

/*
Username = 'kiran2002bp@gmail.com';				
Password = 'kyjoepbonxnhdfsy';	
*/