<?php

/**
 * parametros actions.
 *
 * @package    saspa
 * @subpackage parametros
 * @author     Luis Armando Nuñez Sanchez
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class parametrosActions extends sfActions
{
  
  /**
  * Gestiona los docentes (Executes index action)
  *
  */
  public function executeIndex()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST) 
  	 {
		return sfView::SUCCESS;
    }else{
    	
    	$docente;
    	if($this->getRequestParameter('operacion') == 'Crear') {
		$docente = DocentesPeer::retrieveByPk($this->getRequestParameter('cedula'));
		if(!isset($docente)) {
			$docente = new Docentes();
    			$docente->setCedula($this->getRequestParameter('cedula'));
		} else {
			return $this->renderText("{ success : false,  msg : 'No se pudo crear el docente por que ya existe' }");
		}
    	}
    	else {
    		$docente = DocentesPeer::retrieveByPk($this->getRequestParameter('cedula'));
    		if(!isset($docente))
    			return $this->renderText("{ success : false,  msg : 'El docente no existe'}");
    	}
    	$docente->setNombre($this->getRequestParameter('nombre'));
    	$docente->setApellidos($this->getRequestParameter('apellidos'));
	$docente->setFacultad($this->getRequestParameter('facultad'));
	$docente->setDependencia($this->getRequestParameter('dependencia'));
	$docente->setCategoria($this->getRequestParameter('categoria'));		
	$docente->save();
    	return $this->renderText("{ success : true,  msg : 'Docente creado' }");
    }

  }
  
  
  /**
  * Lista los doncentes
  * @return string 
  */
  public function executeListarDocentes()
  {
		$c = new Criteria();
		$docentes = DocentesPeer::doSelect($c);
			
		$datos = array();
		$cont = 0;
		foreach($docentes as $docente)
		{
			$datos[$cont]['cedula']= $docente->getCedula();
			$datos[$cont]['nombre']= $docente->getNombre();
			$datos[$cont]['apellidos']= $docente->getApellidos();
			$datos[$cont]['facultad']= $docente->getFacultad();
			$datos[$cont]['dependencia']= $docente->getDependencia();
			$datos[$cont]['categoria']= $docente->getCategoria();
			$cont++;
		}
		
		$js_datos = "{ datos : ".json_encode($datos)." }";
		
		return $this->renderText($js_datos);
  }

  /*
  * Lista las facultades
  * return string json
  */
  public function executeListarFacultades()
  {
  		$c = new Criteria();
		$facultades = FacultadPeer::doSelect($c);
		
		$datos = array();
		$cont = 0;
		foreach($facultades as $facultad)
		{
			$datos[$cont]['fac_id']     = $facultad->getFacId();
			$datos[$cont]['fac_nombre'] = $facultad->getFacNombre();
			$cont++;
		}
  		
		return $this->renderText(json_encode($datos));
  }
  
  /*
  * Lista las sedes
  * @return string json
  */
  public function executeListarSedes()
  {
  		$c = new Criteria();
		$sedes = SedePeer::doSelect($c);
		
		$datos = array();
		$cont = 0;
		foreach($sedes as $sede)
		{
			$datos[$cont]['sed_codigo'] = $sede->getSedCodigo();
			$datos[$cont]['sed_nombre'] = $sede->getSedNombre();
			$cont++;
		}
  		
		return $this->renderText(json_encode($datos));
  }

  
  /*
  * Lista las dependencias
  * @return string json
  */
  public function executeListarDependencias()
  {
  		$c = new Criteria();
  		$c->add(DependenciaPeer::DEP_FACULTAD, $this->getRequestParameter('idFacultad'));
  		$dependencias = DependenciaPeer::doSelect($c);
  		
		$datos = array();
		$cont = 0;
		foreach($dependencias as $dependencia)
		{
			$datos[$cont]['dep_codigo'] = $dependencia->getDepCodigo();
			$datos[$cont]['dep_nombre'] = $dependencia->getDepNombre();
			$cont++;
		}
		
		return $this->renderText(json_encode($datos));
  }
  
  /**
  * Crea o Actualiza una dependencia
  * @return string json
  */
  public function executeAlmacenarDependencia()
  {
    	$dependencia;
    	$op = $this->getRequestParameter('operacion');
    	if($op == 'Crear'){
    		$dependencia = new Dependencia();
    		$dependencia->setDepFacultad($this->getRequestParameter('depfacultad'));
    	}
    	else{
    		$dependencia = DependenciaPeer::retrieveByPk($this->getRequestParameter('dep_codigo'));
    		if(!isset($dependencia))
    			return $this->renderText("{ success : false,  msg : 'La dependencia no existe'}");
    	}
    	$dependencia->setDepNombre($this->getRequestParameter('dep_nombre'));
    	$dependencia->setDepCodigo($this->getRequestParameter('dep_codigo'));
	$dependencia->save();
	return $this->renderText("{ success : true, msg : '".$op." Dependencia terminado'}");
  }
  
  
  /**
  * Elimina un docente
  * @param string cedulaDocente
  * @return string json
  */
  public function executeEliminarDocente()
  {
  		$cedulaDocente = $this->getRequestParameter('cedulaDocente');
  		$docente = DocentesPeer::retrieveByPk($cedulaDocente);
  		if(isset($docente))
  		{
  			$docente->delete();
  			return $this->renderText("{ success : true, msg : 'Docente eliminado'}");
  		}else{
  			return $this->renderText("{ success : false, msg : 'Docente no existe'}");	
  		}
  }
  
  /**
  * Eliminar una dependencia
  * @param object request
  * @return string json
  */
  public function executeEliminarDependencia()
  {
	$dependencia = DependenciaPeer::retrieveByPk($this->getRequestParameter('dep_codigo'));
	if(!isset($dependencia))
	{
		return $this->renderText("{ success : true , msg : 'La dependencia no existe' }");		
	}else{
		$dependencia->delete();
		return $this->renderText("{ success : true , msg : 'Dependencia eliminada' }");
	}
  }


  /**
  * Eliminar una facultad
  * @param object request
  * @return string
  */
  public function executeEliminarFacultad()
  {
	$facultad = FacultadPeer::retrieveByPk($this->getRequestParameter('fac_id'));
	if(isset($facultad))
	{
		$facultad->delete();
		return $this->renderText("{ success : true , msg : 'facultad eliminada' }");
	}else{
		return $this->renderText("{ success : true , msg : 'La facultad no existe' }");		
	}
  }

  
  
  /**
  * Gestiona la dercersion en los diferentes programas academicos
  * 
  */
  public function executeDesercion()
  {
	if($this->getRequest()->getMethod() != sfRequest::POST) 
 	{
		return sfView::SUCCESS;
	} else {
   		$salida = "";
		$objDecersion;

		$dec_codigo = $this->getRequestParameter('decId');
		$sede       = $this->getRequestParameter('sede');
		$facultad   = $this->getRequestParameter('facultad');
		$tipopro    = $this->getRequestParameter('tipoPrograma');
		$periodo    = $this->getRequestParameter('periodo');
		$valor      = $this->getRequestParameter('valor');
   		$salida     = "{ success : true , msg : 'Prueba', sede : '.$sede.', facultad : '.$facultad.' }";
		/*
		if(empty($dec_codigo))
		{
			$objDecersion = new Decersion();
			$objDecersion->setDecSede($sede);//es un campo de texto y $sede es un valor numerico
			$objDecersion->setDecFacultad($facultad);
			$objDecersion->setDecTipoPrograma($tipopro);
			$objDecersion->setDecPeriodo($periodo);
			$objDecersion->setDecValor(0.5);//este valor es temporal
	   		$salida = "{ success : true , msg : 'descersion creada' }";
		} else {
			$objDecersion = DecersionPeer::retrieveByPk($dec_codigo);
			if(isset($objDecersion))
			{
				$objDecersion->setDecSede($sede);//es un campo de texto y $sede es un valor numerico
				$objDecersion->setDecFacultad($facultad);
				$objDecersion->setDecTipoPrograma($tipopro);
				$objDecersion->setDecPeriodo($periodo);
				$objDecersion->setDecValor(0.5);//este valor es temporal
		   		$salida = "{ success : true , msg : 'decersion actualizada' }";
			}else{
				$salida = "{ success : false , msg : 'decersion no existe' }";
			}
		}
		$objDecersion->save();*/
		return $this->renderText($salida);
	}
  }
  
  /*
  * Lista la informacion que esta en la tabla decersion
  * @author Luis A. Nuñez
  * @since 2011-Mar-02
  */
  public function executeListarDecersion()
  {
  		$c = new Criteria();
  		$decersiones = DecersionPeer::doSelect($c);
  		
  		$pos = 0;
  		$datos;
  		foreach($decersiones as $dec)
  		{
			$datos[$pos]['sede'] = $dec->getDecSede();
  			$datos[$pos]['facultad'] = $dec->getDecFacultad();

  			$datos[$pos]['decId'] = $dec->getDecId();
  			$datos[$pos]['periodo'] = $dec->getDecPeriodo();
  			$datos[$pos]['tipoPrograma'] = $dec->getDecTipoPrograma();
  			$datos[$pos]['valor'] = $dec->getDecValor();
			
  			$pos++;
  		}
  		
  		if(isset($datos))
  		{
         $data   = json_encode($datos);
         $salida =   '({"datos":' . $data . '})';
  		} else {
  			$salida =   '({"datos": {} })';
  		}
  		
  		return $this->renderText($salida);
  }
  
  
  /**
  * Gestiona las facultades y sus correspondientes dependencias
  */
  public function executeFacultad()
  {
  		if($this->getRequest()->getMethod() != sfRequest::POST) 
  	 	{
			return sfView::SUCCESS;
	   }else{
	   	$op = $this->getRequestParameter('operacion');
	   	$facultad;
	   	if($op == 'Crear')
	   	{
	   		$facultad = new Facultad();
	   	}else{
	   		$facultad = FacultadPeer::retrieveByPk($this->getRequestParameter('fac_id'));
	   		if(!isset($facultad))
	   		{
	   			return $this->renderText("{ success : true, msg : 'La facultad ya no existe'}");
	   		}
	   	}
	   	$facultad->setFacNombre($this->getRequestParameter('fac_nombre'));
	   	$facultad->save();
	   	return $this->renderText("{ success : true, msg : '".$op." Facultad terminado'}");
	   }
		
  }
  
  
}
