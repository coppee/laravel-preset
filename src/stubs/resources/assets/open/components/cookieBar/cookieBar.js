const $ = require('jquery')
const Cookie = require('js-cookie')

if(Cookie.get('accept-cookies')===undefined)
{
	$('.js-cookie-bar').show()
	$('.js-cookie-bar__cta').click(function(e)
	{
		e.preventDefault()
		Cookie.set('accept-cookies', 'accepted', { expires: 30*12 }) //expires : 1Y
		$('.js-cookie-bar').fadeOut()
	})
}