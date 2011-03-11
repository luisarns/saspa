<?php


abstract class BaseInversionesGastosGenerales extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $igg_peg_id;


	
	protected $igg_concepto;


	
	protected $igg_periodo;


	
	protected $igg_costo;


	
	protected $id;

	
	protected $aPresupuestoEgresos;

	
	protected $aConceptoGastos;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getIggPegId()
	{

		return $this->igg_peg_id;
	}

	
	public function getIggConcepto()
	{

		return $this->igg_concepto;
	}

	
	public function getIggPeriodo()
	{

		return $this->igg_periodo;
	}

	
	public function getIggCosto()
	{

		return $this->igg_costo;
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setIggPegId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->igg_peg_id !== $v) {
			$this->igg_peg_id = $v;
			$this->modifiedColumns[] = InversionesGastosGeneralesPeer::IGG_PEG_ID;
		}

		if ($this->aPresupuestoEgresos !== null && $this->aPresupuestoEgresos->getPegId() !== $v) {
			$this->aPresupuestoEgresos = null;
		}

	} 
	
	public function setIggConcepto($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->igg_concepto !== $v) {
			$this->igg_concepto = $v;
			$this->modifiedColumns[] = InversionesGastosGeneralesPeer::IGG_CONCEPTO;
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
			$this->modifiedColumns[] = InversionesGastosGeneralesPeer::IGG_PERIODO;
		}

	} 
	
	public function setIggCosto($v)
	{

		if ($this->igg_costo !== $v) {
			$this->igg_costo = $v;
			$this->modifiedColumns[] = InversionesGastosGeneralesPeer::IGG_COSTO;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = InversionesGastosGeneralesPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->igg_peg_id = $rs->getInt($startcol + 0);

			$this->igg_concepto = $rs->getInt($startcol + 1);

			$this->igg_periodo = $rs->getInt($startcol + 2);

			$this->igg_costo = $rs->getFloat($startcol + 3);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating InversionesGastosGenerales object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(InversionesGastosGeneralesPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			InversionesGastosGeneralesPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(InversionesGastosGeneralesPeer::DATABASE_NAME);
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


												
			if ($this->aPresupuestoEgresos !== null) {
				if ($this->aPresupuestoEgresos->isModified()) {
					$affectedRows += $this->aPresupuestoEgresos->save($con);
				}
				$this->setPresupuestoEgresos($this->aPresupuestoEgresos);
			}

			if ($this->aConceptoGastos !== null) {
				if ($this->aConceptoGastos->isModified()) {
					$affectedRows += $this->aConceptoGastos->save($con);
				}
				$this->setConceptoGastos($this->aConceptoGastos);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = InversionesGastosGeneralesPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += InversionesGastosGeneralesPeer::doUpdate($this, $con);
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


												
			if ($this->aPresupuestoEgresos !== null) {
				if (!$this->aPresupuestoEgresos->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aPresupuestoEgresos->getValidationFailures());
				}
			}

			if ($this->aConceptoGastos !== null) {
				if (!$this->aConceptoGastos->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aConceptoGastos->getValidationFailures());
				}
			}


			if (($retval = InversionesGastosGeneralesPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InversionesGastosGeneralesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getIggPegId();
				break;
			case 1:
				return $this->getIggConcepto();
				break;
			case 2:
				return $this->getIggPeriodo();
				break;
			case 3:
				return $this->getIggCosto();
				break;
			case 4:
				return $this->getId();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InversionesGastosGeneralesPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getIggPegId(),
			$keys[1] => $this->getIggConcepto(),
			$keys[2] => $this->getIggPeriodo(),
			$keys[3] => $this->getIggCosto(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = InversionesGastosGeneralesPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setIggPegId($value);
				break;
			case 1:
				$this->setIggConcepto($value);
				break;
			case 2:
				$this->setIggPeriodo($value);
				break;
			case 3:
				$this->setIggCosto($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = InversionesGastosGeneralesPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setIggPegId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setIggConcepto($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setIggPeriodo($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setIggCosto($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(InversionesGastosGeneralesPeer::DATABASE_NAME);

		if ($this->isColumnModified(InversionesGastosGeneralesPeer::IGG_PEG_ID)) $criteria->add(InversionesGastosGeneralesPeer::IGG_PEG_ID, $this->igg_peg_id);
		if ($this->isColumnModified(InversionesGastosGeneralesPeer::IGG_CONCEPTO)) $criteria->add(InversionesGastosGeneralesPeer::IGG_CONCEPTO, $this->igg_concepto);
		if ($this->isColumnModified(InversionesGastosGeneralesPeer::IGG_PERIODO)) $criteria->add(InversionesGastosGeneralesPeer::IGG_PERIODO, $this->igg_periodo);
		if ($this->isColumnModified(InversionesGastosGeneralesPeer::IGG_COSTO)) $criteria->add(InversionesGastosGeneralesPeer::IGG_COSTO, $this->igg_costo);
		if ($this->isColumnModified(InversionesGastosGeneralesPeer::ID)) $criteria->add(InversionesGastosGeneralesPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(InversionesGastosGeneralesPeer::DATABASE_NAME);

		$criteria->add(InversionesGastosGeneralesPeer::ID, $this->id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setIggPegId($this->igg_peg_id);

		$copyObj->setIggConcepto($this->igg_concepto);

		$copyObj->setIggPeriodo($this->igg_periodo);

		$copyObj->setIggCosto($this->igg_costo);


		$copyObj->setNew(true);

		$copyObj->setId(NULL); 
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
			self::$peer = new InversionesGastosGeneralesPeer();
		}
		return self::$peer;
	}

	
	public function setPresupuestoEgresos($v)
	{


		if ($v === null) {
			$this->setIggPegId(NULL);
		} else {
			$this->setIggPegId($v->getPegId());
		}


		$this->aPresupuestoEgresos = $v;
	}


	
	public function getPresupuestoEgresos($con = null)
	{
		if ($this->aPresupuestoEgresos === null && ($this->igg_peg_id !== null)) {
						include_once 'lib/model/om/BasePresupuestoEgresosPeer.php';

			$this->aPresupuestoEgresos = PresupuestoEgresosPeer::retrieveByPK($this->igg_peg_id, $con);

			
		}
		return $this->aPresupuestoEgresos;
	}

	
	public function setConceptoGastos($v)
	{


		if ($v === null) {
			$this->setIggConcepto(NULL);
		} else {
			$this->setIggConcepto($v->getCogId());
		}


		$this->aConceptoGastos = $v;
	}


	
	public function getConceptoGastos($con = null)
	{
		if ($this->aConceptoGastos === null && ($this->igg_concepto !== null)) {
						include_once 'lib/model/om/BaseConceptoGastosPeer.php';

			$this->aConceptoGastos = ConceptoGastosPeer::retrieveByPK($this->igg_concepto, $con);

			
		}
		return $this->aConceptoGastos;
	}

} 