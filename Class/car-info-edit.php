<?php 

include "config.php";

if(isset($_POST["carid"])){ $carid = $_POST["carid"];}else{$carid = "";}

$carinfo=DB::getRow('SELECT * FROM admincars WHERE carid = ?',
      array($carid)
);


if(isset($_POST["carbrand"])){$carbrand = $_POST["carbrand"];}else{$carbrand = "";}

if(isset($_POST["carmodel"])){$carmodel = $_POST["carmodel"];}else{$carmodel = "";}

if(isset($_POST["carfuel"])){$carfuel = $_POST["carfuel"];}else{$carfuel = "";}

if(isset($_POST["carvites"])){$carvites = $_POST["carvites"];}else{$carvites = "";}

if(isset($_POST["carcolor"])){$carcolor = $_POST["carcolor"];}else{$carcolor = "";}

if(isset($_POST["carplaque"])){$carplaque = $_POST["carplaque"];}else{$carplaque = "";}

if(isset($_POST["carprice"])){$carprice = $_POST["carprice"];}else{$carprice = "";}


DB::query('UPDATE admincars SET carbrand=?, carmodel=?, carfuel=?, carvites=?, carcolor=?, carplaque=?, carprice=? WHERE carid=?',
          array($carbrand, $carmodel, $carfuel, $carvites, $carcolor, $carplaque, $carprice, $carid)
);

$carinfo2=DB::getRow('SELECT * FROM admincars WHERE carid = ?',
      array($carid)
);

if ($carinfo != $carinfo2) {
	Header("Location:http://localhost/RentACarProject/cars.php?case=carsedittrue");
}else{
	Header("Location:http://localhost/RentACarProject/cars.php?case=carseditfalse");
}

 ?>