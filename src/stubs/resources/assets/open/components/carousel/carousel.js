const $ = require('jquery');

$('.js-carousel').slick({
	//prevArrow: '<button type="button" class="slick-prev"><i class="fal fa-chevron-left" aria-hidden="true"></i></button>',
	//nextArrow: '<button type="button" class="slick-next"><i class="fal fa-chevron-right" aria-hidden="true"></i></button>',
	arrows: false,
	autoplay: true,
	autoplaySpeed: 10000,
	pauseOnHover: true,
	dots: true,
	infinite: false
});