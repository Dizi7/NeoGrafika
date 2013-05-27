<?php
/*
Plugin Name: wp_slider
Plugin URI: https://github.com/scrubmx/wp_slider
Description: Users can upload images from the dashboard
Version: 1.0
Author: scrubmx
Author URI: http://tangentlabs.mx
License: http://www.wtfpl.net/txt/copying/
*/

	class Slider{

		public $images;

		public function __construct()
		{
			$this->images = get_option('slider-images');
		}

		public function add_slider_menu()
		{
			add_menu_page('wp_slider', 'Slider', 'administrator', __FILE__, array('Slider', 'show_slider_menu'), '', 81 );
		}


		public function show_slider_menu()
		{
			?>
			<div class="wrap">
				<?php screen_icon( 'generic' ); ?>
				<h2>Slider Images</h2>
				<form action="options.php" method="POST" enctype="multipart/form-data">


				</form>
			</div>

			<?php
		}

	}


	add_action("admin_menu", function () {
		Slider::add_slider_menu();
	});