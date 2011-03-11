<?php
  echo  '<div id="extructuraCurricular" style="width:915px;"></div>';
  
  //recupero la informacion de las asignaturas que hay en el nuevo programa 
  //para el cual es creada la solicitud
  $c = new Criteria();
  $c->add(ExtructuraCurricularPeer::ECU_SOL_ID, $sol_id);
  $extCurricular = ExtructuraCurricularPeer::doSelect($c);
  
  $pos = 0;
  $datos;
  
  foreach($extCurricular as $fila)
  {
    $datos[$pos][] = $fila->getEcuId();
    $datos[$pos][] = $fila->getEcuSolId();
    $datos[$pos][] = $fila->getEcuPeriodoAcademico();
    $datos[$pos][] = $fila->getEcuAsignatura();
    $datos[$pos][] = $fila->getEcuNumCreditos();
    $datos[$pos][] = $fila->getEcuTotalHoras();
    $datos[$pos][] = $fila->getEcuNumProgramaComparte();
    $datos[$pos][] = $fila->getEcuCategoriaDocente();
    $datos[$pos][] = $fila->getEcuHorasDictadasComo();
    $datos[$pos][] = $fila->getEcuValorHora();
    $pos++;
  }
  
  $datosCurriculares = "{}";
  if(isset($datos))
  {
    $datosCurriculares = json_encode($datos);
  }
  
  //obtengo los campos nivel academico y numero de periodos de la tabla informacion_general
  $c1 = new Criteria();
  $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
  $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1);  

  $nivelAcademico;
  $numeroPeriodos;
  if(isset($informacionGeneral)){
    $nivelAcademico = $informacionGeneral->getIngNivelAcademico();
    $numeroPeriodos = $informacionGeneral->getIngDuracionPrograma();
  }
  
  //obtener los valores de las horas para cada docente
  $c1 = new Criteria();
  $c1->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $nivelAcademico); //obtengo todos los valores de hora para el nivel academico
  $valoresHorasbd = ValorHoraDocentePeer::doSelect($c1);
  
  $valoresHoras = array(); //crear el arreglo para almacenar los valores de hora
  foreach($valoresHorasbd as $valorHora)
  {
    array_push($valoresHoras,array(
      "categoria"=>$valorHora->getVhdCategoriaDocente(),
      "hdicomo" => array( 
           "Hora_catedra"    => array($valorHora->getVhdHoraCatedra(),($valorHora->getVhdHoraCatedra()*0.5) ),
           "Bonificado"      => array($valorHora->getVhdNombradoBonificado(),($valorHora->getVhdNombradoBonificado()*0.5) ),
           "Carga_academica" => array($valorHora->getVhdNombradoCargaAcademica(),($valorHora->getVhdNombradoCargaAcademica()*0.5) )
         )
    ));
  }
  
  $valoresHorasObj = json_encode($valoresHoras);
  
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var valoresDeHora = '';
    valoresDeHora = Ext.util.JSON.decode('".$valoresHorasObj."');
    
    
    var datosCurriculares = '' ;
    datosCurriculares = Ext.util.JSON.decode('".$datosCurriculares."');
    
    
    //El store para el grid con la lista de asignaturas
    var store = new Ext.data.SimpleStore({
      fields     : [
        {name :'id', type : 'int'},
        {name :'sol_id', type : 'int'}, 
        {name :'periodo', type : 'int'},
        {name :'asignatura'},
        {name :'num_creditos', type : 'int'},
        {name :'total_horas', type : 'int'},
        {name :'num_programa_comparte', type : 'int'},
        {name :'categoria_docente'},
        {name :'horas_dictadas_como'},
        {name :'valor_hora', type : 'float'},
      ]
    });
    
    store.loadData(datosCurriculares);
    
    //defino la configuracion de los editores para las celdas
    var perfd   = new Ext.form.NumberField({
      allowBlank    : false,
      allowDecimals : false,
      minValue      : 1,
      maxValue      : '".$numeroPeriodos."'
    });
    
    
    var asigfd  = new Ext.form.TextField({allowBlank: false});// Asignatura 
    var credfd  = new Ext.form.NumberField({allowBlank: false})// Creditos
    var tothrfd = new Ext.form.NumberField({allowBlank: false}) //Total horas
    var prcomfd = new Ext.form.NumberField({allowBlank: false}) //Programa compartidos por la asignatura 0 si no es compartida con otro programa
    
    var catedfd = new Ext.form.ComboBox({// Categoria del docente
      mode: 'local',
      store: ['Titular','Asociado','Asistente','Auxiliar'],
      triggerAction: 'all',
      forceSelection: true,
      editable: false,
      allowBlank: false
    });

    var hrdidfd = new Ext.form.ComboBox({//Horas dictadas como
      mode: 'local',
      store: ['Hora catedra','Bonificado','Carga academica'],
      triggerAction: 'all',
      forceSelection: true,
      editable: false,
      allowBlank: false
    });
    
    //Valor de la hora para el docente que dicta la asignatura
    var valhrfd = new Ext.form.NumberField({allowBlank: false})
    
    //las columnas que se mostraran al usuario en el grid
    var colmodel = new Ext.grid.ColumnModel([
      {header : 'Periodo', tooltip : 'Periodo Academico', width : 60, sortable : true , dataIndex : 'periodo', editor : perfd },
      {id : 'asignatura', header : 'Asignatura', sortable : true , dataIndex : 'asignatura', editor : asigfd },
      {header : 'Creditos', width : 60, sortable : true , dataIndex : 'num_creditos', editor : credfd },
      {header : 'Total horas', tooltip : 'Total horas en el  periodo academico', width : 72, sortable : true , dataIndex : 'total_horas' , editor : tothrfd },
      {header : 'Programas que comparte', tooltip : 'Numero de programas que comparten la asignatura',width : 132, sortable : true , dataIndex : 'num_programa_comparte', editor : prcomfd },
      {header : 'Categoria docente', tooltip : 'Categoria del docente' ,width : 110, sortable : true, dataIndex : 'categoria_docente', editor : catedfd },
      {header : 'Horas dictadas como', width : 120, sortable : true, dataIndex : 'horas_dictadas_como', editor : hrdidfd },
      {header : 'Valor hora', width : 100, sortable : true, dataIndex : 'valor_hora', editor : valhrfd }
    ]);
    
    var selModel = new Ext.grid.RowSelectionModel({singleSelect :true});
    
    var gridexcurricular  = new Ext.grid.EditorGridPanel({
      store     : store,
      cm        : colmodel,
      autoExpandColumn : 'asignatura',
      clicksToEdit     : 1,
      sm        : selModel,
      listeners : {
        afteredit : function(obj)
        {
          if(obj.column == 7)//si es la columna valor hora 
          {
            if(!(Ext.isEmpty(obj.record.get('categoria_docente')) || Ext.isEmpty(obj.record.get('horas_dictadas_como'))))  
            {
              validarValorHora(obj);
            }else{
              Ext.Msg.alert('Importante','Antes de definir un valor para la hora debe llenar las columnas Categoria docente y Horas dictadas como');
              obj.record.set('valor_hora',''); 
            }
          }
          
          //asignar el valor de hora minimo dado los parametros anteriores
          if(obj.column == 5 || obj.column == 6)
          {
            if(!Ext.isEmpty(obj.record.get('categoria_docente')) && !Ext.isEmpty(obj.record.get('horas_dictadas_como')))
            {
              actualizarValorHora(obj);
            }
          }
            
        }
      },
      autoWidth  : true,
      height     : 350,
      frame      : true,
      title      : 'Extructura curricular',
      iconCls    : 'icon-grid',
      tbar       : [
        {text : 'Guardar cambios' ,   handler : guardar, iconCls: 'x-btn-text-ico', icon: '../images/table_save.png' },
        {text : 'Agregar asignatura', handler : agregar, iconCls: 'x-btn-text-ico', icon: '../images/table_row_insert.png' },
        {text : 'Descartar cambios',  handler : cancelar, iconCls: 'x-btn-text-ico', icon: '../images/arrow_rotate_anticlockwise.png' },
        {text : 'Eliminar registro',  handler : eliminar, iconCls: 'x-btn-text-ico', icon: '../images/table_row_delete.png'}
      ],
      buttons:[
        {text : 'Salir', handler : enviarSalir },
        {text: 'Siguiente', handler : enviarSiguiente }
      ],
      border     : false,
      stripeRows : true 
    });
    
    
    function enviarSiguiente()
    {
      var modified = store.getModifiedRecords();
      if( modified.length > 0 )
      {
        Ext.Msg.alert('INFORM','Debe guardar todos los cambios para continuar');
      }else{
        Ext.Ajax.request({
          url     : '".URL_SASPA."direccion_dev.php/solicitud/extructuraCurricular',
          params  : { siguiente : 'true' },
          success : function(rp)
          {
            var rpt = Ext.decode(rp.responseText); 
            if(!Ext.isEmpty(rpt.urlFormulario))
            {
              actualizarPanel('central',rpt.urlFormulario); 
            }
          },
          failure : function(response)
          {
            Ext.Msg.alert('WARNING','Ocurrio un error mientras se procesaba la solicitud');
          } 
          
        });
      }
    }


    function enviarSalir()
    {
      Ext.Msg.alert('Salir','Para salir  presione el submenu Solicitudes a mano derecha, se perderan los cambios'); 
    }
    
    
    function guardar(){
      var modified = store.getModifiedRecords();//gridexcurricular.getStore().getModifiedRecords();//obtengo los registros modificados
      if(!Ext.isEmpty(modified)){
        var recordsToSend = [];
      
        Ext.each(modified, function(record) {
          recordsToSend.push(record.data);
        });
      
        gridexcurricular.el.mask('Guardando...', 'x-mask-loading');  
        gridexcurricular.stopEditing();
      
        recordsToSend = Ext.encode(recordsToSend);
      
        Ext.Ajax.request({   
          url : '".URL_SASPA."direccion_dev.php/solicitud/extructuraCurricular',    
          params :{records : recordsToSend},  
          success : function(response) {  
            gridexcurricular.el.unmask();            
            
            var info = Ext.decode(response.responseText); // decodifico la informacion regresada del servidor 

            Ext.each(info.data,function(obj){
	           var record = store.getById(obj.oldId);//gridexcurricular.getStore().getById(obj.oldId);
	           record.set('id',obj.id);
	           delete record.data.newRecordId; //este aunque no se ve en el grid, es considerado un cambio por lo que debo llamar al commit despues de esto	           
            });
            store.commitChanges(); 
            Ext.Msg.alert('INFORM','Cambios realizados');
          }  
        });
      }
    }
    
    function agregar()
    {
      var posicion = gridexcurricular.getStore().getCount();  
      var id = Ext.id();  
      var defaultData = {
        sol_id       : '".$sol_id."',
        asignatura   : '',
        num_programa_comparte : 0,
        horas_dictadas_como : '',
        categoria_docente : '',
        newRecordId  : id
      };  
      
      var Asignatura = gridexcurricular.getStore().recordType; //step 2  
      var asignatura = new Asignatura(defaultData,id);//asignamos la informacion por defecto dela asignatura  
      gridexcurricular.stopEditing(); //paramos cualquier edicion en el grid  
      gridexcurricular.getStore().insert(posicion, asignatura);   
      gridexcurricular.startEditing(posicion, 0);
    }
    
    function cancelar()
    {
       gridexcurricular.getStore().rejectChanges(); 
    }
    
    function eliminar(){
      var record = gridexcurricular.getSelectionModel().getSelected(); //obtengo el registro que esta seleccionado
      if(!Ext.isEmpty(record))//si no esta basio 
      {
        if(Ext.isEmpty(record.data.newRecordId))//si el registro ya fue guardado newRecordId no existe
        {
          Ext.Msg.show({//confirmacion para eliminar el rejistro 
            title   : 'Confirmacion',
            msg     : '¿Desea eliminar el registro '+record.get('asignatura')+'?',
            buttons : Ext.Msg.YESNO,
            fn      : function (btn){
              if(btn == 'yes')
              {
                Ext.Ajax.request({//peticion Ajax para eliminar el rejistro   
                url     : '".URL_SASPA."direccion_dev.php/solicitud/extructuraCurricular', //la url del servidor  
                params  :{id : record.data.id },//envio el id del registro a eliminar  
                success : function(response) {  
                    Ext.Msg.alert('INFORM','El registro fue eliminado');
                    gridexcurricular.getStore().remove(record);//elimino el registro de la grid
                },
                failure : function(response){
                  Ext.Msg.alert('INFORM','No se elimino el registro');
                } 
                });
              }
           },
           icon    : Ext.MessageBox.QUESTION
           });
           
        }else{ 
          gridexcurricular.getStore().remove(record);//elimino el rejistro del store
        }
      }else{
        Ext.Msg.alert('INFORM','Selecione un registro antes de dar clic en eliminar');
      }
    }
    
    
    function actualizarValorHora(evento)
    {
      //asignar el valor de hora minimo dado los parametros anteriores
      Ext.each(valoresDeHora, function (valhoraobj){
        if(valhoraobj.categoria == evento.record.get('categoria_docente'))
        {
          var horaDictadasComo = evento.record.get('horas_dictadas_como');
          horaDictadasComo = horaDictadasComo.replace(/ /g,'_');
          var arrg = eval('valhoraobj.hdicomo.'+(horaDictadasComo));
          evento.record.set('valor_hora',arrg[0]);//paso el valor minimo permitido al campo valor_hora
          return true;
        }
      });
      return false; //si no se encuentra coincidencia
    }  
  
  
  
    function validarValorHora(obeven) 
    {
      Ext.each(valoresDeHora, function (valhoraobj){
        if(valhoraobj.categoria == obeven.record.get('categoria_docente'))
        {
          var horaDictadasComo = obeven.record.get('horas_dictadas_como');
          horaDictadasComo = horaDictadasComo.replace(/ /g,'_');//remplazo los espacios basios con el guion bajo
          var arrg = eval('valhoraobj.hdicomo.'+(horaDictadasComo)); 
          if(obeven.value <= arrg[1] && obeven.value >= arrg[0]){
            if(obeven.record.get('horas_dictadas_como') == 'Carga academica')
            {
               Ext.Msg.alert('INFORM', 'No se puede cambiar el valor de la hora cuando las horas son dictadas como Carga academica');
               obeven.record.set('valor_hora',arrg[0]);
            }
            return true;
          }
          Ext.Msg.alert('Valores de hora permitidos', 'Minimo = '+arrg[0]+', Maximo = '+arrg[1]);
          obeven.record.set('valor_hora',arrg[0]);
        }      
      });
      return false;
    }
    
    
    
    Saspa.ExtructuraCurricular = new Ext.Panel({
        renderTo: 'extructuraCurricular',
        layout:   'column',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        items: [ 
          {columnWidth : 1 ,width: '100%', height: '100%', frame: true, autoScroll: true, items:[gridexcurricular]}
        ]
    });

    Saspa.ExtructuraCurricular.render();


  ");
?>