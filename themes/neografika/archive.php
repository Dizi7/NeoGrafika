<?php get_header(); ?>


	<div class="light-wrapper">
		<div class="inner">

			<?php $objeto = get_queried_object(); ?>

				<h1 class="aligncenter">Colección Neografika: <?php echo $objeto->name; ?></h1>
				<p class="description aligncenter"><?php echo $objeto->category_description ?></p>
				<br />

				<div class="portfolio-wrapper showcase">

					<ul class="items col4 isotope">

						<?php $products = get_posts_by_term_slug($objeto->slug);
						foreach ($products as $index => $product) :

							$meta = get_post_meta($product->ID, '_product_meta');

							$precio = isset($meta['precio']) ? $meta['precio'] : '';
							$sku    = isset($meta['sku'])    ? $meta['sku']    : '';
							$size   = isset($meta['size'])   ? $meta['size']   : '';
							$weight = isset($meta['weight']) ? $meta['weight'] : '';
							$images = product_slider_images($product->ID); ?>

							<li class="item web isotope-item" data-callback="callPortfolioScripts();"
								data-detailcontent='<div class="content">
														<div id="myCarousel" class="carousel slide">
															<div class="carousel-inner"><?= $images ?></div>
																<a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
																<a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
															</div>
														</div>

														<div class="item-details">
															<h2><?= $product->post_title ?></h2>
															<ul class="item-info">
																<li><span class="lite1">Categoría:</span> <?= $product->name ?></li>
																<li><span class="lite1">Precio:</span> $<?= number_format((int)$precio, 2, '.', ',') ?></li>
																<li><span class="lite1">Medidas:</span> <?= $size ?></li>
															</ul>
															<p><?= $product->post_content ?></p>
															<p class="disclaimer">
																Las piezas expuestas en la presente página, pertenecen a una colección de piezas únicas,
																y no a un catálogo, debido a ello pueden presentar variaciones, en producciones posteriores.
															</p>
															<a href="<?= site_url('/distribuidores/'); ?>" class="button">Comprar</a>
														</div>

														<div class="clear"></div>'>
								<a href="#">
									<div class="overlay">
										<h3><?= _e($product->post_title) ?></h3>
										<span class="meta"><?= $product->post_excerpt ?></span>
									</div>
									<?php if( has_post_thumbnail($product->ID) ){
										echo get_the_post_thumbnail( $product->ID, 'producto_thumb' );
									}else{
										echo '<img src="http://placehold.it/270x220">';
									} ?>
								</a>

							</li><!-- end item -->

						<?php endforeach; ?>

					</ul><!-- end items -->

				</div><!-- End portfolio-wrapper showcase -->

		  	</div><!-- End Portfolio -->

			<div class="clear"></div>

		</div><!-- End Inner -->

	</div><!-- End Light Wrapper -->


	<div class="dark-wrapper">
		<div class="inner">
			<div id="twitter-wrapper">
				<div id="twitter"></div>
			</div>
		</div><!-- End Inner -->
	</div><!-- End Dark Wrapper -->

<?php get_footer(); ?>