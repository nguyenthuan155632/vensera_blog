jQuery(document).ready(function($) {
var stickyNavTop = $('.main-header').offset().top;

var stickyNav = function(){
var scrollTop = $(window).scrollTop();
     
if (scrollTop > stickyNavTop) { 
    $('.main-header').addClass('sticky-menu');
} else {
    $('.main-header').removeClass('sticky-menu'); 
}
};

stickyNav();

$(window).scroll(function() {
	stickyNav();
});
});
