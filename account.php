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

		<section class="account-info mt-4">
			<div class="card text-center">
				<div class="card-body">
					<?php
						if($getcase=="changetrue")
							{
								?>
								<div class="alert alert-success" role="alert">
								Değişikleriniz kaydedilmiştir
								</div>
								<?php
							}

						if($getcase=="changefalse")
						{
							?>
							<div class="alert alert-danger" role="alert">
							Bir değişiklik yapılmamış, lütfen değişiklik yaptığınızdan emin olun.
							</div>
							<?php
						}
						
					?>
					<div class="input w-100">
						<input class="w-100" disabled="disabled" type="text" name="" value="<?= $admininfo->adminnamesurname ?>" placeholder="Ad ve Soyad">
					</div>
					<div class="input w-100">
						<input class="w-100" disabled="disabled" type="text" name="phone" value="<?php echo $admininfo->admintelephone; ?>" 
						placeholder="">
					</div>
					<div class="input w-100">
						<input class="w-100" disabled="disabled" type="number" name="tcno" placeholder="TCNO" value="">
					</div>
					<div class="input w-100">
						<input class="w-100" disabled="disabled" type="mail" name="" value="<?php echo $admininfo->adminemail; ?>" placeholder="E-posta" >
					</div>
					<div class="input w-100">
						<input class="w-100" disabled="disabled" type="password" name="" value="<?= $admininfo->adminpassword ?>" placeholder="Parola">
					</div>
					
					<div class="input w-100">
						<section class="info-change mt-3">
							<button type="button" class="button save" data-bs-toggle="modal" data-bs-target="#infochange">
							  DÜZENLE
							</button>
							<!-- Modal -->
							<div class="modal fade" id="infochange" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
							  <div class="modal-dialog modal-dialog-centered">
							    <div class="modal-content">
							      <div class="modal-header">
							        <h5 class="modal-title" id="exampleModalLabel">Bilgilerimi Düzenle</h5>
							        <button type="button" class="btn one" data-bs-dismiss="modal" >X</button>
							      </div>
							      <div class="modal-body">
							      	<form action="Class/account-change.php" method="POST">
									    <div class="input w-100">
											<input type="text" name="accountname" value="<?= $admininfo->adminnamesurname ?>" placeholder="Ad ve Soyad">
										</div>
										<div class="input w-100">
											<input type="text" name="accountphone" value="<?php echo $admininfo->admintelephone; ?>" 
											placeholder="">
										</div>
										<div class="input w-100">
											<input type="number" name="accounttcno" placeholder="TCNO" value="">
										</div>
										<div class="input w-100">
											<input type="mail" name="accountemail" value="<?php echo $admininfo->adminemail; ?>" placeholder="E-posta" >
										</div>
										<div class="input w-100">
											<input type="password" name="accountpassword" value="<?= $admininfo->adminpassword ?>" placeholder="Parola">
										</div>
										<div class="input w-100">
											<input type="password" name="accountpasswordagain" value="<?= $admininfo->adminpassword ?>" placeholder="Parola">
										</div>
								      	</div>
								      	<div class="modal-footer">
								        	<button type="submit" class="btn one">Kaydet</button>
								        	<button type="button" class="btn btn-danger" data-bs-dismiss="modal">İptal</button>
								      	</div>
							      	</form>
							      </div>
							  </div>
							</div>
						</section>
					</div>
				</div>
			</div>
		</section>
	</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>