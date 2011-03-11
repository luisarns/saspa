<?php

/**
 * inicio actions.
 *
 * @package    saspa
 * @subpackage inicio
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class inicioActions extends sfActions
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
   * Esta accion se encarga de mostrar la interfaz del menu asignado al usuario
   *
   * @author     Luis A. Nuñez <armandon20@gmail.com>
   * @access     public
   * @since      2010-5-8
   * @return     void
  */
  public  function  executeMenuAnalisis()
  {

  }
  
  /**
  * Esta accion se encarga de mostrar la interfaz inicial del panel central al usuario
  *
  * @author     Luis A. Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-5-8
  * @return     void
  */
  public  function  executeInicioAnalisis()
  {

  }
  
  
  
}
