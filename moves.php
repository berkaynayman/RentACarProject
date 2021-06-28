<?php 

ob_start();
session_start();
include "Class/config.php";

$admininfo=DB::getRow('SELECT * FROM admins WHERE adminid = ?',
      array($_SESSION["adminid"])
);


if (empty($admininfo)) {
	Header("Location:http://localhost/RentACarProject/login.php");
	exit();
}

if(isset($_GET["case"])){
	$getcase = $_GET["case"];
}else{
	$getcase = "";
}

$operationsgecmis = DB::get('SELECT * FROM operations WHERE adminid=? AND operationcase = ?',
    array($_SESSION["adminid"],0)
);

$operationsdevameden = DB::get('SELECT * FROM operations WHERE adminid=? AND operationcase = ?',
    array($_SESSION["adminid"],1)
);

?>

<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="CSS/account.less" />
	<!-- Less JS -->
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

	<!-- Google Font -->
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	</style>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Admin Paneli</title>
</head>
<body>
	<div class="container mt-5">

		<nav class="navbar navbar-expand-xl navbar-light">
		  <div class="container">
		    <a class="navbar-brand" href="#">
		    	<img src="images/logo.png" class="logo" alt="">
		    </a>
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavDropdown">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link" aria-current="page" href="#">HESABIM</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">HAREKETLER</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="cars.php">ARAÇLAR</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="Class/exit.php">ÇIKIŞ
		          	<i class="fas fa-sign-out-alt"></i>
		          </a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<div class="accordion mt-5" id="accordionExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingOne">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    DEVAM EDEN İŞLEMLER
                </button>
                </h2>
                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">İlk Tarih</th>
                                        <th scope="col">Son Tarih</th>
                                        <th scope="col">İşlem Tarihi Tarih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($operationsdevameden as $key) {  ?>
                                        <tr>
                                        <td> <?php echo $key->price ?> </td>
                                        <td> <?php echo $key->firstdate ?> </td>
                                        <td> <?php echo $key->lastdate ?> </td>
                                        <td> <?php echo $key->operationdate ?> </td>
                                        </tr>
                                        
                                    <?php } ?>
                                </tbody>
                            </table>
                </div>
                </div>
            </div>
            <div class="accordion-item">
                <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    GEÇMİŞ İŞLEMLER
                </button>
                </h2>
                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">Fiyat</th>
                                        <th scope="col">İlk Tarih</th>
                                        <th scope="col">Son Tarih</th>
                                        <th scope="col">İşlem Tarihi Tarih</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($operationsgecmis as $key) {  ?>
                                        <tr>
                                        <td> <?php echo $key->price ?> </td>
                                        <td> <?php echo $key->firstdate ?> </td>
                                        <td> <?php echo $key->lastdate ?> </td>
                                        <td> <?php echo $key->operationdate ?> </td>
                                        </tr>
                                        
                                    <?php } ?>
                                </tbody>
                            </table>
                </div>
                </div>
            </div>
            
        </div>

	</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>