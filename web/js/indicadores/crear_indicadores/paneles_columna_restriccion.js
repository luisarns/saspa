//Paneles para la restriccion de datos predefinidos
SUE.form_nueva_opcion_restriccion1 = Ext.form;

SUE.lista_restricion1_column_model = new Ext.grid.ColumnModel(
    [{
        id:        'dato',
        header:    'Opciones',
        dataIndex: 'dato',
        width:     300,
        editor: new SUE.form_nueva_opcion_restriccion1.TextField({
            allowBlank: false
        })
    }]
);

SUE.lista_restricion1_column_model.defaultSortable = true;

SUE.lista_restriccion1 = new Ext.grid.EditorGridPanel({
    autoScroll:   true,
    hidden:       true,
    store:        SUE.store_opcines_restriccion1,
    cm:           SUE.lista_restricion1_column_model,
    width:        360,
    height:       175,
    frame:        true,
    clicksToEdit: 2,
    tbar:
    [{
        text:    'Nuevo Dato',
        iconCls: 'sue_icono_crear',
        handler: function()
        {
            var nueva_opcion = new SUE.array_opciones_restriccion1({
                dato: 'Dato Nuevo',
            });
            SUE.lista_restriccion1.stopEditing();
            SUE.store_opcines_restriccion1.insert(0, nueva_opcion);
            SUE.lista_restriccion1.startEditing(0, 0);
        }
    }],
    view: new Ext.grid.GridView( {
                    forceFit:     true,
                    columnsText:  'Columnas',
                    sortAscText:  'Ordenar  Ascendentemente',
                    sortDescText: 'Ordenar Descendentemente'

    } )
});
//Fin paneles para la restriccion de datos predefinidos

//Paneles para la restriccion de valor numerico
Ext.form.VTypes['restriccion2_validar_rango_valores'] = function(val, field) 
{
    var valor_inicio = Ext.getCmp('sue_restriccion2_inicio').getValue();
    var valor_final  = Ext.getCmp('sue_restriccion2_fin').getValue();
  
    var inicio = Ext.getCmp('sue_restriccion2_inicio');
    var final  = Ext.getCmp('sue_restriccion2_fin');

    if (field == inicio && valor_inicio > valor_final && !valor_final == '') {
        Ext.Msg.alert('Alerta!', 'Debe ingresar un valor menor o igual a '+valor_final+' en el campo Valor Minimo');
    }
    if (field == final && valor_inicio > valor_final && !valor_inicio == '') {
        Ext.Msg.alert('Alerta!', 'Debe ingresar un valor mayor o igual a '+valor_inicio+' en el campo Maximo Valor');
    }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
}


SUE.campos_restriccion2 = new Ext.Panel({
      width:       350,
      bodyStyle:   'padding: 20px 0 0 10px;',
      id:          'restriccion2',
      defaults:    { width: 175 },
      layout:      'form',
      defaultType: 'numberfield',
      items: 
      [{
          fieldLabel:      'Valor Minimo',
          name:            'sue_restriccion2_inicio',
          id:              'sue_restriccion2_inicio',
          validationDelay: 600,
          vtype:           'restriccion2_validar_rango_valores',
      },
      {
          fieldLabel:      'Maximo Valor',
          name:            'sue_restriccion2_fin',
          id:              'sue_restriccion2_fin',
          validationDelay: 600,
          vtype:           'restriccion2_validar_rango_valores',
      }],
      hidden: true
});
//Fin paneles para la restriccion de valor numerico

//Paneles para la restriccion de fecha
Ext.form.VTypes['restriccion3_validar_fechas'] = function(val, field) 
{
    var date = field.parseDate(val);

    if (!date) {
        return;
    }
    if (field.startDateField && (!this.dateRangeMax || (date.getTime() != this.dateRangeMax.getTime()))) {
        var start = Ext.getCmp(field.startDateField);
        start.setMaxValue(date);
        start.validate();
        this.dateRangeMax = date;
    } 
    else if (field.endDateField && (!this.dateRangeMin || (date.getTime() != this.dateRangeMin.getTime()))) {
        var end = Ext.getCmp(field.endDateField);
        end.setMinValue(date);
        end.validate();
        this.dateRangeMin = date;
    }
        /*
         * Always return true since we're only using this vtype to set the
         * min/max allowed values (these are tested for after the vtype test)
         */
        return true;
}


SUE.campos_restriccion3 = new Ext.Panel({
      width:       350,
      bodyStyle:   'padding: 20px 0 0 10px;',
      id:          'restriccion3',
      defaults:    { width: 175 },
      layout:      'form',
      defaultType: 'datefield',
      items: 
      [{
          fieldLabel:   'Inicio del periodo',
          name:         'sue_restriccion3_inicio',
          id:           'sue_restriccion3_inicio',
          vtype:        'restriccion3_validar_fechas',
          readOnly:     true,
          format:       'd/m/Y',
          endDateField: 'sue_restriccion3_fin' // id of the end date field
      },
      {
          fieldLabel:     'Fin del periodo',
          name:           'sue_restriccion3_fin',
          id:             'sue_restriccion3_fin',
          vtype:          'restriccion3_validar_fechas',
          readOnly:       true,
          format:         'd/m/Y',
          startDateField: 'sue_restriccion3_inicio' // id of the start date field
      }],
      hidden: true
});
//Fin paneles para la restriccion de fecha