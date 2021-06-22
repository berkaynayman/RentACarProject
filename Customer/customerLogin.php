<?php
if(isset($_GET["case"])){
	$getcase = $_GET["case"];
}else{
	$getcase = "";
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="../CSS/style.less" />
	<!-- Less JS -->
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

	<!-- Google Font -->
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	</style>

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Giriş Yap</title>
</head>
<body>
	<div class="container mt-5">
		<div class="card text-center">
			<div class="card-body">
				<div class="card-img-top">
					<img class="login-img" src="images/logo.png" alt="">
				</div>
				<?php
					if($getcase=="notdata")
						{
							?>
							<div class="alert alert-danger" role="alert">
							Böyle bir kayıt bulunmamaktadır
							</div>
							<?php
						}

					if($getcase=="activationagain")
                        {
                            ?>
                            <div class="alert alert-danger" role="alert">
                            Aktivasyon kaydınızı tamamlamamışsınız size yeni bir
                            mail gönderdik. Lütfen mail deki linke tıklayınız.
                            </div>
                            <?php
                        }
					
				?>
				<form action="../Class/customer-login.php" method="POST">
					<div class="input w-100">
						<input class="w-100" type="mail" name="email" value="" placeholder="E-posta">
					</div>
					<div class="input w-100">
						<input class="w-100" type="password" name="password" value="" placeholder="Parola">
					</div>
					<div class="input w-100">
						<button class="button login">GİRİŞ YAP</button>					
					</div>		
				</form>	
			</div>
			<div class="card-footer">
				<p>Hesabım Yok</p>
				<a href="customerRegister.php">
					<button class="button register" type="submit">KAYIT OL</button>										
				</a>
			</div>
			
		</div>
	</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>