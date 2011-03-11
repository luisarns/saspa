//Variables
var sue_id_t            = '';
var sue_nom_t           = '';
var sue_tipo_t          = '';
var sue_sql_crear_t     = '';
var sue_sql_poblar_t_id = '';
var sue_sql_poblar_t    = '';
var sue_estado_t        = '';
var sue_accion_t        = '';
var soporte_tabla       = '';
var llaves_t_datos      = '';

var r_id        = '';
var r_nombre    = '';
var r_sql       = '';
// var r_tabla     = '';
var r_indicador = '';
var r_accion    = '';

var res_tabla  = '';
var res_estado = '';
var res_rol    = '';

var res_id     = '';
var res_estado = '';
var res_accion = '';

var URL_SIPI = 'http://172.17.8.211/sipi/sipi/web/';
//Fin Variables

SUE.verificar_campos_tabla_resultado = function()
{
    var patron = /insert|update|delete|drop|alter|grant|select|create/i;
//     if (sue_tipo_t == 'datos') {
	if(Ext.getCmp('nom_t_datos').getValue() == '') {
		Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre de la tabla'); 
		return false;
	}
	if(Ext.getCmp('sql_crear_t_datos').getValue() == '') {
		Ext.Msg.alert('Alerta!', 'Por favor escriba los campos de la tabla'); 
		return false;
	}
	if (Ext.getCmp('sql_crear_t_datos').getValue().search(patron) != -1) {
		Ext.Msg.alert('Alerta!', '<html>En la secci&oacute;n: "Campos de la tabla", no puede ingresar instrucciones sql</html>');
		return false;
	}  
// 	if(Ext.getCmp('sql_poblar_t_datos').getValue() == '') {
// 		Ext.Msg.alert('Alerta!', '<html>Por favor escriba la instrucci&oacute;n sql para poblar la tabla</html>'); 
// 		return false;
// 	}
	var patron2 = /update|delete|drop|alter|grant|create|insert|into/i;
// 	if (Ext.getCmp('sql_poblar_t_datos').getValue().search(patron2) != -1) {
// 		Ext.Msg.alert('Alerta!', '<html>En la secci&oacute;n para diligenciar la consulta SQL, solo puede ingresar<br> instrucciones tipo SELECT.');
// 		return false;
// 	}
	if (sue_accion_t == 'modificar_td') {
//             if (sue_estado_t == 'prueba') {
//                 sue_sql_poblar_t = Ext.getCmp('sql_poblar_t_datos').getValue();
//                 sue_nom_t        = Ext.getCmp('nom_t_datos').getValue();
//                 sue_sql_crear_t  = Ext.getCmp('sql_crear_t_datos').getValue();
//             } else if (sue_estado_t == 'fijo') {
//                 sue_sql_poblar_t = Ext.getCmp('sql_poblar_t_datos').getValue();
//             }
		if (Ext.getCmp('est_t_pru').getValue()) {
			sue_estado_t = 'prueba';
		} else if (Ext.getCmp('est_t_fijo').getValue()) {
			sue_estado_t = 'fijo';
		}
	} else if (sue_accion_t == 'crear_td') {
		sue_estado_t = 'prueba';
	}
	
	if (Ext.getCmp('soporte_si').getValue()) {
	soporte_tabla = 'si';
	} else if (Ext.getCmp('soporte_no').getValue()) {
	soporte_tabla = 'no';
	}

	if (Ext.getCmp('tipo_filas').getValue()) {
		sue_tipo_t = 'filas';
	} else if (Ext.getCmp('tipo_columnas').getValue()) {
		sue_tipo_t = 'columnas';
	}
	
    llaves_t_datos   = Ext.getCmp('llaves_t_datos').getValue();    
// 	sue_sql_poblar_t = Ext.getCmp('sql_poblar_t_datos').getValue();
	sue_nom_t        = Ext.getCmp('nom_t_datos').getValue();
	sue_sql_crear_t  = Ext.getCmp('sql_crear_t_datos').getValue();
	myMask = new Ext.LoadMask(grid_lista_tablas.getEl(), {msg:'Cargando...',removeMask: true});
	myMask.show();
	SUE.gestionar_tablas();
}

SUE.gestionar_tablas = function()
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
					llaves_t_datos:      llaves_t_datos,
//                     sue_sql_poblar_t_id: sue_sql_poblar_t_id,   
//                     sue_sql_poblar:      sue_sql_poblar_t,
                    sue_estado_t:        sue_estado_t,
		    soporte:             soporte_tabla
                },
                success: function(response, action)
                {
		    setTimeout('myMask.hide()');
                    obj = Ext.util.JSON.decode(response.responseText);
                    if (obj.success && obj.error) {
						ventana = new SUE.ventana_informe();
						Ext.getCmp('sue_prueba_error').setValue(obj.mensaje);
						ventana.show();
						 st_lista_tablas.removeAll();
						st_lista_tablas.load({params: {ind_id: ind_id}});
						formularioTablaDatos.getForm().reset();
						formularioTablaDatos.hide();
						formularioTablaResultados.getForm().reset();
						formularioTablaResultados.hide();
						st_grid_lis_t_datos.removeAll();
						st_grid_lis_t_datos.load({params: {ind_id: ind_id}});
					} else if (obj.success) {
                        var mensaje = obj.mensaje;
                        Ext.Msg.alert('Alerta!', mensaje, function(btn, text) {
                                    if(btn == 'ok') {
                                        st_lista_tablas.removeAll();
                                        st_lista_tablas.load({params: {ind_id: ind_id}});
                                        formularioTablaDatos.getForm().reset();
                                        formularioTablaDatos.hide();
                                        formularioTablaResultados.getForm().reset();
                                        formularioTablaResultados.hide();
//                                         st_lista_tablas_combo.removeAll();
//                                         st_lista_tablas_combo.load({params: {ind_id: ind_id}});
                                        st_grid_lis_t_datos.removeAll();
                                        st_grid_lis_t_datos.load({params: {ind_id: ind_id}});
                                    }
                                } );
                    } else if (!obj.success) {
//                         Ext.Msg.alert('Error!', obj.errors.reason);
						ventana = new SUE.ventana_informe();
						Ext.getCmp('sue_prueba_error').setValue(obj.errors.reason);
						ventana.show();
						st_lista_tablas.removeAll();
						st_lista_tablas.load({params: {ind_id: ind_id}});
						st_grid_lis_t_datos.removeAll();
						st_grid_lis_t_datos.load({params: {ind_id: ind_id}});
// 						st_lista_tablas.removeAll();
// 						st_lista_tablas.load({params: {ind_id: ind_id}});
// 						formularioTablaDatos.getForm().reset();
// 						formularioTablaDatos.hide();
// 						formularioTablaResultados.getForm().reset();
// 						formularioTablaResultados.hide();
//                                         st_lista_tablas_combo.removeAll();
//                                         st_lista_tablas_combo.load({params: {ind_id: ind_id}});
// 						st_grid_lis_t_datos.removeAll();
// 						st_grid_lis_t_datos.load({params: {ind_id: ind_id}});
//                          alert(obj.errors.reason);
//                         Ext.getCmp('sue_prueba_error').setValue(obj.errors.reason);
//                         SUE.ventana_prueba.show();
                    }
                },
                failure: function() 
                { 
                    Ext.Msg.alert('Error', 'El servidor no responde.');
                }
            } );
}


SUE.mostrar_ocultar_forms = function(tipo)
{
    if (tipo == 't_datos') {
        sue_id_t            = '';
        sue_nom_t           = '';
        sue_sql_crear_t     = '';
        sue_estado_t        = '';
        sue_estado_t        = '';
		sue_tipo_t          = '';
		soporte_tabla       = '';
        Ext.getCmp('sue_presentacion_derecho').show();
        formularioTablaDatos.show();
        formularioTablaResultados.hide();
        formularioTablaDatos.render('sue_presentacion_derecho');
    } else if (tipo == 'form_resultados') {
        r_id     = '';
        r_nombre = '';
        r_sql    = '';
        r_accion = '';
        Ext.getCmp('sue_presentacion_derecho_resultados').show();
        formularioResultados.show();
        formularioResultados.render('sue_presentacion_derecho_resultados');
    }
}

SUE.verificar_campos_form_resultado = function()
{    
//     if(Ext.getCmp('resul_tabla').getValue() == '') {
//         Ext.Msg.alert('Alerta!', 'Por favor escoja una tabla'); 
//         return false;
//     }
    if(Ext.getCmp('resul_nombre').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba el nombre del resultado'); 
        return false;
    }
	if (Ext.getCmp('resul_tipo').getValue() == '') {
	Ext.Msg.alert('Alerta!', 'Por favor escoja el tipo de resultado'); 
        return false;
    }
    if (Ext.getCmp('resul_sql').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Por favor escriba la consulta SQL para obtener el resultado');
        return false;
    }  
    var patron2 = /update|delete|drop|alter|grant|create|insert|into/i;
    if (Ext.getCmp('resul_sql').getValue().search(patron2) != -1) {
        Ext.Msg.alert('Alerta!', '<html>En la secci&oacute;n para diligenciar la consulta SQL, solo puede ingresar<br> instrucciones tipo SELECT.');
        return false;
    }
    
//     r_tabla  = Ext.getCmp('resul_tabla').getValue();
    r_nombre = Ext.getCmp('resul_nombre').getValue();
    r_sql    = Ext.getCmp('resul_sql').getValue();

    
    SUE.gestionar_resultados();
}

SUE.gestionar_resultados = function()
{
    Ext.Ajax.request( {
                url:    URL_SIPI+'indicadores.php/gestion/GestionarResultados',
                method: 'POST',
                params: {
//                     r_tabla:     r_tabla,
                    r_indicador: ind_id,
                    r_id:        r_id,
					r_tipo:     Ext.getCmp('resul_tipo').getValue(),
                    r_nombre:    r_nombre,
                    r_sql:       r_sql,
                    r_accion:    r_accion
                },
                success: function(response, action)
                {
                    obj = Ext.util.JSON.decode(response.responseText);
                    if (obj.success) {
                        var mensaje = obj.mensaje;
                        Ext.Msg.alert('Alerta!', mensaje, function(btn, text) {
                                    if(btn == 'ok') {
                                        st_lista_resultados.removeAll();
										st_lista_resultados.load({params: {ind_id: ind_id, tipo: Ext.getCmp('combo_tipo_res').getValue()}});
                                        formularioResultados.getForm().reset();
                                        formularioResultados.hide();
                                    }
                                } );
                    } else if (!obj.success) {
//                         Ext.Msg.alert('Error!', obj.errors.reason);
			ventana = new SUE.ventana_informe();
			Ext.getCmp('sue_prueba_error').setValue(obj.errors.reason);
			ventana.show();
			st_lista_resultados.removeAll();
			st_lista_resultados.load({params: {ind_id: ind_id, tipo: Ext.getCmp('combo_tipo_res').getValue()}});
			formularioResultados.getForm().reset();
			formularioResultados.hide();
                    }
                },
                failure: function() 
                { 
                    Ext.Msg.alert('Error', 'El servidor no responde.');
                }
            } );
}
