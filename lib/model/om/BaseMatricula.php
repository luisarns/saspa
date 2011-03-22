<?php


abstract class BaseMatricula extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $mat_id;


	
	protected $mat_ano;


	
	protected $mat_sede;


	
	protected $mat_facultad;


	
	protected $mat_valor;

	
	protected $aSede;

	
	protected $aFacultad;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getMatId()
	{

		return $this->mat_id;
	}

	
	public function getMatAno()
	{

		return $this->mat_ano;
	}

	
	public function getMatSede()
	{

		return $this->mat_sede;
	}

	
	public function getMatFacultad()
	{

		return $this->mat_facultad;
	}

	
	public function getMatValor()
	{

		return $this->mat_valor;
	}

	
	public function setMatId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mat_id !== $v) {
			$this->mat_id = $v;
			$this->modifiedColumns[] = MatriculaPeer::MAT_ID;
		}

	} 
	
	public function setMatAno($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->mat_ano !== $v) {
			$this->mat_ano = $v;
			$this->modifiedColumns[] = MatriculaPeer::MAT_ANO;
		}

	} 
	
	public function setMatSede($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mat_sede !== $v) {
			$this->mat_sede = $v;
			$this->modifiedColumns[] = MatriculaPeer::MAT_SEDE;
		}

		if ($this->aSede !== null && $this->aSede->getSedCodigo() !== $v) {
			$this->aSede = null;
		}

	} 
	
	public function setMatFacultad($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->mat_facultad !== $v) {
			$this->mat_facultad = $v;
			$this->modifiedColumns[] = MatriculaPeer::MAT_FACULTAD;
		}

		if ($this->aFacultad !== null && $this->aFacultad->getFacId() !== $v) {
			$this->aFacultad = null;
		}

	} 
	
	public function setMatValor($v)
	{

		if ($this->mat_valor !== $v) {
			$this->mat_valor = $v;
			$this->modifiedColumns[] = MatriculaPeer::MAT_VALOR;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->mat_id = $rs->getInt($startcol + 0);

			$this->mat_ano = $rs->getString($startcol + 1);

			$this->mat_sede = $rs->getInt($startcol + 2);

			$this->mat_facultad = $rs->getInt($startcol + 3);

			$this->mat_valor = $rs->getFloat($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Matricula object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(MatriculaPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			MatriculaPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(MatriculaPeer::DATABASE_NAME);
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


												
			if ($this->aSede !== null) {
				if ($this->aSede->isModified()) {
					$affectedRows += $this->aSede->save($con);
				}
				$this->setSede($this->aSede);
			}

			if ($this->aFacultad !== null) {
				if ($this->aFacultad->isModified()) {
					$affectedRows += $this->aFacultad->save($con);
				}
				$this->setFacultad($this->aFacultad);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = MatriculaPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setMatId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += MatriculaPeer::doUpdate($this, $con);
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


												
			if ($this->aSede !== null) {
				if (!$this->aSede->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSede->getValidationFailures());
				}
			}

			if ($this->aFacultad !== null) {
				if (!$this->aFacultad->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aFacultad->getValidationFailures());
				}
			}


			if (($retval = MatriculaPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MatriculaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getMatId();
				break;
			case 1:
				return $this->getMatAno();
				break;
			case 2:
				return $this->getMatSede();
				break;
			case 3:
				return $this->getMatFacultad();
				break;
			case 4:
				return $this->getMatValor();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MatriculaPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getMatId(),
			$keys[1] => $this->getMatAno(),
			$keys[2] => $this->getMatSede(),
			$keys[3] => $this->getMatFacultad(),
			$keys[4] => $this->getMatValor(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = MatriculaPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setMatId($value);
				break;
			case 1:
				$this->setMatAno($value);
				break;
			case 2:
				$this->setMatSede($value);
				break;
			case 3:
				$this->setMatFacultad($value);
				break;
			case 4:
				$this->setMatValor($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = MatriculaPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setMatId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setMatAno($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setMatSede($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setMatFacultad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setMatValor($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(MatriculaPeer::DATABASE_NAME);

		if ($this->isColumnModified(MatriculaPeer::MAT_ID)) $criteria->add(MatriculaPeer::MAT_ID, $this->mat_id);
		if ($this->isColumnModified(MatriculaPeer::MAT_ANO)) $criteria->add(MatriculaPeer::MAT_ANO, $this->mat_ano);
		if ($this->isColumnModified(MatriculaPeer::MAT_SEDE)) $criteria->add(MatriculaPeer::MAT_SEDE, $this->mat_sede);
		if ($this->isColumnModified(MatriculaPeer::MAT_FACULTAD)) $criteria->add(MatriculaPeer::MAT_FACULTAD, $this->mat_facultad);
		if ($this->isColumnModified(MatriculaPeer::MAT_VALOR)) $criteria->add(MatriculaPeer::MAT_VALOR, $this->mat_valor);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(MatriculaPeer::DATABASE_NAME);

		$criteria->add(MatriculaPeer::MAT_ID, $this->mat_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getMatId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setMatId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setMatAno($this->mat_ano);

		$copyObj->setMatSede($this->mat_sede);

		$copyObj->setMatFacultad($this->mat_facultad);

		$copyObj->setMatValor($this->mat_valor);


		$copyObj->setNew(true);

		$copyObj->setMatId(NULL); 
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
			self::$peer = new MatriculaPeer();
		}
		return self::$peer;
	}

	
	public function setSede($v)
	{


		if ($v === null) {
			$this->setMatSede(NULL);
		} else {
			$this->setMatSede($v->getSedCodigo());
		}


		$this->aSede = $v;
	}


	
	public function getSede($con = null)
	{
		if ($this->aSede === null && ($this->mat_sede !== null)) {
						include_once 'lib/model/om/BaseSedePeer.php';

			$this->aSede = SedePeer::retrieveByPK($this->mat_sede, $con);

			
		}
		return $this->aSede;
	}

	
	public function setFacultad($v)
	{


		if ($v === null) {
			$this->setMatFacultad(NULL);
		} else {
			$this->setMatFacultad($v->getFacId());
		}


		$this->aFacultad = $v;
	}


	
	public function getFacultad($con = null)
	{
		if ($this->aFacultad === null && ($this->mat_facultad !== null)) {
						include_once 'lib/model/om/BaseFacultadPeer.php';

			$this->aFacultad = FacultadPeer::retrieveByPK($this->mat_facultad, $con);

			
		}
		return $this->aFacultad;
	}

} 