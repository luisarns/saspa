Ext.namespace('Saspa.comentario');
Saspa.comentario.comentar = function(urlserv,sol_id,sol_nombre)
{

	var formComentario = new Ext.form.FormPanel({
		title      : 'Comentar solicitud',
		url        : urlserv,
		height     : 350,
		autoWidth  : true,
		frame      : true,
		labelAlign : 'top',
		bodyStyle  : 'padding:5px 5px 0',
		items : [ 
			{
				xtype : 'htmleditor',
				name  : 'comentario',
				fieldLabel : 'Comentario'
			}
		],
		buttons   : [
			{text : 'Aceptar',  handler : enviarComentario},
			{text : 'Cancelar', handler : cancelarComentario},
		]
	});
	
	
	var winprincipal = new Ext.Window({
		title  : sol_id+' - '+sol_nombre,
		layout : 'fit',
		width  : 550,
		height : 350,
		items  : formComentario
	});

	function cancelarComentario()
	{
		winprincipal.close();
	}	
	
	
	function enviarComentario(btn,evobj)
	{
		formComentario.getForm().submit({
			method    : 'POST',
         waitTitle : 'Enviando',
         waitMsg   : 'Enviando datos...',
         params    : {
         	id : sol_id
         },
         success   : function(form, action)
         {
            var response = action.result; //la respuesta del servidor decodificada
            if(response.success){
            	Ext.Msg.alert('INFORM',response.msg);
            	winprincipal.close();
            }else {
            	Ext.Msg.alert('ERROR',response.error);
            }
            //cerrar la ventana, buscar el metodo
         },
         failured : function(form, action)
         {
            Ext.Msg.alert('WARNING','Ocurrio un error mientras se procesaba la solicitud');
         }
      });
	}
	 
	winprincipal.show();	
}