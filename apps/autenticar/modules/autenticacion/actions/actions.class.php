<?php

/**
 * autenticacion actions.
 *
 * @package    saspa
 * @subpackage autenticacion
 * @author     Luis Armando Nuñez
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class autenticacionActions extends sfActions
{
	
  /**
   * Executes index action
   *
   * @param urlMenu: Contiene la ruta al archivo que tiene configurado el arbol (json)
   * con la configuración del menu que se vera a la izquierda de la pantalla
   *
   * @param urlInicio: Es la ruta al archivo que se cargara en el centro de la pantalla principal,
   * este es la misma para todos los roles.
   */
  public function executeIndex()
  {
    if(!$this->getUser()->isAuthenticated())
    {
      return $this->redirect('autenticacion/login');
    }
    else{
      $this->urlMenu    = URL_SASPA.$this->getUser()->getAttribute('urlMenu');
      $this->urlInicio  = URL_SASPA.$this->getUser()->getAttribute('urlInicio');
    }
  }
  
  
  /**
  * Este metodo se encarga de sacar al usuario del sistema y regresarlo a la pantalla de autenticacion
  */  
  public function executeSalir()
  {
    if($this->getUser()->isAuthenticated())
    {
      $this->getUser()->setAuthenticated(false);
      $this->getUser()->getAttributeHolder()->clear();
    }     
    return $this->redirect('autenticacion/login');//utiliza el GET para redireccionar
  }

  
  /**
  * Este metodo se encargada del ingreso del usuario al sistema mediante
  * la peticion de un nombre de usuario y su respectiva contraseña. 
  */
  public function executeLogin()
  {

    if($this->getUser()->isAuthenticated())
	 {
	   return $this->redirect('autenticacion/index');
	 }
	 
	 
	 //Si es la primera vez que se ingresa al login
    if($this->getRequest()->getMethod() != sfRequest::POST)
	 {
	 	//despliega el formulario para ingreso del login y clave
	   return sfView::SUCCESS;
	   
	 }else{
	 	

	   $login = $this->getRequestParameter('usuario');
	   $password  =  $this->getRequestParameter('contrasena');
	   $usuario = UsuarioPeer::retrieveByPk($login);

	   $this->autenticado = "false";
	   
	   if($usuario)
	   {
	     if( ($password) == $usuario->getUsuContrasena() ){
	       
	       $rol = RolPeer::retrieveByPk($usuario->getUsuRol());
	       
	       //si el usuario esta desactivado no se lo deja ingresar al sistema
	       if($usuario->getUsuEstado() == '02') {
            $this->getUser()->setAuthenticated(false);
            $this->autenticado = "false2";
			   return sfView::SUCCESS;
			 }
	       
	       $this->getUser()->setAttribute('usuario',    $usuario->getUsuIdentificador());
	       $this->getUser()->setAttribute('rol',        $rol->getRolNombre());
	       $this->getUser()->setAttribute('urlMenu',    $rol->getRolUrlMenu());
	       $this->getUser()->setAttribute('urlInicio',  $rol->getRolUrlInicio());
	       $this->getUser()->setAuthenticated(true);
	       
			 return $this->redirect('autenticacion/index');
	     }
	     
	   }
	   
	 }
	 
  }

}
