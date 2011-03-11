function verificar()
{
    salida =  true;

    if( Ext.getCmp('rec_estam_plan').getValue() == '' && Ext.getCmp('rec_estam_ejec').getValue() != '' ){
        Ext.Msg.alert('Alerta!', 'No puede ingresar un recurso que no se ha planeado');
        return false;
    }
    else if( Ext.getCmp('rec_otros_plan').getValue() == '' && Ext.getCmp('rec_otros_ejec').getValue() != '' ){
        Ext.Msg.alert('Alerta!', 'No puede ingresar un recurso que no se ha planeado');
        return false;
    }

    return salida;
};