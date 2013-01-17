<?php if ($connected === TRUE) { ?>

<!-- AJOUT DE L'URL -->	
	<section class="well">
		 <?php
			//form igniter
			echo form_open('message/curler', array('methodes' => 'post', 'class' => 'formCurl'));
		?>
			<div class="input-prepend input-append">
				<span class="add-on"><i class="icon-globe"></i></span>
				
				<?php $MsgInput = array(
					'name' => 'message',
					'id' => 'message appendedInputButton',
					'class' => 'span8',
					'placeholder' => 'Enter your website'
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
			<?php echo form_close(); ?>  
<!-- fin de l'URL -->
	
<?php if(isset($error)) { ?>
	<div class="alert alert-error blockAlert">
		<h4>Error!</h4>
		<p><?php echo $error; ?></p>
		<p><a href="<?php echo site_url(); ?>" title="Go to home page">Back to home</a></p>
	</div>
<?php } ?>

<!-- FORMULAIRE d'AJOUT  -->	
	<?php if(isset($curl_site)) : 
			echo form_open('message/ajouter', array('methodes' => 'post'));

			$userInput = array(
				'name' => 'userId',
				'type' => 'hidden',
				'value' => $id_user
				);
			echo form_input($userInput);

			$siteInput = array(
				'name' => 'site',
				'type' => 'hidden',
				'value' => $curl_site
			);
			echo form_input($siteInput);
			
			$nomInput = array(
				'name' => 'nom',
				'value' => isset($curl_titre) ? html_entity_decode($curl_titre) : '',
				'class' => 'span9 curl_titre',
				'placeholder' => "Title not found, enter one by yourself"
			);
			echo form_input($nomInput); 

			$descInput = array(
				'name' => 'desc',
				'value' => isset($curl_description) ? html_entity_decode($curl_description) : '',
				'class' => 'span9 curl_description',
				'placeholder' => "Description not found, enter one by yourself"
			);
			echo form_textarea($descInput); 
			
			if(isset($img)): ?>

			<div class="row">
				<?php 
					foreach ($img[1] as $image) : 
						$scheme = parse_url($image); 
						
						if(empty($scheme['host']))
							$image = $curl_site . '/' . $image;	

					$imgInput = array(
						'name' => 'img',
						'value' => isset($image) ? $image : '',
						'type' => isset($image) ? 'radio' : 'hidden',
						'class' => 'span2 curlImg'
					); ?>

						<figure class="span2">
							<img src="<?php echo $image; ?>" class="img-rounded image" width="75px" height="75px" alt="<?php if(isset($curl_titre)) : echo $curl_titre; endif; ?>" />
							<?php echo form_radio($imgInput); ?>
						</figure>
						
				<?php endforeach; ?> 
			</div>
			<div class="navImg row span2"></div>			
				<?php endif; ?>
			
			<div class="row">
		<?php	$submit = array(
				'name' => 'ajouter',
				'value' => 'Ajouter',
				'id' => 'add',
				'class' => 'btn btn-inverse btn-large span2',
				'type' => isset($curl_site) ? 'submit' : 'hidden'
			);
			echo form_submit($submit);
			?> </div> <?php
			
			echo form_close();
		?>
			
     <?php endif; ?>

	 <?php } ?> <!-- fin de "is connected" -->	  
	</section> <!-- fin de la div well -->
<!-- fin du curl --> 


<!-- LISTE DES LIENS  -->
<?php if(isset($message)) : ?>
	<section class="container">
		<h1 class="textIndent">Liste des liens</h1>
		<?php foreach ($message as $msg) : ?>
			<article class="lien row">	
					<?php if(isset($msg['titre'])) : ?>
						<h3 class="span8 siteTitle"><?php echo $msg['titre'];?></h3>
						 <?php if ($connected === TRUE) { ?>
						<div class="offset2 span2 admin">
							<a href="<?php echo site_url(); ?>message/supprimer/<?php echo $msg['id']; ?>" data-dismiss="alert" title="delete link" class="delete adminTools">
								<i class="icon-remove"></i>
							</a>
							<a href="<?php echo site_url(); ?>message/listerOne/<?php echo $msg['id']; ?>" data-dismiss="alert" title="modify link" class="adminTools">
								<i class="icon-edit"></i>
							</a>
						</div>
						<?php } ?>
					<?php endif; ?>

					<!-- lien du site -->
					<p class="span8 siteUrl">
						<a href="<?php echo $msg['site']; ?>" title="<?php if(isset($msg['titre'])) : echo $msg['titre']; endif; ?>"><?php echo $msg['site'];?>
						</a>
					</p>

					<?php if(!($msg['image']) == 0) : 
						$imgThumbExplode = explode('.', $msg['image']);
						$imgThumb = $imgThumbExplode[0] . '_thumb' . '.' . $imgThumbExplode[1];
					?>
						<img src="<?php echo site_url(); ?>web/upload/<?php echo $imgThumb; ?>" alt="<?php echo $msg['titre']; ?>" class="span3 offset1 img-rounded imgThumb" width="75px" height="75px" />
					<?php endif; ?>

					<?php if(isset($msg['description'])) : ?>
					<p class="span8 description"><?php echo $msg['description']; ?></p>
					<?php endif; ?>	

			</article>
			
		<?php endforeach;?>
	</section>
<?php  endif;  ?>
<!-- fin des liens -->