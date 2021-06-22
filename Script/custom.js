
$(document).ready(function(){
	
	$(".aktifpasif").click(function(){ // aktifpasif adlı class click olunda function çalışacak
		var id = $(this).attr("id"); // click olunan verinin id sini alıyoruz

		var durum = $(this).is(":checked") ? '1' : '0' ;

			$.ajax({
				url : "./Class/cartruefalse.php",
				data: {id:id,durum:durum},
				type: "post"
			})
	});

});