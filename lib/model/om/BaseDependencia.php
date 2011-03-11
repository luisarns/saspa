<?php


abstract class BaseDependencia extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $dep_codigo;


	
	protected $dep_facultad;


	
	protected $dep_nombre;

	
	protected $aFacultad;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDepCodigo()
	{

		return $this->dep_codigo;
	}

	
	public function getDepFacultad()
	{

		return $this->dep_facultad;
	}

	
	public function getDepNombre()
	{

		return $this->dep_nombre;
	}

	
	public function setDepCodigo($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dep_codigo !== $v) {
			$this->dep_codigo = $v;
			$this->modifiedColumns[] = DependenciaPeer::DEP_CODIGO;
		}

	} 
	
	public function setDepFacultad($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dep_facultad !== $v) {
			$this->dep_facultad = $v;
			$this->modifiedColumns[] = DependenciaPeer::DEP_FACULTAD;
		}

		if ($this->aFacultad !== null && $this->aFacultad->getFacId() !== $v) {
			$this->aFacultad = null;
		}

	} 
	
	public function setDepNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dep_nombre !== $v) {
			$this->dep_nombre = $v;
			$this->modifiedColumns[] = DependenciaPeer::DEP_NOMBRE;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->dep_codigo = $rs->getString($startcol + 0);

			$this->dep_facultad = $rs->getInt($startcol + 1);

			$this->dep_nombre = $rs->getString($startcol + 2);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 3; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Dependencia object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DependenciaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DependenciaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DependenciaPeer::DATABASE_NAME);
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


												
			if ($this->aFacultad !== null) {
				if ($this->aFacultad->isModified()) {
					$affectedRows += $this->aFacultad->save($con);
				}
				$this->setFacultad($this->aFacultad);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = DependenciaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += DependenciaPeer::doUpdate($this, $con);
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


												
			if ($this->aFacultad !== null) {
				if (!$this->aFacultad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFacultad->getValidationFailures());
				}
			}


			if (($retval = DependenciaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DependenciaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDepCodigo();
				break;
			case 1:
				return $this->getDepFacultad();
				break;
			case 2:
				return $this->getDepNombre();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DependenciaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDepCodigo(),
			$keys[1] => $this->getDepFacultad(),
			$keys[2] => $this->getDepNombre(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DependenciaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDepCodigo($value);
				break;
			case 1:
				$this->setDepFacultad($value);
				break;
			case 2:
				$this->setDepNombre($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DependenciaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDepCodigo($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDepFacultad($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDepNombre($arr[$keys[2]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DependenciaPeer::DATABASE_NAME);

		if ($this->isColumnModified(DependenciaPeer::DEP_CODIGO)) $criteria->add(DependenciaPeer::DEP_CODIGO, $this->dep_codigo);
		if ($this->isColumnModified(DependenciaPeer::DEP_FACULTAD)) $criteria->add(DependenciaPeer::DEP_FACULTAD, $this->dep_facultad);
		if ($this->isColumnModified(DependenciaPeer::DEP_NOMBRE)) $criteria->add(DependenciaPeer::DEP_NOMBRE, $this->dep_nombre);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DependenciaPeer::DATABASE_NAME);

		$criteria->add(DependenciaPeer::DEP_CODIGO, $this->dep_codigo);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getDepCodigo();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setDepCodigo($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDepFacultad($this->dep_facultad);

		$copyObj->setDepNombre($this->dep_nombre);


		$copyObj->setNew(true);

		$copyObj->setDepCodigo(NULL); 
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
			self::$peer = new DependenciaPeer();
		}
		return self::$peer;
	}

	
	public function setFacultad($v)
	{


		if ($v === null) {
			$this->setDepFacultad(NULL);
		} else {
			$this->setDepFacultad($v->getFacId());
		}


		$this->aFacultad = $v;
	}


	
	public function getFacultad($con = null)
	{
		if ($this->aFacultad === null && ($this->dep_facultad !== null)) {
						include_once 'lib/model/om/BaseFacultadPeer.php';

			$this->aFacultad = FacultadPeer::retrieveByPK($this->dep_facultad, $con);

			
		}
		return $this->aFacultad;
	}

} 