function rechazarAlcance()
{
    salida =  true;

    if(Ext.getCmp('alc_alcance').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede rechazar una meta a la que no se le ha ingresado un alcance');
        return false;
    }
    
    else if(Ext.getCmp('ame_ajuste').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede rechazar el seguimiento a este indicador si no se ha realizado previamente el ajuste a la meta');
        return false;
    }
    
    else if(Ext.getCmp('alc_rechazo_unidad').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe especificar la razón del rechazo el alcance especificado por la dependencia');
        return false;
    }

    return salida;
};

function verificar()
{
    salida =  true;

    if(Ext.getCmp('alc_alcance').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede aprobar una meta a la que no se le ha ingresado un alcance');
        return false;
    }
        
    else if(Ext.getCmp('ame_ajuste').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No puede aprobar el seguimiento a este indicador si no se ha realizado previamente el ajuste a la meta');
        return false;
    }
    
    else if(Ext.getCmp('alc_estado').getValue() == 'Rechazado Opdi')
    {
        Ext.Msg.alert('Alerta!', 'Para poder aprobar este valor debe ser primero revisado por la dependencia');
        return false;
    }
    
    else if(Ext.getCmp('alc_estado').getValue() == 'Aprobado Opdi')
    {
        Ext.Msg.alert('Alerta!', 'El valor reportado ya fue aprobado por la oficina de planeación');
        return false;
    }
    return salida;
};