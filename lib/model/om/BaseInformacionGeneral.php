<?php


abstract class BaseInformacionGeneral extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ing_id;


	
	protected $ing_sol_id;


	
	protected $ing_fecha;


	
	protected $ing_solicitante;


	
	protected $ing_facultad;


	
	protected $ing_escuela;


	
	protected $ing_nombre_programa;


	
	protected $ing_titulo_otorga;


	
	protected $ing_motivo_solicitud;


	
	protected $ing_cual_motivo;


	
	protected $ing_ciudad_sede;


	
	protected $ing_nivel_academico;


	
	protected $ing_duracion_programa;


	
	protected $ing_jornada;


	
	protected $ing_tipo_modalidad;


	
	protected $ing_tipo_valor;


	
	protected $ing_forma_pago;


	
	protected $ing_valor;

	
	protected $aSolicitud;

	
	protected $collValorDiferenciados;

	
	protected $lastValorDiferenciadoCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIngId()
	{

		return $this->ing_id;
	}

	
	public function getIngSolId()
	{

		return $this->ing_sol_id;
	}

	
	public function getIngFecha($format = 'Y-m-d')
	{

		if ($this->ing_fecha === null || $this->ing_fecha === '') {
			return null;
		} elseif (!is_int($this->ing_fecha)) {
						$ts = strtotime($this->ing_fecha);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [ing_fecha] as date/time value: " . var_export($this->ing_fecha, true));
			}
		} else {
			$ts = $this->ing_fecha;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getIngSolicitante()
	{

		return $this->ing_solicitante;
	}

	
	public function getIngFacultad()
	{

		return $this->ing_facultad;
	}

	
	public function getIngEscuela()
	{

		return $this->ing_escuela;
	}

	
	public function getIngNombrePrograma()
	{

		return $this->ing_nombre_programa;
	}

	
	public function getIngTituloOtorga()
	{

		return $this->ing_titulo_otorga;
	}

	
	public function getIngMotivoSolicitud()
	{

		return $this->ing_motivo_solicitud;
	}

	
	public function getIngCualMotivo()
	{

		return $this->ing_cual_motivo;
	}

	
	public function getIngCiudadSede()
	{

		return $this->ing_ciudad_sede;
	}

	
	public function getIngNivelAcademico()
	{

		return $this->ing_nivel_academico;
	}

	
	public function getIngDuracionPrograma()
	{

		return $this->ing_duracion_programa;
	}

	
	public function getIngJornada()
	{

		return $this->ing_jornada;
	}

	
	public function getIngTipoModalidad()
	{

		return $this->ing_tipo_modalidad;
	}

	
	public function getIngTipoValor()
	{

		return $this->ing_tipo_valor;
	}

	
	public function getIngFormaPago()
	{

		return $this->ing_forma_pago;
	}

	
	public function getIngValor()
	{

		return $this->ing_valor;
	}

	
	public function setIngId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ing_id !== $v) {
			$this->ing_id = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_ID;
		}

	} 
	
	public function setIngSolId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ing_sol_id !== $v) {
			$this->ing_sol_id = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setIngFecha($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [ing_fecha] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->ing_fecha !== $ts) {
			$this->ing_fecha = $ts;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_FECHA;
		}

	} 
	
	public function setIngSolicitante($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_solicitante !== $v) {
			$this->ing_solicitante = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_SOLICITANTE;
		}

	} 
	
	public function setIngFacultad($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_facultad !== $v) {
			$this->ing_facultad = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_FACULTAD;
		}

	} 
	
	public function setIngEscuela($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_escuela !== $v) {
			$this->ing_escuela = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_ESCUELA;
		}

	} 
	
	public function setIngNombrePrograma($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_nombre_programa !== $v) {
			$this->ing_nombre_programa = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_NOMBRE_PROGRAMA;
		}

	} 
	
	public function setIngTituloOtorga($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_titulo_otorga !== $v) {
			$this->ing_titulo_otorga = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_TITULO_OTORGA;
		}

	} 
	
	public function setIngMotivoSolicitud($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_motivo_solicitud !== $v) {
			$this->ing_motivo_solicitud = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_MOTIVO_SOLICITUD;
		}

	} 
	
	public function setIngCualMotivo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_cual_motivo !== $v) {
			$this->ing_cual_motivo = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_CUAL_MOTIVO;
		}

	} 
	
	public function setIngCiudadSede($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_ciudad_sede !== $v) {
			$this->ing_ciudad_sede = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_CIUDAD_SEDE;
		}

	} 
	
	public function setIngNivelAcademico($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_nivel_academico !== $v) {
			$this->ing_nivel_academico = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_NIVEL_ACADEMICO;
		}

	} 
	
	public function setIngDuracionPrograma($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ing_duracion_programa !== $v) {
			$this->ing_duracion_programa = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_DURACION_PROGRAMA;
		}

	} 
	
	public function setIngJornada($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_jornada !== $v) {
			$this->ing_jornada = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_JORNADA;
		}

	} 
	
	public function setIngTipoModalidad($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_tipo_modalidad !== $v) {
			$this->ing_tipo_modalidad = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_TIPO_MODALIDAD;
		}

	} 
	
	public function setIngTipoValor($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_tipo_valor !== $v) {
			$this->ing_tipo_valor = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_TIPO_VALOR;
		}

	} 
	
	public function setIngFormaPago($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ing_forma_pago !== $v) {
			$this->ing_forma_pago = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_FORMA_PAGO;
		}

	} 
	
	public function setIngValor($v)
	{

		if ($this->ing_valor !== $v) {
			$this->ing_valor = $v;
			$this->modifiedColumns[] = InformacionGeneralPeer::ING_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ing_id = $rs->getInt($startcol + 0);

			$this->ing_sol_id = $rs->getInt($startcol + 1);

			$this->ing_fecha = $rs->getDate($startcol + 2, null);

			$this->ing_solicitante = $rs->getString($startcol + 3);

			$this->ing_facultad = $rs->getString($startcol + 4);

			$this->ing_escuela = $rs->getString($startcol + 5);

			$this->ing_nombre_programa = $rs->getString($startcol + 6);

			$this->ing_titulo_otorga = $rs->getString($startcol + 7);

			$this->ing_motivo_solicitud = $rs->getString($startcol + 8);

			$this->ing_cual_motivo = $rs->getString($startcol + 9);

			$this->ing_ciudad_sede = $rs->getString($startcol + 10);

			$this->ing_nivel_academico = $rs->getString($startcol + 11);

			$this->ing_duracion_programa = $rs->getInt($startcol + 12);

			$this->ing_jornada = $rs->getString($startcol + 13);

			$this->ing_tipo_modalidad = $rs->getString($startcol + 14);

			$this->ing_tipo_valor = $rs->getString($startcol + 15);

			$this->ing_forma_pago = $rs->getString($startcol + 16);

			$this->ing_valor = $rs->getFloat($startcol + 17);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 18; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InformacionGeneral object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InformacionGeneralPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InformacionGeneralPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InformacionGeneralPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			$affectedRows = $this->doSave($con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	protected function doSave($con)
	{
		$affectedRows = 0; 		if (!$this->alreadyInSave) {
			$this->alreadyInSave = true;


												
			if ($this->aSolicitud !== null) {
				if ($this->aSolicitud->isModified()) {
					$affectedRows += $this->aSolicitud->save($con);
				}
				$this->setSolicitud($this->aSolicitud);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InformacionGeneralPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setIngId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += InformacionGeneralPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collValorDiferenciados !== null) {
				foreach($this->collValorDiferenciados as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			$this->alreadyInSave = false;
		}
		return $affectedRows;
	} 
	
	protected $validationFailures = array();

	
	public function getValidationFailures()
	{
		return $this->validationFailures;
	}

	
	public function validate($columns = null)
	{
		$res = $this->doValidate($columns);
		if ($res === true) {
			$this->validationFailures = array();
			return true;
		} else {
			$this->validationFailures = $res;
			return false;
		}
	}

	
	protected function doValidate($columns = null)
	{
		if (!$this->alreadyInValidation) {
			$this->alreadyInValidation = true;
			$retval = null;

			$failureMap = array();


												
			if ($this->aSolicitud !== null) {
				if (!$this->aSolicitud->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSolicitud->getValidationFailures());
				}
			}


			if (($retval = InformacionGeneralPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collValorDiferenciados !== null) {
					foreach($this->collValorDiferenciados as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}


			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformacionGeneralPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIngId();
				break;
			case 1:
				return $this->getIngSolId();
				break;
			case 2:
				return $this->getIngFecha();
				break;
			case 3:
				return $this->getIngSolicitante();
				break;
			case 4:
				return $this->getIngFacultad();
				break;
			case 5:
				return $this->getIngEscuela();
				break;
			case 6:
				return $this->getIngNombrePrograma();
				break;
			case 7:
				return $this->getIngTituloOtorga();
				break;
			case 8:
				return $this->getIngMotivoSolicitud();
				break;
			case 9:
				return $this->getIngCualMotivo();
				break;
			case 10:
				return $this->getIngCiudadSede();
				break;
			case 11:
				return $this->getIngNivelAcademico();
				break;
			case 12:
				return $this->getIngDuracionPrograma();
				break;
			case 13:
				return $this->getIngJornada();
				break;
			case 14:
				return $this->getIngTipoModalidad();
				break;
			case 15:
				return $this->getIngTipoValor();
				break;
			case 16:
				return $this->getIngFormaPago();
				break;
			case 17:
				return $this->getIngValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformacionGeneralPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIngId(),
			$keys[1] => $this->getIngSolId(),
			$keys[2] => $this->getIngFecha(),
			$keys[3] => $this->getIngSolicitante(),
			$keys[4] => $this->getIngFacultad(),
			$keys[5] => $this->getIngEscuela(),
			$keys[6] => $this->getIngNombrePrograma(),
			$keys[7] => $this->getIngTituloOtorga(),
			$keys[8] => $this->getIngMotivoSolicitud(),
			$keys[9] => $this->getIngCualMotivo(),
			$keys[10] => $this->getIngCiudadSede(),
			$keys[11] => $this->getIngNivelAcademico(),
			$keys[12] => $this->getIngDuracionPrograma(),
			$keys[13] => $this->getIngJornada(),
			$keys[14] => $this->getIngTipoModalidad(),
			$keys[15] => $this->getIngTipoValor(),
			$keys[16] => $this->getIngFormaPago(),
			$keys[17] => $this->getIngValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InformacionGeneralPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIngId($value);
				break;
			case 1:
				$this->setIngSolId($value);
				break;
			case 2:
				$this->setIngFecha($value);
				break;
			case 3:
				$this->setIngSolicitante($value);
				break;
			case 4:
				$this->setIngFacultad($value);
				break;
			case 5:
				$this->setIngEscuela($value);
				break;
			case 6:
				$this->setIngNombrePrograma($value);
				break;
			case 7:
				$this->setIngTituloOtorga($value);
				break;
			case 8:
				$this->setIngMotivoSolicitud($value);
				break;
			case 9:
				$this->setIngCualMotivo($value);
				break;
			case 10:
				$this->setIngCiudadSede($value);
				break;
			case 11:
				$this->setIngNivelAcademico($value);
				break;
			case 12:
				$this->setIngDuracionPrograma($value);
				break;
			case 13:
				$this->setIngJornada($value);
				break;
			case 14:
				$this->setIngTipoModalidad($value);
				break;
			case 15:
				$this->setIngTipoValor($value);
				break;
			case 16:
				$this->setIngFormaPago($value);
				break;
			case 17:
				$this->setIngValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InformacionGeneralPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIngId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIngSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIngFecha($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIngSolicitante($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setIngFacultad($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setIngEscuela($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setIngNombrePrograma($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setIngTituloOtorga($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setIngMotivoSolicitud($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setIngCualMotivo($arr[$keys[9]]);
		if (array_key_exists($keys[10], $arr)) $this->setIngCiudadSede($arr[$keys[10]]);
		if (array_key_exists($keys[11], $arr)) $this->setIngNivelAcademico($arr[$keys[11]]);
		if (array_key_exists($keys[12], $arr)) $this->setIngDuracionPrograma($arr[$keys[12]]);
		if (array_key_exists($keys[13], $arr)) $this->setIngJornada($arr[$keys[13]]);
		if (array_key_exists($keys[14], $arr)) $this->setIngTipoModalidad($arr[$keys[14]]);
		if (array_key_exists($keys[15], $arr)) $this->setIngTipoValor($arr[$keys[15]]);
		if (array_key_exists($keys[16], $arr)) $this->setIngFormaPago($arr[$keys[16]]);
		if (array_key_exists($keys[17], $arr)) $this->setIngValor($arr[$keys[17]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InformacionGeneralPeer::DATABASE_NAME);

		if ($this->isColumnModified(InformacionGeneralPeer::ING_ID)) $criteria->add(InformacionGeneralPeer::ING_ID, $this->ing_id);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_SOL_ID)) $criteria->add(InformacionGeneralPeer::ING_SOL_ID, $this->ing_sol_id);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_FECHA)) $criteria->add(InformacionGeneralPeer::ING_FECHA, $this->ing_fecha);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_SOLICITANTE)) $criteria->add(InformacionGeneralPeer::ING_SOLICITANTE, $this->ing_solicitante);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_FACULTAD)) $criteria->add(InformacionGeneralPeer::ING_FACULTAD, $this->ing_facultad);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_ESCUELA)) $criteria->add(InformacionGeneralPeer::ING_ESCUELA, $this->ing_escuela);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_NOMBRE_PROGRAMA)) $criteria->add(InformacionGeneralPeer::ING_NOMBRE_PROGRAMA, $this->ing_nombre_programa);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_TITULO_OTORGA)) $criteria->add(InformacionGeneralPeer::ING_TITULO_OTORGA, $this->ing_titulo_otorga);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_MOTIVO_SOLICITUD)) $criteria->add(InformacionGeneralPeer::ING_MOTIVO_SOLICITUD, $this->ing_motivo_solicitud);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_CUAL_MOTIVO)) $criteria->add(InformacionGeneralPeer::ING_CUAL_MOTIVO, $this->ing_cual_motivo);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_CIUDAD_SEDE)) $criteria->add(InformacionGeneralPeer::ING_CIUDAD_SEDE, $this->ing_ciudad_sede);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_NIVEL_ACADEMICO)) $criteria->add(InformacionGeneralPeer::ING_NIVEL_ACADEMICO, $this->ing_nivel_academico);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_DURACION_PROGRAMA)) $criteria->add(InformacionGeneralPeer::ING_DURACION_PROGRAMA, $this->ing_duracion_programa);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_JORNADA)) $criteria->add(InformacionGeneralPeer::ING_JORNADA, $this->ing_jornada);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_TIPO_MODALIDAD)) $criteria->add(InformacionGeneralPeer::ING_TIPO_MODALIDAD, $this->ing_tipo_modalidad);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_TIPO_VALOR)) $criteria->add(InformacionGeneralPeer::ING_TIPO_VALOR, $this->ing_tipo_valor);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_FORMA_PAGO)) $criteria->add(InformacionGeneralPeer::ING_FORMA_PAGO, $this->ing_forma_pago);
		if ($this->isColumnModified(InformacionGeneralPeer::ING_VALOR)) $criteria->add(InformacionGeneralPeer::ING_VALOR, $this->ing_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InformacionGeneralPeer::DATABASE_NAME);

		$criteria->add(InformacionGeneralPeer::ING_ID, $this->ing_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getIngId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setIngId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIngSolId($this->ing_sol_id);

		$copyObj->setIngFecha($this->ing_fecha);

		$copyObj->setIngSolicitante($this->ing_solicitante);

		$copyObj->setIngFacultad($this->ing_facultad);

		$copyObj->setIngEscuela($this->ing_escuela);

		$copyObj->setIngNombrePrograma($this->ing_nombre_programa);

		$copyObj->setIngTituloOtorga($this->ing_titulo_otorga);

		$copyObj->setIngMotivoSolicitud($this->ing_motivo_solicitud);

		$copyObj->setIngCualMotivo($this->ing_cual_motivo);

		$copyObj->setIngCiudadSede($this->ing_ciudad_sede);

		$copyObj->setIngNivelAcademico($this->ing_nivel_academico);

		$copyObj->setIngDuracionPrograma($this->ing_duracion_programa);

		$copyObj->setIngJornada($this->ing_jornada);

		$copyObj->setIngTipoModalidad($this->ing_tipo_modalidad);

		$copyObj->setIngTipoValor($this->ing_tipo_valor);

		$copyObj->setIngFormaPago($this->ing_forma_pago);

		$copyObj->setIngValor($this->ing_valor);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getValorDiferenciados() as $relObj) {
				$copyObj->addValorDiferenciado($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setIngId(NULL); 
	}

	
	public function copy($deepCopy = false)
	{
				$clazz = get_class($this);
		$copyObj = new $clazz();
		$this->copyInto($copyObj, $deepCopy);
		return $copyObj;
	}

	
	public function getPeer()
	{
		if (self::$peer === null) {
			self::$peer = new InformacionGeneralPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setIngSolId(NULL);
		} else {
			$this->setIngSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->ing_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->ing_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function initValorDiferenciados()
	{
		if ($this->collValorDiferenciados === null) {
			$this->collValorDiferenciados = array();
		}
	}

	
	public function getValorDiferenciados($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseValorDiferenciadoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collValorDiferenciados === null) {
			if ($this->isNew()) {
			   $this->collValorDiferenciados = array();
			} else {

				$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $this->getIngId());

				ValorDiferenciadoPeer::addSelectColumns($criteria);
				$this->collValorDiferenciados = ValorDiferenciadoPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $this->getIngId());

				ValorDiferenciadoPeer::addSelectColumns($criteria);
				if (!isset($this->lastValorDiferenciadoCriteria) || !$this->lastValorDiferenciadoCriteria->equals($criteria)) {
					$this->collValorDiferenciados = ValorDiferenciadoPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastValorDiferenciadoCriteria = $criteria;
		return $this->collValorDiferenciados;
	}

	
	public function countValorDiferenciados($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseValorDiferenciadoPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $this->getIngId());

		return ValorDiferenciadoPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addValorDiferenciado(ValorDiferenciado $l)
	{
		$this->collValorDiferenciados[] = $l;
		$l->setInformacionGeneral($this);
	}

} 