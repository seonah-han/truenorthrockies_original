'use strict';

jQuery(function ($) {
  var waitFor = function waitFor(selector, callback) {
    if ($(selector).length) {
      callback();
    } else {
      setTimeout(function () {
        waitFor(selector, callback);
      }, 100);
    }
  };

  // navigation bar
  $('.site-header').html('\n    <div class="header clearfix">\n  \t\t<div class="header-inner">\n  \t\t\t<a href="#" class="menu-button"><span></span></a>\n  \t\t\t<ul class="header-menu no-style el-iblock pull-left">\n  \t\t\t\t<li class="nav-search"><a class="open-search-overlay"><i class="fa fa-search"></i></a></li>\n  \t\t\t\t<li><a href="http://truenorthrockies.com">Home</a></li>\n  \t\t\t\t<li><a href="http://blog.truenorthrockies.com">Blog</a></li>\n  \t\t\t\t<li><a href="http://truenorthrockies.com/#explore">Activities Guide</a></li>\n  \t\t\t\t<li><a href="http://truenorthrockies.com/#subscribe">Subscribe</a></li>\n  \t\t\t</ul>\n  \t\t\t<div class="camera-enter text-center">\n  \t\t\t\t<a href="http://truenorthrockies.com/#contest" class="camera"><i class="fa fa-camera" aria-hidden="true"></i> <span>#WeLoveWinter</span></a>\n  \t\t\t</div>\n  \t\t\t<a href="#" class="header-logo pull-right">\n  \t\t\t\t<span>presented by</span>\n  \t\t\t\t<img src="http://truenorthrockies.com/images/header_logo_bgr.png" alt="">\n  \t\t\t</a>\n  \t\t</div>\n  \t</div>\n  ');
  $('.site-header').after('\n    <div class="mountain-background">\n      <div style="position: absolute; bottom: 0; left: 0; right: 0; height: 199px; background: url(http://blog.truenorthrockies.com/wp-content/uploads/2018/01/truenorthrockies-transparent-grey.png); background-repeat: repeat-x;"></div>\n  \t</div>\n  ');

  // menu button
  $('.menu-button').on('click', function (e) {
    e.preventDefault();
    $('.menu-button').toggleClass('active');
    $('.header-menu').slideToggle();
  });

  // hero
  var description = function description(post) {
    return post.excerpt.rendered.substr(3, 40) + '...';
  };
  var link = function link(post) {
    return post.link;
  };
  $.ajax({
    url: 'http://blog.truenorthrockies.com/wp-json/wp/v2/posts?per_page=4',
    type: 'get',
    cache: false,
    success: function success(posts) {
      $('.popular-wrapper').html('\n        <div class="container">\n          <div class="logo">\n            <img class="logo__image" src="http://truenorthrockies.com/images/logo_bg.png" alt="">\n            <h3 class="logo__text">WHERE #WELOVEWINTER</h3>\n          </div>\n          <div class="tnr-hero">\n            <div class="tnr-hero-post" style="margin-bottom: 2px; background: url(' + posts[0].better_featured_image.source_url + ') center center / cover no-repeat" onclick="window.location = \'' + link(posts[0]) + '\';">\n              <div class="tnr-hero-post__inner">\n                <div class="tnr-hero-post__name tnr-hero-post__name--large">' + posts[0].title.rendered + '</div>\n                <div class="tnr-hero-post__description">' + description(posts[0]) + '</div>\n                <a class="more-link btn btn-color" href="' + link(posts[0]) + '">Read more...</a>\n              </div>\n            </div>\n            <div class="tnr-hero__bottom">\n              <div class="tnr-hero-post" style="flex: 2; background: url(' + posts[1].better_featured_image.source_url + ') center center / cover no-repeat" onclick="window.location = \'' + link(posts[1]) + '\';">\n                <div class="tnr-hero-post__inner">\n                  <div class="tnr-hero-post__name">' + posts[1].title.rendered + '</div>\n                  <div class="tnr-hero-post__description">' + description(posts[1]) + '</div>\n                  <a class="more-link btn btn-color" href="' + link(posts[1]) + '">Read more...</a>\n                </div>\n              </div>\n              <div class="tnr-hero-post" style="flex: 1; margin: 0 2px; background: url(' + posts[2].better_featured_image.source_url + ') center center / cover no-repeat" onclick="window.location = \'' + link(posts[2]) + '\';">\n                <div class="tnr-hero-post__inner">\n                  <div class="tnr-hero-post__name">' + posts[2].title.rendered + '</div>\n                  <div class="tnr-hero-post__description">' + description(posts[2]) + '</div>\n                  <a class="more-link btn btn-color" href="' + link(posts[2]) + '">Read more...</a>\n                </div>\n              </div>\n              <div class="tnr-hero-post" style="flex: 1; background: url(' + posts[3].better_featured_image.source_url + ') center center / cover no-repeat" onclick="window.location = \'' + link(posts[3]) + '\';">\n                <div class="tnr-hero-post__inner">\n                  <div class="tnr-hero-post__name">' + posts[3].title.rendered + '</div>\n                  <div class="tnr-hero-post__description">' + description(posts[3]) + '</div>\n                  <a class="more-link btn btn-color" href="' + link(posts[3]) + '">Read more...</a>\n                </div>\n              </div>\n            </div>\n          </div>\n      \t</div>\n      ');
    },
    error: function error(req, status, err) {
      return console.log(err);
    }
  });

  // adjust hero image height based on width
  waitFor('.tnr-hero > .tnr-hero-post', function () {
    var width = jQuery('.tnr-hero > .tnr-hero-post').width();
    if (width >= 768) {
      jQuery('.tnr-hero > .tnr-hero-post').height(width * 0.666);
    }
  });

  // post logo
  $('.post-standard .post-img').prepend('\n    <div class="logo logo--embedded">\n      <img class="logo__image" src="http://truenorthrockies.com/images/logo_bg.png" alt="">\n      <h3 class="logo__text">WHERE #WELOVEWINTER</h3>\n    </div>\n  ');

  // category and search logo
  if ($('body').is('.search-results')) {
    $('.page-header').before('\n      <div class="container">\n        <div class="logo" style="margin-top: 20px; margin-bottom: 0;">\n          <img class="logo__image" src="http://truenorthrockies.com/images/logo_bg.png" alt="">\n          <h3 class="logo__text">WHERE #WELOVEWINTER</h3>\n        </div>\n      </div>\n    ');
  } else {
    $('.page-header').before('\n      <div class="logo" style="margin-top: 20px; margin-bottom: 0;">\n        <img class="logo__image" src="http://truenorthrockies.com/images/logo_bg.png" alt="">\n        <h3 class="logo__text">WHERE #WELOVEWINTER</h3>\n      </div>\n    ');
  }

  // search
  $('body').prepend('\n    <div class="nav-search"><div class="search-form-container">\n      <form method="get" class="search-form form" action="http://blog.truenorthrockies.com/">\n        <label class="sr-only">Search for: </label>\n        <div class="input-group">\n          <input type="search" value="" name="s" class="search-field form-control" placeholder="Enter Keyword..." required="">\n          <span class="input-group-btn">\n            <button type="submit" class="btn search-submit"><i class="fa fa-search"></i></button>\n          </span>\n        </div>\n        <p class="search-text">Input your search keywords and press Enter.</p>\n      </form>\n    </div>\n    <span class="close-search-overlay"><i></i></span></div>\n  ');

  $('.nav-search .open-search-overlay').on('click', function () {
    $('body').addClass('search-overlay');

    setTimeout(function () {
      $('.nav-search .search-form-container').fadeIn(500).css('display', 'table');
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

  // tags
  $('.tagcloud').html($('.tagcloud a').slice(0, 18));
});
