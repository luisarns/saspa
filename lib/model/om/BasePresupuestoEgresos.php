<?php


abstract class BasePresupuestoEgresos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $peg_id;


	
	protected $peg_sol_id;


	
	protected $peg_hse_cord_programa;


	
	protected $peg_hse_secretaria;


	
	protected $peg_hse_aux_administrativo;


	
	protected $peg_hse_monitorias;


	
	protected $peg_sm_direccion;


	
	protected $peg_sm_coordinacion;


	
	protected $peg_sm_otro_nombre;


	
	protected $peg_sm_otro_valor;

	
	protected $aSolicitud;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPegId()
	{

		return $this->peg_id;
	}

	
	public function getPegSolId()
	{

		return $this->peg_sol_id;
	}

	
	public function getPegHseCordPrograma()
	{

		return $this->peg_hse_cord_programa;
	}

	
	public function getPegHseSecretaria()
	{

		return $this->peg_hse_secretaria;
	}

	
	public function getPegHseAuxAdministrativo()
	{

		return $this->peg_hse_aux_administrativo;
	}

	
	public function getPegHseMonitorias()
	{

		return $this->peg_hse_monitorias;
	}

	
	public function getPegSmDireccion()
	{

		return $this->peg_sm_direccion;
	}

	
	public function getPegSmCoordinacion()
	{

		return $this->peg_sm_coordinacion;
	}

	
	public function getPegSmOtroNombre()
	{

		return $this->peg_sm_otro_nombre;
	}

	
	public function getPegSmOtroValor()
	{

		return $this->peg_sm_otro_valor;
	}

	
	public function setPegId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_id !== $v) {
			$this->peg_id = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_ID;
		}

	} 
	
	public function setPegSolId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_sol_id !== $v) {
			$this->peg_sol_id = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setPegHseCordPrograma($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_hse_cord_programa !== $v) {
			$this->peg_hse_cord_programa = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA;
		}

	} 
	
	public function setPegHseSecretaria($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_hse_secretaria !== $v) {
			$this->peg_hse_secretaria = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_HSE_SECRETARIA;
		}

	} 
	
	public function setPegHseAuxAdministrativo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_hse_aux_administrativo !== $v) {
			$this->peg_hse_aux_administrativo = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO;
		}

	} 
	
	public function setPegHseMonitorias($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->peg_hse_monitorias !== $v) {
			$this->peg_hse_monitorias = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_HSE_MONITORIAS;
		}

	} 
	
	public function setPegSmDireccion($v)
	{

		if ($this->peg_sm_direccion !== $v) {
			$this->peg_sm_direccion = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_SM_DIRECCION;
		}

	} 
	
	public function setPegSmCoordinacion($v)
	{

		if ($this->peg_sm_coordinacion !== $v) {
			$this->peg_sm_coordinacion = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_SM_COORDINACION;
		}

	} 
	
	public function setPegSmOtroNombre($v)
	{

		if ($this->peg_sm_otro_nombre !== $v) {
			$this->peg_sm_otro_nombre = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE;
		}

	} 
	
	public function setPegSmOtroValor($v)
	{

		if ($this->peg_sm_otro_valor !== $v) {
			$this->peg_sm_otro_valor = $v;
			$this->modifiedColumns[] = PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->peg_id = $rs->getInt($startcol + 0);

			$this->peg_sol_id = $rs->getInt($startcol + 1);

			$this->peg_hse_cord_programa = $rs->getInt($startcol + 2);

			$this->peg_hse_secretaria = $rs->getInt($startcol + 3);

			$this->peg_hse_aux_administrativo = $rs->getInt($startcol + 4);

			$this->peg_hse_monitorias = $rs->getInt($startcol + 5);

			$this->peg_sm_direccion = $rs->getFloat($startcol + 6);

			$this->peg_sm_coordinacion = $rs->getFloat($startcol + 7);

			$this->peg_sm_otro_nombre = $rs->getFloat($startcol + 8);

			$this->peg_sm_otro_valor = $rs->getFloat($startcol + 9);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 10; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PresupuestoEgresos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PresupuestoEgresosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PresupuestoEgresosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PresupuestoEgresosPeer::DATABASE_NAME);
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
					$pk = PresupuestoEgresosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setPegId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PresupuestoEgresosPeer::doUpdate($this, $con);
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


			if (($retval = PresupuestoEgresosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PresupuestoEgresosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPegId();
				break;
			case 1:
				return $this->getPegSolId();
				break;
			case 2:
				return $this->getPegHseCordPrograma();
				break;
			case 3:
				return $this->getPegHseSecretaria();
				break;
			case 4:
				return $this->getPegHseAuxAdministrativo();
				break;
			case 5:
				return $this->getPegHseMonitorias();
				break;
			case 6:
				return $this->getPegSmDireccion();
				break;
			case 7:
				return $this->getPegSmCoordinacion();
				break;
			case 8:
				return $this->getPegSmOtroNombre();
				break;
			case 9:
				return $this->getPegSmOtroValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PresupuestoEgresosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPegId(),
			$keys[1] => $this->getPegSolId(),
			$keys[2] => $this->getPegHseCordPrograma(),
			$keys[3] => $this->getPegHseSecretaria(),
			$keys[4] => $this->getPegHseAuxAdministrativo(),
			$keys[5] => $this->getPegHseMonitorias(),
			$keys[6] => $this->getPegSmDireccion(),
			$keys[7] => $this->getPegSmCoordinacion(),
			$keys[8] => $this->getPegSmOtroNombre(),
			$keys[9] => $this->getPegSmOtroValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PresupuestoEgresosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPegId($value);
				break;
			case 1:
				$this->setPegSolId($value);
				break;
			case 2:
				$this->setPegHseCordPrograma($value);
				break;
			case 3:
				$this->setPegHseSecretaria($value);
				break;
			case 4:
				$this->setPegHseAuxAdministrativo($value);
				break;
			case 5:
				$this->setPegHseMonitorias($value);
				break;
			case 6:
				$this->setPegSmDireccion($value);
				break;
			case 7:
				$this->setPegSmCoordinacion($value);
				break;
			case 8:
				$this->setPegSmOtroNombre($value);
				break;
			case 9:
				$this->setPegSmOtroValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PresupuestoEgresosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPegId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPegSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPegHseCordPrograma($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPegHseSecretaria($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPegHseAuxAdministrativo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setPegHseMonitorias($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setPegSmDireccion($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setPegSmCoordinacion($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setPegSmOtroNombre($arr[$keys[8]]);
		if (array_key_exists($keys[9], $arr)) $this->setPegSmOtroValor($arr[$keys[9]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PresupuestoEgresosPeer::DATABASE_NAME);

		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_ID)) $criteria->add(PresupuestoEgresosPeer::PEG_ID, $this->peg_id);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_SOL_ID)) $criteria->add(PresupuestoEgresosPeer::PEG_SOL_ID, $this->peg_sol_id);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA)) $criteria->add(PresupuestoEgresosPeer::PEG_HSE_CORD_PROGRAMA, $this->peg_hse_cord_programa);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_HSE_SECRETARIA)) $criteria->add(PresupuestoEgresosPeer::PEG_HSE_SECRETARIA, $this->peg_hse_secretaria);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO)) $criteria->add(PresupuestoEgresosPeer::PEG_HSE_AUX_ADMINISTRATIVO, $this->peg_hse_aux_administrativo);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_HSE_MONITORIAS)) $criteria->add(PresupuestoEgresosPeer::PEG_HSE_MONITORIAS, $this->peg_hse_monitorias);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_SM_DIRECCION)) $criteria->add(PresupuestoEgresosPeer::PEG_SM_DIRECCION, $this->peg_sm_direccion);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_SM_COORDINACION)) $criteria->add(PresupuestoEgresosPeer::PEG_SM_COORDINACION, $this->peg_sm_coordinacion);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE)) $criteria->add(PresupuestoEgresosPeer::PEG_SM_OTRO_NOMBRE, $this->peg_sm_otro_nombre);
		if ($this->isColumnModified(PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR)) $criteria->add(PresupuestoEgresosPeer::PEG_SM_OTRO_VALOR, $this->peg_sm_otro_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PresupuestoEgresosPeer::DATABASE_NAME);

		$criteria->add(PresupuestoEgresosPeer::PEG_ID, $this->peg_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getPegId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setPegId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPegSolId($this->peg_sol_id);

		$copyObj->setPegHseCordPrograma($this->peg_hse_cord_programa);

		$copyObj->setPegHseSecretaria($this->peg_hse_secretaria);

		$copyObj->setPegHseAuxAdministrativo($this->peg_hse_aux_administrativo);

		$copyObj->setPegHseMonitorias($this->peg_hse_monitorias);

		$copyObj->setPegSmDireccion($this->peg_sm_direccion);

		$copyObj->setPegSmCoordinacion($this->peg_sm_coordinacion);

		$copyObj->setPegSmOtroNombre($this->peg_sm_otro_nombre);

		$copyObj->setPegSmOtroValor($this->peg_sm_otro_valor);


		$copyObj->setNew(true);

		$copyObj->setPegId(NULL); 
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
			self::$peer = new PresupuestoEgresosPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setPegSolId(NULL);
		} else {
			$this->setPegSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->peg_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->peg_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

} 