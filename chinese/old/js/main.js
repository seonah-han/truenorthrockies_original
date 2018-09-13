WebFont.load({
	google: {
		families: ['Source Sans Pro:400,600,700', 'Roboto Condensed:700']
	}
});

//YOUTUBE API
var tag = document.createElement('script');

tag.src = "https://www.youtube.com/iframe_api";
var firstScriptTag = document.getElementsByTagName('script')[0];
firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);

var trueadrenaline;
var truediscovery;
function onYouTubeIframeAPIReady() {
	trueadrenaline = new YT.Player('trueadrenaline', {
		videoId: 'Sh10z5h4lQk'
	});
	truediscovery = new YT.Player('truediscovery', {
		videoId: 'SSkSZ1zDihY'
	});
}

//LAYOUT SWAP

var gallery = {
	
	init: function() {
		this.setRows();
	},
	getDisplay: function() {
		
		var hash, display;

		hash = window.location.hash;
		display = [
					{
						id: 1,
						expand: 2
					},
					{
						id: 2,
						expand: 1
					},
					{
						id: 3,
						expand: 2
					},
					{
						id: 4,
						expand: 1
					},
					{
						id: 5,
						expand: 2
					},
					{
						id: 6,
						expand: 3
					},
					{
						id: 7,
						expand: null
					}
				];

		if(hash != 'undefined'){
			if(hash == '#adventure'){
				display = [
					{
						id: 5,
						expand: 1
					},
					{
						id: 1,
						expand: 1
					},
					{
						id: 2,
						expand: 3
					},
					{
						id: 3,
						expand: 1
					},
					{
						id: 6,
						expand: 1
					},
					{
						id: 4,
						expand: 2
					},
					{
						id: 7,
						expand: null
					}
				];
			} else if(hash == '#relax') {
				display = [
					{
						id: 6,
						expand: 3
					},
					{
						id: 2,
						expand: 1
					},
					{
						id: 5,
						expand: 2
					},
					{
						id: 1,
						expand: 2
					},
					{
						id: 4,
						expand: 1
					},
					{
						id: 3,
						expand: 2
					},
					{
						id: 7,
						expand: null
					}
				];
			} else if(hash == '#ski') {
				display = [
					{
						id: 2,
						expand: 2
					},
					{
						id: 5,
						expand: 2
					},
					{
						id: 6,
						expand: 2
					},
					{
						id: 4,
						expand: 2
					},
					{
						id: 3,
						expand: 2
					},
					{
						id: 1,
						expand: 1
					},
					{
						id: 7,
						expand: null
					}
				];
			}
		}

		return display;
	},
	getRows: function() {

		var display, rows, row, next, element, bigElement, count, contracted, expanded;

		display = this.getDisplay();		
		rows = [];

		$.each(display, function(key, value){
			row = $('#row' + value.id);
			if(key != (display.length - 1)){
				element = row.find('.g-box');
				bigElement = element.eq(value.expand-1);
				next = display[key+1].id;
				count = element.length;
				
				if(count == 2){
					contracted = 'g-box-33';
					expanded = 'g-box-66 is-opened visible';
				} else if(count == 3) {
					contracted = 'g-box-15';
					expanded = 'g-box-56 is-opened visible';
				}

				element.attr('data-next-row', '#row' + next);
				element.not(bigElement).addClass(contracted);
				bigElement.addClass(expanded);
			}
			rows.push(row);
		});
		
		return rows;
	},
	setRows: function() {

		var rows, element;
		rows = this.getRows();
		container = $('.gallery-images .container');

		$('.g-box-wrap').remove();

		$.each(rows, function(key, value){
			container.append(value);
		});

	}
}

gallery.init();

var trueNorth = {
	init: function() {
		this.cacheDom();
		this.windowWidth();
		this.isDevice();
		this.boxNotExpanded();
		this.rowCollapseAll();
		this.rowCollapse();
		this.rowPushed();
		this.boxHover();
		this.bindEvents();
	},
	cacheDom: function() {
		this.$win = $(window);
		this.gBox = $('.g-box');
		this.close = $('.g-box-close');
		this.gBoxWrap = $('.g-box-wrap');
		this.image = $('.thumb-wrap img');
	},
	//check window width
	windowWidth: function(winW) {
		return  winW || this.$win.width();
	},
	// check for device
	isDevice: function() {
		if (this.windowWidth()>640) {
			return "desktop";
		} else {
			return "mobile";
		}
	},
	boxNotExpanded: function(box) {
		return $(box).is(":not(:visible)");
	},
	boxHover: function($thisDiv) {
		if($thisDiv) {
			var animated = false;
			if($thisDiv.hasClass('g-box-3-anim')) {
				if(!$thisDiv.hasClass('g-box-56')) {
					$thisDiv.removeClass('g-box-15').addClass('g-box-56 is-opened').siblings().removeClass('g-box-56 is-opened').addClass('g-box-15');
					animated = true;
				}

				if(animated) {
					$('.is-opened').one("otransitionend oTransitionEnd msTransitionEnd transitionend", function(e) {
						$thisDiv.addClass('visible').siblings('.g-box').removeClass('visible');
						animated = false;
					});
				}
			} else if($thisDiv.hasClass('g-box-2-anim')) {
				if(!$thisDiv.hasClass('g-box-66')) {
					$thisDiv.removeClass('g-box-33').addClass('g-box-66 is-opened').siblings().removeClass('g-box-66 is-opened').addClass('g-box-33');
					animated = true;
				}

				if(animated) {
					$('.is-opened').one("otransitionend oTransitionEnd msTransitionEnd transitionend", function(e) {
						$thisDiv.addClass('visible').siblings('.g-box').removeClass('visible');
						animated = false;
					});
				}
			}
		}
	},
	rowCollapseAll: function() {
		$('.pushed').animate({'margin-top': 0}, 300).removeClass('pushed');
	},
	rowCollapse: function(nextRow) {
		this.gBoxWrap.not(nextRow).animate({'margin-top': 0}, 300).removeClass('pushed');
	},
	rowPushed: function(nextRow, boxHeight) {
		//if(!$(nextRow).hasClass('pushed')) {
			$(nextRow).animate({
				'margin-top': boxHeight
			}, 300).addClass('pushed');
		//}
	},
	boxClose: function() {
		$('.g-box').removeClass('collapsed');
		$('.expanded-row').slideUp().removeClass("is-expanded");
		this.rowCollapseAll();
	},

	boxAnimation: function(box, boxHeight, row, nextRow, $thisDiv) {
		if(this.isDevice()=="desktop") {
			this.rowPushed(nextRow, boxHeight);
			this.rowCollapse(nextRow);
		}
		$(".is-expanded").slideUp().removeClass("is-expanded");
		$(box).slideDown().addClass('is-expanded');
		$('.collapsed').removeClass('collapsed');
		$thisDiv.addClass('collapsed');
	},

	bindEvents: function() {
		var thisObj = this;
		this.gBox.on("click", function(e){
			e.stopPropagation();
			var $this = $(this);
			var box = $this.attr('data-box');
			var row = $this.attr('data-row');
			var nextRow = $(this).attr('data-next-row');
			var boxHeight = $(box).outerHeight(true);

			if(thisObj.boxNotExpanded(box)) {
				thisObj.boxAnimation(box, boxHeight, row, nextRow, $this);
			}

			trueadrenaline.stopVideo();
			truediscovery.stopVideo();
			
			if($this.find('#trueadrenaline').length > 0){
				trueadrenaline.playVideo();
			} else if ($this.find('#truediscovery').length > 0){
				truediscovery.playVideo();
			}

		});
		this.close.on('click', function(e) {
			e.preventDefault();
			e.stopPropagation();
			var $this = $(this).closest('.g-box');
			var box = $this.attr('data-box');
			var nextRow = $this.attr('data-next-row');
			thisObj.boxClose(box, nextRow, $this);

			if($this.find('iframe').length > 0){
				trueadrenaline.stopVideo();
				truediscovery.stopVideo();
			}

		});
		this.gBox.on("mouseover", function() {
			var $this = $(this);
			thisObj.boxHover($this);
		});
	}
};
trueNorth.init();

$(document).ready(function() {

	$(window).resize(function() {
		trueNorth.boxClose();
	});


	var $winW = $(window).width();
	var $containerW = $('.container').outerWidth();
	var $destinationW = (($winW-$containerW)/2)+(($containerW/3)*2);

	function setDestinationWidth(dd) {
		$('.destination-bg').css('width', dd);
	}
	if($winW>992) {
		setDestinationWidth($destinationW);
	}

	$(window).on('resize', function() {
		$winW = $(window).width();
		$containerW = $('.container').outerWidth();
		$destinationW = (($winW-$containerW)/2)+(($containerW/3)*2);
		if($winW>992) {
			setDestinationWidth($destinationW);
		}
	});

	//JCF Custom Forms
	jcf.replaceAll();

	//Tab panel
	$('.tab-wrap .select-tab li a').on('click', function(e)  {
		e.preventDefault();
		var currentTab = $(this).attr('href');
		//console.log(currentTab);
		$('.tab-wrap ' + currentTab).fadeIn(800).siblings().hide();
		$(this).addClass('active');
		$('.select-tab li a').not(this).removeClass('active');
	});

	//Scroll to top
	$('.scroll-top').on('click', function(e) {
		e.preventDefault();
		$('html, body').animate({ scrollTop: 0 }, 1200);
	});

	//Smooth Scroll
	if($(window).height() <= 900){
		smoothScroll.init({
			offset: -250
		});
	} else {
		smoothScroll.init();
	}

	//bxslider
	if($('.destination-wrap').length>0) {
		$('.destination-wrap').bxSlider({
			mode: 'fade',
			controls: false,
			pagerCustom: '.destination-pager'
		});
	}

	$('form#subscribe').submit(function(e) {
		$(this).find('.error').empty();
		return e.preventDefault();
	});
	if ($('form#subscribe').length > 0) {
		$('form#subscribe').validate({
		  rules: {
		    email: {
		      required: true,
		      email: true
		    },
		    chk1: {
		    	required: true
		    }
		  },
			messages: {
				email: {
					required: "Please enter an email address to subscribe."
				},
				chk1: "Please select this checkbox to subscribe."
			},
		  errorPlacement: function ($error, $element) {
				$('form#subscribe .error' + $element.attr('name')).html($error.text());
			},
		  submitHandler: function(form) {
		    var _this, email, post;
		    _this = $('form#subscribe');
		    email = _this.find('[name="email"]').val();
		    post = $.post(_this.attr('action'), {
		      email: email
		    });
		    return post.done(function(data) {
		    	$('form#subscribe .confirm-text').hide();
		   		$('form#subscribe .error-text').hide();
		      if (data === 'subscribed' || data === 'pending') {
		        $('form#subscribe .confirm-text').show();
		      } else {
		      	$('form#subscribe .error-text').show();
		      }
		    });
		  }
		});
	}

	link = 'http://truenorthrockies.com';

    facebook = 'https://www.facebook.com/sharer/sharer.php?u=' + encodeURI(link);
    $('.share.facebook').click(function(e) {
      e.preventDefault();
      return popUp(facebook);
    });
    twitter = 'https://twitter.com/home?status=' + encodeURI(link);
    $('.share.twitter').click(function(e) {
      e.preventDefault();
      return popUp(twitter);
    });

	popUp = function(link) {
		return window.open(link, '_blank', 'toolbar=no,scrollbars=no,resizable=no,top=0,right=0,width=600,height=400');
	};


	var lightbox_options = {
		centered: true
	}

	$('a.privacy-policy').click(function(e){
		e.preventDefault();
		$('.lightbox.privacy-policy').lightbox_me(lightbox_options);
	});

	$('a.terms-conditions').click(function(e){
		e.preventDefault();
		$('.lightbox.terms-conditions').lightbox_me(lightbox_options);
	});

	$('a.instagram-contest').click(function(e){
		e.preventDefault();
		$('.lightbox.instagram-contest').lightbox_me(lightbox_options);
	});

	$('.lightbox .fa-stack').click(function(){
		$('.lightbox').trigger('close');
	});

});

//INSTAGRAM CUSTOMIZATION
var images = [];
var initFeed = function() {
	$('.juicer-feed .feed-item').each(function(key, value){
		var _this, image, video;
		_this = $(this).find('.j-image');
		_parent = _this.parent();
		if( _this.attr('href').indexOf('juicer') == -1 ){
			if(_this.attr('data-video-url').indexOf('.mp4') > -1){
				video = _this.attr('data-video-url');
			}
			image = {
				'src': _this.attr('data-image'),
				'url': _this.attr('href'),
				'video': video,
				'content': _parent.find('.j-message').html(),
				'likes': _parent.find('.heart').text(),
				'comments': _parent.find('.comments').text()
			}
			images.push(image);
		}
	});
	var instawrapper = $('#instafeed .instawrapper');
	$.when.apply($, images.map(function(item) {

		var div = $('<div class="item"></div>')

		instawrapper.append(div);

		div.append('<img src="'+item.src+'">');
		
		if(item.video != undefined){
			div.append('<span class="fa-stack fa-2x"><i class="fa fa-circle-thin fa-stack-2x"></i><i class="fa fa-play fa-stack-1x"></i></span>');	
		}

		div.append('<div class="overlay" data-url="'+item.url+'">\
					<div class="content">'+item.content+'</div>\
					<div class="meta"><ul><li><a href="'+item.url+'" target="_blank"><i class="fa fa-heart" aria-hidden="true"></i> '+item.likes+'</a> <a href="'+item.url+'" target="_blank"><i class="fa fa-comments" aria-hidden="true"></i> '+item.comments+'</a></li><li><a href="'+item.url+'" target="_blank"><i class="fa fa-instagram" aria-hidden="true"></i></a></li></ul></div>\
				</div>');
	})).then(function() {
		instawrapper.imagesLoaded( function() {
			var isotope = instawrapper.isotope({
				itemSelector: '.item',
				layoutMode: 'packery',
				percentPosition: true
			});	
			var height = instawrapper.find('.item').first().height();
			instawrapper.find('.item').height(height);
			instawrapper.find('.item').eq(9).height(height * 2);

			instawrapper.isotope('layout');

			$('#instafeed').height($('.instawrapper').height()).html($('.instawrapper').html());

			$('#instafeed').find('.overlay').click(function(){
				window.open($(this).attr('data-url'));
			});

		});
	});
}