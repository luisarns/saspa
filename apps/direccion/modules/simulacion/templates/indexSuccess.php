<?php
  echo  '<div id="Index" style="width:915px;"></div>';
  
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var storeSolicitud = new Ext.data.JsonStore({
      url: '".URL_SASPA."direccion.php/simulacion/lista',
      root: 'datos',
      totalProperty: 'total',
      fields: [
        {name:'sol_id'},
        {name:'sol_nombre'},
        {name:'sol_escuela'},
        {name:'sol_facultad'},
        {name:'sol_archivo'},
        {name:'sol_estado'},
        {name:'sol_usuario'},
        {name:'created_at', type : 'date', dateFormat : 'Y-m-d H:i:s'},
        {name:'updated_at', type : 'date', dateFormat : 'Y-m-d H:i:s'}
      ]
    });
    storeSolicitud.load();
    
    var columnSolicitud = new Ext.grid.ColumnModel([
      {id: 'id' , resizable:true, header: '"."Numero de Solicitud"."' , sortable: true, width: 30, dataIndex: 'sol_id'},      
      {id:'nombre', header: '"."Nombre"."' ,    resizable:true, sortable: true, width: 140, dataIndex: 'sol_nombre'},
      {header: '"."Escuela"."' ,   resizable:true, width: 185, sortable: true, dataIndex: 'sol_escuela'},
      {header: '"."Facultad"."' ,  resizable:true, width: 185, sortable: true, dataIndex: 'sol_facultad'},
      {header: '"."Estado"."' ,    resizable:true, width: 70, sortable: true, dataIndex: 'sol_estado'},
      {header: '"."Creada"."' ,    resizable:true, width: 120, sortable: true, dataIndex: 'created_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')},
      {header: '"."Modificada"."', resizable:true, width: 120, sortable: true, dataIndex: 'updated_at', renderer : Ext.util.Format.dateRenderer('d/M/Y')}
    ]);
    
    var listaSolicitud = new Ext.grid.GridPanel({
      id: 'idlistaSolicitud',
      ds: storeSolicitud,
      cm: columnSolicitud,
      tbar : [
       {text: 'Simular', handler : silumar, iconCls: 'x-btn-text-ico', icon: '../images/control_play_blue.png' }
      ],
      sm: new Ext.grid.RowSelectionModel({
	     singleSelect: true	     
	   }),
      width : 750,
      height: 350,
	   border: true,
	   title: 'Solicitudes (seleccione una solicitud para simular)'
    }); 
    
    
    function silumar(bt,e)
    {
      var record = listaSolicitud.getSelectionModel().getSelected();
      if(!Ext.isEmpty(record))
      {        
        Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Desea simular la solicitud '+record.data.sol_nombre+'?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes')
            {
              
              Ext.Ajax.request({   
                url     : '".URL_SASPA."direccion_dev.php/simulacion/index',  
                params  :{id : record.data.sol_id },  
                success : function(response) {  
                  var rp = Ext.decode(response.responseText);
                  if(rp.success)
                  {
                    actualizarPanel('central',rp.urlFormulario);
                  }else {
                    Ext.Msg.alert('Error',rp.error);
                  }
                  
                },
                failure : function(response){
                  var rp = Ext.decode(response.responseText);
                  Ext.Msg.alert('Error',rp.error);
                } 
              });
              
            }
          },
          icon     : Ext.MessageBox.QUESTION
        });
           
      }else{
        Ext.Msg.alert('INFORM','Selecione una solicitud y clic en simular');
      }
    }
    
    
    Saspa.Solicitudes = new Ext.Panel({
        renderTo: 'Index',
        layout:   'fit',
        style:    'width: 100%; height: 100%;', 
        fitToFrame: true,
        items: [listaSolicitud]
    });
         
    Saspa.Solicitudes.render();
    
    
  ");

  
?>