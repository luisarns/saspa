<?php
    echo  '<div id="Solicitudes" style="width:915px;"></div>';
    
    echo javascript_include_tag('extjs/examples/grid/RowExpander.js');
    echo javascript_include_tag('direccion/solicitudes.js');
    echo javascript_include_tag('direccion/gestionObservaciones.js');
    echo use_helper('Javascript');
    
    echo javascript_tag("
      
       //el almacen de datos para las solicitudes
      var storeSolicitud = new Ext.data.JsonStore({
        url: '".URL_SASPA."direccion.php/solicitud/lista',
        root: 'datos',
        totalProperty: 'total',
        fields: [
          {name:'sol_id'},
          {name:'sol_nombre'},
          {name:'sol_escuela'},
          {name:'sol_facultad'},
          {name:'sol_estado'},
          {name:'sol_usuario'},
          {name:'created_at',type : 'date', dateFormat : 'Y-m-d H:i:s' },
          {name:'updated_at',type : 'date', dateFormat : 'Y-m-d H:i:s' }
        ]
      });
      storeSolicitud.load();
      
      
      //el modelo de las columnas para el grid
      var columnSolicitud = new Ext.grid.ColumnModel([
      {id: 'id' , resizable:true, header: '"."Numero de Solicitud"."' , sortable: true, dataIndex: 'sol_id'},      
      {id:'nombre', header: '"."Nombre"."' ,    resizable:true, sortable: true, dataIndex: 'sol_nombre'},
      {header: '"."Escuela"."' ,   resizable:true, sortable: true, dataIndex: 'sol_escuela'},
      {header: '"."Facultad"."' ,  resizable:true, sortable: true, dataIndex: 'sol_facultad'},
      {header: '"."Estado"."' ,    resizable:true, sortable: true, dataIndex: 'sol_estado'},
      {header: '"."Creada"."' ,    resizable:true, sortable: true, dataIndex: 'created_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')},
      {header: '"."Modificada"."', resizable:true, sortable: true, dataIndex: 'updated_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')}
      ]);
      
      var crudSolicitudes = new Ext.form.FormPanel({
        url: '".URL_SASPA."direccion_dev.php/solicitud/Almacenar',//mostrar informacion mas detallada de los errores
        title: 'Información de la solicitud',
        collapseFirst: true,
        collapsible: true,
        border: true,
        frame: true,
        layout: 'column',
        items:[
          {
            columnWidth: 0.6,
            items:{
              xtype: 'grid',
              id: 'grid_solicitud',
              ds: storeSolicitud,
              cm: columnSolicitud,
              stripeRows: true,
              height: 450,
              autoScroll: true,
              plugins:[new Ext.ux.grid.Search({          
                mode:          'local',
                position:      top,
                searchText:    'Filtrar',
                selectAllText: 'Seleccionar todos',
                searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
                width:         150
              })],
              tbar:[
                new Ext.Button({
                  id : 'idNuevo',
				      iconCls: 'usu-nuevo',
				      tooltip: 'Crear una nueva solicitud',
				      handler: function()
				      {
				        //Para crear una nueva solicitud
				        //-1 Quitar la seleccion del grid
				        //-2 Activar todos los campos del formulario excepto el de estado por que este sera manejado internamente.
				        //-3 Cambiar el valor de la variable tipoOperacion por creacion 
				      
				        //1
				        Ext.getCmp('grid_solicitud').getSelectionModel().clearSelections();
				        
				        //2
					     mostrarFormCrearSol();
					     
					     //enmascara el form mientras se activan los campos necesarios para la nueva solicitud
					     myMask = new Ext.LoadMask(crudSolicitudes.getEl(), {msg:'Cargando...',removeMask: true});
					     myMask.show();
					     setTimeout('myMask.hide()',500);
				      }
				    }),'-',' ',
				    new Ext.Button({
				      id : 'idDelete',
				      iconCls: 'delete',
				      tooltip: 'Eliminar una solicitud',
				      handler: function()
				      {
					     //-1 recuperar el id de la solicitud seleccionada
					     var solRec = Ext.getCmp('grid_solicitud').getSelectionModel().getSelected();
					     
					     if(!Ext.isEmpty(solRec))
					     {
					       //-2 enviar el identificador de la solicitud al servidor
					       Ext.Msg.show({ 
            			   title   : 'Confirmacion',
            			   msg     : '¿Desea eliminar la solicitud selecionado?',
             			   buttons : Ext.Msg.YESNO,
            			   fn      : function (btn){
                        if(btn == 'yes')
                        {
					           Ext.Ajax.request({   
                            url : '".URL_SASPA."direccion_dev.php/solicitud/eliminar',   
                            params :{
                              sol_id   : solRec.data.sol_id
                            },  
                        	 success : function(rp) {  
                          		var resp = Ext.decode(rp.responseText);
                          		Ext.Msg.alert('INFORM',resp.msg);
                          		storeSolicitud.reload();
                          		Ext.getCmp('grid_solicitud').getSelectionModel().clearSelections();
                        	 }  
                      	  });
                      	}
                        },
                        icon     : Ext.MessageBox.QUESTION
                      });
                      
					     }else{
					       Ext.Msg.alert('INFORM','Seleccione una solicitud para eliminar');
					     }
					     
				      }
				    }),'-',' ',
				    new Ext.Button({
				      id : 'idDiligenciar',
				      iconCls: 'diligenciar',
				      tooltip: 'Diligenciar una solicitud',
				      handler: function()
				      {
					     //ha selecionado alguna solictud AQUI
					     var recsol = Ext.getCmp('grid_solicitud').getSelectionModel().getSelected();
					     if(!Ext.isEmpty(recsol))
					     {
					        Ext.Msg.show({
					          title:'Confirmacion',
					          msg: '¿Quiere diligenciar la lo solicitud '+recsol.get('sol_nombre')+'?',
					          buttons: Ext.Msg.YESNO,
					          fn: function (btn){
					            if(btn == 'yes')
					            {
					               Ext.Ajax.request({
                                url: '".URL_SASPA."direccion.php/solicitud/renderizarFormularios',
                                params : {
                                		sol_id : recsol.get('sol_id')
                                },
                                success: function(resp){
                                  var response = Ext.decode(resp.responseText);
                                  actualizarPanel('central',response.urlFormulario);
                                },
                                failure: function(){
                                  Ext.Msg.alert('Problema', 'Hubo un problema en la llamada a la funcion');
                                }
                              });
					            }
					            
					          },
					          icon: Ext.MessageBox.QUESTION
					        });
					        
					     }else{
					       Ext.Msg.alert('INFORM','Seleccione una solicitud para diligenciar');
					     }
				      }
				      				      
				    }),'-',' ',
				    {
				    	id      : 'idComentario',
				    	iconCls : 'comentarios',
				    	tooltip : 'Ver comentarios',
				    	handler : function(btn,evobj){
				    		
				    		var rec = Ext.getCmp('grid_solicitud').getSelectionModel().getSelected();
				    		if(!Ext.isEmpty(rec))
				    		{
				    			Saspa.comentario.gstcomentario('".URL_SASPA."analisis_dev.php/solicitud/ListarComentarios',rec.get('sol_id'));
				    		}else{
				    			Ext.Msg.alert('Mensaje','Selecione una solicitud');
				    		}
				    		//CONTINUAR AQUI
				    	}
				    },
				    '->',
              ],
              sm: new Ext.grid.RowSelectionModel({
	                singleSelect: true,
	                listeners: {
	                    rowselect: function(sm, row, rec) {
	                        manejoEdicionSolicitud(rec);
	                    }
	                }
	            }),
	           autoExpandColumn: 'id',
	           border: true,
	           title: 'Mis solicitudes'              
            }
          },
          {
            columnWidth: 0.4,
            xtype:'fieldset',
            title: 'Solicitud',
            bodyStyle: Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
            border: false,
            height: 450,
            items:[
              {
                xtype:  'textfield',
                id:     'tipoOperacion',
                labelSeparator: '',
                text:   'creacion',
                hidden: true
              },
              {
                xtype: 'hidden',
                id: 'sol_id',
                name: 'sol_id'
              },
              {
                xtype: 'textfield',
                fieldLabel: 'Facultad',
                disabled: true,
                value: '".$docfacultad."', 
                allowBlank: false,
                anchor:'100%',
                id: 'sol_facultad',
                name: 'sol_facultad'
              },
              {
                xtype: 'textfield',
                fieldLabel: 'Escuela',
                disabled: true,
                anchor:'100%',
                id: 'sol_escuela',
                value: '".$docescuela."',
                name: 'sol_escuela'
              },
              {
                xtype: 'textfield',
                fieldLabel: 'Estado',
                disabled: true,
                allowBlank: false,
                id: 'sol_estado',
                name: 'sol_estado'
              },{
                xtype: 'textfield',
                id: 'sol_nombre',
                fieldLabel: 'Nombre',
                allowBlank: false,
                disabled: true,
                name: 'sol_nombre'
              }
            ]
          }
        ],
        buttons:[ 
          {id:'btCrear', text:'Crear',
            handler: function(){
              var verificacion = verificarCampos();
              if( verificacion == 'almacenar' )
              {
                crudSolicitudes.getForm().submit({
                  method: 'POST',
                  waitTitle: 'Enviando',
                  params : {
                    sol_escuela  : Ext.getCmp('sol_escuela').getValue(),
                    sol_estado   : Ext.getCmp('sol_estado').getValue(),
                    sol_facultad : Ext.getCmp('sol_facultad').getValue()
                  },
                  waitMsg: 'Enviando datos...',
                  success: function(fm,act)
                  {

                    Ext.Msg.alert('INFORM', act.result.msg, function(btn, text){
                      if (btn == 'ok'){
                        crudSolicitudes.getForm().reset();
                        modificacion(false);
                        storeSolicitud.reload();
                      }
                    });

                  },
                  failured: function(form, action){
                    
                    if(action.failureType == 'server'){
                      obj = Ext.util.JSON.decode(action.response.responseText); 
                      Ext.Msg.alert('Error!', obj.errors.reason); 
                    }else
                    {
                      Ext.Msg.alert('Alerta!', 'No se obtuvo respuesta del servidor: ' + action.response.responseText);
                    }

                  }
                }); 
                
              } 
             
            }
          }
        ]
      });
      
      
      /*
      * Este funcion se encarga de restringir la edicion o diligenciado de una solicitud
      * si esta no se encuentra en uno de los estados en los que puede ser editable 
      * (Proceso o Pendiente) 
      */
      function manejoEdicionSolicitud(rec)
      {
        //-1 Si el estado de la solicitud es Proceso o Pendiente activar campos y opciones
        crudSolicitudes.getForm().loadRecord(rec);
        if(rec.data.sol_estado != 'Proceso' && rec.data.sol_estado != 'Pendiente')
        {
          Ext.getCmp('idDelete').disable();
          Ext.getCmp('idDiligenciar').disable();
          Ext.getCmp('sol_nombre').disable();
          //if(rec.data.sol_estado != 'Emitido'){
          //Ext.getCmp('sol_archivo').disable();
          //}
          
        }else if(rec.data.sol_estado == 'Pendiente'){
          Ext.getCmp('idDelete').disable();
          Ext.getCmp('idDiligenciar').enable();//se puede diligenciar para hacer las actualizaciones dictadas por los comentarios
          Ext.getCmp('sol_nombre').enable();
          //Ext.getCmp('sol_archivo').disable();
          
        }else{
          Ext.getCmp('idDelete').enable();
          Ext.getCmp('idDiligenciar').enable();
          Ext.getCmp('sol_nombre').enable();
          //Ext.getCmp('sol_archivo').disable();
        }
        
      }
      
      Saspa.Solicitudes = new Ext.Panel({
        renderTo: 'Solicitudes',
        layout:   'column',
        autoWidth: true,
        autoHeight: true,
        fitToFrame: true,
        items: [ {width: '100%', height: '100%', frame: true, autoScroll: true, items:[crudSolicitudes]} ]
      });
         
      Saspa.Solicitudes.render();
      
   ");
?>