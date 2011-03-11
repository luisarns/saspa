function verificarCampos()
{
    salida =  true;

	if(Ext.getCmp('nombre_estrategia').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
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

    else if (Ext.getCmp('nombre_estrategia').getValue().length > 400 ){
        Ext.Msg.alert('Alerta!', 'El nombre no puede superar los 400 caracteres');
        return false;
    }

    return salida;
};

function verificarCategoria()
{
    salida =  'almacenar';
    
    if(Ext.getCmp('cpeNombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'El campo Nombre no debe estar vacío');
        return false;
    }

    else if(Ext.getCmp('cpeNombre').getValue().length > 400){
        Ext.Msg.alert('Alerta!', 'El nombre no puede exceder los 400 caracteres');
        return false;
    }

    else if(Ext.getCmp('cpeNombre').getValue().length < 4){
        Ext.Msg.alert('Alerta!', 'El nombre debe contener al menos 4 caracteres');
        return false;
    }
    
    else if(Ext.getCmp('cpe_padre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Seleccione un nodo padre para la categoría');
        return false;
    }
    
    return salida;
};

function verificarId()
{
    if(Ext.getCmp('idCatEst').getValue() == '')
    {
        Ext.Msg.alert('Alerta!', 'Seleccione primero una categoría para eliminar');
        return false;
    }
    else
    {
        return true;
    }
}


function espacioBlanco(s)
{
	var salida = false;

	if (/^\s+/.test(s))
    {
        salida = true;
    } 
	return salida;
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
		Ext.getCmp('nombre_estrategia').setDisabled(false);
		Ext.getCmp('anhioInicio').setDisabled(true);
		Ext.getCmp('anhioFin').setDisabled(true);
		Ext.getCmp('planEstDesc').setDisabled(false);
		Ext.getCmp('planEstObs').setDisabled(false);
	}
	else
	{
		Ext.getCmp('nombre_estrategia').setDisabled(false);
		Ext.getCmp('anhioInicio').setDisabled(false);
		Ext.getCmp('anhioFin').setDisabled(false);
		Ext.getCmp('planEstDesc').setDisabled(false);
		Ext.getCmp('planEstObs').setDisabled(false);
	}
}


function modificarCategorias(b)
{
	if(b)
	{
		Ext.getCmp('cpeNombre').setDisabled(false);
		//Ext.getCmp('identificadorCatEst').setDisabled(true);
		Ext.getCmp('cpeDescripcion').setDisabled(false);
		Ext.getCmp('cpe_padre').setDisabled(true);
	}
	else
	{
		Ext.getCmp('cpeNombre').setDisabled(false);
		//Ext.getCmp('identificadorCatEst').setDisabled(false);
		Ext.getCmp('cpeDescripcion').setDisabled(false);
		Ext.getCmp('cpe_padre').setDisabled(false);
	}
}


