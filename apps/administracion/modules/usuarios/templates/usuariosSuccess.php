<?php
    echo  '<div id="administracionUsuarios" style="width:915px;"></div>';
	 
    $c = new Criteria();
    $c->addAscendingOrderByColumn(RolPeer::ROL_NOMBRE);
    $datosObtenidos = RolPeer::doSelect($c);

    $pos = 0;
    $datos;

    foreach($datosObtenidos as $fila)
    {
		$datos[$pos][] = $fila->getRolIdentificador();
		$datos[$pos][] = $fila->getRolNombre();
		$pos++;
    }
    
    echo javascript_include_tag('md5.js');
    echo javascript_include_tag('administracion/usuarios.js'); 
    echo use_helper('Javascript');
    echo javascript_tag("

      var datosRol = '' ;
      datosRol = Ext.util.JSON.decode('".json_encode($datos)."');

      var arregloParametrosSelctRol;
      var usuariosHabilitados = true;
      var url_foto = 'usuario.jpg';
      verificacion = '';

     var store = new Ext.data.SimpleStore({
	  		fields: [
	    		{name: 'idrol'},
	    		{name: 'nombre'}
	  		]
      });
      
      store.loadData(datosRol);
      
     var selectorRol = new Ext.form.ComboBox({
	    id: 'usu_rol',
	    name: 'idrol',
	    store: store,
	    fieldLabel: 'Rol',
	    valueField: 'idrol',
	    displayField: 'nombre',
	    hiddenName: 'idrol',
	    width: '140',
	    style: 'width: 140px;',
	    typeAhead: true,
	    editable: false,
	    forceSelection: true,
	    mode: 'local',
	    triggerAction: 'all',
	    emptyText:'Seleccione el rol',
	    selectOnFocus:true,
	    allowBlank:false,
	    disabled: true,
	    blankText: 'El rol es obligatorio',
	    resizable: true,
	    width: 170
      });
      
      var datosUsuario = new Ext.data.JsonStore({
        url: '".URL_SASPA."administracion.php/usuarios/lista',
        root: 'datos',
        totalProperty: 'total',
        fields:[
          {name:'identificador'},
          {name:'nombres'},
          {name:'apellidos'},
          {name:'estado'},
          {name:'rolnombre'},
          {name: 'rolid'},
          {name:'contrasena'},
          {name:'recontrasena'}
        ]
      });
      
      datosUsuario.load({params: {estado: '01' }});
      
      var colModel = new Ext.grid.ColumnModel([
        new Ext.grid.RowNumberer(),
        {id:'hNombres',      resizable:true,    header: '"."Nombres"."',    sortable: true, dataIndex: 'nombres'},
        {id:'hApellidos',    resizable:true,    header: '"."Apellidos"."',  sortable: true, dataIndex: 'apellidos'},
        {id:'hrol',          resizable:true,    header: '"."Rol"."',        sortable: true, dataIndex: 'rolnombre'}
      ]);


     var listaUsuarios = new Ext.grid.GridPanel({
        style:  'width:100%;height:100%;',
        id:     'listaUsuarios',
        title:  'Listado',
        frame: true,
        autoScroll: true,
        plugins:[new Ext.ux.grid.Search({          
            mode:          'local',
            position:      top,
            searchText:    'Filtrar',
            selectAllText: 'Seleccionar todos',
            searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
            width:         150
        })],
        tbar: [
            new Ext.Button({
				iconCls: 'usu-nuevo',
				tooltip: 'Crear un nuevo usuario',
				handler: function()
				{
					 listaUsuarios.getSelectionModel().clearSelections();
					 mostrarFormCrearUsu();
					 formularioDatosPersonales.enable();
					 myMask = new Ext.LoadMask(formularioDatosPersonales.getEl(), {msg:'Cargando...',removeMask: true});
					 myMask.show();
					 setTimeout('myMask.hide()',500);
				}
			}),
			'-',
			new Ext.Button({
				iconCls: 'usu-hab',
				tooltip: 'Listar los usuarios activos',
				handler: function()
				{
				  usuariosHabilitados = true;
				  formularioDatosPersonales.getForm().reset();
				  reiniciarCampos('todos');
				  datosUsuario.removeAll();
				  datosUsuario.load({params: {estado: '01' }});
				  mostrarFormCrearUsu();
				  listaUsuarios.getSelectionModel().clearSelections();
				}
			}),
			'-',
			new Ext.Button({
				iconCls: 'usu-deshab',
				tooltip: 'Listar los usuarios deshabilitados',
				handler: function()
				{
				  usuariosHabilitados = false;
				  formularioDatosPersonales.getForm().reset();
				  reiniciarCampos('todos');
				  datosUsuario.removeAll();
				  datosUsuario.load({params: {estado: '02' }});
				  mostrarFormCrearUsu();
				  listaUsuarios.getSelectionModel().clearSelections();
				}
			}),
          '->',
        ],
        ds: datosUsuario,
        cm: colModel,
        sm: new Ext.grid.RowSelectionModel({
		    id: 'sm_usuarios',
          singleSelect: true,
          listeners: 
          {
			   rowselect: function(sm, row, rec) {                  
              if(rec.get('estado')=='01'){
                 Ext.getCmp('usu_habilitado').setValue(true);
                 Ext.getCmp('usu_deshabilitado').setValue(false);
                 usuariosHabilitados = true;
                 
                }else if(rec.get('estado')=='02'){
                  Ext.getCmp('usu_habilitado').setValue(false);
                  Ext.getCmp('usu_deshabilitado').setValue(true);
                  usuariosHabilitados = false;
                }
                
                selectorRol.setValue(rec.get('rolid'));
                
                formularioDatosPersonales.getForm().loadRecord(rec);
                formularioDatosPersonales.enable();
                formularioDatosPersonales.setTitle('Modificar usuario');
                   
                myMask = new Ext.LoadMask(formularioDatosPersonales.getEl(), {msg:'Cargando...',removeMask: true});
                myMask.show();
                setTimeout('myMask.hide()',500);
                modificacion(true);
              }
            }
        }),
        autoHeight: true,
        autoWidth: true,
        afterRender: function(g) {
            var a = 1+1;
        },
        listeners: {
          render: function(g) {
             g.getSelectionModel().selectRow(0);
             datosUsuario.filter('estado','01');
          }
        }
      });
      
      
      //Formulario para la creacion actualizacion y eliminacion de los usuarios
      var formularioDatosPersonales = new Ext.FormPanel({
        url: '".URL_SASPA."administracion.php/usuarios/Almacenar',
        title: 'Información del usuario',
        autoHeight : true,
	autoWidth  : true,
	//height: 450,//540
        //width:  545,
        frame: true,
        border: true,
        layout: 'fit',
        items:[
          {
                xtype:  'textfield',
                id:     'tipoOperacion',
                text:   'creacion',
                hidden: true
          },{
          xtype: 'fieldset',
          autoHeight: 'true',
          title:'Información de contacto',
          labelWidth: 100,
          style:'padding:10px',
          items:[{
            xtype:  'panel',
            id:     'label_1',
            height: 40,
            hidden: false,//era true muestra un mensaje en el formulario
            items:[
              {
              		xtype: 'label',
                  html:  'Si no escribe una contraseña nueva se mantendrá la contraseña actual.<br />',
                  style: 'font-size:8.5pt; color:#484848;',
              }
            ]
          },
          selectorRol, //aqui van los campos para el ingreso de los datos del usuario
          {
            xtype:'numberfield',
            fieldLabel: 'Documento',
            allowDecimals: false,
            name: 'identificador',
            id: 'usu_identificador',
            allowBlank:false,
            disabled: true,
            blankText: 'El número de identificación es obligatorio', 
            width: 170
          },
          {
            xtype:'textfield',
            fieldLabel: 'Nombres',
            name: 'nombres',
            id: 'usu_nombres',
            allowBlank:false,
            disabled: true,
            blankText: 'El nombre es obligatorio',
            maskRe:     /^[a-zA-Z ]$/, 
            width: 170
          },
          {
            xtype:'textfield',
            fieldLabel: 'Apellidos',
            name: 'apellidos',
            id: 'usu_apellidos',
            allowBlank:false,
            disabled: true,
            blankText: 'Los apellidos son obligatorios', 
            maskRe:     /^[a-zA-Z ]$/,
            width: 170
          },
          {
            xtype:'textfield',
            fieldLabel: 'Contraseña',
            name: 'contrasena',
            inputType: 'password',
            id: 'usu_contrasena',
            //allowBlank:false,
            blankText: 'La contraseña es obligatoria',
            maskRe:     /^[a-zA-Z0-9]$/,
            disabled: true,
            width: 170
          },
          {
            xtype:      'textfield',
            fieldLabel: 'Re-Contraseña',
            name:       'recontrasena',
            inputType:  'password',
            id:         'usu_recontrasena',
            labelStyle: 'font-size:8.5pt;',
            disabled: true,
            blankText: 'La confirmación de la contraseña es obligatoria',
            maskRe:     /^[a-zA-Z0-9]$/,
            width: 170
          },{
            xtype:      'radiogroup',
            disabled: true,
            fieldLabel: 'Estado',
            columns : [.25,.25],
            items:
            [
            	{
                  boxLabel:   'Habilitado',
                  name:       'estado',
                  id:         'usu_habilitado',
                  inputValue: '01',
                  checked:    true
               },
               {
					   boxLabel:   'Deshabilitado',
                  name:       'estado',
                  id:         'usu_deshabilitado',
                  inputValue: '02'
               }
            ]
          }]
        }
        ],
        buttons:[{id:'btGuardar', text:'Guardar',
          handler: function(){
            //en esta funcion se maneja las peticiones que puede manejar el formulario
            var verificacion = verificarCampos();
            if(verificacion == 'almacenar')
            {
               Ext.getCmp('usu_contrasena').setDisabled(true);
               Ext.getCmp('usu_recontrasena').setDisabled(true);
               var contrasenaEncrypt = '';
               if(Ext.getCmp('usu_contrasena').getValue() != ''){
                  contrasenaEncrypt = hex_md5(Ext.getCmp('usu_contrasena').getValue());
               }
               
               reiniciarCampos('modificables');
               var estado = '01';
               if(!Ext.getCmp('usu_habilitado').checked){
                 estado = '02';  
               }
               
               //envio la peticion al servidor para el cambio de los usuarios
               formularioDatosPersonales.getForm().submit({
                 method: 'POST',
                 params: {
                    identificador: Ext.getCmp('usu_identificador').getValue(),
                    contrasena: contrasenaEncrypt
                  },
                  waitTitle: 'Enviando',
                  waitMsg: 'Enviando datos...',
                  success: function()
                  {
                    Ext.Msg.alert('Estado', '!Almacenado exitosamente', function(btn, text){
                      if (btn == 'ok'){
						      usuariosHabilitados = true;  
                        modificacion(false);
                        datosUsuario.removeAll();
                        datosUsuario.load({params: {estado: '01' }});
                        
                        if(usuariosHabilitados){
                          datosUsuario.filter('estado','01');
                        }
                        else{
                          datosUsuario.filter('estado','02');
                        }
                        formularioDatosPersonales.getForm().reset();
                        Ext.getCmp('usu_contrasena').setDisabled(false);
                        Ext.getCmp('usu_recontrasena').setDisabled(false);
                        Ext.getCmp('tipoOperacion').setValue('creacion');
                      }//end if
                    });//end function and end Msg.alert
                  },//end success
                  failured: function(form, action){
                    
                    if(action.failureType == 'server'){
                      obj = Ext.util.JSON.decode(action.response.responseText); 
                      Ext.Msg.alert('Error al guardar la información!', obj.errors.reason); 
                    }else
                    {
                      Ext.Msg.alert('Alerta!', 'No se obtuvo respuesta del servidor: ' + action.response.responseText);
                    }
                    Ext.getCmp('usu_contrasena').setDisabled(false);
                    Ext.getCmp('usu_recontrasena').setDisabled(false);
                    
                  }//end failured
                  
               });//end submit
               
               
            }//end if almacenar
          }
        }]
      });


      Saspa.Usuarios = new Ext.Panel({
        renderTo: 'administracionUsuarios',
        layout:   'column',
	autoHeight : true,
        autoWidth  : true,
	autoScroll : true,
	frame    : true,
        items: [ {width: 356, height: 570, frame: true, autoScroll: true, items:[listaUsuarios]}, { height: 570, frame: true, autoScroll: true, items:[formularioDatosPersonales]} ]
      });
         
      Saspa.Usuarios.render();
      
      ");
?>
