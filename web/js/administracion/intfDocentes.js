Ext.namespace('Saspa.parametros');

Saspa.parametros.docentes = {
	init : function(){
		//aqui va el codigo para la gestion de los docentes
		var stdocentes = new Ext.data.JsonStore({
			id   : 'stdocentes',
			url  : URL_SASPA+'administracion.php/parametros/listarDocentes',
			root : 'datos',
			autoLoad : true,
			fields : [
				{name : 'cedula'},
				{name : 'nombre'},
				{name : 'apellidos'},
				{name : 'facultad'},
				{name : 'dependencia'},
				{name : 'categoria'}
			]
		});
		
		var cmDocentes = new Ext.grid.ColumnModel([
			{header : "Cedula", resizable : true, sortable : true, dataIndex : 'cedula'},
			{header : "Nombre", resizable : true, sortable : true, dataIndex : 'nombre'},
			{header : "Apellidos", resizable : true, sortable : true, dataIndex : 'apellidos'},
			{header : "Facultad", resizable : true, sortable : true, dataIndex : 'facultad'},
			{header : "Dependencia", resizable : true, sortable : true, dataIndex : 'dependencia'},
			{header : "Categoria", resizable : true, sortable : true, dataIndex : 'categoria'}
		]);
		
		var gridDocentes = new Ext.grid.GridPanel({
			id    : 'gridocentes',
			store : stdocentes,
			cm    : cmDocentes,
			sm    : new Ext.grid.RowSelectionModel({
				singleSelect : true,
				listeners : {
					rowselect : function(sm, row, rec) {
						formDocentes.getForm().loadRecord(rec);
						Ext.getCmp("idoperacion").setValue('Actualizar');
						formDocentes.findById('idcedula').disable();
					}
				}
			}),
			title : 'Docentes',
			frame : true,
			tbar  : [
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
			],
			autoWidth : true,
			height    : 500
		});
		
		var strfacultad = new Ext.data.JsonStore({
			url  : URL_SASPA+'administracion.php/parametros/listarFacultades',
			fields   : ['fac_id','fac_nombre']
		});
		
		var strdependencia = new Ext.data.JsonStore({
			url    : URL_SASPA+'administracion.php/parametros/listarDependencias',
			baseParams : { idFacultad : 0 },
			fields : ['dep_codigo','dep_nombre']
		}); 
		
		
		var formDocentes = new Ext.form.FormPanel({
			title       : 'Gestionar docentes',
			id          : 'formdocentes',
			url         : URL_SASPA+'administracion.php/parametros/index',
			frame       : true,
			autoWidth   : true,
			height      : 500,
			defaultType : 'textfield',
			defaults    : {
				allowBlank : false
			},
			items  : [
				{
					xtype : 'hidden',
					name  : 'operacion',
					id    : 'idoperacion',
					value : 'Crear'
				},
				{
					fieldLabel : 'Cedula',
					id         : 'idcedula',
              				name       : 'cedula'
				},
				{
					fieldLabel : 'Nombre',
              				name       : 'nombre'
				},
				{
					fieldLabel : 'Apellidos',
              				name       : 'apellidos'
				},
				{
					xtype          : 'combo',
					id             : 'id_facultad',
					fieldLabel     : 'Facultad',
					name           : 'facultad',
					store          : strfacultad,
					displayField   : 'fac_nombre',
					emptyText      : 'Selecione una facultad...',
              				forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true,
					anchor         : '90%',
					listeners      : {
						select : function(combo,rec,index){
							var fac = rec.get('fac_id');
							var dep = Ext.getCmp('id_dependencia');
							dep.store.baseParams.idFacultad = fac;
							
							dep.setDisabled(true);
							dep.setValue('');
							dep.store.removeAll();
							
							dep.store.reload({
								callback : function(){
									dep.setDisabled(false);
								}
							});
							
						}
					}
					//fin del listeners
				},
				{
					xtype          : 'combo',
					id             : 'id_dependencia',
					fieldLabel     : 'Dependencia',
              				name           : 'dependencia',
					store          : strdependencia,
					displayField   : 'dep_nombre',
					anchor         : '90%',
					emptyText      :'Selecione una dependencia...',
					forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true
				},
				{
					xtype          : 'combo',
					fieldLabel     : 'Categoria',
					name           : 'categoria',
					mode           : 'local',
					store          : ['Titular','Asociado','Asistente','Auxiliar'],
					anchor         : '90%',
					forceSelection : true,
					triggerAction  : 'all',
					typeAhead      : true
				}
			],
			buttons : [
				{
					text : 'Enviar', 
					handler : this.onEnviar
				}
			]
			
		});		
		
		
		var conDocentes = new Ext.Panel({
			title     : 'Datos Docentes',
			layout    : 'column',
			width     : 710,
			items     : [
				{
					columnWidth : 0.6,
					layout      : 'fit',
					items       : gridDocentes
				},
				{
					columnWidth : 0.4,
					items       : formDocentes
				}
			],
			renderTo : 'gestDocentes'
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
	* @param object btn
	* @param object evt	
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
	* @param object btn
	* @param object evt	
	*/
	onEnviar   : function(btn,evt){
		if(btn.findParentByType('form').getForm().isValid())
		{
			Ext.getCmp('formdocentes').findById('idcedula').enable();
			Ext.getCmp('formdocentes').getForm().submit({
				method    : 'POST',
				waitTitle : 'Enviando',
				waitMsg   : 'Enviando Datos...',
				success   : function(fm,act){
					fm.reset();
					if(act.result.success)
					{
						Ext.getCmp('gridocentes').getStore().reload();
						Ext.Msg.alert('Mensaje',act.result.msg);
					}else{
						Ext.Msg.alert('Error',act.result.msg);
					}
				},
				failured  : function(fm,act){
					Ext.Msg.alert('ERROR','Ocurrio un error mientras se procesaba la solicitud');
				}

			});
			
		}else{
			Ext.Msg.alert("INFORM","Los campos en rojo son obligatorios");
		}
	}
	
}

Ext.onReady(Saspa.parametros.docentes.init,Saspa.parametros.docentes);
