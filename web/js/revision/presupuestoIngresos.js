Ext.namespace('Saspa.analisis');


//primera linea en blanco 
Saspa.analisis.recPresIngreso = Ext.data.Record.create([
    {name: 'inscriptos'   },
    {name: 'matriculados' },
    {name: 'exenciones'   }
]);

Saspa.analisis.presIngresos = new Ext.form.FormPanel({
		title       : 'Prespuesto ingresos',
		height      : 300,
		autoWidth   : true,
		frame       : true,
		defaultType : 'textfield',
		defaults    : {
			disabled : true
		},
		bodyStyle   : 'padding:5px 5px 0',
		items       : [
			{
				id         : 'id_inscriptos',
            fieldLabel : 'Estudiantes inscritos',
            name       : 'inscriptos'
			},
			{
				id         : 'id_matriculados',
				fieldLabel : 'Estudiantes matriculados',
            name       : 'matriculados'
			},
			{
				id         : 'id_exenciones',
				fieldLabel : '(%)Exenciones',
            name       : 'exenciones'
			}
		]
});


Saspa.analisis.cargarIngresos = function(dta)
{
	Ext.getCmp('id_inscriptos').setValue(dta.inscriptos);
	Ext.getCmp('id_matriculados').setValue(dta.matriculados);
	Ext.getCmp('id_exenciones').setValue(dta.exenciones);
	//var reg = new Saspa.analisis.recPresIngreso(dta);
	//Ext.Msg.alert('Inscriptos',reg.data.inscriptos);
	//Saspa.analisis.presIngresos.getForm().loadRecord(reg);
	//Con esto se muestra la informacion de los campos
	//presIngresos.doLayout();
}



Saspa.analisis.cargarFuenteExternas = function(nperiodos,datos)
{
	//nperiodos contiene el numero de periodos 
	//datos contiene los datos de las fuentes esternas
	
	var columnas = []; 
   var campos   = [];
   
   campos.push({ name : 'nombre'}); 
   columnas[0] = {header : 'Nombre', dataIndex : 'nombre'};
   
   for(var i = 1; i <= nperiodos; i++)
   {
      campos.push({name : ''+i , type : 'float'});
      columnas[i] = {header : 'Periodo'+i, dataIndex : ''+i};
   }
   
   var store = new Ext.data.SimpleStore({
      fields : campos
   });
	
	store.loadData(datos);
	
	var gridConvenios = new Ext.grid.GridPanel({
		store      : store,
		columns    : columnas ,
		autoHeight : true,
		//height     : 100,
		title      : 'Fuentes externas (Convenios/Entidades) contribucion por periodo',
		border     : false,
		stripeRows : true
	});
	 
    
	if(nperiodos > 0)
	{
		Saspa.analisis.presIngresos.add(gridConvenios);
		Saspa.analisis.presIngresos.doLayout();
	}
	
}