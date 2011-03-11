<?php
  
  echo  '<div id="ConsultaSolicitudes" style="width:915px;"></div>';
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
        {name:'updated_at'}    //la ultima actualizacion de la solicitud (cuando cambio de estado)
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
      {header: '"."Fecha Estado"."', resizable:true, sortable: true, dataIndex: 'updated_at'}
    ]);
      
     
    var gridConsulta = new Ext.grid.GridPanel({
      title      : 'Listado Solicitudes',
      store      : storeSolicitud,
      cm         : columnSolicitud,
      border     : true,
      height     : 500,
      frame      : true,
      width      : '100%',
      autoExpandColumn : 'nombreProId',
      stripeRows : true
    });
      
      
    Saspa.Consulta = new Ext.Panel({
        renderTo: 'ConsultaSolicitudes',
        items: [gridConsulta]
    });
         
    Saspa.Consulta.render();

 ");
?>
