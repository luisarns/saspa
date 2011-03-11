<?php


abstract class BaseGastosGenerales extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $igg_cog_id;


	
	protected $igg_periodo;


	
	protected $igg_costo;

	
	protected $aConceptoGastos;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIggCogId()
	{

		return $this->igg_cog_id;
	}

	
	public function getIggPeriodo()
	{

		return $this->igg_periodo;
	}

	
	public function getIggCosto()
	{

		return $this->igg_costo;
	}

	
	public function setIggCogId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->igg_cog_id !== $v) {
			$this->igg_cog_id = $v;
			$this->modifiedColumns[] = GastosGeneralesPeer::IGG_COG_ID;
		}

		if ($this->aConceptoGastos !== null && $this->aConceptoGastos->getCogId() !== $v) {
			$this->aConceptoGastos = null;
		}

	} 
	
	public function setIggPeriodo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->igg_periodo !== $v) {
			$this->igg_periodo = $v;
			$this->modifiedColumns[] = GastosGeneralesPeer::IGG_PERIODO;
		}

	} 
	
	public function setIggCosto($v)
	{

		if ($this->igg_costo !== $v) {
			$this->igg_costo = $v;
			$this->modifiedColumns[] = GastosGeneralesPeer::IGG_COSTO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->igg_cog_id = $rs->getInt($startcol + 0);

			$this->igg_periodo = $rs->getInt($startcol + 1);

			$this->igg_costo = $rs->getFloat($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating GastosGenerales object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(GastosGeneralesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			GastosGeneralesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(GastosGeneralesPeer::DATABASE_NAME);
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


												
			if ($this->aConceptoGastos !== null) {
				if ($this->aConceptoGastos->isModified()) {
					$affectedRows += $this->aConceptoGastos->save($con);
				}
				$this->setConceptoGastos($this->aConceptoGastos);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = GastosGeneralesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += GastosGeneralesPeer::doUpdate($this, $con);
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


												
			if ($this->aConceptoGastos !== null) {
				if (!$this->aConceptoGastos->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptoGastos->getValidationFailures());
				}
			}


			if (($retval = GastosGeneralesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GastosGeneralesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIggCogId();
				break;
			case 1:
				return $this->getIggPeriodo();
				break;
			case 2:
				return $this->getIggCosto();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GastosGeneralesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIggCogId(),
			$keys[1] => $this->getIggPeriodo(),
			$keys[2] => $this->getIggCosto(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = GastosGeneralesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIggCogId($value);
				break;
			case 1:
				$this->setIggPeriodo($value);
				break;
			case 2:
				$this->setIggCosto($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = GastosGeneralesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIggCogId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIggPeriodo($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIggCosto($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(GastosGeneralesPeer::DATABASE_NAME);

		if ($this->isColumnModified(GastosGeneralesPeer::IGG_COG_ID)) $criteria->add(GastosGeneralesPeer::IGG_COG_ID, $this->igg_cog_id);
		if ($this->isColumnModified(GastosGeneralesPeer::IGG_PERIODO)) $criteria->add(GastosGeneralesPeer::IGG_PERIODO, $this->igg_periodo);
		if ($this->isColumnModified(GastosGeneralesPeer::IGG_COSTO)) $criteria->add(GastosGeneralesPeer::IGG_COSTO, $this->igg_costo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(GastosGeneralesPeer::DATABASE_NAME);

		$criteria->add(GastosGeneralesPeer::IGG_COG_ID, $this->igg_cog_id);
		$criteria->add(GastosGeneralesPeer::IGG_PERIODO, $this->igg_periodo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getIggCogId();

		$pks[1] = $this->getIggPeriodo();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setIggCogId($keys[0]);

		$this->setIggPeriodo($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIggCosto($this->igg_costo);


		$copyObj->setNew(true);

		$copyObj->setIggCogId(NULL); 
		$copyObj->setIggPeriodo(NULL); 
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
			self::$peer = new GastosGeneralesPeer();
		}
		return self::$peer;
	}

	
	public function setConceptoGastos($v)
	{


		if ($v === null) {
			$this->setIggCogId(NULL);
		} else {
			$this->setIggCogId($v->getCogId());
		}


		$this->aConceptoGastos = $v;
	}


	
	public function getConceptoGastos($con = null)
	{
		if ($this->aConceptoGastos === null && ($this->igg_cog_id !== null)) {
						include_once 'lib/model/om/BaseConceptoGastosPeer.php';

			$this->aConceptoGastos = ConceptoGastosPeer::retrieveByPK($this->igg_cog_id, $con);

			
		}
		return $this->aConceptoGastos;
	}

} 