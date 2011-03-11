<?php
echo  '<div  id= "menuCoordinador"></div>';

echo  use_helper('Javascript');
echo  javascript_tag("

    var json = 
    [{
        text:'Coordinador de Area',
        id:'inicioGestorPlan',
        draggable:false,
        expanded:true,
        iconCls:'icon-cmp',
        name: 'admon',
        children:[
        {
            id : 'consultar',
            tabType:'load',
            text:'Consultar',
            draggable:false,
            iconCls:'menu_clientes',
            leaf:true,
            disabled:false
        },{
            id : 'revisar',
            tabType:'load',
            draggable:false,
            text:'Revisar concepto',
            iconCls:'menu_facturas',
            leaf:true,
        },{
            id : 'estadisticas',
            tabType:'load',
            draggable:false,
            text:'Estadisticas',
            iconCls:'menu_facturas',//cambiar por iconos alucibos
            leaf:true,
        }]
    }];


    Saspa.Enlaces = new Ext.Panel({
        renderTo: 'menuCoordinador',
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
                            actualizarPanel('central','".URL_SASPA."coordinacion_dev.php/solicitud/consultar');
                        } else if (node.attributes.id == 'revisar') 
                        {
                        	actualizarPanel('central','".URL_SASPA."coordinacion_dev.php/solicitud/revisar');
                        } else {
                          var nodo = node.attributes.id;
                          //actualizarPanel('central','".URL_SASPA."coordinacion_dev.php/'+nodo+'/'+nodo);
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