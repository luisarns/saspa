<?php

/**
 * solicitud actions.
 *
 * @package    saspa
 * @subpackage solicitud
 * @author     Luis Armando Nuñez Sanchez <armandon20@gmail.com>
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
  }
  
  
  /**
   * Esta accion en la encargada de desplegar el panel que contiene la interfaz para crear, eliminar
   * actualizar y diligenciar las solicitudes.
   */
  public function executeSolicitudes()
  {
		if($this->getRequest()->getMethod() != sfRequest::POST) {
			$this->docfacultad = "";
			$this->docescuela = "";
			
			$docente = DocentesPeer::retrieveByPk($this->getUser()->getAttribute('usuario'));
			if(isset($docente)) {
				$this->docfacultad = $docente->getFacultad();
				$this->docescuela = $docente->getDependencia();
			}
		}
  }
  
  
   /**
   * Guarda los datos de la solicitud
   * 
   * @author     Luis Armando Nuñez <armandon20@gmail.com>
   * @access     public
   * @since      2010-3-15
   * @param string $sol_nombre Nombre de la solicitud
   * @param string $sol_estado El estado de la solicitud 
   * @param string $sol_escuela Escuela a la que pertenece el Usuario
   * @param string $sol_facultad Facultad a la que pertenece el Usuario
   * @param string $tipoOperacion La operacion a realizar con la informacion
   * @return string $salida
   */
  public function executeAlmacenar()
  {
    $operacion = $this->getRequestParameter('tipoOperacion');
    $sol_id    = $this->getRequestParameter('sol_id');
    
    if($operacion == 'creacion') {
      $solicitud = new Solicitud();
      $solicitud->setSolNombre($this->getRequestParameter('sol_nombre'));
      $solicitud->setSolEscuela($this->getRequestParameter('sol_escuela'));
      $solicitud->setSolFacultad($this->getRequestParameter('sol_facultad'));
      $solicitud->setSolEstado($this->getRequestParameter('sol_estado'));
      $solicitud->setSolUsuario($this->getUser()->getAttribute('usuario'));
      $solicitud->save();
      
      if(isset($solicitud)) {
        $salida = "{ success : true,  msg : 'Nueva solicitud registrada' }";
      } else {
        $salida = "{ success : false, errors : { reason : 'No se pudo crear la solicitud' } }";
      }
      
    } elseif (isset($sol_id)) {
      $solicitud = SolicitudPeer::retrieveByPk($sol_id);
      if(isset($solicitud))
      {
        $solicitud->setSolNombre($this->getRequestParameter('sol_nombre'));
        $solicitud->save();
        $salida = "{ success: true, msg:'Se actualizo la solicitud'}";
        
      } else {
        $salida = "{ success: false, errors : { reason : 'La solicitud no esta registrada' } }";
      }
      
    } else {
    	$salida = "{ success: false, errors : { reason : 'Esta funcion no esta definida' } }";
    }
        
    return $this->renderText($salida);
    
  }
  
  /** Este metodo elimina una solicitud del sistema con todo y los rejistros contenidos
  * en los formularios asociados a ella.
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-05-11
  * @param sol_id el identificador de la solicitud a eliminar
  */
  public function executeEliminar()
  {
    $salida;
    $sol_id = $this->getRequestParameter('sol_id');   
    $solicitud = SolicitudPeer::retrieveByPk($sol_id);
    
    if(isset($solicitud))
    {
      $solicitud->delete();
      $salida = "{ success: true, msg:'Solicitud eliminada'}";
    }else{
      $salida = "{ success: true, msg:'La solicitud no esta registrada'}";
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
    $c->add(SolicitudPeer::SOL_USUARIO, $this->getUser()->getAttribute('usuario'));
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
  
  
  /**
  * En este metodo se encarga de mostra el formulario de informacion general y de 
  * almacenar los campos ingresados en este formulario al sistema.  
  *
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-3-15
  * @param solicitud el numero de la solicitud que se esta diligenciando 
  */
  public function executeInformacionGeneral()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->solId      = $this->getUser()->getAttribute('solicitud');
      $this->solusuario = $this->getUser()->getAttribute('usuario');
      return sfView::SUCCESS;
    } else {
    
      $ing_id = $this->getRequestParameter('ing_id');
      $informacionGeneral = InformacionGeneralPeer::retrieveByPk($ing_id);
      if(!isset($informacionGeneral))
      {
        //creacion de un nuevo rejistro
        $informacionGeneral = new InformacionGeneral();//declaro el nuevo registro
        $informacionGeneral->setIngSolId($this->getRequestParameter('solicitudnumero'));//codigo de la solicitud
        $informacionGeneral->setIngSolicitante($this->getRequestParameter('solicitante'));
        $informacionGeneral->setIngFacultad($this->getRequestParameter('facultad'));



	//----------------------MODIFICAR-----------------------//
	// Hay que recibir los codigos y estos son los que se van a almacenar 
	//en la base de datos
        $informacionGeneral->setIngFecha($this->getRequestParameter('fechasolicitud'));
        $informacionGeneral->setIngEscuela($this->getRequestParameter('escuela'));
        //-----------------------------------------------------//
        
        
        
        $informacionGeneral->setIngDuracionPrograma($this->getRequestParameter('duracionprograma'));
        $informacionGeneral->setIngTipoValor($this->getRequestParameter('mododepago'));
      }
      
      $informacionGeneral->setIngNombrePrograma($this->getRequestParameter('nombreprograma'));
      $informacionGeneral->setIngTituloOtorga($this->getRequestParameter('titulootorga'));
      $informacionGeneral->setIngMotivoSolicitud($this->getRequestParameter('motivosolicitud'));
      
      if($informacionGeneral->getIngMotivoSolicitud() == 'Otro')
      {
        $informacionGeneral->setIngCualMotivo($this->getRequestParameter('cualmotivosolicitud'));
      }
      
      $informacionGeneral->setIngCiudadSede($this->getRequestParameter('sede'));
      $informacionGeneral->setIngNivelAcademico($this->getRequestParameter('nivelacademico'));
      $informacionGeneral->setIngJornada($this->getRequestParameter('jornada'));
      $informacionGeneral->setIngTipoModalidad($this->getRequestParameter('modalidad'));
      
      
      if($informacionGeneral->getIngTipoValor() == 'Valor Unico')
      { 
        $informacionGeneral->setIngFormaPago($this->getRequestParameter('opcionespagoperiodo'));
        $informacionGeneral->setIngValor($this->getRequestParameter('valorunico'));
      }

      $informacionGeneral->save();//creo el rejistro en la bd
      $valoresDirefenciados = $this->getRequestParameter('valoresDiferenciados');//obtengo el arreglo json
       
      if(isset($valoresDirefenciados))//si no esta basio
      {
        $records = json_decode(stripslashes($valoresDirefenciados)); 
        $ing_id = $informacionGeneral->getIngId(); //obtengo el id asignado por symfony al rejistro
        
        foreach($records as $record)
        {
          $valdif = ValorDiferenciadoPeer::retrieveByPk($ing_id,$record->periodo);//recupero el rejistro de la bd
          if(isset($valdif))//si ya existe actualizo su valor y lo guardo
          {
            $valdif->setVadValor($record->valor); //actualizo el valor del rejistro
            $valdif->save();
          }else{//creo el nuevo rejistro y lo  guardo
            $valdif = new ValorDiferenciado();
            $valdif->setVadIngId($ing_id);
            $valdif->setVadPeriodo($record->periodo);
            $valdif->setVadValor($record->valor);
            $valdif->save();
          }
        }
        
      }
      
      $salida = "{success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/extructuraCurricular' }";
      return $this->renderText($salida);
    }
  
  }
  
  
  /**
  * En este metodo se encarga de manejar el proceso de diligenciado de la estructura curricular 
  * asociada a una determinada solicitud 
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-04-12
  * @param solicitud el numero de la solicitud que se esta diligenciando 
  */
  public function executeExtructuraCurricular()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->sol_id = $this->getUser()->getAttribute('solicitud');
      $this->usu_identificador = $this->getUser()->getAttribute('usuario');
      return sfView::SUCCESS;
    }else{
      //obtengo los rejistros ha modificar
      $add = $this->getRequestParameter('records');
      if(isset($add))
      {
        $records = json_decode(stripslashes($add)); //convierte el string en un objeto PHP
        $ids = array();
        foreach($records as $record)
        {
          $regCurricular; 
          if(isset($record->newRecordId))//si es un dato nuevo 
          {
            $regCurricular = new ExtructuraCurricular();
            $regCurricular->setEcuSolId($record->sol_id);
            $regCurricular->setEcuPeriodoAcademico($record->periodo );
            $regCurricular->setEcuAsignatura($record->asignatura);
            $regCurricular->setEcuNumCreditos($record->num_creditos);
            $regCurricular->setEcuTotalHoras($record->total_horas);
            $regCurricular->setEcuNumProgramaComparte($record->num_programa_comparte);
            $regCurricular->setEcuCategoriaDocente($record->categoria_docente);
            $regCurricular->setEcuHorasDictadasComo($record->horas_dictadas_como);
            $regCurricular->setEcuValorHora($record->valor_hora);
            $regCurricular->save();//guardo el rejistro en la bd

            //aqui guardo los id asignados a los rejistro para enviarlos al cliente 
            array_push($ids,array('oldId'=>$record->newRecordId,'id'=>$regCurricular->getEcuId()));
          }else{//si es una actualizacion

            $regCurricular = ExtructuraCurricularPeer::retrieveByPk($record->id);
            $regCurricular->setEcuPeriodoAcademico($record->periodo);
            $regCurricular->setEcuAsignatura($record->asignatura);
            $regCurricular->setEcuNumCreditos($record->num_creditos);
            $regCurricular->setEcuTotalHoras($record->total_horas);
            $regCurricular->setEcuNumProgramaComparte($record->num_programa_comparte);
            $regCurricular->setEcuCategoriaDocente($record->categoria_docente);
            $regCurricular->setEcuHorasDictadasComo($record->horas_dictadas_como);
            $regCurricular->setEcuValorHora($record->valor_hora);
            $regCurricular->save();//guardo el rejistro en la bd
          }
          
        }
        //envio los rejistros creados con su identificador definido en el cliente 
        //y con el nuevo identificador asignado por symfony
        $salida =  json_encode(array('success'=>true,'data'=>$ids));
        return $this->renderText($salida);
      }
      
      //eliminar un rejistro de la base de datos
      $delId = $this->getRequestParameter('id');
      if(isset($delId))
      {
        $salida;
        $delAsigntura = ExtructuraCurricularPeer::retrieveByPk($delId);        
        if(isset($delAsigntura))
        {
          $delAsigntura->delete();//elimino el rejistro de la bd
          $salida = json_encode(array('success'=>true));
        }else{
        	 $salida = json_encode(array('success'=>false, 'error'=>'El registro no se encuetra en la base de datos'));
        }
        return  $this->renderText($salida);
      }
      
      //Cuando el usuario da clic en el boton siguiente del formulario extructura curricular
      $siguiente = $this->getRequestParameter('siguiente');
      if(isset($siguiente))
      {
        $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/presupuestoIngreso'}";
        return $this->renderText($salida);
      }
      
      
    } 
    
  }
  
  /**
  * En este metodo se encarga de manejar el proceso de diligenciado del presupuesto de ingresos 
  * asociado a una solicitud 
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-04-26
  * @param solicitud el numero de la solicitud que se esta diligenciando 
  */
  public function executePresupuestoIngreso()
  {
    $this->sol_id = $this->getUser()->getAttribute('solicitud');
    
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      
      $this->usu_identificador = $this->getUser()->getAttribute('usuario');
      return sfView::SUCCESS;
    }else{
      
      $delId = $this->getRequestParameter('id');
      if(isset($delId))
      {
        $c = new Criteria();
        $c->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $delId);
        $elimnados = ContribucionFuenteExternaPeer::doDelete($c);
        
        $fuenteExterna = FuentesExternasPeer::retrieveByPk($delId);
        $fuenteExterna->delete();
        
        $salida = "{ success: true }";
        return $this->renderText($salida);
      }
      
      //para el caso en que hay que guardar la informacion del presupuesto de ingreso
      $siguiente = $this->getRequestParameter('siguiente');
      if(isset($siguiente))
      {
        //guardo la informacion basica de presupuesto ingreso
        $presupuestoIngreso = PresupuestoIngresosPeer::retrieveByPk($this->getRequestParameter('pin_id'));
        if(!isset($presupuestoIngreso))
        {
          $presupuestoIngreso = new PresupuestoIngresos();
          $presupuestoIngreso->setPinSolId($this->sol_id);
        }
        $presupuestoIngreso->setPinNumeroInscritos($this->getRequestParameter('estudiantesInscritos'));
        $presupuestoIngreso->setPinNumeroMatriculados($this->getRequestParameter('estudiantesMatriculados'));
        $presupuestoIngreso->setPinExenciones($this->getRequestParameter('exenciones'));
        
        $presupuestoIngreso->save(); //guardamos el presupuesto de ingresos
        $pin_id = $presupuestoIngreso->getPinId(); //obtengo el identificador del presupuesto de ingresos 
        
        $add = $this->getRequestParameter('fuentesExternas');
        $numPeriodos = $this->getRequestParameter('periodos');
        
        if(isset($add))
        {
          $records = json_decode(stripslashes($add));
          foreach($records as $record)
          {
            $becaId = (isset($record->id))?$record->id:'';//el identificador de la fuente externa
            
            if(isset($record->newRecordId))//si es un nuevo rejistro
            {
              //creo la nueva fuente externa
              $nBeca = new FuentesExternas();
              $nBeca->setFueSolId($this->sol_id);
              $nBeca->setFueNombre($record->nombre); 
              $nBeca->save();
              $becaId = $nBeca->getFueId();
            }
            
            for($i = 1 ; $i <= $numPeriodos ; $i++)
            {
              //puede ser una actualizacion o un nueva contribucion
              $nNumPeriodoBeca = ContribucionFuenteExternaPeer::retrieveByPk($pin_id,$becaId,$i);
              if(!isset($nNumPeriodoBeca))
              {
                $nNumPeriodoBeca = new ContribucionFuenteExterna();
                $nNumPeriodoBeca->setCfePinId($pin_id);
                $nNumPeriodoBeca->setCfeFueId($becaId);
                $nNumPeriodoBeca->setCfePeriodo($i);
              }
              $nNumPeriodoBeca->setCfeValor($record->$i);//hay un error ??? Undefined property: stdClass::$10
              $nNumPeriodoBeca->save();
              
            }

          }
          
        }
        
        //enviar la respuesta al cliente en funcion de los resultados obtenidos
        $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/presupuestoEgreso'}";
        return $this->renderText($salida);
        
      }
      
    }
  }
  
  
  /**
  * MODIFICAR ESTE ACTION PARA QUE CUMPLA CON LOS NUEVOS REQUERIMIENTOS->->->
  * En este metodo se encarga de manejar el proceso de diligenciado del presupuesto de egresos 
  * asociado a una solicitud 
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-04-26
  * @param solicitud el numero de la solicitud que se esta diligenciando 
  */
  public function executePresupuestoEgreso()
  {
    $this->sol_id = $this->getUser()->getAttribute('solicitud');
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->usu_identificador = $this->getUser()->getAttribute('usuario');
      return sfView::SUCCESS;
    }else{
    	
    	
    	
      $siguiente = $this->getRequestParameter('siguiente');
      if(isset($siguiente))
      {
         $peg_id = $this->getRequestParameter('peg_id');
         
         $presupuestoEgreso = PresupuestoEgresosPeer::retrieveByPk($peg_id);
         if(!isset($presupuestoEgreso))
         {
           $presupuestoEgreso = new PresupuestoEgresos();
           $presupuestoEgreso->setPegSolId($this->sol_id);
         }
         
         //----------------//Modificando abajo//---------------------//
         $presupuestoEgreso->setPegHseSecretaria($this->getRequestParameter('secretaria'));
         $presupuestoEgreso->setPegHseAuxAdministrativo($this->getRequestParameter('auxadministrativos'));
         $presupuestoEgreso->setPegHseMonitorias($this->getRequestParameter('monitorias'));
         $presupuestoEgreso->setPegHseCordPrograma($this->getRequestParameter('coordinacion'));
         
         //para el sueldo mensual
         $presupuestoEgreso->setPegSmDireccion($this->getRequestParameter('saldireccion'));
         $presupuestoEgreso->setPegSmCoordinacion($this->getRequestParameter('salcoordinacion'));
         $presupuestoEgreso->setPegSmOtroNombre($this->getRequestParameter('otro_nombre'));
         $presupuestoEgreso->setPegSmOtroValor($this->getRequestParameter('otro_sueldo'));
         

         //por ahora no esta guardando por que esta en pruebas
         $presupuestoEgreso->save();
         //descomentar la linea anterior para almacenar el registro en la BD
         //----------------//Modificando arriba//---------------------//
         
         
         //prueba recibiendo datos y regresando respuesta siguiente : true para probar que se esta actulizando en el cliente
        $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/egresosGenerales'}";
        return $this->renderText($salida); 
      }
      
      //cuando algo no salio bien 
      $salida = "{ success: false, error: 'No se puede procesar la solicitud'}";
      return $this->renderText($salida);
      
    }
    
  }
  
  /**
  * En este metodo se encarga de manejar el proceso de diligenciado del presupuesto de egresos 
  * en la parte del ingreso de los egresos generales y por los gastos de inversion
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-05-06
  * @param solicitud el numero de la solicitud que se esta diligenciando 
  */
  public function executeEgresosGenerales()
  {
    $this->sol_id = $this->getUser()->getAttribute('solicitud');
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      $this->usu_identificador = $this->getUser()->getAttribute('usuario');
      return sfView::SUCCESS;
    }else{
      
      $add = $this->getRequestParameter('records');//contiene los rejistros a guardar y/o modificar
      if(isset($add))
      {
        $tipoGasto  = $this->getRequestParameter('tipoGasto');
        $numPeriodos = $this->getRequestParameter('periodos');
        $records = json_decode(stripslashes($add));
        $ids = array();
        foreach($records as $record)
        {
          //manejar transaciones 
          $conceptId = (isset($record->cog_id))?$record->cog_id:'';
          if(isset($record->newRecordId))//si es un nuevo rejistro
          {
            //crear el concepto gasto nuevo
            $conpGasto = new ConceptoGastos();
            $conpGasto->setCogSolId($this->sol_id);
            $conpGasto->setCogConcepto($record->concepto);
            $conpGasto->setCogTipo($tipoGasto);
            $conpGasto->save();
            $conceptId = $conpGasto->getCogId();
            
            //la informacion del id solo se envia para los rejistro nuevos
            array_push($ids,array('oldId' => $record->newRecordId ,'id' =>$conceptId));        
          }
          
          //agregar cada uno de los nuevos rejistros
          for($i = 1 ; $i <= $numPeriodos ; $i++)
          {
            $gastoGeneral = GastosGeneralesPeer::retrieveByPk($conceptId,$i);
            if(!isset($gastoGeneral))
            {
              $gastoGeneral = new GastosGenerales();
              $gastoGeneral->setIggCogId($conceptId);
              $gastoGeneral->setIggPeriodo($i);
            }
            
            //en el caso que no este dejar este campo basio
            if(isset($record->$i)){$gastoGeneral->setIggCosto($record->$i);}
            $gastoGeneral->save();
            
          }//eofor 
          
        }//eoforeach
        
        $salida =  json_encode(array('success'=>true,'data'=>$ids));
        return $this->renderText($salida);
        
      }//eoif
      
      //aplicar transacionalidad  
      $delId = $this->getRequestParameter('id');
      if(isset($delId))
      {
        //eliminar todos los elementos asociados al concepto
        $c = new Criteria();
        $c->add(GastosGeneralesPeer::IGG_COG_ID, $delId);
        $gastoGenerales = GastosGeneralesPeer::doDelete($c);
        
        //eliminar el concepto
        $conceptGasto = ConceptoGastosPeer::retrieveByPk($delId);
        $conceptGasto->delete();
        
        $salida = "{ success: true, msg: 'El registro fue borrado' }";
        return $this->renderText($salida);
      }
      
      //aqui va el codigo para el manejo del envio de la peticion 
      
      
      $salida = "{ success: true, data : [] }";
      return $this->renderText($salida);
    }
    
    
  }
  
  /**
  * Este metodo se encarga de manejar el proceso de envio de una solicitud
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-5-10
  * @param sol_id : el identificador de la solicitud que se va a cambiar de estado
  */
  public function executeEnviar()
  {
    $sol_id = $this->getUser()->getAttribute('solicitud');
    $usu_identificador = $this->getUser()->getAttribute('usuario');
    
    //cambia el estado de la solicitud a Solicitado 
    $solicitud = SolicitudPeer::retrieveByPk($sol_id);
    $solicitud->setSolEstado('Solicitado');
    $solicitud->save();
    
    //elimino los datos de la sesion de usuario y defino nuevamente el usuario en session
    $this->getUser()->getAttributeHolder()->clear();
    $this->getUser()->setAttribute('usuario', $usu_identificador);
    
    
    $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/solicitudes'}";
    return $this->renderText($salida);
    
  }  
  
   /**
  * En este metodo se encarga del renderizado de cada uno de los formularios 
  * necesarios para el diligenciado de una solicitud
  * @author     Luis Armando Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-3-25
  */
  public function executeRenderizarFormularios()
  {
    $sol_id = $this->getRequestParameter('sol_id');
    $this->getUser()->setAttribute('solicitud',$sol_id);
    $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/solicitud/informacionGeneral'}";
    return $this->renderText($salida);
  }
 
   
}
