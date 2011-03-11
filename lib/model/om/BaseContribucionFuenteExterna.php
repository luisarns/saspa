<?php


abstract class BaseContribucionFuenteExterna extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $cfe_pin_id;


	
	protected $cfe_fue_id;


	
	protected $cfe_periodo;


	
	protected $cfe_valor;

	
	protected $aPresupuestoIngresos;

	
	protected $aFuentesExternas;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCfePinId()
	{

		return $this->cfe_pin_id;
	}

	
	public function getCfeFueId()
	{

		return $this->cfe_fue_id;
	}

	
	public function getCfePeriodo()
	{

		return $this->cfe_periodo;
	}

	
	public function getCfeValor()
	{

		return $this->cfe_valor;
	}

	
	public function setCfePinId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cfe_pin_id !== $v) {
			$this->cfe_pin_id = $v;
			$this->modifiedColumns[] = ContribucionFuenteExternaPeer::CFE_PIN_ID;
		}

		if ($this->aPresupuestoIngresos !== null && $this->aPresupuestoIngresos->getPinId() !== $v) {
			$this->aPresupuestoIngresos = null;
		}

	} 
	
	public function setCfeFueId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cfe_fue_id !== $v) {
			$this->cfe_fue_id = $v;
			$this->modifiedColumns[] = ContribucionFuenteExternaPeer::CFE_FUE_ID;
		}

		if ($this->aFuentesExternas !== null && $this->aFuentesExternas->getFueId() !== $v) {
			$this->aFuentesExternas = null;
		}

	} 
	
	public function setCfePeriodo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cfe_periodo !== $v) {
			$this->cfe_periodo = $v;
			$this->modifiedColumns[] = ContribucionFuenteExternaPeer::CFE_PERIODO;
		}

	} 
	
	public function setCfeValor($v)
	{

		if ($this->cfe_valor !== $v) {
			$this->cfe_valor = $v;
			$this->modifiedColumns[] = ContribucionFuenteExternaPeer::CFE_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->cfe_pin_id = $rs->getInt($startcol + 0);

			$this->cfe_fue_id = $rs->getInt($startcol + 1);

			$this->cfe_periodo = $rs->getInt($startcol + 2);

			$this->cfe_valor = $rs->getFloat($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ContribucionFuenteExterna object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ContribucionFuenteExternaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ContribucionFuenteExternaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ContribucionFuenteExternaPeer::DATABASE_NAME);
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


												
			if ($this->aPresupuestoIngresos !== null) {
				if ($this->aPresupuestoIngresos->isModified()) {
					$affectedRows += $this->aPresupuestoIngresos->save($con);
				}
				$this->setPresupuestoIngresos($this->aPresupuestoIngresos);
			}

			if ($this->aFuentesExternas !== null) {
				if ($this->aFuentesExternas->isModified()) {
					$affectedRows += $this->aFuentesExternas->save($con);
				}
				$this->setFuentesExternas($this->aFuentesExternas);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ContribucionFuenteExternaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ContribucionFuenteExternaPeer::doUpdate($this, $con);
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


												
			if ($this->aPresupuestoIngresos !== null) {
				if (!$this->aPresupuestoIngresos->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPresupuestoIngresos->getValidationFailures());
				}
			}

			if ($this->aFuentesExternas !== null) {
				if (!$this->aFuentesExternas->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFuentesExternas->getValidationFailures());
				}
			}


			if (($retval = ContribucionFuenteExternaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContribucionFuenteExternaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCfePinId();
				break;
			case 1:
				return $this->getCfeFueId();
				break;
			case 2:
				return $this->getCfePeriodo();
				break;
			case 3:
				return $this->getCfeValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContribucionFuenteExternaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCfePinId(),
			$keys[1] => $this->getCfeFueId(),
			$keys[2] => $this->getCfePeriodo(),
			$keys[3] => $this->getCfeValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ContribucionFuenteExternaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCfePinId($value);
				break;
			case 1:
				$this->setCfeFueId($value);
				break;
			case 2:
				$this->setCfePeriodo($value);
				break;
			case 3:
				$this->setCfeValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ContribucionFuenteExternaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCfePinId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCfeFueId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCfePeriodo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCfeValor($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ContribucionFuenteExternaPeer::DATABASE_NAME);

		if ($this->isColumnModified(ContribucionFuenteExternaPeer::CFE_PIN_ID)) $criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->cfe_pin_id);
		if ($this->isColumnModified(ContribucionFuenteExternaPeer::CFE_FUE_ID)) $criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->cfe_fue_id);
		if ($this->isColumnModified(ContribucionFuenteExternaPeer::CFE_PERIODO)) $criteria->add(ContribucionFuenteExternaPeer::CFE_PERIODO, $this->cfe_periodo);
		if ($this->isColumnModified(ContribucionFuenteExternaPeer::CFE_VALOR)) $criteria->add(ContribucionFuenteExternaPeer::CFE_VALOR, $this->cfe_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ContribucionFuenteExternaPeer::DATABASE_NAME);

		$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->cfe_pin_id);
		$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->cfe_fue_id);
		$criteria->add(ContribucionFuenteExternaPeer::CFE_PERIODO, $this->cfe_periodo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getCfePinId();

		$pks[1] = $this->getCfeFueId();

		$pks[2] = $this->getCfePeriodo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setCfePinId($keys[0]);

		$this->setCfeFueId($keys[1]);

		$this->setCfePeriodo($keys[2]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCfeValor($this->cfe_valor);


		$copyObj->setNew(true);

		$copyObj->setCfePinId(NULL); 
		$copyObj->setCfeFueId(NULL); 
		$copyObj->setCfePeriodo(NULL); 
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
			self::$peer = new ContribucionFuenteExternaPeer();
		}
		return self::$peer;
	}

	
	public function setPresupuestoIngresos($v)
	{


		if ($v === null) {
			$this->setCfePinId(NULL);
		} else {
			$this->setCfePinId($v->getPinId());
		}


		$this->aPresupuestoIngresos = $v;
	}


	
	public function getPresupuestoIngresos($con = null)
	{
		if ($this->aPresupuestoIngresos === null && ($this->cfe_pin_id !== null)) {
						include_once 'lib/model/om/BasePresupuestoIngresosPeer.php';

			$this->aPresupuestoIngresos = PresupuestoIngresosPeer::retrieveByPK($this->cfe_pin_id, $con);

			
		}
		return $this->aPresupuestoIngresos;
	}

	
	public function setFuentesExternas($v)
	{


		if ($v === null) {
			$this->setCfeFueId(NULL);
		} else {
			$this->setCfeFueId($v->getFueId());
		}


		$this->aFuentesExternas = $v;
	}


	
	public function getFuentesExternas($con = null)
	{
		if ($this->aFuentesExternas === null && ($this->cfe_fue_id !== null)) {
						include_once 'lib/model/om/BaseFuentesExternasPeer.php';

			$this->aFuentesExternas = FuentesExternasPeer::retrieveByPK($this->cfe_fue_id, $con);

			
		}
		return $this->aFuentesExternas;
	}

} 