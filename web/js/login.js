function validar()
{
     //VALIDACION #2
  if(document.formulario.usuario.value.length > 0)
  {
    for(var i=1; i < document.formulario.usuario.value.length; i++)
    {
      if(document.formulario.usuario.value.charAt(i) == " ")
      {
        document.getElementById('informe').innerHTML="<img src='../images/error.gif'>\n\nSu Usuario no debe contener espacios en blanco";
        return false;
      }
    }
  }

  //VALIDACION #4
  if(document.formulario.contrasena.value.length > 0)
  {
    for(var i=1; i < document.formulario.contrasena.value.length; i++)
    {
      if(document.formulario.contrasena.value.charAt(i) == " ")
      {
        document.getElementById('informe').innerHTML="<img src='../images/error.gif'>\n\nSu Contrasena no debe contener espacios en blanco.";
        return false;
      }
    }

    document.formulario.contrasena.value  = hex_md5(document.formulario.contrasena.value );
  }

  //VALIDACION #1.
  if ( document.formulario.usuario.value.charAt(0) == "" )
  {
    document.getElementById('informe').innerHTML="<img src='../images/error.gif'>\n\nPor favor escriba su Usuario.";
    return false;

  }

  //VALIDACION #3
  if ( document.formulario.contrasena.value.charAt(0) == "")
  {
    document.getElementById('informe').innerHTML="<img src='../images/error.gif'>\n\nPor favor escriba su Contrasena.";
    return false;
  }
  else
  {
    return true;
  }

}
