<?php
echo  '<div  id= "menuDaca"></div>';

echo  use_helper('Javascript');
echo  javascript_tag("

    var json = 
    [{
        text:'Daca',
        id:'inicioGestorPlan',
        draggable:false,
        expanded:true,
        iconCls:'icon-cmp',
        name: 'admon',
        children:[
        {
            id : 'consultar',
            tabType:'load',
            text:'Consultar solicitudes',
            draggable:false,
            iconCls:'menu_clientes',
            leaf:true,
            disabled:false
        },{
            id : 'emitidos',
            tabType:'load',
            draggable:false,
            text:'Conceptos emitidos',
            iconCls:'menu_facturas',
            leaf:true,
        },{
            id : 'estadisticas',
            tabType:'load',
            draggable:false,
            text:'Estadisticas',
            iconCls:'menu_facturas',
            leaf:true,
        }]
    }];


    Saspa.Enlaces = new Ext.Panel({
        renderTo: 'menuDaca',
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
                        } else if (node.attributes.id == 'consultar') {
                           actualizarPanel('central','".URL_SASPA."daca.php/solicitud/consultar');
                        } else if(node.attributes.id == 'emitidos')
                        {
                        	actualizarPanel('central','".URL_SASPA."daca.php/solicitud/conceptos');
                        }else {
                          var nodo = node.attributes.id;
                          //actualizarPanel('central','".URL_SASPA."daca.php/'+nodo+'/'+nodo);
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