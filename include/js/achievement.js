var a_lastShow = 0;

function changeFaction(href)
{
	uploadFromHref(href, 'a_data');
	return false;
}

function cacheCat(url)
{
	ajaxCacheHtmlId('a_data', url);
}

function selectCat(id)
{
	var node = $('a_category');
	if (!node)
		return;
	a_lastShow = 0;
	var list = node.getElementsByTagName('a'), selected = 0;
	for (var i=0;i<list.length;i++)
	{
		var e = list[i], parent = e.parentNode;
		if (e.id == 'ach_' + id)
		{
			parent.className = 'a_bodycat_sel';
			if (e.className=='sub')
				e.className = 'sel';
			selected = parent;
			uploadFromHref(e, 'a_data');
		}
		else
		{
			if (selected!=parent)
				parent.className = 'a_bodycat';
			if (e.className=='sel')
				e.className = 'sub';
		}
	}
	return false;
}

function changeSelection(element, sel)
{
	var name = element.className, s = sel?' select':'';
	element.className = (name=='ach_show' || name=='ach_show select') ? 'ach_show'+s : 'ach_show'+s+' locked';
	element.id = sel ? 'selected':'not_select';
}

function showAchReq(element)
{
	if (a_lastShow && a_lastShow != element)
		changeSelection(a_lastShow, false);
	a_lastShow = element;
	changeSelection(element, element.id != 'selected');
}