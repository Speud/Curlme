<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<meta name="description" content="'Curl me' is a web application made by Emmanuel Samu" >
	<title><?php echo $titre; ?></title>
	<link href='http://fonts.googleapis.com/css?family=Raleway:400,900,700' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url() . CSS_DIR;?>bootstrap.min.css" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="<?php echo site_url() . CSS_DIR;?>bootstrap-responsive.min.css" rel="stylesheet">
	 <link rel="stylesheet" type="text/css" media="all" href="<?php echo site_url() . CSS_DIR;?>style.css" /> 
	 <!--[if lt IE 9]>
			<script src="<?php echo site_url(); ?>web/js/html5shiv.js"></script>
		<![endif]-->
</head>
<body>
	<div id="wrap">			
	<header id="header" class="navbar navbar-inverse navbar-inner">
        <div class="container">
          <h1 class="mainTitle span3"><a href="<?php echo site_url(); ?>" class="brand">Curl me&nbsp;!</a></h1>

            <ul class="nav pull-right">
		          	 <?php if ($connected === TRUE) { ?>
						 <li class="dropdown">
							<a class="dropdown-toggle"
							data-toggle="dropdown"
							href="<?php echo site_url(); ?>message/listerUser/<?php echo $id_user; ?>" title="home page">
								<i class="icon-white icon-user"></i> <?php echo $usernameSession ?>
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="<?php echo site_url(); ?>message/listerUser/<?php echo $id_user; ?>" title="home page">
								My links
								</a>
								</li>
							</ul>
						</li>

						<li><a href="<?php echo site_url(); ?>member/logout" class="brand"><i class="icon-white icon-off"></i> Log out</a></li>
					 <?php } else { ?>

						<li><a href="<?php echo site_url(); ?>member" class="brand"><i class="icon-white icon-pencil"></i> Log in / Sign up</a></li>
					 <?php } ?> 
				 </ul>
        </div>
    </header>

		<section id="content" class="container clear-top">
					<?php echo $vue; ?>		
		</section> 	

		<div id="push"><!--//--></div>
	</div><!-- fin div wrap -->
	<footer id="footer">
      		<div class="container">
 				<p><a href="http://www.es-designer.be" title="es-designer">A web application created by Emmanuel Samu <img src="<?php echo site_url(); ?>web/img/logo.png" alt="es-designer" /></a></p>     
 	  		</div>
    </footer>
	
		<script src="<?php echo site_url(); ?>web/js/vendor/modernizr-2.6.1.min.js"></script>	
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8/jquery-ui.min.js"></script>
        <script>window.jQuery || document.write('<script src="<?php echo site_url(); ?>web/js/vendor/jquery-1.8.2.js"><\/script>')</script>
		<script src="<?php echo site_url(); ?>web/js/main.js" type="text/javascript"></script>
		<script src="<?php echo site_url(); ?>web/js/bootstrap.min.js"></script>
</body>
</html>