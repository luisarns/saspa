Ext.namespace('Saspa.analisis');

Saspa.analisis.egresosGenerales = function(nprido,gtGnerales,gtInversion)
{
    
    //definicion de las variables
    var campos = [];
    var columnas = [];
    var camposInv = [];
    var columnasInv = [];
    
    
    
    
    campos.push({name: 'concepto'});
    camposInv.push({name: 'concepto'});
    
    columnas[0] = {id: 'colGeneral', header : 'Concepto', dataIndex : 'concepto', width: 260 };
    columnasInv[0] = {id: 'colInversion', header : 'Concepto', dataIndex : 'concepto', width: 200 };
    
    //no esta entrando al for
    /*
    * No esta entrando al for razones: 
    * 1. nprido <= i  
    * 2. no se estaba pasando el parametro correcto en gtGnerales
    */
    for(var i = 1; i <= nprido; i++)
    {
    	
      //campos.push({name:''+i, type: 'float'});
      //camposInv.push({name:''+i, type: 'float'});
      campos[i] = ({name:''+i, type: 'float'});
      camposInv[i] = ({name:''+i, type: 'float'});
      
      columnas[i]    = {header : 'Periodo'+i, dataIndex : ''+i};
      columnasInv[i] = {header : 'Periodo'+i, dataIndex : ''+i};
      
    }
    //Ext.Msg.alert('Fuera del for ');
    
    //Defino los store para cachear los datos del servidor
    var storeGeneral   = new Ext.data.SimpleStore({fields : campos});
    var storeInversion = new Ext.data.SimpleStore({fields : camposInv});
    
    
    storeGeneral.loadData(gtGnerales);
    storeInversion.loadData(gtInversion);
    
    
    var gridGastosGenerales = new Ext.grid.GridPanel({
      id         : 'General',
      store      : storeGeneral ,
      columns    : columnas,
      autoHeight : true,
      border     : false, 
      stripeRows : true
    });
    
    var gridGastoInversion = new Ext.grid.GridPanel({
      id         : 'Inversion',
      store      : storeInversion,
      columns    : columnasInv ,
      autoHeight : true,
      border     : false, 
      stripeRows : true
    });
    
    var formGastos = new Ext.form.FormPanel({ 
      title     : 'Presupuesto Egresos',
      autoWidth : true,
      frame     : true,
      bodyStyle : 'padding:5px',
      items : [
        {
          xtype : 'fieldset',
          title: 'Valor de los gastos generados por periodo academico',
          autoHeight:true,
          layout : 'fit',
          items  : gridGastosGenerales
        },
        {
          xtype : 'fieldset',
          title: 'Valor de inversion por periodo academico',
          autoHeight:true,
          layout : 'fit',
          items  : gridGastoInversion
        }
      ]   
    });  
   
	return formGastos;
}