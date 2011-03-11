function verificarCampos()
{
    salida =  true;

    if(Ext.getCmp('cca_nombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }
    
    else if(Ext.getCmp('cca_nombre').getValue().length > 400){
        Ext.Msg.alert('Alerta!', 'El nombre no puede superar los 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('ccaPadre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe seleccionar un nodo Padre');
        return false;
    }

//     else if(Ext.getCmp('cca_codigo').getValue().length > 10){
//         Ext.Msg.alert('Alerta!', 'El código no puede exceder 10 caracteres');
//         return false;
//     }
    
    else if(Ext.getCmp('idTipo').getValue() == '' && Ext.getCmp('ccaPadre').getValue() == '' ){
        Ext.Msg.alert('Alerta!', 'Seleccione un tipo de plan para poder seleccionar el nodo padre');
        return false;
    }

    return salida;
};

function verificarIndicador()
{
    salida =  true;

    if(Ext.getCmp('ina_nombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }
    else if(Ext.getCmp('ina_nombre').getValue() > 400 ){
        Ext.Msg.alert('Alerta!', 'El campo Nombre puede superar 400 caracteres');
        return false;
    }
    else if(Ext.getCmp('inaTipo').getValue() == '')
    {
        Ext.Msg.alert('Alerta!', 'Debe seleccionar un tipo para el indicador');
        return false;
    }

    return salida;
};

function verificarMeta()
{
    salida =  true;

    if(Ext.getCmp('anhio_meta').getValue() == '')
    {
        Ext.Msg.alert('Alerta!', 'Seleccione un periodo para asignar la meta');
        return false;
    }
    else if(Ext.getCmp('cpeMeta').getValue() == '' && Ext.getCmp('cpeMeta').getValue() != 0){
        Ext.Msg.alert('Alerta!', 'Debe ingresar un valor para la meta');
        return false;
    }

    return salida;
};