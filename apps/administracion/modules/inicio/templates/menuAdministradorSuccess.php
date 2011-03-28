<?php
echo  '<div  id= "menuAdministrador"></div>';

echo  use_helper('Javascript');
echo  javascript_tag("

    var json = 
    [
	    {
	        text:'Administración',
	        id:'administracion',
	        draggable:false,
	        expanded:true,
	        iconCls:'icon-cmp',
	        name: 'admon',
	        children:[
		        {
		            id : 'usuarios',
		            tabType:'load',
		            text:'Usuarios',
		            draggable:false,
		            leaf:true
		        }
	        ]
	    },{
	        text:'Parametros',
	        id:'parametros',
	        draggable:false,
	        expanded:true,
	        iconCls:'icon-cmp',
	        name: 'param',
	        children:[
		        {
			   id        : 'tabla_facultad',
		           tabType   : 'load',
		           draggable : false,
		           text      : 'Facultades',
	       		   leaf      : true
		        },
			{
		            id : 'tabla_docentes',
		            tabType:'load',
		            draggable:false,
		            text:'Docentes',
		            leaf:true
		        },
		        {
		            id : 'tabla_desercion',
		            tabType:'load',
		            draggable:false,
		            text:'Deserción',
		            leaf:true
		        },
		        {
		            id : 'tabla_matricula',
		            tabType:'load',
		            draggable:false,
		            text:'Matricula pregrado',
		            leaf:true
		        },
		        {
		            id : 'tabla_independientes',
		            tabType:'load',
		            draggable:false,
		            text:'Independientes',
		            leaf:true
		        }
	        ]
	    }
    ];
    

    Saspa.Enlaces = new Ext.Panel({
        renderTo: 'menuAdministrador',
        border: true,
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
                        } else if (node.attributes.id == 'usuarios') {
                            actualizarPanel('central','".URL_SASPA."administracion.php/usuarios/usuarios');
                        }
                        
                        if (node.attributes.name == 'param') {
                        }else if(node.attributes.id == 'tabla_docentes')
                        {
                        	 actualizarPanel('central','".URL_SASPA."administracion.php/parametros/index');
                        }else if(node.attributes.id == 'tabla_desercion')
                        {
                        	actualizarPanel('central','".URL_SASPA."administracion.php/parametros/desercion');
                        }else if(node.attributes.id == 'tabla_facultad')
                        {                        
                        	actualizarPanel('central','".URL_SASPA."administracion.php/parametros/facultad');
                        }else if(node.attributes.id == 'tabla_matricula')
			{
                        	actualizarPanel('central','".URL_SASPA."administracion.php/parametros/matricula');
			}else if(node.attributes.id == 'tabla_independientes')
			{
				actualizarPanel('central','".URL_SASPA."administracion.php/parametros/parametros');
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
