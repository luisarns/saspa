<?php


abstract class BaseDocentes extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $cedula;


	
	protected $nombre;


	
	protected $apellidos;


	
	protected $facultad;


	
	protected $dependencia;


	
	protected $categoria;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getCedula()
	{

		return $this->cedula;
	}

	
	public function getNombre()
	{

		return $this->nombre;
	}

	
	public function getApellidos()
	{

		return $this->apellidos;
	}

	
	public function getFacultad()
	{

		return $this->facultad;
	}

	
	public function getDependencia()
	{

		return $this->dependencia;
	}

	
	public function getCategoria()
	{

		return $this->categoria;
	}

	
	public function setCedula($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->cedula !== $v) {
			$this->cedula = $v;
			$this->modifiedColumns[] = DocentesPeer::CEDULA;
		}

	} 
	
	public function setNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->nombre !== $v) {
			$this->nombre = $v;
			$this->modifiedColumns[] = DocentesPeer::NOMBRE;
		}

	} 
	
	public function setApellidos($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->apellidos !== $v) {
			$this->apellidos = $v;
			$this->modifiedColumns[] = DocentesPeer::APELLIDOS;
		}

	} 
	
	public function setFacultad($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->facultad !== $v) {
			$this->facultad = $v;
			$this->modifiedColumns[] = DocentesPeer::FACULTAD;
		}

	} 
	
	public function setDependencia($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dependencia !== $v) {
			$this->dependencia = $v;
			$this->modifiedColumns[] = DocentesPeer::DEPENDENCIA;
		}

	} 
	
	public function setCategoria($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->categoria !== $v) {
			$this->categoria = $v;
			$this->modifiedColumns[] = DocentesPeer::CATEGORIA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->cedula = $rs->getString($startcol + 0);

			$this->nombre = $rs->getString($startcol + 1);

			$this->apellidos = $rs->getString($startcol + 2);

			$this->facultad = $rs->getString($startcol + 3);

			$this->dependencia = $rs->getString($startcol + 4);

			$this->categoria = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Docentes object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DocentesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DocentesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DocentesPeer::DATABASE_NAME);
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
					$pk = DocentesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += DocentesPeer::doUpdate($this, $con);
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


			if (($retval = DocentesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DocentesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getCedula();
				break;
			case 1:
				return $this->getNombre();
				break;
			case 2:
				return $this->getApellidos();
				break;
			case 3:
				return $this->getFacultad();
				break;
			case 4:
				return $this->getDependencia();
				break;
			case 5:
				return $this->getCategoria();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocentesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getCedula(),
			$keys[1] => $this->getNombre(),
			$keys[2] => $this->getApellidos(),
			$keys[3] => $this->getFacultad(),
			$keys[4] => $this->getDependencia(),
			$keys[5] => $this->getCategoria(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DocentesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setCedula($value);
				break;
			case 1:
				$this->setNombre($value);
				break;
			case 2:
				$this->setApellidos($value);
				break;
			case 3:
				$this->setFacultad($value);
				break;
			case 4:
				$this->setDependencia($value);
				break;
			case 5:
				$this->setCategoria($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DocentesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setCedula($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setApellidos($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setFacultad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDependencia($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCategoria($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DocentesPeer::DATABASE_NAME);

		if ($this->isColumnModified(DocentesPeer::CEDULA)) $criteria->add(DocentesPeer::CEDULA, $this->cedula);
		if ($this->isColumnModified(DocentesPeer::NOMBRE)) $criteria->add(DocentesPeer::NOMBRE, $this->nombre);
		if ($this->isColumnModified(DocentesPeer::APELLIDOS)) $criteria->add(DocentesPeer::APELLIDOS, $this->apellidos);
		if ($this->isColumnModified(DocentesPeer::FACULTAD)) $criteria->add(DocentesPeer::FACULTAD, $this->facultad);
		if ($this->isColumnModified(DocentesPeer::DEPENDENCIA)) $criteria->add(DocentesPeer::DEPENDENCIA, $this->dependencia);
		if ($this->isColumnModified(DocentesPeer::CATEGORIA)) $criteria->add(DocentesPeer::CATEGORIA, $this->categoria);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DocentesPeer::DATABASE_NAME);

		$criteria->add(DocentesPeer::CEDULA, $this->cedula);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getCedula();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setCedula($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombre($this->nombre);

		$copyObj->setApellidos($this->apellidos);

		$copyObj->setFacultad($this->facultad);

		$copyObj->setDependencia($this->dependencia);

		$copyObj->setCategoria($this->categoria);


		$copyObj->setNew(true);

		$copyObj->setCedula(NULL); 
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
			self::$peer = new DocentesPeer();
		}
		return self::$peer;
	}

} 