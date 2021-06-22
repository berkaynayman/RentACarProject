<?php

ob_start();
session_start();
include "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if(isset($_POST["email"])){
    $logemail = $_POST["email"];
}else{
    $logemail = "";
}

if(isset($_POST["password"])){
    $logpassword = $_POST["password"];
}else{
    $logpassword = "";
}


$customercheck = DB::getRow("SELECT * FROM customers WHERE customermail=? AND customerpassword=?",array(
            $logemail,
            $logpassword
));


if ($customercheck->customeremailcheck==1) {
	if ($customercheck->customerid) {
		$_SESSION["customerid"] = $customercheck->customerid;
		Header("Location:http://localhost/RentACarProject/Customer/index.php");
	}else{
		Header("Location:http://localhost/RentACarProject/login.php?case=notdata");
	}
}else{

	$MesajHazirla = "Merhaba Sayın " . $admincheck->adminnamesurname . " Sitemize yapmış olduğunuz üyelik kaydınıızı tamamlamak 
	için <a href='localhost/RentACarProject/Class/activation.php?activation=" . $admincheck->adminactivation . "&email=" . $admincheck->adminemail . "'>Buraya Tıklayınız</a>
	<br> Saygılarımızla iyi çalışmalar <br> Rent A Car"; 
    $mail = new PHPMailer(true);
    try {
        //Server settings
        $mail->SMTPDebug = 0;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'berkaynayman06@gmail.com';                     //SMTP username
        $mail->Password   = '36crazyboy';                               //SMTP password
        $mail->SMTPSecure = 'TLS';         //Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        $mail->Port       = 587;                                    //TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->Charset    = "UTF-8";

        //Recipients
        $mail->setFrom('berkaynayman06@gmail.com', 'Berkay Nayman');
        $mail->addAddress($admincheck->adminemail);     //Add a recipient
        

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Üyelik aktivasyonu';
        $mail->Body    = $MesajHazirla;
        //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

	Header("Location:http://localhost/RentACarProject/login.php?case=activationagain");


}


?>