<?php


abstract class BaseValorDiferenciado extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $vad_ing_id;


	
	protected $vad_periodo;


	
	protected $vad_valor;

	
	protected $aInformacionGeneral;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getVadIngId()
	{

		return $this->vad_ing_id;
	}

	
	public function getVadPeriodo()
	{

		return $this->vad_periodo;
	}

	
	public function getVadValor()
	{

		return $this->vad_valor;
	}

	
	public function setVadIngId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vad_ing_id !== $v) {
			$this->vad_ing_id = $v;
			$this->modifiedColumns[] = ValorDiferenciadoPeer::VAD_ING_ID;
		}

		if ($this->aInformacionGeneral !== null && $this->aInformacionGeneral->getIngId() !== $v) {
			$this->aInformacionGeneral = null;
		}

	} 
	
	public function setVadPeriodo($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->vad_periodo !== $v) {
			$this->vad_periodo = $v;
			$this->modifiedColumns[] = ValorDiferenciadoPeer::VAD_PERIODO;
		}

	} 
	
	public function setVadValor($v)
	{

		if ($this->vad_valor !== $v) {
			$this->vad_valor = $v;
			$this->modifiedColumns[] = ValorDiferenciadoPeer::VAD_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->vad_ing_id = $rs->getInt($startcol + 0);

			$this->vad_periodo = $rs->getInt($startcol + 1);

			$this->vad_valor = $rs->getFloat($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ValorDiferenciado object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ValorDiferenciadoPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ValorDiferenciadoPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ValorDiferenciadoPeer::DATABASE_NAME);
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


												
			if ($this->aInformacionGeneral !== null) {
				if ($this->aInformacionGeneral->isModified()) {
					$affectedRows += $this->aInformacionGeneral->save($con);
				}
				$this->setInformacionGeneral($this->aInformacionGeneral);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = ValorDiferenciadoPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ValorDiferenciadoPeer::doUpdate($this, $con);
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


												
			if ($this->aInformacionGeneral !== null) {
				if (!$this->aInformacionGeneral->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aInformacionGeneral->getValidationFailures());
				}
			}


			if (($retval = ValorDiferenciadoPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValorDiferenciadoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getVadIngId();
				break;
			case 1:
				return $this->getVadPeriodo();
				break;
			case 2:
				return $this->getVadValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValorDiferenciadoPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getVadIngId(),
			$keys[1] => $this->getVadPeriodo(),
			$keys[2] => $this->getVadValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValorDiferenciadoPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setVadIngId($value);
				break;
			case 1:
				$this->setVadPeriodo($value);
				break;
			case 2:
				$this->setVadValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValorDiferenciadoPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVadIngId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVadPeriodo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setVadValor($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ValorDiferenciadoPeer::DATABASE_NAME);

		if ($this->isColumnModified(ValorDiferenciadoPeer::VAD_ING_ID)) $criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $this->vad_ing_id);
		if ($this->isColumnModified(ValorDiferenciadoPeer::VAD_PERIODO)) $criteria->add(ValorDiferenciadoPeer::VAD_PERIODO, $this->vad_periodo);
		if ($this->isColumnModified(ValorDiferenciadoPeer::VAD_VALOR)) $criteria->add(ValorDiferenciadoPeer::VAD_VALOR, $this->vad_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ValorDiferenciadoPeer::DATABASE_NAME);

		$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $this->vad_ing_id);
		$criteria->add(ValorDiferenciadoPeer::VAD_PERIODO, $this->vad_periodo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getVadIngId();

		$pks[1] = $this->getVadPeriodo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setVadIngId($keys[0]);

		$this->setVadPeriodo($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setVadValor($this->vad_valor);


		$copyObj->setNew(true);

		$copyObj->setVadIngId(NULL); 
		$copyObj->setVadPeriodo(NULL); 
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
			self::$peer = new ValorDiferenciadoPeer();
		}
		return self::$peer;
	}

	
	public function setInformacionGeneral($v)
	{


		if ($v === null) {
			$this->setVadIngId(NULL);
		} else {
			$this->setVadIngId($v->getIngId());
		}


		$this->aInformacionGeneral = $v;
	}


	
	public function getInformacionGeneral($con = null)
	{
		if ($this->aInformacionGeneral === null && ($this->vad_ing_id !== null)) {
						include_once 'lib/model/om/BaseInformacionGeneralPeer.php';

			$this->aInformacionGeneral = InformacionGeneralPeer::retrieveByPK($this->vad_ing_id, $con);

			
		}
		return $this->aInformacionGeneral;
	}

} 