<?php


abstract class BaseSede extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sed_codigo;


	
	protected $sed_tipo;


	
	protected $sed_nombre;

	
	protected $collDecersions;

	
	protected $lastDecersionCriteria = null;

	
	protected $collMatriculas;

	
	protected $lastMatriculaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSedCodigo()
	{

		return $this->sed_codigo;
	}

	
	public function getSedTipo()
	{

		return $this->sed_tipo;
	}

	
	public function getSedNombre()
	{

		return $this->sed_nombre;
	}

	
	public function setSedCodigo($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sed_codigo !== $v) {
			$this->sed_codigo = $v;
			$this->modifiedColumns[] = SedePeer::SED_CODIGO;
		}

	} 
	
	public function setSedTipo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sed_tipo !== $v) {
			$this->sed_tipo = $v;
			$this->modifiedColumns[] = SedePeer::SED_TIPO;
		}

	} 
	
	public function setSedNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sed_nombre !== $v) {
			$this->sed_nombre = $v;
			$this->modifiedColumns[] = SedePeer::SED_NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sed_codigo = $rs->getInt($startcol + 0);

			$this->sed_tipo = $rs->getString($startcol + 1);

			$this->sed_nombre = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Sede object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SedePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SedePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(SedePeer::DATABASE_NAME);
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
					$pk = SedePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setSedCodigo($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SedePeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collDecersions !== null) {
				foreach($this->collDecersions as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collMatriculas !== null) {
				foreach($this->collMatriculas as $referrerFK) {
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


			if (($retval = SedePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collDecersions !== null) {
					foreach($this->collDecersions as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collMatriculas !== null) {
					foreach($this->collMatriculas as $referrerFK) {
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
		$pos = SedePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSedCodigo();
				break;
			case 1:
				return $this->getSedTipo();
				break;
			case 2:
				return $this->getSedNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SedePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSedCodigo(),
			$keys[1] => $this->getSedTipo(),
			$keys[2] => $this->getSedNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SedePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSedCodigo($value);
				break;
			case 1:
				$this->setSedTipo($value);
				break;
			case 2:
				$this->setSedNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SedePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSedCodigo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSedTipo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSedNombre($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SedePeer::DATABASE_NAME);

		if ($this->isColumnModified(SedePeer::SED_CODIGO)) $criteria->add(SedePeer::SED_CODIGO, $this->sed_codigo);
		if ($this->isColumnModified(SedePeer::SED_TIPO)) $criteria->add(SedePeer::SED_TIPO, $this->sed_tipo);
		if ($this->isColumnModified(SedePeer::SED_NOMBRE)) $criteria->add(SedePeer::SED_NOMBRE, $this->sed_nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SedePeer::DATABASE_NAME);

		$criteria->add(SedePeer::SED_CODIGO, $this->sed_codigo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getSedCodigo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setSedCodigo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSedTipo($this->sed_tipo);

		$copyObj->setSedNombre($this->sed_nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getDecersions() as $relObj) {
				$copyObj->addDecersion($relObj->copy($deepCopy));
			}

			foreach($this->getMatriculas() as $relObj) {
				$copyObj->addMatricula($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setSedCodigo(NULL); 
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
			self::$peer = new SedePeer();
		}
		return self::$peer;
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

				$criteria->add(DecersionPeer::DEC_SEDE, $this->getSedCodigo());

				DecersionPeer::addSelectColumns($criteria);
				$this->collDecersions = DecersionPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(DecersionPeer::DEC_SEDE, $this->getSedCodigo());

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

		$criteria->add(DecersionPeer::DEC_SEDE, $this->getSedCodigo());

		return DecersionPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addDecersion(Decersion $l)
	{
		$this->collDecersions[] = $l;
		$l->setSede($this);
	}


	
	public function getDecersionsJoinFacultad($criteria = null, $con = null)
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

				$criteria->add(DecersionPeer::DEC_SEDE, $this->getSedCodigo());

				$this->collDecersions = DecersionPeer::doSelectJoinFacultad($criteria, $con);
			}
		} else {
									
			$criteria->add(DecersionPeer::DEC_SEDE, $this->getSedCodigo());

			if (!isset($this->lastDecersionCriteria) || !$this->lastDecersionCriteria->equals($criteria)) {
				$this->collDecersions = DecersionPeer::doSelectJoinFacultad($criteria, $con);
			}
		}
		$this->lastDecersionCriteria = $criteria;

		return $this->collDecersions;
	}

	
	public function initMatriculas()
	{
		if ($this->collMatriculas === null) {
			$this->collMatriculas = array();
		}
	}

	
	public function getMatriculas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMatriculaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMatriculas === null) {
			if ($this->isNew()) {
			   $this->collMatriculas = array();
			} else {

				$criteria->add(MatriculaPeer::MAT_SEDE, $this->getSedCodigo());

				MatriculaPeer::addSelectColumns($criteria);
				$this->collMatriculas = MatriculaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(MatriculaPeer::MAT_SEDE, $this->getSedCodigo());

				MatriculaPeer::addSelectColumns($criteria);
				if (!isset($this->lastMatriculaCriteria) || !$this->lastMatriculaCriteria->equals($criteria)) {
					$this->collMatriculas = MatriculaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastMatriculaCriteria = $criteria;
		return $this->collMatriculas;
	}

	
	public function countMatriculas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseMatriculaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(MatriculaPeer::MAT_SEDE, $this->getSedCodigo());

		return MatriculaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addMatricula(Matricula $l)
	{
		$this->collMatriculas[] = $l;
		$l->setSede($this);
	}


	
	public function getMatriculasJoinFacultad($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseMatriculaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collMatriculas === null) {
			if ($this->isNew()) {
				$this->collMatriculas = array();
			} else {

				$criteria->add(MatriculaPeer::MAT_SEDE, $this->getSedCodigo());

				$this->collMatriculas = MatriculaPeer::doSelectJoinFacultad($criteria, $con);
			}
		} else {
									
			$criteria->add(MatriculaPeer::MAT_SEDE, $this->getSedCodigo());

			if (!isset($this->lastMatriculaCriteria) || !$this->lastMatriculaCriteria->equals($criteria)) {
				$this->collMatriculas = MatriculaPeer::doSelectJoinFacultad($criteria, $con);
			}
		}
		$this->lastMatriculaCriteria = $criteria;

		return $this->collMatriculas;
	}

} 