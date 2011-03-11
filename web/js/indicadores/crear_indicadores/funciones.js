Ext.ns('SUE');

// SUE.url_sipi = 'http://192.168.131.50/~indicadores/sipi/web/index.php/gestion/';
// SUE.url_sipi = 'http://localhost/~sebastian/sipi/web/index.php/gestion/';

//linea agregada conforme documento de instalacion lo indicaba
SUE.url_sipi = 'http://192.168.3.120/sipi/web/index.php/gestion/';

var tipo_documento;
SUE.id_indicador = '1';
SUE.formato_columnas = 0;
var columna = 1;

//Esta es una modificacion del xtype: label, que permite hacerle un update al texto del label
Ext.override(Ext.form.Label, { 
    setText: function(t){
        this.text = t;
        if(this.rendered){
            this.el.update(t);
        }
    }
});
//Fin modificacion del xtype: label

//Funcion para mostrar y cerrar ventana de ayuda para creacion de indicadores
SUE.mostrar_ventana_ayuda_creacion_ind = function ()
{
    SUE.ventana_ayuda_creacion_ind.show();
    SUE.ventana_ayuda_creacion_ind.center();
}
//Fin funcion para mostrar y cerrar ventana de ayuda para creacion de indicadores

//Funciones para gestionar Archivos
SUE.cargar_archivo = function(button) 
{
    var form  = document.createElement('form');
    var input = button.detachInputFile().dom;
    form.appendChild(input);
    form.style.display = 'none';
    document.body.appendChild(form);
    var basicForm = new Ext.form.BasicForm(form, {
        fileUpload: true,
        url: SUE.url_sipi+'GestionarArchivo/accion/cargar'
    });
    basicForm.submit( {
        success: function() 
        {
            if ( tipo_documento == 'protocolo' ) {
                Ext.getCmp('label_sue_protocolo').getEl().update(input.value);
                Ext.getCmp('sue_protocolo').setValue(input.value);
            } else if ( tipo_documento == 'formato' ) {
                Ext.getCmp('label_sue_formato').getEl().update(input.value);
                Ext.getCmp('sue_formato').setValue(input.value);
            }
            document.body.removeChild(form);
            tipo_documento = '';
        },
	failure: function() 
        {
            Ext.Msg.alert('Error', 'No se pudo cargar el archivo.'); 
            document.body.removeChild(form);
            tipo_documento = '';
        }
    } );
};

SUE.borrar_archivo = function() 
{
    if(!Ext.getCmp('sue_protocolo').getValue() == '' || !Ext.getCmp('sue_formato').getValue() == '') {
        var archivo;

        if (tipo_documento == 'protocolo') {
            archivo = Ext.getCmp('sue_protocolo').getValue(); Ext.Msg.alert('Alerta!', archivo);
        } else if ( tipo_documento == 'formato' ) {
            archivo = Ext.getCmp('sue_formato').getValue();
        }
        Ext.Ajax.request( {
            url:    SUE.url_sipi+'GestionarArchivo/accion/borrar',
            method: 'POST',
            params: {
                nombre_archivo: archivo
            },
            success: function() 
            {
                if ( tipo_documento == 'protocolo' ) {
                    Ext.Msg.alert('Alerta!', 'Protocolo borrado exitosamente');
                    Ext.getCmp('sue_protocolo').setValue('');
                    Ext.getCmp('label_sue_protocolo').getEl().update('');
                } else if ( tipo_documento == 'formato' ) {
                    Ext.Msg.alert('Alerta!', 'Formato borrado exitosamente');
                    Ext.getCmp('sue_formato').setValue('');
                    Ext.getCmp('label_sue_formato').getEl().update('');
                }
                tipo_documento = '';
                archivo        = '';
            },
            failure: function() 
            { 
                Ext.Msg.alert('Error', 'No fue posible borrar el Protocolo.');
                tipo_documento = '';
                archivo        = '';
            }
        } );
    } else {
        if ( tipo_documento == 'protocolo' ) {
            Ext.Msg.alert('Alerta!', 'Aun no ha cargado el Protocolo');
        } else if ( tipo_documento == 'formato' ) {
            Ext.Msg.alert('Alerta!', 'Aun no ha cargado el Formato');
        }
    }
}

SUE.descargar_archivo = function() 
{
    if ( tipo_documento == 'protocolo' ) {
        if(!Ext.getCmp('sue_protocolo').getValue() == '') {
            var archivo = Ext.getCmp('sue_protocolo').getValue();
            window.location =  SUE.url_sipi+'GestionarArchivo/accion/descargar/nombre_archivo/'+archivo;
        } else {
            Ext.Msg.alert('Alerta!', 'Aun no ha cargado el Protocolo'); 
        }
    } else if ( tipo_documento == 'formato' ) {
         if(!Ext.getCmp('sue_formato').getValue() == '') {
            var archivo = Ext.getCmp('sue_formato').getValue();
            window.location =  SUE.url_sipi+'GestionarArchivo/accion/descargar/nombre_archivo/'+archivo;
        } else {
            Ext.Msg.alert('Alerta!', 'Aun no ha cargado el Formato'); 
        }
    }
}
//Fin funciones para gestionar Archivos

//Funciones para crear indicadores
SUE.verificar_campos_indicador = function()
{
    salida =  'crear';
    if(Ext.getCmp('sue_categoria').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor seleccione una categoria'); 
        return false;
    }
    if(Ext.getCmp('sue_id').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el identificador'); 
        return false;
    }
    if(Ext.getCmp('sue_titulo').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el titulo');     salida =  'crear';
        return false;
    }
    if(Ext.getCmp('sue_protocolo').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor cargue el Protocolo del indicador'); 
        return false;
    }
    if(Ext.getCmp('sue_descripcion').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba la descripcion'); 
        return false;
    }
    return true;
}

SUE.crear_indicador = function() 
{
    if(SUE.verificar_campos_indicador()) {
        SUE.formulario_creacion_indicadores.getForm().submit( { 
            method:'POST',
//             params:{
// //                          identificador:  Ext.getCmp('usu_identificador').getValue(),
// //                          contrasena:     contrasenaEncrypt
//             },
//             waitTitle: 'Enviando',
//             waitMsg:   'Enviando datos...',

            success: function(form, action)
            {
                obj = Ext.util.JSON.decode(action.response.responseText);
                SUE.id_indicador = obj.sue_id_indicador;
                Ext.Msg.alert('Alerta!', 'El indicador ha sido creado<br />Por favor continue con la configuración de los formatos en el segundo paso', function(btn, text) {
                                  if(btn == 'ok') {
                                      Ext.getCmp('sue_creacion_derecho').show(true);
                                      SUE.panel_formatos_creados.render('sue_creacion_derecho_interno');
                                      SUE.lista_formatos.reconfigure(SUE.store_lista_formatos, lista_formatos_column_model);
//                                       SUE.lista_formatos_sue.load();
//                                       SUE.habilitar_creacion_formatos();
                                  }
                             } );
            },

            failure: function(form, action)
            { 
                if(action.failureType == 'server') { 
                    obj = Ext.util.JSON.decode(action.response.responseText);
                    Ext.Msg.alert('Error!', obj.errors.reason); 
                } else { 
                    Ext.Msg.alert('Alerta!', 'No se obtuvo respuesta del servidor: '); 
                }
            }
        }); 
    }
}

SUE.limpiar_form_crear_ind = function()
{   /*SUE.ventana_configurar_columnas.show();
    SUE.ventana_configurar_columnas.center(); 
    SUE.ventana_configurar_columnas.alignTo('principal_centro','t', ['-10%', 0]);

    Ext.getCmp('sue_creacion_derecho').show(true);
    SUE.panel_formatos_creados.render('sue_creacion_derecho_interno');
    SUE.lista_formatos.reconfigure(SUE.store_lista_formatos, lista_formatos_column_model);
    SUE.lista_formatos.getStore().filter('sue_indicador_id', new RegExp("^"+SUE.id_indicador+"$"), false, false);*/

    Ext.getCmp('sue_categoria').reset();
    Ext.getCmp('sue_id').reset();
    Ext.getCmp('sue_titulo').reset();
    Ext.getCmp('sue_protocolo').reset();
    Ext.getCmp('sue_descripcion').reset();
    Ext.getCmp('sue_categoria').reset();
    Ext.getCmp('sue_id').reset();
    Ext.getCmp('sue_titulo').reset();
    Ext.getCmp('sue_protocolo').reset();
    Ext.getCmp('sue_descripcion').reset();
}
//Fin funciones para crear indicadores

//Funciones para deshabilitar los campos del formulario_creacion_indicadores y habilitar los del formulario_formatos
SUE.habilitar_creacion_formatos = function()
{
    Ext.getCmp('sue_boton_crear_formatos').setDisabled(false);
    Ext.getCmp('sue_boton_eliminar_formatos').setDisabled(false); 
    Ext.getCmp('sue_toolbar_formatos').setDisabled(false);

    Ext.getCmp('sue_toolbar_creacion_ind').setDisabled(true);
    Ext.getCmp('sue_categoria').setDisabled(true);
    Ext.getCmp('sue_id').setDisabled(true);
    Ext.getCmp('sue_titulo').setDisabled(true);
    Ext.getCmp('sue_protocolo').setDisabled(true);
    Ext.getCmp('sue_descripcion').setDisabled(true);
    Ext.getCmp('sue_boton_crear_ind').setDisabled(true);
}
//Fin funciones para deshabilitar los campos del formulario_creacion_indicadores y habilitar los del formulario_formatos


//Funciones para crear categorias
SUE.mostrar_ventana_crear_categoria = function()
{
        Ext.getCmp('sue_categoria_nueva').reset();
        SUE.ventana_crear_categoria.show();
        SUE.ventana_crear_categoria.center();
}

SUE.cerrar_ventana_crear_categoria = function()
{
    SUE.ventana_crear_categoria.hide();
}

SUE.verificar_campos_categoria_nueva = function()
{
    if(Ext.getCmp('sue_categoria_nueva').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre de la categoria que desea crear'); 
        return false;
    }
    return true;
}

SUE.crear_Categoria = function()
{
    if(SUE.verificar_campos_categoria_nueva())
    {
        Ext.Ajax.request( {
            url:    SUE.url_sipi+'CrearCategoriaSUE',
            method: 'POST',
            params: {
                nombre_categoria: Ext.getCmp('sue_categoria_nueva').getValue(),
            },
            success: function() 
            {
                Ext.Msg.alert('Alerta!', 'Ha sido creada una nueva categoria');
                Ext.getCmp('sue_categoria_nueva').reset();
                Ext.getCmp('sue_categoria').reset();
                SUE.ventana_crear_categoria.hide(true);
                SUE.categorias_Sue.load();
            },
            failure: function() 
            { 
                Ext.Msg.alert('Error', 'Esta categoria ya existe.');
            }
        } );
    }
}
//Fin funciones para crear categorias

//Funciones para modificar categorias
SUE.mostrar_ventana_modificar_categoria = function()
{
        Ext.getCmp('sue_categoria_nombre_actual').reset();
        Ext.getCmp('sue_categoria_nuevo_nombre').reset();
        SUE.ventana_modificar_categoria.show();
        SUE.ventana_modificar_categoria.center();
}

SUE.cerrar_ventana_modificar_categoria = function()
{
    SUE.ventana_modificar_categoria.hide(true);
}

SUE.verificar_campos_modificacion_categoria = function()
{
    if(Ext.getCmp('sue_categoria_nombre_actual').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escoja la categoria que desea modificar'); 
        return false;
    }
    if(Ext.getCmp('sue_categoria_nuevo_nombre').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el nuevo nombre de la categoria'); 
        return false;
    }
    return true;
}

SUE.cambiar_nombre_categoria = function()
{
    if(SUE.verificar_campos_modificacion_categoria()) {
        Ext.Ajax.request( {
            url:    SUE.url_sipi+'ModificarCategoriaSUE',
            method: 'POST',
            params: {
                sue_categoria_id:            Ext.getCmp('sue_categoria_nombre_actual').getValue(),
                sue_categoria_nuevo_nombre:  Ext.getCmp('sue_categoria_nuevo_nombre').getValue(),
            },
            success: function() 
            {
                Ext.Msg.alert('Alerta!', 'Categoria modificada exitosamente' );
                Ext.getCmp('sue_categoria_nombre_actual').reset();
                Ext.getCmp('sue_categoria_nuevo_nombre').reset(); 
                Ext.getCmp('sue_categoria').reset();
                SUE.ventana_modificar_categoria.hide(true);
                SUE.categorias_Sue.load();
            },
            failure: function() 
            { 
                Ext.Msg.alert('Error', 'Esta categoria ya existe.');
            }
        } );
    }
}
//Fin funciones para modificar categorias

//Funciones para la configuracion de formatos SUE
SUE.mostrar_ventana_crear_formato = function()
{
    Ext.getCmp('sue_formato_nombre').reset();
    Ext.getCmp('sue_formato_descripcion').reset();
    Ext.getCmp('sue_formato_columnas').reset();
    Ext.getCmp('sue_formato').reset();
    Ext.getCmp('sue_descripcion_soportes').reset();
    Ext.getCmp('sue_descripcion_soportes').reset();
    Ext.getCmp('sue_field_descripcion_soportes').collapse(true);
    SUE.formato_spinner_soportes.reset();
    SUE.ventana_crear_formato.show();
    SUE.ventana_crear_formato.center();
    SUE.ventana_crear_formato.alignTo('principal_centro','t', ['-10%', 0]);
}

SUE.cerrar_ventana_crear_formato = function()
{
    SUE.ventana_crear_formato.hide(true);
}

SUE.verificar_campos_formato = function()
{
    if(Ext.getCmp('sue_formato_nombre').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre del formato'); 
        return false;
    }
    if(Ext.getCmp('sue_formato_descripcion').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba la descripcion del formato'); 
        return false;
    }
    if(Ext.getCmp('sue_formato_columnas').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor indique el numero de columnas del formato'); 
        return false;
    }
    if(Ext.getCmp('sue_formato').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor carge el archivo del formato'); 
        return false;
    }
    return true;
}

SUE.crear_formato = function()
{
    if ( SUE.verificar_campos_formato() ) {
        SUE.formulario_ventana_crear_formato.getForm().submit( {
            method:    'POST',
            params:
            {
               sue_id: SUE.id_indicador
            },
//                     waitTitle: 'Enviando',
//                     waitMsg:   'Enviando datos...',
            success:function(form, action)
            {   SUE.store_lista_formatos.load( {
                                                    callback: function() 
                                                    {
                                                        SUE.store_lista_formatos.filter('sue_indicador_id', new RegExp("^"+SUE.id_indicador+"$"), false, false);
                                                    }
                                             } );
                obj = Ext.util.JSON.decode(action.response.responseText);
                SUE.formato_id       = obj.sue_formato_id;
                SUE.formato_columnas = obj.sue_formato_columnas;
                columna              = 1;
                Ext.Msg.alert('SIPI','Formato creado exitosamente!', function(btn, text)
                                                                     {
                                                                          SUE.ventana_configurar_columnas.show();
                                                                          SUE.ventana_configurar_columnas.center(); 
                                                                          SUE.ventana_configurar_columnas.alignTo('principal_centro','t', ['-10%', 0]);
                                                                          Ext.getCmp('sue_field_columnas').setTitle('Columna: '+columna);
                                                                     }
                             );
            },
            failure: function(form, action)
            { 
                if(action.failureType == 'server') { 
                    obj = Ext.util.JSON.decode(action.response.responseText);
                    Ext.Msg.alert('Error!', obj.errors.reason); 
                } else { 
                    Ext.Msg.alert('Alerta!', 'No se obtuvo respuesta del servidor: '); 
                }
            }
        } );
    }
}
//Funciones para la configuracion de formatos SUE

//Funciones para configurar columnas
SUE.guardar_configuracion_columna = function()
{
    if( columna < SUE.formato_columnas ) {
        columna ++;
        Ext.getCmp('sue_field_columnas').setTitle('Columna: '+columna);

        Ext.getCmp('sue_columna_sin_restriccion').setValue(true);
        Ext.getCmp('sue_columna_restriccion_datos_predefinidos').setValue(false);
        Ext.getCmp('sue_columna_restriccion_numeros').setValue(false);
        Ext.getCmp('sue_columna_restriccion_fecha').setValue(false);

        SUE.store_opcines_restriccion1.removeAll();

        Ext.getCmp('sue_restriccion2_inicio').reset();
        Ext.getCmp('sue_restriccion2_fin').reset();

        Ext.getCmp('sue_restriccion3_inicio').reset();
        Ext.getCmp('sue_restriccion3_fin').reset();
    }
}

SUE.restricion_columna = function()
{
    if( Ext.getCmp('sue_columna_restriccion_datos_predefinidos').getValue()) {

        SUE.campos_restriccion3.hide();
        Ext.getCmp('sue_restriccion3_inicio').reset();
        Ext.getCmp('sue_restriccion3_fin').reset();

        SUE.campos_restriccion2.hide();
        Ext.getCmp('sue_restriccion2_inicio').reset();
        Ext.getCmp('sue_restriccion2_fin').reset();

        SUE.lista_restriccion1.show();
        SUE.lista_restriccion1.reconfigure(SUE.store_opcines_restriccion1, SUE.lista_restricion1_column_model);
    }
    else if( Ext.getCmp('sue_columna_restriccion_numeros').getValue()) {

           SUE.lista_restriccion1.hide();

           SUE.campos_restriccion3.hide();
           Ext.getCmp('sue_restriccion3_inicio').reset();
           Ext.getCmp('sue_restriccion3_fin').reset();

           Ext.getCmp('sue_restriccion2_inicio').reset();
           Ext.getCmp('sue_restriccion2_fin').reset();
           SUE.campos_restriccion2.show();
    }
    else if( Ext.getCmp('sue_columna_restriccion_fecha').getValue()) {

        SUE.lista_restriccion1.hide();

        SUE.campos_restriccion2.hide();
        Ext.getCmp('sue_restriccion2_inicio').reset();
        Ext.getCmp('sue_restriccion2_fin').reset();

         Ext.getCmp('sue_restriccion3_inicio').reset();
         Ext.getCmp('sue_restriccion3_fin').reset();
         SUE.campos_restriccion3.show();
    }
    else if( Ext.getCmp('sue_columna_sin_restriccion').getValue()) {
        SUE.lista_restriccion1.hide();

        SUE.campos_restriccion2.hide();
        Ext.getCmp('sue_restriccion2_inicio').reset();
        Ext.getCmp('sue_restriccion2_fin').reset();

        SUE.campos_restriccion3.hide();
        Ext.getCmp('sue_restriccion3_inicio').reset();
        Ext.getCmp('sue_restriccion3_fin').reset();
    }
}

SUE.prueba = function()
{
       Ext.Msg.alert('Alerta!', 'Esta es la prueba de eventos'); 
}
//Fin funciones para configurar columnas
