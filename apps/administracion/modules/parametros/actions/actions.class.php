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
  
  /**
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
  * Eliminar el registro de una decersion
  * @param string idDecersion : el identificador de la decersion a eliminar
  * @return string
  */
  public function executeEliminarDecersion()
  {
	$decersion = DecersionPeer::retrieveByPk($this->getRequestParameter('idDecersion'));
	if(!isset($decersion))
	{
		return $this->renderText("{ success : true , msg : 'El registro no existe' }");		
	}else{
		$decersion->delete();
		return $this->renderText("{ success : true , msg : 'Registro eliminado' }");
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
		
		if(empty($dec_codigo))
		{
			$objDecersion = new Decersion();
			$objDecersion->setDecSede($sede);//es un campo de texto y $sede es un valor numerico
			$objDecersion->setDecFacultad($facultad);
			$objDecersion->setDecTipoPrograma($tipopro);
			$objDecersion->setDecPeriodo($periodo);
			$objDecersion->setDecValor($valor);//este valor es temporal
	   		$salida = "{ success : true , msg : 'descersion creada' }";
		} else {
			$objDecersion = DecersionPeer::retrieveByPk($dec_codigo);
			if(isset($objDecersion))
			{
				$objDecersion->setDecTipoPrograma($tipopro);
				$objDecersion->setDecPeriodo($periodo);
				$objDecersion->setDecValor($valor);
		   		$salida = "{ success : true , msg : 'decersion actualizada' }";
			}else{
				$salida = "{ success : false , msg : 'decersion no existe' }";
			}
		}
		
		if($objDecersion instanceof Decersion)
		{
		    $objDecersion->save();
		}
		
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
			$datos[$pos]['sede']         = SedePeer::retrieveByPk($dec->getDecSede())->getSedNombre();
  			$datos[$pos]['facultad']     = FacultadPeer::retrieveByPk($dec->getDecFacultad())->getFacNombre();
  			$datos[$pos]['decId']        = $dec->getDecId();
  			$datos[$pos]['periodo']      = $dec->getDecPeriodo();
  			$datos[$pos]['tipoPrograma'] = $dec->getDecTipoPrograma();
  			$datos[$pos]['valor']        = $dec->getDecValor();
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
  
  /**
  * Gestiona la asignacion de valores de matricula a los programas de pregrado
  */
  public function executeMatricula()
  {
	if($this->getRequest()->getMethod() != sfRequest::POST) 
 	{
		return sfView::SUCCESS;
	}else{
	  $salida = "";
	  $objMatricula;

	  $matCodigo   = $this->getRequestParameter('mat_id');
	  $matFacultad = $this->getRequestParameter('mat_facultad');
	  $matSede     = $this->getRequestParameter('mat_sede');
	  $matAno      = $this->getRequestParameter('mat_ano');
	  $matValor    = $this->getRequestParameter('mat_valor');

	  if(empty($matCodigo))
	  {
	    $objMatricula = new Matricula();
	    $objMatricula->setMatFacultad($matFacultad);
	    $objMatricula->setMatSede($matSede);
	    $objMatricula->setMatAno($matAno);
	    $objMatricula->setMatValor($matValor);
	    $salida = "{ success : true , msg : 'Matricula creada' }";
	  } else {
	    
	    $objMatricula = MatriculaPeer::retrieveByPk($matCodigo);
	    if(isset($objMatricula))
	    {
		$objMatricula->setMatAno($matAno);
		$objMatricula->setMatValor($matValor);
		$salida = "{ success : true , msg : 'Matricula actualizada' }";
	    }else{
		$salida = "{ success : false , msg : 'Matricula no existe' }";
	    }
	  }
	  
	  ///Para que no ocurra un error cuando la matricula no existe
	  if($objMatricula instanceof Matricula)
	  {
	    $objMatricula->save();
	  }
	  
	  return $this->renderText($salida);

	}
  }

  /**
  * Eliminar una matricula
  * @param object request
  * @return string
  */
  public function executeEliminarMatricula()
  {
	$matricula = MatriculaPeer::retrieveByPk($this->getRequestParameter('idMatricula'));
	if(isset($matricula))
	{
		$matricula->delete();
		return $this->renderText("{ success : true , msg : 'Matricula eliminada' }");
	}else{
		return $this->renderText("{ success : true , msg : 'La matricula no existe' }");		
	}
  }


  /**
  * Retorna una lista de los valores de matricula para pregrado
  * @return string json
  */
  public function executeListarMatricula()
  {
    $c = new Criteria();
    $matriculas = MatriculaPeer::doSelect($c);

    $pos = 0;
    $datos;
    foreach($matriculas as $mat)
    {
      $datos[$pos]['mat_sede']     = SedePeer::retrieveByPk($mat->getMatSede())->getSedNombre();
      $datos[$pos]['mat_facultad'] = FacultadPeer::retrieveByPk($mat->getMatFacultad())->getFacNombre();
      $datos[$pos]['mat_id']        = $mat->getMatId();
      $datos[$pos]['mat_ano']      = $mat->getMatAno();
      $datos[$pos]['mat_valor']    = $mat->getMatValor();
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
  * Se encarga del manejo de los parametros del sistema que no son
  * tablas
  * @return void
  */
  public function executeParametros()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }else {
      $salida = "";
      $objParametro;

      $valor = $this->getRequestParameter('paraValor');
      $param = $this->getRequestParameter('paraNombre');
      $ano   = $this->getRequestParameter('paraAno');
      $ope   = $this->getRequestParameter('operacion');
      
      if($ope == 'cre'){
      
	$objParametro = new Parametros();
	$objParametro->setParNombre($param);
	$objParametro->setParAno($ano);
	$objParametro->setParValor($valor);
	$salida = "{ success : true , msg : 'Parametro creado' }";
	
      } else if( $ope = 'act') {
	
	$objParametro = ParametrosPeer::retrieveByPk($param,$ano);
	if(isset($objParametro)){
	  $objParametro->setParValor($valor);
	  $salida = "{ success : true , msg : 'Parametro actualizado' }";
	}else{
	  $salida = "{ success : true , msg : 'Parametro no existe, no se pudo actualizar' }";
	}
	
      }
       
      if($objParametro instanceof Parametros)
      {
	$objParametro->save();
      }      
      return $this->renderText($salida);

    }
    
    
  }
  
  /**
  * Retorna los registros de la tabla parametros y los envia al cliente
  * en una cadena json
  * @return string $salida : la cadena json con los registros
  */
  public function executeListarParametros(){
    
    $c = new Criteria();
    $parametros = ParametrosPeer::doSelect($c);
    
    $pos = 0;
    $datos;
    foreach($parametros as $param)
    {
      $datos[$pos]['paraNombre'] = $param->getParNombre();
      $datos[$pos]['paraAno']    = $param->getParAno();
      $datos[$pos]['paraValor']  = $param->getParValor();
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


}
