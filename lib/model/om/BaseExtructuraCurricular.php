<?php


abstract class BaseExtructuraCurricular extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $ecu_id;


	
	protected $ecu_sol_id;


	
	protected $ecu_periodo_academico;


	
	protected $ecu_asignatura;


	
	protected $ecu_num_creditos;


	
	protected $ecu_total_horas;


	
	protected $ecu_num_programa_comparte;


	
	protected $ecu_categoria_docente;


	
	protected $ecu_horas_dictadas_como;


	
	protected $ecu_valor_hora;

	
	protected $aSolicitud;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getEcuId()
	{

		return $this->ecu_id;
	}

	
	public function getEcuSolId()
	{

		return $this->ecu_sol_id;
	}

	
	public function getEcuPeriodoAcademico()
	{

		return $this->ecu_periodo_academico;
	}

	
	public function getEcuAsignatura()
	{

		return $this->ecu_asignatura;
	}

	
	public function getEcuNumCreditos()
	{

		return $this->ecu_num_creditos;
	}

	
	public function getEcuTotalHoras()
	{

		return $this->ecu_total_horas;
	}

	
	public function getEcuNumProgramaComparte()
	{

		return $this->ecu_num_programa_comparte;
	}

	
	public function getEcuCategoriaDocente()
	{

		return $this->ecu_categoria_docente;
	}

	
	public function getEcuHorasDictadasComo()
	{

		return $this->ecu_horas_dictadas_como;
	}

	
	public function getEcuValorHora()
	{

		return $this->ecu_valor_hora;
	}

	
	public function setEcuId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_id !== $v) {
			$this->ecu_id = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_ID;
		}

	} 
	
	public function setEcuSolId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_sol_id !== $v) {
			$this->ecu_sol_id = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setEcuPeriodoAcademico($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_periodo_academico !== $v) {
			$this->ecu_periodo_academico = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO;
		}

	} 
	
	public function setEcuAsignatura($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ecu_asignatura !== $v) {
			$this->ecu_asignatura = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_ASIGNATURA;
		}

	} 
	
	public function setEcuNumCreditos($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_num_creditos !== $v) {
			$this->ecu_num_creditos = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_NUM_CREDITOS;
		}

	} 
	
	public function setEcuTotalHoras($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_total_horas !== $v) {
			$this->ecu_total_horas = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_TOTAL_HORAS;
		}

	} 
	
	public function setEcuNumProgramaComparte($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->ecu_num_programa_comparte !== $v) {
			$this->ecu_num_programa_comparte = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE;
		}

	} 
	
	public function setEcuCategoriaDocente($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ecu_categoria_docente !== $v) {
			$this->ecu_categoria_docente = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE;
		}

	} 
	
	public function setEcuHorasDictadasComo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->ecu_horas_dictadas_como !== $v) {
			$this->ecu_horas_dictadas_como = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO;
		}

	} 
	
	public function setEcuValorHora($v)
	{

		if ($this->ecu_valor_hora !== $v) {
			$this->ecu_valor_hora = $v;
			$this->modifiedColumns[] = ExtructuraCurricularPeer::ECU_VALOR_HORA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->ecu_id = $rs->getInt($startcol + 0);

			$this->ecu_sol_id = $rs->getInt($startcol + 1);

			$this->ecu_periodo_academico = $rs->getInt($startcol + 2);

			$this->ecu_asignatura = $rs->getString($startcol + 3);

			$this->ecu_num_creditos = $rs->getInt($startcol + 4);

			$this->ecu_total_horas = $rs->getInt($startcol + 5);

			$this->ecu_num_programa_comparte = $rs->getInt($startcol + 6);

			$this->ecu_categoria_docente = $rs->getString($startcol + 7);

			$this->ecu_horas_dictadas_como = $rs->getString($startcol + 8);

			$this->ecu_valor_hora = $rs->getFloat($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ExtructuraCurricular object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ExtructuraCurricularPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ExtructuraCurricularPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ExtructuraCurricularPeer::DATABASE_NAME);
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
					$pk = ExtructuraCurricularPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setEcuId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ExtructuraCurricularPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

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


			if (($retval = ExtructuraCurricularPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ExtructuraCurricularPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getEcuId();
				break;
			case 1:
				return $this->getEcuSolId();
				break;
			case 2:
				return $this->getEcuPeriodoAcademico();
				break;
			case 3:
				return $this->getEcuAsignatura();
				break;
			case 4:
				return $this->getEcuNumCreditos();
				break;
			case 5:
				return $this->getEcuTotalHoras();
				break;
			case 6:
				return $this->getEcuNumProgramaComparte();
				break;
			case 7:
				return $this->getEcuCategoriaDocente();
				break;
			case 8:
				return $this->getEcuHorasDictadasComo();
				break;
			case 9:
				return $this->getEcuValorHora();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExtructuraCurricularPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getEcuId(),
			$keys[1] => $this->getEcuSolId(),
			$keys[2] => $this->getEcuPeriodoAcademico(),
			$keys[3] => $this->getEcuAsignatura(),
			$keys[4] => $this->getEcuNumCreditos(),
			$keys[5] => $this->getEcuTotalHoras(),
			$keys[6] => $this->getEcuNumProgramaComparte(),
			$keys[7] => $this->getEcuCategoriaDocente(),
			$keys[8] => $this->getEcuHorasDictadasComo(),
			$keys[9] => $this->getEcuValorHora(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ExtructuraCurricularPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setEcuId($value);
				break;
			case 1:
				$this->setEcuSolId($value);
				break;
			case 2:
				$this->setEcuPeriodoAcademico($value);
				break;
			case 3:
				$this->setEcuAsignatura($value);
				break;
			case 4:
				$this->setEcuNumCreditos($value);
				break;
			case 5:
				$this->setEcuTotalHoras($value);
				break;
			case 6:
				$this->setEcuNumProgramaComparte($value);
				break;
			case 7:
				$this->setEcuCategoriaDocente($value);
				break;
			case 8:
				$this->setEcuHorasDictadasComo($value);
				break;
			case 9:
				$this->setEcuValorHora($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ExtructuraCurricularPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setEcuId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setEcuSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setEcuPeriodoAcademico($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setEcuAsignatura($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setEcuNumCreditos($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setEcuTotalHoras($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setEcuNumProgramaComparte($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setEcuCategoriaDocente($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setEcuHorasDictadasComo($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setEcuValorHora($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ExtructuraCurricularPeer::DATABASE_NAME);

		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_ID)) $criteria->add(ExtructuraCurricularPeer::ECU_ID, $this->ecu_id);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_SOL_ID)) $criteria->add(ExtructuraCurricularPeer::ECU_SOL_ID, $this->ecu_sol_id);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO)) $criteria->add(ExtructuraCurricularPeer::ECU_PERIODO_ACADEMICO, $this->ecu_periodo_academico);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_ASIGNATURA)) $criteria->add(ExtructuraCurricularPeer::ECU_ASIGNATURA, $this->ecu_asignatura);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_NUM_CREDITOS)) $criteria->add(ExtructuraCurricularPeer::ECU_NUM_CREDITOS, $this->ecu_num_creditos);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_TOTAL_HORAS)) $criteria->add(ExtructuraCurricularPeer::ECU_TOTAL_HORAS, $this->ecu_total_horas);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE)) $criteria->add(ExtructuraCurricularPeer::ECU_NUM_PROGRAMA_COMPARTE, $this->ecu_num_programa_comparte);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE)) $criteria->add(ExtructuraCurricularPeer::ECU_CATEGORIA_DOCENTE, $this->ecu_categoria_docente);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO)) $criteria->add(ExtructuraCurricularPeer::ECU_HORAS_DICTADAS_COMO, $this->ecu_horas_dictadas_como);
		if ($this->isColumnModified(ExtructuraCurricularPeer::ECU_VALOR_HORA)) $criteria->add(ExtructuraCurricularPeer::ECU_VALOR_HORA, $this->ecu_valor_hora);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ExtructuraCurricularPeer::DATABASE_NAME);

		$criteria->add(ExtructuraCurricularPeer::ECU_ID, $this->ecu_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getEcuId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setEcuId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setEcuSolId($this->ecu_sol_id);

		$copyObj->setEcuPeriodoAcademico($this->ecu_periodo_academico);

		$copyObj->setEcuAsignatura($this->ecu_asignatura);

		$copyObj->setEcuNumCreditos($this->ecu_num_creditos);

		$copyObj->setEcuTotalHoras($this->ecu_total_horas);

		$copyObj->setEcuNumProgramaComparte($this->ecu_num_programa_comparte);

		$copyObj->setEcuCategoriaDocente($this->ecu_categoria_docente);

		$copyObj->setEcuHorasDictadasComo($this->ecu_horas_dictadas_como);

		$copyObj->setEcuValorHora($this->ecu_valor_hora);


		$copyObj->setNew(true);

		$copyObj->setEcuId(NULL); 
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
			self::$peer = new ExtructuraCurricularPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setEcuSolId(NULL);
		} else {
			$this->setEcuSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->ecu_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->ecu_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

} 