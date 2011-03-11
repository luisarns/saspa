Ext.namespace('Saspa.parametros');

Saspa.parametros.facultad = {
	init : function(){
	
		var stfacultades = new Ext.data.JsonStore({
			id   : 'stfacultades',
			url  : URL_SASPA+'administracion.php/parametros/listarFacultades',
			autoLoad : true,
			fields : [
				{name : 'fac_id'},
				{name : 'fac_nombre'}
			]
		});
		
		var cmFacultades = new Ext.grid.ColumnModel([
			{header : "Identificador", resizable : true, sortable : true, dataIndex : 'fac_id', width : 70},
			{header : "Nombre", resizable : true, sortable : true, dataIndex : 'fac_nombre', width : 220  }
		]);
		
		var gridFacultades = new Ext.grid.GridPanel({
			id    : 'gridfacultades',
			store : stfacultades ,
			cm    : cmFacultades ,
			sm    : new Ext.grid.RowSelectionModel({
				singleSelect : true,
				listeners : {
					rowselect : function(sm, row, rec) {
						formDatosFacultad.getForm().loadRecord(rec);
						formDatosFacultad.findById('facnombre').enable();//campo
						Ext.getCmp("idoperacion").setValue('Actualizar');
						
						
						
						
						//hacer la actualizacion del grid con las dependencias
						var fac = rec.get('fac_id');
						var dep = Ext.getCmp('gridDependencias');
						dep.getStore().baseParams.idFacultad = fac;
						Ext.getCmp('gridDependencias').getStore().reload();
						//desactivar los campos del formulario
						formDatosDependencia.findById('depcodigo').disable();
						formDatosDependencia.findById('depnombre').disable();
						//recargar el grid con los registros de las dependencia de la facultad selecionada
					}
				}
			}),
			title : 'Facultades',
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
			height    : 250,
			width     : 360
		});
		
		
		//Formulario para la facultad
		var formDatosFacultad   = new Ext.FormPanel({
            url: URL_SASPA+'administracion.php/parametros/facultad',
            id : 'iddatosFacultad',
            title:'Información de la facultad',
            style: 'width:50%;height:70%',
            frame: true,
            border: true,
            layout:'fit',
            resizable: true,
            align:'center',
            items:[{
                items: [{
                    xtype: 'fieldset',
                    autoHeight: 'true',
                    labelWidth: 80,
                    style:'padding:10px',
                    items:[
                        {
                            xtype: 'textfield',
                            disabled: true,
                            fieldLabel: 'Identificador',
                            allowDecimals: false,
                            name: 'fac_id',
                            id: 'facid',
                            //allowBlank:false,
                            selectOnFocus:true,
                            maskRe: /^[0-9]$/,
                            blankText: 'El identificador es obligatorio',
									 anchor: '95%'
                        },
                        {
                            xtype:'textfield',
                            disabled: true,
                            fieldLabel: 'Nombre',
                            name: 'fac_nombre',
                            id: 'facnombre',
                            allowBlank:false,
                            selectOnFocus:true,
                            blankText: 'El nombre es obligatorio',
									 anchor: '95%'
                        },
                        {
                        	//definir un edentificador de operacion
                        	xtype : 'hidden',
									name  : 'operacion',
									id    : 'idoperacion',
									value : 'Crear'
                        }
                    ]
                }]
            }],
            buttons:[{
            	text:'Guardar',
					formBind: true,
					id: 'btGuardar',
					handler : this.onEnviar
            }]
        });
		
		
		//ELEMENTOS PARA LA GESTION DE LAS DEPENDENCIAS
		var stdependencias = new Ext.data.JsonStore({
			id   : 'stdependencias',
			url  : URL_SASPA+'administracion.php/parametros/listarDependencias',
			baseParams : {idFacultad : 0},
			fields : [
				'dep_codigo','dep_nombre'
			]
		});
		
		var cmDependencias = new Ext.grid.ColumnModel([
			{header : "Codigo", resizable : true, sortable : true, dataIndex : 'dep_codigo', width : 70},
			{header : "Nombre", resizable : true, sortable : true, dataIndex : 'dep_nombre', width : 220  }
		]);
		
		var gridDependencias = new Ext.grid.GridPanel({
			id    : 'gridDependencias',
			store : stdependencias ,
			cm    : cmDependencias ,
			sm    : new Ext.grid.RowSelectionModel({
				singleSelect : true,
				listeners : {
					rowselect : function(sm, row, rec) {

						formDatosDependencia.getForm().loadRecord(rec);
						Ext.getCmp("idopdepen").setValue('Actualizar');
						
						formDatosDependencia.findById('depcodigo').enable();
						formDatosDependencia.findById('depnombre').enable();
						
					}
				}
			}),
			title : 'Dependencias',
			frame : true,
			tbar  : [
				{
					text    : 'Crear',
					cls     : 'x-btn-text-icon',
					icon    : '../images/table_row_insert.png',
					handler : this.onCreard
				},'-',
				{
					text    : 'Eliminar',
					cls     : 'x-btn-text-icon',
					icon    : '../images/table_row_delete.png',
					handler : this.onEliminard
				}
			],			
			height    : 250,
			width     : 360
		});
		
		var formDatosDependencia = new Ext.FormPanel({
            url: URL_SASPA+'administracion.php/parametros/almacenarDependencia',
            id : 'iddatosDependencia',
            title:'Información de la dependencia',
            style: 'width:50%;height:70%',
            frame: true,
            border: true,
            layout:'fit',
            resizable: true,
            align:'center',
            items:[{
                items: [{
                    xtype: 'fieldset',
                    autoHeight: 'true',
                    labelWidth: 80,
                    style:'padding:10px',
                    items:[
                        {
                            xtype: 'textfield',
                            disabled: true,
                            fieldLabel: 'Codigo',
                            allowDecimals: false,
                            name: 'dep_codigo',
                            id: 'depcodigo',
                            allowBlank:false,
                            selectOnFocus:true,
                            blankText: 'El identificador es obligatorio',
			    anchor: '95%'
                        },
                        {
                            xtype:'textfield',
                            disabled: true,
                            fieldLabel: 'Nombre',
                            name: 'dep_nombre',
                            id: 'depnombre',
                            allowBlank:false,
                            selectOnFocus:true,
                            blankText: 'El nombre es obligatorio',
			    anchor: '95%'
                        },
                        {
                        	xtype : 'hidden',
				name  : 'operacion',
				id    : 'idopdepen',
				value : 'Crear'
                        }
                    ]
                }]
            }],
            buttons:[{
            	text:'Guardar',
		formBind: true,
		id: 'btGuardar',
		handler : this.onEnviard
            }]
        });
		//FIN DE LOS ELEMENTOS DE LAS DEPENDENCIAS
		

		//Panel principal 
		var pnFacultad = new Ext.Panel({
			renderTo : 'gestFacultades',
			frame: true,
			autoScroll: true,
			autoWidth: true,
			fitToFrame: true,
			items:[
				{
					xtype:'panel',
               border:true,
               region:'north',
					width: 1024,
					layout: 'column',
               titlebar: true,
               title: 'Manejo Facultades',
               collapsible:true,
               animate:true,
               fitToFrame: true,
               items: [ gridFacultades , formDatosFacultad ]
				},
				{
					xtype:'panel',
               border:true,
               region:'north',
					width: 1024,
					layout: 'column',
               titlebar: true,
               title: 'Manejo Dependencias',
               collapsible:true,
               animate:true,
               fitToFrame: true,
               items: [ gridDependencias , formDatosDependencia ]
				}
			]
		});
		
		
		///sipi/apps/administracion/modules/sedes/templates/sedesSuccess,php
		
	},
	/**
	* Envia la cedula del docente selecionado al servidor
	*
	* @param object button
	* @param object evento	
	*/
	onEliminar : function(btn,evt){
		var rec  = Ext.getCmp('gridfacultades').getSelectionModel().getSelected();
		if(!Ext.isEmpty(rec))
		{
			Ext.Msg.show({
				title   : 'Confirmacion',
				msg     : '¿Desea eliminar la facultad '+ rec.get('fac_nombre') +' ?',
				buttons : Ext.Msg.YESNO,
				fn      : function(btn){
					if(btn == 'yes'){
						Ext.Ajax.request({
							url     : URL_SASPA+'administracion.php/parametros/eliminarFacultad',
							params  : {
								fac_id : rec.get('fac_id')
							},
							success : function(resp){
								//para atender las respuestas del servidor
								var jsresp = Ext.decode(resp.responseText);
								Ext.Msg.alert('Respuesta', jsresp.msg);
								Ext.getCmp('gridfacultades').getStore().reload();
								Ext.getCmp('gridDependencias').getStore().reload();
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
	* Envia la cedula del docente selecionado al servidor
	*
	* @param object button
	* @param object evento	
	*/
	onEliminard : function(btn,evt){
	//Continuar aqui Luis
		var rec  = Ext.getCmp('gridDependencias').getSelectionModel().getSelected();
		if(!Ext.isEmpty(rec))
		{
			Ext.Msg.show({
				title   : 'Confirmacion',
				msg     : '¿Desea eliminar la dependencia '+ rec.get('dep_codigo') +'?',
				buttons : Ext.Msg.YESNO,
				fn      : function(btn){
					if(btn == 'yes'){
						Ext.Ajax.request({
							url     : URL_SASPA+'administracion.php/parametros/eliminarDependencia',
							params  : {
								dep_codigo : rec.get('dep_codigo')
							},
							success : function(resp){
								var jsresp = Ext.decode(resp.responseText);
								Ext.Msg.alert('Respuesta', jsresp.msg);
								Ext.getCmp('gridDependencias').getStore().reload();
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
			Ext.getCmp('iddatosFacultad').findById('facnombre').enable();//campo
			var bsform = Ext.getCmp('iddatosFacultad').getForm().reset();
			bsform.clearInvalid();
			Ext.getCmp("idoperacion").setValue('Crear');
	},
	onCreard   : function(btn,evt){
			Ext.getCmp('iddatosDependencia').findById('depnombre').enable();
			Ext.getCmp('iddatosDependencia').findById('depcodigo').enable();
			var bsform = Ext.getCmp('iddatosDependencia').getForm().reset();
			bsform.clearInvalid();
			Ext.getCmp("idopdepen").setValue('Crear');
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
			btn.findParentByType('form').findById('facid').enable();//campo
			btn.findParentByType('form').getForm().submit({
				method    : 'POST',
				waitTitle : 'Enviando',
				waitMsg   : 'Enviando Datos...',
				success   : function(fm,act){
					Ext.Msg.alert('Mensaje',act.result.msg);
					fm.reset();
					if(act.result.success)
					{
						Ext.getCmp('gridfacultades').getStore().reload();
					}
					btn.findParentByType('form').findById('facid').disable();
				},
				failured  : function(fm,act){
					Ext.Msg.alert('ERROR','Ocurrio un error mientras se envianban los datos');
				}
			});
		}else{
			Ext.Msg.alert("INFORM","Los campos en rojo son obligatorios");
		}
		
	},
	onEnviard   : function(btn,evt){
		if(btn.findParentByType('form').getForm().isValid())
		{
			btn.findParentByType('form').getForm().submit({
				method    : 'POST',
				waitTitle : 'Enviando',
				waitMsg   : 'Enviando Datos...',
				params    : {
				//para enviar el identificar de la facultad selecionado al servidor
					depfacultad : Ext.getCmp('gridfacultades').getSelectionModel().getSelected().get('fac_id')
				},
				success   : function(fm,act){
					Ext.Msg.alert('Mensaje',act.result.msg);
					fm.reset();
					if(act.result.success)
					{
						Ext.getCmp('gridDependencias').getStore().reload();
					}
				},
				failured  : function(fm,act){
					Ext.Msg.alert('ERROR','Ocurrio un error mientras se envianban los datos');
				}
			});
		}else{
			Ext.Msg.alert("INFORM","Los campos en rojo son obligatorios");
		}
		
	}
}

Ext.onReady(Saspa.parametros.facultad.init ,Saspa.parametros.facultad);
