<?php


abstract class BaseBecas extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $bec_id;


	
	protected $bec_sol_id;


	
	protected $bec_concepto;

	
	protected $aSolicitud;

	
	protected $collNumeroPeriodoBecas;

	
	protected $lastNumeroPeriodoBecaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getBecId()
	{

		return $this->bec_id;
	}

	
	public function getBecSolId()
	{

		return $this->bec_sol_id;
	}

	
	public function getBecConcepto()
	{

		return $this->bec_concepto;
	}

	
	public function setBecId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bec_id !== $v) {
			$this->bec_id = $v;
			$this->modifiedColumns[] = BecasPeer::BEC_ID;
		}

	} 
	
	public function setBecSolId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->bec_sol_id !== $v) {
			$this->bec_sol_id = $v;
			$this->modifiedColumns[] = BecasPeer::BEC_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setBecConcepto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->bec_concepto !== $v) {
			$this->bec_concepto = $v;
			$this->modifiedColumns[] = BecasPeer::BEC_CONCEPTO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->bec_id = $rs->getInt($startcol + 0);

			$this->bec_sol_id = $rs->getInt($startcol + 1);

			$this->bec_concepto = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Becas object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(BecasPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			BecasPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(BecasPeer::DATABASE_NAME);
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
					$pk = BecasPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setBecId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += BecasPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collNumeroPeriodoBecas !== null) {
				foreach($this->collNumeroPeriodoBecas as $referrerFK) {
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


			if (($retval = BecasPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collNumeroPeriodoBecas !== null) {
					foreach($this->collNumeroPeriodoBecas as $referrerFK) {
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
		$pos = BecasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getBecId();
				break;
			case 1:
				return $this->getBecSolId();
				break;
			case 2:
				return $this->getBecConcepto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BecasPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getBecId(),
			$keys[1] => $this->getBecSolId(),
			$keys[2] => $this->getBecConcepto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = BecasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setBecId($value);
				break;
			case 1:
				$this->setBecSolId($value);
				break;
			case 2:
				$this->setBecConcepto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = BecasPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setBecId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setBecSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setBecConcepto($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(BecasPeer::DATABASE_NAME);

		if ($this->isColumnModified(BecasPeer::BEC_ID)) $criteria->add(BecasPeer::BEC_ID, $this->bec_id);
		if ($this->isColumnModified(BecasPeer::BEC_SOL_ID)) $criteria->add(BecasPeer::BEC_SOL_ID, $this->bec_sol_id);
		if ($this->isColumnModified(BecasPeer::BEC_CONCEPTO)) $criteria->add(BecasPeer::BEC_CONCEPTO, $this->bec_concepto);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(BecasPeer::DATABASE_NAME);

		$criteria->add(BecasPeer::BEC_ID, $this->bec_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getBecId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setBecId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setBecSolId($this->bec_sol_id);

		$copyObj->setBecConcepto($this->bec_concepto);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getNumeroPeriodoBecas() as $relObj) {
				$copyObj->addNumeroPeriodoBeca($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setBecId(NULL); 
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
			self::$peer = new BecasPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setBecSolId(NULL);
		} else {
			$this->setBecSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->bec_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->bec_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function initNumeroPeriodoBecas()
	{
		if ($this->collNumeroPeriodoBecas === null) {
			$this->collNumeroPeriodoBecas = array();
		}
	}

	
	public function getNumeroPeriodoBecas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseNumeroPeriodoBecaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collNumeroPeriodoBecas === null) {
			if ($this->isNew()) {
			   $this->collNumeroPeriodoBecas = array();
			} else {

				$criteria->add(NumeroPeriodoBecaPeer::NUP_BEC_ID, $this->getBecId());

				NumeroPeriodoBecaPeer::addSelectColumns($criteria);
				$this->collNumeroPeriodoBecas = NumeroPeriodoBecaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(NumeroPeriodoBecaPeer::NUP_BEC_ID, $this->getBecId());

				NumeroPeriodoBecaPeer::addSelectColumns($criteria);
				if (!isset($this->lastNumeroPeriodoBecaCriteria) || !$this->lastNumeroPeriodoBecaCriteria->equals($criteria)) {
					$this->collNumeroPeriodoBecas = NumeroPeriodoBecaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastNumeroPeriodoBecaCriteria = $criteria;
		return $this->collNumeroPeriodoBecas;
	}

	
	public function countNumeroPeriodoBecas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseNumeroPeriodoBecaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(NumeroPeriodoBecaPeer::NUP_BEC_ID, $this->getBecId());

		return NumeroPeriodoBecaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addNumeroPeriodoBeca(NumeroPeriodoBeca $l)
	{
		$this->collNumeroPeriodoBecas[] = $l;
		$l->setBecas($this);
	}

} 