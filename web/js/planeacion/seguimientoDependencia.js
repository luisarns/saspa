function verificar()
{
    salida =  true;

    if(Ext.getCmp('ame_ajuste').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'No tienes un valor ajustado de metas por cumplir');
        return false;
    }
    else if( Ext.getCmp('alc_alcance').getValue() == '' && Ext.getCmp('alc_alcance').getValue() != 0 ){
        Ext.Msg.alert('Alerta!', 'Debe ingresar un valor ejecutado');
        return false;
    }
    else if(Ext.getCmp('alc_aprobado').getValue() == 'Aprobado Opdi'){
        Ext.Msg.alert('Alerta!', 'El alcance reportado ya fue aprobado por planeación');
        return false;
    }
    else if(Ext.getCmp('alc_aprobado').getValue() == 'Aprobado Und'){
        Ext.Msg.alert('Alerta!', 'El alcance reportado ya fue aprobado por la unidad');
        return false;
    }
    else if(Ext.getCmp('alc_cambios').getValue() != '' && Ext.getCmp('alc_justificacion').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Al formular cambios debe indicar la justificación');
        return false;
    }

    return salida;
};