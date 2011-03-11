<?php 
	
	//vista para el procesos de revision de una solicitud
	echo  '<div id="revisarCoordinadora" style="width:915px;"></div>';
	echo javascript_include_tag('revision/comentar.js');
	echo use_helper('Javascript');
	echo javascript_tag("
		
	var storeSolicitud = new Ext.data.JsonStore({
        url: '".URL_SASPA."jefatura_dev.php/solicitud/lista',
        root: 'datos',
        totalProperty: 'total',
        fields: [
          {name:'sol_id'},
          {name:'sol_nombre'},
          {name:'sol_escuela'},
          {name:'sol_facultad'},
          {name:'sol_estado'},
          {name:'sol_usuario'},
          {name:'created_at',type : 'date', dateFormat : 'Y-m-d H:i:s' },
          {name:'updated_at',type : 'date', dateFormat : 'Y-m-d H:i:s' }
        ]
      });
   
    storeSolicitud.load();
    
		
	 //el modelo de las columnas para el grid
    var columnSolicitud = new Ext.grid.ColumnModel([
      {id: 'id' , resizable:true, header: '"."Numero de Solicitud"."' , sortable: true, dataIndex: 'sol_id'},      
      {id:'nombreid', header: '"."Nombre"."' ,    resizable:true, sortable: true, dataIndex: 'sol_nombre'},
      {header: '"."Escuela"."' ,   resizable:true, sortable: true, dataIndex: 'sol_escuela'},
      {header: '"."Facultad"."' ,  resizable:true, sortable: true, dataIndex: 'sol_facultad'},
      {header: '"."Estado"."' ,    resizable:true, sortable: true, dataIndex: 'sol_estado'},
      {header: '"."Creada"."' ,    resizable:true, sortable: true, dataIndex: 'created_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')},
      {header: '"."Modificada"."', resizable:true, sortable: true, dataIndex: 'updated_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')}
    ]);
    
    
    //incluir el plugin para las busquedas en el grid
    var gridConsulta = new Ext.grid.GridPanel({
      title      : 'Listado Solicitudes',
      plugins    : [
			new Ext.ux.grid.Search({          
            mode:          'local',
            position:      top,
            searchText:    'Consultar',
            selectAllText: 'Seleccionar todos',
            searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
            width:         150
        })
      ],
      tbar : [
      	{
      		text : 'Comentario',
      		handler  : comentar,
				iconCls  : 'x-btn-text-ico',
				icon     : '../images/comments.png'
      	},'-',
      	{
      		text : 'Ver concepto',
      		handler  : mostrarConcepto,
				iconCls  : 'x-btn-text-ico',
				icon     : '../images/page_white_acrobat.png'
      	},
      	'->',
      	{
      		text    : 'Devolver a analisis',
      		funcion : 'Devolver',
      		iconCls : 'x-btn-text-ico',
      		handler : procesarSolicitud,
				icon    : '../images/arrow_left.png'
      	},
      	{
      		text    : 'Aprobado',
      		funcion : 'Aprobar',
      		handler : procesarSolicitud,
      		iconCls : 'x-btn-text-ico',
				icon    : '../images/accept.png'
      	}
      ],
      store      : storeSolicitud,
      cm         : columnSolicitud,
      border     : true,
      height     : 500,
      frame      : true,
      width      : '100%',
      autoExpandColumn : 'nombreid',
      stripeRows : true
    });
      
    Saspa.Consulta = new Ext.Panel({
        renderTo: 'revisarCoordinadora',
        items: [gridConsulta]
    });
    
   
   //esta funcion se encarga de enviar o devolver la solicitud
   function procesarSolicitud(bt,obj)
   {
   	var record = gridConsulta.getSelectionModel().getSelected();
    	if(!Ext.isEmpty(record) && record.data.sol_estado == 'Revision'){
    		Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Desea '+bt.funcion+' la solicitud '+record.get('sol_nombre')+'?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes'){
					Ext.Ajax.request({   
                url     : '".URL_SASPA."jefatura_dev.php/solicitud/revisar',
                params  : {
                		sol_id : record.data.sol_id,
                		operacion : bt.funcion 
                },
                success : function(response) {
                  var rp = Ext.decode(response.responseText);
                  if(rp.success)
                  {
                    Ext.Msg.alert('Mensaje',rp.msg);
                    gridConsulta.getStore().removeAll();
                    gridConsulta.getStore().load();
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
    
    
    //funcion encargada de mostrar el concepto en pdf
    function mostrarConcepto()
    {
    	var record = gridConsulta.getSelectionModel().getSelected();
    	if(!Ext.isEmpty(record) && record.data.sol_estado == 'Revision'){
			window.open('".URL_SASPA."analisis.php/solicitud/realizarAnalisis?sol_id='+record.data.sol_id,'_blank',' toolbar=no,menubar=no,scrollbars=yes,location=yes,status=no,width=700,height=650');
    	}else{
    		Ext.Msg.alert('Mensaje','Selecione una solicitud');
    	}
    	
    }
    
    /*
    * Esta funcion muestra la interfaz para hacer comentarios a las solicitudes
    */
    function comentar()
    {
    	 var record = gridConsulta.getSelectionModel().getSelected();
		 if(!Ext.isEmpty(record) && record.data.sol_estado == 'Revision')
		 {
		 		Saspa.comentario.comentar('".URL_SASPA."jefatura_dev.php/solicitud/comentarSolicitud',record.get('sol_id'),record.get('sol_nombre'));
		 }else{
		 		Ext.Msg.alert('Mensaje','Selecione una solicitud');
		 }
    }
    
    Saspa.Consulta.render();
		
		
	");
	
	
?>