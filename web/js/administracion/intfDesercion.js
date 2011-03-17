Ext.namespace('Saspa.parametros');

Saspa.parametros.desercion = {
	init : function(){

		var decStore = new Ext.data.JsonStore({
	        url: URL_SASPA+'administracion.php/parametros/listarDecersion',
        	root: 'datos',
	        fields:	[
				{name : 'decId' },
				{name : 'sede'},
				{name : 'facultad'},
				{name : 'tipoPrograma'},
				{name : 'periodo', type : 'int'},
				{name : 'valor',   type : 'float'},
			]
		});
		
		var strfacultad = new Ext.data.JsonStore({
			url  : URL_SASPA+'administracion.php/parametros/listarFacultades',
			fields   : ['fac_id','fac_nombre']
		});
		
		var strSede = new Ext.data.JsonStore({
			url  : URL_SASPA+'administracion.php/parametros/listarSedes',
			fields   : ['sed_codigo','sed_nombre']
		});

		var decTbar  =	
		[
			{
				text    : 'Crear',
				cls     : 'x-btn-text-icon',
				icon    : '../images/table_row_insert.png',
				handler : this.onCrear
			},'-',
			{
				text    : 'Eliminar',
				cls     : 'x-btn-text-icon',
				icon    : '../images/table_row_delete.png',
				handler : this.onEliminar 
			}
		];


		decStore.load();
		
		var decColModel = new Ext.grid.ColumnModel([
			{ header : "Periodo",       width : 60,  sortable : true, dataIndex : 'periodo' },
			{ header : "Sede",          width : 80,  sortable : true, dataIndex : 'sede' },
			{ header : "Facultad",      width : 80,  sortable : true, dataIndex : 'facultad' },
			{ header : "Tipo Programa", width : 100, sortable : true, dataIndex : 'tipo_programa' },
			{ header : "Valor(%)", width : 100, sortable : true, dataIndex : 'valor' }
		]);
		
		var decSm = new Ext.grid.RowSelectionModel({
			singleSelect : true,
			listeners : {
				rowselect : function(sm,row,rec) {
					decForm.getForm().loadRecord(rec);
				}
			}
		});

		var decGrid = new Ext.grid.GridPanel({
			id         : 'gridDecersion',
			store      : decStore,
			colModel   : decColModel,
			sm         : decSm,
			height     : 240,
			frame      : true,
			autoScroll : true,
			tbar       : decTbar,
			title      : 'Lista de decersion'
		});
		
		var decForm = new Ext.form.FormPanel(
		{
			id  : 'formDecersion',
			url : URL_SASPA+'administracion_dev.php/parametros/desercion',
			labelWidth: 75,
			title : 'Formulario Decersion',
			frame : true,
			bodyStyle:'padding:5px 5px 0',
			width  : 380,
			height : 240,
			defaults: { width : 180 },
			defaultType: 'textfield',
		      	items :	
			[	
				{
					xtype          : 'combo',
					name           : 'sede',
					displayField   : 'sed_nombre',
					valueField     : 'sed_codigo',
					fieldLabel     : 'Sede',
					store          : strSede,
					emptyText      : 'Selecione una sede...',
              				forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true,
					allowBlank     : false,
					allowBlank     : false
				},
				{
					xtype          : 'combo',
					name           : 'facultad',
					displayField   : 'fac_nombre',
					valueField     : 'fac_id',
					fieldLabel     : 'Facultad',
					store          : strfacultad,
					emptyText      : 'Selecione una facultad...',
              				forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true,
					allowBlank     : false
				},
				{
					fieldLabel : 'Tipo programa',
					name : 'tipoPrograma',
					allowBlank : false
				},
				{
					fieldLabel : 'Periodo',
					name : 'periodo',
					allowBlank : false
				},
				{
					fieldLabel : 'Valor',
					name : 'valor',
					allowBlank : false
				},
				{
					xtype : 'hidden',
					name : 'decId'
				}
			],
			buttonAlign : 'center',
			buttons : 
			[
				{ text : 'Guardar', handler : this.onEnviar }
			]
		});

		var pDecersion = new Ext.Panel(
		{
			renderTo   : 'gestDesercion',
		        layout     : 'column',
		        width      : '100%',
		        autoHeight : true,
		        autoScroll : true,  
		        title      : 'CRUD decersion',
		        frame      : true,
		        items      :	
			[
				{ columnWidth : 0.5, items : [decGrid] },
	        		{ columnWidth : 0.45, items : [decForm] }
			]
		});		
		
	},
	/**
	* Envia la cedula del docente selecionado al servidor
	*
	* @param object button
	* @param object evento	
	*/
	onEliminar : function(btn,evt){
		var rec  = Ext.getCmp('gridocentes').getSelectionModel().getSelected();
		if(!Ext.isEmpty(rec))
		{
			Ext.Msg.show({
				title   : 'Confirmacion',
				msg     : '¿Desea eliminar al docente '+ rec.get('nombre') +' '+ rec.get('apellidos') +'?',
				buttons : Ext.Msg.YESNO,
				fn      : function(btn){
					if(btn == 'yes'){
						Ext.Ajax.request({
							url     : URL_SASPA+'administracion.php/parametros/eliminarDocente',
							params  : {
								cedulaDocente : rec.get('cedula')
							},
							success : function(resp){
								//para atender las respuestas del servidor
								var jsresp = Ext.decode(resp.responseText);
								Ext.Msg.alert('Server', jsresp.msg);
								Ext.getCmp('gridocentes').getStore().reload();
							},
							failure : function(resp){
								Ext.Msg.alert('ERROR','Ocurrio un error mientras se procesaba la solicitud');
							}
						});
					}
				},
				icon    : Ext.MessageBox.QUESTION
			});
			
		}else{
			Ext.Msg.alert("INFORM","Seleccione el registro a eliminar");
		}
		
	},
	/**
	* Limpia los campos del formulario y cambia el nombre del la accion 
	*
	* @param object button
	* @param object evento	
	*/
	onCrear    : function(btn,evt){
		Ext.getCmp('formdocentes').findById('idcedula').enable();
		var bsform = Ext.getCmp('formdocentes').getForm().reset();
		bsform.clearInvalid();
		Ext.getCmp("idoperacion").setValue('Crear');
	},
	/**
	* Envia los datos del formulario al servidor 
	*
	* @param object button
	* @param object evento	
	*/
	onEnviar   : function(btn,evt){
		var fm = Ext.getCmp('formDecersion');
		if(fm.getForm().isValid())
		{
			fm.getForm().submit({
				method    : 'POST',
				waitTitle : 'Enviando',
				waitMsg   : 'Enviando Datos...',
				success   : function(fm,act){
					Ext.Msg.alert('Mensaje',act.result.msg);

					if(act.result.success)
					{
						Ext.getCmp('gridDecersion').getStore().reload();
						fm.reset();
					}
				},
				failured  : function(fm,act){
					Ext.Msg.alert('ERROR','Ocurrio un error mientras se enviaba la informacion');
				}

			});
			
		}else{
			Ext.Msg.alert("INFORM","Los campos en rojo son obligatorios");
		}
	}
	
}
Ext.onReady(Saspa.parametros.desercion.init,Saspa.parametros.desercion);
