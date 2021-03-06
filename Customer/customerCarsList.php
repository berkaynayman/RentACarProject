<?php
error_reporting(0);

include "../Class/config.php";
session_start();

if(!empty($_SESSION["customerid"]))
{
	$customerId = $_SESSION["customerid"];
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

$_SESSION["date1"] = $_POST["date1"];
$_SESSION["date2"] = $_POST["date2"];

$date1 = $_SESSION["date1"];
$date2 = $_SESSION["date2"];
if ($date1>$date2) {
	Header("Location:http://localhost/RentACarProject/Customer/index.php?case=datefalse");
}

$selectCity = $_POST["selectcity"];
$listCarCity= $city[$selectCity] ;

$admincars=DB::get('SELECT adminid FROM admins WHERE admincity = ?',
      array($listCarCity)
);

$listCarId = array();
for($i=0;$i<count($admincars);$i++){
    array_push($listCarId, $admincars[$i]->adminid) ;
} 
$nowdate=date("Y-m-d");
DB::query(
	'UPDATE operations SET operationcase=? WHERE lastdate<=?',
	array(0,$nowdate)
);

foreach ($listCarId as $id) {
        $listCarsInfo=DB::get('SELECT * FROM admincars WHERE adminid = ? AND carcase=?',
        array($id,1)
        );
}
?>


<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="../images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="../CSS/customerCarsList.less" />
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
		<nav class="navbar navbar-expand-xl navbar-light customer">
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



		<nav class="navbar navbar-expand-xl navbar-light">
		  <div class="container">
		    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
		      <span class="navbar-toggler-icon"></span>
		    </button>
		    <div class="collapse navbar-collapse" id="navbarNavDropdown">
		      <ul class="navbar-nav">
		        <li class="nav-item">
		          <a class="nav-link">TARİH SEÇİMİ</a>
		        </li>
		        <li class="nav-item active">
		          <a class="nav-link">ARAÇ SEÇİMİ</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link">ARAÇ DETAY</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link">ÖDEME EKRANI
		          </a>
		        </li>
		      </ul>
		    </div>
		  </div>
		</nav>

		<section class="cars-add mt-3">
			<?php
			/*
				if($getcase=="carsaddtrue")
					{
						?>
						<div class="alert alert-success text-center" role="alert">
						ARAÇ EKLEME İŞLEMİ BAŞARI İLE GERÇEKLEŞMİŞTİR.
						</div>
						<?php
				}

				if($getcase=="carsedittrue")
					{
						?>
						<div class="alert alert-success text-center" role="alert">
						ARAÇ DÜZENLEME İŞLEMİ BAŞARI İLE GERÇEKLEŞMİŞTİR.
						</div>
						<?php
				}

				if($getcase=="carseditfalse")
					{
						?>
						<div class="alert alert-success text-center" role="alert">
						BİR DEĞİŞİKLİK ALGILANMADI, LÜTFEN BİLGİLERİNİZİ KONTROL EDİNİZ.
						</div>
						<?php
				}

				if($getcase=="cardeletetrue")
					{
						?>
						<div class="alert alert-success text-center" role="alert">
						ARAÇ SİLME İŞLEMİ YAPILMIŞTIR.
						</div>
						<?php
				}
			*/
			?>
		
			<div class="alert alert-info alert-dismissible fade show" role="alert">
				<strong><?= $date1?></strong> ile <strong><?= $date2?></strong> tarihleri arasında kiralanılabilir araçlar.
				<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
			</div>
		</section>
			

		<section class="cars-list">
			<div class="row">
				<?php
				foreach ($listCarId as $id) {
						$listCarsInfo=DB::get('SELECT * FROM admincars WHERE adminid = ? AND carcase=?',
						array($id,1)
						);
						foreach ($listCarsInfo as $carinfo ){
							$controlid = $carinfo->carid;

							$cardatecontrol = DB::getRow("SELECT * FROM operations WHERE carid=? AND operationcase=?",array(
								$controlid,
								1
							));

							//print_r($cardatecontrol);
							if($cardatecontrol>0){
								$datecontrolfirstdate =$cardatecontrol->firstdate;
								$datecontrollastdate = $cardatecontrol->lastdate;
								$startDate = strtotime($datecontrolfirstdate); // başlangıç tarihi
								$finishDate = strtotime($datecontrollastdate);// bitiş tarihi	
								$customerRentDays = array();
								for ($i = $startDate; $i <= $finishDate; $i = $i + 86400) {
									array_push($customerRentDays,date( 'Y-m-d', $i ));
									/*echo date( 'Y-m-d', $i ); // aktif gün
									echo '<br/>';*/
								}
								if ( (in_array($date1, $customerRentDays)) OR (in_array($date2, $customerRentDays)) ) {
									continue;
								}
							}	
						
							?>
							<div class="col-xl-4 col-md-6 col-sm-12">
								<div class="card mt-4">
									<div class="card-img-top">
										<img src="../Class/admincarsimages/<?=$carinfo->carimage?>" alt="">
									</div>
									<div class="card-body">
										<table class="table">
										  <tbody>
											<tr>
											  <th>Marka<?=$carinfo->carid?></th>
											  <td><?=$carinfo->carbrand?></td>
											</tr>
											<tr>
											  <th>Model</th>
											  <td><?=$carinfo->carmodel?></td>
											</tr>
											<tr>
											  <th>Yakıt</th>
											  <td><?=$carinfo->carfuel?></td>
											</tr>
											<tr>
											  <th>Vites</th>
											  <td><?=$carinfo->carvites?></td>
											</tr>
											<tr>
											  <th>Renk</th>
											  <td><?=$carinfo->carcolor?></td>
											</tr>
											<tr>
											  <th>Plaka</th>
											  <td><?=$carinfo->carplaque?></td>
											</tr>
											<tr>
											  <th>Fiyat</th>
											  <td><?=$carinfo->carprice?>₺</td>
											</tr>
											<tr>
											   <th class="text-center">
											   <button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#caredit<?=$carinfo->carid?>">
												HIZLI BAKIŞ
												</button>

												<!-- Modal -->
												<div class="modal fade" id="caredit<?=$carinfo->carid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
												<div class="modal-dialog modal-dialog-centered">
													<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="exampleModalLabel">Hızlı Bakış</h5>
														<button type="button" class="btn" data-bs-dismiss="modal" >X</button>
													</div>
													<div class="modal-body">
														<div class="row">
															<div class="col-xl-6">
																<img src="../Class/admincarsimages/<?=$carinfo->carimage?>" alt="">
															</div>
															<div class="col-xl-6">
																<table class="table">
																	<tbody>
																		<tr>
																		<th>Marka<?=$carinfo->carid?></th>
																		<td><?=$carinfo->carbrand?></td>
																		</tr>
																		<tr>
																		<th>Model</th>
																		<td><?=$carinfo->carmodel?></td>
																		</tr>
																		<tr>
																		<th>Yakıt</th>
																		<td><?=$carinfo->carfuel?></td>
																		</tr>
																		<tr>
																		<th>Vites</th>
																		<td><?=$carinfo->carvites?></td>
																		</tr>
																		<tr>
																		<th>Renk</th>
																		<td><?=$carinfo->carcolor?></td>
																		</tr>
																		<tr>
																		<th>Plaka</th>
																		<td><?=$carinfo->carplaque?></td>
																		</tr>
																		<tr>
																		<th>Fiyat</th>
																		<td><?=$carinfo->carprice?>₺</td>
																		</tr>
																	</tbody>
																</table>
															</div>
														</div>
													</div>
												</div>
												</div>

												</th>
												<th class="text-center">
													<a href="customerCarDetail.php?selectCarId=<?=$carinfo->carid?>">												
														<button type="button" class="btn text-white w-100" data-bs-toggle="modal">
															KİRALA
														</button>
													</a>
												</th>
											</tr>
										  </tbody>
										</table>
									</div>
								</div>
							</div>
						<?php }
					}
				?>	
			</div>
		</section>
	</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>