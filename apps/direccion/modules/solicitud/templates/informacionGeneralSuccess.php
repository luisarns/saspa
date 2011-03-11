<?php
  echo  '<div id="informacionGeneral" style="width:915px;"></div>';
  
  $solicitud = SolicitudPeer::retrieveByPk($solId);
  if(isset($solicitud))
  {
  		$sol_id    = $solicitud->getSolId();
  		$fechaSol  = $solicitud->getCreatedAt();
  }
  
  //Obtengo la informacion de docente asociada a este usuario 
  $docente = DocentesPeer::retrieveByPk($solusuario);
  $docenNombreCompleto = $docente->getNombre()." ".$docente->getApellidos(); 
  $docenDocumento      = $docente->getCedula();
  
  
  //----------------------MODIFICAR-----------------------//
  $docenFacultad       = $docente->getFacultad(); 
  $docenEscuela        = $docente->getDependencia();
  //------------------------------------------------------//
  
  
  //obtengo el registro anterior de la informacion general
  $c1 = new Criteria();
  $c1->add(InformacionGeneralPeer::ING_SOL_ID, $solId);
  $informGneral = InformacionGeneralPeer::doSelectOne($c1);  
  
  //Almaceno informacion para mostrar en la vista (MVC)
  $datos["solicitudnumero"] = $solId;
  $datos["fechasolicitud"]  = $fechaSol;
  $datos["solicitante"]     = $docenNombreCompleto;
  $datos["facultad"]        = $docenFacultad;
  $datos["escuela"]         = $docenEscuela;
  $datos["isActualizar"]    = false;
  
  //Recupero los datos ingresados por el usuario cuando guardo el formulario
  if(isset($informGneral))
  {
    $datos["ing_id"]              = $informGneral->getIngId();
    $datos["nombreprograma"]      = $informGneral->getIngNombrePrograma();
    $datos["titulootorga"]        = $informGneral->getIngTituloOtorga();
    $datos["motivosolicitud"]     = $informGneral->getIngMotivoSolicitud();
    $datos["cualmotivosolicitud"] = $informGneral->getIngCualMotivo();
    $datos["ciudadsede"]          = $informGneral->getIngCiudadSede();
    $datos["nivelacademico"]      = $informGneral->getIngNivelAcademico();
    $datos["duracionprograma"]    = $informGneral->getIngDuracionPrograma();
    $datos["jornada"]             = $informGneral->getIngJornada();
    $datos["modalidad"]           = $informGneral->getIngTipoModalidad();
    $datos["mododepago"]          = $informGneral->getIngTipoValor();//tipo de valor
    $datos["isActualizar"]        = true;
    
    //en funcion del modo de pago adicionar los elementos necesarios para poblar el formulario
    if($datos["mododepago"] != 'Valor Diferenciado' )//si el modo de pago no es diferenciado 'Valor Unico',
    {
      $datos["opcionespagoperiodo"] = $informGneral->getIngFormaPago();
      $datos["valorunico"]          = $informGneral->getIngValor();//el valor pagado en SMMLV
    }else{
       
       $c1 = new Criteria();
       $c1->add(ValorDiferenciadoPeer::VAD_ING_ID, $datos["ing_id"]);
       $valDiferenciados = ValorDiferenciadoPeer::doSelect($c1);
       $pos = 0;
       $valoresdiferenciados;
       foreach($valDiferenciados as $valDiferenciado)
       {
         $valoresdiferenciados[$pos]['periodo'] = $valDiferenciado->getVadPeriodo();
         $valoresdiferenciados[$pos]['valor']   = $valDiferenciado->getVadValor();
         $pos++;
       }
       $datos["valoresDiferenciados"] = isset($valoresdiferenciados)?$valoresdiferenciados:"";
       
    }
  }
  
  
  $datosInformacionGeneral = json_encode($datos);
  
  echo use_helper('Javascript');
  echo javascript_tag("

	 //esto es una prueba eliminar Msg.alert despues de terminar   
    //Ext.Msg.alert('".$solId."');
    
    
    //paso los datos tomados de la bd al formulario 
    var datosInformacionGeneral = Ext.decode('".$datosInformacionGeneral."');
    
    //INICIO Definicion de los campos necesarios para el formulario informacion general
    //defino un campo oculto donde almaceno el identificador del formulario informacion general
    var tfingid = new Ext.form.Hidden({
      id   : 'tfingid',
      name : 'ing_id'
    });
    
    var tfsolicitudfecha = new Ext.form.TextField({
      id         : 'tfsolicitudfecha',
      fieldLabel : 'Fecha de solicitud',
      name       : 'fechasolicitud',
      disabled   : true,
      allowBlank : false,
      blankText  : 'Este campo es obligatorio'
    });
    
    var tfsolicitudnumero = new Ext.form.NumberField({
      id         : 'tfsolicitudnumero',
      fieldLabel : 'Numero de solicitud',
      name       : 'solicitudnumero',
      disabled   : true,
      allowBlank : false,
      blankText  : 'Este campo es obligatorio'
    });
    
    var tfsolicitante = new Ext.form.TextField({
      id: 'tfsolicitante',
      fieldLabel: 'Solicitante',
      name: 'solicitante',
      disabled: true,
      width: '90%',
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
    
    //----------------------MODIFICAR-----------------------//
    //estos campos deben mostrar el nombre pero enviar al servidor 
    //los correspondientes codigos
    
    var tffacultad = new Ext.form.TextField({
      id: 'tffacultad',
      fieldLabel: 'Facultad',
      name: 'facultad',
      disabled: true,
      width: '90%',
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
   
  
    var tfescuela = new Ext.form.TextField({
      id: 'tfescuela',
      fieldLabel: 'Escuela',
      name: 'escuela',
      disabled: true,
      width: '90%', 
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
   //-----------------------------------------------------// 
    
    //campos asignados por el usuario
    var tfnombreprograma = new Ext.form.TextField({
      id: 'tfnombreprograma',
      fieldLabel: 'Nombre programa',
      name: 'nombreprograma',
      width: '90%', 
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
  
    var tftitulootorga = new Ext.form.TextField({
      id: 'tftitulootorga',
      fieldLabel: 'Titulo que otorga',
      name: 'titulootorga',
      width: '90%',
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
    
    var ocultoCualSolicitud = true;  
  
    var tfcualmotivosolicitud = new Ext.form.TextField({
      id: 'tfcualmotivosolicitud',
      fieldLabel: 'Cual',
      name: 'cualmotivosolicitud',
      disabled: true,
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
  
    var tfmotivosolicitud = new Ext.form.ComboBox({
      id: 'tfmotivosolicitud',
      fieldLabel: 'Motivo solicitud',
      name: 'motivosolicitud',
      mode: 'local',
      store: ['Nuevo','Modificacion','Extension','Otro'],
      triggerAction: 'all',
      forceSelection: true,
      editable: false,
      listeners: {
        select: function(cbox, rec, i){
         if(cbox.getValue() == 'Otro'){
            if(ocultoCualSolicitud)
            {
              tfcualmotivosolicitud.enable();
              tfcualmotivosolicitud.allowBlank = false;            
              ocultoCualSolicitud = false;
            }
          
          }else
          {
            if(!ocultoCualSolicitud)
            {
              tfcualmotivosolicitud.disable();
              tfcualmotivosolicitud.allowBlank = true;
              ocultoCualSolicitud = true;
            }
          }
          tfcualmotivosolicitud.reset();
        }
      },
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
    
    var tfciudadsede = new Ext.form.ComboBox({
      id             : 'tfciudadsede',
      fieldLabel     : 'Ciudad sede',
      name           : 'ciudadsede',
      mode           : 'local',
      store          : ['Cali','Palmira','Buga'],
      hiddenName     : 'sede',//este es el nombre que se utiliza para enviar la peticion
      displayField   : 'sede',
      triggerAction  : 'all',
      forceSelection : true,
      editable       : false,
      allowBlank     : false,
      blankText      : 'Este campo es obligatorio'
    }); 
    
    var tfnivelacademico = new Ext.form.ComboBox({
      id: 'tfnivelacademico',
      fieldLabel: 'Nivel acad&eacute;mico del programa',
      name: 'nivelacademico',
      mode: 'local',
      store: [
      	'Tecnologico',
      	'Profesional',
      	'Especializacion',
      	'Especializacion Medico Clinica',
      	'Maestria de Profundizacion',
      	'Maestria de Investigacion',
      	'Doctorado'
      ],
      triggerAction: 'all',
      forceSelection: true,
      anchor: '75%',
      editable: false,
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
    
    var tfduracionprograma = new Ext.form.NumberField({
      id: 'tfduracionprograma',
      fieldLabel: 'Duracion programa (en semestres)',
      name: 'duracionprograma',
      emptyText: 'ejemplo: 10',
      allowDecimals: false, 
      allowNegative: false, 
      maxValue: 20,
      minValue: 1,
      nanText: 'Solo se permiten numeros',
      allowBlank: false,
      blankText: 'Este campo es obligatorio y despues de enviado el formulario no se podra modificar'
    });
    
    var tfjornada = new Ext.form.ComboBox({
      id: 'tfjornada',
      fieldLabel: 'Jornada',
      name: 'jornada',
      mode: 'local',
      store: ['Diurna','Nocturna'],
      triggerAction: 'all',
      forceSelection: true,
      editable: false,
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
 
    var tfmodalidad = new Ext.form.ComboBox({
      id: 'tfmodalidad',
      fieldLabel: 'Modalidad',
      name: 'modalidad',
      mode: 'local',
      store: ['Presencial','A distancia'],
      triggerAction: 'all',
      forceSelection: true,
      editable: false,
      allowBlank: false,
      blankText: 'Este campo es obligatorio'
    });
    //FIN
    
    
   var recvalordiferenciado = Ext.data.Record.create([
      {name : 'periodo', type : 'int'},                  
      {name : 'valor',  type : 'float'}  
    ]);
    
    var stvalordiferenciado = new Ext.data.SimpleStore({
      fields:[
        {name : 'periodo', type : 'int'},
        {name : 'valor',  type : 'float'}
      ]      
    });
    
    var cmvalordiferenciado = new Ext.grid.ColumnModel([
      {id : 'periodo', header : 'Periodo', dataIndex : 'periodo', width : 100},
      {header : 'Valor', dataIndex : 'valor', width : 100, editor : 
        new Ext.form.NumberField({
          allowDecimals  : true,
          allowNegative  : false,
          nanText        : 'Solo se permiten numeros',
          minValue       : 0
        })
      } 
    ]);
    

    /*
    * Funcion encargada de cargar la informacion de la base de datos al formulario mediante 
    * el uso del objeto  (datosInformacionGeneral)
    */
    function loadInformGeneral()
    {
      //se encarga de establecer los campos que ya han sido diligenciados por el usuario
      
      ///Inicio los campos manejados por el servidor
      tfsolicitudnumero.setValue(datosInformacionGeneral.solicitudnumero);
      tfsolicitudfecha.setValue(datosInformacionGeneral.fechasolicitud);      
      tfsolicitante.setValue(datosInformacionGeneral.solicitante);
      
      tffacultad.setValue(datosInformacionGeneral.facultad);
      tfescuela.setValue(datosInformacionGeneral.escuela);
      
      //cargar los campos previamente ingresados por el usuario
      if(datosInformacionGeneral.isActualizar)
      {
        tfingid.setValue(datosInformacionGeneral.ing_id);
        tfnombreprograma.setValue(datosInformacionGeneral.nombreprograma);
        tftitulootorga.setValue(datosInformacionGeneral.titulootorga);
        tfmotivosolicitud.setValue(datosInformacionGeneral.motivosolicitud);
        tfcualmotivosolicitud.setValue(datosInformacionGeneral.cualmotivosolicitud);
        tfciudadsede.setValue(datosInformacionGeneral.ciudadsede);
        tfnivelacademico.setValue(datosInformacionGeneral.nivelacademico);
        
        tfduracionprograma.setValue(datosInformacionGeneral.duracionprograma);
        tfduracionprograma.disable();//este campo no se puede modificar
        
        tfjornada.setValue(datosInformacionGeneral.jornada);
        tfmodalidad.setValue(datosInformacionGeneral.modalidad);
        
        Ext.getCmp('cboxmodopago').setValue(datosInformacionGeneral.mododepago);
        Ext.getCmp('cboxmodopago').disable();
        
        if(datosInformacionGeneral.mododepago!='Valor Diferenciado')
        {
          Ext.getCmp('tfopcionespagoperiodo').setValue(datosInformacionGeneral.opcionespagoperiodo);
          Ext.getCmp('tfvalordiferenciadosmmlv').setValue(datosInformacionGeneral.valorunico);
          
          //aqui mostrar el fieldset
          Ext.getCmp('fsvalorunico').setVisible(true); //muestro el fieldset
          Ext.getCmp('fsvalorunico').doLayout(); //aplico el layout nuevamente
          
        }else{
        
          Ext.each(datosInformacionGeneral.valoresDiferenciados, function(record){
            //agrego uno por uno los rejistros a la tabla 
            stvalordiferenciado.add(new recvalordiferenciado({
              periodo : record.periodo,
              valor   : record.valor
            }));
          });
          
          //mostrar el grid 
          Ext.getCmp('gridvaldiferenciado').setVisible(true); //muestro el grid 
          Ext.getCmp('gridvaldiferenciado').doLayout(); // aplico el layout nuevamente al grid
        }
        
      }

  
    }
        
    //Formulario que contiene los campos para el ingreso de la informacion general de una solicitud
    var formInformacionGeneral = new Ext.form.FormPanel({
      url       : '".URL_SASPA."direccion_dev.php/solicitud/informacionGeneral',
      title     : 'Informacion General',
      id        : 'formInfoGeneral',
      frame     : true,
      height    : 500,
      autoWidth : true,
      bodyStyle : 'padding:5px 5px 0', 
      items     : [
        {
          layout   : 'column',
          defaults : {
            layout : 'form',
            xtype  : 'panel'
          },
          items    : [
            {
              columnWidth : 0.7,
              items       : [
                {//fecha y numero de solicitud
                  layout   : 'column',
                  defaults : {
                    layout      : 'form',
                    columnWidth : 0.5,
                    bodyStyle   : 'padding:0 18px 0 0',
                  },
                  items    : [
                    {
                      defaults : { anchor : '100%'},
                      items    : tfsolicitudfecha
                    },
                    {
                      defaults : {anchor:'90%'},
                      items    : tfsolicitudnumero
                    }
                  ]
                },
                tfingid, //este campo almacena el id del formulario cuando se trata de una actualizacion
                tfsolicitante,
                tffacultad,
                tfescuela,
                tfnombreprograma,
                tftitulootorga,
                {
                  layout   : 'column',
                  defaults : {
                    columnWidth : 0.5,
                    bodyStyle   : 'padding:0 18px 0 0',
                    layout      : 'form' 
                  },
                  items    : [
                    {
                      defaults : { anchor : '100%'},
                      items    : tfmotivosolicitud
                    },
                    {
                      defaults : {anchor:'90%'},
                      items    : tfcualmotivosolicitud 
                    }
                  ]   
                },{
                  layout   : 'column',
                  defaults : {
                    layout      : 'form',
                    columnWidth : 0.5,
                    bodyStyle   : 'padding:0 18px 0 0'
                  },
                  items : [
                    {
                      defaults : { anchor : '100%'},
                      items    : tfnivelacademico
                    },
                    {
                      defaults : { anchor : '90%'},
                      items    : tfciudadsede
                    }
                  ]                  
                  
                },{
                  layout   : 'column',
                  defaults : {
                    layout      : 'form',
                    columnWidth : 0.33,
                    bodyStyle   : 'padding:0 18px 0 0'
                  },
                  items : [
                    {
                      defaults : { anchor : '100%'},
                      items    : tfduracionprograma
                    },
                    {
                      defaults : { anchor : '100%'},
                      items    : tfmodalidad
                    },
                    {
                      defaults : { anchor : '90%'},
                      items    : tfjornada
                    }
                  ]                  
                  
                } 

              ]
            }, 
            {
              columnWidth : 0.3,
              items       : [
                {
                  xtype : 'combo',
                  id             : 'cboxmodopago',
                  fieldLabel     : 'Forma de pago',
                  name           : 'mododepago',
                  mode           : 'local',
                  store          : ['Valor Unico','Valor Diferenciado'],
                  triggerAction  : 'all',
                  forceSelection : true,
                  editable       : false,
                  allowBlank     : false,
                  blankText      : 'Este campo es obligatorio',
                  anchor         : '90%',
                  
                  //Aqui se muestran y ocultan los campos cuando se seleciona una forma de pago
                  listeners      : { 
                    select : function (cbox,rec,i){
                      if(cbox.getValue() == 'Valor Unico'){
                        Ext.getCmp('fsvalorunico').setVisible(true); //muestro el fieldset
                        Ext.getCmp('fsvalorunico').doLayout(); //aplico el layout nuevamente
                        Ext.getCmp('gridvaldiferenciado').setVisible(false); //oculto la grid 
                        tfduracionprograma.setDisabled(false);//activo el campo numero de periodos
                        
                        Ext.getCmp('tfopcionespagoperiodo').allowBlank = false;
                        Ext.getCmp('tfvalordiferenciadosmmlv').allowBlank = false;
                        Ext.getCmp('tfvalordiferenciadosmmlv').setDisabled(false);
                        Ext.getCmp('tfopcionespagoperiodo').setDisabled(false);
                      }else{
                        Ext.getCmp('gridvaldiferenciado').setVisible(true); 
                        Ext.getCmp('gridvaldiferenciado').doLayout(); 
                        Ext.getCmp('fsvalorunico').setVisible(false); 
                        poblarGridValorDiferenciado(); //llamado a la funcion encargada de llenar la grid
                        tfduracionprograma.setDisabled(true); //desactivo el campo numero de periodos
                        
                        //hacer que los campos del fieldset no sean obligatorios para llenar
                        Ext.getCmp('tfopcionespagoperiodo').allowBlank = true;
                        Ext.getCmp('tfvalordiferenciadosmmlv').allowBlank = true;
                        Ext.getCmp('tfvalordiferenciadosmmlv').setDisabled(true);
                        Ext.getCmp('tfopcionespagoperiodo').setDisabled(true);
                      }
                    }
                  }
                },
                {
                  xtype      : 'fieldset',
                  hidden     : true,
                  title      : 'Valor unico',
                  id         : 'fsvalorunico',
                  autoWidth  : true,
                  autoHeight : true,
                  items      : [
                    new Ext.form.ComboBox({
                            id             : 'tfopcionespagoperiodo',
                            fieldLabel     : 'Pago',
                            name           : 'opcionespagoperiodo',
                            mode           : 'local',
                            store          : ['Semestral','Anual','Total carrera', 'Creditos'],
                            triggerAction  : 'all',
                            forceSelection : true,
                            editable       : false,
                            //allowBlank     : false,
                            blankText      : 'Este campo es obligatorio',
                            anchor         : '90%'
                    }),
                    new Ext.form.NumberField({
                            id             : 'tfvalordiferenciadosmmlv',
                            fieldLabel     : 'Valor (SMMLV)',
                            name           : 'valorunico',
                            allowDecimals  : true, 
                            allowNegative  : false, 
                            minValue       : 0,
                            nanText        : 'Solo se permiten numeros',
                            //allowBlank     : false,
                            blankText      : 'Este campo es obligatorio',
                            anchor         : '90%'
                     }) 
                  ]
                },//fin cierra el fielset
                {
                  xtype            : 'editorgrid',
                  id               : 'gridvaldiferenciado',
                  store            : stvalordiferenciado ,
                  cm               : cmvalordiferenciado ,
                  title            : 'Valor Diferenciado en SMMLV',
                  clicksToEdit     : 1,
                  autoWidth        : true,
                  autoHeight       : true,
                  viewConfig       : {
                    forceFit : true
                  },
                  autoExpandColumn : 'periodo',
                  hidden           : true 
                }
              ]
            }//los campos para especificar la forma de pago
            
          ]//dentro de esta eteq van los primeros campos del formulario
        }
      ],
      buttons   : [{text : 'Salir', handler : enviarSalir},{text: 'Siguiente', handler : enviarSiguiente}]
    });
    
    
    //agregar la escucha (listener) al formulario para el evento
    //evento Ext.form.FormPanel beforerender : ( Ext.Component this ) antes de renderizar el panel o
    //evento Ext.form.FormPanel beforeshow : ( Ext.Component this ) antes de mostrar el panel 
    // render 
    formInformacionGeneral.on('render',loadInformGeneral);
    
    function enviarSiguiente()
    {
      
      if(formInformacionGeneral.getForm().isValid())
      {
        Ext.Msg.show({
		    title:'Confirmacion',
			 msg: 'El campo duracion de programa no se podra modificar una vez registrado ¿Esta seguro que el valor del campo es correcto?',
			 buttons: Ext.Msg.YESNO,
			 fn: function (btn){
			   if(btn == 'yes')
			   {
              ///Metodo para hacer el envio de los datos del formulario formInformacionGeneral al servidor
              //construir el arreglo de rejistros para guardar en la base de datos
              var valoresxperiodo = [];//almacena la lista de valores para cada periodo
              var gridvalordif = Ext.getCmp('gridvaldiferenciado'); 
              if(gridvalordif.isVisible())
              { 
                var modificados = gridvalordif.getStore().getModifiedRecords();
                Ext.each(modificados , function (record){
                  valoresxperiodo.push(record.data); //almaceno la informacion de los rejistro modificados 
                });
              }
              
              tfduracionprograma.enable();
              tfsolicitudfecha.enable();
              tfsolicitante.enable();
              tffacultad.enable();
              tfescuela.enable();
              tfsolicitudnumero.enable();
              
              formInformacionGeneral.getForm().submit({
                method    : 'POST',
                waitTitle : 'Enviando',
                waitMsg   : 'Enviando datos...',
                params    : {
                  valoresDiferenciados : Ext.encode(valoresxperiodo)
                  //aqui hacer el envio de los codigos de las correspondientes 
                  //facultad y dependencia/escuela MODIFICAR AQUI
                },
                success   : function(form, action)
                {
                  var response = action.result; //la respuesta del servidor decodificada
                  
                  //despliega el formulario extructura curricular
                  actualizarPanel('central',response.urlFormulario);//esta funcion no esta definida aqui
                },
                failured: function(form, action)
                {
                  Ext.Msg.alert('WARNING','Ocurrio un error mientras se procesaba la solicitud');
                  tfsolicitudfecha.disable();
                  tfsolicitante.disable();
                  tffacultad.disable();
                  tfescuela.disable();
                  tfsolicitudnumero.disable();
                }
              });
			   }					            
			 },
			 icon: Ext.MessageBox.QUESTION
		  });
        
      }else{
        Ext.Msg.alert('INFORM','Ningun campo debe quedar basio');
      }
       
    }
    
    //actualizar el area central del panel con el formulario de las solicitudes
    function enviarSalir()
    {
      Ext.Msg.alert('Salir','Para salir  presione el submenu Solicitudes a la izquierda, se perderan los cambios'); 
    }

    function poblarGridValorDiferenciado()
    {
      var periodos =  tfduracionprograma.getValue(); //obtengo el numero de periodos ingresado por el usuario
      stvalordiferenciado.removeAll();
      if( periodos > 0){
        while(periodos > 0)
        {
          //agrego 1 fila por cada periodo
          stvalordiferenciado.insert(0, new recvalordiferenciado({
            periodo : periodos--,
            valor   : 0.0
          }));
        }
        Ext.getCmp('gridvaldiferenciado').startEditing(0,1)//inicio la edicion en la primera fila columna 2
      } 
    }
    
    Saspa.InformacionGeneral = new Ext.Panel({
        renderTo: 'informacionGeneral',
        layout:   'column',
        style:    'width: 100%; height: 100%;',

        frame  : false,
        border : false,
        
        fitToFrame: true,
        items: [ 
          {columnWidth : 1 ,width: '100%', height: '100%', frame: true, autoScroll: true, items:[formInformacionGeneral]}
        ]
      });
         
    Saspa.InformacionGeneral.render();
    
    
  ");
?>