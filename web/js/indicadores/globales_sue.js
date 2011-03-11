var categoria_sue = '01';
function actualizarPanel_sue(div, accion, cat, nom)
{
    categoria_sue = cat;
    cat_sue_nom   = nom;
    Ext.get(div).load({url: accion, scripts: true,text: "Cargando ..."});
}



// function actualizarPanel(div, accion)
// {
//      Ext.get(div).load({url: _URL_SIPI+accion,scripts: true,text: "Cargando MODULO..."});
// //     setTimeOut(function(){Ext.get('central').doLayout();},250);
// }