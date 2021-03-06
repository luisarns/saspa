Ext.namespace('Saspa.parametros');

Saspa.parametros.parametros = {
  init : function() {
    
    var parmStore = new Ext.data.JsonStore({
      url    : URL_SASPA+'administracion.php/parametros/listarParametros',
      root   : 'datos',
      fields : [
	{name : 'paraNombre'},
	{name : 'paraAno'},
	{name : 'paraValor', type : 'float'}
      ]
    });
    
    parmStore.load();
    
    var parmColModel = new Ext.grid.ColumnModel([
      { header : "Nombre", dataIndex : 'paraNombre', sortable : true },
      { header : "Año",    dataIndex : 'paraAno',    sortable : true },
      { header : "Valor",  dataIndex : 'paraValor',  sortable : true, renderer : Ext.util.Format.usMoney }
    ]);
    
    var parmSelModel = new Ext.grid.RowSelectionModel({
      singleSelect : true,
      listeners : {
	rowselect : function(sm,row,rec) {
	  parmForm.getForm().loadRecord(rec);
	  Ext.getCmp('parm_nombre').disable();
	  Ext.getCmp('oper_id').setValue('act');
	}
      }
    });
    
    var parmTbar = [
      {
	text    : 'Nuevo',
	cls     : 'x-btn-text-icon',
	icon    : '../images/table_row_insert.png',
	handler : this.onCrear
      }
    ]
    
    
    var parmGrid = new Ext.grid.GridPanel({
      id         : 'gridParametros',
      store      : parmStore,
      colModel   : parmColModel,
      sm         : parmSelModel,
      title      : 'Lista Parametros',
      tbar       : parmTbar,
      
      autoScroll : true,
      frame      : true,
      height     : 250
    });
    
    var fecha_actual = new Date();
    
    var parmForm = new Ext.form.FormPanel({
      id    : 'formParametros',
      title : 'Formulario parametros',
      url   : URL_SASPA+'administracion_dev.php/parametros/parametros',
      frame : true,
      items : [
	{
	  xtype      : 'combo',
	  fieldLabel : 'Nom. Parametro',
	  name       : 'paraNombre',
	  id         : 'parm_nombre',
	  mode       : 'local',
	  store      : [
	    'Salario minimo',
	    'Hora secretaria',
	    'Hora auxiliar',
	    'Hora monitor',
	    '(%) Prestaciones x año'
	  ],
	  triggerAction  : 'all',
	  forceSelection : true,
	  editable       : false,
	  allowBlank     : false
	},
	{
	  xtype      : 'textfield',
	  fieldLabel : 'Año',
	  name       : 'paraAno',
	  id         : 'parm_ano',
	  allowBlank : false,
	  disabled   : true,
	  value      : fecha_actual.getFullYear()
	},
	{
	  xtype      : 'textfield',
	  fieldLabel : 'Valor',
	  name       : 'paraValor',
	  allowBlank : false
	},
	{
	  xtype : 'hidden',
	  name  : 'operacion',
	  id    : 'oper_id',
	  value : 'cre'
	}
      ],
      buttonAlign : 'center',
      buttons : 
      [
	  { text : 'Guardar', handler : this.onEnviar }
      ]
    });
    
    
    var pDecersion = new Ext.Panel(
    {
      renderTo   : 'gestParametros',
      layout     : 'column',
      width      : '100%',
      autoHeight : true,
      autoScroll : true,  
      title      : 'Gestionar parametros',
      frame      : true,
      items      : [
	{ columnWidth : 0.5,  items : [parmGrid] },
	{ columnWidth : 0.45, items : [parmForm] }
      ]
    });
    
    
    
  },
  onCrear  : function(btn,evt){
    Ext.Msg.alert('Informe','Crear un parametro');
    Ext.getCmp('formParametros').getForm().reset();
    Ext.getCmp('parm_nombre').enable();
    Ext.getCmp('oper_id').setValue('cre');
  },
  onEnviar : function(btn,evt) {
    var fm = Ext.getCmp('formParametros');
    
    //Activo los campos para que sean enviados automaticamente en el submit 
    //del formulario
    Ext.getCmp('parm_ano').enable();
    Ext.getCmp('parm_nombre').enable();
    if(fm.getForm().isValid())
    {
      fm.getForm().submit({
	method    : 'POST',
	waitTitle : 'Enviando',
	waitMsg   : 'Enviando Datos...',
	success   : function(fm,act) {
	  
	  Ext.Msg.alert('Mensaje',act.result.msg);
	  if(act.result.success)
	  {
	    Ext.getCmp('gridParametros').getStore().reload();
	    fm.reset();
	    Ext.getCmp('parm_ano').disable();
	  }
	  
	},
	failured  : function(fm,act) {
	      Ext.Msg.alert('ERROR','Ocurrio un error mientras se enviaba la informacion');
	}
      });
    } else {
      Ext.Msg.alert('INFORM','Los campos en rojo son obligatorios');
    }
    
  }

}
Ext.onReady(Saspa.parametros.parametros.init,Saspa.parametros.parametros);