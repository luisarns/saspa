function verificar()
{
    salida =  true;

    if(Ext.getCmp('idContenido').getValue() == '' && Ext.getCmp('idContenido').getValue() != 0 ){
        Ext.Msg.alert('Alerta!', 'Si desea realizar un ajuste a metas debe ingresar un valor para la meta');
        return false;
    }

    return salida;
};

function listarIndicadores()
{
    salida =  true;

    if(Ext.getCmp('idcat').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe seleccionar una categoría para obtener el listado de los indicadores');
        return false;
    }
    else if(Ext.getCmp('anhio_meta').getValue() == '' ){
        Ext.Msg.alert('Alerta!', 'Debe seleccionar un año para obtener el listado de los indicadores');
        return false;
    }

    return salida;
};

function rechazarAjuste()
{
    salida =  true;

    if(Ext.getCmp('idmeta').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede rechazar una meta que no se ha ajustado');
        return false;
    }
    else if(Ext.getCmp('idrechazo').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe especificar la razón del rechazo del ajuste');
        return false;
    }

    return salida;
};