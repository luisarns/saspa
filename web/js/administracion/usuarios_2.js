  function verificarCampos()
  {
    salida =  'almacenar';
    
    if(Ext.getCmp('usu_tipodoc').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Eliga un tipo de documento');
      return false;
    }
    else if(Ext.getCmp('usu_identificador').getValue() == ''){
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
    }
    else if(Ext.getCmp('usu_sede').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Eliga una sede');
      return false;
    }
    else if(Ext.getCmp('usu_dependencia').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Eliga una dependencia');
      return false;
    }
    else if(Ext.getCmp('usu_habilitado').checked == false && Ext.getCmp('usu_deshabilitado').checked == false){
      Ext.Msg.alert('Alerta!', 'Seleccione un estado');
      return false;
    }
    else if(Ext.getCmp('usu_rol').getValue() == ''){
      Ext.Msg.alert('Alerta!', 'Eliga un rol');
      return false;
    }
    else if(Ext.getCmp('usu_contrasena').getValue() != Ext.getCmp('usu_recontrasena').getValue() /*&& 
    (Ext.getCmp('tipoOperacion').getValue() == 'creacion' || Ext.getCmp('tipoOperacion').getValue() == '')*/){
      Ext.Msg.alert('Alerta!', '<html> La contrase&ntilde;a y su confirmación, no coinciden<\html>');
      return false;
    }
    else if(Ext.getCmp('usu_contrasena').getValue() == ''  && (Ext.getCmp('tipoOperacion').getValue() == 'creacion' || 
    Ext.getCmp('tipoOperacion').getValue() == '')){
      Ext.Msg.alert('Alerta!', 'La contraseña y su confirmación, no deben estar vacios');
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
        Ext.getCmp('usu_tipodoc').setDisabled(true);
        Ext.getCmp('usu_identificador').setDisabled(true);
        Ext.getCmp('usu_deshabilitado').setDisabled(false);
        Ext.getCmp('usu_habilitado').setDisabled(false);
        Ext.getCmp('usu_nombres').setDisabled(false);
        Ext.getCmp('usu_apellidos').setDisabled(false);
        Ext.getCmp('usu_sede').setDisabled(false);
        Ext.getCmp('usu_dependencia').setDisabled(false);
        Ext.getCmp('usu_teloficina').setDisabled(false);
        Ext.getCmp('usu_fax').setDisabled(false);
        Ext.getCmp('usu_telcasa').setDisabled(false);
        Ext.getCmp('usu_celular').setDisabled(false);
        Ext.getCmp('usu_email').setDisabled(false);
        Ext.getCmp('usu_rol').setDisabled(false);
        Ext.getCmp('usu_contrasena').setDisabled(false);
        Ext.getCmp('usu_recontrasena').setDisabled(false);
        Ext.getCmp('tipoOperacion').setValue('modificacion');
      }
      else{
        Ext.getCmp('usu_tipodoc').setDisabled(true);
        Ext.getCmp('usu_identificador').setDisabled(true);
        Ext.getCmp('usu_nombres').setDisabled(true);
        Ext.getCmp('usu_apellidos').setDisabled(true);
        Ext.getCmp('usu_sede').setDisabled(true);
        Ext.getCmp('usu_dependencia').setDisabled(true);
        Ext.getCmp('usu_teloficina').setDisabled(true);
        Ext.getCmp('usu_celular').setDisabled(true);
        Ext.getCmp('usu_email').setDisabled(true);
        Ext.getCmp('usu_rol').setDisabled(true);
        Ext.getCmp('usu_contrasena').setDisabled(true);
        Ext.getCmp('usu_recontrasena').setDisabled(true);
        Ext.getCmp('usu_fax').setDisabled(true);
        Ext.getCmp('usu_telcasa').setDisabled(true);
        Ext.getCmp('usu_deshabilitado').setDisabled(false);
        Ext.getCmp('usu_habilitado').setDisabled(false);
        Ext.getCmp('tipoOperacion').setValue('modificacion');
      }
    }
    else{
      
      Ext.getCmp('usu_tipodoc').setDisabled(false);
      Ext.getCmp('usu_identificador').setDisabled(false);
      Ext.getCmp('usu_nombres').setDisabled(false);
      Ext.getCmp('usu_apellidos').setDisabled(false);
      Ext.getCmp('usu_sede').setDisabled(false);
      Ext.getCmp('usu_dependencia').setDisabled(false);
      Ext.getCmp('usu_teloficina').setDisabled(false);
      Ext.getCmp('usu_fax').setDisabled(false);
      Ext.getCmp('usu_telcasa').setDisabled(false);
      Ext.getCmp('usu_celular').setDisabled(false);
      Ext.getCmp('usu_email').setDisabled(false);
      Ext.getCmp('usu_rol').setDisabled(false);
      Ext.getCmp('usu_contrasena').setDisabled(false);
      Ext.getCmp('usu_recontrasena').setDisabled(false);
      Ext.getCmp('usu_contrasena').allowBlank = false;
      Ext.getCmp('usu_recontrasena').allowBlank = false;
      Ext.getCmp('usu_tipodoc').setValue('');
      Ext.getCmp('usu_identificador').setValue('');
      Ext.getCmp('usu_nombres').setValue('');
      Ext.getCmp('usu_apellidos').setValue('');
      Ext.getCmp('usu_sede').setValue('');
      Ext.getCmp('usu_dependencia').setValue('');
      Ext.getCmp('usu_teloficina').setValue('');
      Ext.getCmp('usu_telcasa').setValue('');
      Ext.getCmp('usu_fax').setValue('');
      Ext.getCmp('usu_celular').setValue('');
      Ext.getCmp('usu_email').setValue('');
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
      Ext.getCmp('usu_tipodoc').setDisabled(false);
      Ext.getCmp('usu_identificador').setDisabled(false);
      Ext.getCmp('usu_contrasena').allowBlank = false;
      Ext.getCmp('usu_recontrasena').allowBlank = false;
      Ext.getCmp('usu_contrasena').setDisabled(false);
      Ext.getCmp('usu_recontrasena').setDisabled(false);
      Ext.getCmp('usu_habilitado').checked = true;
      Ext.getCmp('usu_deshabilitado').checked = false;
      Ext.getCmp('usu_deshabilitado').setDisabled(true);
      Ext.getCmp('usu_habilitado').setDisabled(true);
      Ext.getCmp('tipoOperacion').setValue('creacion');
    }
    Ext.getCmp('usu_contrasena').allowBlank = false;
    Ext.getCmp('usu_recontrasena').allowBlank = false;
    Ext.getCmp('usu_nombres').setDisabled(false);
    Ext.getCmp('usu_apellidos').setDisabled(false);
    Ext.getCmp('usu_sede').setDisabled(false);
    Ext.getCmp('usu_dependencia').setDisabled(false);
    Ext.getCmp('usu_teloficina').setDisabled(false);
    Ext.getCmp('usu_fax').setDisabled(false);
    Ext.getCmp('usu_telcasa').setDisabled(false);
    Ext.getCmp('usu_celular').setDisabled(false);
    Ext.getCmp('usu_email').setDisabled(false);
    Ext.getCmp('usu_rol').setDisabled(false);
  }

  function mostrarFormCrearUsu()
  {
      formularioDatosPersonales.getForm().reset();
      formularioDatosPersonales.setTitle('Nuevo usuario');
      Ext.getCmp('label_1').show();
      Ext.getCmp('label_2').hide();
      Ext.getCmp('usu_sexo_m').setDisabled(false);
      Ext.getCmp('usu_sexo_f').setDisabled(false);
      Ext.getCmp('usu_sexo_m').setValue(false);
      Ext.getCmp('usu_sexo_f').setValue(true);
      Ext.getCmp('radios_estado').hide();
      reiniciarCampos('todos');
      myMask = new Ext.LoadMask(formularioDatosPersonales.getEl(), {msg:'Cargando...',removeMask: true});
      myMask.show();
      setTimeout('myMask.hide()',500);
      Ext.getCmp('foto_usuario').setDisabled(false);
  }
