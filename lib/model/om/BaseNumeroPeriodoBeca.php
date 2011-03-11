<?php


abstract class BaseNumeroPeriodoBeca extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $nup_bec_id;


	
	protected $nup_periodo;


	
	protected $nup_numero;

	
	protected $aBecas;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getNupBecId()
	{

		return $this->nup_bec_id;
	}

	
	public function getNupPeriodo()
	{

		return $this->nup_periodo;
	}

	
	public function getNupNumero()
	{

		return $this->nup_numero;
	}

	
	public function setNupBecId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nup_bec_id !== $v) {
			$this->nup_bec_id = $v;
			$this->modifiedColumns[] = NumeroPeriodoBecaPeer::NUP_BEC_ID;
		}

		if ($this->aBecas !== null && $this->aBecas->getBecId() !== $v) {
			$this->aBecas = null;
		}

	} 
	
	public function setNupPeriodo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nup_periodo !== $v) {
			$this->nup_periodo = $v;
			$this->modifiedColumns[] = NumeroPeriodoBecaPeer::NUP_PERIODO;
		}

	} 
	
	public function setNupNumero($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->nup_numero !== $v) {
			$this->nup_numero = $v;
			$this->modifiedColumns[] = NumeroPeriodoBecaPeer::NUP_NUMERO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->nup_bec_id = $rs->getInt($startcol + 0);

			$this->nup_periodo = $rs->getInt($startcol + 1);

			$this->nup_numero = $rs->getInt($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating NumeroPeriodoBeca object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(NumeroPeriodoBecaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			NumeroPeriodoBecaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(NumeroPeriodoBecaPeer::DATABASE_NAME);
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


												
			if ($this->aBecas !== null) {
				if ($this->aBecas->isModified()) {
					$affectedRows += $this->aBecas->save($con);
				}
				$this->setBecas($this->aBecas);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = NumeroPeriodoBecaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += NumeroPeriodoBecaPeer::doUpdate($this, $con);
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


												
			if ($this->aBecas !== null) {
				if (!$this->aBecas->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aBecas->getValidationFailures());
				}
			}


			if (($retval = NumeroPeriodoBecaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NumeroPeriodoBecaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getNupBecId();
				break;
			case 1:
				return $this->getNupPeriodo();
				break;
			case 2:
				return $this->getNupNumero();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NumeroPeriodoBecaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getNupBecId(),
			$keys[1] => $this->getNupPeriodo(),
			$keys[2] => $this->getNupNumero(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = NumeroPeriodoBecaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setNupBecId($value);
				break;
			case 1:
				$this->setNupPeriodo($value);
				break;
			case 2:
				$this->setNupNumero($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = NumeroPeriodoBecaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setNupBecId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNupPeriodo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNupNumero($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(NumeroPeriodoBecaPeer::DATABASE_NAME);

		if ($this->isColumnModified(NumeroPeriodoBecaPeer::NUP_BEC_ID)) $criteria->add(NumeroPeriodoBecaPeer::NUP_BEC_ID, $this->nup_bec_id);
		if ($this->isColumnModified(NumeroPeriodoBecaPeer::NUP_PERIODO)) $criteria->add(NumeroPeriodoBecaPeer::NUP_PERIODO, $this->nup_periodo);
		if ($this->isColumnModified(NumeroPeriodoBecaPeer::NUP_NUMERO)) $criteria->add(NumeroPeriodoBecaPeer::NUP_NUMERO, $this->nup_numero);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(NumeroPeriodoBecaPeer::DATABASE_NAME);

		$criteria->add(NumeroPeriodoBecaPeer::NUP_BEC_ID, $this->nup_bec_id);
		$criteria->add(NumeroPeriodoBecaPeer::NUP_PERIODO, $this->nup_periodo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getNupBecId();

		$pks[1] = $this->getNupPeriodo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setNupBecId($keys[0]);

		$this->setNupPeriodo($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNupNumero($this->nup_numero);


		$copyObj->setNew(true);

		$copyObj->setNupBecId(NULL); 
		$copyObj->setNupPeriodo(NULL); 
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
			self::$peer = new NumeroPeriodoBecaPeer();
		}
		return self::$peer;
	}

	
	public function setBecas($v)
	{


		if ($v === null) {
			$this->setNupBecId(NULL);
		} else {
			$this->setNupBecId($v->getBecId());
		}


		$this->aBecas = $v;
	}


	
	public function getBecas($con = null)
	{
		if ($this->aBecas === null && ($this->nup_bec_id !== null)) {
						include_once 'lib/model/om/BaseBecasPeer.php';

			$this->aBecas = BecasPeer::retrieveByPK($this->nup_bec_id, $con);

			
		}
		return $this->aBecas;
	}

} 