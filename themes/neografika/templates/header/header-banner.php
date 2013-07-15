<div class="bannercontainer">
	<div class="banner">
		<ul>
			<?php $images = 	();

			foreach ($images as $image) {
				echo "<li data-transition='fade'>";
				echo wp_get_attachment_image( $image->ID, 'main_slider' );
				echo "</li>";
			} ?>?>
			<!--
			<li data-transition="fade"> <img src="<?php bloginfo('template_directory') ?>/images/art/slider-transparent.png" alt="" style="background-color:#2a2a2a" />

				<div class="caption sfl huge" data-x="306" data-y="90" data-speed="300" data-start="100" data-easing="easeOutExpo">We are</div>
				<div class="caption sft huge" data-x="513" data-y="90" data-speed="300" data-start="800" data-easing="easeOutExpo"><strong>Webpaint.</strong></div>
				<div class="caption sfl big" data-x="center" data-y="176" data-speed="300" data-start="1100" data-easing="easeOutExpo">A <em>digital</em> <span class="colored">&</span> <em>branding</em> agency based in London, England.</div>
				<div class="caption sfr big" data-x="center" data-y="245" data-speed="300" data-start="1400" data-easing="easeOutExpo">We love to turn ideas into beautiful things.</div>
				<div class="caption sfb" data-x="center" data-y="329" data-speed="300" data-start="1700" data-easing="easeOutExpo"><a href="#" class="button">See Portfolio</a></div>

			</li>
			-->
		</ul>
		<div class="tp-bannertimer tp-bottom"></div>
	</div>
</div>