Ext.namespace('Saspa.analisis');

//Constructor del record que se va  a cargar al formulario
Saspa.analisis.InformGnralRecord = Ext.data.Record.create([
    {name: 'numSolicitud'},
    {name: 'fecha',  type: 'date'},
    {name: 'solicitante' },
    {name: 'facultad' },
    {name: 'escuela' },
    {name: 'programa' },
    {name: 'titulo' },
    {name: 'motivo' },
    {name: 'sede' },
    {name: 'jornada' },
    {name: 'nivel' },
    {name: 'duracion' },
    {name: 'modalidad' },
    {name: 'formaPago' }    
]);


Saspa.analisis.inforGeneral = new Ext.form.FormPanel({
		title  : 'Informacion General',
		height : 300,
		autoWidth   : true,
		frame       : true,
		labelAlign  : 'top',
		defaults    : {
			//disabled : true
		},
		bodyStyle : 'padding:5px 5px 0',
		items  : [
			{
          	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel',
   	         defaults : {
   	         	disabled : true
   	         }
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
         }, //fin de la fila 1
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel',
   	         defaults : {
   	         	disabled : true
   	         }
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
         }, //fin de la fila 2 
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel',
   	         defaults : {
   	         	disabled : true
   	         }
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
         }, //fin de la fila 3 
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel',
   	         defaults : {
   	         	disabled : true
   	         }
      	   },
      	   items    : [
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Motivo',
            			name       : 'motivo'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Sede',
            			name       : 'sede'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '75%',
      	   			fieldLabel : 'Jornada',
            			name       : 'jornada'
      	   		}
      	   	}
      	   ]
         }, //fin de la fila 4 
         {
         	layout   : 'column',
          	defaults : {
	            layout  : 'form',
   	         xtype   : 'panel',
   	         defaults : {
   	         	disabled : true
   	         }
      	   },
      	   items    : [
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Nivel Académico',
            			name       : 'nivel'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '80%',
      	   			fieldLabel : 'Duración(Semestre)',
            			name       : 'duracion'
      	   		}
      	   	},
      	   	{
      	   		columnWidth : 0.33,
      	   		items       : {
      	   			xtype      : 'textfield',
      	   			anchor     : '75%',
      	   			fieldLabel : 'Modalidad',
            			name       : 'modalidad'
      	   		}
      	   	}
      	   ]
         }
		]
});


/**
* Funcion encargada de inicizalizar los campos del formulario, con la informacion
* de la solicitud. 
* 
* @param rec : Un rejistro con los datos de la informacion general de la solicitud, las campos del registro
  deben llamarse igual a los correspondientes campos del formulario. 
* @param comp: (Es un panel con dos campos o un grid) Puede ser un campo de texto, con el valor de la matricula,
  cuando la forma de pago es Valor Unico o un grid con el valor de la matricula por periodo, cuando la forma 
  de pago es Valor Diferenciado
*/
Saspa.analisis.initInformacionGeneral = function(array,comp)
{
	
	var rec = new Saspa.analisis.InformGnralRecord(array);
	
	//Aqui va el codigo para cargar la informacion al formulario
	Saspa.analisis.inforGeneral.getForm().loadRecord(rec);
	
	//var panel = new Ext.Panel(comp);
	Saspa.analisis.inforGeneral.add(comp);
	Saspa.analisis.inforGeneral.doLayout();
	
	//Ext.Msg.alert('initInformacionGeneral','Formulario inicializado');
}

