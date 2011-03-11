<?php
  echo  '<div id="RevisionSolicitudes" style="width:915px;"></div>';
    
  //toda la carga de los script necesarios para la pagina hacerla de esta forma
  $c = new Criteria();
  //$c->add(SolicitudPeer::SOL_ESTADO,'Solicitado');
  $c1 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Analisis');
  $c2 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Solicitado');
  $c1->addOr($c2);
  $c->add($c1);
  $solicitudes = SolicitudPeer::doSelect($c);
  
  $pos = 0;
  $datos = array();
  foreach($solicitudes as $solicitud)
  {  
    $c = new Criteria();
    $c->add(InformacionGeneralPeer::ING_SOL_ID, $solicitud->getSolId());
    $infGeneral = InformacionGeneralPeer::doSelectOne($c);
    $sol_motivo = "Sin definir";
    $sol_programa = "Sin definir";
   
    if(isset($infGeneral))
    {
      $sol_motivo = $infGeneral->getIngMotivoSolicitud();
      $sol_programa = $infGeneral->getIngNombrePrograma();
    }
   
    $datos[$pos][] = $solicitud->getSolId();
    $datos[$pos][] = $solicitud->getSolFacultad();
    $datos[$pos][] = $sol_programa;
    $datos[$pos][] = $sol_motivo;
    $datos[$pos][] = $solicitud->getSolEstado();
    $datos[$pos][] = $solicitud->getUpdatedAt();
    $pos++;
  }
  
  $regSolicitudes = json_encode($datos);

	//Incluyo el plugin que me permite mostrar la descripcion de la observacion en el grid  
  echo javascript_include_tag('extjs/examples/grid/RowExpander.js');
  
  
  echo javascript_include_tag('revision/informacionGeneral.js');//Contiene el form con la estructura curricular de la solicitud
  echo javascript_include_tag('revision/estructuraCurricular.js');
  echo javascript_include_tag('revision/presupuestoIngresos.js');
  echo javascript_include_tag('revision/presupuestoEgresos.js');
  echo javascript_include_tag('revision/egresosGenerales.js');
  echo javascript_include_tag('revision/gestionComentarios.js');
  echo use_helper('Javascript');
  echo javascript_tag("
      
    var rejSolicitudes = Ext.decode('".$regSolicitudes."');
      
      
    //el almacen de datos para las solicitudes
    var storeSolicitud = new Ext.data.SimpleStore({
      fields: [
        {name:'sol_id'},       //identificador de la solicitud
        {name:'sol_facultad'}, //facultad desde donde se expide la solicitud
        {name:'sol_programa'}, //nombre del programa informacion general
        {name:'sol_motivo'},   //informacion general
        {name:'sol_estado'},   // estado en el que se encuentra la solicitud
        {name:'updated_at', type : 'date', dateFormat : 'Y-m-d H:i:s'}    //la ultima actualizacion de la solicitud (cuando cambio de estado)
      ]
    });
    
    storeSolicitud.loadData(rejSolicitudes);
      
    //el modelo de las columnas para el grid
    var columnSolicitud = new Ext.grid.ColumnModel([
      {header: '"."Numero de Solicitud"."' , resizable:true,  sortable: true, dataIndex: 'sol_id'},
      {header: '"."Facultad"."' ,  resizable:true, sortable: true, dataIndex: 'sol_facultad'},
      {id: 'nombreProId', header: '"."Nombre programa"."' ,  resizable:true, sortable: true, dataIndex: 'sol_programa'},
      {header: '"."Motivo Solicitud"."' ,   resizable:true, sortable: true, dataIndex: 'sol_motivo'},
      {header: '"."Estado"."' ,    resizable:true, sortable: true, dataIndex: 'sol_estado'},
      {header: '"."Fecha Estado"."', resizable:true, sortable: true, dataIndex: 'updated_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')}
    ]);
      
    var gridRevision = new Ext.grid.GridPanel({
      title            : 'Revision de solicitudes',
      store            : storeSolicitud,
      cm               : columnSolicitud,
      border           : true,
      height       	  : 400,
      frame             : true,
      autoWidth		  : true,
      autoExpandColumn : 'nombreProId',
      stripeRows       : true,
      tbar : [
        {text: 'Revisar solicitud', handler : revisar, iconCls: 'x-btn-text-ico', icon: '../images/iconos/page_paintbrush.png' }
        ,' ','-',{
        		text    : 'Comentarios', 
        		tooltip : 'Ver comentarios anteriores',
        		iconCls : 'x-btn-text-ico',
        		icon    : '../images/comments.png',
        		handler : function(btn,evobj)
        		{
        			  var solRec = gridRevision.getSelectionModel().getSelected();
					  if(!Ext.isEmpty(solRec))
					  {
					  		Saspa.comentario.gstcomentario('".URL_SASPA."analisis_dev.php/solicitud/ListarComentarios',solRec.get('sol_id'));
					  }else{
					  		Ext.Msg.alert('Mensaje','Selecione una solicitud');
					  }
        		}
        },'-',' ',' ',
        {
				text     : 'Realizar analisis',
				handler  : realizarAnalisis,
				iconCls  : 'x-btn-text-ico',
				icon     : '../images/page_white_acrobat.png'
        },
        {
        		text     : 'Enviar a coordinadora de Area',
				handler  : enviarCoordinadora,
				iconCls  : 'x-btn-text-ico',
				icon     : '../images/iconos/email.png'
        }
      ],
      sm: new Ext.grid.RowSelectionModel({
	     singleSelect: true	     
	   })
    });
      

    /*
    * Esta funcion envia la informacion al servidor para la realizacion del analisis a 
    * la solicitud seleccionada
    */
    function realizarAnalisis()
    {
    	var record = gridRevision.getSelectionModel().getSelected();
    	if(!Ext.isEmpty(record) && record.data.sol_estado == 'Analisis'){
    		
    		Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Realizar analisis para la solicitud #'+record.data.sol_id+'?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes'){
					//definir otro parametro para no cambiar el estado de la solicitud, en caso que el informe sea generado desde otro punto de la aplicacion
					window.open('".URL_SASPA."analisis.php/solicitud/realizarAnalisis?sol_id='+record.data.sol_id,'_blank',' toolbar=no,menubar=no,scrollbars=yes,location=yes,status=no,width=700,height=650');
            }
          },
          icon     : Ext.MessageBox.QUESTION
        });
    		
    	}else{
    		Ext.Msg.alert('INFORM','Selecione una solicitud');
    	}
    	
    }
    
    /**
    * Enviar a Coordinadora de Area: envia el identificador de la solicitud seleccionada al servidor 
    */
    function enviarCoordinadora()
    {
    	var record = gridRevision.getSelectionModel().getSelected();
    	if(!Ext.isEmpty(record) && record.data.sol_estado == 'Analisis'){
    		
    		Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Enviar solicitud a coordinadora de area?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes'){
					Ext.Ajax.request({   
                url     : '".URL_SASPA."analisis_dev.php/solicitud/enviarCoordinadora',
                params  : {sol_id : record.data.sol_id },
                success : function(response) {
                  
                  var rp = Ext.decode(response.responseText);
                  if(rp.success)
                  {
                    Ext.Msg.alert('Mensaje',rp.msg);
                    //remover el registro del store por ahora , luego pensar en el cambio de estado
                    storeSolicitud.remove(record);
                    
                  }else{
                    Ext.Msg.alert('Error',rp.error);
                  }
                  
                },
                failure : function(response){
                  var rp = Ext.decode(response.responseText);
                  Ext.Msg.alert('Error','No se pudo procesar la peticion');
                }
                
              });
            }
          },
          icon     : Ext.MessageBox.QUESTION
        });
    		
    	}else{
    		Ext.Msg.alert('INFORM','Selecione una solicitud');
    	}
    	
    }
    //CONTINUAR AQUI, DEFINIR LA PETICION AJAX Y LA ACTUALIZACION DEL STORE
    
     
     
     
    /*
    * Envia la peticion al servidor con el identificador de la solicitud (sol_id)
    */ 
    function revisar()
    {
      var record = gridRevision.getSelectionModel().getSelected();
      if(!Ext.isEmpty(record))
      {
      
        Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Desea revisar la solicitud número '+record.data.sol_id+'?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes')
            {
              Ext.Ajax.request({   
                url     : '".URL_SASPA."analisis_dev.php/solicitud/revisarSolicitudes',
                params  : {id : record.data.sol_id },
                success : function(response) {
                  
                  var rp = Ext.decode(response.responseText);
                  if(rp.success)
                  {
                    actualizarPanel('central',rp.urlFormulario);
                  }else{
                    Ext.Msg.alert('Error',rp.error);
                  }
                  
                },
                failure : function(response){
                  var rp = Ext.decode(response.responseText);
                  Ext.Msg.alert('Error','No se pudo procesar la peticion');
                }
                
              });
            }
          },
          icon     : Ext.MessageBox.QUESTION
        });
        
      }else{
        Ext.Msg.alert('INFORM','Selecione una solicitud y clic en Revisar solicitud');
      }
      
    }
        
    Saspa.Revision = new Ext.Panel({
        renderTo: 'RevisionSolicitudes',
        layout:   'fit',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        items: [gridRevision]
    });
         
    Saspa.Revision.render();  
      
      
      
 ");
?>
