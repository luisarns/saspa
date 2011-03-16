<?php


abstract class BasePresupuestoIngresos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $pin_id;


	
	protected $pin_sol_id;


	
	protected $pin_numero_inscritos;


	
	protected $pin_numero_matriculados;


	
	protected $pin_exenciones;

	
	protected $aSolicitud;

	
	protected $collContribucionFuenteExternas;

	
	protected $lastContribucionFuenteExternaCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getPinId()
	{

		return $this->pin_id;
	}

	
	public function getPinSolId()
	{

		return $this->pin_sol_id;
	}

	
	public function getPinNumeroInscritos()
	{

		return $this->pin_numero_inscritos;
	}

	
	public function getPinNumeroMatriculados()
	{

		return $this->pin_numero_matriculados;
	}

	
	public function getPinExenciones()
	{

		return $this->pin_exenciones;
	}

	
	public function setPinId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pin_id !== $v) {
			$this->pin_id = $v;
			$this->modifiedColumns[] = PresupuestoIngresosPeer::PIN_ID;
		}

	} 
	
	public function setPinSolId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pin_sol_id !== $v) {
			$this->pin_sol_id = $v;
			$this->modifiedColumns[] = PresupuestoIngresosPeer::PIN_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setPinNumeroInscritos($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pin_numero_inscritos !== $v) {
			$this->pin_numero_inscritos = $v;
			$this->modifiedColumns[] = PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS;
		}

	} 
	
	public function setPinNumeroMatriculados($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pin_numero_matriculados !== $v) {
			$this->pin_numero_matriculados = $v;
			$this->modifiedColumns[] = PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS;
		}

	} 
	
	public function setPinExenciones($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->pin_exenciones !== $v) {
			$this->pin_exenciones = $v;
			$this->modifiedColumns[] = PresupuestoIngresosPeer::PIN_EXENCIONES;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->pin_id = $rs->getInt($startcol + 0);

			$this->pin_sol_id = $rs->getInt($startcol + 1);

			$this->pin_numero_inscritos = $rs->getInt($startcol + 2);

			$this->pin_numero_matriculados = $rs->getInt($startcol + 3);

			$this->pin_exenciones = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating PresupuestoIngresos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(PresupuestoIngresosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			PresupuestoIngresosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(PresupuestoIngresosPeer::DATABASE_NAME);
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
					$pk = PresupuestoIngresosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setPinId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += PresupuestoIngresosPeer::doUpdate($this, $con);
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


			if (($retval = PresupuestoIngresosPeer::doValidate($this, $columns)) !== true) {
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
		$pos = PresupuestoIngresosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getPinId();
				break;
			case 1:
				return $this->getPinSolId();
				break;
			case 2:
				return $this->getPinNumeroInscritos();
				break;
			case 3:
				return $this->getPinNumeroMatriculados();
				break;
			case 4:
				return $this->getPinExenciones();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PresupuestoIngresosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getPinId(),
			$keys[1] => $this->getPinSolId(),
			$keys[2] => $this->getPinNumeroInscritos(),
			$keys[3] => $this->getPinNumeroMatriculados(),
			$keys[4] => $this->getPinExenciones(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = PresupuestoIngresosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setPinId($value);
				break;
			case 1:
				$this->setPinSolId($value);
				break;
			case 2:
				$this->setPinNumeroInscritos($value);
				break;
			case 3:
				$this->setPinNumeroMatriculados($value);
				break;
			case 4:
				$this->setPinExenciones($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = PresupuestoIngresosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setPinId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setPinSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setPinNumeroInscritos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setPinNumeroMatriculados($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setPinExenciones($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(PresupuestoIngresosPeer::DATABASE_NAME);

		if ($this->isColumnModified(PresupuestoIngresosPeer::PIN_ID)) $criteria->add(PresupuestoIngresosPeer::PIN_ID, $this->pin_id);
		if ($this->isColumnModified(PresupuestoIngresosPeer::PIN_SOL_ID)) $criteria->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->pin_sol_id);
		if ($this->isColumnModified(PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS)) $criteria->add(PresupuestoIngresosPeer::PIN_NUMERO_INSCRITOS, $this->pin_numero_inscritos);
		if ($this->isColumnModified(PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS)) $criteria->add(PresupuestoIngresosPeer::PIN_NUMERO_MATRICULADOS, $this->pin_numero_matriculados);
		if ($this->isColumnModified(PresupuestoIngresosPeer::PIN_EXENCIONES)) $criteria->add(PresupuestoIngresosPeer::PIN_EXENCIONES, $this->pin_exenciones);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(PresupuestoIngresosPeer::DATABASE_NAME);

		$criteria->add(PresupuestoIngresosPeer::PIN_ID, $this->pin_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getPinId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setPinId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setPinSolId($this->pin_sol_id);

		$copyObj->setPinNumeroInscritos($this->pin_numero_inscritos);

		$copyObj->setPinNumeroMatriculados($this->pin_numero_matriculados);

		$copyObj->setPinExenciones($this->pin_exenciones);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getContribucionFuenteExternas() as $relObj) {
				$copyObj->addContribucionFuenteExterna($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setPinId(NULL); 
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
			self::$peer = new PresupuestoIngresosPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setPinSolId(NULL);
		} else {
			$this->setPinSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->pin_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->pin_sol_id, $con);

			
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

				$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->getPinId());

				ContribucionFuenteExternaPeer::addSelectColumns($criteria);
				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->getPinId());

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

		$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->getPinId());

		return ContribucionFuenteExternaPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addContribucionFuenteExterna(ContribucionFuenteExterna $l)
	{
		$this->collContribucionFuenteExternas[] = $l;
		$l->setPresupuestoIngresos($this);
	}


	
	public function getContribucionFuenteExternasJoinFuentesExternas($criteria = null, $con = null)
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

				$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->getPinId());

				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelectJoinFuentesExternas($criteria, $con);
			}
		} else {
									
			$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $this->getPinId());

			if (!isset($this->lastContribucionFuenteExternaCriteria) || !$this->lastContribucionFuenteExternaCriteria->equals($criteria)) {
				$this->collContribucionFuenteExternas = ContribucionFuenteExternaPeer::doSelectJoinFuentesExternas($criteria, $con);
			}
		}
		$this->lastContribucionFuenteExternaCriteria = $criteria;

		return $this->collContribucionFuenteExternas;
	}

} 