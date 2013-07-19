
	<div class="dark-wrapper">

		<div class="innerTweet">
			<div id="twitter-wrapper">
				<div id="twitter"></div>
			</div>
		</div>

	</div><!-- end .dark-wrapper -->


	<!-- Handlebars Template -->
	<script id="tweets-template" type="text/x-handlebars-template">
		<span class="twitterPrefix">
			<i class="icon-twitter"></i>
			<span class="twitterStatus"> {{ parse_links text }} </span>
			<br />
			<em class="twitterTime">
				<a href="http://twitter.com/{{user.screen_name}}/statuses/{{id_str}}">
					{{ date created_at }}
				</a>
			</em>
		</span>
	</script>