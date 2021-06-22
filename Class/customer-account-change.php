<?php 

ob_start();
session_start();
include "config.php";

$customerinfo=DB::getRow('SELECT * FROM customers WHERE customerid = ?',
      array($_SESSION["customerid"])
);

if (isset($_POST["accountpassword"])) {
	$accountpassword = $_POST["accountpassword"];
}else{
	$accountpassword = "";
}

if (isset($_POST["accountpasswordagain"])) {
	$accountpasswordagain = $_POST["accountpasswordagain"];
}else{
	$accountpasswordagain = "";
}


if( $accountpassword == $accountpasswordagain ) {
	
	if (isset($_POST["accountemail"])) {
		$accountemail = $_POST["accountemail"];
	}else{
		$accountemail = "";
	}

	if (isset($_POST["accountname"])) {
		$accountname = $_POST["accountname"];
	}else{
		$accountname = "";
	}

	if (isset($_POST["accountphone"])) {
		$accountphone = $_POST["accountphone"];
	}else{
		$accountphone = "";
	}

	echo $accountname . "<br>" ;
    echo $accountphone . "<br>";
    echo $accountemail . "<br>";
    echo $accountpassword . "<br>";
    echo "-----------------------" . "<br>";
	
	DB::query(
                'UPDATE customers SET customernamesurname=?, customertelephone=?, customermail=?, customerpassword=? WHERE customerid=?',
                array($accountname, $accountphone, $accountemail, $accountpassword,$_SESSION["customerid"])
     );

	$customerinfo2=DB::getRow('SELECT * FROM customers WHERE customerid = ?',
      array($_SESSION["customerid"])
	);

	if ($customerinfo != $customerinfo2) {
		Header("Location:http://localhost/RentACarProject/Customer/customerAccount.php?case=changetrue");
	}else{
		Header("Location:http://localhost/RentACarProject/Customer/customerAccount.php?case=changefalse");
	}
	
}else{

}

 ?>