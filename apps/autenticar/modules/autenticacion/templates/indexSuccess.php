<?php
    javascript_include_tag('usuarios/usuarios.js');
    
    echo use_helper('Javascript');
    echo javascript_tag("
              
      Ext.ns('Saspa');
      Ext.QuickTips.init();
      Ext.BLANK_IMAGE_URL = '../../lib/extjs/resources/images/default/s.gif';
      
      
            Saspa.Window = Ext.extend(Ext.Viewport, {
              layout : 'border',
              frame  : true,
              border : true,
              autoScroll: true,
              initComponent:function() {
                Ext.apply(this,{
                  items:[
                    {
                        xtype  : 'panel',
                        region : 'north',
                        id     : 'norte',
                        cls    : 'titulo',
                        buttons:[
                        new Ext.Toolbar.Button({
                        text: 'Manual de ayuda',
                        frame: true,
                        handler: function(){
                          window.open('".URL_SASPA."archivos/manualSASPA-Final.pdf');
                        },
                        icon: '../images/pdf.png',
                        iconCls: 'x-btn-text-ico'
                        }),
                        new Ext.form.ComboBox({
                          xtype : 'combo',
                          id    : 'usu_combo_theme',
                          name  : 'idcombotheme',
                          forceSelection : true,
                          fieldLabel     : 'Tema',
                          editable       : false,
                          width          : '15',
                          triggerAction  : 'all',
                          store: [
                            ['peppermint','Rojo'],
                            ['gray','Gris'],
                            ['slate','Slate'],
                            ['blue','Azul']
                          ],
                          value: 'blue'
                        }),
                        new Ext.Toolbar.Button({
                          text     : 'Salir',
                          formBind : true,
                          frame    : true,
                          icon     : '../images/salir.png',
                          iconCls  : 'x-btn-text-ico',
                          id       : 'bt',
                          handler:function(){
                            Ext.MessageBox.confirm('Confirmar', 'Esta seguro de cerrar la cuenta?', function(btn, text){
                              if(btn == 'yes'){
                                var redirect = '".URL_SASPA."index.php/autenticacion/salir';
                                window.location = redirect;
                              }
                            });
                          }
                        }),
                        
                      ]
                    },
                    {
                        xtype       : 'panel',
                        border      : false,
                        title       : 'Menu',
                        id          : 'panelMenu',
                        region      : 'west',
                        style       : 'width:18%;',
                        split       : true, 
                        titlebar    : true,
                        collapsible : true,
                        frame       : true,
                        autoScroll  : true,
                        items       : [ { xtype:'panel', id:'menu', border:false } ]
                    },
                    {
                      region     : 'center',
                      xtype      : 'panel',
                      frame      : true, 
                      id         : 'panelCentral',
                      style      : 'width:100%;height:99%',
                      //fitToFrame : true,
                      autoScroll : true,
		      border     : false,
		      items      : [ { xtype : 'panel', id : 'central', border : false } ]
                    }
                    ]
                  });
                  
                  Saspa.Window.superclass.initComponent.apply(this, arguments);
                },
                afterRender:function() 
                {
                  Saspa.Window.superclass.afterRender.apply(this, arguments);
                  Ext.getCmp('usu_combo_theme').on('select', function(combo, record, indice){
                    var tema = Ext.getCmp('usu_combo_theme').getValue();
	            Ext.util.CSS.swapStyleSheet('theme','../css/extjs/resources/css/xtheme-'+tema+'.css');
                  });
                },
                resize: function( component, adjWidth, adjHeight, rawWidth, rawHeight )
                {
                  alert( component+', '+adjWidth+', '+adjHeight+', '+rawWidth+', '+rawHeight );
                }
              });
              
              var win = new Saspa.Window({
                name:'SASPA',
              });
              win.show();
              
              if ('".$urlMenu."' !=  '') {
                    actualizarPanel('menu',       '".$urlMenu."');
              } else {
                    Ext.getCmp('panelMenu').collapse(false);
                    Ext.getCmp('panelMenu').hide();
              }
              actualizarPanel('central',    '".$urlInicio."');
              
    ");
    // actualizarPanel() ESTA definido en global.js (IMPORTANTE) 
    //el panel con id = menu es un panel que esta como item del panel con id=panelMenu 
?>
