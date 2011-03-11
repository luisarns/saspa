function verificar()
{
    salida =  true;

    if( Ext.getCmp('valor_metaGlobal').getValue() == '' && Ext.getCmp('valor_metaGlobal').getValue() != 0 ){
        Ext.Msg.alert('Alerta!', 'Debe existir una meta global para realizar un ajuste');
        return false;
    }
    else if(Ext.getCmp('idContenido').getValue() == '' && Ext.getCmp('idContenido').getValue() != 0 ){
        Ext.Msg.alert('Alerta!', 'Si desea realizar un ajuste a metas debe ingresar un valor para la meta');
        return false;
    }

    return salida;
};