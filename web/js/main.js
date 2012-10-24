$(function(){

	//$("#message").focus();
	$("#message").val('http://');
	//$('#curl').fadeIn('slow');
	
//  $("#check").on("click", function() {
		
		// var curlText = $('.curl_titre').text(); //cible le champ input avec "this" et on va rechercher sa valeur avec val(); 
			//(champInput.match('/^(((https?|ftp)://(w{3}\.)?)(?<!www)(\w+-?)*\.([a-z]{2,4}))$/i'))
		
		
		// $("#curl").fadeIn('slow');
	
	// }); 
	
	var $figs = $('figure');
	
	$('<button id="previous"><i class="icon-chevron-left"></i></button>').appendTo('.img').on('click', imagePrecedente);
	$('<button id="next"><i class="icon-chevron-right"></i></button>').appendTo('.img').on('click', imageSuivante);
	
			
	$figs.not(':first').hide();

	function imageSuivante(e) {
		e.preventDefault();
		var $nextImage = $figs.filter(':visible').next('figure');
		
		if($nextImage.size() == 0)
		
			$nextImage = $figs.first();
			
			$figs.filter(':visible').fadeOut('fast', function() {
				$nextImage.fadeIn('fast');
			});
	};
	
	function imagePrecedente(e) {
		e.preventDefault();
		var $previousImage = $figs.filter(':visible').prev('figure');
		
		if($previousImage.size() == 0)
		
			$previousImage = $figs.last();
			
			$figs.filter(':visible').fadeOut('fast', function() {
				$previousImage.fadeIn('fast');
			});
	};
	
	$(".delete").on('click', function(event){ 
		var href = $(this).attr('href');
		var $this = $(this);
		$.ajax({
				url:href,
				success:function(data) {
					//alert(data);
					$this.parent().text(data).addClass('text-success').fadeOut(5000);
				}
			});
		event.preventDefault();
	});

 }); 