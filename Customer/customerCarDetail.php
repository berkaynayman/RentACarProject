<?php

include "../Class/config.php";
session_start();
echo $_GET["selectCarId"];
$_SESSION["selectCarId"] = $_GET["selectCarId"];
$carId = $_GET["selectCarId"];

$listCarsInfo=DB::getRow('SELECT * FROM admincars WHERE carid = ?',
        array($carId)
);

print_r($listCarsInfo);

$carDayPrice = floatval($listCarsInfo->carprice);
echo $carDayPrice;

$date1=$_SESSION["date1"];
$date2=$_SESSION["date2"];

$datee1=date_create($_SESSION["date1"]);
$datee2=date_create($_SESSION["date2"]);

$diff = date_diff($datee1,$datee2);
$totalDay = $diff->format("%a");
echo "iki tarih arasındaki fark " . "<br>" . $totalDay ;

$carPrice = $carDayPrice * $totalDay;

$_SESSION["carprice"] = $carPrice;
?>

<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="../CSS/customerCarDetail.less" />
	<!-- Less JS -->
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

	<!-- Car Aktif - Pasif -->
	<link rel="stylesheet" type="text/css" href="CSS/switch.css">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

	<!-- JQUERY -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>

	<!-- Google Font -->
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	</style>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Araç Seçiniz</title>
</head>
<body>
	<div class="container mt-5 mb-5">
		<nav class="navbar navbar-expand-xl navbar-light">
		  <div class="container">
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavDropdown">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link" aria-current="page" href="account.php">TARİH SEÇİMİ</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">ARAÇ SEÇİMİ</a>
		        </li>
		        <li class="nav-item active">
		          <a class="nav-link" href="#">ARAÇ DETAY</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="Class/exit.php">ÖDEME EKRANI
		          </a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<section class="car-detail">
            <div class="row">
                <div class="col-xl-7">
                    <img class="car-image" src="../Class/admincarsimages/<?=$listCarsInfo->carimage?>">
                </div>
                <div class="col-xl-4 p-5">
                    <table class="table">
                        <tbody>
                        <tr>
                            <th>Marka</th>
                            <td><?=$listCarsInfo->carbrand?></td>
                        </tr>
                        <tr>
                            <th>Model</th>
                            <td><?=$listCarsInfo->carmodel?></td>
                        </tr>
                        <tr>
                            <th>Yakıt</th>
                            <td><?=$listCarsInfo->carfuel?></td>
                        </tr>
                        <tr>
                            <th>Vites</th>
                            <td><?=$listCarsInfo->carvites?></td>
                        </tr>
                        <tr>
                            <th>Renk</th>
                            <td><?=$listCarsInfo->carcolor?></td>
                        </tr>
                        <tr>
                            <th>Plaka</th>
                            <td><?=$listCarsInfo->carplaque?></td>
                        </tr>
                        </tbody>
                    </table>
                    
                    
                    <div class="date-price-info">
                        <div class="date">
                            <h3><?=$date1?><span>tarihinde teslim alıcaksın</span></h3>
                            <h3><?=$date2?><span>tarihinde teslim adiceksin</span></h3>
                        </div>
                        <div class="total-price">
                            <h2 class="text-center"><?=$carPrice?>₺</h2>
                            <h4 class="text-center">Ödeme Yapıcaksın</h4>
                            <a href="pay.php">
                              <button type="button" class="btn text-white w-100 p-3">
                                ÖDEME EKRANINA GİT
                              </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
			

		
	</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>