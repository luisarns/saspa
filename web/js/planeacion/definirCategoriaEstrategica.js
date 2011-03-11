function verificarCampos()
{
    salida =  true;

    if(Ext.getCmp('cce_nombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }
    
    else if(Ext.getCmp('cce_nombre').getValue().length > 400){
        Ext.Msg.alert('Alerta!', 'Le nombre no puede superar los 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('ccePadre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Debe seleccionar un nodo Padre');
        return false;
    }

    return salida;
};

function verificarIndicador()
{
    salida =  true;

    if(Ext.getCmp('ine_nombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }

    if(Ext.getCmp('ine_nombre').getValue().length > 400 ){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no puede exceder los 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('ine_formaCalculo').getValue().length > 500){
        Ext.Msg.alert('Alerta!', 'La forma de cálculo no puede superar los 500 caracteres');
        return false;
    }
    
    else if(Ext.getCmp('ineTipo').getValue() == '')
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

function verificarRecurso()
{
    salida =  true;

    if(Ext.getCmp('rec_anhio').getValue() == '')
    {
        Ext.Msg.alert('Alerta!', 'Seleccione un periodo de tiempo para asignar el recurso');
        return false;
    }
    else if(Ext.getCmp('rec_otros_plan').getValue() == '' ){
        Ext.Msg.alert('Alerta!', 'Debe ingresar un valor en el campo recursos');
        return false;
    }

    return salida;
};
