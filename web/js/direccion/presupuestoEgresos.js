var formPresupuestoEgresos = new Ext.FormPanel({
        labelWidth: 75, // label settings here cascade unless overridden
        frame:true,
        title: 'Presupuesto Egresos',
        bodyStyle:'padding:5px 5px 0',
        width: 350,
        items: [{
            xtype :'fieldset',
            checkboxToggle :true,
            title : 'Cargo  (sueldo mensual)',
            autoHeight :true,
            defaults : {width: 210,allowNegative: false},
            defaultType : 'numberfield',
            collapsed : true,
            items :[{
                    fieldLabel : 'Direccion',
                    name : 'saldireccion',
                    allowBlank :false
                },{
                    fieldLabel : 'Coordinacion',
                    name : 'salcoordinacion'
                },{
                	  xtype : 'fieldset',
                	  checkboxToggle : true,
                	  checkboxName   : 'Otro',
                	  hideBorders    : true,
                	  autoHeight     : true,
                	  items 			  : [
                	  		{
                	  			xtype      : 'textfield',
                	  			fieldLabel : 'Nombre',
                	  			anchor     : '50%',
                	  			name       : 'otro_nombre'
                	  		},
                	  		{
                	  			xtype      : 'numberfield',
                	  			fieldLabel : 'Sueldo',
                	  			anchor     : '45%',
                	  			name       : 'otro_sueldo'
                	  		}
                	  ]
                }
            ]
        },{
            xtype:'fieldset',
            title: 'Cargo (horas totales por semestre)',
            //collapsible: true,
            autoHeight:true,
            defaults: {width: 210,allowNegative: false},
            defaultType: 'numberfield',
            items :[{
                    fieldLabel: 'Coordinacion programa',
                    name: 'hracoordprograma'
                },{
                    fieldLabel: 'Secretaria',
                    name: 'hrasecretaria'
                },{
                    fieldLabel: 'Auxiliares administrativos',
                    name: 'hraauxadmin'
                },{
                    fieldLabel: 'Monitorias',
                    name: 'hramonitoria'
                }
            ]
        }],

        buttons: [{
            text: 'Salir'
        },{
            text: 'Siguiente'
        }]
    });

	//Para las pruebas iniciales de la interfaz desplegar el formulario en una ventana (window de extjs)
   //formPresupuestoEgresos.render(document.body);
   