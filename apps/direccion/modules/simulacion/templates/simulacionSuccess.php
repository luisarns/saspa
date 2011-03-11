<?php
  echo  '<div id="Simulacion" style="width:915px;"></div>';
  
  
  //para no tener que recarga la pagina cada vez que cambie algo
  //actualizarPanel('central','http://192.168.3.120/saspa/web/direccion_dev.php/simulacion/simulacion');
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var periodos = '".$numeroPeriodos."';
    
    var rejistrosResultadosIngresos = Ext.decode('".$rejistroIngresos."');

    var rejistrosResultadosEgresos = Ext.decode('".$rejistroEgresos."');

    var rejistrosPuntoEquilibrio = Ext.decode('".$rejistroEquilibrio."');
    
    var camposIngreso = [];
    var camposEgreso = [];
    var colIngreso = [];
    var colEgreso = [];
    var camposEquilibrio = [];
    var colEquilibrio = []
    
    //aplicar funcion a los valores numericos para que tenga otro color tal como esta en el ejemplo
    //de extjs 
    
    camposEquilibrio.push({name: 'concepto'});
    camposIngreso.push({name: 'concepto'});
    camposEgreso.push({name: 'concepto'});
    colIngreso[0] = {id: 'idcolingreso', header : 'Concepto', dataIndex : 'concepto', width: 260 };
    colEgreso[0]  = {id: 'idcolegreso',  header : 'Concepto', dataIndex : 'concepto', width: 260 };
    colEquilibrio[0] = {id: 'idcolequilibrio',  header : 'Concepto', dataIndex : 'concepto', width: 260 };
    
    for(var i = 1; i <= periodos ; i++ )
    {
      camposEquilibrio.push({name:''+i, type: 'float'});
      camposIngreso.push({name:''+i, type: 'float'});
      camposEgreso.push({name:''+i, type: 'float'});
      colIngreso[i] = {header : 'Periodo'+i, dataIndex : ''+i, renderer: fmaPesos};
      colEgreso[i]  = {header : 'Periodo'+i, dataIndex : ''+i, renderer: fmaPesos};
      colEquilibrio[i] = {header : 'Periodo'+i, dataIndex : ''+i, renderer: fmaPesos};
    }
    //tener en cuenta la suma de los totales por periodo al final de cada una de las listas
    
    
    function fmaPesos(val)
    {
		if(val > 1000)
			return '<span style=\"color:green;\">' + Ext.util.Format.usMoney(val) + '</span>';
		
		if(val < 0)
			return '<span style=\"color:red;\">' + Ext.util.Format.usMoney(val) + '</span>';
			
		return val;
    }
    
    //defino los store para almacenar los resultados
    var storeIngreso = new Ext.data.SimpleStore({fields : camposIngreso});
    var storeEgreso  = new Ext.data.SimpleStore({fields : camposEgreso});
    var storeEquilibrio = new Ext.data.SimpleStore({fields : camposEquilibrio});
    
    
    //cargo los datos para que se muestren en la lista
    storeIngreso.loadData(rejistrosResultadosIngresos);
    storeEgreso.loadData(rejistrosResultadosEgresos);    
    storeEquilibrio.loadData(rejistrosPuntoEquilibrio);
    
    
    //remove( Ext.data.Record record ) y Ext.data.Record getAt( Number index ) : Ext.data.Record
    //storeIngreso.remove(storeIngreso.getAt(2));//elimino el registro con los ingresos por inscripcion
    
    
    //grid con los resultados para los Ingresos
    var gridIngresos = new Ext.grid.GridPanel({
      title   : 'Resultados Ingresos',
      store   : storeIngreso,
      columns : colIngreso,
      border     : true,
      height     : 250,
      stripeRows : true
    });
    
    
    //grid con los resultados para los Egresos 
    var gridEgresos = new Ext.grid.GridPanel({
      title   : 'Resultados Egresos',
      store   : storeEgreso,
      columns : colEgreso,
      border     : true,
      height     : 250,
      stripeRows : true
    });
    
    
    //grid con el punto de equilibrio
    var gridEquilibrio = new Ext.grid.GridPanel({
      title   : 'Punto de Equilibrio',
      store   : storeEquilibrio,
      columns : colEquilibrio,
      border     : true,
      height     : 250,
      stripeRows : true
    });
    
    
    var panelSimulacion = new Ext.TabPanel({
      title     : 'Panel de resultados',
      activeTab : 0,
      items     : [
        gridIngresos,
        gridEgresos,
        gridEquilibrio
      ]
    });
    

    /*
    * proceso para la simulacion de una solicitud,
    * 1. seleccionar una solicitud de la lista
    * 2. dar clic en simular
    * 3. el sistema envia el sol_id y el numero de periodos de la solicitud
    * 4. se procede a hacer los calculos para los ingresos y egresos a cada uno de los conceptos que tendra la tabla correspondiente.
    * 5. se configura la respuesta en un json para pasarsela a las tablas y que estas la muestren a usuario.
    */
    Saspa.Simulacion = new Ext.Panel({
        renderTo: 'Simulacion',
        layout:   'fit',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        frame: true,
        items: [panelSimulacion]
    });
         
    Saspa.Simulacion.render();
    
    
  ");
?>
