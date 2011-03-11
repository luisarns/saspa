<?php
echo  '<div  id= "menuAnalisis"></div>';

echo  use_helper('Javascript');
echo  javascript_tag("

    var json = 
    [{
        text:'OPDI Analisis',
        id:'inicioGestorPlan',
        draggable:false,
        expanded:true,
        iconCls:'icon-cmp',
        name: 'admon',
        children:[
        {
            id : 'solicitudes',
            tabType:'load',
            text:'Consultar solicitudes',
            draggable:false,
            iconCls:'menu_clientes',
            leaf:true,
            disabled:false
        },{
            id : 'revisar',
            tabType:'load',
            draggable:false,
            text:'Revisar solicitudes',
            iconCls:'menu_facturas',
            leaf:true,
        },{
            id : 'emitidos',
            tabType:'load',
            draggable:false,
            text:'Conceptos emitidos',
            iconCls:'menu_facturas',
            leaf:true,
        }]
    }];


    Saspa.Enlaces = new Ext.Panel({
        renderTo: 'menuAnalisis',
        border:true,
        region:'west',
        style: 'width:100%;',
        titlebar: true,
        collapsible:true,
        items:[
            {
                cls:'ct',
            },
            {
                xtype:'treepanel',
                iconCls:'nav',
                rootVisible:false,
                lines:true,
                draggable:false,
                containerScroll:true,
                singleExpand:false,
                useArrows:true,
                enableDD:true,
                listeners:{
                    click: function(node) 
                    {
                        if (node.attributes.name == 'admon') { 
                        } else if (node.attributes.id == 'solicitudes') {
                            actualizarPanel('central','".URL_SASPA."analisis.php/solicitud/consultar');
                        
                        } else if(node.attributes.id == 'revisar'){
                            actualizarPanel('central','".URL_SASPA."analisis.php/solicitud/revisarSolicitudes');
                        
                        }else if(node.attributes.id =='emitidos'){
                        		actualizarPanel('central','".URL_SASPA."analisis.php/solicitud/emitidos');
                        }else {
                          var nodo = node.attributes.id;
                          Ext.Msg.alert('(Y)','Esta funcion no esta definida');
                        }
                    }
                },
                selectable:true,
                singleSelect:true,
                root: new Ext.tree.AsyncTreeNode({
                    expanded:true,
                    text: 'Autos',
                    draggable:false,
                    id: 'source',
                    children: json,
                }),
                layoutConfig:
                {
                    animate:true
                }
            }
        ]
    });

    Saspa.Enlaces.render();

");
?>