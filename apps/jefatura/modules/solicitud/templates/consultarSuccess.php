<?php
  
  echo  '<div id="ConsultaSolicitudes" style="width:915px;"></div>';
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var registroSolicitudes = Ext.decode('".$regSolicitudes."');
    
    var storeSolicitud = new Ext.data.SimpleStore({
      fields: [
        {name : 'tp_programa'  },//nivel academico
        {name : 'sol_estado'   },   
        {name : 'updated_at'   },
        {name : 'solicitante'  },
        {name : 'tp_analisis'  },//motivo solicitud
        {name : 'duracion'     },
        {name : 'inscritos'    },
        {name : 'admitidos'    },
        {name : 'sol_facultad' }, 
        {name : 'sol_escuela'  } 
      ]
    });
    
    storeSolicitud.loadData(registroSolicitudes);
    
    //el modelo de las columnas para el grid
    var columnSolicitud = new Ext.grid.ColumnModel([
      {header: '"."Tipo Programa"."' , resizable:true, size: 4, sortable: true, dataIndex: 'tp_programa'},
      {header: '"."Estado"."' ,    resizable:true, sortable: true, dataIndex: 'sol_estado'},
      {header: '"."Modificado"."', resizable:true, sortable: true, dataIndex: 'updated_at'},
      {id : 'soliciId', header: '"."Solicitante"."', resizable:true, sortable: true, dataIndex: 'solicitante'},
      {header: '"."Tipo Analisis"."', resizable:true, sortable: true, dataIndex: 'tp_analisis'},
      {header: '"."Duracion"."',  width : 54, resizable:true, sortable: true, dataIndex: 'duracion'},
      {header: '"."Inscritos"."', width : 54, resizable:true, sortable: true, dataIndex: 'inscritos'},
      {header: '"."Admitidos"."', width : 54, resizable:true, sortable: true, dataIndex: 'admitidos'},
      {header: '"."Facultad"."' ,  resizable:true, sortable: true, dataIndex: 'sol_facultad'},
      {header: '"."Escuela"."' ,  resizable:true, sortable: true, dataIndex: 'sol_escuela'}
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
      	'->'
      ],
      store      : storeSolicitud,
      cm         : columnSolicitud,
      border     : true,
      height     : 500,
      frame      : true,
      width      : '100%',
      autoExpandColumn : 'soliciId',
      stripeRows : true
    });
      
    Saspa.Consulta = new Ext.Panel({
        renderTo: 'ConsultaSolicitudes',
        items: [gridConsulta]
    });
    
    
    /*
    * Esta funcion se encarga del proceso de revision de un concepto
    */
    function revisarConcepto()
    {
    	Ext.Msg.alert('Mensaje','hizo clic en revisar concepto');
    }
    
         
    Saspa.Consulta.render();

 ");
?>
