<?php 

ob_start();
session_start();
include "config.php";

$admininfo=DB::getRow('SELECT * FROM admins WHERE adminid = ?',
      array($_SESSION["adminid"])
);

print_r($admininfo);

/*if (isset($_POST["accounttcno"])) {
	$accounttcno = $_POST["accounttcno"];
}else{
	$accounttcno = "";
}*/


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


    /*
	$adduser = DB::insert("INSERT INTO admins(adminnamesurname,admintelephone,adminemail,adminpassword,adminemailcheck,adminactivation) VALUES(?,?,?,?,?,?)",array(
            $regnamesurname,
            $regphone,
            $regemail,
            $Md5,
            $durum,
            $Activation
	));*/


	
	DB::query(
                'UPDATE admins SET adminnamesurname=?, admintelephone=?, adminemail=?, adminpassword=? WHERE adminid=?',
                array($accountname, $accountphone, $accountemail, $accountpassword,$_SESSION["adminid"])
     );

	$admininfo2=DB::getRow('SELECT * FROM admins WHERE adminid = ?',
      array($_SESSION["adminid"])
	);

	if ($admininfo != $admininfo2) {
		Header("Location:http://localhost/RentACarProject/account.php?case=changetrue");
	}else{
		Header("Location:http://localhost/RentACarProject/account.php?case=changefalse");
	}
	
}else{

}









echo "account-change.php";

 ?>