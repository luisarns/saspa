
var panelPrueba = new Ext.form.FormPanel({
		title  : 'Informacion General',
		height : 300,
		autoWidth   : true,
		frame       : true,
		//disabled    : true, //Para evitar modificaciones mientras se analiza la solicitud
		labelAlign  : 'top',
		bodyStyle : 'padding:5px 5px 0', //Propiedad del ejemplo de Ext
		items  : [
			{
          	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel'
      	   },
      	   items : [
      	   	{
      	   		columnWidth : 0.4,
      	   		items : {
      	   			xtype      : 'textfield',
            			fieldLabel : 'Solicitante',
            			name       : 'solicitante'
         			}
      	   	},
      	   	{
      	   		columnWidth : 0.25,
			      	items : {
			      		xtype      : 'textfield',
         				fieldLabel : 'Solicitud #',
          				name       : 'numSolicitud'
   	  				}
      	   	},
      	   	{
      	   		columnWidth : 0.25,
			      	items : {
			      		xtype      : 'textfield',
         				fieldLabel : 'Fecha',
   	  	   			name       : 'fecha'
   	  				}
      	   	}
      	   ]
         },
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel'
      	   },
      	   items    : [
      	   	{
      	   		columnWidth : 0.5,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Facultad',
            			name       : 'facultad'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.5,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Escuela',
            			name       : 'escuela'
      	   		}
      	   	}
      	   ]
         },
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel'
      	   },
      	   items    : [
      	   	{
      	   		columnWidth : 0.5,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Programa',
            			name       : 'programa'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.5,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Titulo',
            			name       : 'titulo'
      	   		}
      	   	}
      	   ]
         }
			
			/*
			{
           	fieldLabel: 'Fecha',
   	  	   name: 'fecha'
		   },{
         	fieldLabel: 'Solicitud #',
          	name: 'numSolicitud'
   	  	},{
            fieldLabel: 'Solicitante',
            name: 'solicitante'
         },{
            fieldLabel: 'Facultad',
            name: 'facultad'
         },{
            fieldLabel: 'Escuela',
            name: 'escuela'
         },{
            fieldLabel: 'Programa',
            name: 'programa'
         },{
            fieldLabel: 'Titulo',
            name: 'titulo'
         },{
            fieldLabel: 'Motivo',
            name: 'motivo'
         },{
            fieldLabel: 'Sede',
            name: 'sede'
         },{
            fieldLabel: 'Nivel academico',
            name: 'nivacademico'
         },{
            fieldLabel: 'Duracion (semestres)',
            name: 'duracion'
         },{
            fieldLabel: 'Jornada',
            name: 'jornada'
         },{
            fieldLabel: 'Modalidad',
            name: 'modalidad'
         }*/
         
		]
});
