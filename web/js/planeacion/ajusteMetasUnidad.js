function verificar()
{
    salida =  true;

    if(Ext.getCmp('idContenido').getValue() == '' && Ext.getCmp('idContenido').getValue() != 0){
        Ext.Msg.alert('Alerta!', 'Si desea realizar un ajuste a metas debe ingresar un valor para la meta');
        return false;
    }

    return salida;
};


function rechazarAjuste()
{
    salida =  true;

    if(Ext.getCmp('idmeta').getValue() == '' && Ext.getCmp('idmeta').getValue() != 0 ){
        Ext.Msg.alert('Alerta!', 'No puede rechazar una meta que no se ha ajustado');
        return false;
    }
    else if(Ext.getCmp('idrechazo').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe especificar la razón del rechazo del ajuste');
        return false;
    }

    return salida;
};