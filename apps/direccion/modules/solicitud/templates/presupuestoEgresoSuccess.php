<?php
  echo  '<div id="presupuestoEgreso" style="width:915px;"></div>';
  
  $c1 = new Criteria();
  $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
  $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1); 
  $nivelAcademico = $informacionGeneral->getIngNivelAcademico();
  
  $datosPresupuestoEgresos = array();
  
  $c = new Criteria();
  $c->add(PresupuestoEgresosPeer::PEG_SOL_ID, $sol_id);
  $presupuestoEgresos = PresupuestoEgresosPeer::doSelectOne($c);
  
  if(isset($presupuestoEgresos))
  {
    $datosPresupuestoEgresos['peg_id'] = $presupuestoEgresos->getPegId();
    $datosPresupuestoEgresos['coordinacion'] = $presupuestoEgresos->getPegHseCordPrograma();
    $datosPresupuestoEgresos['secretaria'] = $presupuestoEgresos->getPegHseSecretaria();
    $datosPresupuestoEgresos['administrativo'] = $presupuestoEgresos->getPegHseAuxAdministrativo();
    $datosPresupuestoEgresos['monitorias'] = $presupuestoEgresos->getPegHseMonitorias();
    
    //la informacio de los salarios pagados en la sedes regionales
    $datosPresupuestoEgresos['smdireccion'] = $presupuestoEgresos->getPegSmDireccion();
    $datosPresupuestoEgresos['smcoordinacion'] = $presupuestoEgresos->getPegSmCoordinacion();
    $datosPresupuestoEgresos['smotronombre'] = $presupuestoEgresos->getPegSmOtroNombre();
    $datosPresupuestoEgresos['smotrovalor'] = $presupuestoEgresos->getPegSmOtroValor();

  }
  
  $updateEgresos = json_encode($datosPresupuestoEgresos);
  
  
  echo use_helper('Javascript');
  echo javascript_tag("
  
	 var rejistroEgresos = '';
	 var nivelAcademicoPrograma = '".$nivelAcademico."';
    rejistroEgresos = Ext.decode('".$updateEgresos."');
    
    //gridBecas.on('render',agregar);
	 
	
	 var formPresupuestoEgreso = new Ext.form.FormPanel({
      title      : 'Presupuesto egresos',
      url        : '".URL_SASPA."direccion_dev.php/solicitud/presupuestoEgreso',
      //width      : 800,
      autoWidth  : true,
      frame      : true,
      bodyStyle  : 'padding:5px',
      layout     : 'column',
      items      : [
        {
          columnWidth : 0.4,
          xtype       : 'fieldset',
          labelWidth  : 100,
          title       : 'Cargos (Numero de horas semestrales)',
          defaults    : {width: 140, minValue: 0, maxValue: 880},
          defaultType : 'numberfield',
          autoHeight  : true,
          autoWidth   : true,
          bodyStyle   : Ext.isIE ? 'padding:0 0 5px 15px;' : 'padding:10px 15px;',
          border      : false,
          items       : [
            {
              xtype : 'hidden',
              name  : 'peg_id',
              id    : 'hdpeg_id'
            },
            {
              id            : 'tfcoordinacion',
              fieldLabel    : 'Coordinacion',
              name          : 'coordinacion',
              allowNegative : false,
              allowBlank    : false
            },
            {
              id            : 'tfsecretaria',
              fieldLabel    : 'Secretaria',
              name          : 'secretaria',
              allowNegative : false, 
              allowBlank    : false
            },
            {
              id            : 'tfauxadministrativos',
              fieldLabel    : 'Auxiliares administrativos',
              name          : 'auxadministrativos',
              allowNegative : false, 
              allowBlank    : false
            },
            {
              id            : 'tfmonitorias',
              fieldLabel    : 'Monitorias',
              name          : 'monitorias',
              allowNegative : false, 
              allowBlank    : false
            }
          ] 
        },
        {
          columnWidth : 0.6,
          xtype:'fieldset',
          checkboxToggle:true,
          title: 'Cargo  (sueldo mensual sedes)',
          autoHeight:true,
          defaults: {width: 210,allowNegative: false},
          defaultType: 'numberfield',
          //collapsed: true,
          items :[
          	{
          		id : 'saldireccion',
            	fieldLabel : 'Direccion',
               name : 'saldireccion'
            },
            {
            	id : 'salcoordinacion',
               fieldLabel : 'Coordinacion',
               name : 'salcoordinacion'
            },
            {
              xtype : 'fieldset',
              checkboxToggle : true,
              hideBorders    : true,
              //collapsed      : true,
              autoHeight     : true,
              title          : 'Otro',
              width          : '100%',              
              items 			: [
                {
                  xtype      : 'textfield',
                  id : 'otro_nombre',
               	fieldLabel : 'Nombre',
                  name       : 'otro_nombre'
                },
                {
                  xtype      : 'numberfield',
                	id : 'otro_sueldo',
                	fieldLabel : 'Sueldo mensual',
                  name       : 'otro_sueldo'
                }
              ]
            }
          ]
        }
      ],
      buttons    : [
        { text : 'Salir'},
        { text : 'Siguiente', handler : enviarSiguiente}    
      ]
    });
    
    
    
   //esta funcion se encarga de enviar los datos del formulario al servidor
   function enviarSiguiente()
    {      
      if(formPresupuestoEgreso.getForm().isValid())
      {
        Ext.Msg.show({
		    title:'Confirmacion',
			 msg: '¿Esta seguro que desea guardar la informacion?', 
			 buttons: Ext.Msg.YESNO,
			 fn: function (btn){
			   if(btn == 'yes')
			   {
              formPresupuestoEgreso.getForm().submit({
                method    : 'POST',
                waitTitle : 'Enviando',
                waitMsg   : 'Enviando datos...',
                params    : {
                  siguiente      : 'true',
                  nivelAcademico : nivelAcademicoPrograma
                },
                success   : function(form, action)
                { 
                  var response = action.result;
                  actualizarPanel('central',response.urlFormulario);
                  
                },
                failured: function(form, action)
                {
                  Ext.Msg.alert('ERROR', action.result.error);
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
    
    
    //con estas instruciones hago preparo el formulario para una actualizacion de los datos
    formPresupuestoEgreso.on('render',cargarFormulario);
    
    function cargarFormulario()
    {      
      //rejistroEgresos valores iniciales
      Ext.getCmp('hdpeg_id').setValue(rejistroEgresos.peg_id);
      Ext.getCmp('tfcoordinacion').setValue(rejistroEgresos.coordinacion);
      Ext.getCmp('tfsecretaria').setValue(rejistroEgresos.secretaria);
      Ext.getCmp('tfauxadministrativos').setValue(rejistroEgresos.administrativo);
      Ext.getCmp('tfmonitorias').setValue(rejistroEgresos.monitorias);
      
      //agregar los registro de salarios los nombre de los campos
     Ext.getCmp('saldireccion').setValue(rejistroEgresos.smdireccion);
     Ext.getCmp('salcoordinacion').setValue(rejistroEgresos.smcoordinacion);
     Ext.getCmp('otro_nombre').setValue(rejistroEgresos.smotronombre);
     Ext.getCmp('otro_sueldo').setValue(rejistroEgresos.smotrovalor);
     
    }



	 Saspa.PresupuestoEgreso = new Ext.Panel({
      renderTo: 'presupuestoEgreso',
      layout:   'column',
      style:    'width: 100%; height: 100%;', 
      fitToFrame: true,
      items: [ 
        {columnWidth : 1 ,width: '100%', height: '100%', frame: true, autoScroll: true, items:[formPresupuestoEgreso]}
      ]
    });
    
    Saspa.PresupuestoEgreso.render();
	  
  ");
  
  //actualizarPanel('central','http://192.168.3.120/saspa/web/direccion_dev.php/solicitud/presupuestoEgreso');
  
?>
