//Panel de botones para gestionar archivos
SUE.panel_botones_gestion_archivos = Ext.extend(Ext.Panel, {
    initComponent:function()
    {
        Ext.apply(this, {
            width:        220,
            height:       40,
            border:       false,
            bodyStyle:    'padding:5px',
            autoScroll:   true,
            layout:       'table', frame: true,
            layoutConfig:
            {
               columns:3
            },
            defaults:
            {
                bodyStyle: 'padding:3px;',
                style:     'margin:2px;'
            },
        } );
        SUE.panel_botones_gestion_archivos.superclass.initComponent.apply(this, arguments);
    }
} );
Ext.reg('botones_gestionar_archivos', SUE.panel_botones_gestion_archivos)
//Fin panel de botones para gestionar archivos

//Menu botones para modificar categorias
SUE.menu_categorias = new Ext.menu.Menu({
    id: 'sue_menu_categorias',
    items:
    [{
        text:    'Nueva categoria',
        iconCls: 'sue_icono_crear',
        handler: SUE.mostrar_ventana_crear_categoria
    },
    {
        text:    'Modificar categoria',
        iconCls: 'sue_icono_modificar',
        handler: SUE.mostrar_ventana_modificar_categoria
    }]
});

SUE.toolbar_categorias = new  Ext.Toolbar( {
    style: 'margin-bottom: 15px; border-bottom: 1px solid #99bbe8;',
    id:    'sue_toolbar_creacion_ind',
    items:
    [{
        text:    'Categorias SUE',
        id:      'sue_menu_categorias',
        tooltip: 'Aqui podrá crear nuevas categorias SUE y modificar los nombres de las categorias existentes',
        iconCls: 'sue_icono_menu',
        menu:    SUE.menu_categorias,
    }/*,
    '->',
    {
        iconCls: 'sue_icono_ayuda',
        tooltip: 'Aqui podrá encontrar información acerca de los campos que debe llenar para crear un indicador',
        handler: SUE.mostrar_ventana_ayuda_creacion_ind
    }*/]
} );
//Fin menu botones para modificar categorias

//Ventanas para crear y modificar categorias
SUE.ventana_crear_categoria = new Ext.Window( {
      id:          'crear_categoria',
      title:       'Categorias SUE', 
      resizable:   false,
      modal:       true,
      width:       400,
      height:      150,
      plain:       true,
      constrain:   true,
      layout:      'fit',
      closeAction: 'hide',
      items:
      [{
        xtype:      'fieldset',
        id:         'categoria_nueva',
        title:      'Crear categoria',
        height:     100,
        width:      300,
        items:
        [{
            xtype:      'textfield',
            id:         'sue_categoria_nueva',
            name:       'sue_categoria_nueva',
            fieldLabel: '(*) Nombre',
            allowBlank: false,
            emptyText:  'Escriba el nombre de la nueva categoria',
            blankText:  'Debe escribir un nombre para la nueva categoria',
            maskRe:     /^[a-zA-Z]$/,
            width:      230
        }],
        buttons:
        [{
            xtype:   'button',
            text:    'Crear',
            handler: SUE.crear_Categoria
        },
        {
            xtype:   'button',
            text:    'Cancelar',
            handler: SUE.cerrar_ventana_crear_categoria
        }]
    }]
} );

SUE.ventana_modificar_categoria = new Ext.Window( {
      id:            'modificar_categoria',
      title:         'Categorias SUE',
      resizable:     false,
      modal:         true,
      width:         400,
      plain:         true,
      constrain:     true,
      layout:        'fit',
      closeAction:   'hide',
      items:
      [{
        xtype:          'fieldset',
        title:          'Modificar categoria',
        autoHeight:     true,
//         checkboxToggle: true,
//         collapsed:      true,
        items:
        [{
	    xtype:          'combo',
            id:             'sue_categoria_nombre_actual',
            name:           'sue_categoria_nombre_actual',
	    fieldLabel:     '(*) Categoria',
	    valueField:     'id_categoria',
	    displayField:   'nom_categoria',
	    hiddenName:     'id_categoria',
            store:          SUE.categorias_Sue,
	    typeAhead:      true,
	    editable:       false,
	    forceSelection: true,
	    mode:           'local',
            triggerAction:  'all',
	    emptyText:      'Seleccione una categoria',
	    selectOnFocus:  true ,
	    allowBlank:     false,
	    blankText:      'Seleccione la categoria que desea modificar',
	    width:          230
	},
        {
            xtype:      'textfield',
            id:         'sue_categoria_nuevo_nombre',
            name:       'sue_categoria_nuevo_nombre',
            fieldLabel: '(*) Nuevo nombre',
            allowBlank: false,
            emptyText:  'Escriba el nuevo nombre de la categoria',
            blankText:  'Escriba el nuevo nombre  de la categoria',
            maskRe:     /^[a-zA-Z]$/,
            width:      230
        }],
        buttons:
        [{
            xtype:   'button',
            text:    'Guardar',
            handler: SUE.cambiar_nombre_categoria
        },
        {
            xtype:   'button',
            text:    'Cancelar',
            handler: SUE.cerrar_ventana_modificar_categoria
        }]
    }]
} );
//Fin ventanas para crear y modificar categorias

//Venta de ayuda para crear indicadores
SUE.ventana_ayuda_creacion_ind = new Ext.Window( {
    title:       'Categorias SUE', 
    resizable:   false,
//     modal:       true,
    width:       400,
    height:      150,
    plain:       true,
    layout:      'fit',
    closeAction: 'hide',
    html:        '<h1>Categoria:</h1></ p> Prueba preuva</ p><h1>Identificador:</h1></p><h1>Titulo:</h1>'
} );
//Fin venta de ayuda para crear indicadores

//Formulario para Crear Indicadores
SUE.formulario_creacion_indicadores = new Ext.FormPanel( {
    url:         SUE.url_sipi+'CrearIndicador',
    id:          'sue_formulario_creacion_indicadores',
    title:       'Primer Paso: Creacion del Indicador SUE',
    style:       'padding:0; margin:0;',
    width:       420, 
    height:      390,
    fitToFrame:  true,
    autoScroll:  true,
    buttonAlign: 'right',
    collapsible: true,
    fileUpload:  true,
    layout:      'fit',
    tbar:        SUE.toolbar_categorias,
    defaults:
    {
//         bodyStyle: 'padding:3px;',
//         style:     'border:5px;'
    },
    items: 
    [{  
        xtype:      'fieldset',
        id:         'informacion_indicador',
	title:      'Información del Indicador',
	items: 
	[{
            xtype: 'panel',
            height: 30,
            items:
            [{
                xtype: 'label',
                text:  'Los campos marcados con (*) son obligatorios',
                style: 'font-size:8.5pt; color:#484848;',
            }]
        },
        {
	    xtype:          'combo',
            id:             'sue_categoria',
            name:           'sue_categoria',
	    fieldLabel:     '(*) Categoria',
	    valueField:     'id_categoria',
	    displayField:   'nom_categoria',
	    hiddenName:     'id_categoria',
            store:          SUE.categorias_Sue,
	    typeAhead:      true,
	    editable:       false,
	    forceSelection: true,
	    mode:           'local',
            triggerAction:  'all',
	    emptyText:      'Seleccione una categoria',
	    selectOnFocus:  true ,
	    allowBlank:     false,
	    blankText:      'Seleccione la Categoria del indicador',
	    width:          170,
//             listeners: {
//                 select:function() 
//                 {
// 		    SUE.modificar_categorias();
// 		}
//             }
	},
        {
            xtype:      'textfield',
            id:         'sue_id',
            name:       'sue_id',
            fieldLabel: '(*) Identificador',
            allowBlank: false,
            maskRe:     /^[a-zA-Z0-9]$/,
//             blankText:  'El Identificador es obligatorio',
            width:      260
        },
        {
            xtype:      'textfield',
            id:         'sue_titulo',
            name:       'sue_titulo',
            fieldLabel: '(*) Titulo',
            allowBlank: false,
            blankText:  'Indique el nombre del indicador',
            maskRe:     /^[a-zA-Z0-9 ]$/,
            width:      260 
        },
        {
            xtype:      'textfield',
            id:         'sue_protocolo',
            name:       'sue_protocolo',
            fieldLabel: '(*) Protocolo',
            inputType:  'file'
        },
        {
            xtype:      'radiogroup',
            fieldLabel: '(*) Fuente de Datos',
            items: 
            [{
                boxLabel:   'Formatos',
                name:       'sue_fuente_datos',
                inputValue: 'formatos',
                checked:    true
            },
            {
                boxLabel:   'BD',
                name:       'sue_fuente_datos',
                inputValue: 'bd',
                disabled:   true,
            }]
        },
        {
            xtype:      'textarea',
            id:         'sue_descripcion',
            name:       'sue_descripcion',
            fieldLabel: '(*) Descripcion',
            allowBlank: false,
            blankText:  'Escriba una breve descripcion del Indicador',
            maskRe:     /^[a-zA-Z0-9,. ]$/,
            width:      260,
            height:     80
        }],
        buttons:
        [{
            text:     'Crear Indicador',
            id:       'sue_boton_crear_ind',
            formBind: true,
            handler:  SUE.crear_indicador,
        },
        {
            text:    'Limpiar',
            id:      'sue_boton_limpiar_form_crear_ind',
            tooltip: 'Si desea limpiar los campos correspondientes a la informacion del indicador presione este boton.',
            handler: SUE.limpiar_form_crear_ind
        }]
    }]
} );
//Fin formulario para crear indicadores

//Panel para formatos SUE
SUE.toolbar_formatos = new  Ext.Toolbar( {
    style:    'margin-bottom: 15px; border-bottom: 1px solid #99bbe8;',
    id:       'sue_toolbar_formatos',
//     disabled: true,
    items:
    [{
        text:    'Crear Formato',
        iconCls: 'sue_icono_crear',
        handler: SUE.mostrar_ventana_crear_formato
    },
     '->',
    {
        iconCls: 'sue_icono_ayuda',
        tooltip: 'Aqui podrá encontrar información acerca de los campos que debe llenar para crear un indicador',
        handler: SUE.mostrar_ventana_configurar_columnas
    }]
} );

var sm = new Ext.grid.CheckboxSelectionModel( {singleSelect: true});
var lista_formatos_column_model =  new Ext.grid.ColumnModel( [
    sm,
    {
        id:        'sue_formato_nombre', 
        resizable: true, 
        header:    'Nombre',
        sortable:  true, 
        dataIndex: 'sue_formato_nombre',
        width:     500
     },
     {
         id:        'sue_formato_configurado',
         resizable: true, 
         header:    'Configurado',
         sortable:  true, 
         dataIndex: 'sue_formato_configurado',
         width:     120
     }
] );

SUE.lista_formatos = new Ext.grid.EditorGridPanel( {
            autoScroll: true,
            store:      SUE.store_lista_formatos,
            sm:         sm,
            frame:      true,
            height:     220,
            cm: new Ext.grid.ColumnModel([
                sm,
                {
                    id:        'sue_formato_nombre_inicio', 
                    resizable: true, 
                    header:    'Nombre', 
                    sortable:  true, 
                    dataIndex: 'sue_formato_nombre'
                },
                {
                    id:        'sue_formato_configurado_inicio',
                    resizable: true, 
                    header:    'Configurado',
                    sortable:  true, 
                    dataIndex: 'sue_formato_configurado'
                }
            ]),
            tbar:
            [{
                xtype:    'button',
                iconCls:  'sue_icono_modificar',
                id:       'sue_boton_crear_formatos',
                tooltip:  'Una vez haya seleccionado el formato que desea editar, presione aqui para ejecutar la acción Editar',
                minWidth: 30,
                disabled: true,
            },
            {
                xtype:   'button',
                iconCls: 'sue_icono_eliminar',
                id:      'sue_boton_eliminar_formatos',
                disabled: true,
                minWidth: 30,
                tooltip: 'Una vez haya seleccionado el formato que desea eliminar, presione aqui para ejecutar la acción Eliminar'
            }],
            plugins:[new Ext.ux.grid.Search( {
                mode:          'local',
                position:      top,
                searchText:    'Filtrar',
                selectAllText: 'Seleccionar todos',
                searchTipText: 'Escriba el texto que desea buscar y presione la tecla enter',
                width:         150
            } )],
            view: new Ext.grid.GridView( {
                    forceFit:     true,
                    columnsText:  'Columnas',
                    sortAscText:  'Ordenar  Ascendentemente',
                    sortDescText: 'Ordenar Descendentemente'

            } ),
} );



SUE.panel_formatos_creados = new Ext.FormPanel( {
    id:          'formulario_formatos',
    title:       'Segundo Paso: Configurar los formatos del indicador',
    url:         SUE.url_sipi+'CrearFormato',
    width:       450,
    height:      390,
    border:      true,
    fitToFrame:  true,
    autoScroll:  true,
    collapsible: true,
    layout:      'fit',
    rendered:    false,
    tbar:        SUE.toolbar_formatos,
    items:
    [{
        xtype:      'fieldset',
        title:      'Formatos Creados', 
        layout: 'fit',
        items:
        [SUE.lista_formatos]
    }]
} );
//Fin panel para formatos SUE

//Ventanas para configurar formatos SUE
SUE.formato_spinner_columnas = new Ext.ux.form.Spinner({
    strategy:{
         xtype:    'number',
         minValue: 1,
         maxValue: 30,
         value:    1
    },
    value:         1, 
    name:          'sue_formato_columnas',
    id:            'sue_formato_columnas',
    fieldLabel:    '(*) Numero de columnas',
    labelStyle:    'font-size:8.5pt;',
    maskRe:        /^[0-9]$/,
    baseChars:     0-9,
    maxLength:     2,
    maxLengthText: 'En esta casilla solo se permiten valores entre 0 y 30',
});

SUE.formato_spinner_soportes = new Ext.ux.form.Spinner({
    strategy:{
         xtype:    'number',
         minValue: 1,
         maxValue: 30,
         value:    1
    },
    value:         1,
    name:          'sue_formato_soportes',
    id:            'sue_formato_soportes',
    fieldLabel:    'Numero de soportes',
    labelStyle:    'font-size:8.5pt;',
    minValue:      1,
    maskRe:        /^[0-9]$/,
    maxLength:     2,
    maxLengthText: 'En esta casilla solo se permiten valores entre 0 y 30',
});

SUE.formulario_ventana_crear_formato = new Ext.FormPanel( {
    id:          'sue_formulario_crear_formato',
    url:         SUE.url_sipi+'CrearFormato',
    buttonAlign: 'right',
    frame:       true,
//     height:      267,
    fileUpload:  true,
    items:
    [{
        xtype:      'fieldset',
        title:      'Informacion del Formato', 
        autoHeight: true,
        items:
        [{
            xtype: 'panel',
            height: 30,
            items:
            [{
                xtype: 'label',
                text:  'Los campos marcados con (*) son obligatorios',
                style: 'font-size:8.5pt; color:#484848;',
            }]
        },
        {
            xtype:      'textfield',
            fieldLabel: '(*) Nombre',
            name:       'sue_formato_nombre',
            id:         'sue_formato_nombre',
            allowBlank: false,
            blankText:  'El Identificador es obligatorio',
            anchor:     '100%'
        },
        {
            xtype:      'textarea',
            id:         'sue_formato_descripcion',
            name:       'sue_formato_descripcion',
            fieldLabel: '(*) Descripcion',
            allowBlank: false,
            blankText:  'Escriba una breve descripcion del formato',
            height:     80,
            anchor:     '100%'
        },
            SUE.formato_spinner_columnas,
        {
            xtype:      'textfield',
            id:         'sue_formato',
            name:       'sue_formato',
            fieldLabel: '(*) Archivo',
            inputType:  'file'
        }]
    },
    {
        xtype:          'fieldset',
        id:             'sue_field_descripcion_soportes',
        name:           'sue_field_descripcion_soportes',
        collapsible:    true,
//         checkboxToggle: true,
//         checkboxName:   'sue_checkbox_descripcion_soportes',
//         checkboxId:   'sue_checkbox_descripcion_soportes',
        title:          'Soportes de los datos',
        autoHeight:     true,
        collapsed:      true,
        items :
        [
            SUE.formato_spinner_soportes,
        {
            xtype:      'textarea',
            id:         'sue_descripcion_soportes',
            name:       'sue_descripcion_soportes',
            fieldLabel: 'Descripción de el o los soportes',
            anchor:     '100%',
            height:     120,
//             allowBlank: false
        }]
    }],
    buttons:
    [{
        text:     'Crear',
        handler:  SUE.crear_formato
    },
    {
        text:     'Cancelar',
        handler:  SUE.cerrar_ventana_crear_formato
    }]
} );

SUE.ventana_crear_formato = new Ext.Window( {
    id:              'sue_crear_formato',
    title:           'Creacion del Formato del Indicador',
    modal:           true,
    width:           450,
    plain:           true,
    layout:          'form',
    resizable:       false,
    fileUpload:      true,
    closeAction:     'hide', 
    shadow:          false,
    constrainHeader: true,
    iconCls:         'sue_icono_ventana_formato',
    items:
    [SUE.formulario_ventana_crear_formato]
} );
//Fin ventanas para configurar formatos SUE

//Ventana para la configuración de columnas
SUE.formulario_ventana_configurar_columnas = new Ext.FormPanel( {
    id:          'sue_formulario_ventana_configurar_columnas',
    url:         SUE.url_sipi+'ConfigurarColumna',
    buttonAlign: 'right',
    height:      280,
    style:       'width:100%;',
    frame:       true,
    layout:      'column',
    items:
    [{
        style: 'padding-right:10px;',
//         frame: true,
        items:
        [{
            xtype:      'fieldset',
            id:         'sue_field_columnas',
            title:      'Columna: ',
            width:      378,
            height:     267,
            items: 
            [{
                xtype: 'panel',
                height: 30,
                items:
                [{
                    xtype: 'label',
                    text:  'Los campos marcados con (*) son obligatorios',
                    style: 'font-size:8.5pt; color:#484848;',
                }]
            },
            {
                xtype:      'textfield',
                fieldLabel: '(*) Titulo',
                id:         'sue_columna_titulo',
                name:       'sue_columna_titulo',
                anchor:     '100%'
            },
            {
                xtype:      'textarea',
                fieldLabel: '(*) Descripcion',
                id:         'sue_columna_descripcion',
                name:       'sue_columna_descripcion',
                height:     130,
                anchor:     '100%'
            },
            {
                xtype:      'radiogroup',
                fieldLabel: 'Obligatotia',
                items: 
                [{
                    boxLabel:   'SI',
                    name:       'sue_columna_obligatoria',
                    inputValue: 'si',
                    checked:    true
                },
                {
                    boxLabel:   'NO',
                    name:       'sue_columna_obligatoria',
                    inputValue: 'no'
                }]
            }]
        }]
    },
    {
        items:
        [{
            xtype:  'fieldset',
            title:  'Resctricciones (Opcional)',
            width:  382,
            height: 267,
            autoScroll: true,
            items:
            [{
                xtype:      'radiogroup',
                hideLabel: true,
                items: 
                [{
                    columnWidth: '.5',
                    items:
                    [{
                        boxLabel:   'Datos Predefinidos',
                        labelStyle: 'font-size:8.5pt;',
                        name:       'sue_columna_restriccion',
                        id:         'sue_columna_restriccion_datos_predefinidos',
                        inputValue: 'sue_columna_restriccion_datos_predefinidos',
                        handler:    SUE.restricion_columna
                    },
                    {
                        boxLabel:   'Fecha',
                        name:       'sue_columna_restriccion',
                        id:         'sue_columna_restriccion_fecha',
                        inputValue: 'sue_columna_restriccion_fecha',
                        handler:    SUE.restricion_columna
                    }]
                },
                {
                    columnWidth: '.5',
                    items:
                    [{
                        boxLabel:   'Valor Numérico',
                        name:       'sue_columna_restriccion',
                        id:         'sue_columna_restriccion_numeros',
                        inputValue: 'sue_columna_restriccion_numeros',
                        handler:    SUE.restricion_columna
                    },
                    {
                        boxLabel:   'Ninguna',
                        name:       'sue_columna_restriccion',
                        id:         'sue_columna_sin_restriccion',
                        inputValue: 'sue_columna_sin_restriccion',
                        checked:    true,
                        handler:    SUE.restricion_columna
                    }]
                }]
            },
            SUE.lista_restriccion1,
            SUE.campos_restriccion2,
            SUE.campos_restriccion3
            ]
        }]
    }]
} );

SUE.ventana_configurar_columnas = new Ext.Window( {
    id:              'sue_ventana_configurar_columnas',
    title:           'Configuración de las Columnas',
    modal:           true,
    width:           800,
    height:          350,
    plain:           true,
//     layout:          'form',
    resizable:       false,
    closeAction:     'hide', 
    shadow:          false,
    constrainHeader: true,
    iconCls:         'sue_icono_ventana_formato',
    items:
    [SUE.formulario_ventana_configurar_columnas],
    buttons:
    [{
        text:    'siguiente',
        handler: SUE.guardar_configuracion_columna
    }]
} );
//Fin ventana para la configuracion de columnas

//Contenedor de los paneles
SUE.contenedor_creacion = new Ext.Panel( {
    width:      950,
    id:         'principal',
    border:     false,
    autoScroll: true,
    layout:     'column',
    style:      'padding-top:10px;',
    fitToFrame: true,
    items: 
    [{
        style: 'padding-left:10px; padding-right:10px;',
        frame: true,
        items:
        [
            SUE.formulario_creacion_indicadores
        ]
    },
    {
        frame:      true,
        hidden:     true,
        id:         'sue_creacion_derecho',
        name:       'sue_creacion_derecho',
        autoHeight: true,
        items:
        [{
            xtype: 'panel',
            id:    'sue_creacion_derecho_interno'
        }]
    }]
} );
//Fin contenedor de los paneles 



