<?php
session_start();

if(!empty($_SESSION["customerid"]))
{
	$customerId = $_SESSION["customerid"];
}

if(isset($_GET["case"])){
	$getcase = $_GET["case"];
}else{
	$getcase = "";
}

$city = array('Adana', 'Adıyaman', 'Afyon', 'Ağrı', 'Amasya', 'Ankara', 'Antalya', 'Artvin',
'Aydın', 'Balıkesir', 'Bilecik', 'Bingöl', 'Bitlis', 'Bolu', 'Burdur', 'Bursa', 'Çanakkale',
'Çankırı', 'Çorum', 'Denizli', 'Diyarbakır', 'Edirne', 'Elazığ', 'Erzincan', 'Erzurum', 'Eskişehir',
'Gaziantep', 'Giresun', 'Gümüşhane', 'Hakkari', 'Hatay', 'Isparta', 'Mersin', 'İstanbul', 'İzmir', 
'Kars', 'Kastamonu', 'Kayseri', 'Kırklareli', 'Kırşehir', 'Kocaeli', 'Konya', 'Kütahya', 'Malatya', 
'Manisa', 'Kahramanmaraş', 'Mardin', 'Muğla', 'Muş', 'Nevşehir', 'Niğde', 'Ordu', 'Rize', 'Sakarya',
'Samsun', 'Siirt', 'Sinop', 'Sivas', 'Tekirdağ', 'Tokat', 'Trabzon', 'Tunceli', 'Şanlıurfa', 'Uşak',
'Van', 'Yozgat', 'Zonguldak', 'Aksaray', 'Bayburt', 'Karaman', 'Kırıkkale', 'Batman', 'Şırnak',
'Bartın', 'Ardahan', 'Iğdır', 'Yalova', 'Karabük', 'Kilis', 'Osmaniye', 'Düzce');

?>

<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="../CSS/index.less" />
	<!-- Less JS -->
	<script src="//cdn.jsdelivr.net/npm/less@3.13" ></script>

	<!-- Google Font -->
	<style>
	@import url('https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap');
	</style>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />

	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Rent A Car Project</title>
</head>
<body>
	<div class="container mt-5">
		<nav class="navbar navbar-expand-xl navbar-light">
			<div class="container">
				<a class="navbar-brand" href="#">
					<img src="../images/logo.png" class="logo" alt="">CUSTOMER
				</a>
				<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbarNavDropdown">
					<ul class="navbar-nav">
						<?php if(!empty($_SESSION["customerid"])){if($customerId!=""){ ?>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="customerAccount.php">Hesabım <i class="far fa-user"></i></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="customerLogin.php">İşlemler <i class="fas fa-history"></i></a>
							</li>
							<li class="nav-item">
								<a class="nav-link" aria-current="page" href="../Class/customer-exit.php">Çıkış Yap <i class="fas fa-sign-out-alt"></i></a>
							</li>
						<?php }}else{ ?>
							<li class="nav-item">
							<a class="nav-link" aria-current="page" href="customerLogin.php">GİRİŞ YAP <i class="far fa-user"></i></a>
							</li>
							<li class="nav-item">
							<a class="nav-link" href="customerRegister.php">KAYIT OL <i class="fas fa-user-plus"></i></a>
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
			</nav>

		<div class="card text-center">
			<div class="card-body">
				<?php
				/*
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
				*/
				?>
				<form action="customerCarsList.php" method="POST" accept-charset="utf-8">
					<select name="selectcity" class="input w-100" required>
						<option value="">Şehir Seçiniz</option>
						<?php foreach ($city as $varCity) { ?>
							<option value="<?= array_search($varCity, $city) ?>"> <?= $varCity?> </option>
						<?php } ?>
					</select>
					<div class="input w-100">
						<input class="w-100" type="date" name="date1" required>
					</div>
					<div class="input w-100">
						<input class="w-100" type="date" name="date2" required>
					</div>
					<div class="input w-100">
						<button class="button login" type="submit">ARAÇLARI GÖR</button>					
					</div>
				</form>
			</div>
		</div>
	</div>

	<script type="text/javascript">
   
	</script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
</body>
</html>

