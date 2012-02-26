/*
 My tooltip lib
*/
var config = new Object();

config. width       =   0   // Tooltip width, 0 for auto
config. OffsetX     =  40   // Horizontal offset of left-top corner from mousepointer
config. OffsetY     = -30   // Vertical offset
config. Sticky      = true  // Move or not while shown
config. Border      = true  // Show border
config. step        = 15    // Opacity step time
config. timeUp      = 0     // Show opacity time
config. timeDown    = 300   // Hide opacity time
tt_aV = new Array();        // Caches and enumerates config data for currently active tooltip

// Mouse data
var tt_musX = 0, tt_musY = 0;

// tip data
var tt_opaTimer = new Number(0),
tt_mainDiv = 0,     // Main div
tt_subDiv = 0,      // Main sub div - for opacity
tt_status  = 0,     // Status & 1 - tip shown/hide
tt_element = 0,     // onmouseover element for hide tooltip
tt_opacity = 0,     // Current sub div opacity
tt_isIE = 0,
tt_currentTip = -1,
tt_loading_text = '<div class=loading> </div>';

function ajaxTip()
{
	tt_currentTip = arguments[0];
	arguments[0] = tt_loading_text;
	var id = tt_currentTip;
	tt_Tip(arguments);
	my_AJAX.GETupload("../../ajax.php?tip=" + id, function(text){tt_updateTipData(id, text);});
}
function tt_hrefTip()
{
	if (!this.id)
		return;
	if (this.firstChild.tagName=='IMG')
		ajaxTip(this.id);
	else
		ajaxTip(this.id, STICKY, false);
}

function Tip()
{
	tt_currentTip = -1;
	tt_Tip(arguments);
}
function tt_Tip(arg)
{
	tt_ReadCmds(arg);
	tt_UpdateTip(arg[0]);
	tt_updatePosition();
	tt_startShowTip();
}
function tt_updateTipData(id, text)
{
	if (tt_currentTip != id)
		return;
	if ((tt_status & 1) == 0)
		return;
	tt_UpdateTip(text);
	setOpacity(tt_subDiv, tt_opacity);
	tt_updatePosition();
}
function tt_opaStepUp(step)
{
	tt_opacity+=(100*step/tt_aV[TIMEUP]);
	if (tt_opacity < 100)
		tt_opaTimer.Timer("tt_opaStepUp(" + step + ")", step, true);
	else
		{tt_opaTimer.EndTimer();tt_opacity = 100;}
	setOpacity(tt_subDiv, tt_opacity);
}
function tt_opaStepDown(step)
{
	tt_opacity-=(100*step/tt_aV[TIMEDOWN]);
	if (tt_opacity > 0)
		tt_opaTimer.Timer("tt_opaStepDown(" + step + ")", step, true);
	else
		{tt_opaTimer.EndTimer();tt_finishHideTip();}
	setOpacity(tt_subDiv, tt_opacity);
}
function tt_startShowTip()
{
	tt_opaTimer.EndTimer();
	if (tt_element)
	{
		removeEvent(tt_element, "mouseout", tt_Hide);
		tt_element = 0;
	}

	tt_status|=1;
	tt_mainDiv.style.visibility = "visible";
	if (tt_aV[TIMEUP])
	{
		tt_opacity = 0;
		tt_opaStepUp(tt_aV[STEP]);
	}
	else
	{
		tt_opacity = 100;
		setOpacity(tt_subDiv, tt_opacity);
	}
}
function tt_startHideTip()
{
	tt_opaTimer.EndTimer();
	tt_status&=~1;
	if (tt_aV[TIMEDOWN])
		tt_opaStepDown(tt_aV[STEP]);
	else
		tt_finishHideTip();
}
function tt_finishHideTip()
{
	tt_mainDiv.style.visibility = "hidden";
	tt_opacity = 0;
}
function tt_updatePosition()
{
	var p = getPageRect(),
	width = tt_subDiv.offsetWidth,
	height= tt_subDiv.offsetHeight,
	max_x = p.left + p.width - width,
	max_y = p.top + p.height - height,
	x = tt_musX + tt_aV[OFFSETX],
	y = tt_musY + tt_aV[OFFSETY];
	if (x >= max_x) x = max_x;
	if (y >= max_y) y = max_y;

	var inX_ByX = (tt_musX > x && tt_musX < x + width);
	var inY_ByY = (tt_musY > y && tt_musY < y + height);
	if (inX_ByX && inY_ByY)
	{
		x = tt_musX - width - tt_aV[OFFSETX];
		x = x<p.left?p.left:x;
		inX_ByX = (tt_musX > x && tt_musX < x + width);
		if (inX_ByX) y = tt_musY - height - tt_aV[OFFSETY];
    }
	var css = tt_mainDiv.style;
	css.left = (x<p.left?p.left:x) + 'px';
	css.top  = (y<p.top?p.top:y) + 'px';
}

function tt_UpdateTip(text)
{
	if (tt_aV[BORDER])
	{
		var tt_tipBody = $('tt_tip_body');
		if (tt_tipBody)
		{
			tt_tipBody.innerHTML = text;
			return;
		}
		tt_mainDiv.innerHTML = ''
		+ '<div id=tt_tooltip>'
		+ '<table class=tooltip cellSpacing=0 cellPadding=0><tbody>'
		+ '<tr><td class=tiptopl></td><td class=tiptop></td><td class=tiptopr></td></tr>'
		+ '<tr><td class=tipl>&nbsp;</td><td class=tipbody id=tt_tip_body>'
		+ text
		+ '</td><td class=tipr>&nbsp;</td></tr>'
		+ '<tr><td class=tipbottoml></td><td class=tipbottom></td><td class=tipbottomr></td></tr>'
		+ '</tbody></table></div>';
	}
	else
		tt_mainDiv.innerHTML = ''
		+ '<div id=tt_tooltip>'
		+ text
		+ '</div>';
	tt_subDiv = $('tt_tooltip');
	tt_subDiv.style.width = tt_aV[WIDTH] ? tt_aV[WIDTH] + 'px' : 'auto';
}

function tt_Hide(e)
{
	e = window.event || e;
	if (!e) return;
	var target = e.target || e.srcElement;
	if (tt_element == target) {
		removeEvent(tt_element, "mouseout", tt_Hide);
		tt_element = 0;
		tt_startHideTip();
	}
}

function tt_Move(e)
{
	e = window.event || e;
	if (!e) return;
   	var b = document.body || document.documentElement;
	tt_musX = e.pageX || (e.clientX + b.scrollLeft);
	tt_musY = e.pageY || (e.clientY + b.scrollTop);
	if (tt_element == 0 && tt_status & 1)
	{
		tt_element = e.target || e.srcElement;
		addEvent(tt_element, "mouseout", tt_Hide);
	}
	if (!tt_aV[STICKY] && tt_status&1)
	   tt_updatePosition();
}
function Init()
{
	// Create the tooltip DIV
	tt_mainDiv = insertElement(getBody(), 'DIV','tt_mytooltip');
	tt_mainDiv.style.position = "absolute";
	tt_mainDiv.style.zIndex   = 1000;
	tt_MkCmdEnum();
	addEvent(document, "mousemove", tt_Move);
	tt_finishHideTip();
}

// Creates command names by translating config variable names to upper case
function tt_MkCmdEnum()
{
	var n = 0;
	for(var i in config)
		eval("window." + i.toString().toUpperCase() + " = " + n++);
}
function tt_ReadCmds(a)
{
	var i=0;
	// First load the global config values, to initialize also values
	// for which no command has been passed
	for(var j in config)
		tt_aV[i++] = config[j];
	// Then replace each cached config value for which a command has been
	// passed (ensure the # of command args plus value args be even)
	if(a.length & 1)
	{
		for(i = a.length - 1; i > 0; i -= 2)
			tt_aV[a[i - 1]] = a[i];
		return true;
	}
	tt_Err("Incorrect call of Tip() or ajaxTip().\n"
			+ "Each command must be followed by a value.");
	return false;
}
Init();
