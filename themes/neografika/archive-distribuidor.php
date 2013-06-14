<?php get_header(); ?>

	<!-- Begin Light Wrapper -->
	<div class="light-wrapper">
		<!-- Begin Inner -->
		<div class="inner">

			<h1 class="aligncenter">Distribuidores Neografika</h1><br/>

			<?php $distribuidores = get_distribuidores();
			foreach ($distribuidores as $index => $distribuidor) {
				$meta = unserialize($distribuidor->meta);
				$last = ( ($index+1)%3 ) ? '' : 'last'; ?>

				<div class="one-third distribuidor <?= $last ?>">
					<i class="icon-location special">
						<span class="distribuidor-title"><?= $distribuidor->title ?></span>
					</i>
					<p>
						<?= $meta['calle'] ?><br/>
						<strong>Contacto: </strong><?= $meta['contacto'] ?><br/>
						<strong>Colonia: </strong><?= $meta['colonia'] ?><br/>
						<strong>Estado: </strong><?= $meta['estado'] ?><br/>
						<strong>CP: </strong><?= $meta['postal'] ?><br/>
						<strong>Teléfono: </strong><?= $meta['telefono'] ?><br/>
						<strong>Website: </strong><a href="<?= $meta['website'] ?>"><?= $meta['website'] ?></a>
					</p>
				</div>

			<?php } ?>

			<div class="clear"></div>
		</div><!-- End Inner -->
	</div><!-- End Light Wrapper -->


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
