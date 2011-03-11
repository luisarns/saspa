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
    /*
    * 1 Consultar las solicitudes 
    * 2 Revisar las solicitudes 
    */
  }
  
  
  /**
  * Muestra  una tabla con todas las solicitudes que estan rejistradas en el sistema,
  * cuyo estado es Proceso o Solicitado 
  */
  public function executeConsultar()
  {
    $c = new Criteria();
    $c1 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Proceso');
    $c2 = $c->getNewCriterion(SolicitudPeer::SOL_ESTADO,'Solicitado');
    $c1->addOr($c2);
    $c->add($c1);
    
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
      
      if(isset($infGeneral))
      {
        $sol_motivo = $infGeneral->getIngMotivoSolicitud();
        $sol_programa = $infGeneral->getIngNombrePrograma();
      }
      
      $datos[$pos][] = $solicitud->getSolId();
      $datos[$pos][] = $solicitud->getSolFacultad();
      $datos[$pos][] = $sol_programa;
      $datos[$pos][] = $sol_motivo;
      $datos[$pos][] = $solicitud->getSolEstado();
      $datos[$pos][] = $solicitud->getUpdatedAt();
      $pos++;
    }
    
    $this->regSolicitudes = json_encode($datos);
  }

 
  
  /**
  * Este metodo se encarga de manejar el proceso de revision de una solicitud
  *
  */
  public function executeRevisarSolicitudes()
  {
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
      return sfView::SUCCESS;
    }else{
      
      $solicitud = SolicitudPeer::retrieveByPk($this->getRequestParameter('id'));
      $salida = "";
      
      if(isset($solicitud))
      {
        $this->getUser()->setAttribute('solicitud',$solicitud->getSolId());
        
        //Cambio de estado a analisis la solicitud que sera revisada
        $solicitud->setSolEstado('Analisis');
        $solicitud->save();
        ///Fin
        
        $salida = "{ success: true, urlFormulario: '".URL_SASPA."analisis_dev.php/solicitud/procesoRevision'}";
      }else{
        $salida = "{ success: false, error: 'La solicitud no esta registrada'}";
      }
      return $this->renderText($salida);
    }
    
    
  }
  
  
  /**
  * Cambia el estado de una solicitud a Revision
  * @author Luis A. Nuñez
  * @since 2011-Feb-22
  * @param int sol_id : identificador de la solicitud a actualizar
  */
  public function executeEnviarCoordinadora()
  {
  		$salida = "";
  		$sol_id = $this->getRequestParameter('sol_id');
  		$solicitud = SolicitudPeer::retrieveByPk($sol_id);
  		if(isset($solicitud))
  		{
  			$solicitud->setSolEstado('Revision');
  			$solicitud->save();
  			$salida = "{ success : true, msg : 'Solicitud enviada a coordinador' }";
  		}else{
  			$salida = "{ success : false, error : 'solicitud #'+$sol_id+' no actualizada' }";
  		}
		return $this->renderText($salida); 
  }
  
  
  /*
  * En este metodo se encarga del manejo de las interfaces para manejar el proceso
  *  de la revision de solicitudes.
  */
  public function executeProcesoRevision()
  {
  	 //Trabajar aqui Luis
    if($this->getRequest()->getMethod() != sfRequest::POST)
    {
    	$this->paramInformacionGeneral();
    	$this->cnslStrCrrc();
    	$this->cgPresIngresos();
    	$this->cgPresEgresos();
    	$this->dtaEgresosGenerales(); 
      return sfView::SUCCESS;
    }else{
      
      $solicitud = SolicitudPeer::retrieveByPk($this->getUser()->getAttribute('solicitud'));
      $comentario = new Comentario();
      $com = $this->getRequestParameter('comentario');
      $opr = $this->getRequestParameter('operacion');
      
      if(isset($solicitud) && isset($opr))
      {
		   if($opr == 'Guardar')
		   {
				//cambiar el estado de la solicitud a Revision
				$solicitud->setSolEstado('Revision');
		   }
		   else if ($opr == 'Devolver')
		   {
		   	//cambiar el estado de la solicitud a Pediente
		   	$solicitud->setSolEstado('Pendiente');
		   }
			
			//empty: si la cadena basia es pasada devuelve true
			if(!empty($com)/*&& $com != ''*/){
			   $comentario->setComSolicitud($solicitud->getSolId());
			   $comentario->setComDescripcion($com);
			   $comentario->setComUsuario($this->getUser()->getAttribute('usuario'));
			   $comentario->setComSolEstado('No procesada');//Procesada
			   $comentario->save();
		   }
		   
		   $solicitud->save();
		   
		   
		   $salida = "{success: true, msg: 'Solicitud revisada', urlRevSol: '".URL_SASPA."analisis_dev.php/solicitud/revisarSolicitudes' }";
		   return $this->renderText($salida);
      }
      
      $salida = "{success: false, msg : 'Revision no terminada' }";
		return $this->renderText($salida);
    }
    
  }
  
  
  
  /*
  * Este metodo se encarga de generar los datos para el formulario de egresosGenerales
  */
  private function dtaEgresosGenerales()
  {
	  $datosGastosInversiones = array();
	  $datosGastosGenerales   = array();
	    
	  //obtengo todos los concepto gastos asociados a la solicitud sol_id
	  $c = new Criteria();
	  $c->add(ConceptoGastosPeer::COG_SOL_ID, $this->getUser()->getAttribute('solicitud'));
	  $conceptosGastos = ConceptoGastosPeer::doSelect($c);
	  
	  foreach($conceptosGastos as $conceptoGasto)
	  {
	    //obtengo los gastos por periodos asociados al concepto
	    $c = new Criteria();
	    $c->add(GastosGeneralesPeer::IGG_COG_ID, $conceptoGasto->getCogId());
	    $gastosPeriodos = GastosGeneralesPeer::doSelect($c);
	    
	    //obtengo el tipo del concepto para determinar cual de los dos arreglos poner el nuevo rejistro
	    $tipoConcepto = $conceptoGasto->getCogTipo();
	    
	    $newRejistro[0] = $conceptoGasto->getCogConcepto();//almaceno el nombre del concepto 
	    foreach($gastosPeriodos as $gastoPeriodo)
	    {
	      //almaceno el valor en la posicion del arreglo correspondiente al periodo del gasto
	      $p = $gastoPeriodo->getIggPeriodo();
	      $v = $gastoPeriodo->getIggCosto();
	      $newRejistro[$p] = $v;
	    }    
	    	    
	    if($tipoConcepto == 'General')
	    {
	      array_push($datosGastosGenerales, $newRejistro);
	    }
	    else if($tipoConcepto == 'Inversion')
	    {
	      array_push($datosGastosInversiones, $newRejistro);
	    }

	  }

	  //codifico en json los arreglos para enviarlos a la interfaz cliente
	  $this->gastosInversiones = json_encode($datosGastosInversiones);
	  $this->gastosGenerales   = json_encode($datosGastosGenerales);
  }
  

  private function cgPresEgresos()
  {
		$c = new Criteria();
  		$c->add(PresupuestoEgresosPeer::PEG_SOL_ID, $this->getUser()->getAttribute('solicitud'));
  		$presupuestoEgresos = PresupuestoEgresosPeer::doSelectOne($c);
  		
  		$psEgresos = array();
  		
  		if(isset($presupuestoEgresos))
  		{
  			
  			$psEgresos['tfcordprograma']   = $presupuestoEgresos->getPegHseCordPrograma();
  			$psEgresos['tfsecretaria']   = $presupuestoEgresos->getPegHseSecretaria();
  			$psEgresos['tfauxadministrativos'] = $presupuestoEgresos->getPegHseAuxAdministrativo();
  			$psEgresos['tfmonitorias']   = $presupuestoEgresos->getPegHseMonitorias();
  			//muestra los salarios
  			$psEgresos['smdireccion'] = $presupuestoEgresos->getPegSmDireccion();
  			$psEgresos['smcoordinacion']   = $presupuestoEgresos->getPegSmCoordinacion();
  			$psEgresos['smotronombre'] = $presupuestoEgresos->getPegSmOtroNombre();
  			$psEgresos['smotrovalor']   = $presupuestoEgresos->getPegSmOtroValor();
  			
  			
  		}
  		$this->datosEgresos = json_encode($psEgresos);
	
  }
  
  
  private function cgPresIngresos()
  {
  		$c = new Criteria();
  		$c->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->getUser()->getAttribute('solicitud'));
  		$presupuestoIngreso = PresupuestoIngresosPeer::doSelectOne($c);
  		
  		$psingresos = array();
  		
  		if(isset($presupuestoIngreso))
  		{
  			$psingresos['inscriptos']   = $presupuestoIngreso->getPinNumeroInscritos();
  			$psingresos['matriculados'] = $presupuestoIngreso->getPinNumeroMatriculados();
  			$psingresos['exenciones']   = $presupuestoIngreso->getPinExenciones();
  		}  		
  		//Codifico los datos para tenerlos disponibles en el cliente
  		$this->datosPresupuestoIngresos = json_encode($psingresos);
  		
  		//obtengo el numero de periodos y la informacion de los aportes echos en cada periodo
  		//por las fuentes externas y los envio al cliente para que este muestre el grid con la info
  		$datosContribucionFuente = array();
  		$datosContribucionesFuentes = array();
  		
  		$c = new Criteria();
      $c->add(FuentesExternasPeer::FUE_SOL_ID, $this->getUser()->getAttribute('solicitud'));
      $fuentesExternas = FuentesExternasPeer::doSelect($c);
  		
  		foreach($fuentesExternas as $fuenteExterna)
      {
      	//obtengo todas las contribuciones que hace la fuente externa en cada periodo
      	$c = new Criteria();
      	$c->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $fuenteExterna->getFueId());
      	$contribucionesFuentes = ContribucionFuenteExternaPeer::doSelect($c);
    		
	      //agrego los elementos al array para que puedan ser vistos por el almacen (store)
	      $datosContribucionFuente[0] = $fuenteExterna->getFueNombre();
	      foreach($contribucionesFuentes as $contribucionFuente)
	      {
	        //creo las clave periodo : valor con las cuales determino el aporte de la fuente externa en un periodo
	        $prido = $contribucionFuente->getCfePeriodo();
	        $vlor  = $contribucionFuente->getCfeValor();
	        $datosContribucionFuente[$prido] = $vlor;
	      }
	      //agrego el arreglo configurado de contribuciones por periodo
	      array_push($datosContribucionesFuentes, $datosContribucionFuente);
    	}
  		$this->jsncontribuciones = json_encode($datosContribucionesFuentes); 
  		
  		
  }
  
  
  private function cnslStrCrrc()
  {
		$c = new Criteria();
		$c->add(ExtructuraCurricularPeer::ECU_SOL_ID, $this->getUser()->getAttribute('solicitud'));
		$extCurricular = ExtructuraCurricularPeer::doSelect($c);
		
		$pos = 0;
  		$datos;
  		foreach($extCurricular as $fila)
  		{
	 		$datos[$pos][] = $fila->getEcuId();
    		$datos[$pos][] = $fila->getEcuSolId();
    		$datos[$pos][] = $fila->getEcuPeriodoAcademico();
    		$datos[$pos][] = $fila->getEcuAsignatura();
    		$datos[$pos][] = $fila->getEcuNumCreditos();
    		$datos[$pos][] = $fila->getEcuTotalHoras();
    		$datos[$pos][] = $fila->getEcuNumProgramaComparte();
    		$datos[$pos][] = $fila->getEcuCategoriaDocente();
    		$datos[$pos][] = $fila->getEcuHorasDictadasComo();
    		$datos[$pos][] = $fila->getEcuValorHora();
    		$pos++;
  		}
  		$this->datosCurriculares = json_encode($datos);
  }
  
  
  private  function paramInformacionGeneral()
  {
  		$parametros;
  		$regPagosVariados;
  		
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID, $this->getUser()->getAttribute('solicitud'));
      $paramig = InformacionGeneralPeer::doSelectOne($c);
      
      if(isset($paramig))
      {
      	$regPagosVariados['programador'] = 'Luis A. Nunyez';
      	$regPagosVariados['numSolicitud'] = $paramig->getIngSolId();
      	$regPagosVariados['fecha'] = $paramig->getIngFecha();
      	$regPagosVariados['solicitante'] = $paramig->getIngSolicitante();
      	$regPagosVariados['facultad'] = $paramig->getIngFacultad();
      	$regPagosVariados['escuela'] = $paramig->getIngEscuela();
      	$regPagosVariados['programa'] = $paramig->getIngNombrePrograma();
      	$regPagosVariados['titulo'] = $paramig->getIngTituloOtorga();      	
      	$regPagosVariados['motivo'] = $paramig->getIngMotivoSolicitud();
      	$regPagosVariados['sede'] = $paramig->getIngCiudadSede();
      	$regPagosVariados['jornada'] = $paramig->getIngJornada();
      	$regPagosVariados['nivel'] = $paramig->getIngNivelAcademico();
      	$regPagosVariados['modalidad'] = $paramig->getIngTipoModalidad();
      	$regPagosVariados['duracion'] = $paramig->getIngDuracionPrograma();
      	
      	$this->numperiodos = $regPagosVariados['duracion'];
      	
      	$regPagosVariados['formaPago'] = $paramig->getIngTipoValor();
      }
      $this->dtosInformGeneral = json_encode($regPagosVariados);
       
  		$componente = "";
  		
  		if($regPagosVariados['formaPago'] != 'Valor Diferenciado')
  		{
  			$componente  = "{ xtype : 'fieldset', defaults : { disabled: true},  layout: 'form', title : '".$regPagosVariados['formaPago']."',  autoWidth  : true, autoHeight : true, items : [";
  			$componente .= "{ xtype : 'textfield', fieldLabel : 'Pago',  value : '".$paramig->getIngFormaPago()."' },";
  			$componente .= "{ xtype : 'textfield', fieldLabel : 'Valor(SMMLV)', value : ".$paramig->getIngValor()." } ]}";

  		}else{

  			$c1 = new Criteria();
       	$c1->add(ValorDiferenciadoPeer::VAD_ING_ID, $paramig->getIngId()); 
       	$valDiferenciados = ValorDiferenciadoPeer::doSelect($c1);

       	$valoresdiferenciados = "[";
       	foreach($valDiferenciados as $valDiferenciado)
       	{
         	$valoresdiferenciados .= "[".$valDiferenciado->getVadPeriodo().",".$valDiferenciado->getVadValor()."],";
       	}
       	$valoresdiferenciados .= "[0,0]]";
       	
       	///Configuracion de SimpleStore
       	$simStoConfig  = "{fields: [";
         $simStoConfig .= "{name: 'periodo', type : 'int' },";
         $simStoConfig .= "{name: 'valor', type: 'float'}],";
         $simStoConfig .= "data : ".$valoresdiferenciados." }";
         
         //definicion del column model para el grid
         $colModelConfig  = "[ {id : 'periodo', header : 'Periodo', dataIndex : 'periodo', width : 100},";
         $colModelConfig .= "{header : 'Valor', dataIndex : 'valor', width : 100}]";
         
         $gridConfig = "{xtype : 'editorgrid', id : 'gridvaldiferenciado' ,";
         $gridConfig .= "store : new Ext.data.SimpleStore(".$simStoConfig."),";
         $gridConfig .= "cm : new Ext.grid.ColumnModel(".$colModelConfig."),";
         $gridConfig .= "title : 'Valor Diferenciado en SMMLV',";
         $gridConfig .= "autoWidth : true, autoHeight : true,}";
       	
			$componente = $gridConfig;
  		}
  		$this->compInGnral = json_encode($componente);
  }
  
   /*
  * executeListarComentarios: number -> string(json)
  * Genera una lista de las observaciones, no procesadas, echas a una solicitud
  * @param solicitud: number - identificador de una solicitud
  * @return (string)json: contiene la lista de observaciones echas a la solicitud
  *-------------------------------------------------------------------------------
  * executeListarComentarios: number -> string(json)
  * Actualiza el estado de una observacion echa a una solicitud
  * @param coment: number - identificador de la observacion
  * @return (string)json: mensaje con informe del resultado de la operacion  
  */
  public function executeListarComentarios()
  {
  
  		$comID=$this->getRequestParameter('coment');
  		$solID=$this->getRequestParameter('solicitud');
  		
  		if(isset($solID))
  		{
	  		$c = new Criteria();
	      $c->add(ComentarioPeer::COM_SOLICITUD,$solID);
	      $coments = ComentarioPeer::doSelect($c);
	  		$salida = "";
	  		
	  		$pos = 0;
	  		$datos = array();
	  		foreach($coments as $coment)
	  		{
	  			$datos[$pos]['comid']      = $coment->getComId();
	  			$datos[$pos]['comentario'] = $coment->getComDescripcion();
	  			$datos[$pos]['estado']     = $coment->getComSolEstado();
	  			$datos[$pos]['creado']     = $coment->getCreatedAt();
	  			$pos++;
	  		}
	  		 	
  			$rows   = count($datos);
      	$data   = json_encode($datos);
  			$salida = '({ "total" : "'.$rows.'", "datos" : '.$data.' })';

			return $this->renderText($salida);
		}
		
		if(isset($comID))
		{
			//hago el procesamiento de la peticion para actualizar el estado de una solicitud
			$comentario = ComentarioPeer::retrieveByPk($comID);
			$comentario->setComSolEstado($this->getRequestParameter('newEstado'));
			$comentario->save();
			return $this->renderText('{success : true , msg : "Observacion actualizada"}');
		}
		
		return $this->renderText('{success : false , msg : "Operacion desconocida"}');
  }
  
  
  
  
   /**
  * Enviar una lista de las solicitudes cuyo estado es Emitido
  * @author Luis A. Nuñez
  * @since 2011-Feb-22
  * @return void
  */
  public function executeEmitidos()
  {
  	 $c = new Criteria();
    $c = $c->add(SolicitudPeer::SOL_ESTADO,'Emitido');
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
      
      if(isset($infGeneral))
      {
        $sol_motivo = $infGeneral->getIngMotivoSolicitud();
        $sol_programa = $infGeneral->getIngNombrePrograma();
      }
      
      $datos[$pos][] = $solicitud->getSolId();
      $datos[$pos][] = $solicitud->getSolFacultad();
      $datos[$pos][] = $sol_programa;
      $datos[$pos][] = $sol_motivo;
      $datos[$pos][] = $solicitud->getSolEstado();
      $datos[$pos][] = $solicitud->getUpdatedAt();
      $pos++;
    }
    
    $this->regSolicitudes = json_encode($datos);
  }
  
  
  
  /**
  * Esta funcion genera el concepto en pdf de una solicitud
  * @param int sol_id identificador de la solicitud
  */
  public function executeRealizarAnalisis()
  {
  		$solicitud = SolicitudPeer::retrieveByPk($this->getRequestParameter('sol_id'));
  		
  		if(isset($solicitud)){
  			// pdf object
			//$pdf = new sfTCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			$pdf = new sfTCPDF("L", PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
			
			//usuario
			$usuario = UsuarioPeer::retrieveByPk($solicitud->getSolUsuario());
		
			// set document information
			$pdf->SetCreator($usuario->getUsuIdentificador().'-'.$usuario->getUsuNombre());
			$pdf->SetAuthor('OPDI');
			$pdf->SetTitle($solicitud->getSolNombre());
			$pdf->SetSubject('Concepto emitido');
			$pdf->SetKeywords('OPDI, solicitud, conceptos');
		
			// remove default header/footer
			$pdf->setPrintHeader(false);
			$pdf->setPrintFooter(false);
		
		
			// set default monospaced font
			$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);
			//set margins
			$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
			//set auto page breaks
			$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);
			//set image scale factor
			$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);
			//set some language-dependent strings
			$pdf->setLanguageArray($l);
			// ---------------------------------------------------------
			
			// set font
			$pdf->SetFont('helvetica', 'B', 10);		
			// add a page
			$pdf->AddPage();
		
			// set some text to print
			$pdf->Cell(0, 0, "RECTORIA", 0, 2, 'L', 0, '', 0, false, 'A');
			$pdf->Cell(0, 0, "Oficina de Planeacion y Desarrollo Institucional", 0, 2, 'L', 0, '', 0, false, 'A');
			$pdf->Cell(0, 0, "Area de Analisis Institucional", 0, 0, 'L', 0, '', 0, false, 'A');
			
			
			//colocar una linea horizontal para separar la cabecera del documento
			$pdf->Line(0,40,300,40);
			
			//para que resalten los campos y sus nombres
			$pdf->SetFont('helvetica', '', 10);
			//eforce ejemplo $pdf->SetFont('Times','B',8);
			
			//obtengo la informacion general de la solicitud
			$c = new Criteria();
			$c->add(InformacionGeneralPeer::ING_SOL_ID,$solicitud->getSolId());
			$infgral  = InformacionGeneralPeer::doSelectOne($c);
			
			//para la configuracion del informe que tendra la imagen
			$pdf->Ln(10);
			
			
			//La primer tabla informacion general			
			$html  = "<table border=\"2\">";
			//primera fila
			$html .= "<tr><td><b>Solicitante:</b> ".$infgral->getIngSolicitante()." </td>";
			$html .= "<td colspan=\"2\"><b>Departamento o Escuela:</b> ".$infgral->getIngEscuela()." </td></tr>";
			//segunda fila
			$html .= "<tr><td><b>Facultad / Instituto Academico:</b> ".$infgral->getIngFacultad()." </td>";
			$html .= "<td colspan=\"2\"><b>Programa:</b> ".$infgral->getIngNombrePrograma()." </td></tr>";
			//la tercer fila 
			$html .= "<tr><td><b>Modificaci&oacute;n Solicitada:</b> ".$infgral->getIngMotivoSolicitud()." </td>";
			$html .= "<td><b>Ciudad Sede:</b> ".$infgral->getIngCiudadSede()." </td>";
			$html .= "<td><b>Duracion:</b> ".$infgral->getIngDuracionPrograma()." Semestres </td></tr>";
			//la cuarte fila
			$html .= "<tr><td><b>Titulo que Otorga:</b> ".$infgral->getIngTituloOtorga()." </td>";
			$html .= "<td><b>Jornada:</b> ".$infgral->getIngJornada()." </td>";
			$html .= "<td><b>Modalidad:</b> ".$infgral->getIngTipoModalidad()." </td></tr>";
			//cierra la tabla
			$html .="</table>";
		
			$pdf->writeHTML($html,true,false,false,'L');
			//end informacion general 			
			
			//dejando espacion de lineas
			$pdf->Ln(5);
			
			//begin estructura curricular
			$estruhtml = $this->tablaCurricular($solicitud->getSolId());
			//aqui escribo las lineas
			$text = "<ul><li><b>Estructura Curricular</b><br/>
			A continuaci&oacute;n se presenta la informaci&oacute;n referente al n&uacute;mero de créditos por asignatura que corresponden al programa analizado
			</li></ul>";
			$pdf->writeHTML($text,true,false,false,'L');
			$pdf->Ln(2);
			$pdf->writeHTML($estruhtml,true,false,false,'L');
			//end estructura curricular
			
			$pdf->Ln(5);		
			
			//begin horas de docencia
			$estruhtml = $this->horasDocencia($solicitud->getSolId());
			$text = "<ul><li><b>Horas de docencia</b><br/></li></ul>";
			$pdf->writeHTML($text,true,false,false,'L');
			$pdf->Ln(2);
			$pdf->writeHTML($estruhtml,true,false,false,'L');
			//end horas de docencia
			
			$pdf->Ln(5);
			
			//begin ingresos
			$tbIngreso = $this->tablaIngresos($solicitud->getSolId());
			$text = "<ul><li><b>Ingresos</b><br/></li></ul>";
			$pdf->writeHTML($text,true,false,false,'L');
			$pdf->Ln(2);
			$pdf->writeHTML($tbIngreso,true,false,false,'L');
			//end ingresos
			
			$pdf->Ln(5);	
			
			//begin egresos
			$tbEgreso = $this->tablaEgresos($solicitud->getSolId());
			$text = "<ul><li><b>Egresos</b><br/></li></ul>";
			$pdf->writeHTML($text,true,false,false,'L');
			$pdf->Ln(2);
			$pdf->writeHTML($tbEgreso,true,false,false,'L');
			//end Egresos
			
			$pdf->Ln(5);
			
			//Punto de equilibrio
			$tbEquilibrio = $this->tablaPuntoEquilibrio($solicitud->getSolId());
			$text = "<ul><li><b>Sostenibilidad del programa con costos</b><br/></li></ul>";
			$pdf->writeHTML($text,true,false,false,'L');
			$pdf->Ln(2);
			$pdf->writeHTML($tbEquilibrio,true,false,false,'L');
			//fin
			
			$pdf->Ln(30);
			
			//averiguar la posibilidad de saber cuantas lineas faltan para el cambio de hoja en el documento
			//para evitar la separacion de la informacion de la firma
			
			//inclusion de la informacion para las firmaas digitales
			$text = "<b>Luis Carlos Castillo</b>";
			$pdf->writeHTML($text,true,false,false,'L');
			$text = "<b>Jefe Oficina de Planeaci&oacute;n y Desarrollo Institucional</b>";
			$pdf->writeHTML($text,true,false,false,'L');
			$text = "<b>Elaborado por:</b> Rodolfo Padilla M., Profesional OPDI";
			$pdf->writeHTML($text,true,false,false,'L');
			$text = "<b>Revisador por:</b> Ludmila Medina M., Coordinadora &Aacute;rea de An&aacute;lisis Institucional";
			$pdf->writeHTML($text,true,false,false,'L');
			
			//Close and output PDF document
			$pdf->Output('concepto'.$solicitud->getUpdatedAt().'.pdf', 'I');
    		return sfView::NONE; //para terminar la ejecucion de symfony
    	}
  }
  
  /*
  * Devuelve una tabla con los valores de los conceptos del punto de equilibrio
  * @param int sol_id indentificador de la solicitud
  * @return string tabla
  */
  private function tablaPuntoEquilibrio($sol_id)
  {
  		$tabla  ="<table border=\"2\">";  	  		
  		
  		//definicio de la cabecera
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID,$sol_id);
      $infgnral  = InformacionGeneralPeer::doSelectOne($c);
  		$numPeriodos = $infgnral->getIngDuracionPrograma();
  		
		//Cabecera de la tabla
		$tabla .= "<tr><td><b>Concepto</b></td>";
  		for($i=1; $i<=$numPeriodos ; $i++){
  			$tabla.="<td align=\"center\"><b>$i</b></td>";
  		}
  		$tabla .= "</tr>";
  		
  		
  		$ingMenosEgre = array_fill(0,$numPeriodos+1,0);
  		$ingMenosEgre[0] = $this->totalIngresos[0]." - ".$this->totalEgresos[0];
  		for($i = 1; $i <= $numPeriodos; $i++) {
  			$ingMenosEgre[$i] = $this->totalIngresos[$i] - $this->totalEgresos[$i];
  		}
  		
  		
  		
  		//punto de equilibrio es el total costos variables / valor de la matricula periodo a periodo
  		//$this->valorMatricula este array contiene los valores de matricula
  		if($infgnral->getIngFormaPago() == "Total carrera") {
			$ingMatriculaTemp = array_fill(0,$numPeriodos+1,round($ingMatricula[1]/$numPeriodos));
		} else {
			$ingMatriculaTemp	= $this->valorMatricula;
		}
  		$puntoEquilibrio    = array_fill(0,$numPeriodos+1,0);
  		$puntoEquilibrio[0] = "Punto de equilibrio costos variables";
  		for($i = 1; $i <= $numPeriodos; $i++) {
  			$denmdor = ($ingMatriculaTemp[$i] > 0)?$ingMatriculaTemp[$i]:1;
  			$puntoEquilibrio[$i] = $this->totalEgresos[$i] / $denmdor;
  		}
  		
  		
  		//inclusion de las filas a la tabla
  		$fingresos = "<tr><td>".$this->totalIngresos[0]."</td>";
  		$fegresos  = "<tr><td>".$this->totalEgresos[0]."</td>";
  		$fingmenegre = "<tr><td>".$ingMenosEgre[0]."</td>";
  		$fpntequili  = "<tr><td>".$puntoEquilibrio[0]."</td>";
  		for($i = 1; $i <= $numPeriodos; $i++) {
  			$fingresos   .= "<td align=\"right\">".number_format($this->totalIngresos[$i])."</td>";
			$fegresos    .= "<td align=\"right\">".number_format($this->totalEgresos[$i])."</td>";
			$fingmenegre .= "<td align=\"right\">".number_format($ingMenosEgre[$i])."</td>";
			$fpntequili  .= "<td align=\"right\">".number_format($puntoEquilibrio[$i])."</td>";
  		}
  		
  		$tabla .= $fingresos."</tr>";
  		$tabla .= $fegresos."</tr>";
  		$tabla .= $fingmenegre."</tr>";
  		$tabla .= $fpntequili."</tr>";
  		
  		
		$tabla .="</table>";
		return $tabla;
  }
  
  
  
  /*
  * @param int sol_id identificador de la solicitud
  * @return string tabla
  */
  private function tablaCurricular($sol_id)
  {
		$c = new Criteria();
		$c->add(ExtructuraCurricularPeer::ECU_SOL_ID,$sol_id);
		$estcrs = ExtructuraCurricularPeer::doSelect($c);
		
  		$tabla  ="<table border=\"2\">";
		$tabla .="<tr><th><b>Semestre</b></th><th><b>Nombre Asignatura</b></th><th><b>Cr&eacute;ditos</b></th></tr>";
		$tcreds = 0;
  		foreach($estcrs as $est){
  			$tcreds = $tcreds + $est->getEcuNumCreditos();
  			$tabla .= "<tr> <td>".$est->getEcuPeriodoAcademico()."</td> <td>".$est->getEcuAsignatura()."</td>  <td>".$est->getEcuNumCreditos()."</td> </tr>";
  		}
  		$tabla .="<tr> <td colspan=\"2\"><b>Total Cr&eacute;ditos </b></td> <td>".$tcreds."</td></tr>";
  		$tabla .="</table>";
  		
  		return $tabla;
  }
  
  
  /*
  * Devuelve una tabla con las horas de docencia periodo a periodo por tipo de vinculacion
  * @param int sol_id indentificador de la solicitud
  * @return string tabla
  */
  private function horasDocencia($sol_id)
  {
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID,$sol_id);
      $infgral  = InformacionGeneralPeer::doSelectOne($c);
		
		$tabla  ="<table border=\"2\">";
		$periodos = $infgral->getIngDuracionPrograma();
		
		//la cabecera
  		$tabla .= "<tr><td><b>Tipo vinculaci&oacute;n / Categor&iacute;a </b></td>";
  		for($i=1; $i<=$periodos ; $i++){
  			$tabla.="<td align=\"center\"><b>$i</b></td>";
  		}
  		$tabla .= "</tr>";
  		
  		//la iteracion por las profesiones
  		$c = new Criteria();
		$c->add(ExtructuraCurricularPeer::ECU_SOL_ID,$sol_id);
		$estcrs = ExtructuraCurricularPeer::doSelect($c);
		
		$contratista=array_fill(0,$periodos+1,0);
		$docentCarga=array_fill(0,$periodos+1,0);
		$docentBonif=array_fill(0,$periodos+1,0);
		$totales=array_fill(0,$periodos+1,0);
		
		$contratista[0]="Contratista";
		$docentCarga[0]="Docente nombrado (carga acad&eacute;mica)";
		$docentBonif[0]="Docente nombrado (bonificado)";
		$totales[0]="Total horas";
		foreach($estcrs as $ext)
		{
			$i =  $ext->getEcuPeriodoAcademico();
			$catg = $ext->getEcuHorasDictadasComo();
			$horas = $ext->getEcuTotalHoras();
			switch($catg)
			{
				case "Hora catedra":
					$contratista[$i]+=$horas; 
				break;

				case "Bonificado":
					$docentBonif[$i]+=$horas;
				break;

				case "Carga academica":
					$docentCarga[$i]+=$horas;
				break;
				
				default:
			}
			$totales[$i]+=$horas;
		}
		
		$contfil="<tr>";
		$cargfil="<tr>";
		$bonifil="<tr>";
		$totafil="<tr>";
		for($i =0; $i <= $periodos; $i++)
		{
			$contfil.="<td>".$contratista[$i]."</td>";
			$cargfil.="<td>".$docentCarga[$i]."</td>";
			$bonifil.="<td>".$docentBonif[$i]."</td>";
			$totafil.="<td><b>".$totales[$i]."</b></td>";
		}
		
		$contfil.="</tr>";
  		$cargfil.="</tr>";
  		$bonifil.="</tr>";
  		$totafil.="</tr>";
  		
  		//incluyo cada una de las filas en la  tabla
  		$tabla.=$contfil; $tabla.=$cargfil; $tabla.=$bonifil; $tabla.=$totafil;
  		
  		
  		$tabla .="</table>";
  		return $tabla;
  }
  
 
  
  /*
  * Devuelve una tabla con los valores de los conceptos de egreso periodo a periodo
  * @param int sol_id indentificador de la solicitud
  * @return string tabla
  */
  private function tablaEgresos($sol_id) 
  {
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID,$sol_id);
      $infgnral  = InformacionGeneralPeer::doSelectOne($c);
  		$numPeriodos = $infgnral->getIngDuracionPrograma();
  		
  		
  		$tabla  ="<table border=\"2\">";
		
		//Cabecera de la tabla
		$tabla .= "<tr><td><b>Concepto</b></td>";
  		for($i=1; $i<=$numPeriodos ; $i++){
  			$tabla.="<td align=\"center\"><b>$i</b></td>";
  		}
  		$tabla .= "</tr>";
  		
  		
  		//Horas de docencia y costo de docencia
  		$hraDocencia  = array_fill(0,$numPeriodos+1,0);
  		$costDocencia = array_fill(0,$numPeriodos+1,0);
  		$hraDocencia[0] = "Horas de docencia";
  		$costDocencia[0]= "Costo de docencia";
  		
  		$c = new Criteria();
    	$c->add(ExtructuraCurricularPeer::ECU_SOL_ID, $sol_id);
    	$extCurriculares = ExtructuraCurricularPeer::doSelect($c);
  		foreach($extCurriculares as $extCurricular)
    	{
      	$periodo      = $extCurricular->getEcuPeriodoAcademico();
      	$horas        = $extCurricular->getEcuTotalHoras();
      	$valorHora    = $extCurricular->getEcuValorHora();
      	$progComparte = $extCurricular->getEcuNumProgramaComparte();
      
      	$hraDocencia[$periodo]  += $horas;      
      	$costDocencia[$periodo] += round($valorHora * ( $horas / ($progComparte + 1) ));
    	}
  		//fin 
  		
  		
  		//INICIO GASTOS ADMINISTRATIVOS
		
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
		
		if($infgnral->isPregrado())
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
		
  		$gastosAdmin = array_fill(0,$numPeriodos+1,$gastosAdministrativos);
		$gastosAdmin[0] = "Gastos administrativos";
  		//FIN DE GASTOS ADMINISTRATIVOS
  		
  		//Gastos generales
  		$gtosGneral = array_fill(0,$numPeriodos+1,0);
    	$gtosGneral[0] = "Gastos generales";
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
				$periodo = $gastoGeneral->getIggPeriodo();
				$gasto   = $gastoGeneral->getIggCosto();
				$gtosGneral[$periodo] += $gasto;
			}
	   }
  		
  		//fin gastos generales
  		
  		
  		//inicio inversion 
	  	$factorInversion = 1;
	   $arrInversion = array_fill(0,$numPeriodos+1,0);
	   $arrInversion[0] = "Inversion";
	   $rejistroTemp = array_fill(0,$numPeriodos,0);
	    
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
	      
	      for($i=1; $i<=$numPeriodos; $i++)
	      {
	        $arrInversion[$i] += $valorTotalInversion * $factorInversion;  
	      }
	      
    	}
  		//fin inversion el mismo calculo de la simulacion
  		
  		
  		//calculo de los totales
  		$totales = array_fill(0,$numPeriodos+1,0);
  		$totales[0]="Total costos";
  		for($i = 1; $i <= $numPeriodos; $i++) {
        		$totales[$i] = $costDocencia[$i] + $gastosAdmin[$i] + $gtosGneral[$i] + $arrInversion[$i];
      }
  		//fin calculo totales
  		
  		
  		//agregando filas a la tabla
  		$fhraDocencia  = "<tr><td>$hraDocencia[0]</td>";
  		$fcostDocencia = "<tr><td>$costDocencia[0]</td>";
  		$fgastosAdmin = "<tr><td>$gastosAdmin[0]</td>";
  		$fgtosGneral = "<tr><td>$gtosGneral[0]</td>";
  		$farrInversion = "<tr><td>$arrInversion[0]</td>";
  		$ftotales  = "<tr><td><b>$totales[0]</b></td>";
  		for($i = 1; $i <= $numPeriodos; $i++){
  			$fhraDocencia  .= "<td>$hraDocencia[$i]</td>";
  			$fcostDocencia .= "<td align=\"right\">".number_format($costDocencia[$i])."</td>";
  			$fgastosAdmin  .= "<td align=\"right\">".number_format($gastosAdmin[$i])."</td>";
  			$fgtosGneral   .= "<td align=\"right\">".number_format($gtosGneral[$i])."</td>";
  			$farrInversion .= "<td align=\"right\">".number_format($arrInversion[$i])."</td>";
  			$ftotales      .= "<td align=\"right\">".number_format($totales[$i])."</td>";
  		}
  		$tabla .= $fhraDocencia."</tr>";
  		$tabla .= $fcostDocencia."</tr>";
  		$tabla .= $fgastosAdmin."</tr>";
  		$tabla .= $fgtosGneral."</tr>";
  		$tabla .= $farrInversion."</tr>";
  		$tabla .= $ftotales."</tr>";
  		
		$tabla .="</table>";
		
		//para usar en el calculo del punto de equilibrio
		$this->totalEgresos = $totales;
		
  		return $tabla;
  }
  
  
  /**
  * Calcula el factor a multiplicar al valor total de la inversion dado el el nombre del concepto
  *@param concepto Nombre del concepto
  *@return int el fator de inversion
  */
  private function getFactorInversion($concepto)
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
  
  
  private function getNumPeriodos($sol_id)
  {
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID,$sol_id);
      $infgnral  = InformacionGeneralPeer::doSelectOne($c);
  		$numPeriodos = $infgnral->getIngDuracionPrograma();
  		return $numPeriodos;
  }
  
  
   /*
  * Devuelve una tabla con los valores de los conceptos de ingreso periodo a periodo
  * @param int sol_id indentificador de la solicitud
  * @return string tabla
  */
  private function tablaIngresos($sol_id)
  {
  		$c = new Criteria();
      $c->add(InformacionGeneralPeer::ING_SOL_ID,$sol_id);
      $infgnral  = InformacionGeneralPeer::doSelectOne($c);
  		$numPeriodos = $infgnral->getIngDuracionPrograma();
  		
  		$tabla  ="<table border=\"2\">";
  		
  			//la cabecera
  		$tabla .= "<tr><td><b>Concepto</b></td>";
  		for($i=1; $i<=$numPeriodos ; $i++){
  			$tabla.="<td align=\"center\"><b>$i</b></td>";
  		}
  		$tabla .= "</tr>";
  		
  		
  		$c = new Criteria();
      $c->add(PresupuestoIngresosPeer::PIN_SOL_ID, $sol_id);
      $preIngreso = PresupuestoIngresosPeer::doSelectOne($c);
  		
  		
  		
  		//estudiantes inscritos
  		$estInscriptos = array_fill(0,$numPeriodos+1,0);
  		$estInscriptos[0] = "Estudiantes inscritos";
  		$estInscriptos[1] = $preIngreso->getPinNumeroInscritos();
  		
  		
  		//estudiantes matriculados
  		$desercion = DESERCION;
  		$estMatriculado = array_fill(0,$numPeriodos+1,0);
  		$estMatriculado[0] = "Estudiantes matriculados";
  		$estMatriculado[1] = $preIngreso->getPinNumeroMatriculados();
		for($i = 2; $i <= $numPeriodos; $i++){
         $estMatriculado[$i] = round($estMatriculado[ $i - 1 ] * ( 1 - $desercion ));
      }
  		
  		//Ingresos por matricula
  		$valor_matricula = VALOR_MATRICULA;
  		$salario_minimo = SMMLV;
  		$ingMatricula = array_fill(0,$numPeriodos+1,0);
  		$ingMatricula[0] = "Ingreso por matr&iacute;cula";
  		if($infgnral->isPregrado()) {
        for($i = 1; $i <= $numPeriodos; $i++) {
          $ingMatricula[$i] = $estMatriculado[$i] * $valor_matricula;
        }
  		}else
  		{
  			
  			$tipoPago = $infgnral->getIngTipoValor();
  			
  			if($tipoPago == "Valor Unico")
  			{
  				$formPago = $infgnral->getIngFormaPago();
  				$valor_matricula =  $infgnral->getIngValor() * $salario_minimo;
  				
  				if($formPago == "Semestral"){
  					for($i = 1; $i <= $numPeriodos; $i++){
		         	$ingMatricula[$i] = $estMatriculado[$i] * $valor_matricula;
		       	}
  				}
  				
  				if($formPago == "Anual"){
  					$valor_matricula = ($valor_matricula/2);
  					for($i = 1; $i <= $numPeriodos; $i++){
		         	$ingMatricula[$i] = $estMatriculado[$i] * $valor_matricula;
		       	}
  				}
  				
  				if($formPago == "Creditos"){
  					$numCreditoPeriodo = $this->creditosPeriodo($sol_id, $numPeriodos);
		       	for($i = 1; $i <= $numPeriodos; $i++){
		         	$ingMatricula[$i] = $estMatriculado[$i] * ($numCreditoPeriodo[$i] * $valor_matricula);
		       	}
  				}
  				
  				if($formPago == "Total carrera"){
  					$ingMatricula[1]= $estMatriculado[1] * $valor_matricula;
  				}
  				
  			}else{
  			
				$c = new Criteria();
				$c->add(ValorDiferenciadoPeer::VAD_ING_ID, $infgnral->getIngId());
				$valDiff = ValorDiferenciadoPeer::doSelect($c);
				foreach($valDiff as $vdif){
					$p = $vdif->getVadPeriodo();
					$v = $vdif->getVadValor() * $salario_minimo;
					$ingMatricula[$p] = $estMatriculado[$p] * $v ; 
				}
				
  			}
  			
  		}
  		//fin ingresos por matricula
  		
  		
  		
  		//comienzo ingresos por convenio
		$ingConvenio = array_fill(0,$numPeriodos+1,0);
		$ingConvenio[0] = "Ingresos por convenios";
		
		$c = new Criteria();
      $c->add(FuentesExternasPeer::FUE_SOL_ID, $sol_id);
      $fExts = FuentesExternasPeer::doSelect($c);
      
      foreach($fExts as $fext) {
			$c1 = new Criteria();
			$c1->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $fext->getFueId());
			$contriFuentes = ContribucionFuenteExternaPeer::doSelect($c1);
			foreach($contriFuentes as $conFuente){
				$p = $conFuente->getCfePeriodo();
				$v = $conFuente->getCfeValor();//el valor esta en pesos
          	$ingConvenio[$p]+=$v;
        	}
			
		}
		//fin ingresos por convenio
  		
  		
  		//comienzo exenciones 
  		$exencion = $preIngreso->getPinExenciones();
      $exencion = $exencion * 0.01;//para dejarlo expresado como % (porcentaje)
  		$exenciones = array_fill(0,$numPeriodos+1,0);
  		$exenciones[0] = "Exenciones";
		
		if($infgnral->getIngFormaPago() == "Total carrera") {
			$ingMatriculaTemp = array_fill(0,$numPeriodos+1,round($ingMatricula[1]/$numPeriodos));
			for($i = 1; $i <= $numPeriodos; $i++) {
        		$exenciones[$i] = $ingMatriculaTemp[$i] * $exencion;
      	}
      	
		} else {
			for($i = 1; $i <= $numPeriodos; $i++) {
        		$exenciones[$i] = $ingMatricula[$i] * $exencion;
      	}
		}
  		//fin exenciones
  		
  		//para el calculo del punto de equilibrio
  		$this->valorMatricula = $ingMatricula;
  		
  		
  		//calculo de los totales
  		$totales = array_fill(0,$numPeriodos+1,0);
  		$totales[0]="Total ingresos";
  		for($i = 1; $i <= $numPeriodos; $i++) {
        		$totales[$i] = $ingConvenio[$i] + $ingMatricula[$i] - $exenciones[$i];
      }
  		//fin calculo totales
  		
  		
  		
  		
  		//incluyo los conceptos en la tabla
  		$festInscr = "<tr><td>$estInscriptos[0]</td>";
  		$festMatri = "<tr><td>$estMatriculado[0]</td>";
  		$fingMatri = "<tr><td>$ingMatricula[0]</td>";
  		$fingConve = "<tr><td>$ingConvenio[0]</td>";
  		$fExcencio = "<tr><td>$exenciones[0]</td>";
  		$ftotales  = "<tr><td><b>$totales[0]</b></td>";
  		for($i = 1; $i <= $numPeriodos; $i++)
  		{
  			$festInscr .="<td>$estInscriptos[$i]</td>";
  			$festMatri .="<td>$estMatriculado[$i]</td>";
  			$fingMatri .="<td align=\"right\">".number_format($ingMatricula[$i])."</td>";
  			$fingConve .="<td align=\"right\">".number_format($ingConvenio[$i])."</td>";
  			$fExcencio .="<td align=\"right\">".number_format($exenciones[$i])."</td>";
  			$ftotales  .="<td align=\"right\">".number_format($totales[$i])."</td>";
  		}
  		$festInscr .= "</tr>";
  		$festMatri .= "</tr>";
  		$fingMatri .= "</tr>";
  		$fingConve .= "</tr>";
		$fExcencio .= "</tr>";
		$ftotales  .= "</tr>";
		
		//agrego cada una de las filas a la tabla  		
  		$tabla .= $festInscr;
  		$tabla .= $festMatri;
  		$tabla .= $fingMatri;
  		$tabla .= $fingConve;
  		$tabla .= $fExcencio;
  		$tabla .= $ftotales;
  		
  		//prueba de los parametros de configuracion los parametros estan funcionando
  		//$tabla .= "<tr><td>$desercion</td><td>$valor_matricula</td><td>$salario_minimo</td><td>$exencion</td></tr>";
  		  		
  		$tabla .="</table>";
  		
  		//para usar en el punto de equilibrio
  		$this->totalIngresos= $totales;
  		return $tabla;
  }
  
  
 /**
  * Calcula el numero de creditos por periodo de una de un programa academico
  * @param string sol_id : identificador de la solicitud
  * @param string numeroPeriodos : numero de periodos del programa
  * @return array numCredPeriodo 
  */
  private function creditosPeriodo($sol_id , $numeroPeriodos)
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
  
  
  
}
