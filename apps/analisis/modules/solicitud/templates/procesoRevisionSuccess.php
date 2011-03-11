<?php
  
  //en este div se renderizan los formularios de la solicitud 
  echo '<div id="formRevisarSolicitud" style="width:96%;height:98%;"></div>';
  
  //actualizarPanel('central','http://192.168.3.120/saspa/web/analisis_dev.php/solicitud/procesoRevision');
  
  echo use_helper('Javascript');
  echo javascript_tag("
    
    var datosInformGneral = Ext.decode('".$dtosInformGeneral."');
    var datosCurriculares = Ext.decode('".$datosCurriculares."');
    var configCompInGnral = Ext.decode(".$compInGnral.");
    var datosPresIngreso  = Ext.decode('".$datosPresupuestoIngresos."');
    
    
    var formComentario = new Ext.form.FormPanel({
      url        : '".URL_SASPA."analisis_dev.php/solicitud/procesoRevision',
      title      : 'Comentarios',
      height     : 295,
      width      : '100%',
      autoScroll : true,
      frame      : true,
      layout     : 'fit',
      items: [
        {
          xtype : 'htmleditor',
          name  : 'comentario'
        }
      ],
      buttons : [
        {text: 'Devolver', handler : enviarDatos},
        {text: 'Guardar',  handler : enviarDatos}
      ]
    });
    
    
    function enviarDatos(btn,obj)
    {
    	var op = btn.getText();
       Ext.Msg.show({ 
          title   : 'Confirmacion',
          msg     : '¿Esta seguro de '+op+' la solicitud?',
          buttons : Ext.Msg.YESNO,
          fn      : function (btn){
            if(btn == 'yes')
            {
              formComentario.getForm().submit({
              	method : 'POST',
              	params  : {
              	  operacion : op
              	},
              	success : function(form,action)
              	{
              		//Mostrar un mensaje, operacion terminada
              		//desplegar la grid para la revision de las solicitudes, en la zona central, donde se encuentra 
              		//el panel actual.
              		if(action.result.success)
              		{
              			Ext.Msg.alert('Respuesta servidor',action.result.msg);
              			actualizarPanel('central',action.result.urlRevSol);
              			
              		}else{
              			Ext.Msg.alert('Respuesta servidor',action.result.msg);
              		}
              	}
              	
              });
              
            }
          },
          icon     : Ext.MessageBox.QUESTION
        });
    }
	
	
	  
	  /*
	  * Fuerza al panel a recalcular el layout y a los hijos del panel recursivamente
	  * @param Ext.Panel : panel
	  */
	  var forzarLayout = function(panel)
	  {
	  		panel.doLayout();
	  }
	  
	
	
	///Ext.FormPanel: Formulario Egresos Generales
	var egresosGenerales = Saspa.analisis.egresosGenerales(".$numperiodos.",Ext.decode('".$gastosGenerales."'),Ext.decode('".$gastosInversiones."'));
	egresosGenerales.on('activate',forzarLayout);
	

    Saspa.Revisar = new Ext.Panel({
        renderTo   : 'formRevisarSolicitud',
        autoScroll : true,
        autoWidth  : true,
        height     : 600,
        items: [
          {
            xtype      : 'tabpanel',
            id         : 'tabRevision',
            activeTab  : 0,
            height     : 300,
            width      : '100%',
            defaults   : {autoScroll: true},
            plain      : true,
            items : 
            [
              Saspa.analisis.inforGeneral,
              Saspa.analisis.grdStrCrrc,
              Saspa.analisis.presIngresos,
              Saspa.analisis.presEgresos,
              egresosGenerales
            ]
          },
          formComentario
        ]
    });
	  
	  
	  
    /*
    * Este metodo se encarga de asignar a los campos del formulario, la informacion general de la 
    * solicitud que se encuentra en un objeto json.
    */
    Saspa.analisis.initInformacionGeneral(datosInformGneral,configCompInGnral);
    Saspa.analisis.cargarIngresos(datosPresIngreso);
    Saspa.analisis.crgSgn(datosCurriculares);
    Saspa.analisis.cargarEgresos(Ext.decode('".$datosEgresos."'));

    var jsonfuentesExternas = Ext.decode('".$jsncontribuciones."');
    Saspa.analisis.cargarFuenteExternas(".$numperiodos.",jsonfuentesExternas); 
    
    
    Saspa.Revisar.render();
    
    
  ");
  
?>