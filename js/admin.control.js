// functions for toggling the display of theme option modes in Translucence

function setThemeOptionsMode(value, options) {
	var oform = document.getElementById('settings');
	var options_mode = options+"[options-mode]";
	oform.elements[options_mode].value = value;
	oform.submit();
}
