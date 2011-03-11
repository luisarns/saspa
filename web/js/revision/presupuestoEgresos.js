Ext.namespace('Saspa.analisis');

Saspa.analisis.presEgresos = new Ext.form.FormPanel({
		title       : 'Prespuesto Egresos',
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
				id            : 'tfcordprograma',
            fieldLabel    : 'Coordinacion'
			},
			{
				id            : 'tfsecretaria',
            fieldLabel    : 'Secretaria'
			},
			{
				id            : 'tfauxadministrativos',
            fieldLabel    : 'Auxiliares administrativos'
			},
			{
				id            : 'tfmonitorias',
            fieldLabel    : 'Monitorias'
			},
			{
				id            : 'smdireccion',
            fieldLabel    : 'Sueldo direccion'
			},
			{ 
				id            : 'smcoordinacion',
            fieldLabel    : 'Sueldo coordinacion'
			},
			{
				id            : 'smotronombre',
            fieldLabel    : 'Otro nombre'
			},
			{
				id            : 'smotrovalor',
            fieldLabel    : 'Otro sueldo'
			}
		]
});


Saspa.analisis.cargarEgresos = function(dta)
{
	Ext.getCmp('tfcordprograma').setValue(dta.tfcordprograma);
	Ext.getCmp('tfsecretaria').setValue(dta.tfsecretaria);
	Ext.getCmp('tfauxadministrativos').setValue(dta.tfauxadministrativos);
	Ext.getCmp('tfmonitorias').setValue(dta.tfmonitorias);
	Ext.getCmp('smdireccion').setValue(dta.smdireccion);
	Ext.getCmp('smcoordinacion').setValue(dta.smcoordinacion);
	Ext.getCmp('smotronombre').setValue(dta.smotronombre);
	Ext.getCmp('smotrovalor').setValue(dta.smotrovalor);
	
}


/*
Saspa.analisis.cargarBecas = function(nperiodos,datos)
{
	//nperiodos contiene el numero de periodos 
	//datos contiene los datos de las becas
	var columnas = []; 
   var campos   = [];
   
   campos.push({ name : 'concepto'});
   columnas[0] = {header : 'Concepto', dataIndex : 'concepto'};
	for(var i = 1; i <= nperiodos; i++)
   {
      campos.push({name : ''+i , type : 'int'});
      columnas[i] = {header : 'Periodo'+i, dataIndex : ''+i};
   }
   
   var store = new Ext.data.SimpleStore({
      fields : campos
   });
	
	store.loadData(datos);
	
	var gridBecas = new Ext.grid.GridPanel({
		store      : store,
		columns    : columnas ,
		autoHeight : true,
		//height     : 100,
		title      : 'Becas (Asistente de Docencia / Investigacion)',
		border     : false,
		stripeRows : true
	});
	
	if(nperiodos > 0)
	{
		Saspa.analisis.presEgresos.add(gridBecas);
		Saspa.analisis.presEgresos.doLayout();
	}
	
}
*/