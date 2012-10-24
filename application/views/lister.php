<!-- AJOUT DE L'URL -->	
	<div class="well row">

		 <?php
			//form igniter
			echo form_open('message/curler', array('methodes' => 'post'));
			$label = array(
				'class' => 'muted'
			);
			echo form_label('Type your website :', 'message', $label); ?>
			
			<div class="input-prepend input-append">
			<span class="add-on"><i class="icon-globe"></i></span>
			
			<?php $MsgInput = array(
				'name' => 'message',
				'id' => 'message appendedInputButton',
				'class' => 'span6'
			);
			echo form_input($MsgInput); 

			$submit = array(
				'name' => 'check',
				'value' => 'Curl me !',
				'class' => 'btn',
				'id' => 'curlme'
			);
			echo form_submit($submit); ?>
			</div>
			<?php echo form_close();
		?>   
	
	
	<?php if (isset($erreur)) { echo $erreur; } ?>

<!-- FORMULAIRE d'AJOUT  -->	
	<?php if(isset($curl_site)) : ?>

		<?php
			echo form_open('message/ajouter', array('methodes' => 'post'));
			
			$siteInput = array(
				'name' => 'site',
				'value' => isset($curl_titre) ? html_entity_decode($curl_site) : '',
				'type' => 'hidden'
			);
			echo form_input($siteInput);
			
			$nomInput = array(
				'name' => 'nom',
				'value' => isset($curl_titre) ? html_entity_decode($curl_titre) : '',
				'class' => 'span9 curl_titre',
				'placeholder' => "Title not found, type one by yourself"
			);
			echo form_input($nomInput);
			
			$descInput = array(
				'name' => 'desc',
				'value' => isset($curl_description) ? html_entity_decode($curl_description) : '',
				'class' => 'span9 curl_description',
				'style' => isset($curl_description) ? 'display:block' : 'display:none',
				'placeholder' => "Description not found, type one by yourself"
			);
			echo form_textarea($descInput); 
			
			if(isset($img)): ?>
			<div class="row">
				<?php foreach ($img[1] as $image) : 
					$imgInput = array(
						'name' => 'img',
						'value' => isset($image) ? $image : '',
						'type' => isset($image) ? 'radio' : 'hidden',
						'class' => 'span2'
					); ?>
					
						<figure class="span2">
							<img src="<?php echo $image; ?>" class="img-rounded" alt="<?php if(isset($curl_titre)) : echo $curl_titre; endif; ?>" />
							<?php echo form_radio($imgInput); ?>
						</figure>
						
				<?php endforeach; ?> 
			</div>
			<div class="img row span2"></div>			
				<?php endif; 
			
			
			$submit = array(
				'name' => 'ajouter',
				'value' => 'Ajouter ce lien',
				'id' => 'add',
				'class' => 'btn btn-inverse btn-large',
				'type' => isset($curl_site) ? 'submit' : 'hidden'
			);
			echo form_submit($submit);
			
			echo form_close();
		?>
			
     <?php endif; ?>
</div>
	 
	
<!-- LISTE DES LIENS  -->
		<?php if(isset($message)) : ?>
		<section>
			<?php foreach ($message as $msg) : ?>
			<div id="lien" class="row">
				
					<?php if(!($msg['image']) == 0) : ?>
						<img src="<?php echo $msg['image']; ?>" alt="<?php echo $msg['titre']; ?>" class="span3 img-rounded" />
					<?php endif; ?>
					
					<?php if(isset($msg['titre'])) : ?>
						<h3 class="span8"><?php echo $msg['titre'];?></h3>
					<?php endif; ?>
					
					<a href="message/supprimer/<?php echo $msg['id']; ?>" title="supprimer ce lien" class="delete btn">
						<i class="icon-remove"></i>
					</a>
					
					
					<p class="span8"><a href="<?php echo $msg['site']; ?>" title="<?php if(isset($msg['titre'])) : echo $msg['titre']; endif; ?>"><?php echo $msg['site'];?></a></p>
					
					
					
					<?php if(isset($msg['description'])) : ?>
					<p class="span9 description muted"><?php echo $msg['description']; ?></p>
					<?php endif; ?>
					
					
				<span class="clear"></span>		
					
			</div>
			
		<?php endforeach;?>
	</section>
	<?php  endif;  ?>
		
</div>