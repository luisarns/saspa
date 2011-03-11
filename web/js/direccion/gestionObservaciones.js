Ext.namespace('Saspa.comentario');
Saspa.comentario.gstcomentario = function(urlserv,sol_id)
{
	//Entrada el identificador de una solicitud
	//Una lista de comentarios a esta solicitud, con la opcion para cambiar el estado 
	//de estos comentarios
	//el record debe contener el id del comentario para poder hacer la actualizacion
	//la configuracion de los elementos que va a tener el panel
	//Hacer el paso del store en el llamado a un metodo que se encargue de mostrar la ventana con el grid
	//Funcion encargada de mostrar la ventana con su correspondiente funcionalidad
	
	var stcoment = new Ext.data.JsonStore({
		url        : ''+urlserv,
		root       : 'datos',
		baseParams : {
			solicitud : sol_id
		},
		fields     : [
			{name : 'comid', type : 'int'},
			'comentario','estado',
			{name : 'creado', type : 'date', dateFormat : 'Y-m-d H:i:s'}//renderer: Ext.util.Format.dateRenderer('m/d/Y') 
		]
	});
	
	
	stcoment.load();//hago la peticion al servidor con el identificador de la solicitud selecionada
	
	
	//Ejemplo de la especificacion de una plantilla
	var plgexpander = new Ext.grid.RowExpander({
		  tpl : new Ext.Template(
		   '<p><b>Fecha:</b> {creado}</p><br>',
		   '<p><b>Comentario:</b> {comentario}</p>'
		  )
	});
	
	var cmcoment = new Ext.grid.ColumnModel([
		plgexpander,
		{header : "Descripcion", sortable : true, dataIndex : 'comentario'},
		{header : "Estado", sortable : true, dataIndex : 'estado'},
		{header : "Creado", sortable : true, renderer : Ext.util.Format.dateRenderer('d/M/Y'), dataIndex : 'creado'}
	]);
	
	
	//la configuracion de los elementos que va a tener el panel
	var gridcentral = new Ext.grid.GridPanel({
		store      : stcoment,
		cm         : cmcoment,
		stripeRows : true, 
		sm         : new Ext.grid.RowSelectionModel({singleSelect:true}),
		autoWidth  : true,
		//width      : 350,
		//height     : 200,
		plugins 	  : plgexpander
	});

	var winprincipal = new Ext.Window({
		title  : 'Observaciones',
		layout : 'fit',
		width  : 350,
		height : 350,
		items  : gridcentral
	});
	
	//Para los dos botones anteriores poner la imagen de un chulo y una x 
	winprincipal.show();
	
} 


//las para los comentarios solo se le mostraran al usuario director de programa
//aquellos que no esten procesados. Procesada y No procesada