const $ = require('jquery')

// require('slick-carousel')
let backToTop = require('./../components/backToTop/backToTop')

$(document).ready(function(e) {
	// require('./../components/carousel/carousel')
	require('./../components/cookieBar/cookieBar')
	require('./../components/dropdowns/dropdowns')
	require('./../components/Header/Header')

  let backToTopSelector = '.js-back-to-top';
  backToTop.init(backToTopSelector);
  backToTop.click(backToTopSelector);

  $(window).scroll(function () {
    backToTop.init(backToTopSelector);
  });
});