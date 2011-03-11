//cargar una pagina o script en un div
function actualizarPanel(div, accion)
{
    Ext.get(div).load({url: accion, scripts: true,text: "Cargando ..."});
}

//var URL_SASPA = 'http://192.168.3.120/saspa/web/';
var URL_SASPA = 'http://127.0.0.1/saspa/web/';
