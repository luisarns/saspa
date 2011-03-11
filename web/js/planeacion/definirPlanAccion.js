function verificarCampos()
{
    salida =  true;

    if(Ext.getCmp('nombrePlan').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }

    else if(Ext.getCmp('nombrePlan').getValue().length > 400){
        Ext.Msg.alert('Alerta!', 'El nombre no puede superar los 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('nomPlanEst').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El Plan Estratégico es obligatorio');
        return false;
    }

    else if(Ext.getCmp('anhioInicio').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Elija un año inicial');
        return false;
    }

    else if(Ext.getCmp('anhioFin').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Elija un año de finalización');
        return false;
    }

    else if(Ext.getCmp('anhioInicio').getValue() > Ext.getCmp('anhioFin').getValue()){
       Ext.Msg.alert('Alerta!', 'La fecha inicial no puede ser mayor a la fecha de finalización');
       return false;
    }

    else if(Ext.getCmp('anhioInicio').getValue() == Ext.getCmp('anhioFin').getValue()){
       Ext.Msg.alert('Alerta!', 'La fecha inicial y de finalización no pueden ser iguales');
       return false;
    }

    return salida;
};


function verificarCategoria()
{
    salida =  'almacenar';
    
    if(Ext.getCmp('cpaNombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }
    
    else if(Ext.getCmp('cpaNombre').getValue().length > 400 ){
        Ext.Msg.alert('Alerta!', 'El nombre no puede exceder 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('cpaNombre').getValue().length < 4 ){
        Ext.Msg.alert('Alerta!', 'El nombre debe contener al menos 4 caracteres');
        return false;
    }

    else if(Ext.getCmp('cpa_padre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Seleccione un nodo padre para la categoría');
        return false;
    }

    return salida;
};

function verificarId()
{
    if(Ext.getCmp('idCatAcc').getValue() == '')
    {
        Ext.Msg.alert('Alerta!', 'Seleccione primero una categoría para eliminar');
        return false;
    }
    else
    {
        return true;
    }
}

function validarMinuscula(s)
{
    var salida = false;

    if ((/^[a-z]*$/.test(s)) && (s.toLowerCase() == s))
    {
        salida = true;
    } 
    return salida;
    
}

function modificarPlan(b)
{
	if(b)
	{
		Ext.getCmp('nombrePlan').setDisabled(false);
		Ext.getCmp('planAccDesc').setDisabled(false);
		Ext.getCmp('planAccObs').setDisabled(false);
		Ext.getCmp('nomPlanEst').setDisabled(true);
        //Ext.getCmp('archivo_planA').setDisabled(false);
	}
	else
	{
        Ext.getCmp('nombrePlan').setDisabled(false);
        Ext.getCmp('planAccDesc').setDisabled(false);
        Ext.getCmp('planAccObs').setDisabled(false);
        Ext.getCmp('nomPlanEst').setDisabled(false);
       // Ext.getCmp('archivo_planA').setDisabled(false);
	}
}

function modificarCategorias(b)
{
    if(b)
    {
        Ext.getCmp('cpaNombre').setDisabled(false);
        //Ext.getCmp('identificadorCatAcc').setDisabled(true);
        Ext.getCmp('cpaDescripcion').setDisabled(false);
        Ext.getCmp('cpa_padre').setDisabled(true);
    }
    else
    {
        Ext.getCmp('cpaNombre').setDisabled(false);
        //Ext.getCmp('identificadorCatAcc').setDisabled(false);
        Ext.getCmp('cpaDescripcion').setDisabled(false);
        Ext.getCmp('cpa_padre').setDisabled(false);
    }
}
