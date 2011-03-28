<?php


abstract class BaseParametros extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $par_nombre;


	
	protected $par_ano;


	
	protected $par_valor;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getParNombre()
	{

		return $this->par_nombre;
	}

	
	public function getParAno()
	{

		return $this->par_ano;
	}

	
	public function getParValor()
	{

		return $this->par_valor;
	}

	
	public function setParNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->par_nombre !== $v) {
			$this->par_nombre = $v;
			$this->modifiedColumns[] = ParametrosPeer::PAR_NOMBRE;
		}

	} 
	
	public function setParAno($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->par_ano !== $v) {
			$this->par_ano = $v;
			$this->modifiedColumns[] = ParametrosPeer::PAR_ANO;
		}

	} 
	
	public function setParValor($v)
	{

		if ($this->par_valor !== $v) {
			$this->par_valor = $v;
			$this->modifiedColumns[] = ParametrosPeer::PAR_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->par_nombre = $rs->getString($startcol + 0);

			$this->par_ano = $rs->getString($startcol + 1);

			$this->par_valor = $rs->getFloat($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Parametros object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ParametrosPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ParametrosPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ParametrosPeer::DATABASE_NAME);
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
					$pk = ParametrosPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ParametrosPeer::doUpdate($this, $con);
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


			if (($retval = ParametrosPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ParametrosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getParNombre();
				break;
			case 1:
				return $this->getParAno();
				break;
			case 2:
				return $this->getParValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ParametrosPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getParNombre(),
			$keys[1] => $this->getParAno(),
			$keys[2] => $this->getParValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ParametrosPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setParNombre($value);
				break;
			case 1:
				$this->setParAno($value);
				break;
			case 2:
				$this->setParValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ParametrosPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setParNombre($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setParAno($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setParValor($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ParametrosPeer::DATABASE_NAME);

		if ($this->isColumnModified(ParametrosPeer::PAR_NOMBRE)) $criteria->add(ParametrosPeer::PAR_NOMBRE, $this->par_nombre);
		if ($this->isColumnModified(ParametrosPeer::PAR_ANO)) $criteria->add(ParametrosPeer::PAR_ANO, $this->par_ano);
		if ($this->isColumnModified(ParametrosPeer::PAR_VALOR)) $criteria->add(ParametrosPeer::PAR_VALOR, $this->par_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ParametrosPeer::DATABASE_NAME);

		$criteria->add(ParametrosPeer::PAR_NOMBRE, $this->par_nombre);
		$criteria->add(ParametrosPeer::PAR_ANO, $this->par_ano);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getParNombre();

		$pks[1] = $this->getParAno();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setParNombre($keys[0]);

		$this->setParAno($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setParValor($this->par_valor);


		$copyObj->setNew(true);

		$copyObj->setParNombre(NULL); 
		$copyObj->setParAno(NULL); 
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
			self::$peer = new ParametrosPeer();
		}
		return self::$peer;
	}

} 