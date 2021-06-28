<?php

session_start();
include "config.php";

if(isset($_SESSION["customerid"])){  $customerid = intval($_SESSION["customerid"]);}
if(isset($_SESSION["selectCarId"])){ $carid = intval($_SESSION["selectCarId"]);}
if(isset($_SESSION["date1"])){ $firsdate = $_SESSION["date1"]; }
if(isset($_SESSION["date2"])){ $lastdate = $_SESSION["date2"]; }
if(isset($_SESSION["carprice"])){ $price = $_SESSION["carprice"];}
if(isset($_SESSION["admincarid"])){ $admincarid = $_SESSION["admincarid"];}

if(isset($_POST["cardname"])){  $cardname = $_POST["cardname"];}
if(isset($_POST["month"])){
     $cardmonth = intval($_POST["month"]);
     if (  ($cardmonth>12) OR ($cardmonth<1) ) {
		Header("Location:http://localhost/RentACarProject/Customer/pay.php?case=monthfalse");
        exit();
     }
}

if(isset($_POST["year"])){  
    $cardyear = intval($_POST["year"]);
    if ( $cardyear<21 ) {
        Header("Location:http://localhost/RentACarProject/Customer/pay.php?case=yearfalse");
        exit();

    }
}

if( ($cardmonth<=6) AND ($cardyear=21) ){
    Header("Location:http://localhost/RentACarProject/Customer/pay.php?case=monthyearfalse");
    exit();

}

if(isset($_POST["cardnumber"])){$cardnumber = intval($_POST["cardnumber"]);
    $cardnumber = preg_replace('/[^\d]/', '', $cardnumber);
    $sum = '';
    for ($i = strlen($cardnumber) - 1; $i >= 0; -- $i) {
    $sum .= $i & 1 ? $cardnumber[$i] : $cardnumber[$i] * 2;
    }

    if (array_sum(str_split($sum)) % 10 == 0) {
        echo " 111 ";        
    }else{
		Header("Location:http://localhost/RentACarProject/Customer/pay.php?case=notcardnumber");
		exit();
    }


}
if(isset($_POST["cardcvc"])){   $cardcvc = intval($_POST["cardcvc"]);}
$nowdate=date("Y-m-d");




echo "customer ID -> " . var_dump(intval($customerid)) . "<br>" . "car ID -> " . var_dump($carid) . "<br>"
. "first Date -> " . var_dump($firsdate) . "<br>" . "last date -> " . var_dump($lastdate) . "<br>"
. "car price -> " . var_dump($price) . "<br>" . "cardname -> " . var_dump($cardname) . "<br>" 
. "month -> " . var_dump($cardmonth) . "<br>" . "card year -> " . var_dump($cardyear) . "<br>"
. "card number -> " . var_dump($cardnumber) . "<br>" . "cardcvc -> " . var_dump($cardcvc) . "now date -> " . var_dump($nowdate);


$operationa = DB::insert("INSERT INTO operations(customerid, adminid,carid, price, cardname, cardmonth, cardyear, cardnumber, cardcvc, firstdate, lastdate, operationdate) VALUES(?,?,?,?,?,?,?,?,?,?,?,?)",array(
    $customerid,
    $admincarid,
    $carid,
    $price,
    $cardname,
    $cardmonth,
    $cardyear,
    $cardnumber,
    $cardcvc,
    $firsdate,
    $lastdate,
    $nowdate
));  


echo "opertaiona" . "<br>";
var_dump($operationa);
echo $operationa;

if ($operationa>0) {
    Header("Location:http://localhost/RentACarProject/Customer/pay-okey.php?case=true");
}else{
    Header("Location:http://localhost/RentACarProject/Customer/pay-okey.php?case=false");
}
?>