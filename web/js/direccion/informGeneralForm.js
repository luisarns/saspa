  Ext.form.Field.prototype.msgTarget = 'side'; //para desplegar los mensajes al lado derecho 
  
  //Ext.Msg.alert('Hola','Mundo');
  //definir cada uno de los formularios para la solicitid 
  
  
  //CAMPOS PARA EL FORMULARIO INFORMACION GENERAL
 var tfsolicitante = new Ext.form.TextField({//nombre y apellidos del solicitante (tabla: docentes)
    id: 'tfsolicitante',
    fieldLabel: 'Solicitante',
    name: 'solicitante',

    //para el posicionamiento dentro del formulario
    width: '90%',
    
    //config validacion 
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
  });
  
  /*
  dado que el identificador del solicitante ya esta en la solicitud y este formulario pertenece a una solicitud
  en la tabla informacion general debe ir el nombre y apellidos del solicitante en este campo y no su 
  identificador.
  */
   var tffacultad = new Ext.form.TextField({
    id: 'tffacultad',
    fieldLabel: 'Facultad',
    name: 'facultad',
    
    //para el posicionamiento dentro del formulario
    width: '90%',
    
    //config validacion 
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
  });
  
  var tfescuela = new Ext.form.TextField({
    id: 'tfescuela',
    fieldLabel: 'Escuela',
    name: 'escuela',
    
    //para el posicionamiento dentro del formulario
    width: '90%',
    
    //config validacion 
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
  });
  
  var tfnombreprograma = new Ext.form.TextField({
    id: 'tfnombreprograma',
    fieldLabel: 'Nombre programa',
    name: 'nombreprograma',
    
    //para el posicionamiento dentro del formulario
    width: '90%',
    
    //config validacion 
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
    id: 'tfciudadsede',
    fieldLabel: 'Ciudad sede',
    name: 'ciudadsede',
    mode: 'remote',
    store: new Ext.data.JsonStore({
      url: 'sedes.php',
      root:'datos',
      fields: ['ciudad']
    }),
    hiddenName: 'ciudad',
    displayField: 'ciudad',
    triggerAction: 'all',
    forceSelection: true,
    editable: false,
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
  }); 
  
   var tfnivelacademico = new Ext.form.ComboBox({
    id: 'tfnivelacademico',
    fieldLabel: 'Nivel acad&eacute;mico del programa',
    name: 'nivelacademico',
    mode: 'local',
    store: ['Tecnologico','Profesional','Especializacion','Doctorado'],
    triggerAction: 'all',
    forceSelection: true,
    editable: false,
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
  });

  //duracion del programa en semestres para este campo usar spinnerfield 
  var tfduracionprograma = new Ext.form.NumberField({
    id: 'tfduracionprograma',
    fieldLabel: 'Duraci&oacute;n programa (en semestres)',
    name: 'duracionprograma',
    emptyText: 'Digite el # de semestres',
    allowDecimals: false, 
    allowNegative: false, 
    maxValue: 20,
    minValue: 1,
    nanText: 'Solo se permiten numeros',
    allowBlank: false,
    blankText: 'Este campo es obligatorio'
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

  
   //tipo modalidad 
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


  var fpinformacionGeneral = new Ext.form.FormPanel({
    title: 'informacion General',
    id: 'tabinformaciongeneral',
    frame: true,
    //border: true,
    height: 600,
    width: 450,
    items:[
      tfsolicitante,
      tffacultad,
      tfescuela,
      tfnombreprograma,
      tftitulootorga,
      {
        layout: 'column',
        defaults:
        {
          columnWidth: 0.5,
          layout: 'form',
          border: false,
          bodyStyle:'padding:0 18px 0 0',
          xtype: 'panel'
        },
        items:[
         {
           defaults: {anchor:'100%'},
           items: [tfmotivosolicitud]
         },{
           defaults: {anchor:'96%'},
           items: [tfcualmotivosolicitud]
         }
        ]
      },
      tfciudadsede,
      tfnivelacademico,
      tfduracionprograma,
      tfjornada,
      tfmodalidad
    ],
    buttons:[{text: 'Salir'},{text: 'Siguiente'}]
  });