<?php
include "config.php";

if(isset($_GET["activation"])){
    $mailactivation = $_GET["activation"];
}else{
    $mailactivation = "";
}

if(isset($_GET["email"])){
    $mailemail = $_GET["email"];
}else{
    $mailemail = "";
}

/*$GuncellemeSorgusu = $Baglan->prepare("UPDATE adminler SET durum = ? WHERE email = ? AND aktivasyon = ?");
$GuncellemeSorgusu->execute([1, $GelenEmail, $GelenAktivasyon]);
*/
$UpdateSql = DB::query('UPDATE admins SET adminemailcheck=? WHERE adminemail=? AND adminactivation=?', array(1,$mailemail, $mailactivation)
);

if($UpdateSql>0){
	Header("Location:http://localhost/RentACarProject/register.php?case=activationtrue");
}else{
	Header("Location:http://localhost/RentACarProject/register.php?case=activationfalse");
}

?>