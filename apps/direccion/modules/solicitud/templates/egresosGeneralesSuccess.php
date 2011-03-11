<?php 
  echo '<div id="egresosGenerales" style="width:900px;"></div>';

  //obtengo el numero de periodos del programa academico
  $c1 = new Criteria();
  $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
  $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1); 
  $numeroPeriodos = $informacionGeneral->getIngDuracionPrograma();
  
  //arreglos en los que iran los rejistros configurados del los gastos generales y por inversion
  $datosGastosInversiones = array();
  $datosGastosGenerales   = array();
    
  //obtengo todos los concepto gastos asociados a la solicitud sol_id
  $c = new Criteria();
  $c->add(ConceptoGastosPeer::COG_SOL_ID, $sol_id);
  $conceptosGastos = ConceptoGastosPeer::doSelect($c);
  
  
  foreach($conceptosGastos as $conceptoGasto)
  {
    //obtengo los gastos por periodos asociados al concepto
    $c = new Criteria();
    $c->add(GastosGeneralesPeer::IGG_COG_ID, $conceptoGasto->getCogId());
    $gastosPeriodos = GastosGeneralesPeer::doSelect($c);
    
    //obtengo el tipo del concepto para determinar cual de los dos arreglos poner el nuevo rejistro
    $tipoConcepto = $conceptoGasto->getCogTipo();
    
    $newRejistro[0] = $conceptoGasto->getCogConcepto();//almaceno el nombre del concepto 
    foreach($gastosPeriodos as $gastoPeriodo)
    {
      //almaceno el valor en la posicion del arreglo correspondiente al periodo del gasto
      $p = $gastoPeriodo->getIggPeriodo();
      $v = $gastoPeriodo->getIggCosto();
      $newRejistro[$p] = $v;
    }    
    //guardo el id del concepto para saber que ya esta definido y cualquier cambio seria una actualizacion
    $newRejistro[$numeroPeriodos+1] = $conceptoGasto->getCogId(); 
    
    if($tipoConcepto == 'General')
    {
      array_push($datosGastosGenerales, $newRejistro);
    }
    else if($tipoConcepto == 'Inversion')
    {
      array_push($datosGastosInversiones, $newRejistro);
    }
    
  }
  
  //codifico en json los arreglos para enviarlos a la interfaz cliente
  $rejistrosGastosInversiones = json_encode($datosGastosInversiones);
  $rejistrosGastosGenerales   = json_encode($datosGastosGenerales);
  
  //direccion para las pruebas
  //actualizarPanel('central','http://192.168.3.120/saspa/web/direccion_dev.php/solicitud/egresosGenerales')
  
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var periodos;
    var rejistrosGastosInversiones;
    var rejistrosGastosGenerales;
    
    periodos = '".$numeroPeriodos."';
    rejistrosGastosInversiones = Ext.decode('".$rejistrosGastosInversiones."');
    rejistrosGastosGenerales   = Ext.decode('".$rejistrosGastosGenerales."');
    
    
    //defino los nombres con los que se identificara cada elemento del arreglo dada su posicion
    var campos = [];
    var columnas = [];
    var camposInv = [];
    var columnasInv = [];
    
    
    campos.push({name: 'concepto'});
    camposInv.push({name: 'concepto'});
    columnas[0] = {id: 'colGeneral', header : 'Concepto', dataIndex : 'concepto', editor : new Ext.form.TextField({allowBlank : false }), width: 260 };
    columnasInv[0] = {id: 'colInversion', header : 'Concepto', dataIndex : 'concepto', editor : new Ext.form.TextField({allowBlank : false }), width: 200 };
    for(var i = 1; i <= periodos; i++)
    {
      campos.push({name:''+i, type: 'float'});
      camposInv.push({name:''+i, type: 'float'});
      columnas[i] = {header : 'Periodo'+i, editor : new Ext.form.NumberField({
      allowBlank    : false,
      allowDecimals : true,
      allowNegative : false}), dataIndex : ''+i};
      columnasInv[i] = {header : 'Periodo'+i, editor : new Ext.form.NumberField({
      allowBlank    : false,
      allowDecimals : true,
      allowNegative : false}), dataIndex : ''+i};
    }
    campos.push({name:'cog_id'}); //aqui se toma el identificador del concepto
    camposInv.push({name:'cog_id'});
   
      
    //defino 2 store por la necesita de cargar los dos arreglos el general e inversion
    var storeGeneral   = new Ext.data.SimpleStore({fields : campos});
    var storeInversion = new Ext.data.SimpleStore({fields : camposInv});
    
    
    storeGeneral.loadData(rejistrosGastosGenerales);
    storeInversion.loadData(rejistrosGastosInversiones);
    
    
    //apartir de aqui la definicion de la interfaz y de la interaccion con el usuario
    
    
    //grid con los Gastos Generales
    var gridGastosGenerales = new Ext.grid.EditorGridPanel({
      id         : 'General',
      store      : storeGeneral ,
      columns    : columnas ,
      sm         : new Ext.grid.RowSelectionModel({singleSelect :true}),
      height     : 250,
      tbar       : [
        {text : 'Guardar cambios'  , handler : guardar , grid : 'General', iconCls: 'x-btn-text-ico', icon: '../images/table_save.png' },
        {text : 'Agregar', handler : agregar, grid : 'General', iconCls: 'x-btn-text-ico', icon: '../images/table_row_insert.png'  },
        {text : 'Descartar cambios', handler : cancelar, grid : 'General', iconCls: 'x-btn-text-ico', icon: '../images/arrow_rotate_anticlockwise.png' },
        {text : 'Eliminar registro', handler : eliminar, grid : 'General', iconCls: 'x-btn-text-ico', icon: '../images/table_row_delete.png' }
      ],
      clicksToEdit: 1,
      border     : false, 
      stripeRows : true
    });
    
    
    //grid con los Gastos de las Inversiones
    var gridGastoInversion = new Ext.grid.EditorGridPanel({
      id         : 'Inversion',
      store      : storeInversion,
      columns    : columnasInv ,
      sm         : new Ext.grid.RowSelectionModel({singleSelect :true}),
      height     : 250,
      tbar       : [
        {text : 'Guardar cambios', handler : guardar, grid : 'Inversion', iconCls: 'x-btn-text-ico', icon: '../images/table_save.png' },
        {text : 'Agregar', handler : agregar, grid : 'Inversion', iconCls: 'x-btn-text-ico', icon: '../images/table_row_insert.png'  },
        {text : 'Descartar cambios', handler : cancelar,  grid : 'Inversion', iconCls: 'x-btn-text-ico', icon: '../images/arrow_rotate_anticlockwise.png' },
        {text : 'Eliminar registro', handler : eliminar, grid : 'Inversion', iconCls: 'x-btn-text-ico', icon: '../images/table_row_delete.png' }
      ],
      clicksToEdit: 1,
      border     : false, 
      stripeRows : true
    });
    
    
    var formGastos = new Ext.form.FormPanel({//formulario principal 
      title     : 'Presupuesto Egresos',
      url       : '".URL_SASPA."direccion_dev.php/solicitud/egresosGenerale',
      autoWidth : true, //width : 800
      frame     : true,
      bodyStyle : 'padding:5px',
      items : [
        {
          //fieldset 1
          xtype : 'fieldset',
          title: 'Valor de los gastos generados por periodo academico',
          autoHeight:true,
          layout : 'fit',
          items  : gridGastosGenerales
        },
        {
          //fieldset 2
          xtype : 'fieldset',
          title: 'Valor de inversion por periodo academico',
          autoHeight:true,
          layout : 'fit',
          items  : gridGastoInversion
        }
      ],
      buttonAlign : 'center',
      buttons     : [
        { text : 'Salir'},
        { text : 'Enviar', handler : enviar}    
      ]
    });  


   //GUARDAR
   function guardar(bt,e){
     
     var grilla = (bt.grid == 'Inversion')? gridGastoInversion : gridGastosGenerales;
     var store  = grilla.getStore();
     var modified  = store.getModifiedRecords();
     
     
     if(!Ext.isEmpty(modified)){
       var recordsToSend = [];
       
       Ext.each(modified, function(record) {
         recordsToSend.push(record.data);
       });
     
       grilla.el.mask('Guardando...', 'x-mask-loading');  
       grilla.stopEditing();
     
       recordsToSend = Ext.encode(recordsToSend);
     
       Ext.Ajax.request({   
         url : '".URL_SASPA."direccion_dev.php/solicitud/egresosGenerales',   
         params :{
           records   : recordsToSend,
           periodos  : periodos,
           tipoGasto : bt.grid
         },  
         success : function(response) {  
           grilla.el.unmask();
           store.commitChanges();
         
           var info = Ext.decode(response.responseText); 
           Ext.each(info.data,function(obj){
	          var record = store.getById(obj.oldId);
	          record.set('cog_id', obj.id);
             delete record.data.newRecordId;
           }); 
           Ext.Msg.alert('INFORM','Cambios realizados');
         }  
       });
     }
   }
    
   
   //AGREGAR
   function agregar(bt,e)
   {
     var grilla = (bt.grid == 'Inversion')? gridGastoInversion : gridGastosGenerales;
     var store  = grilla.getStore();
     
     var posicion = store.getCount();//la posicion donde ira el nuevo rejistro
     var id = Ext.id();
     var defaultData = {
        newRecordId  : id
     };
     
     var Rejistro = store.recordType;
     var rejistro = new Rejistro(defaultData,id);
     grilla.stopEditing();
     store.insert(posicion, rejistro);
     grilla.startEditing(posicion, 0);
   }
   
   //CANCELAR
   function cancelar(bt,e)
   {
       var grilla = (bt.grid == 'Inversion')? gridGastoInversion : gridGastosGenerales;
       grilla.getStore().rejectChanges(); 
   }
   
   //ELIMINAR 
   function eliminar(bt,e)
   {
     var grilla = (bt.grid == 'Inversion')? gridGastoInversion : gridGastosGenerales;
     var store  = grilla.getStore();
     
     var record = grilla.getSelectionModel().getSelected();
     if(!Ext.isEmpty(record)) 
      {
        if(Ext.isEmpty(record.data.newRecordId))
        {
          Ext.Msg.show({ 
            title   : 'Confirmacion',
            msg     : '¿Desea eliminar el registro selecionado?',
            buttons : Ext.Msg.YESNO,
            fn      : function (btn){
              if(btn == 'yes')
              {
                Ext.Ajax.request({   
                url     : '".URL_SASPA."direccion_dev.php/solicitud/egresosGenerales',  
                params  :{id : record.data.cog_id },  
                success : function(response) {  
                    Ext.Msg.alert('INFORM','El registro fue eliminado');
                    store.remove(record);
                },
                failure : function(response){
                  Ext.Msg.alert('INFORM','No se elimino el registro');
                } 
                });
              }
           },
           icon     : Ext.MessageBox.QUESTION
           });
           
        }else{ 
          store.remove(record);
        }
      }else{
        Ext.Msg.alert('INFORM','Selecione un registro y clic en eliminar');
      }
      
   }
   
   
   
   function gastosPorDefecto(grid)
   {
     var store = grid.getStore();
     var id    = grid.getId();
     var codId = Ext.id();
     
     if(store.getCount() == 0)
     {
       var Rejistro = store.recordType;
       if(id == 'Inversion')
       {
         store.addSorted(new Rejistro({concepto : 'Adecuacion y ampliacion de aulas', cog_id : '' , newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Adecuacion y ampliacion de laboratorios', cog_id : '' ,newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Dotacion de aulas con  ayudas didacticas', cog_id : '' ,newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Dotacion de laboratorios', cog_id : '' ,newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Recursos informaticos:  software, hardware, etc', cog_id : '' ,newRecordId: codId},codId));
         
       }else{
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Productos y reactivos quimicos,  combustibles y lubricantes', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Alimentos viveres y refrigerios', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Utiles de oficina y suministros  varios', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Promocion y publicidad', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Arrendamientos', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Pasajes y viaticos (Acorde con la Resolucion No. 1.314 de  septiembre 13 de 1994)', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Impresos (publicaciones, fotocopias)', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Comunicacion (correos y transportes)', newRecordId: codId},codId));
         codId = Ext.id();
         store.addSorted(new Rejistro({concepto : 'Seguros generales', newRecordId: codId},codId));

       }
     }
     
   }
   

   //add el evento al grid para que el metodo se encarge de poblar las grid con los 
   //rejistros iniciales
   gridGastoInversion.on('render',gastosPorDefecto);
   gridGastosGenerales.on('render',gastosPorDefecto);
   
   
   /*
   * Con esta funcion se hace el envio de la solicitud
   */
   function enviar()
   {
	  Ext.Msg.show({ 
	  title   : 'Confirmacion',
	  msg     : 'Asegurece que todo la informacion que ha ingresado en la solicitud <br/> es correcta antes de enviar. ¿Esta seguro de enviar la solicitud?',
	  buttons : Ext.Msg.YESNO,
	  fn      : function (btn){
	    if(btn == 'yes')
	    {
	      Ext.Ajax.request({   
	        url     : '".URL_SASPA."direccion_dev.php/solicitud/enviar',  
	        success : function(response) {  
	          
	          var rpt = Ext.decode(response.responseText); 
             if(!Ext.isEmpty(rpt.urlFormulario))
             {
               actualizarPanel('central',rpt.urlFormulario); 
             }
             	          
	        },
	        failure : function(response){
	          
	        } 
	      });
	    }
	  },
	  icon : Ext.MessageBox.QUESTION
	  });
   }
   
   
   
    Saspa.EgresosGenerales = new Ext.Panel({
        renderTo: 'egresosGenerales',
        layout:   'column',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        items: [ 
          {columnWidth : 1 ,width: '100%', height: '100%', frame: true, autoScroll: true, items:[formGastos]}
        ]
    });
    Saspa.EgresosGenerales.render();
 
    
  ");
  
?>
