jQuery.fn.exists = function(callback) {
  var args = [].slice.call(arguments, 1);
  if (this.length) {
    callback.call(this, args);
  }
  return this;
};

/*----------------------------------------------------
/*  Dropdown menu
/* ------------------------------------------------- */
jQuery(document).ready(function($) { 
	$('#navigation ul.sub-menu').hide(); // hides the submenus in mobile menu too
	$('#navigation ul li').hover( 
		function() {
			$(this).children('ul.sub-menu').slideDown('fast');
		}, 
		function() {
			$(this).children('ul.sub-menu').hide();
		}
	);
});  

/*----------------------------------------------------
/* Responsive Navigation
/*--------------------------------------------------*/
jQuery(document).ready(function($) {
	var windowHeigth = $(window).height();

    $('#pull').bind('click', function(e) {
        e.preventDefault();
        e.stopPropagation();

        if($('html').hasClass('navigation-is-visible')){
            $('.main-container-wrap').css('height', '');
            $('html').removeClass('navigation-is-visible');
        } else {
            $('.main-container-wrap').height(windowHeigth);
            $('html').addClass('navigation-is-visible');
        }
    });

    $('.main-container-wrap').bind('click', function(e) {            
        if ($('html').hasClass('navigation-is-visible')) {
            
            e.preventDefault();
            e.stopPropagation();

            $('.main-container-wrap').css('height', '');
            $('html').removeClass('navigation-is-visible');
        }
    });
	
});

/*----------------------------------------------------
/* Scroll to top footer link script
/*--------------------------------------------------*/
jQuery(document).ready(function($){
    jQuery('a[href=#top]').click(function(){
        jQuery('html, body').animate({scrollTop:0}, 'slow');
        return false;
    });
	jQuery(".togglec").hide();
	jQuery(".togglet").click(function(){
	jQuery(this).toggleClass("toggleta").next(".togglec").slideToggle("normal");
	   return true;
	});
});

/*----------------------------------------------------
/* Social button scripts
/*---------------------------------------------------*/
jQuery(document).ready(function($){
	jQuery.fn.exists = function(callback) {
	  var args = [].slice.call(arguments, 1);
	  if (this.length) {
		callback.call(this, args);
	  }
	  return this;
	};
	(function(d, s) {
	  var js, fjs = d.getElementsByTagName(s)[0], load = function(url, id) {
		if (d.getElementById(id)) {return;}
		js = d.createElement(s); js.src = url; js.id = id;
		fjs.parentNode.insertBefore(js, fjs);
	  };
	jQuery('span.facebookbtn, .facebook_like').exists(function() {
	  load('//connect.facebook.net/en_US/all.js#xfbml=1', 'fbjssdk');
	});
	jQuery('span.gplusbtn').exists(function() {
	  load('https://apis.google.com/js/plusone.js', 'gplus1js');
	});
	jQuery('span.twitterbtn').exists(function() {
	  load('//platform.twitter.com/widgets.js', 'tweetjs');
	});
	jQuery('span.linkedinbtn').exists(function() {
	  load('//platform.linkedin.com/in.js', 'linkedinjs');
	});
	jQuery('span.pinbtn').exists(function() {
	  load('//assets.pinterest.com/js/pinit.js', 'pinterestjs');
	});
	jQuery('span.stumblebtn').exists(function() {
	  load('//platform.stumbleupon.com/1/widgets.js', 'stumbleuponjs');
	});
	}(document, 'script'));
});