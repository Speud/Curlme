$(function(){
	/* Bouton revenir en haut de la page */
		$('body').prepend('<a href="#top" class="top_link" title="Back to top"><img src="http://www.es-designer.be/wp-content/themes/es/images/backToTop.png" alt="Back to top" width="30px" height="30px" /></a>');  
		$(window).scroll(function(){  
			posScroll = $(document).scrollTop();  
			if(posScroll >=550)  
				$('.top_link').fadeIn(600);  
			else  
				$('.top_link').fadeOut(600);  
		});

	$("#message").val('http://');
	
	var $figs = $('figure');
	
	$('<button id="previous"><i class="icon-chevron-left"></i></button>').appendTo('.navImg').on('click', imagePrecedente);
	$('<button id="next"><i class="icon-chevron-right"></i></button>').appendTo('.navImg').on('click', imageSuivante);

	$figs.not(':first').hide();
	$('.curlImg').hide();
	
	$figs.children('input').first().attr('checked', 'checked');

	function imageSuivante(e) {
		e.preventDefault();
		
		$('input[checked=checked]').parent().next().children('input').attr('checked', 'checked');
		$('input[checked=checked]').removeAttr('checked');


		var $nextImage = $figs.filter(':visible').next('figure');
		
		if($nextImage.size() == 0)
		
			$nextImage = $figs.first();
			
			$figs.filter(':visible').fadeOut('fast', function() {
				$nextImage.fadeIn('fast');	
			});
			
			$nextImage.children('input').first().attr('checked', 'checked');
	};
	
	function imagePrecedente(e) {
		e.preventDefault();
		var $previousImage = $figs.filter(':visible').prev('figure');
		
		if($previousImage.size() == 0)
		
			$previousImage = $figs.last();
			
			$figs.filter(':visible').fadeOut('fast', function() {
				$previousImage.fadeIn('fast');		
			});
			
			$previousImage.children('input').first().attr('checked', 'checked');
	};
	
	$(".delete").on('click', function(event){ 
		var href = $(this).attr('href');
		var $this = $(this);
		$.ajax({
				url:href,
				success:function(data) {
					$this.parent().parent().text(data).addClass('text-success deleteLink').fadeOut(5000);
				}
			});
		event.preventDefault();
	});

 }); 