/*
 * Left menu create and options
 */
dd_options['leftmenu'] = {
 min:'1',
 arrow:'skin_pop_arrow',
 arrowtext:'>',
 row:'skin_pop_row',
 selrow:'skin_pop_mrow',
 defpos:{m:'tr', x:-10, y:0}
};

function generateLeftMenu()
{
   var l = leftmenu.length;
   for (var i = 0; i < l; i++)
     document.write(generateLeftSub(leftmenu[i], i));
}
function generateLeftSub(menu, id)
{
   var text = ''
   + '<div class=menutitle>' + menu.name +'</div>'
   + '<div class=skin_menu_sub>'
   +     getSubMenuText(menu.sub, 'leftmenu_' + id)
   + '</div>';
   return text;
}