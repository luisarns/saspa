<?php


abstract class BaseConceptoGastos extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $cog_id;


	
	protected $cog_sol_id;


	
	protected $cog_concepto;


	
	protected $cog_tipo;

	
	protected $aSolicitud;

	
	protected $collGastosGeneraless;

	
	protected $lastGastosGeneralesCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCogId()
	{

		return $this->cog_id;
	}

	
	public function getCogSolId()
	{

		return $this->cog_sol_id;
	}

	
	public function getCogConcepto()
	{

		return $this->cog_concepto;
	}

	
	public function getCogTipo()
	{

		return $this->cog_tipo;
	}

	
	public function setCogId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cog_id !== $v) {
			$this->cog_id = $v;
			$this->modifiedColumns[] = ConceptoGastosPeer::COG_ID;
		}

	} 
	
	public function setCogSolId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->cog_sol_id !== $v) {
			$this->cog_sol_id = $v;
			$this->modifiedColumns[] = ConceptoGastosPeer::COG_SOL_ID;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setCogConcepto($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cog_concepto !== $v) {
			$this->cog_concepto = $v;
			$this->modifiedColumns[] = ConceptoGastosPeer::COG_CONCEPTO;
		}

	} 
	
	public function setCogTipo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cog_tipo !== $v) {
			$this->cog_tipo = $v;
			$this->modifiedColumns[] = ConceptoGastosPeer::COG_TIPO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->cog_id = $rs->getInt($startcol + 0);

			$this->cog_sol_id = $rs->getInt($startcol + 1);

			$this->cog_concepto = $rs->getString($startcol + 2);

			$this->cog_tipo = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ConceptoGastos object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ConceptoGastosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ConceptoGastosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ConceptoGastosPeer::DATABASE_NAME);
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
					$pk = ConceptoGastosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setCogId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ConceptoGastosPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collGastosGeneraless !== null) {
				foreach($this->collGastosGeneraless as $referrerFK) {
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


			if (($retval = ConceptoGastosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collGastosGeneraless !== null) {
					foreach($this->collGastosGeneraless as $referrerFK) {
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
		$pos = ConceptoGastosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCogId();
				break;
			case 1:
				return $this->getCogSolId();
				break;
			case 2:
				return $this->getCogConcepto();
				break;
			case 3:
				return $this->getCogTipo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptoGastosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCogId(),
			$keys[1] => $this->getCogSolId(),
			$keys[2] => $this->getCogConcepto(),
			$keys[3] => $this->getCogTipo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ConceptoGastosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCogId($value);
				break;
			case 1:
				$this->setCogSolId($value);
				break;
			case 2:
				$this->setCogConcepto($value);
				break;
			case 3:
				$this->setCogTipo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ConceptoGastosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCogId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setCogSolId($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setCogConcepto($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCogTipo($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ConceptoGastosPeer::DATABASE_NAME);

		if ($this->isColumnModified(ConceptoGastosPeer::COG_ID)) $criteria->add(ConceptoGastosPeer::COG_ID, $this->cog_id);
		if ($this->isColumnModified(ConceptoGastosPeer::COG_SOL_ID)) $criteria->add(ConceptoGastosPeer::COG_SOL_ID, $this->cog_sol_id);
		if ($this->isColumnModified(ConceptoGastosPeer::COG_CONCEPTO)) $criteria->add(ConceptoGastosPeer::COG_CONCEPTO, $this->cog_concepto);
		if ($this->isColumnModified(ConceptoGastosPeer::COG_TIPO)) $criteria->add(ConceptoGastosPeer::COG_TIPO, $this->cog_tipo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ConceptoGastosPeer::DATABASE_NAME);

		$criteria->add(ConceptoGastosPeer::COG_ID, $this->cog_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCogId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCogId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setCogSolId($this->cog_sol_id);

		$copyObj->setCogConcepto($this->cog_concepto);

		$copyObj->setCogTipo($this->cog_tipo);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getGastosGeneraless() as $relObj) {
				$copyObj->addGastosGenerales($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setCogId(NULL); 
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
			self::$peer = new ConceptoGastosPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setCogSolId(NULL);
		} else {
			$this->setCogSolId($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->cog_sol_id !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->cog_sol_id, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function initGastosGeneraless()
	{
		if ($this->collGastosGeneraless === null) {
			$this->collGastosGeneraless = array();
		}
	}

	
	public function getGastosGeneraless($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseGastosGeneralesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collGastosGeneraless === null) {
			if ($this->isNew()) {
			   $this->collGastosGeneraless = array();
			} else {

				$criteria->add(GastosGeneralesPeer::IGG_COG_ID, $this->getCogId());

				GastosGeneralesPeer::addSelectColumns($criteria);
				$this->collGastosGeneraless = GastosGeneralesPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(GastosGeneralesPeer::IGG_COG_ID, $this->getCogId());

				GastosGeneralesPeer::addSelectColumns($criteria);
				if (!isset($this->lastGastosGeneralesCriteria) || !$this->lastGastosGeneralesCriteria->equals($criteria)) {
					$this->collGastosGeneraless = GastosGeneralesPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastGastosGeneralesCriteria = $criteria;
		return $this->collGastosGeneraless;
	}

	
	public function countGastosGeneraless($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseGastosGeneralesPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(GastosGeneralesPeer::IGG_COG_ID, $this->getCogId());

		return GastosGeneralesPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addGastosGenerales(GastosGenerales $l)
	{
		$this->collGastosGeneraless[] = $l;
		$l->setConceptoGastos($this);
	}

} 