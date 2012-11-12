<!-- FORMULAIRE d'AJOUT  -->	
	<?php 
			echo form_open('message/modifier/' . $message[0]['id'], array('methodes' => 'post'));
	?>

	<div class="input-prepend input-append">
		<span class="add-on"><i class="icon-globe"></i></span>
	<?php
			$userInput = array(
				'name' => 'userId',
				'type' => 'hidden',
				'value' => $id_user
				);
			echo form_input($userInput);
			
			$siteInput = array(
				'name' => 'site',
				'value' => $message[0]['site'],
				'class' => 'span3',
				'placeholder' => "URL not found, type one by yourself"
			);
			echo form_input($siteInput);
			
			$nomInput = array(
				'name' => 'nom',
				'value' => $message[0]['titre'],
				'class' => 'span6 curl_titre',
				'placeholder' => "Title not found, type one by yourself"
			);
			echo form_input($nomInput);
	?>
	</div>
	<?php	
			$descInput = array(
				'name' => 'desc',
				'value' => $message[0]['description'],
				'class' => 'span9 curl_description',
				'placeholder' => "Description not found, type one by yourself"
			);
			echo form_textarea($descInput); 
			
			if(isset($img)): ?>
			<div class="row">
				<?php 
					foreach ($img[1] as $image) : 
					
					$imgInput = array(
						'name' => 'img',
						'value' => isset($image) ? $image : '',
						'type' => isset($image) ? 'radio' : 'hidden',
						'class' => 'span2 curlImg'
					); ?>
					
						<figure class="span2">
							<img src="<?php echo $image; ?>" class="img-rounded image" alt="<?php if(isset($curl_titre)) : echo $curl_titre; endif; ?>" />
							<?php echo form_radio($imgInput); ?>
						</figure>
						
				<?php endforeach; ?> 
			</div>
			<div class="navImg row span2"></div>			
				<?php endif; ?>
			
			<div class="row">
		<?php	$submit = array(
				'name' => 'modifier',
				'value' => 'Modifier ce lien',
				'id' => 'add',
				'class' => 'btn btn-inverse btn-large span2',
				'type' => isset($message[0]['site']) ? 'submit' : 'hidden'
			);
			echo form_submit($submit);
			?> </div> <?php
			
			echo form_close();
		?>
