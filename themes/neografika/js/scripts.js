/*-----------------------------------------------------------------------------------*/
/*	RETINA.JS
/*-----------------------------------------------------------------------------------*/

(function($){

	(function () {

		if (matchMedia) {
			var mq = window.matchMedia("(min-width: 767px)");
			mq.addListener(WidthChange);
			WidthChange(mq);

			var mq_smaller = window.matchMedia("(min-width: 495px)");
			mq_smaller.addListener(WidthChangeMobile);
			WidthChangeMobile(mq_smaller);

			var dist = window.matchMedia("(min-width: 960px)");
			dist.addListener(WidthChangeDistribuidores);
			WidthChangeDistribuidores(dist);
		}


		// media query change
		function WidthChange(mq) {
			if (mq.matches) {
				// window width is at least 767px
				$('.item img').attr('height', '270');
			}else {
				$('.item img').attr('height', '200');
			}
		}

		function WidthChangeMobile(mq){
			if(!mq.matches){
				$('.item img').attr('height', '140');
				$('.filter a').css({
					'font-size': '14px',
					'width': '110px',
					'height': '35px',
					'margin-left': '14px'
				});
			}
		}


		function WidthChangeDistribuidores(mq){
			if(!mq.matches){

				var distribuidores = $('.distribuidor');
				distribuidores.removeClass('last');

				$.each(distribuidores, function(index, element){
					var last = ( (index+1)%2 ) ? '' : 'last';
					$(element).removeClass('one-third').addClass('one-half');
					if(last){
						$(element).addClass(last);
					}
				});

			}else{
				var distribuidores = $('.distribuidor');
				distribuidores.removeClass('last');

				$.each(distribuidores, function(index, element){
					var last = ( (index+1)%3 ) ? '' : 'last';
					$(element).removeClass('one-half').addClass('one-third');
					if(last){
						$(element).addClass(last);
					}
				});
			}
		}


		// Highlight links en la barra de navegación
		$(document).ready(function() {

			var url = window.location.pathname;

			$('#tiny li').each(function(){

				var element_id = $(this).attr('id');

				if( url.indexOf(element_id) !== -1 ) {
					$(this).addClass('active');
				}
			});

			if( is_home === 'true' ){
				$('#home').addClass('active');
			}
		});


		function validateEmail(email) {
			var regexp = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
			return regexp.test(email);
		}


		function t(e) {
			this.path = e;
			var t = this.path.split("."),
				n = t.slice(0, t.length - 1).join("."),
				r = t[t.length - 1];
			this.at_2x_path = n + "@2x." + r
		}
		function n(e) {
			this.el = e, this.path = new t(this.el.getAttribute("src"));
			var n = this;
			this.path.check_2x_variant(function (e) {
				e && n.swap()
			})
		}
		var e = typeof exports == "undefined" ? window : exports;
		e.RetinaImagePath = t, t.confirmed_paths = [], t.prototype.is_external = function () {
			return !!this.path.match(/^https?\:/i) && !this.path.match("//" + document.domain)
		}, t.prototype.check_2x_variant = function (e) {
			var n, r = this;
			if (this.is_external()) return e(!1);
			if (this.at_2x_path in t.confirmed_paths) return e(!0);
			n = new XMLHttpRequest, n.open("HEAD", this.at_2x_path), n.onreadystatechange = function () {
				return n.readyState != 4 ? e(!1) : n.status >= 200 && n.status <= 399 ? (t.confirmed_paths.push(r.at_2x_path), e(!0)) : e(!1)
			}, n.send()
		}, e.RetinaImage = n, n.prototype.swap = function (e) {
			function n() {
				t.el.complete ? (t.el.setAttribute("width", t.el.offsetWidth), t.el.setAttribute("height", t.el.offsetHeight), t.el.setAttribute("src", e)) : setTimeout(n, 5)
			}
			typeof e == "undefined" && (e = this.path.at_2x_path);
			var t = this;
			n()
		}, e.devicePixelRatio > 1 && (window.onload = function () {
			var e = document.getElementsByTagName("img"),
				t = [],
				r, i;
			for (r = 0; r < e.length; r++) i = e[r], t.push(new n(i))
		})
	})();
	/*-----------------------------------------------------------------------------------*/
	/*	ISOTOPE PORTFOLIO
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function () {
		var $container = $('.portfolio-wrapper .items');
		$container.imagesLoaded(function () {
			$container.isotope({
				itemSelector: '.item',
				layoutMode: 'fitRows'
			});
		});

		$('.filter li a').click(function () {

			$('.filter li a').removeClass('active');
			$(this).addClass('active');

			var selector = $(this).attr('data-filter');
			$container.isotope({
				filter: selector
			});

			return false;
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	FANCYBOX
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function() {
		$(".fancybox-media").fancybox({
			arrows: true,
			padding: 0,
			closeBtn: true,
			openEffect: 'fade',
			closeEffect: 'fade',
			prevEffect: 'fade',
			nextEffect: 'fade',
			helpers: {
				media: {},
				overlay: {
					locked: false
				},
				buttons: false,
				thumbs: {
					width: 50,
					height: 50
				},
				title: {
					type: 'inside'
				}
			},
			beforeLoad: function() {
				var el, id = $(this.element).data('title-id');
				if (id) {
					el = $('#' + id);
					if (el.length) {
						this.title = el.html();
					}
				}
			}
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	FORM
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function () {
		$('.btn-submit').on('click', function (e){
			e.preventDefault();

			var name    = $('#name').val(),
				email   = $('#email').val(),
				subject = $('#subject').val(),
				message = $('#message').val();

			if ( name === '' || name === 'Nombre'){
				alert('Ingresa el Nombre');
			}else if ( email === '' || email === 'Email'){
				alert('Ingresa una direccion de email valida');
			}else if ( message === '' ){
				alert('Ingresa tu mensaje');
			}else{
				$.ajax({
					type: 'POST',
					url: ajax_url,
					data: {
						name: name,
						email: email,
						subject: subject,
						message: message,
						action: 'send_new_comment_mail'
					},
					dataType: 'json'
				}).done(function(data){
					console.log(data);
				});
			}
		});
	});
	jQuery(document).ready(function () {
		$('.forms').dcSlickForms();
	});
	$(document).ready(function () {
		$('.comment-form input[title], .comment-form textarea').each(function () {
			if ($(this).val() === '') {
				$(this).val($(this).attr('title'));
			}

			$(this).focus(function () {
				if ($(this).val() == $(this).attr('title')) {
					$(this).val('').addClass('focused');
				}
			});
			$(this).blur(function () {
				if ($(this).val() === '') {
					$(this).val($(this).attr('title')).removeClass('focused');
				}
			});
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	TABS
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function () {
		$('.tabs').easytabs({
			animationSpeed: 300,
			updateHash: false
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	TESTIMONIALS
	/*-----------------------------------------------------------------------------------*/
	 $(document).ready( function() {
		  $('#testimonials').easytabs({
			  animationSpeed: 500,
			  updateHash: false,
			  cycle: 5000
		  });

		});
	/*-----------------------------------------------------------------------------------*/
	/*	TOGGLE
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function () {
		//Hide the tooglebox when page load
		$(".togglebox").hide();
		//slide up and down when click over heading 2
		$("h4").click(function () {
			// slide toggle effect set to slow you can set it to fast too.
			$(this).toggleClass("active").next(".togglebox").slideToggle("slow");
			return true;
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	VIDEO
	/*-----------------------------------------------------------------------------------*/
	jQuery(document).ready(function () {
		jQuery('.video').fitVids();
	});
	/*-----------------------------------------------------------------------------------*/
	/*	HOVER OPACITY
	/*-----------------------------------------------------------------------------------*/
	jQuery(document).ready(function ($) {
		$("ul.client-list li").css("opacity", "0.70");
		$("ul.client-list li").hover(function () {
			$(this).stop().animate({
				opacity: 1.0
			}, "fast");
		},

		function () {
			$(this).stop().animate({
				opacity: 0.70
			}, "fast");
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	SLIDER
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function() {
		if ($.fn.cssOriginal != undefined) $.fn.css = $.fn.cssOriginal;
		$('.banner').revolution({
			delay: 9000,
			startheight: 460,
			startwidth: 1110,
			hideThumbs: 200,
			thumbWidth: 100,
			// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
			thumbHeight: 50,
			thumbAmount: 5,
			navigationType: "bullet",
			// bullet, thumb, none
			navigationArrows: "verticalcentered",
			// nexttobullets, solo (old name verticalcentered), none
			navigationStyle: "round",
			// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
			navigationHAlign: "center",
			// Vertical Align top,center,bottom
			navigationVAlign: "bottom",
			// Horizontal Align left,center,right
			navigationHOffset: 0,
			navigationVOffset: 20,
			soloArrowLeftHalign: "left",
			soloArrowLeftValign: "center",
			soloArrowLeftHOffset: 20,
			soloArrowLeftVOffset: 0,
			soloArrowRightHalign: "right",
			soloArrowRightValign: "center",
			soloArrowRightHOffset: 20,
			soloArrowRightVOffset: 0,
			touchenabled: "on",
			// Enable Swipe Function : on/off
			onHoverStop: "on",
			// Stop Banner Timet at Hover on Slide on/off
			stopAtSlide: -1,
			// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
			stopAfterLoops: -1,
			// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
			hideCaptionAtLimit: 0,
			// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
			hideAllCaptionAtLilmit: 0,
			// Hide all The Captions if Width of Browser is less then this value
			hideSliderAtLimit: 0,
			// Hide the whole slider, and stop also functions if Width of Browser is less than this value
			shadow: 0,
			//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
			fullWidth: "on" // Turns On or Off the Fullwidth Image Centering in FullWidth Modus
		});
		$('.portfolio-banner').revolution({
			delay: 9000,
			startheight: 550,
			startwidth: 1110,
			hideThumbs: 200,
			thumbWidth: 100,
			// Thumb With and Height and Amount (only if navigation Tyope set to thumb !)
			thumbHeight: 50,
			thumbAmount: 5,
			navigationType: "bullet",
			// bullet, thumb, none
			navigationArrows: "verticalcentered",
			// nexttobullets, solo (old name verticalcentered), none
			navigationStyle: "round",
			// round,square,navbar,round-old,square-old,navbar-old, or any from the list in the docu (choose between 50+ different item), custom
			navigationHAlign: "center",
			// Vertical Align top,center,bottom
			navigationVAlign: "bottom",
			// Horizontal Align left,center,right
			navigationHOffset: 0,
			navigationVOffset: 20,
			soloArrowLeftHalign: "left",
			soloArrowLeftValign: "center",
			soloArrowLeftHOffset: 20,
			soloArrowLeftVOffset: 0,
			soloArrowRightHalign: "right",
			soloArrowRightValign: "center",
			soloArrowRightHOffset: 20,
			soloArrowRightVOffset: 0,
			touchenabled: "on",
			// Enable Swipe Function : on/off
			onHoverStop: "on",
			// Stop Banner Timet at Hover on Slide on/off
			stopAtSlide: -1,
			// Stop Timer if Slide "x" has been Reached. If stopAfterLoops set to 0, then it stops already in the first Loop at slide X which defined. -1 means do not stop at any slide. stopAfterLoops has no sinn in this case.
			stopAfterLoops: -1,
			// Stop Timer if All slides has been played "x" times. IT will stop at THe slide which is defined via stopAtSlide:x, if set to -1 slide never stop automatic
			hideCaptionAtLimit: 0,
			// It Defines if a caption should be shown under a Screen Resolution ( Basod on The Width of Browser)
			hideAllCaptionAtLilmit: 0,
			// Hide all The Captions if Width of Browser is less then this value
			hideSliderAtLimit: 0,
			// Hide the whole slider, and stop also functions if Width of Browser is less than this value
			shadow: 0,
			//0 = no Shadow, 1,2,3 = 3 Different Art of Shadows  (No Shadow in Fullwidth Version !)
			fullWidth: "off" // Turns On or Off the Fullwidth Image Centering in FullWidth Modus
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	IMAGE HOVER
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function() {
		$('.overlay a').prepend('<span class="more"></span>');
	});
	$(document).ready(function() {
		$('.overlay').mouseenter(function(e) {
			$(this).children('a').children('span').fadeIn(300);
		}).mouseleave(function(e) {
			$(this).children('a').children('span').fadeOut(200);
		});
	});
	$(document).ready(function() {
			$('.items li').mouseenter(function(e) {

				$(this).children('a').children('div').fadeIn(300);
			}).mouseleave(function(e) {

				if (!$(this).hasClass("active")) $(this).children('a').children('div').fadeOut(200);
			});
		});
	/*-----------------------------------------------------------------------------------*/
	/*	TOUCH CAROUSEL
	/*-----------------------------------------------------------------------------------*/
	jQuery(function($) {
				$(".touch-carousel").touchCarousel({
					pagingNav: false,
					snapToItems: false,
					itemsPerMove: 4,
					scrollToLast: false,
					loopItems: false,
					scrollbar: true
				});
			});
	/*-----------------------------------------------------------------------------------*/
	/*	PORTFOLIO SHOWCASE
	/*-----------------------------------------------------------------------------------*/
	/**************************************************************************
	 * jQuery Plugin for Showcase
	 * @version: 1.0
	 * @requires jQuery v1.8 or later
	 * @author ThunderBudies http://themeforest.net/user/Thunderbuddies/portfolio
	 **************************************************************************/
	jQuery(document).ready(function() {

		 var $container = $('.portfolio-wrapper.showcase .items');
		 var speed = 600;
		 var header_offset = 0;
		 var scrollspeed = 600;
		 var force_scrolltotop = false;

		 ///////////////////////////
		// GET THE URL PARAMETER //
		///////////////////////////
		function getUrlVars(hashdivider)
				{

					try { var vars = [], hash;
						var hashes = window.location.href.slice(window.location.href.indexOf(hashdivider) + 1).split('_');
						for(var i = 0; i < hashes.length; i++)
						{
							hashes[i] = hashes[i].replace('%3D',"=");
							hash = hashes[i].split('=');
							vars.push(hash[0]);
							vars[hash[0]] = hash[1];
						}
						return vars;
					} catch(e) { }

				}


		////////////////////////
		// GET THE BASIC URL  //
		///////////////////////
		function getAbsolutePath() {
				var loc = window.location;
				var pathName = loc.pathname.substring(0, loc.pathname.lastIndexOf('/') + 1);
				return loc.href.substring(0, loc.href.length - ((loc.pathname + loc.search + loc.hash).length - pathName.length));
		}

		//////////////////////////
		// SET THE URL PARAMETER //
		///////////////////////////
		function updateURLParameter(paramVal){
				var yScroll=document.body.scrollTop;


				var baseurl = window.location.pathname.split("#")[0];
				var url = baseurl.split("#")[0];
				if (paramVal==undefined) paramVal="";

				if (paramVal.length==0)
					par="#"
				else
					par='#'+paramVal;

				//window.location.replace(url+par);

				if(history.pushState) {
					history.pushState(null, null, par);
				}
				else {
					location.hash = par;
				}

		}


		 var deeplink = getUrlVars("#");
		 var ie = !$.support.opacity;
		 var ie9 = (document.documentMode == 9);

		 $container.find('.item').click(function() {

				// The CLicked Thumb
				var thumb = jQuery(this);



				// IF THE CLICKED THUMB IS ALREADY SELECTED, WE NEED TO CLOSE THE WINDOWS SIMPLE
				if (thumb.hasClass("active")) {
					thumb.removeClass("active");

					closeDetailView($container);

				// OTHER WAY WE CLOSE THE WINDOW (IF NECESsARY, OPEN AGAIN, AND DESELET / SELECT THE RIGHT THUMBS
				}  else {
					updateURLParameter("entry-"+thumb.index());
					thumb.addClass("latest-active");
					removeActiveThumbs($container);

					thumb.removeClass("latest-active");
					thumb.addClass("active");

					// CHECK IF WE ALREADY HAVE THE DETAIL WINDOW OPEN
					 var pdv = jQuery('body').find('.portfolio-detail-view');

					if (pdv.length) {
						var fade=false;
						clearInterval(pdv.data('interval'));
						pdv.addClass("portfolio-detail-view-remove").removeClass('portfolio-detail-view');
						pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});

						var delay=speed+50;
						//if (thumb.position().top<pdv.position().top) {
						// 	delay=0;
						//} else {
						   moveThumbs($container,pdv.data('itemstomove'),0);
						   setTimeout(function() {$container.isotope( 'reLayout');},speed+50);
						// }

						setTimeout(function() {
								jQuery('body,html').animate({
									scrollTop: thumb.offset().top-(header_offset+10)
								}, {
									duration: scrollspeed,
									queue: false
								});
								 if (force_scrolltotop) {

									 openDetailView($container,thumb,fade);
									} else {
										setTimeout(function () {
											openDetailView($container,thumb,fade);
										},scrollspeed)
									}


						},delay)

					} else {

						jQuery('body,html').animate({
									scrollTop: thumb.offset().top-(header_offset+10)
								}, {
									duration: scrollspeed,
									queue: false
								});
						if (force_scrolltotop) {
								openDetailView($container,thumb);
						} else {
							setTimeout(function () {
								openDetailView($container,thumb);
							},scrollspeed)
						}




					}
				}
				return false;
		 }) // END OF CLICK ON PORTFOLIO ITEM

		 // DEEPLINK START IF NECESSARY
			 if (deeplink[0].split('entry-').length>1) {
				var thmb = parseInt(deeplink[0].split('entry-')[1],0)+1;
				 $container.find('.item:nth-child('+thmb+')').click();
				 $container.find('.item:nth-child('+thmb+')').addClass("active").children('a').children('div').fadeIn(300);;

			}



		 // CLICK ON FILTER SHOULD CLOSE THE DETAIL PAGE ALSO
		 jQuery('.portfolio-wrapper.showcase .filter').find('li a').each(function() {
			 jQuery(this).click(function() {

				closeDetailView($container)
			 })
		 })

		 // ON RESIZE REMOVE THE DETAIL VIEW CONTAINER

		 if (!ie) {
			 jQuery(window).bind('resize',function()  {
				if (!isiPhone()) {
					closeDetailView($container);
					centerpdv($container);

				}
			 });
		} else {

			$container.isotope( 'option', {resizable:false});
		}

		 //  CHECK IPHONE
		// Return boolean TRUE/FALSE
			function isiPhone(){
				return (
					(navigator.platform.indexOf("iPhone") != -1) ||
					(navigator.platform.indexOf("iPod") != -1) ||
					(navigator.platform.indexOf("iPad") != -1)
				);
			}


		 // REMOVE ACTIVE THUMB EFFECTS
		 function removeActiveThumbs($container) {
				$container.find('.item').each(function() {
						jQuery(this).removeClass('active');
						if (!jQuery(this).hasClass('latest-active')) jQuery(this).children('a').children('div').fadeOut(200);

					});
		 }

		 // CLOSE DETAILVIEW
		 function closeDetailView($container) {

			 var pdv = jQuery('body').find('.portfolio-detail-view');
			 setTimeout(function() {
				 if (pdv.length) {
						removeActiveThumbs($container);
						clearInterval(pdv.data('interval'));
						pdv.animate({'height':'0px','opacity':'0'},{duration:speed, complete:function() { jQuery(this).remove();}});
						moveThumbs($container,pdv.data('itemstomove'),0);
				}
				setTimeout(function() {
						$container.isotope( 'reLayout',function() {
							$container.data('height',$container.height());
							setTimeout(function() {

								$container.data('height',$container.height());
							},speed);  //500 old value
						});
				},speed+50);
				if (!ie && !ie9) updateURLParameter("");

			},150)
		 }

		 function centerpdv($container) {
			try {
				var pdv = jQuery('body').find('.portfolio-detail-view');
				var pleft=jQuery('body').width()/2 - pdv.width()/2;

				pdv.css({'left':pleft+"px"});

			} catch(e) { }
		 }


		 // OPEN THE DETAILVEW AND CATCH THE THUMBS BEHIND THE CURRENT THUMB
		 function openDetailView($container,thumb,fadeit) {

				// The Top Position of the Current Item.
				currentTop= thumb.position().top;
				thumbOffsetTop= thumb.offset().top;

				 // ALL ITEM WE NEED TO MOVE SOMEWHERE
				var itemstomove =[];

				$container.find('.item').each(function() {
					var curitem = jQuery(this);
					if (curitem.position().top>currentTop) itemstomove.push(curitem);

				})

				// Reset CurrentPositions

				jQuery.each(itemstomove,function() {
					var thumb = jQuery(this);
					thumb.data('oldPos',thumb.position().top);

				})

				// We Save the Height Of the current Container here.
				if ($container.data('height')!=undefined) {
					if ($container.height()<$container.data('height')) 	$container.data('height',$container.height());
				} else {
					$container.data('height',$container.height());
				 }

				// ADD THE NEW CONTENT IN THE DETAIL VIEW WINDOW.
				jQuery('body').append(
					'<div class="portfolio-detail-view">'+
					'<div class="inner">'+
					'<div class="portfolio-detail-content-container">'+
					thumb.data('detailcontent')+
					'</div>'+
					'</div>'+
					'<div class="closebutton"><i class="icon-cancel-1"></i></div>'+
					'</div>');

				// CATCH THE DETAIL VIEW AND CONTENT CONTAINER
				var pdv = jQuery('body').find('.portfolio-detail-view');
				var closeb = pdv.find('.closebutton');
				var pdcc = pdv.find('.portfolio-detail-content-container');
				var pdvpad = parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);

				var offset = pdcc.height()+pdvpad + parseInt(pdv.css('marginBottom'),0);


				closeb.click(function() {

						closeDetailView($container);
				})

				// ANIMATE THE OPENING OF THE CONTENT CONTAINER

				pdv.animate({'height':(pdcc.outerHeight(true)+pdvpad)+"px"},{duration:speed,queue:false});


				// SAVE THE ITEMS TO MOVE IN THE PDV
				pdv.data('itemstomove',itemstomove);



				//PUT THE CONTAINER IN THE RIGHT POSITION
				pdv.css({'top':(thumbOffsetTop+thumb.height()+parseInt(thumb.css('marginBottom'),0))+"px"});

				centerpdv($container);

				// FIRE THE CALLBACK HERE
				try{
					var callback = new Function(thumb.data('callback'));

					callback();
				} catch(e) {}

				//INITIALISE THE CAROUSEL HERE
				pdv.find('.carousel').each(function() {

					jQuery(this).carousel({
						interval: 2000
					})
				});



				jQuery.each(itemstomove,function() {
					var thumb = jQuery(this);
					if (ie ||ie9)
						thumb.data('top',parseInt(thumb.position().top,0));
					else
						thumb.data('top',0);
				});
				// MOVE THE REST OF THE THUMBNAILS
				moveThumbs($container,itemstomove,offset);

				pdv.data('interval',setInterval(function() {
					var pdv = jQuery('body').find('.portfolio-detail-view');
					var closeb = pdv.find('.closebutton');
					var pdcc = pdv.find('.portfolio-detail-content-container');
					var pdvpad =  parseInt(pdcc.css('paddingBottom'),0) + parseInt(pdcc.css('paddingTop'),0);
					var offset = pdcc.height()+pdvpad + parseInt(pdv.css('marginBottom'),0);
					moveThumbs($container,itemstomove,offset);
					pdv.animate({'height':Math.round(pdcc.height()+pdvpad)+"px"},{duration:speed,queue:false});

				},100));

		 }

		 // MOVE THE THUMBS
		 function moveThumbs($container,itemstomove,offset) {

				jQuery.each(itemstomove,function() {
					var thumb = jQuery(this);
					thumb.stop(true);
					thumb.animate({'top':(thumb.data('top')+offset)+"px"},{duration:speed,queue:false});
				})


				if (ie || ie9) {
					$container.stop(true);
					$container.animate({'height':($container.data('height')+offset)+"px"}, {duration:speed,queue:false});
				} else {
					$container.css({'height':Math.round($container.data('height')+offset)+"px"});
				}
		 }
	});
	/*-----------------------------------------------------------------------------------*/
	/*	CALL PORTFOLIO SCRIPTS
	/*-----------------------------------------------------------------------------------*/
	function callPortfolioScripts() {
		jQuery('.vid').fitVids();
	};
	/*-----------------------------------------------------------------------------------*/
	/*	TWITTER
	/*-----------------------------------------------------------------------------------*/
	Handlebars.registerHelper('date', function (fecha) {
		return new Date(fecha).toDateString();
	});

	Handlebars.registerHelper('parse_links', function (text) {
		var regExp = /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/ig;
		var result = text.replace( regExp, "<a href='$1' target='_blank' rel='nofollow'>$1</a>");
		return new Handlebars.SafeString(result);
	});

	window.Twitter = {

		init: function (config) {
			this.template  = config.template;
			this.container = config.container;
			this.Tweet     = Twitter.getTweet();
		},

		getTweet: function () {
			$.getJSON( ajax_url, { action: 'get_neografika_tweet' } )
			.done(function (json) {
				Twitter.attachTemplate(json[0]);
			});
		},

		attachTemplate: function (json) {
			var template = Handlebars.compile( this.template );
			this.container.append( template( json ) );
		}
	};

	Twitter.init({
		template: $('#tweets-template').html(),
		container: $('#twitter')
	});


	/*-----------------------------------------------------------------------------------*/
	/*	SELECTNAV
	/*-----------------------------------------------------------------------------------*/
	$(document).ready(function () {
		selectnav('tiny', {
			label: '--- Navigation --- ',
			indent: '-'
		});
	});
	/*-----------------------------------------------------------------------------------*/
	/*	MENU
	/*-----------------------------------------------------------------------------------*/
	ddsmoothmenu.init({
		mainmenuid: "menu",
		orientation: 'h',
		classname: 'menu',
		contentsource: "markup"
	})


})(jQuery);