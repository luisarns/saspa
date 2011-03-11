<?php
echo  '<div  id="menuDirector" ></div>';

echo  use_helper('Javascript');
echo  javascript_tag("

    var json = 
    [{
        text:'Director de Programa',
        id:'inicioGestorPlan',
        draggable:false,
        expanded:true,
        iconCls:'icon-cmp',
        name: 'admon',
        children:[
        {
            id : 'solicitudes',
            tabType:'load',
            text:'Solicitudes',
            draggable:false,
            //iconCls:'menu_clientes',
            leaf:true
        },{
            id : 'simulacion',
            tabType:'load',
            draggable:false,
            text:'Simulacion',
            //iconCls:'menu_facturas',
            leaf:true,
        },{
            id : 'estadisticas',
            tabType:'load',
            draggable:false,
            text:'Estadisticas',
            //iconCls:'menu_facturas',
            leaf:true,
        }]
    }];


    Saspa.Enlaces = new Ext.Panel({
        renderTo: 'menuDirector',
        border:true,
        //region:'west',
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
                            actualizarPanel('central','".URL_SASPA."direccion_dev.php/solicitud/solicitudes');
                        } else if (node.attributes.id == 'simulacion') {
                            actualizarPanel('central','".URL_SASPA."direccion_dev.php/simulacion/index');
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