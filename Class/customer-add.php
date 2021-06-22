<?php 

include "config.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


if(isset($_POST["password"])){
    $regpassword = $_POST["password"];
}else{
    $regpassword = "";
}

if(isset($_POST["password-again"])){
    $regpasswordagain = $_POST["password-again"];
}else{
    $regpasswordagain = "";
}


if( $regpassword == $regpasswordagain ) {
	
	if(isset($_POST["email"])){
	    $regemail = $_POST["email"];
	}else{
	    $regemail = "";
	}

	$mailcontrol = DB::getRow("SELECT * FROM customers WHERE customermail=?",array(
            $regemail
    ));

    print_r($mailcontrol);

	if ($mailcontrol>0) {
		Header("Location:http://localhost/RentACarProject/customerRegister.php?case=notmail");
		exit();
	}

	if(isset($_POST["namesurname"])){
    $regnamesurname = $_POST["namesurname"];
	}else{
	    $regnamesurname = "";
	}

	if(isset($_POST["phone"])){
	    $regphone = $_POST["phone"];
	}else{
	    $regphone = "";
	}	

	$durum = 0;
	$OneActivationCode = rand(100,200);
	$TwoActivationCode = rand(300,400);
	$Activation = $OneActivationCode . "-" . $TwoActivationCode ;
	echo $regnamesurname . "<br>" ;
    echo $regphone . "<br>";
    echo $regemail . "<br>";
    echo $regpassword . "<br>";
	echo $durum . "<br>" ;
    echo $Activation ;

	$adduser = DB::insert("INSERT INTO customers(customernamesurname,customertelephone,customermail,customerpassword,customeremailcheck,customeractivation) VALUES(?,?,?,?,?,?)",array(
            $regnamesurname,
            $regphone,
            $regemail,
            $regpassword,
            $durum,
            $Activation
	));

	if($adduser>0){

	    $MesajHazirla = "Merhaba Sayın " . $regnamesurname . " Sitemize yapmış olduğunuz üyelik kaydınıızı tamamlamak için <a href='localhost/RentACarProject/Class/customer-activation.php?activation=" . $Activation . "&email=" . $regemail . "'>Buraya Tıklayınız</a>
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
	        $mail->addAddress($regemail);     //Add a recipient
	        

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

		Header("Location:http://localhost/RentACarProject/Customer/customerRegister.php?case=succes");    
	}else{
	    Header("Location:http://localhost/RentACarProject/Customer/customerRegister.php?case=danger");    
	}

}else{
    Header("Location:http://localhost/RentACarProject/Customer/customerRegister.php?case=password-again");
}

?>