<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="'Curl me' is a web application made by Emmanuel Samu" >
	<title><?php echo $titre; ?></title>
	 <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url() . CSS_DIR;?>/style.css" /> 
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url() . CSS_DIR;?>/bootstrap.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo site_url() . CSS_DIR;?>/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

	<div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <h1><a href="<?php echo site_url(); ?>" class="brand">Curl me&nbsp;!</a></h1>
			<h2 class="muted">A web application created by <a href="http://www.es-designer.be" title="es-designer">Emmanuel Samu</a></h2>
        </div>
      </div>
    </div>

	<div id="content" class="container">
		<section>
				<?php echo $vue; ?>
		</section>
	</div>
	
		<script src="<?php echo site_url(); ?>/web/js/vendor/modernizr-2.6.1.min.js"></script>	
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="web/js/vendor/jquery-1.8.2.js"><\/script>')</script>
		<script src="<?php echo site_url(); ?>/web/js/main.js" type="text/javascript"></script>
		<script src="<?php echo site_url(); ?>/web/js/bootstrap.min.js"></script>
</body>
</html>