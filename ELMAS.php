<?php 

ob_start();
session_start();
include "Class/config.php";

$city = array('Adana', 'Adıyaman', 'Afyon', 'Ağrı', 'Amasya', 'Ankara', 'Antalya', 'Artvin',
'Aydın', 'Balıkesir', 'Bilecik', 'Bingöl', 'Bitlis', 'Bolu', 'Burdur', 'Bursa', 'Çanakkale',
'Çankırı', 'Çorum', 'Denizli', 'Diyarbakır', 'Edirne', 'Elazığ', 'Erzincan', 'Erzurum', 'Eskişehir',
'Gaziantep', 'Giresun', 'Gümüşhane', 'Hakkari', 'Hatay', 'Isparta', 'Mersin', 'İstanbul', 'İzmir', 
'Kars', 'Kastamonu', 'Kayseri', 'Kırklareli', 'Kırşehir', 'Kocaeli', 'Konya', 'Kütahya', 'Malatya', 
'Manisa', 'Kahramanmaraş', 'Mardin', 'Muğla', 'Muş', 'Nevşehir', 'Niğde', 'Ordu', 'Rize', 'Sakarya',
'Samsun', 'Siirt', 'Sinop', 'Sivas', 'Tekirdağ', 'Tokat', 'Trabzon', 'Tunceli', 'Şanlıurfa', 'Uşak',
'Van', 'Yozgat', 'Zonguldak', 'Aksaray', 'Bayburt', 'Karaman', 'Kırıkkale', 'Batman', 'Şırnak',
'Bartın', 'Ardahan', 'Iğdır', 'Yalova', 'Karabük', 'Kilis', 'Osmaniye', 'Düzce');

if(!empty($_POST["selectcity"]))
{
    $sd = $_POST["selectcity"];
    $cityadmininfo=DB::get('SELECT adminnamesurname, admintelephone, adminemail, admincity FROM admins WHERE admincity = ?',
      array($city[$sd])
    );
}

if ( (!empty($_POST["date1"])) AND (!empty($_POST["date2"])) ) {
    $dateliste=DB::get('SELECT * FROM operations WHERE operationdate BETWEEN ? AND ?',
      array($_POST["date1"], $_POST["date2"])
    );
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
		
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                    ŞEHİRLERE GÖRE HİZMET VEREN ŞAHISLAR ?
                </button>
            </h2>
            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="#" method="POST">
                        <select name="selectcity" class="input w-100" required>
                            <option value="">Şehir Seçiniz</option>
                            <?php foreach ($city as $varCity) { ?>
                                <option value="<?= array_search($varCity, $city) ?>"> <?= $varCity?> </option>
                            <?php } ?>
                        </select>
						<button class="btn btn-success mt-1" type="submit">SORGULA</button>					
                    </form>
                </div>
            </div>
        </div>

        <div class="accordion-item">
            <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                İKİ TARİH ARASINDAKİ İŞLEMLER
            </button>
            </h2>
            <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                <div class="accordion-body">
                    <form action="#" method="POST" accept-charset="utf-8">
                        <div class="input w-100">
                            <input class="w-100" type="date" name="date1" required>
                        </div>
                        <div class="input w-100 mt-1">
                            <input class="w-100" type="date" name="date2" required>
                        </div>
                        <div class="input w-100">
                            <button class="btn btn-success mt-1" type="submit">İŞLEMLERİ GÖR</button>					
                        </div>
                    </form>
                </div>
            </div>
        </div>

        

        <div class="cikti mt-5">
            <?php
                if(!empty($sd))
                {
                    ?>
                        <h3 class="text-center"><?=$city[$sd]?> Şehrinde Hizmet Veren Şahıslar</h3>
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col">İsim ve Soyisin</th>
                                    <th scope="col">Telefon Numarası</th>
                                    <th scope="col">E-posta Adresi</th>
                                    <th scope="col">Şehir</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($cityadmininfo as $key) {  ?>
                                    <tr>
                                    <td> <?php echo $key->adminnamesurname ?> </td>
                                    <td> <?php echo $key->admintelephone ?> </td>
                                    <td> <?php echo $key->adminemail ?> </td>
                                    <td> <?php echo $key->admincity ?> </td>
                                    </tr>
                                    
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                }

                if( (!empty($_POST["date1"])) AND (!empty($_POST["date2"])) )
                {
                    ?>
                        <h3 class="text-center"><?=$_POST["date1"]?> - <?=$_POST["date2"]?> Tarih Arası İşlemler</h3>
                        <table class="table table-light">
                            <thead>
                                <tr>
                                    <th scope="col">Fiyat</th>
                                    <th scope="col">Kart Adı</th>
                                    <th scope="col">Kart Numarası</th>
                                    <th scope="col">Kart Ay</th>
                                    <th scope="col">Kart Yıl</th>
                                    <th scope="col">Kart CVC</th>
                                    <th scope="col">İşlem Tarihi</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($dateliste as $key) {  ?>
                                    <tr>
                                    <td> <?php echo $key->price ?> </td>
                                    <td> <?php echo $key->cardname ?> </td>
                                    <td> <?php echo $key->cardnumber ?> </td>
                                    <td> <?php echo $key->cardmonth ?> </td>
                                    <td> <?php echo $key->cardyear ?> </td>
                                    <td> <?php echo $key->cardcvc ?> </td>
                                    <td> <?php echo $key->operationdate ?> </td>

                                    </tr>
                                    
                                <?php } ?>
                            </tbody>
                        </table>
                    <?php
                }
            ?>
            
            
        </div>

		
	</div>



<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

</body>
</html>