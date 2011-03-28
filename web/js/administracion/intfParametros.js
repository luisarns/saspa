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
      { header : "Valor",  dataIndex : 'paraValor',  sortable : true }
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
	    'Salario secretaria',
	    'Salario auxiliar',
	    'Salario monitor',
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
	  value      : Date('Y')
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
  onEnviar : function(btn,evt){
    Ext.Msg.alert('Informe','Enviar la informacion');
  }

}
Ext.onReady(Saspa.parametros.parametros.init,Saspa.parametros.parametros);