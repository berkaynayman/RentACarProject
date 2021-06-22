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

$admincars=DB::get('SELECT * FROM admincars WHERE adminid = ?',
      array($_SESSION["adminid"])
);

/* Yakıt Tipleri Dizi */
$gasTypeArray  = array("Dizel", "Benzin", "LPG", "Elektrik");
/* Vites Tipleri Dizi */
$vitesTypeArray = array("Manuel", "Otomatik");
/* Renk Tipleri Dizi */
$colorArray		= array("Siyah", "Beyaz", "Mavi", "Gri", "Kırmızı", "Lacivert", "Yeşil", "Sarı", "Turuncu");

?>

<!DOCTYPE html>
<html lang="tr">
<head>

	<link rel="shortcut icon" type="image/png" href="images/favicon.png"/>

	<!-- Bootstrap JS -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
	
	<!-- Less CSS -->
	<link rel="stylesheet/less" type="text/css" href="CSS/cars.less" />
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
	<title>Araçlarım</title>
</head>
<body>
	<div class="container mt-5 mb-5">
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
		          <a class="nav-link" aria-current="page" href="account.php">HESABIM</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">HAREKETLER</a>
		        </li>
		        <li class="nav-item">
		          <a class="nav-link" href="#">ARAÇLAR</a>
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

		<section class="cars-add mt-3">
			<?php
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
			?>
			<button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#aracEkle">
			  ARAÇ EKLE
			</button>

			<!-- Modal -->
			<div class="modal fade" id="aracEkle" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Araç Ekleme Ekranı</h5>
			        <button type="button" class="btn" data-bs-dismiss="modal" >X</button>
			      </div>
			      <div class="modal-body">
			      	<form action="Class/car-add.php" method="POST" enctype="multipart/form-data">

						<select name="carBrand" id="carBrand" class="input w-100">
							<option value="">Marka Seçiniz</option>
						</select>

						<select name="carModel" id="carModel" class="w-100">
							<option value="">Model Seçiniz</option>
						</select>

						<select name="carfuel" id="carfuel" class="input w-100">
							<option value="">Yakıt Tipi Seçiniz</option>
							<?php foreach ($gasTypeArray as $gasType) { ?>
								<option value="<?php echo(array_search($gasType, $gasTypeArray)) ?>"> <?= $gasType?> </option>
							<?php } ?>
						</select>

						<select name="carvites" id="carvites" class="w-100">
							<option value="">Vites Tipi Seçiniz</option>
							<?php foreach ($vitesTypeArray as $vitesType) { ?>
								<option value="<?php echo(array_search($vitesType, $vitesTypeArray)) ?>"> <?= $vitesType?> </option>
							<?php } ?>
						</select>

						<select name="carcolor" id="carcolor" class="input w-100">
							<option value="">Renk Seçiniz</option>
							<?php foreach ($colorArray as $color) { ?>
								
								<option value="<?php echo(array_search($color, $colorArray)) ?>"> <?= $color?> </option>
								
							<?php  } ?>
						</select>

						<div class="w-100">
							<input class="w-100" type="text" name="carplaque" value="" placeholder="Plaka">
						</div>

						<div class="input w-100">
							<input class="w-100" type="text" name="carprice" value="" placeholder="Fiyat">
						</div>

						<div class="input w-100">
							<input class="w-100" type="file" name="carimage" value="">
						</div>

						<script>
							$(document).ready(function(){

							load_json_data('carBrand');

							function load_json_data(id, parent_id)
							{
							var html_code = '';
							$.getJSON('Script/carsBrandModel.json', function(data){

							html_code += '<option value="">Marka Seçiniz</option>';
							$.each(data, function(key, value){
								if(id == 'carBrand')
								{
									if(value.parent_id == '0')
									{
									html_code += '<option value="'+value.id+'">'+value.name+'</option>';
									}
								}
								else
								{
									if(value.parent_id == parent_id)
									{
									html_code += '<option value="'+value.id+'">'+value.name+'</option>';
									}
								}
							});
							$('#'+id).html(html_code);
							});

							}

							$(document).on('change', '#carBrand', function(){
							var country_id = $(this).val();
							if(country_id != '')
							{
							load_json_data('carModel', country_id);
							}
							else
							{
							$('#carModel').html('<option value="">Model Seçiniz</option>');
							}
							});
							});
						</script>
					    
				      </div>
				      <div class="modal-footer">
				        <button type="submit" class="btn">Ekle</button>
				        <button type="button" class="btn-danger" data-bs-dismiss="modal">İptal</button>
				      </div>
			      	</form>
			    </div>
			  </div>
			</div>
		</section>
			

		<section class="cars-list">
			<div class="row">
				<?php foreach ($admincars as $carinfo ): ?>
					<div class="col-xl-4 col-md-6 col-sm-12">
						<div class="card mt-4">
							<div class="card-img-top">
								<img src="Class/admincarsimages/<?=$carinfo->carimage?>" alt="">
							</div>
							<div class="card-body">
								<table class="table">
								  <tbody>
								    <tr>
								      <th>Marka</th>
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
								      <th>Durum</th>
								      <td>
								      	<label class="switch">
					                      <input type="checkbox" id="<?php echo $carinfo->carid; ?>" class="aktifpasif" <?php echo $carinfo->carcase == 1 ? 'checked' : null ?> >
					                      <span class="slider round"></span>
					                    </label>
					                   </td>
								    </tr>
								    <tr>
								      <th class="text-center">
								      	<button type="button" class="btn text-white" data-bs-toggle="modal" data-bs-target="#caredit<?=$carinfo->carid?>">
										  DÜZENLE
										</button>

										<!-- Modal -->
										<div class="modal fade" id="caredit<?=$carinfo->carid?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
										  <div class="modal-dialog modal-dialog-centered">
										    <div class="modal-content">
										      <div class="modal-header">
										        <h5 class="modal-title" id="exampleModalLabel">Araç Düzenleme Ekranı</h5>
										        <button type="button" class="btn" data-bs-dismiss="modal" >X</button>
										      </div>
										      <div class="modal-body">
										      	<form action="Class/car-info-edit.php" method="POST" enctype="multipart/form-data">
													<input class="w-100 d-none" type="text" name="carid" value="<?=$carinfo->carid?>" placeholder="Marka">      		
												    <div class="input w-100">
														<input class="w-100" type="text" name="carbrand" value="<?=$carinfo->carbrand?>" placeholder="Marka">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carmodel" value="<?=$carinfo->carmodel?>" placeholder="Model">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carfuel" value="<?=$carinfo->carfuel?>" placeholder="Yakıt">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carvites" value="<?=$carinfo->carvites?>" placeholder="Vites">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carcolor" value="<?=$carinfo->carcolor?>" placeholder="Renk">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carplaque" value="<?=$carinfo->carplaque?>" placeholder="Plaka">
													</div>
													<div class="input w-100">
														<input class="w-100" type="text" name="carprice" value="<?=$carinfo->carprice?>" placeholder="Fiyat">
													</div>
											      </div>
											      <div class="modal-footer">
											        <button type="submit" class="btn">Ekle</button>
											        <button type="button" class="btn-danger" data-bs-dismiss="modal">İptal</button>
											      </div>
										      	</form>
										    </div>
										  </div>
										</div>











								      </th>
								      <td class="text-center">
								      	<a href="Class/car-edit.php?deletecarid=<?=$carinfo->carid?>">
								      		<button class="btn-danger" type="submit">KALDIR</button>
								      	</a>
								      </td>
								    </tr>
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				<?php endforeach ?>
			</div>
		</section>
	</div>

<!-- JS -->
<script type="text/javascript" src="Script/custom.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>