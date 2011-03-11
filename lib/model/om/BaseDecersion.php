<?php


abstract class BaseDecersion extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $dec_id;


	
	protected $dec_sede;


	
	protected $dec_facultad;


	
	protected $dec_tipo_progama;


	
	protected $dec_periodo;

	
	protected $aFacultad;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getDecId()
	{

		return $this->dec_id;
	}

	
	public function getDecSede()
	{

		return $this->dec_sede;
	}

	
	public function getDecFacultad()
	{

		return $this->dec_facultad;
	}

	
	public function getDecTipoProgama()
	{

		return $this->dec_tipo_progama;
	}

	
	public function getDecPeriodo()
	{

		return $this->dec_periodo;
	}

	
	public function setDecId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dec_id !== $v) {
			$this->dec_id = $v;
			$this->modifiedColumns[] = DecersionPeer::DEC_ID;
		}

	} 
	
	public function setDecSede($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dec_sede !== $v) {
			$this->dec_sede = $v;
			$this->modifiedColumns[] = DecersionPeer::DEC_SEDE;
		}

	} 
	
	public function setDecFacultad($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dec_facultad !== $v) {
			$this->dec_facultad = $v;
			$this->modifiedColumns[] = DecersionPeer::DEC_FACULTAD;
		}

		if ($this->aFacultad !== null && $this->aFacultad->getFacId() !== $v) {
			$this->aFacultad = null;
		}

	} 
	
	public function setDecTipoProgama($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->dec_tipo_progama !== $v) {
			$this->dec_tipo_progama = $v;
			$this->modifiedColumns[] = DecersionPeer::DEC_TIPO_PROGAMA;
		}

	} 
	
	public function setDecPeriodo($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->dec_periodo !== $v) {
			$this->dec_periodo = $v;
			$this->modifiedColumns[] = DecersionPeer::DEC_PERIODO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->dec_id = $rs->getInt($startcol + 0);

			$this->dec_sede = $rs->getString($startcol + 1);

			$this->dec_facultad = $rs->getInt($startcol + 2);

			$this->dec_tipo_progama = $rs->getString($startcol + 3);

			$this->dec_periodo = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Decersion object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(DecersionPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			DecersionPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(DecersionPeer::DATABASE_NAME);
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
					$pk = DecersionPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setDecId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += DecersionPeer::doUpdate($this, $con);
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


			if (($retval = DecersionPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DecersionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getDecId();
				break;
			case 1:
				return $this->getDecSede();
				break;
			case 2:
				return $this->getDecFacultad();
				break;
			case 3:
				return $this->getDecTipoProgama();
				break;
			case 4:
				return $this->getDecPeriodo();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DecersionPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getDecId(),
			$keys[1] => $this->getDecSede(),
			$keys[2] => $this->getDecFacultad(),
			$keys[3] => $this->getDecTipoProgama(),
			$keys[4] => $this->getDecPeriodo(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = DecersionPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setDecId($value);
				break;
			case 1:
				$this->setDecSede($value);
				break;
			case 2:
				$this->setDecFacultad($value);
				break;
			case 3:
				$this->setDecTipoProgama($value);
				break;
			case 4:
				$this->setDecPeriodo($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = DecersionPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setDecId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setDecSede($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setDecFacultad($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setDecTipoProgama($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setDecPeriodo($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(DecersionPeer::DATABASE_NAME);

		if ($this->isColumnModified(DecersionPeer::DEC_ID)) $criteria->add(DecersionPeer::DEC_ID, $this->dec_id);
		if ($this->isColumnModified(DecersionPeer::DEC_SEDE)) $criteria->add(DecersionPeer::DEC_SEDE, $this->dec_sede);
		if ($this->isColumnModified(DecersionPeer::DEC_FACULTAD)) $criteria->add(DecersionPeer::DEC_FACULTAD, $this->dec_facultad);
		if ($this->isColumnModified(DecersionPeer::DEC_TIPO_PROGAMA)) $criteria->add(DecersionPeer::DEC_TIPO_PROGAMA, $this->dec_tipo_progama);
		if ($this->isColumnModified(DecersionPeer::DEC_PERIODO)) $criteria->add(DecersionPeer::DEC_PERIODO, $this->dec_periodo);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(DecersionPeer::DATABASE_NAME);

		$criteria->add(DecersionPeer::DEC_ID, $this->dec_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getDecId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setDecId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setDecSede($this->dec_sede);

		$copyObj->setDecFacultad($this->dec_facultad);

		$copyObj->setDecTipoProgama($this->dec_tipo_progama);

		$copyObj->setDecPeriodo($this->dec_periodo);


		$copyObj->setNew(true);

		$copyObj->setDecId(NULL); 
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
			self::$peer = new DecersionPeer();
		}
		return self::$peer;
	}

	
	public function setFacultad($v)
	{


		if ($v === null) {
			$this->setDecFacultad(NULL);
		} else {
			$this->setDecFacultad($v->getFacId());
		}


		$this->aFacultad = $v;
	}


	
	public function getFacultad($con = null)
	{
		if ($this->aFacultad === null && ($this->dec_facultad !== null)) {
						include_once 'lib/model/om/BaseFacultadPeer.php';

			$this->aFacultad = FacultadPeer::retrieveByPK($this->dec_facultad, $con);

			
		}
		return $this->aFacultad;
	}

} 