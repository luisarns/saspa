<?php 
	echo '<div id="gestDesercion"></div>';
//	echo use_helper('Javascript');
	echo javascript_include_tag('administracion/intfDesercion.js');
/*
   echo javascript_tag("

      var decStore = new Ext.data.JsonStore({
        url: '".URL_SASPA."administracion.php/parametros/listarDecersion',
        root: 'datos',
        fields:[
          {name : 'decId' },
          {name : 'sede'},
          {name : 'facultad'},
          {name : 'tipoPrograma'},
          {name : 'periodo', type : 'int'}
        ]
      });
      
      //cargo los datos desde el servidor
      decStore.load();
      
      var decColModel = new Ext.grid.ColumnModel([
			{ header : \"#Periodo\", width : 60, sortable : true, dataIndex : 'periodo' },
			{ header : \"Sede\", width : 80, sortable : true, dataIndex : 'sede' },
			{ header : \"Facultad\", width : 80, sortable : true, dataIndex : 'facultad' },
			{ header : \"Tipo Programa\", width : 100, sortable : true, dataIndex : 'tipo_programa' }
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
			store : decStore,
			colModel : decColModel,
			sm : decSm,
			height : 240,
			frame  : true,
			autoScroll : true,
			title  : 'Lista de decersion'
		});
		
		
		//creo el formulario para la decersion
		var decForm = new Ext.form.FormPanel({
			labelWidth: 75,// label settings here cascade unless overridden
			title : 'Formulario Decersion',
			frame : true,
			bodyStyle:'padding:5px 5px 0',
			width: 380,
			height : 240, //esta medida es temporal mientras se agregan todos los controles al formulario
			defaults: {width: 180},
			defaultType: 'textfield',
		      	items : [
      				{
					fieldLabel : 'Sede',
					name : 'sede',
					allowBlank : false
				},
				{
			            	fieldLabel : 'Facultad',
					name : 'facultad',
					allowBlank : false
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
					xtype : 'hidden',
					name : 'decId'
				}
      	],
      	buttonAlign : 'center',
      	buttons : [
      		{ text : 'Guardar'}
      	]
		});

      Saspa.Parametros = new Ext.Panel({
        renderTo: 'gestDesercion',
        layout:   'column',
        width : '80%',
        autoHeight : true,
        autoScroll : true,  
        title  : 'CRUD decersion',
        frame : true,
        items:	[ 
			{ columnWidth : 0.4, items : [decGrid] },
        		{ columnWidth : 0.4, items : [decForm] }
		]
	});
         
      Saspa.Parametros.render();
      
      ");
*/
?>
