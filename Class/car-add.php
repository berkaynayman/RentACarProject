<?php


include "verot.net.php";
include "config.php";

ob_start();
session_start();

$admininfo=DB::getRow('SELECT * FROM admins WHERE adminid = ?',
      array($_SESSION["adminid"])
);

$cars = array("Renault", "Toyota", "BMW", "AUDI", "FIAT", "FORD",
	"Clio", "Espace", "Fluence", "Megane",
	"Auris", "Avensis", "Corolla", "Yaris",
	"1 Serisi","2 Serisi", "M Serisi", "Z Serisi",
	"A1","A3","A6","S Serisi",
	"500 Ailesi", "Egea", "Bravo", "Linea",
	"Mustang", "Mondeo", "Taunus", "Focus"
);

/* Yakıt Tipleri Dizi */
$gasTypeArray  = array("Dizel", "Benzin", "LPG", "Elektrik");
/* Vites Tipleri Dizi */
$vitesTypeArray = array("Manuel", "Otomatik");
/* Renk Tipleri Dizi */
$colorArray		= array("Siyah", "Beyaz", "Mavi", "Gri", "Kırmızı", "Lacivert", "Yeşil", "Sarı", "Turuncu");


if(isset($_POST["carBrand"])){$carbrand = $_POST["carBrand"];}else{$carbrand = "";}

if(isset($_POST["carModel"])){$carmodel = $_POST["carModel"];}else{$carmodel = "";}

if(isset($_POST["carfuel"])){$carfuel = $_POST["carfuel"];}else{$carfuel = "";}

if(isset($_POST["carvites"])){$carvites = $_POST["carvites"];}else{$carvites = "";}

if(isset($_POST["carcolor"])){$carcolor = $_POST["carcolor"];}else{$carcolor = "";}

if(isset($_POST["carplaque"])){$carplaque = $_POST["carplaque"];}else{$carplaque = "";}

if(isset($_POST["carprice"])){$carprice = $_POST["carprice"];}else{$carprice = "";}

$bulunacak = array('ç','Ç','ı','İ','ğ','Ğ','ü','ö','Ş','ş','Ö','Ü',',',' ','(',')','[',']'); 
$degistir  = array('c','C','i','I','g','G','u','o','S','s','O','U','','_','','','',''); 

if(isset($_FILES["carimage"])){
    $foo = new upload($_FILES["carimage"]);
    if ($foo->uploaded) {
        $foo->file_new_name_body = trim($admininfo->adminid) . str_replace($bulunacak,$degistir,$admininfo->adminnamesurname) . "araba";
        $foo->process("admincarsimages");
        if ($foo->processed) {
          $carimagename = $foo->file_dst_name;

            $id = DB::insert("INSERT INTO admincars(adminid, carbrand, carmodel, carfuel, carvites, carcolor, carplaque, carprice, carimage) VALUES(?,?,?,?,?,?,?,?,?)",array(
              $admininfo->adminid,
              $cars[$carbrand-1],
              $cars[$carmodel-1],
              $gasTypeArray[$carfuel],
              $vitesTypeArray[$carvites],
              $colorArray[$carcolor],
              $carplaque,
              $carprice,
              $carimagename
            ));  
        }
        if ($id>0) {
			Header("Location:http://localhost/RentACarProject/cars.php?case=carsaddtrue");
        }
    }
}



?>