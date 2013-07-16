<?php

	/**
	 * Neografika: Archive producto
	 */

	get_header(); ?>

	<!-- Begin Light Wrapper -->
	<div class="light-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<h1 class="aligncenter">Colección Neografika</h1>
			<p class="description aligncenter">
				Hablar de México es hablar de un país de luchadores, hombres y mujeres,
				que sin importar nuestras diferencias políticas religiosas o culturales,
				apostamos a diario nuestra mascara o nuestra cabellera en el coliseo de la vida,
				donde brazos y piernas caen en pos de sacrificio, o se levantan y vuelan en pos de sus sueños…
			</p>
			<br />

			<?php $categories = get_categories(
				array(
					'type'     => 'producto',
					'taxonomy' => 'category',
					'exclude'  => 1
				)); ?>

			<?php foreach ($categories as $categorie) : ?>
			<div class="category-wrapper">
				<div class="category-info">
					<h3><a href="<?= site_url("/categoria/$categorie->slug/"); ?>"><?= $categorie->name ?></a></h3>
					<p><?= $categorie->description ?></p>
				</div>

				<div class="carousel-wrapper">
					<div class="touchcarousel touch-carousel">
						<ul class="touchcarousel-container">
							<?php $posts = get_posts_by_term_slug( $categorie->slug ); ?>
							<?php foreach ( $posts as $product ) : ?>
								<li class="touchcarousel-item item-block">
									<?php if ( has_post_thumbnail( $product->ID ) ) {
										echo get_the_post_thumbnail( $product->ID, 'producto_thumb' );
									} else {
										echo '<img src="http://placehold.it/270x220" width="270" height="220" alt="">';
									} ?>
									<!-- <a href="style/images/art/full1.jpg" class="fancybox-media" rel="web-design" data-title-id="title-<?= $product->ID ?>">
										<span class="link"></span>
									</a> -->
								</li>
								<div id="title-<?= $product->ID ?>" class="info hidden">
									<h2><?= $product->post_title ?></h2>
									<div class="fancybody">
										<?= $product->post_content ?>
									</div>
								</div>
							<?php endforeach; ?>
						</ul>
					</div>
				</div><!-- carousel-wrapper -->
			</div><!-- category-wrapper -->

			<div class="clear"></div>
			<?php endforeach; ?>

		</div><!-- End Inner -->
	</div> <!-- End Light Wrapper -->

	<!-- Begin Dark Wrapper -->
	<div class="dark-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<div id="twitter-wrapper">
				<div id="twitter"></div>
			</div>
		</div><!-- End Inner -->
	</div><!-- End Dark Wrapper -->

<?php get_footer(); ?>