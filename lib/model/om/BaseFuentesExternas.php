<?php


abstract class BaseFuentesExternas extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $fue_id;


	
	protected $fue_sol_id;


	
	protected $fue_nombre;

	
	protected $aSolicitud;

	
	protected $collContribucionFuenteExternas;

	
	protected $lastContribucionFuenteExternaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getFueId()
	{

		return $this->fue_id;
	}

	
	public function getFueSolId()
	{

		return $this->fue_sol_id;
	}

	
	public function getFueNombre()
	{

		return $this->fue_nombre;
	}

	
	public function setFueId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fue_id !== $v) {
			$this->fue_id = $v;
			$this->modifiedColumns[] = FuentesExternasPeer::FUE_ID;
		}

	} 
	
	public function setFueSolId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->fue_sol_id !== $v) {
			$this->fue_sol_id = $v;
			$this->modifiedColumns[] = FuentesExternasPeer::FUE_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setFueNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->fue_nombre !== $v) {
			$this->fue_nombre = $v;
			$this->modifiedColumns[] = FuentesExternasPeer::FUE_NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->fue_id = $rs->getInt($startcol + 0);

			$this->fue_sol_id = $rs->getInt($startcol + 1);

			$this->fue_nombre = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating FuentesExternas object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(FuentesExternasPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			FuentesExternasPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(FuentesExternasPeer::DATABASE_NAME);
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
					$pk = FuentesExternasPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setFueId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += FuentesExternasPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collContribucionFuenteExternas !== null) {
				foreach($this->collContribucionFuenteExternas as $referrerFK) {
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


			if (($retval = FuentesExternasPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collContribucionFuenteExternas !== null) {
					foreach($this->collContribucionFuenteExternas as $referrerFK) {
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
		$pos = FuentesExternasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getFueId();
				break;
			case 1:
				return $this->getFueSolId();
				break;
			case 2:
				return $this->getFueNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FuentesExternasPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getFueId(),
			$keys[1] => $this->getFueSolId(),
			$keys[2] => $this->getFueNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = FuentesExternasPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setFueId($value);
				break;
			case 1:
				$this->setFueSolId($value);
				break;
			case 2:
				$this->setFueNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = FuentesExternasPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setFueId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setFueSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setFueNombre($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(FuentesExternasPeer::DATABASE_NAME);

		if ($this->isColumnModified(FuentesExternasPeer::FUE_ID)) $criteria->add(FuentesExternasPeer::FUE_ID, $this->fue_id);
		if ($this->isColumnModified(FuentesExternasPeer::FUE_SOL_ID)) $criteria->add(FuentesExternasPeer::FUE_SOL_ID, $this->fue_sol_id);
		if ($this->isColumnModified(FuentesExternasPeer::FUE_NOMBRE)) $criteria->add(FuentesExternasPeer::FUE_NOMBRE, $this->fue_nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(FuentesExternasPeer::DATABASE_NAME);

		$criteria->add(FuentesExternasPeer::FUE_ID, $this->fue_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getFueId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setFueId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setFueSolId($this->fue_sol_id);

		$copyObj->setFueNombre($this->fue_nombre);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getContribucionFuenteExternas() as $relObj) {
				$copyObj->addContribucionFuenteExterna($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setFueId(NULL); 
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
			self::$peer = new FuentesExternasPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setFueSolId(NULL);
		} else {
			$this->setFueSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->fue_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->fue_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function initContribucionFuenteExternas()
	{
		if ($this->collContribucionFuenteExternas === null) {
			$this->collContribucionFuenteExternas = array();
		}
	}

	
	public function getContribucionFuenteExternas($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseContribucionFuenteExternaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContribucionFuenteExternas === null) {
			if ($this->isNew()) {
			   $this->collContribucionFuenteExternas = array();
			} else {

				$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->getFueId());

				ContribucionFuenteExternaPeer::addSelectColumns($criteria);
				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->getFueId());

				ContribucionFuenteExternaPeer::addSelectColumns($criteria);
				if (!isset($this->lastContribucionFuenteExternaCriteria) || !$this->lastContribucionFuenteExternaCriteria->equals($criteria)) {
					$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastContribucionFuenteExternaCriteria = $criteria;
		return $this->collContribucionFuenteExternas;
	}

	
	public function countContribucionFuenteExternas($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseContribucionFuenteExternaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->getFueId());

		return ContribucionFuenteExternaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContribucionFuenteExterna(ContribucionFuenteExterna $l)
	{
		$this->collContribucionFuenteExternas[] = $l;
		$l->setFuentesExternas($this);
	}


	
	public function getContribucionFuenteExternasJoinPresupuestoIngresos($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseContribucionFuenteExternaPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collContribucionFuenteExternas === null) {
			if ($this->isNew()) {
				$this->collContribucionFuenteExternas = array();
			} else {

				$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->getFueId());

				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelectJoinPresupuestoIngresos($criteria, $con);
			}
		} else {
									
			$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $this->getFueId());

			if (!isset($this->lastContribucionFuenteExternaCriteria) || !$this->lastContribucionFuenteExternaCriteria->equals($criteria)) {
				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelectJoinPresupuestoIngresos($criteria, $con);
			}
		}
		$this->lastContribucionFuenteExternaCriteria = $criteria;

		return $this->collContribucionFuenteExternas;
	}

} 