Ext.ns('SUE');
        var xg = Ext.grid;

        var datos_IC1_2007_sue = new Ext.data.JsonStore({
            url: '".URL_SIPI."indicadores.php/presentacion/ListaDatosIC1',
            root: 'datos',
            totalProperty: 'total',
            fields: [
                {name:'id'},
                {name:'tipo_vinculacion'},
                {name:'nombre'},
                {name:'cc'},
                {name:'maximo_nivel_formacion'},
                {name:'unidad_academica'},
                {name:'dedicacion_numero_horas'},
                {name:'periodo'},
                {name:'responsable'}
            ]
        });

        var reporte_IC1_2007_sue = new Ext.data.JsonStore({
            url: '".URL_SIPI."indicadores.php/presentacion/ListaDatosIC1/sue_id/ic1_reporte',
            root: 'datos',
            totalProperty: 'total',
            fields: [
                {name:'id'},
                {name:'item'},
                {name:'valor1'},
                {name:'valor2'},
                {name:'valor3'},
                {name:'valor4'}
            ]
        });

        var lista_reporte_sue = new Ext.grid.GridPanel({
            frame: true,
            store: reporte_IC1_2007_sue,
            cm: new Ext.grid.ColumnModel([
                {header: 'Nivel de Formacion', width: 450, sortable: true, dataIndex: 'item', tooltip: 'Nivel de Formacion'},
                {header: '2003', width: 50, sortable: false, dataIndex: 'valor1', tooltip: '2003'},
                {header: '2004', width: 50,  sortable: false, dataIndex: 'valor2', tooltip: '2004'},
                {header: '2005', width: 50,  sortable: false, dataIndex: 'valor3', tooltip: '2005'},
                {header: '2006', width: 50,  sortable: false, dataIndex: 'valor4', tooltip: '2006'},
            ]),
            title:'Reporte 2 Resultados IC1',
            height:300,
            iconCls:'icon-grid',
        });

        var toolbar_datos = new  Ext.Toolbar( {
            id:       'sue_toolbar_formatos',
            items:
            [{
                xtype:          'combo',
                fieldLabel:     'Periodo',
                valueField:     'id',
                displayField:   'periodo',
                hiddenName:     'id',
                store: new Ext.data.SimpleStore({
                    fields: ['id', 'periodo'],
                    data:
                    [
                        ['1', 'Periodo I'],
                        ['2', 'Periodo II'],
                    ]
                }),
                typeAhead:      true,
                editable:       false,
                forceSelection: true,
                mode:           'local',
                triggerAction:  'all',
                selectOnFocus:  true ,
                width:          120
            },
            {
                iconCls: 'exportar-xls',
                tooltip: 'Presione aqui para exportar los datos en formato .xls',
                style:   'margin-left:15px;'
//                 handler: SUE.mostrar_ventana_configurar_columnas
            },
            {
                iconCls: 'exportar-pdf',
                tooltip: 'Presione aqui para exportar los datos en formato .pdf',
                style:   'margin-left:10px;'
//                 handler: SUE.mostrar_ventana_configurar_columnas
            }]
        } );


        var grid_datos_IC1 = new Ext.grid.GridPanel({
            frame: true,
            store: datos_IC1_2007_sue,
            cm: new xg.ColumnModel([
                new xg.RowNumberer( {width:30}),
                {header: 'Tipo de vinculación', width: 110, sortable: true, dataIndex: 'tipo_vinculacion', tooltip: 'Tipo de vinculación'},
                {header: 'Nombre', width: 280, sortable: true, dataIndex: 'nombre', tooltip: 'NOMBRE'},
                {header: 'Cedula', width: 80, sortable: true, dataIndex: 'cc', tooltip: 'CEDULA'},
                {header: 'Max. Nivel Formacion', width: 150, sortable: true, dataIndex: 'maximo_nivel_formacion', tooltip: 'MAXIMO NIVEL DE FORMACION'},
                {header: 'Unidad Academica', width: 280, sortable: true, dataIndex: 'unidad_academica', tooltip: 'UNIDAD ACADEMICA'},
                {header: 'Dedicacion', width: 70, sortable: true, dataIndex: 'dedicacion_numero_horas', tooltip: 'DEDICACION O NUMERO DE HORAS'}
            ]),
            tbar: toolbar_datos,
            bbar: new Ext.PagingToolbar({
                pageSize: 50,
                store: datos_IC1_2007_sue,
                displayInfo: true,
                displayMsg: 'INFORMACION {0} - {1} de {2}',
                emptyMsg: 'No hay elementos para mostrar',
            }),
            width:900,
            height:500,
            title:'Reporte 1 Soporte IC1',
            iconCls:'icon-grid',
//             listeners: {activate: handleActivate},
        });
        
        var tabs_reporte_sue = new Ext.TabPanel({
            title: 'Tab Panel',
            activeTab: 0,
            width:500,
            height:500,
            plain:true,
            defaults:{autoScroll: true},
            items:[
                grid_datos_IC1,
                lista_reporte_sue,
            ]
        });
/*
        function handleActivate(tab){
            reporte_IC1_2007_sue.load();
        }*/

        SUE.st_indicadores = new Ext.data.JsonStore( {
            url:  '".URL_SIPI."indicadores.php/presentacion/ListaSUE',
            root: 'indicadores',
            sortInfo: {
                          field:    'sue_identificador',
                          Direction:'DESC'
                      },
            fields: 
            [
                { name:'sue_identificador', type: 'string' },
                { name:'sue_titulo', type: 'string' },
                { name:'sue_descripcion', type: 'string' },
                { name:'sue_version', type: 'string' },
                { name:'sue_anhio', type: 'string' },
            ]
        } );
        SUE.st_indicadores.load({params: {cat_sue: categoria_sue }});

        SUE.lista_ind_cm =  new Ext.grid.ColumnModel( [
             {
                 id:        'sue_identificador',
                 resizable: true, 
                 header:    'Id',
                 sortable:  true, 
                 dataIndex: 'sue_identificador',
                 width:     35
             },
             {
                 id:        'sue_titulo',
                 resizable: true, 
                 header:    'Nombre',
                 sortable:  true, 
                 dataIndex: 'sue_titulo'
             }
        ] );

        SUE.lista_indicadores = new Ext.grid.GridPanel( {
                    autoScroll: true,
                    title:      'Indicadores',
                    store:      SUE.st_indicadores,
                    width:      270,
                    height:     220,
                    cm:         SUE.lista_ind_cm,
//                     style:      'text-transform: lowercase',
                    view: new Ext.grid.GridView( {
                            forceFit:     true,
                            columnsText:  'Columnas',
                            sortAscText:  'Ordenar  Ascendentemente',
                            sortDescText: 'Ordenar Descendentemente'
                    } ),
                    sm: new Ext.grid.RowSelectionModel({
                        singleSelect: true,
                        listeners: 
                        {
                            rowselect: function(sm, row, rec) {
                            ind_sue = rec.get('sue_identificador');
                            var panel_info_sue = Ext.getCmp('panel_info_sue');
                            tpl_inf_sue.overwrite(panel_info_sue.body, rec.data);
                            if (ind_sue=='ic1') {
                                reporte_IC1_2007_sue.load();
                                datos_IC1_2007_sue.load({params: {sue_id: ind_sue, start:0, limit:50 }});
                                Ext.getCmp('sue_presentacion_derecho').show();
                                tabs_reporte_sue.render('sue_presentacion_derecho_interno');
                           }
//                         ind_sue = 'ic1_reporte',
//                         datos_IC1_2007_sue.load({params: {sue_id: ind_sue}});
                    }
                  }
                }),
        } );
        SUE.lista_indicadores.setTitle('Indicadores de '+cat_sue_nom);
        datos_IC1_2007_sue.on('beforeload', function() {
            datos_IC1_2007_sue.baseParams.sue_id = ind_sue;
        });


        var info_ind_sue = [
            '<B>Identificador:</B> {sue_identificador}<br/>',
            '<B>Titulo:</B>        {sue_titulo}<br/>',
            '<B>Descripci&oacute;n:</B>   {sue_descripcion}<br/>',
            '<B>Versi&oacute;n:</B>       {sue_version}'
        ];
        var tpl_inf_sue = new Ext.Template(info_ind_sue);

        SUE.contenedor_presentacion_sue = new Ext.Panel( {
            width:      1024,
            height:     700,
            id:         'principal',
            border:     false,
            autoScroll: true,
            frame:      true,
            layout:     'column',
            fitToFrame: true,
            items: 
            [{
                frame: true,
                width: 280,
                items:
                [
                    SUE.lista_indicadores,
                    {
                        id: 'panel_info_sue',
                        region: 'center',
                        frame: true,
                        bodyStyle: 
                        {
                            background: '#ffffff',
                            padding: '7px'
                        },
                        html: 'Seleccione un indicador.'
                    }
                ]
            },
            {
                hidden:     true,
                id:         'sue_presentacion_derecho',
                name:       'sue_presentacion_derecho',
                autoScroll: true,
                items:
                [{
                    xtype: 'panel',
                    id:    'sue_presentacion_derecho_interno',
                    width:      725,
                    autoScroll: true,
                }]
            }]
        } );
//         SUE.contenedor_presentacion_sue.render('presentacio_sue');