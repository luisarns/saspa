<?php


abstract class BaseFacultad extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $fac_id;


	
	protected $fac_nombre;

	
	protected $collDependencias;

	
	protected $lastDependenciaCriteria = null;

	
	protected $collDecersions;

	
	protected $lastDecersionCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getFacId()
	{

		return $this->fac_id;
	}

	
	public function getFacNombre()
	{

		return $this->fac_nombre;
	}

	
	public function setFacId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fac_id !== $v) {
			$this->fac_id = $v;
			$this->modifiedColumns[] = FacultadPeer::FAC_ID;
		}

	} 
	
	public function setFacNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fac_nombre !== $v) {
			$this->fac_nombre = $v;
			$this->modifiedColumns[] = FacultadPeer::FAC_NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->fac_id = $rs->getInt($startcol + 0);

			$this->fac_nombre = $rs->getString($startcol + 1);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 2; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Facultad object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FacultadPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FacultadPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FacultadPeer::DATABASE_NAME);
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


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = FacultadPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setFacId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FacultadPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDependencias !== null) {
				foreach($this->collDependencias as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collDecersions !== null) {
				foreach($this->collDecersions as $referrerFK) {
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


			if (($retval = FacultadPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDependencias !== null) {
					foreach($this->collDependencias as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collDecersions !== null) {
					foreach($this->collDecersions as $referrerFK) {
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
		$pos = FacultadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getFacId();
				break;
			case 1:
				return $this->getFacNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FacultadPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFacId(),
			$keys[1] => $this->getFacNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FacultadPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setFacId($value);
				break;
			case 1:
				$this->setFacNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FacultadPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFacId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFacNombre($arr[$keys[1]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FacultadPeer::DATABASE_NAME);

		if ($this->isColumnModified(FacultadPeer::FAC_ID)) $criteria->add(FacultadPeer::FAC_ID, $this->fac_id);
		if ($this->isColumnModified(FacultadPeer::FAC_NOMBRE)) $criteria->add(FacultadPeer::FAC_NOMBRE, $this->fac_nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FacultadPeer::DATABASE_NAME);

		$criteria->add(FacultadPeer::FAC_ID, $this->fac_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getFacId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setFacId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFacNombre($this->fac_nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDependencias() as $relObj) {
				$copyObj->addDependencia($relObj->copy($deepCopy));
			}

			foreach($this->getDecersions() as $relObj) {
				$copyObj->addDecersion($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setFacId(NULL); 
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
			self::$peer = new FacultadPeer();
		}
		return self::$peer;
	}

	
	public function initDependencias()
	{
		if ($this->collDependencias === null) {
			$this->collDependencias = array();
		}
	}

	
	public function getDependencias($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDependenciaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDependencias === null) {
			if ($this->isNew()) {
			   $this->collDependencias = array();
			} else {

				$criteria->add(DependenciaPeer::DEP_FACULTAD, $this->getFacId());

				DependenciaPeer::addSelectColumns($criteria);
				$this->collDependencias = DependenciaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DependenciaPeer::DEP_FACULTAD, $this->getFacId());

				DependenciaPeer::addSelectColumns($criteria);
				if (!isset($this->lastDependenciaCriteria) || !$this->lastDependenciaCriteria->equals($criteria)) {
					$this->collDependencias = DependenciaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDependenciaCriteria = $criteria;
		return $this->collDependencias;
	}

	
	public function countDependencias($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDependenciaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DependenciaPeer::DEP_FACULTAD, $this->getFacId());

		return DependenciaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDependencia(Dependencia $l)
	{
		$this->collDependencias[] = $l;
		$l->setFacultad($this);
	}

	
	public function initDecersions()
	{
		if ($this->collDecersions === null) {
			$this->collDecersions = array();
		}
	}

	
	public function getDecersions($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseDecersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collDecersions === null) {
			if ($this->isNew()) {
			   $this->collDecersions = array();
			} else {

				$criteria->add(DecersionPeer::DEC_FACULTAD, $this->getFacId());

				DecersionPeer::addSelectColumns($criteria);
				$this->collDecersions = DecersionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DecersionPeer::DEC_FACULTAD, $this->getFacId());

				DecersionPeer::addSelectColumns($criteria);
				if (!isset($this->lastDecersionCriteria) || !$this->lastDecersionCriteria->equals($criteria)) {
					$this->collDecersions = DecersionPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastDecersionCriteria = $criteria;
		return $this->collDecersions;
	}

	
	public function countDecersions($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseDecersionPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(DecersionPeer::DEC_FACULTAD, $this->getFacId());

		return DecersionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDecersion(Decersion $l)
	{
		$this->collDecersions[] = $l;
		$l->setFacultad($this);
	}

} 