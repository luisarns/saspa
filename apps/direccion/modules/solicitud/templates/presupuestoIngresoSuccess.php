<?php
  echo  '<div id="presupuestoIngreso" style="width:915px;"></div>';
  
  //obtengo el numero de periodos del programa academico
  $c1 = new Criteria();
  $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
  $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1); 
  $numeroPeriodos = $informacionGeneral->getIngDuracionPrograma();
  
  $datosContribucionesFuentes = array();//arreglo que contiene la lista de rejistro que se mostraran en el grid
  $datosPresupuestoIngreso = array();//este arreglo contiene la informacion del formulario
  
  
  //obtengo la informacion del prepuesto de ingreso
  $c = new Criteria();
  $c->add(PresupuestoIngresosPeer::PIN_SOL_ID, $sol_id);
  $presupuestoIngreso = PresupuestoIngresosPeer::doSelectOne($c);
  
  if(isset($presupuestoIngreso))
  {
    $datosPresupuestoIngreso['pin_id'] = $presupuestoIngreso->getPinId();
    $datosPresupuestoIngreso['estudiantesInscritos'] = $presupuestoIngreso->getPinNumeroInscritos();
    $datosPresupuestoIngreso['estudiantesMatriculados'] = $presupuestoIngreso->getPinNumeroMatriculados();
    $datosPresupuestoIngreso['exenciones'] = $presupuestoIngreso->getPinExenciones();
    
    //obtengo todas las fuentes externas asociadas a la solicitud
    $c = new Criteria();
    $c->add(FuentesExternasPeer::FUE_SOL_ID, $sol_id);
    $fuentesExternas = FuentesExternasPeer::doSelect($c);
  
  
    //para cada una de las fuentes externas
    foreach($fuentesExternas as $fuenteExterna)
    {
      //obtengo todas las contribuciones que hace la fuente externa en cada periodo
      $c = new Criteria();
      $c->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $fuenteExterna->getFueId());
      $contribucionesFuentes = ContribucionFuenteExternaPeer::doSelect($c);
    
      //agrego los elementos al array para que puedan ser vistos por el almacen (store)
      $datosContribucionFuente[0] = $fuenteExterna->getFueNombre();
      foreach($contribucionesFuentes as $contribucionFuente)
      {
        //creo las clave periodo : valor con las cuales determino el aporte de la fuente externa en un periodo
        $prido = $contribucionFuente->getCfePeriodo();
        $vlor  = $contribucionFuente->getCfeValor();
        $datosContribucionFuente[$prido] = $vlor; 
      }
      $datosContribucionFuente[$numeroPeriodos+1] = $fuenteExterna->getFueId();//el paso el identificador de la fuente externa
      
      //agrego el arreglo configurado de contribuciones por periodo
      array_push($datosContribucionesFuentes, $datosContribucionFuente);
    }
    
  }
  $updateIngreso = json_encode($datosPresupuestoIngreso);
  
  //creo el objeto json para llenar el store
  $jsonContribFuentes = json_encode($datosContribucionesFuentes);
  
  
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var rejistroIngresos = '';
    rejistroIngresos = Ext.decode('".$updateIngreso."');
    
    
    var periodos = '';
    var contribucionesFuentesPeriodos = '';
    
    periodos = '".$numeroPeriodos."';    
    
    //contribuciones de las fuentes externas al programa periodo a periodo
    contribucionesFuentesPeriodos = Ext.decode('".$jsonContribFuentes."');
    
    var columnas = [];//las columns del grid 
    var campos   = [];//los fields del store no esta mostrando el nombre y aun no se por que
  
    campos.push({ name : 'nombre'}); 
    columnas[0] = {header : 'Nombre', dataIndex : 'nombre', editor : new Ext.form.TextField({allowBlank : false }) }; 
  
    for(var i = 1; i <= periodos; i++)
    {
      campos.push({name : ''+i , type : 'float'});
      columnas[i] = {header : 'Periodo'+i, editor : new Ext.form.NumberField({
      allowBlank    : false,
      allowDecimals : true,
      allowNegative : false}), dataIndex : ''+i, renderer : fmaPesos };
    }
    campos.push({name : 'id'});//el identificador de la entidad o convenio
    
    var store = new Ext.data.SimpleStore({
      fields : campos
    });

    function fmaPesos(val)
    {
      if(val > 1000)
	      return '<span style=\"color:green;\">' + Ext.util.Format.usMoney(val) + '</span>';	
      if(val < 0)
	      return '<span style=\"color:red;\">' + Ext.util.Format.usMoney(val) + '</span>';
      
      return val;
    }

    store.loadData(contribucionesFuentesPeriodos);
    
    var gridConvenios = new Ext.grid.EditorGridPanel({
      store      : store ,
      columns    : columnas ,
      sm         : new Ext.grid.RowSelectionModel({singleSelect :true}),
      height     : 300,
      title      : 'Fuentes externas (Convenios/Entidades) contribucion por periodo',
      tbar       : [
        {text : 'Deshacer', handler : cancelar, iconCls: 'x-btn-text-ico', icon: '../images/arrow_rotate_anticlockwise.png' },
        {text : 'Agregar' , handler : agregar,  iconCls: 'x-btn-text-ico', icon: '../images/table_row_insert.png'  },
        {text : 'Eliminar', handler : eliminar, iconCls: 'x-btn-text-ico', icon: '../images/table_row_delete.png' }
      ],
      border     : false,
      clicksToEdit: 1,
      stripeRows : true
    });
    
    function cancelar()
    {
      gridConvenios.getStore().rejectChanges(); 
    }
    
    function agregar()
    {
	   var posicion = gridConvenios.getStore().getCount();  
	   var id = Ext.id();
	   var defaultData = {
	     newRecordId  : id
	   };  
	    
      var Convenio = gridConvenios.getStore().recordType;   
	   var convenio = new Convenio(defaultData,id);  
	   gridConvenios.stopEditing();   
	   gridConvenios.getStore().insert(posicion,convenio);  
	   gridConvenios.startEditing(posicion, 0); 
    }
    
    function eliminar()
    {
      var record = gridConvenios.getSelectionModel().getSelected();
      if(!Ext.isEmpty(record)) 
      {
        if(Ext.isEmpty(record.data.newRecordId))
        {
          Ext.Msg.show({ 
            title   : 'Confirmacion',
            msg     : '¿Desea eliminar el registro '+record.get('nombre')+'?',
            buttons : Ext.Msg.YESNO,
            fn      : function (btn){
              if(btn == 'yes')
              {
                Ext.Ajax.request({   
                url     : '".URL_SASPA."direccion_dev.php/solicitud/presupuestoIngreso',  
                params  :{id : record.data.id },  
                success : function(response) {  
                    Ext.Msg.alert('INFORM','El registro fue eliminado');
                    gridConvenios.getStore().remove(record);
                  }
                });
              }
           },
           icon    : Ext.MessageBox.QUESTION
           });
        }else{ 
          store.remove(record);
        }
       
      }else{
        Ext.Msg.alert('INFORM','Selecione un registro antes de dar clic en eliminar');
      }
     
    }
    
    //cuando se elimine un rejistro
    store.on('remove',function(st,rec,indx){
      Ext.Msg.alert('Removido registro',rec.data.nombre);
    });
    
    
    //formulario principal con los campos para ingresar los datos
      var formPresupuestoIngreso = new Ext.form.FormPanel({
      title      : 'Presupuesto ingresos',
      url        : '".URL_SASPA."direccion_dev.php/solicitud/presupuestoIngreso',
      autoWidth  : true,
      frame      : true,
      bodyStyle  : 'padding:5px',
      layout     : 'column',
      items      : [
        {
          columnWidth : 0.4,
          xtype       : 'fieldset',
          labelWidth  : 100,
          title       : 'Conceptos (numero de horas semestrales)',
          defaults    : {width: 140},
          defaultType : 'numberfield',
          autoHeight  : true,
          bodyStyle   : Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
          border      : false,
          items       : [
            {
              xtype : 'hidden',
              name  : 'pin_id',
              id    : 'hdpid_id'
            },
            {
              id            : 'tfnumEstInscritos',
              fieldLabel    : 'Estudiantes inscritos(#)',
              name          : 'estudiantesInscritos',
              allowNegative : false, 
              allowBlank    : false
            },
            {
              id            : 'tfnumEstMatriculados',
              fieldLabel    : 'Estudiantes matriculados(#)',
              name          : 'estudiantesMatriculados',
              allowNegative : false, 
              allowBlank    : false
            },
            {
              id            : 'tfpctExenciones',
              fieldLabel    : 'Exenciones(%)',
              name          : 'exenciones',
              maxValue      : 20,
              minValue      : 1,
              allowNegative : false, 
              allowBlank    : false
            }
          ] 
        },
        {
          columnWidth : 0.6,
          layout      : 'fit',
          items       : gridConvenios
        }
      ],
      buttons    : [
        { text : 'Salir'},
        { text : 'Siguiente', handler : enviarSiguiente}    
      ]
    });

    //Esta funcion se encarga del envio de los datos del presupuesto de ingresos al servidor
    function enviarSiguiente()
    {      
      if(formPresupuestoIngreso.getForm().isValid())
      {
        Ext.Msg.show({
		    title:'Confirmacion',
			 msg: '¿Esta seguro que desea guardar la informacion?', //la confirmacion no deberia estar aqui 
			 buttons: Ext.Msg.YESNO,
			 fn: function (btn){
			   if(btn == 'yes')
			   {
              var conveniosEntidades = [];
              var modificados = store.getModifiedRecords();
              Ext.each(modificados, function (record){
                conveniosEntidades.push(record.data);
              });
              
              formPresupuestoIngreso.getForm().submit({
                method    : 'POST',
                waitTitle : 'Enviando',
                waitMsg   : 'Enviando datos...',
                params    : {
                  fuentesExternas : Ext.encode(conveniosEntidades),
                  siguiente       : 'true',
                  periodos        : periodos
                },
                success   : function(form, action)
                {
                  var response = action.result;
                  actualizarPanel('central',response.urlFormulario);
                  
                },
                failured: function(form, action)
                {
                  //manejar la transacionalidad cuando este manipulando rejistros de la bd
                  Ext.Msg.alert('ERROR', 'No se pudo almacenar la informacion');
                }
              });
			   }					            
			 },
			 icon: Ext.MessageBox.QUESTION
		  });
        
      }else{
        Ext.Msg.alert('INFORM','Los campos en rojo son obligatorios');
      }
    }
    
    formPresupuestoIngreso.on('render',cargarFormulario);
    
    function cargarFormulario()
    {
      Ext.getCmp('hdpid_id').setValue(rejistroIngresos.pin_id);
      Ext.getCmp('tfnumEstInscritos').setValue(rejistroIngresos.estudiantesInscritos);
      Ext.getCmp('tfnumEstMatriculados').setValue(rejistroIngresos.estudiantesMatriculados);
      Ext.getCmp('tfpctExenciones').setValue(rejistroIngresos.exenciones);
    }
    
    Saspa.PresupuestoIngreso = new Ext.Panel({
        renderTo: 'presupuestoIngreso',
        layout:   'column',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        items: [ 
          {columnWidth : 1 ,width: '100%', height: '100%', frame: true, autoScroll: true, items:[formPresupuestoIngreso]}
        ]
    });
    Saspa.PresupuestoIngreso.render();
    
    
  ");
  
?>
