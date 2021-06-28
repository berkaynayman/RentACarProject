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
	<title>Kayıt Ol</title>
</head>
<body>
	<div class="container mt-5">
		<div class="card text-center">
			<div class="card-body">
				<div class="card-img-top">
					<img class="login-img" src="images/logo.png" alt="">
				</div>
				<?php
					if($getcase=="password-again"){
						?>
							<div class="alert alert-danger" role="alert">
							Parolalar uyuşmuyor. Tekrar Deneyin.
							</div>
						<?php
					}

					if($getcase=="notmail"){
						?>
							<div class="alert alert-danger" role="alert">
							Bu mail adresi kullanılamaz. Tekrar Deneyin.
							</div>
						<?php
					}

					if($getcase=="succes"){
						?>
							<div class="alert alert-success" role="alert">
							Mail adresinizde gelen linke tıklayın.
							</div>
						<?php
					}

					if($getcase=="danger"){
						?>
							<div class="alert alert-danger" role="alert">
							Bir sorun oluştu tekrar deneyin.
							</div>
						<?php
					}

					if($getcase=="activationtrue"){
						?>
							<div class="alert alert-success" role="alert">
							Mail adresiniziz aktivasyon işlemi yapılmıştır.
							</div>
						<?php
					}
				?>
				<form action="../Class/customer-add.php" method="POST" accept-charset="utf-8">
					<div class="input w-100">
					<input class="w-100" type="text" name="namesurname" value="" placeholder="Ad ve Soyad">
					</div>
					<div class="input w-100">
						<input class="w-100" type="tel" maxlength="11" minlength="11" name="phone" value="" 
						placeholder="+90 (___) ___ __ __" id="phone">
					</div>
					<div class="input w-100">
						<input class="w-100" type="password" name="password" value="" placeholder="Parola">
					</div>
					<div class="input w-100">
						<input class="w-100" type="password" name="password-again" value="" placeholder="Parola Tekrar">
					</div>
					<div class="input w-100">
						<input class="w-100" type="mail" name="email" value="" placeholder="E-posta">
					</div>
					<div class="input w-100">
						<button class="button login" type="submit">KAYIT OL</button>					
					</div>
				</form>
				</div>
				<div class="card-footer">
					<p>Hesabım Var</p>
					<a href="customerLogin.php">
					<button class="button register" type="submit">GİRİŞ YAP</button>		
					</a>			
				</div>
		</div>
	</div>

	<script type="text/javascript">
   
	</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>