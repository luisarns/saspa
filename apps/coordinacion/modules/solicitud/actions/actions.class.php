<?php

/**
 * solicitud actions.
 *
 * @package    saspa
 * @subpackage solicitud
 * @author     Luis A. Nuñez
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class solicitudActions extends sfActions
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
  * Muestra todas las solicitudes
  */
  public function executeConsultar()
  {
	 $c = new Criteria();
	 $c->add(SolicitudPeer::SOL_ESTADO,'Revision');
    $solicitudes = SolicitudPeer::doSelect($c);

    $pos = 0;
    $datos = array();    
    foreach($solicitudes as $solicitud)
    {
      $c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID, $solicitud->getSolId());
      $infGeneral = InformacionGeneralPeer::doSelectOne($c);
      $sol_motivo = "Sin definir";
      $sol_programa = "Sin definir";
      
      
      $usuario = UsuarioPeer::retrieveByPk($solicitud->getSolUsuario());
      if(isset($usuario)){
      	$solicitante = $usuario->getUsuIdentificador()."-".$usuario->getUsuNombre();
      }
      
      if(isset($infGeneral))
      {
        $sol_motivo = $infGeneral->getIngMotivoSolicitud();
        $sol_programa = $infGeneral->getIngNombrePrograma();
        $tipoPrograma = $infGeneral->getIngNivelAcademico();
        $duracion = $infGeneral->getIngDuracionPrograma();
      }
      
      //obtengo los matriculados (admitidos) y los inscritos 
      $c = new Criteria();
      $c->add(PresupuestoIngresosPeer::PIN_SOL_ID,$solicitud->getSolId());
      $presIngreso = PresupuestoIngresosPeer::doSelectOne($c);
      if(isset($presIngreso)){
			$numInscritos = $presIngreso->getPinNumeroInscritos(); 
			$numAdmitidos = $presIngreso->getPinNumeroMatriculados();    
      }
      
      $datos[$pos][] = $tipoPrograma;   
      $datos[$pos][] = $solicitud->getSolEstado();
      $datos[$pos][] = $solicitud->getUpdatedAt();
      $datos[$pos][] = $solicitante;
      $datos[$pos][] = $sol_motivo;//tipo analisis
      $datos[$pos][] = $duracion;
      $datos[$pos][] = $numInscritos; 
      $datos[$pos][] = $numAdmitidos;
      $datos[$pos][] = $solicitud->getSolFacultad();
      $datos[$pos][] = $solicitud->getSolEscuela();//escuela
      $pos++;
    }
    
    $this->regSolicitudes = json_encode($datos);
  }
  
  /**
  * 
  */
  public function executeRevisar()
  {
  		if($this->getRequest()->getMethod() != sfRequest::POST)
  		{
  			return sfView::SUCCESS;
  		}else{
  			$salida = "";
  			$solicitud = SolicitudPeer::retrieveByPk($this->getRequestParameter('sol_id'));
  			if(isset($solicitud))
  			{
  				$operacion = $this->getRequestParameter('operacion');
  				
  				if($operacion == 'Devolver')
  				{
  					$solicitud->setSolEstado('Analisis');
  					$solicitud->save();
  					$salida = "{ success: true, msg : 'Solicitud devuelta a analisis'}";  					
  				}else{
  					$salida = "{ success: true, msg : 'Solicitud revisada' }";
  				}
  				
  			} else {
  				$salida = "{ success: false, error : 'Solicitud no encontrada'}";
  			}  			
  			return $this->renderText($salida);
  		}
  		
  }
  
  /**
  * este metodo se encarga de aplicar un comentario a una solicitud
  * @param int sol_id: identificador de la solicitud a comentar 
  */
  public function executeComentarSolicitud()
  {
  		$salida = "";
  		$solicitud = SolicitudPeer::retrieveByPk($this->getRequestParameter('id'));
  		if(isset($solicitud))
      {
      	//Aplico el comentario a la solicitud
      	$comentario = new Comentario();
      	$com = $this->getRequestParameter('comentario');
      	
      	//empty: si la cadena basia es pasada devuelve true
			if(!empty($com)){
			   $comentario->setComSolicitud($solicitud->getSolId());
			   $comentario->setComDescripcion($com);
			   $comentario->setComUsuario($this->getUser()->getAttribute('usuario'));
			   $comentario->setComSolEstado('No procesada');//Procesada
			   $comentario->save();
		   }      	
      	$salida = "{ success: true, msg : 'Comentario realizado' }";
      	
      }else {
      	//cuando la solicitud no existe
      	$salida = "{ success: false, error : 'Solicitud no encontrada'}";
      }
  		return $this->renderText($salida);
  }
  
  
  /**
   * En este metodo se listan las solicitudes del usuario
   * @param usu_identificador el numero de cedula del usuario
   * @author     Luis Armando Nuñez <armandon20@gmail.com>
   * @access     public
   * @since      2010-3-15
   * @return     string la lista en formato json de todas las solicitudes del usuario en cuestion
   */
  public function executeLista()
  {       
    $c = new Criteria();
    $c->add(SolicitudPeer::SOL_ESTADO,'Revision');
    $solicitudes = SolicitudPeer::doSelect($c);
    
    $pos = 0;
    $datos;
    foreach($solicitudes as $solicitud)
    {
      $datos[$pos]['sol_id']= $solicitud->getSolId();
      $datos[$pos]['sol_nombre']= $solicitud->getSolNombre();
      $datos[$pos]['sol_escuela']= $solicitud->getSolEscuela();
      $datos[$pos]['sol_facultad']= $solicitud->getSolFacultad();
      $datos[$pos]['sol_archivo']= $solicitud->getSolArchivo();
      $datos[$pos]['sol_estado']= $solicitud->getSolEstado();
      $datos[$pos]['sol_usuario']= $solicitud->getSolUsuario();
      $datos[$pos]['created_at']= $solicitud->getCreatedAt();
      $datos[$pos]['updated_at']= $solicitud->getUpdatedAt();
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
  
  
  
  
}
