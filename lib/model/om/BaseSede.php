<?php


abstract class BaseSede extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sed_codigo;


	
	protected $sed_tipo;


	
	protected $sed_nombre;

	
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

} 