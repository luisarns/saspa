  function verificarCampos()
  {
    salida =  'almacenar';
    
    if(Ext.getCmp('sol_nombre').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Digite el nombre de la solicitud');
      return false;
    }
    else if(Ext.getCmp('sol_facultad').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'El campo Facultad no debe estar vacio');
      return false;
    }
    else if(Ext.getCmp('sol_escuela').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'El campo Escuela no debe estar vacio');
      return false;
    }
    else if(Ext.getCmp('sol_estado').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'El campo Estado no debe estar vacio');
      return false;
    }
    return salida;
  }
  
  
  function modificacion(opcion)
  {
      mostrarFormCrearSol();
      Ext.getCmp('sol_facultad').setDisabled(true);
      Ext.getCmp('sol_escuela').setDisabled(true);
  }
  
  function reiniciarCampos()
  {
      Ext.getCmp('sol_nombre').setDisabled(false);
      Ext.getCmp('sol_estado').setDisabled(true);
      Ext.getCmp('sol_estado').setValue('Proceso');
      Ext.getCmp('tipoOperacion').setValue('creacion');
  }

  
  
  function mostrarFormCrearSol()
  { 
  		Ext.getCmp('grid_solicitud').getForm().reset();
      //crudSolicitudes.getForm().reset();
      reiniciarCampos();
  }
