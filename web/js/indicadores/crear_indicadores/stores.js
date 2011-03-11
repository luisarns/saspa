//Store de categorias
SUE.categorias_Sue = new Ext.data.JsonStore( {
    url:  SUE.url_sipi+'CategoriasSue',
    root: 'categorias',
    sortInfo: {
                  field:    'nom_categoria', 
                  Direction:'DESC'
              },
    fields: 
    [
        { name:'id_categoria',  type: 'string' },
        { name:'nom_categoria', type: 'string' }
    ]
} );
SUE.categorias_Sue.load();
//Fin store de categorias

//Store de formatos SUE
SUE.lista_indicadores = new Ext.data.JsonStore( {
    url:           SUE.url_sipi+'ListaIndicadores',
    root:          'indicadores',
    totalProperty: 'total',
    fields:
    [
        { name:'sue_categoria'     },
        { name:'sue_identificador' },
        { name:'sue_titulo'        },
        { name:'sue_descripcion'   },
        { name:'sue_protocolo'     },
    ]
} );

SUE.store_lista_formatos = new Ext.data.JsonStore( {
    url:           SUE.url_sipi+'ListaFormatosSue',
    root:          'formatos_sue',
    totalProperty: 'total',
    sortInfo: {
                  field:    'sue_formato_nombre', 
                  Direction:'DESC'
              },
    fields:
    [
        { name:'sue_formato_id'              },
        { name:'sue_indicador_id'            },
        { name:'sue_formato_nombre'          },
        { name:'sue_formato_descripcion'     },
        { name:'sue_formato_columnas'        },
        { name:'sue_formato_archivo'         },
        { name:'sue_formato_documentos'      },
        { name:'sue_formato_soportes_decrip' },
        { name:'sue_formato_configurado'     },
    ]
} );
SUE.store_lista_formatos.load();
//Fin store de formatos SUE


var myData = [
        ['3m Co'],
        ['Alcoa Inc'],
        ['Altria Group Inc'],
        ['American Express Company'],
        ['American International Group, Inc.'],
        ['AT&T Inc.']
    ];

SUE.store_opcines_restriccion1 = new Ext.data.SimpleStore( {
    fields:
    [
        { name:'dato'}
    ]
} );
// SUE.store_opcines_restriccion1.loadData(myData);

SUE.array_opciones_restriccion1 = Ext.data.Record.create([
           {name: 'dato'},
]);
