<?php 
    
	require "config.php";
	if ($_POST) {

		$id 	= (int) $_POST["id"];
		$durum 	= (int) $_POST["durum"];
            
            DB::query(
                'UPDATE admincars SET carcase=? WHERE carid=?',
                array($durum, $id)
            );
            /*
			if ($durum) {
				echo $id . " " . $durum . " " . "Nolu kayıt aktif edildi";
			}else{
				echo $id . " " . $durum . " " . "Nolu kayıt pasif edildi";
			}
			*/

	}

 ?>