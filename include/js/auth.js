function OpenSlider()
{
	$("#slider-in").animate({ height: "170px" });
	$("#login").focus();
	$("#open-div-auth").toggle();
	$("#close-div-auth").toggle();
	return false;
}

function CloseSlider()
{
	$("#slider-in").animate({ height: "0" });
	$("#open-div-auth").toggle();
	$("#close-div-auth").toggle();
	return false;
}
	 
$(document).ready(function(){$("#open-button-auth").click(OpenSlider);$("#close-button-auth").click(CloseSlider);});