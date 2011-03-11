<?php

/**
 * usuarios actions.
 *
 * @package    saspa
 * @subpackage usuarios
 * @author     Luis Armando Nuñez
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class usuariosActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    $this->forward('default', 'module');
  }
  
  /**
    * Esta accion se encarga de verificar si el usuario está autenticado en en el sistema
    *
    * @author     Hector F. Cruz Mosquera <hectorcaz@gmail.com>
    * @access     public
    * @copyright  CEDESOFT
    * @since      2008-9-10
    * @return     redirect
    */
    public function preExecute()
    {
        if (!$this->getUser()->isAuthenticated()) {
            return $this->redirect('autenticar/login');
        }
    }
 
   /**
    * Esta accion se encarga de mostrar la interfaz donde el administrador
    * puede gestionar usuarios.
    *
    * @author     Luis Armando Nuñez <armandon20@gmail.com>
    * @access     public
    * @since      2010-3-11
    * @return     void
    */
    public function executeUsuarios()
    {
      
    }
    
    
    /**
    * Accion que permite obtener el listado de los usuarios creados. 
    *
    * @author     Luis Armando Nuñez <armandon20@gmail.com>
    * @access     public
    * @param      string estado -- Estado de los usuarios que se van a listar.
    * @since      2010-3-11
    * @return     string
    */ 
    public function executeLista()
    {
        $estado  =   $this->getRequestParameter('estado');
        $c       = new Criteria();
        $c->add(UsuarioPeer::USU_ESTADO, $estado);
        $c->add(UsuarioPeer::USU_IDENTIFICADOR, $this->getUser()->getAttribute('usuario'), Criteria::NOT_EQUAL); 
        $datosObtenidos = UsuarioPeer::doSelect($c);

        $pos = 0;
        $datos;

        foreach ($datosObtenidos as $usuario) {
            $datos[$pos]['identificador'] = $usuario->getUsuIdentificador();
            $datos[$pos]['estado']        = $usuario->getUsuEstado();
            $datos[$pos]['nombres']       = $usuario->getUsuNombre();
            $datos[$pos]['apellidos']     = $usuario->getUsuApellidos();
            
            $rol =  RolPeer::retrieveByPk($usuario->getUsuRol());            
            $datos[$pos]['rolnombre'] = $rol->getRolNombre();
            $datos[$pos]['rolid']     = $rol->getRolIdentificador();
            $pos++;
        }

        if(isset($datos))
        {
         $rows   = count($datos);
         $data   = json_encode($datos);
         $salida =   '({"total":"' . $rows . '","datos":' . $data . '})';
        }else{
          $salida =   '({"total:"0","datos": {} })';
        }
        
        return $this->renderText($salida);
    }
    
    /**
    * Esta accion permite crear usuarios y modificar los usuarios creados.
    *
    * @author     Luis Armando Nuñez <armandon20@gmail.com>
    * @access     public
    * @param      string identificador -- Numero del documento de identidad
    * @param      string tipoOperacion -- Tipo de operacion que se debe llevar a cabo (creacion o modificacion).
    * @param      string estado -- Id del estado del usuario, habilitado o deshabilitado.
    * @param      string nombres -- Nombre(s) del usuario.
    * @param      string apellidos -- Apellidos del usuario.
    * @param      string idrol -- Id del rol del usuario.
    * @since      2010-3-11
    * @return     string
    */
    public function executeAlmacenar()
    {
        if($this->getRequest()->getMethod() != sfRequest::POST) 
        {
            $this->redirect('autenticar/login');
        }
        else 
        {
            $numeroDocumento    =   $this->getRequestParameter('identificador');
            $operacion          =   $this->getRequestParameter('tipoOperacion');
				$estado		=   $this->getRequestParameter('estado');

            $usuario = UsuarioPeer::retrieveByPk($numeroDocumento);

            if (!isset($usuario) && $operacion == 'creacion') 
            {
                $usuario  = new Usuario();
                $usuario->setUsuIdentificador($this->getRequestParameter('identificador'));                  
                $usuario->setUsuContrasena($this->getRequestParameter('contrasena'));
            }
            else if ($operacion == 'creacion') 
            {
                $salida = '{success: false, errors: {reason: "Este usuario ya existe"}}';
                return $this->renderText($salida);
            }
            
            if ($this->getRequestParameter('contrasena') != '' && $operacion != 'creacion')
            {
                $usuario->setUsuContrasena($this->getRequestParameter('contrasena'));
            }
            
            $usuario->setUsuRol($this->getRequestParameter('idrol'));
            $usuario->setUsuEstado($estado);
            $usuario->setUsuNombre($this->getRequestParameter('nombres'));
            $usuario->setUsuApellidos($this->getRequestParameter('apellidos')); 
            $usuario->save();
            
            $salida = '({success: true})';
        }
        return $this->renderText($salida);
    }
    
    
    
    
}
