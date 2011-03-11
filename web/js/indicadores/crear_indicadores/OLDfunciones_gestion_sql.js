//Variables
var sue_id_t;
var sue_nom_t;
var sue_tipo_t;
var sue_sql_crear_t;
var sue_sql_poblar_t_id;
var sue_sql_poblar_t;
var sue_estado_t;
var sue_accion_t;
var URL_SIPI = 'http://192.168.131.50/~indicadores/sipi/web/';    
//Fin Variables

SUE.verificar_campos_tabla_resultado = function()
{
    var patron = /insert|update|delete|drop|alter|grant|select/i;
    if (sue_tipo_t == 'datos') {
        if(Ext.getCmp('nom_t_datos').getValue() == '') {
            Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre de la tabla'); 
            return false;
        }
        if(Ext.getCmp('sql_crear_t_datos').getValue() == '') {
            Ext.Msg.alert('Alerta!', 'Por favor escriba la instruccion sql para crear la tabla'); 
            return false;
        }
        if (Ext.getCmp('sql_crear_t_datos').getValue().search(patron) != -1) {
            Ext.Msg.alert('Alerta!', 'Solo puede ingresar instrucciones sql tipo CREATE');
            return false;
        }  
        if(Ext.getCmp('sql_poblar_t_datos').getValue() == '') {
            Ext.Msg.alert('Alerta!', 'Por favor escriba la instruccion sql para poblar la tabla'); 
            return false;
        }
        var patron2 = /update|delete|drop|alter|grant|create/i;
        if (Ext.getCmp('sql_poblar_t_datos').getValue().search(patron2) != -1) {
            Ext.Msg.alert('Alerta!', 'Solo puede ingresar instrucciones sql tipo INSERT INTO y SELECT');
            return false;
        }
      
        sue_sql_poblar_t = Ext.getCmp('sql_poblar_t_datos').getValue();
        sue_nom_t        = Ext.getCmp('nom_t_datos').getValue();
        sue_sql_crear_t  = Ext.getCmp('sql_crear_t_datos').getValue();
    }
    
    if (sue_tipo_t == 'resultados') {
        if(Ext.getCmp('nom_t_resultados').getValue() == '') {
            Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre de la tabla'); 
            return false;
        }
        if(Ext.getCmp('sql_crear_t_resultados').getValue() == '') {
            Ext.Msg.alert('Alerta!', 'Por favor escriba la instruccion sql para crear la tabla'); 
            return false;
        }
        if (Ext.getCmp('sql_crear_t_resultados').getValue().search(patron) != -1) {
            Ext.Msg.alert('Alerta!', 'Solo puede ingresar instrucciones sql tipo CREATE');
            return false;
        }
        
        sue_nom_t        = Ext.getCmp('nom_t_resultados').getValue();
        sue_sql_crear_t  = Ext.getCmp('sql_crear_t_resultados').getValue();
    } 
    
    SUE.gestionar_tabla_resultado();
}

SUE.gestionar_tabla_resultado = function()
{
    Ext.Ajax.request( {
                url:    URL_SIPI+'indicadores.php/gestion/GestionarTablasDatosSUE',
                method: 'POST',
                params: {
                    sue_accion_t:        sue_accion_t,
                    sue_id:              ind_id,
                    sue_id_t:            sue_id_t,
                    sue_nom_tabla:       sue_nom_t,
                    sue_tipo_t:          sue_tipo_t,
                    sue_sql_crear:       sue_sql_crear_t,
                    sue_sql_poblar_t_id: sue_sql_poblar_t_id,   
                    sue_sql_poblar:      sue_sql_poblar_t,
                    sue_estado_t:        sue_estado_t
                },
                success: function(response, action)
                {
                    obj = Ext.util.JSON.decode(response.responseText);
                    if (obj.success) {
                        var mensaje = obj.mensaje;
                        Ext.Msg.alert('Alerta!', mensaje, function(btn, text) {
                                    if(btn == 'ok') {
                                        st_lista_tablas.removeAll();
                                        st_lista_tablas.load({params: {ind_id: ind_id}});
                                        formularioTablaDatos.getForm().reset();
                                        formularioTablaDatos.hide();
                                    }
                                } );
                    } else if (!obj.success) {
                        Ext.Msg.alert('Error!', obj.errors.reason);
                    }
                }
            } );
}

SUE.mostrar_ocultar_forms = function(tipo)
{
    if (tipo == 't_datos') {
        sue_id_t            = '';
        sue_nom_t           = '';
        sue_sql_crear_t     = '';
        sue_sql_poblar_t    = '';
        sue_estado_t        = '';
        sue_sql_poblar_t_id = '';
        sue_estado_t        = '';
        Ext.getCmp('sue_presentacion_derecho').show();
        formularioTablaDatos.show();
        formularioTablaResultados.hide();
        formularioDatos2Formato.hide();
        formularioTablaDatos.render('sue_presentacion_derecho');
    } else if (tipo == 't_resultados') {
        sue_id_t            = '';
        sue_nom_t           = '';
        sue_sql_crear_t     = '';
        sue_sql_poblar_t    = '';
        sue_estado_t        = '';
        sue_sql_poblar_t_id = '';
        sue_estado_t        = '';
        Ext.getCmp('sue_presentacion_derecho').show();
        formularioTablaDatos.hide();
        formularioTablaResultados.show();
        formularioDatos2Formato.hide();
        formularioTablaResultados.render('sue_presentacion_derecho');
    }
}