<!doctype html>
	<!--[if lt IE 7]><html class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
	<!--[if IE 7]><html class="no-js lt-ie9 lt-ie8"> <![endif]-->
	<!--[if IE 8]><link rel="stylesheet" type="text/css" href="style/css/ie8.css" media="all" /><![endif]-->
	<!--[if IE 9]><link rel="stylesheet" type="text/css" href="style/css/ie9.css" media="all" /><![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<meta name="description" content="<?php bloginfo('description'); ?>">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('template_directory') ?>/images/favicon.png" />
		<title><?php bloginfo('name'); ?></title>
		<?php wp_head(); ?>
	</head>


	<body class="full-layout">
		<!--[if lt IE 7]>
			<p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
		<![endif]-->

		<!-- Begin Body Wrapper -->
		<div class="body-wrapper">
			<!-- Begin Top Wrapper -->
			<div class="top-wrapper">
				<header>
					<div class="inner">
						<div class="logo"><a href="<?= site_url() ?>"><img src="<?php bloginfo('template_directory') ?>/images/logo.png" alt="" /></a></div>
						<!-- Begin Menu -->
						<nav id="menu" class="menu">
							<ul id="tiny">
								<li id="inicio"><a href="<?= site_url() ?>">Inicio</a></li>
								<li id="catalogo"><a href="<?= site_url('/catalogo/') ?>">Catalogo</a></li>
								<li id="nosotros"><a href="<?= site_url('/nosotros/') ?>">Nosotros</a></li>
								<li id="contacto"><a href="<?= site_url('/contacto/') ?>">Contacto</a></li>
							</ul>
						</nav>
						<!-- End Menu -->
						<div class="clear"></div>
					</div>
				</header>


				<?php if( is_home() ){
					get_template_part('templates/header/header', 'banner');
				} ?>

			</div><!-- End Top Wrapper -->