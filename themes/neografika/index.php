<?php get_header(); ?>

	<!-- Begin Light Wrapper -->
	<div class="light-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<h1 class="aligncenter">Latest Works</h1>
			<p class="description aligncenter">
				Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget lacinia odio sem nec elit.
			</p>

			<br />

			<div class="portfolio-wrapper showcase">
				<ul class="filter">
					<li><a class="active" href="#" data-filter="*">All</a></li>
					<li><a href="#" data-filter=".web">Web Design</a></li>
					<li><a href="#" data-filter=".graphic">Graphic</a></li>
					<li><a href="#" data-filter=".artwork">Artwork</a></li>
					<li><a href="#" data-filter=".video">Video</a></li>
				</ul>

				<ul class="items col4">

					<?php $products = get_products_data();  // [ID] title, content [subtitle] price [sku] [size] [category]
						foreach ($products as $index => $product) { ?>
							<li class="item <?= $product->category ?> web" data-callback="callPortfolioScripts();"
								data-detailcontent='<div class="content">
														<div id="myCarousel" class="carousel slide">
															<div class="carousel-inner">
																<div class="active item">
																	<img alt="" width="100%" src="<?php bloginfo('template_directory') ?>/images/art/ds5-1.jpg">
																	<a href="<?php bloginfo('template_directory') ?>/images/art/ds5-1.jpg" class="fancybox-media" rel="item-5">
																		<span class="link"></span>
																	</a>
																</div>
																<div class="item">
																	<img alt="" width="100%" src="<?php bloginfo('template_directory') ?>/images/art/ds5-2.jpg">
																	<a href="<?php bloginfo('template_directory') ?>/images/art/ds5-2.jpg" class="fancybox-media" rel="item-5">
																		<span class="link"></span>
																	</a>
																</div>
															</div>

															<a class="carousel-control left" href="#myCarousel" data-slide="prev"></a>
															<a class="carousel-control right" href="#myCarousel" data-slide="next"></a>
														</div>
													</div>

													<div class="item-details">
														<h2><?= _e($product->title) ?></h2>
														<ul class="item-info">
															<li><span class="lite1">Categoría:</span> <?= $product->category ?></li>
															<li><span class="lite1">Precio:</span> $<?= number_format($product->price, 2, '.', ',') ?></li>
															<li><span class="lite1">Medidas:</span> <?= $product->size ?></li>
														</ul>
														<p><?= _e($product->content) ?></p>
														<a href="#" class="button">Detalles</a>
													</div>
													<div class="clear"></div>'>
								<a href="#">
									<div class="overlay">
										<h3><?= _e($product->title) ?></h3>
										<span class="meta"><?= $product->subtitle ?></span>
									</div>
									<img src="<?php bloginfo('template_directory') ?>/images/art/p1.jpg" alt="" />
								</a>
							</li><!-- end item -->
					<?php } ?>
				</ul><!-- end items -->
			</div><!-- end portfolio-wrapper -->
		</div><!-- end Inner -->
	</div><!-- end Light Wrapper -->


	<!-- Begin Dark Wrapper -->
	<div class="dark-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<div id="twitter-wrapper">
				<div id="twitter"></div>
			</div>
		</div>
		<!-- End Inner -->
	</div>
	<!-- End Dark Wrapper -->

<?php get_footer(); ?>