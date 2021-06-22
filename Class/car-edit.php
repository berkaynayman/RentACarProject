<?php 
include "config.php";

if(isset($_GET["deletecarid"]))
{
	  $deletecarid = $_GET["deletecarid"];
	
	  $deletecaridlocation = DB::getRow("SELECT carimage FROM admincars WHERE carid=?",array(
	    $deletecarid
	  ));
	  
	  echo "print_r" . "<br>";
	  print_r($deletecarid);
	  echo "<br>" . $deletecarid;


	  $deleteimgname = $deletecaridlocation->carimage;

	  echo "<br>" . $deleteimgname;

	  if($deleteimgname){
	    unlink("admincarsimages/$deleteimgname");
	  }

	  DB::query(
	    'DELETE FROM admincars WHERE carid=?',
	    array($deletecarid)
	  );

	 Header("Location:http://localhost/RentACarProject/cars.php?case=cardeletetrue");
}
  
  
 ?>