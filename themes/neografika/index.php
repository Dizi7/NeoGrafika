<?php get_header(); ?>

	<!-- Begin Light Wrapper -->
	<div class="light-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<h1 class="aligncenter">Colección</h1>
			<p class="description aligncenter">Reyes de la Lucha Libre</p><br />

			<!-- Lista de categosias disponibles -->
			<div class="portfolio-wrapper showcase">
				<ul class="filter">
					<li><a class="active" href="#" data-filter="*">Todos</a></li>

					<?php $categories = get_categories(
						array(
							'type'     => 'productos',
							'taxonomy' => 'category',
							'exclude'  => 1
						)
					); ?>

					<?php foreach ($categories as $categorie) : ?>
						<li><a href="#" data-filter=".<?= $categorie->name ?>"><?= $categorie->name ?></a></li>
					<?php endforeach; ?>

				</ul>

				<ul class="items col4">

					<?php $products = get_products_data();
						foreach ($products as $index => $product) {

							$precio = isset($product->meta['precio']) ? $product->meta['precio'] : '';
							$sku    = isset($product->meta['sku'])    ? $product->meta['sku']    : '';
							$size   = isset($product->meta['size'])   ? $product->meta['size']   : '';
							$weight = isset($product->meta['weight']) ? $product->meta['weight'] : '';
							$images = product_slider_images($product->ID); ?>

							<li class="item <?= $product->category ?> web" data-callback="callPortfolioScripts();"
								data-detailcontent='<div class="content">
														<div id="myCarousel" class="carousel slide">
															<div class="carousel-inner"><?= $images ?></div>
															<a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
															<a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
														</div>
													</div>

													<div class="item-details">
														<h2><?= _e($product->title) ?></h2>
														<ul class="item-info">
															<li><span class="lite1">Categoría:</span> <?= $product->category ?></li>
															<li><span class="lite1">Precio:</span> $<?= number_format((int)$precio, 2, '.', ',') ?></li>
															<li><span class="lite1">Medidas:</span> <?= $size ?></li>
														</ul>
														<p><?= _e($product->content) ?></p>
														<p class="disclaimer">
															Las piezas expuestas en la presente página, pertenecen a una colección de piezas únicas,
															y no a un catálogo, debido a ello pueden presentar variaciones, en producciones posteriores.
														</p>
														<a href="<?= site_url('/distribuidores/'); ?>" class="button">Comprar</a>
													</div>

													<div class="clear"></div>'>
								<a href="#">
									<div class="overlay">
										<h3><?= _e($product->title) ?></h3>
										<span class="meta"><?= $product->subtitle ?></span>
									</div>
									<?php
										if( has_post_thumbnail($product->ID) ){
											echo get_the_post_thumbnail( $product->ID, 'producto_thumb' );
										}else{
											echo '<img src="http://placehold.it/270x220">';
										}
									?>
								</a>
							</li><!-- end item -->
					<?php } ?>
				</ul><!-- end items -->
			</div><!-- end portfolio-wrapper -->
		</div><!-- end Inner -->
	</div><!-- end Light Wrapper -->

	<?php get_template_part( 'templates/footer', 'twitter' ); ?>

<?php get_footer(); ?>