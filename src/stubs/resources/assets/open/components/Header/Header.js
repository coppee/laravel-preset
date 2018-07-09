const $ = require('jquery')

function openResponsiveHeader()
{
	var trigger = $(".js-openResponsiveHeader");
	trigger.click(function () {
		var header = document.getElementById("js-header");
		if (header.className === "Header") {
			header.className += " is-open";
		} else {
			header.className = "Header";
		}
	});
}

openResponsiveHeader();