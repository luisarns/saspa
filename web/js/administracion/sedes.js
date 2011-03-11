var form_sede_activo = false;
function activarCamposSede()
{
    Ext.getCmp('sedTextIdentificador').enable();
    Ext.getCmp('sedTextNombre').enable();
    Ext.getCmp('sedComboMunicipio').enable();
    form_sede_activo = true;
}

var form_dep_activo = false;
function activarCamposDep()
{
    Ext.getCmp('depTextIdentificador').enable();
    Ext.getCmp('depTextNombre').enable();
    Ext.getCmp('depSedeNom').enable();
	Ext.getCmp('idAbrev').enable();
    form_dep_activo = true;
}

function activarCamposDependencia () 
{
    Ext.getCmp('subdepTextIdentificador').enable();
    Ext.getCmp('subdepTextNombre').enable();
}

function admVerificarCamposSede()
{
    salida =  'no almacenar';
    /*if (!form_sede_activo) {
        return false; 
    } else */if (Ext.getCmp('sedTextIdentificador').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Digite el identificador para la sede');
        return false;
    }
    else if (Ext.getCmp('sedTextNombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Digite el nombre de la sede');
        return false;
    }
    else if (Ext.getCmp('sedComboMunicipio').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Escoja un municipio para la sede');
        return false;
    }
    return 'almacenar';
}



function admVerificarCamposDependencia()
{
    salida =  'almacenar';
    if (!form_dep_activo) {
        return false;
    }
    if(Ext.getCmp('depTextIdentificador').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Digite el identificador de la dependencia');
        salida =  'no almacenar'
        return salida;
    }
    else if(Ext.getCmp('depTextNombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Digite el nombre de la dependencia');
        salida =  'no almacenar'
        return salida;
    }
    else if(Ext.getCmp('depComboSede').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Escoja una sede para la dependencia');
        salida =  'no almacenar'
        return salida;
    }
	else if(Ext.getCmp('idAbrev').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Seleccione una abreviatura');
        salida =  'no almacenar'
        return salida;
    }
    return salida;
}

function admVerificarCamposSubDependencia()
{
    if (Ext.getCmp('subdepTextIdentificador').getValue() == '') {
        Ext.Msg.alert('Alerta!', 'Digite el identificador de la sub-dependencia');
        return false;
    }
    else if(Ext.getCmp('subdepTextNombre').getValue() == ''){
        Ext.Msg.alert('Alerta!', 'Digite el nombre de la sub-dependencia');
        return false;
    }
    return true;
}


