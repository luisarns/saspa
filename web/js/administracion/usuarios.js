  function verificarCampos()
  {
    salida =  'almacenar';
    
    if(Ext.getCmp('usu_identificador').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Digite el número de documento');
      return false;
    }
    else if(Ext.getCmp('usu_nombres').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'El campo Nombres no debe estar vacio');
      return false;
    }
    else if(Ext.getCmp('usu_apellidos').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'El campo Apellidos no debe estar vacio');
      return false;
    }else if(Ext.getCmp('usu_habilitado').checked == false && Ext.getCmp('usu_deshabilitado').checked == false){
      Ext.Msg.alert('Alerta!', 'Seleccione un estado');
      return false;
    }
    else if(Ext.getCmp('usu_rol').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Eliga un rol');
      return false;
    }
    else if(Ext.getCmp('usu_contrasena').getValue() != Ext.getCmp('usu_recontrasena').getValue()){
      Ext.Msg.alert('Alerta!', '<html>La contrase&ntilde;a y su confirmaci&oacute;n, no coinciden<\html>');
      return false;
    }
    else if(Ext.getCmp('usu_contrasena').getValue() == ''  && (Ext.getCmp('tipoOperacion').getValue() == 'creacion' || 
    Ext.getCmp('tipoOperacion').getValue() == '')){
      Ext.Msg.alert('Alerta!', '<html>La contrase&ntilde;a y su confirmaci&oacute;n, no deben estar vacios<\html>');
      return false;
    }
    return salida;
  }
  
  function modificacion(opcion)
  {
    if(opcion){
      if(usuariosHabilitados){
        Ext.getCmp('usu_contrasena').allowBlank = true;
        Ext.getCmp('usu_recontrasena').allowBlank = true;
        Ext.getCmp('usu_identificador').setDisabled(true);
        Ext.getCmp('usu_deshabilitado').setDisabled(false);
        Ext.getCmp('usu_habilitado').setDisabled(false);
        Ext.getCmp('usu_nombres').setDisabled(false);
        Ext.getCmp('usu_apellidos').setDisabled(false);
        Ext.getCmp('usu_contrasena').setDisabled(false);
        Ext.getCmp('usu_recontrasena').setDisabled(false);
        Ext.getCmp('tipoOperacion').setValue('modificacion');
      }
      else{
        Ext.getCmp('usu_identificador').setDisabled(true);
        Ext.getCmp('usu_nombres').setDisabled(true);
        Ext.getCmp('usu_apellidos').setDisabled(true);
        Ext.getCmp('usu_rol').setDisabled(true);
        Ext.getCmp('usu_contrasena').setDisabled(true);
        Ext.getCmp('usu_recontrasena').setDisabled(true);
        Ext.getCmp('usu_deshabilitado').setDisabled(false);
        Ext.getCmp('usu_habilitado').setDisabled(false);
        Ext.getCmp('tipoOperacion').setValue('modificacion');
      }
    }
    else{
      Ext.getCmp('usu_identificador').setDisabled(false);
      Ext.getCmp('usu_nombres').setDisabled(false);
      Ext.getCmp('usu_apellidos').setDisabled(false);
      Ext.getCmp('usu_rol').setDisabled(false);
      Ext.getCmp('usu_contrasena').setDisabled(false);
      Ext.getCmp('usu_recontrasena').setDisabled(false);
      Ext.getCmp('usu_contrasena').allowBlank = false;
      Ext.getCmp('usu_recontrasena').allowBlank = false;
      Ext.getCmp('usu_identificador').setValue('');
      Ext.getCmp('usu_nombres').setValue('');
      Ext.getCmp('usu_apellidos').setValue('');
      Ext.getCmp('usu_rol').setValue('');
      Ext.getCmp('usu_contrasena').setValue('');
      Ext.getCmp('usu_recontrasena').setValue('');
      Ext.getCmp('tipoOperacion').setValue('creacion');
      Ext.getCmp('usu_habilitado').checked = true;
      Ext.getCmp('usu_deshabilitado').checked = false;
      Ext.getCmp('usu_deshabilitado').setDisabled(true);
      Ext.getCmp('usu_habilitado').setDisabled(true);
    }
  }
  
  function reiniciarCampos(opcion)
  {
    if(opcion=='todos')
    {
      Ext.getCmp('usu_identificador').setDisabled(false);
      Ext.getCmp('usu_contrasena').setDisabled(false);
      Ext.getCmp('usu_recontrasena').setDisabled(false);
      Ext.getCmp('usu_deshabilitado').setDisabled(true);
      Ext.getCmp('usu_habilitado').setDisabled(true);
      
      Ext.getCmp('usu_contrasena').allowBlank = false;
      Ext.getCmp('usu_recontrasena').allowBlank = false;
      Ext.getCmp('usu_habilitado').checked = true;
      Ext.getCmp('usu_deshabilitado').checked = false;
      Ext.getCmp('tipoOperacion').setValue('creacion');
    }
    Ext.getCmp('usu_contrasena').allowBlank = false;
    Ext.getCmp('usu_recontrasena').allowBlank = false;
    Ext.getCmp('usu_nombres').setDisabled(false);
    Ext.getCmp('usu_apellidos').setDisabled(false);
    Ext.getCmp('usu_rol').setDisabled(false);
    
  }

  function mostrarFormCrearUsu()
  { 
      formularioDatosPersonales.getForm().reset();
      formularioDatosPersonales.setTitle('Nuevo usuario');
      reiniciarCampos('todos');
  }
