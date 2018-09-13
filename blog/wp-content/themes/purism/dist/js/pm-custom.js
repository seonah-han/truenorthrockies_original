jQuery(document).ready(function($) {

	"use strict";

	// Menu
	var navMenu = $('.nav-menu .primary-menu');

	if(navMenu.length) {
		navMenu.slicknav({
			prependTo:'.nav-menu-mobile',
			label: '',
			allowParentLinks: true,
			duration: 500,
			closedSymbol:	'<span class="fa fa-angle-right"></span>',
			openedSymbol:	'<span class="fa fa-angle-down"></span>'
		});
	}

	// Sticky Menu
	var stickyEffect = $('.sticky-effect');
	var headerTitle = $('.header-title-wrapper');
	var primNav = $('.primary-nav-wrapper');
	var stickyHeight = 0;

	if(stickyEffect.length && primNav.length) {


		$(window).scroll(function() {

			if(headerTitle.length && headerTitle.is(':visible')) {
				stickyHeight = stickyHeight + headerTitle.height();
			}

			stickyHeight = stickyHeight + primNav.height();

			var scrollTop = $(this).scrollTop();
			if (scrollTop > stickyHeight + 75) {
				stickyEffect.addClass('sticky-navbar');
				$('.sticky-effect .primary-nav').css('top' , '0');
				$('.sticky-effect .primary-nav').css('opacity' , '1');
				stickyHeight = 0;
			}
			else if (scrollTop <= stickyHeight + 75 && scrollTop > stickyHeight) {
				$('.sticky-effect .primary-nav').css('top' , '-75px');
				$('.sticky-effect .primary-nav').css('opacity' , '0');
				stickyHeight = 0;
			}
			else {

				/*			alert(stickyHeight); */
				stickyEffect.removeClass('sticky-navbar');
				$('.sticky-effect .primary-nav').css('top' , '0');
				$('.sticky-effect .primary-nav').css('opacity' , '1');
				stickyHeight = 0;
			}
		});
	}

	// Search Overlay
	$('.nav-search .open-search-overlay').on('click', function () {

		$('body').addClass('search-overlay');

		setTimeout(function(){
			$('.nav-search .search-form-container').fadeIn(500).css('display','table');
			$('.close-search-overlay').fadeIn(500);
			$('.nav-search .search-form-container input').focus();
		}, 500);

		$(document).mouseup(function (e) {
			var container = $('.nav-search input, .search-submit');
			if (!container.is(e.target) && container.has(e.target).length === 0) {
				$('body').removeClass('search-overlay');
				$('.nav-search .search-form-container').fadeOut(500);
				$('.close-search-overlay').fadeOut(500);
			}
		});
	});

	$('.close-search-overlay').on('click', function () {
		$('body').removeClass('search-overlay');
	});

	// Lightbox Gallery
	var galleryLightbox = $('.post-entry .gallery');

	if(galleryLightbox) {
		galleryLightbox.each(function(){
			$('a[href*=".png"], a[href*=".gif"], a[href*=".jpg"], a[href*=".jpeg"]', this).addClass("image-popup");
			$(this).magnificPopup({
				delegate:".image-popup",
				type: 'image',
				gallery:{
					tCounter: '%curr% / %total%',
					enabled:true,
					arrowMarkup: '<button title="%title%" type="button" class="gallery-arrow fa gallery-arrow-%dir%"></button>'
				},
				image: {
					titleSrc: function(item) {
						return item.el.parent().next().text();
					}
				},
				zoom: {
					enabled: true,
					duration: 300
				},
			});
		});
	}

	// Lightbox Image
	var imageLightbox = $('.post-entry figure');

	if(imageLightbox) {
		imageLightbox.not(".gallery figure").each(function(){
			$('a[href*=".png"], a[href*=".gif"], a[href*=".jpg"], a[href*=".jpeg"]', this).addClass("image-popup");
			$(this).magnificPopup({
				delegate:".image-popup",
				type: 'image',
				gallery:{
					enabled: false
				},
				image: {
					titleSrc: function(item) {
						return item.el.next().text();
					}
				},
				zoom: {
					enabled: true,
					duration: 300 // don't foget to change the duration also in CSS
				},
			});
		});
	}

	// Related Slider
	var relatedSlider = $('.related-slider');
	if(relatedSlider.length) {
		relatedSlider.slick({
			slidesToShow: 3,
			slidesToScroll: 3,
			arrows: false,
			dots: true,
			speed: 2000,
			autoplay: true,
			autoplaySpeed: 5000,
			adaptiveHeight: true,
			responsive: [
				{
					breakpoint: 567,
					settings: {
						slidesToShow: 1,
					}
				},
				{
					breakpoint: 768,
					settings: {
						slidesToShow: 2,
					}
				}
			]
		});
	}

	// Featured Slider Single
	var featuredSliderSingleRtl = $('.rtl .featured-slider.mode-single');

	if(featuredSliderSingleRtl.length) {
		featuredSliderSingleRtl.slick({
			rtl: true,
			slidesToShow: 1,
			speed: 2000,
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			autoplaySpeed: 5000,
			autoplay: featuredSliderSingleRtl.data("autoplay"),
			fade: featuredSliderSingleRtl.data("fade"),
		});
	}

	var featuredSliderSingle = $('.ltr .featured-slider.mode-single');

	if(featuredSliderSingle.length) {
		featuredSliderSingle.slick({
			slidesToShow: 1,
			speed: 2000,
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			autoplaySpeed: 5000,
			autoplay: featuredSliderSingle.data("autoplay"),
			fade: featuredSliderSingle.data("fade"),
		});
	}

	// Featured Slider Center
	var featuredSliderCenterRtl = $('.rtl .featured-slider.mode-multiple');
	if(featuredSliderCenterRtl.length) {
		featuredSliderCenterRtl.slick({
			rtl: true,
			centerMode: true,
			slidesToShow: 1,
			centerPadding: '33.333333%',
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			speed: 2000,
			autoplaySpeed: 5000,
			autoplay: featuredSliderCenterRtl.data("autoplay"),
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						centerMode: false,
						centerPadding: '0',
						fade: featuredSliderCenterRtl.data("fade"),
					}
				},
			]
		});
	}

	var featuredSliderCenter = $('.ltr .featured-slider.mode-multiple');
	if(featuredSliderCenter.length) {
		featuredSliderCenter.slick({
			centerMode: true,
			slidesToShow: 1,
			centerPadding: '33.333333%',
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			speed: 2000,
			autoplaySpeed: 5000,
			autoplay: featuredSliderCenter.data("autoplay"),
			responsive: [
				{
					breakpoint: 768,
					settings: {
						arrows: true,
						centerMode: false,
						centerPadding: '0',
						fade: featuredSliderCenter.data("fade"),
					}
				},
			]
		});
	}

	// Video Embed Slider
	var slideEmbedVideo = $('.slide-embed-video');
	if(slideEmbedVideo.length) {
		slideEmbedVideo.each(function() {
			$(this).jarallax({
				videoSrc: $(this).data("video"),
				elementInViewport: $(this).parents('.slick-track:eq(0)'),
			});
		});
	}

	// Post Gallery Slider
	var gallerySlider = $('.ltr .gallery-slider');

	if(gallerySlider.length) {
		gallerySlider.slick({
			slidesToShow: 1,
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			dots: false,
			speed: 2000,
			autoplay: true,
			fade: true,
			autoplaySpeed: 5000,
			adaptiveHeight: true
		});
	}

	var gallerySliderRtl = $('.rtl .gallery-slider');

	if(gallerySliderRtl.length) {
		gallerySliderRtl.slick({
			rtl: true,
			slidesToShow: 1,
			arrows: true,
			prevArrow: '<button type="button" data-role="none" class="slick-prev slick-arrow" aria-label="Previous"><i class="fa fa-angle-left"></i></button>',
			nextArrow: '<button type="button" data-role="none" class="slick-next slick-arrow" aria-label="Next"><i class="fa fa-angle-right"></i></button>',
			dots: false,
			speed: 2000,
			autoplay: true,
			fade: true,
			autoplaySpeed: 5000,
			adaptiveHeight: true
		});
	}

	// Scroll Top Button
	var scrollTop = $('.scroll-top');
	var showHeight = $(window).height();
	if(scrollTop.length) {
		scrollTop.on('click', function () {
			$('html, body').stop().animate({ scrollTop: 0 }, 1000, 'easeInOutExpo');
			return false;
		});

		$(window).scroll(function () {
			if ($(this).scrollTop() > showHeight) {
				scrollTop.addClass('show');
			} else {
				scrollTop.removeClass('show');
			}
		});
	}

	// Check FullScreen
	this.fullScreenMode = document.fullScreen || document.mozFullScreen || document.webkitIsFullScreen; // This will return true or false depending on if it's full screen or not.

	$(document).on ('mozfullscreenchange webkitfullscreenchange fullscreenchange',function(){
		this.fullScreenMode = !this.fullScreenMode;
	});

	// Lazy Load
	var lazyLoadEffect = $('.lazy-load-effect .site-main .post');

	if(lazyLoadEffect) {
		lazyLoadEffect.waypoint(function(direction) {
			if (direction != "down" && this.fullScreenMode) {
				$(this).removeClass("post-visible");
			} else {
				$(this).addClass("post-visible");
			}
		}, {offset: '100%'} );
	}

	// Responsive Video Embed
	$('body').fitVids();
	$('.jarallax').fitVids();

	// MailChimp
	$(document).on("click", ".mc-form-submit", function (e) {
		var form = $(this).closest('.mc-form');
		if (form.length) {
			form.ajaxChimp({
				language: 'custom',
				callback: mailchimpCallback,
				url: object.url
			});
		}

		// callback function when the form submitted, show the notification box
		function mailchimpCallback(resp) {
			var messageContainer = form.find('.message-newsletter');

			messageContainer.removeClass('error');

			form.find('.form-group').removeClass('error');
			if (resp.result === 'error') {
				form.find('.input-group').addClass('error');
				messageContainer.addClass('error');
			} else {
				form.find('.form-control').val('').focus().blur();
			}

			messageContainer.slideDown('slow', 'swing');

			setTimeout(function () {
				messageContainer.slideUp('slow', 'swing');
			}, 10000);
		}

		$.ajaxChimp.translations.custom = {
			'submit': object.m_submit,
			0: object.m_0,
			1: object.m_1,
			2: object.m_2,
			3: object.m_3,
			4: object.m_4,
			5: object.m_5
		};
	});
});
