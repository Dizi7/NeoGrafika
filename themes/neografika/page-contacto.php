<?php get_header(); ?>

	<!-- Begin Light Wrapper -->
	<div class="light-wrapper">
		<!-- Begin Inner -->
		<div class="inner">
			<!-- Begin Content -->
			<section class="content">
			<h2>Envíanos tus comentarios</h2>
			<p>
				Envíanos tus comentarios, dudas o sugerencias y nos pondremos en contacto contigo a la brevedad.
				Nos interesa conocerte y que sepas qué hacemos y qué ofrecemos en Neografika.
			</p>
			<!-- Begin Form -->
			<div class="form-container">
				<div class="response"></div>
				<form class="forms" action="form-handler.php" method="POST">
					<fieldset>
						<ol>
							<li class="form-row text-input-row name-field">
								<input type="text" name="name" id="name" class="text-input defaultText required" title="Nombre"/>
							</li>
							<li class="form-row text-input-row email-field">
								<input type="text" name="email" id="email" class="text-input defaultText required email" title="Email"/>
							</li>
							<li class="form-row text-input-row subject-field">
								<input type="text" name="subject" id="subject" class="text-input defaultText" title="Motivo"/>
							</li>
							<li class="form-row text-area-row">
								<textarea name="message" id="message" class="text-area required"></textarea>
							</li>
							<li class="button-row">
								<input type="submit" value="Enviar" name="submit" class="btn-submit" />
							</li>
						</ol>
					</fieldset>
				</form>
			</div>
			<!-- End Form -->
			</section>
			<aside class="sidebar">
				<div class="sidebox">
					<h3>Dirección</h3>

					<p>
					Calle saltillo 14304, Eje vial K. <br/>
					Col. SNTE, C.P. 72490. <br/>
					Puebla, Pue. Mex.
					</p>
					<i class="icon-location contact"></i>  México, Distrito Federal<br />
					<i class="icon-phone contact"></i> <a href="tel://2223957162">52+222-395-71-62</a><br />
					<i class="icon-mail contact"></i> <a href="mailto:ventas@neografika.com">ventas@neografika.com</a><br />
					<i class="icon-mail contact"></i> <a href="mailto:direcciongeneral@neografika.com">direcciongeneral@neografika.com</a><br />
				</div>
			</aside>
			<div class="clear"></div>
		</div><!-- End Inner -->
	</div><!-- End Light Wrapper -->

	<?php get_template_part( 'templates/footer', 'twitter' ); ?>

<?php get_footer(); ?>