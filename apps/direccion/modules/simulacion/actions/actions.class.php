<?php

/**
 * simulacion actions.
 *
 * @package    saspa
 * @subpackage simulacion
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 2692 2006-11-15 21:03:55Z fabien $
 */
class simulacionActions extends sfActions
{
  /**
   * Executes index action
   *
   */
  public function executeIndex()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }else {
      
      $error = "";
      $solicitud = SolicitudPeer::retrieveByPk($this->getRequestParameter('id'));
      
      if($solicitud->getSolEstado() == "Proceso")
      {
        $sol_id = $solicitud->getSolId();
        
        
        $c1 = new Criteria();
        $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
        $formulario = InformacionGeneralPeer::doSelectOne($c1);
        if(!(isset($formulario)))
        {
          $error .= ", Informacion general";
        }
        
        
        $c1 = new Criteria();
        $c1->add(ExtructuraCurricularPeer::ECU_SOL_ID, $sol_id);
        $formulario = ExtructuraCurricularPeer::doSelectOne($c1);
        if(!(isset($formulario)))
        {
          $error .= ", Extructura curricular";
        }
        
        
        $c1 = new Criteria();
        $c1->add(PresupuestoIngresosPeer::PIN_SOL_ID, $sol_id);
        $formulario = PresupuestoIngresosPeer::doSelectOne($c1);
        if(!(isset($formulario)))
        {
          $error .= ", Presupuesto ingreso";
        }
        
        
        $c1 = new Criteria();
        $c1->add(PresupuestoEgresosPeer::PEG_SOL_ID, $sol_id);
        $formulario = PresupuestoEgresosPeer::doSelectOne($c1);
        if(!(isset($formulario)))
        {
          $error .= ", Presupuesto egreso";
        }
        
      }
      
      
      if($error == "")
      {
        $this->getUser()->setAttribute('solicitud',$solicitud->getSolId());
        $salida = "{ success: true, urlFormulario: '".URL_SASPA."direccion_dev.php/simulacion/simulacion' }";
      
      }else{
        $salida = "{ success: false, error: 'No se puede hacer la simulacion falta diligenciar los siguientes formularios ".$error."' }";
      }
      
      return $this->renderText($salida);
    }
    
  } 
  
  
  /**
  * Metodo encargado de realizar la simulacion para una solicitud.
  *
  * @author     Luis A. Nuñez <armandon20@gmail.com>
  * @access     public
  * @since      2010-5-18
  * @param integer : sol_id -> El identificador de la solicitud a simular
  */
  public function executeSimulacion()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      
      $this->sol_id = $this->getUser()->getAttribute('solicitud');
      $datosResultadoIngresos = array();
      
      
      //obtengo el numero de periodos del programa academico
      $c1 = new Criteria();
      $c1->add(InformacionGeneralPeer::ING_SOL_ID, $this->sol_id);
      $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1);
      $this->numeroPeriodos = $informacionGeneral->getIngDuracionPrograma();
      
      
      //estudiantes matriculados , 3 datos para el presupuesto de ingresos
      $c1 = new Criteria();
      $c1->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->sol_id);
      $presupuestoIngreso = PresupuestoIngresosPeer::doSelectOne($c1);
      
      
      //Obtengo el parametro salario minimo
      $fechaSol     = $informacionGeneral->getIngFecha();
      $nomParametro = "Salario minimo";
      $anoParametro = substr($fechaSol,0,4);//"2011";
      $salarioMinimo = ParametrosPeer::retrieveByPk($nomParametro,$anoParametro);
      if(isset($salarioMinimo))
      {
	$salario_minimo = $salarioMinimo->getParValor();
      } else {
	$salario_minimo = 0;
      }
      //Fin
      
      


      $nuevoRejisto = array_fill(1,$this->numeroPeriodos,0);
      $nuevoRejisto[0] = "Estudiantes Inscritos";
      $nuevoRejisto[1] = $presupuestoIngreso->getPinNumeroInscritos();
      array_push($datosResultadoIngresos,$nuevoRejisto);//estudiantes inscritos 0
      
      
      //estudiantes matriculados
      //parametro del sistema es una tabla, buscar definicion en modelo.txt
      $desercion = DESERCION;
      $nuevoRejisto[0]  = "Estudiantes Matriculados";
      $nuevoRejisto[1] = $presupuestoIngreso->getPinNumeroMatriculados();
      for($i = 2; $i <= $this->numeroPeriodos; $i++)
      {
         //round retorna el entero mas cercano de un decimal
         $nuevoRejisto[$i] = round($nuevoRejisto[$i-1] * (1-$desercion));
      }
      array_push($datosResultadoIngresos,$nuevoRejisto);//estudiantes matriculados 1 
      
      
      //Ingresos por matricula calculo periodo a periodo
      $nivelAcademico = $informacionGeneral->getIngNivelAcademico();
      $tipoPago  = $informacionGeneral->getIngTipoValor();//Valor Unico o Valor Diferenciado
      $formaPago = $informacionGeneral->getIngFormaPago();//Si es Valor Unico (Anual, Semestral, etc)       
      
      
      //creo el nombre del concepto a mostrar en la tabla
      $newRejistro = array_fill(1,$this->numeroPeriodos,0);
      $newRejistro[0] = "Ingresos por Matricula";
      
      $valorMatricula;
      
      //inicia cada posicion del arreglo con cero desde 1 hasta numeroPeriodos
      $valorMatriculaAux = array();
      
      if($informacionGeneral->isPregrado())
      {
        $valorMatricula = VALOR_MATRICULA;
        for($i = 1; $i <= $this->numeroPeriodos; $i++)
        {
      	 //$datosResultadoIngresos[1] numero de estudiantes matriculados
          $newRejistro[$i] = $datosResultadoIngresos[1][$i] * $valorMatricula;
          $valorMatriculaAux[$i] = $newRejistro[$i];
        }
        
      } else {
        
        //Postgrado el valor de matricula viene de Informacion general
	if($tipoPago == "Valor Unico")
	{
	    //indica si el arreglo nuevoRejistro ha cambiado
	    $cambio  = false;

	    //obtengo el valor de la matricula de la informacion general de la solicitud
	    $valorMatricula = $informacionGeneral->getIngValor() * $salario_minimo;
	    
	    //Se guarda un unico valor de matricula por periodo
	    $valorMatriculaAux = array_fill(1,$this->numeroPeriodos,$valorMatricula);

	    if($formaPago == "Anual")
	    {
	      $valorMatricula = ($valorMatricula/2);
	      $valorMatriculaAux = array_fill(1,$this->numeroPeriodos,$valorMatricula);

	    }else if($formaPago == "Creditos")
	    {
		$numCreditoPeriodo = $this->creditosPeriodo($this->sol_id , $this->numeroPeriodos);
		for($i = 1; $i <= $this->numeroPeriodos; $i++)
		{
		  //$datosResultadoIngresos[1][] numero de estudiantes matriculados
		  $newRejistro[$i] = $datosResultadoIngresos[1][$i] * ($numCreditoPeriodo[$i] * $valorMatricula);
		  $valorMatriculaAux[$i] = $newRejistro[$i];
		}
		$cambio = true;
			
	    }else if ($formaPago == "Total carrera")
	    {
	      $newRejistro[1] = $datosResultadoIngresos[1][1] * $valorMatricula;
	      $cambio = true;
	      
	      //divido el valor total de la carrera en el numero de periodos, para obtener un valor por periodo de la matricula
	      $valorMatriculaAux = array_fill(1,$this->numeroPeriodos,round($valorMatricula/$this->numeroPeriodos));

	    }
		     
	    if(!$cambio)
	    {
	      for($i = 1; $i <= $this->numeroPeriodos; $i++)
	      {
		    //$datosResultadoIngresos[1][] estudiantes matriculados
		  $newRejistro[$i] = $datosResultadoIngresos[1][$i] * $valorMatricula;
	      }
	    }

	  } else {
	    //recupero el valor a pagar por matricula en cada periodo
	    $c1 = new Criteria();
	    $c1->add(ValorDiferenciadoPeer::VAD_ING_ID, $informacionGeneral->getIngId());
	    $valorDiferenciado = ValorDiferenciadoPeer::doSelect($c1);
	    foreach($valorDiferenciado as $valorDif)
	    {
	      $p = $valorDif->getVadPeriodo();
	      $v = $valorDif->getVadValor() * $salario_minimo;
	      $valorMatriculaAux[$p] = $v;
	      $newRejistro[$p] = $datosResultadoIngresos[1][$p] * $v ; 
	    }
	    
	  }
	    
      }

      array_push($datosResultadoIngresos,$newRejistro);//ingresos por matricula 2
      //Almacenar el valor de la matricula por periodo en la variable $valorMatriculaAux
      
      
      
      //Ingresos por convenios tabla fuente_externas y contribucion_fuente_externas
      $newRejistro = array_fill(1,$this->numeroPeriodos,0);
      $newRejistro[0] = "Ingresos por Convenio";
      
      $c1 = new Criteria();
      $c1->add(FuentesExternasPeer::FUE_SOL_ID, $this->sol_id);
      $fuentesExternas = FuentesExternasPeer::doSelect($c1);
      
      foreach($fuentesExternas as $fuenteExterna)
      {
        //obtengo todas las contribuciones que hace la fuente externa en cada periodo
        $c = new Criteria();
        $c->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $fuenteExterna->getFueId());
        $contribucionesFuentes = ContribucionFuenteExternaPeer::doSelect($c);
        
        foreach($contribucionesFuentes as $contribucionFuente)
        {
          $p = $contribucionFuente->getCfePeriodo();
          $v  = $contribucionFuente->getCfeValor();//el valor esta en pesos
          $newRejistro[$p]+=$v;
        }
        
      }
      array_push($datosResultadoIngresos,$newRejistro);// 3 Ingresos por Convenio
      
      
      //exenciones presupuesto ingresos es un porcentaje pero esta dado como un numero entre 0 y 20
      //hay que divirlo por 100 o multiplicarlo por 0.01 que es lo mismo 
      $exenciones = $presupuestoIngreso->getPinExenciones();
      $exenciones = $exenciones * 0.01;//para dejarlo expresado como % (porcentaje)
      $newRejistro[0] = "Exenciones";
      for($i = 1; $i <= $this->numeroPeriodos; $i++)
      {
        //$datosResultadoIngresos[2][] contiene los valores de los ingreso por matricula periodo a periodo 
        $newRejistro[$i] = $datosResultadoIngresos[2][$i] * $exenciones;
      }
      array_push($datosResultadoIngresos,$newRejistro);// 4 Exenciones 
      
      
      //calculo de los totales para los datos de ingresos
      $newRejistro[0] = "Total Ingresos";
      for($i = 1; $i <= $this->numeroPeriodos; $i++)
      {
        // $datosResultadoIngresos[2][] ingresos por matricula 
        // $datosResultadoIngresos[3][] ingresos por convenios
        // $datosResultadoIngresos[4][] exenciones
        $newRejistro[$i] = ($datosResultadoIngresos[2][$i] + $datosResultadoIngresos[3][$i]) - $datosResultadoIngresos[4][$i];
      }
      array_push($datosResultadoIngresos,$newRejistro);// 5 Exenciones 
      
		
		
      //$datosResultadoIngresos[1][] estudiantes matriculados      
      //Llamado a la funcion que calcula los datos para los egresos
      
      $datosResultadoEgresos = $this->calcularEgresos($this->sol_id,$this->numeroPeriodos);
      $rejistro = array_fill(1,$this->numeroPeriodos,0);
      $rejistro[0] = "Total costos variables";
      for($i = 1; $i <= $this->numeroPeriodos; $i++)
      {
        $rejistro[$i] = $datosResultadoEgresos[1][$i] + $datosResultadoEgresos[2][$i];
        $rejistro[$i] += $datosResultadoEgresos[3][$i] + $datosResultadoEgresos[4][$i];
      }
      
      array_push($datosResultadoEgresos,$rejistro);//5 Total costos variables
    
    
      //CALCULO DEL LOS RESULTADOS PARA EL PUNTO DE EQUILIBRIO DEL PROGRAMA
      $datosPuntoEquilibrio = array();
      
      //$datosResultadoIngresos[5] Total ingresos
      //$datosResultadoEgresos[5] Total costos variables
      array_push($datosPuntoEquilibrio,$datosResultadoIngresos[5]);//0
      array_push($datosPuntoEquilibrio,$datosResultadoEgresos[5]);//1
      
      
      $rejistro = array_fill(1,$this->numeroPeriodos,0);
      $rejistro[0] = "Ingresos - Costos variables";
      
      for($i = 1; $i <= $this->numeroPeriodos; $i++)
      {
        $rejistro[$i] =  $datosResultadoIngresos[5][$i] - $datosResultadoEgresos[5][$i];
      }
      array_push($datosPuntoEquilibrio,$rejistro);//2
      
      
      /*
      * calculo del valor de la matricula para el caso de pregrado
      */
      if($this->isPregrado($nivelAcademico))
      {
      	for($i = 1; $i <= $this->numeroPeriodos; $i++)
	    $valorMatriculaAux[$i] = VALOR_MATRICULA_PREGRADO * $datosResultadoIngresos[1][$i];
      }
      
      $rejistro = array_fill(1,$this->numeroPeriodos,0);
      $rejistro[0] = "Punto de equilibrio costos variables";
      for($i = 1; $i <= $this->numeroPeriodos; $i++)
      {
        //$datosResultadoEgresos[5] total costos variables
        //$valorMatriculaAux[i] valores en el periodo i
	$denominador = ($valorMatriculaAux[$i] > 0)?$valorMatriculaAux[$i]:1; //para evitar la division por 0 
	$rejistro[$i] =  $datosResultadoEgresos[5][$i] / $denominador;
      }
      
      array_push($datosPuntoEquilibrio,$rejistro);
      
      //envio los datos al servidor en un string json
      $this->rejistroIngresos   = json_encode($datosResultadoIngresos);      
      $this->rejistroEgresos    = json_encode($datosResultadoEgresos);
      $this->rejistroEquilibrio = json_encode($datosPuntoEquilibrio);
            
      return sfView::SUCCESS;
      
    }
    
  }
  
  
  //--------------Modificando esta parte abajo----------------------//
  
  /**
  * En este metodo se hacen los calculos de la simulacion para los egresos
  * @author     Luis A. Nuñez <armandon20@gmail.com>
  * @access     protected
  * @since      2010-5-24
  * @param sol_id identificador de la solicitud
  * @return datos arreglo con los calculos realizados
  */
  protected function calcularEgresos($sol_id,$numeroPeriodos)
  {
    //En este arreglo se almacenan los resultados por cada concepto de egreso
    $datosResultadoEgresos = array();
    
    
    $rejistro = array_fill(1,$numeroPeriodos,0);
    $costoDocencia = array_fill(1,$numeroPeriodos,0);
    
    $costoDocencia[0] = "Costo de docencia";
    $rejistro[0] = "Horas de docencia costeadas";
    
    $c = new Criteria();
    $c->add(ExtructuraCurricularPeer::ECU_SOL_ID, $sol_id);
    $extCurriculares = ExtructuraCurricularPeer::doSelect($c);
    
    foreach($extCurriculares as $extCurricular )
    {
      $periodo      = $extCurricular->getEcuPeriodoAcademico();
      $horas        = $extCurricular->getEcuTotalHoras();
      $valorHora    = $extCurricular->getEcuValorHora();
      $progComparte = $extCurricular->getEcuNumProgramaComparte();
      
      $rejistro[$periodo]      += $horas;      
      $costoDocencia[$periodo] += round($valorHora * ( $horas / ($progComparte + 1) ));
    }
    array_push($datosResultadoEgresos,$rejistro);//0 Horas de docencia costeadas
    array_push($datosResultadoEgresos,$costoDocencia);//1 Costo de docencia
    
    
    
    //---------------//1. Codigo para modificar//----------------//
    //los asistentes de docencia, este paso fue eliminado del proceso de simulacion
    //$asigMenAsisten = ASIG_ASIST_DOCENCIA; //parametro del sistema asignacion mensual asistente
    //$rejistro = array_fill(1,$numeroPeriodos,0);
    //$rejistro[0] = "Asistentes de docencia/investigacion";
    //array_push($datosResultadoEgresos,$rejistro);//2 este campo es usado una vez
    //---------------//Fin 1.//----------------//
    
    
    //Gastos administrativo

    //variables 
    $valDirPrograma;
    $valCordProgram;
    $valSecretaria;
    $valAuxiliares;
    $valMonitores;
    $dirSedeRegional;
    $coordSedeRegional;
    
    
    $valorHora; //parametro del sistema
    $c = new Criteria();
    $c->add(PresupuestoEgresosPeer::PEG_SOL_ID, $sol_id);
    $presupuestoEgresos = PresupuestoEgresosPeer::doSelectOne($c);
    $mesesPeriodo = 6;
    
    
    $c1 = new Criteria();
    $c1->add(InformacionGeneralPeer::ING_SOL_ID, $sol_id);
    $informacionGeneral = InformacionGeneralPeer::doSelectOne($c1);
    $nivelAcademico = $informacionGeneral->getIngNivelAcademico();
    
    if($this->isPregrado($nivelAcademico))
    {
    	$valDirPrograma  = SUELDO_MES_PROFESOR * $mesesPeriodo * PORCENTAJE_PRESTACIONES;
    }else{
    	$valDirPrograma = GASTOS_REPRESENTACION;
    }
    
    $valCordProgram = $presupuestoEgresos->getPegHseCordPrograma() * VALOR_HORA_DOCENTE;
    $valSecretaria = $presupuestoEgresos->getPegHseSecretaria() * VALOR_HORA_SECRETARIA;
    $valAuxiliares = $presupuestoEgresos->getPegHseAuxAdministrativo() * VALOR_HORA_AUXILIARES;
    $valMonitores = $presupuestoEgresos->getPegHseMonitorias() * VALOR_HORA_MONITORIAS;
    
    
    //DIRECCION Y COORDINACION SEDE REGIONAL
    $dirSedeRegional = $mesesPeriodo * $presupuestoEgresos->getPegSmDireccion();
    $coordSedeRegional = $mesesPeriodo * $presupuestoEgresos->getPegSmCoordinacion();
    
    
    
    $gastosAdministrativos = $valMonitores + $valAuxiliares + $valSecretaria + $valDirPrograma;
    $gastosAdministrativos += $dirSedeRegional + $coordSedeRegional;
    $rejistro = array_fill(1,$numeroPeriodos,$gastosAdministrativos);//establesco el valor de los gasto administrativos en cada periodo
    $rejistro[0] = "Gastos administrativos";
    
    array_push($datosResultadoEgresos,$rejistro);//2 Gastos administrativos
    
    
  
    $rejistro = array_fill(1,$numeroPeriodos,0);
    $rejistro[0] = "Gastos generales";
    $c = new Criteria();
    $c->add(ConceptoGastosPeer::COG_SOL_ID, $sol_id);
    $c->add(ConceptoGastosPeer::COG_TIPO, "General");
    $conceptoGastos  = ConceptoGastosPeer::doSelect($c);
    foreach($conceptoGastos as $conceptoGasto)
    {
      $c = new Criteria();
      $c->add(GastosGeneralesPeer::IGG_COG_ID, $conceptoGasto->getCogId());
      $gastosGenerales = GastosGeneralesPeer::doSelect($c);
      foreach($gastosGenerales as $gastoGeneral)
      {
        $periodo   = $gastoGeneral->getIggPeriodo();
        $gasto = $gastoGeneral->getIggCosto();
        $rejistro[$periodo] += $gasto;
      }
    }
    array_push($datosResultadoEgresos,$rejistro);//3 gastos generales

    
    $factorInversion = 1;
    $rejistro = array_fill(1,$numeroPeriodos,0);
    $rejistro[0] = "Inversion";
    $rejistroTemp = array_fill(0,$numeroPeriodos,0);
    
    $c = new Criteria();
    $c->add(ConceptoGastosPeer::COG_SOL_ID, $sol_id);
    $c->add(ConceptoGastosPeer::COG_TIPO, "Inversion");
    $conceptoGastos  = ConceptoGastosPeer::doSelect($c);
    
    foreach($conceptoGastos as $conceptoGasto)
    {
      $c = new Criteria();
      $c->add(GastosGeneralesPeer::IGG_COG_ID, $conceptoGasto->getCogId());
      $gastosGenerales = GastosGeneralesPeer::doSelect($c);
      
      $factorInversion = $this->getFactorInversion($conceptoGasto->getCogConcepto());
      
      foreach($gastosGenerales as $gastoGeneral)
      {
        $periodo   = $gastoGeneral->getIggPeriodo();
        $inversion = $gastoGeneral->getIggCosto();
        $rejistroTemp[$periodo] = $inversion;
      }

      $valorTotalInversion = array_sum($rejistroTemp);
      
      for($i=1; $i<=$numeroPeriodos; $i++)
      {
        $rejistro[$i] += $valorTotalInversion * $factorInversion;  
      }
      
    }
    
    array_push($datosResultadoEgresos,$rejistro);//4 Inversion 
    
    return $datosResultadoEgresos;
  }
  
  //--------------Modificando esta parte arriba----------------------//
  
  
  
  
  /**
  * Calcula el factor a multiplicar al valor total de la inversion dado el el nombre del concepto
  *@param concepto Nombre del concepto
  *@return int el fator de inversion
  */
  protected function getFactorInversion($concepto)
  {
    $factorInversion = 1;
    
    //preg_match(coincidencia,cadena) return 0 o 1 
    if(preg_match("/Adecuacion/",$concepto))
    {
      $factorInversion = 0.06;
      
    }else if(preg_match("/Dotacion/",$concepto))
    {
        $factorInversion = 0.1;
      
    }else if(preg_match("/Recursos/",$concepto))
    {
      $factorInversion = 1/6;
    }
    
    return $factorInversion; 
  }
  
  
  
  /**
  * Devuelve si un programa es de pregrado
  * @param string : El nivel academico del programa
  * @return boolean
  */
  protected function isPregrado($nivelAcademico)
  {
    if($nivelAcademico != "Tecnologico" && $nivelAcademico != "Profesional")
    {
      return false;
    }
    return true;
  }
  
  
  
  /**
  * Calcula el numero de creditos por periodo de una de un programa academico
  * @param string sol_id : identificador de la solicitud
  * @param string numeroPeriodos : numero de periodos del programa
  * @return array numCredPeriodo 
  */
  protected function creditosPeriodo($sol_id , $numeroPeriodos)
  {
    $numCredPeriodo = array_fill(1,$numeroPeriodos,0);
    
    $c = new Criteria();
    $c->add(ExtructuraCurricularPeer::ECU_SOL_ID, $sol_id);
    $extCurriculares  = ExtructuraCurricularPeer::doSelect($c);
    foreach($extCurriculares as  $extCurricular )
    {
      $p   = $extCurricular->getEcuPeriodoAcademico(); //periodo  
      $cre = $extCurricular->getEcuNumCreditos(); //num creditos
      $numCredPeriodo[$p] += $cre;
    }
    return $numCredPeriodo; 
  }
  
  
  
  
   /**
   * Lista las solicitudes cuyo esta es Proceso o Solicitado
   * @author     Luis A. Nuñez <armandon20@gmail.com>
   * @access     public
   * @since      2010-5-18
   * @param usuario El identificador del usuario actualmente logueado
   * @return     string la lista en formato json de todas las solicitudes del usuario en cuestion
   */
  public function executeLista()
  { 
    $c = new Criteria();
    
    //esto es necesario para hacer el OR en la columna sol_estado de la tabla solicitud
    $c1 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Proceso');
    $c2 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Solicitado');
    $c3 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Analisis');
    $c1->addOr($c2);
    $c3->addOr($c1);//cambio se agrego esta expresion
    $c->add(SolicitudPeer::SOL_USUARIO, $this->getUser()->getAttribute('usuario'));
    $c->add($c3);//cambio el parametro $c1 por $c3 
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
