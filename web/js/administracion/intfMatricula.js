Ext.namespace('Saspa.parametros');

Saspa.parametros.matricula = {
	init : function(){

		var decStore = new Ext.data.JsonStore({
	        url: URL_SASPA+'administracion.php/parametros/listarMatricula',
        	root: 'datos',
	        fields:	[
				{name : 'mat_id' },
				{name : 'mat_ano'},
				{name : 'mat_sede'},
				{name : 'mat_facultad'},
				{name : 'mat_valor',   type : 'float'},
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
			{ header : "Sede",            width : 80,  sortable : true, dataIndex : 'mat_sede' },
			{ header : "Facultad",        width : 80,  sortable : true, dataIndex : 'mat_facultad' },
			{ header : "Año",             width : 100, sortable : true, dataIndex : 'mat_ano' },
			{ header : "Valor Matricula", width : 100, sortable : true, dataIndex : 'mat_valor' }
		]);
		
		var decSm = new Ext.grid.RowSelectionModel({
			singleSelect : true,
			listeners : {
				rowselect : function(sm,row,rec) {
					decForm.getForm().loadRecord(rec);
					//Desactivo la sede y la facultad
					Ext.getCmp('id_sede').disable();
					Ext.getCmp('id_facultad').disable();
				}
			}
		});

		var decGrid = new Ext.grid.GridPanel({
			id         : 'gridMatricula',
			store      : decStore,
			colModel   : decColModel,
			sm         : decSm,
			height     : 240,
			frame      : true,
			autoScroll : true,
			tbar       : decTbar,
			title      : 'Lista de Matricula'
		});
		
		var decForm = new Ext.form.FormPanel(
		{
			id          : 'formMatricula',
			url         : URL_SASPA+'administracion_dev.php/parametros/matricula',
			labelWidth  : 75,
			title       : 'Formulario Matricula',
			frame       : true,
			bodyStyle   :'padding:5px 5px 0',
			width       : 380,
			height      : 240,
			defaults    : { width : 180 },
			defaultType : 'textfield',
		      	items       :
			[	
				{
					xtype          : 'combo',
					hiddenName     : 'mat_sede',
					displayField   : 'sed_nombre',
					valueField     : 'sed_codigo',
					fieldLabel     : 'Sede',
					store          : strSede,
					emptyText      : 'Selecione una sede...',
              				forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true,
					allowBlank     : false,
					id             : 'id_sede'
				},
				{
					xtype          : 'combo',
					displayField   : 'fac_nombre',
					valueField     : 'fac_id',
					hiddenName     : 'mat_facultad',
					fieldLabel     : 'Facultad',
					store          : strfacultad,
					emptyText      : 'Selecione una facultad...',
              				forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true,
					allowBlank     : false,
					id             : 'id_facultad'
				},
				{
					fieldLabel : 'Año',
					name : 'mat_ano',
					allowBlank : false
				},
				{
					fieldLabel : 'Valor',
					name : 'mat_valor',
					allowBlank : false
				},
				{
					xtype : 'hidden',
					name  : 'mat_id',
					id    : 'id_matId'
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
			renderTo   : 'gestMatricula',
		        layout     : 'column',
		        width      : '100%',
		        autoHeight : true,
		        autoScroll : true,  
		        title      : 'CRUD Matricula',
		        frame      : true,
		        items      :	
			[
				{ columnWidth : 0.5,  items : [decGrid] },
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
		var rec  = Ext.getCmp('gridMatricula').getSelectionModel().getSelected();
		if(!Ext.isEmpty(rec))
		{
			Ext.Msg.show({
				title   : 'Confirmacion',
				msg     : '¿Desea eliminar el registro?',
				buttons : Ext.Msg.YESNO,
				fn      : function(btn){
					if(btn == 'yes'){
						Ext.Ajax.request({
							url     : URL_SASPA+'administracion.php/parametros/eliminarMatricula',
							params  : {
								idMatricula : rec.get('mat_id')
							},
							success : function(resp){
								var jsresp = Ext.decode(resp.responseText);
								Ext.Msg.alert('Server', jsresp.msg);
								Ext.getCmp('gridMatricula').getStore().reload();
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
		Ext.getCmp('id_sede').enable();
		Ext.getCmp('id_facultad').enable();
		Ext.getCmp('formMatricula').getForm().reset();
		Ext.getCmp('id_matId').setValue('');
	},
	/**
	* Envia los datos del formulario al servidor 
	*
	* @param object button
	* @param object evento	
	*/
	onEnviar   : function(btn,evt){
		var fm = Ext.getCmp('formMatricula');
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
						Ext.getCmp('gridMatricula').getStore().reload();
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
Ext.onReady(Saspa.parametros.matricula.init,Saspa.parametros.matricula);
