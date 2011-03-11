function rechazarAlcance()
{
    salida =  true;

    if(Ext.getCmp('alc_alcance').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede rechazar una meta a la que no se le ha ingresado un valor ejecutado');
        return false;
    }
    
    else if(Ext.getCmp('ame_ajuste').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede rechazar el seguimiento a este indicador si no se ha realizado previamente el ajuste a la meta');
        return false;
    }
    
    else if(Ext.getCmp('alc_rechazo_opdi').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe especificar la razón del rechazo el alcance especificado por la dependencia');
        return false;
    }

    return salida;
};

function verificar()
{
    salida =  true;

    if(Ext.getCmp('alc_alcance').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Aún no se ha ingresado el valor ejecutado');
        return false;
    }

    return salida;
};