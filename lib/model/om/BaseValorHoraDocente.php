<?php


abstract class BaseValorHoraDocente extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $vhd_nivel_programa;


	
	protected $vhd_categoria_docente;


	
	protected $nombrado_bonificado;


	
	protected $nombrado_carga_academica;


	
	protected $hora_catedra;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getVhdNivelPrograma()
	{

		return $this->vhd_nivel_programa;
	}

	
	public function getVhdCategoriaDocente()
	{

		return $this->vhd_categoria_docente;
	}

	
	public function getNombradoBonificado()
	{

		return $this->nombrado_bonificado;
	}

	
	public function getNombradoCargaAcademica()
	{

		return $this->nombrado_carga_academica;
	}

	
	public function getHoraCatedra()
	{

		return $this->hora_catedra;
	}

	
	public function setVhdNivelPrograma($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->vhd_nivel_programa !== $v) {
			$this->vhd_nivel_programa = $v;
			$this->modifiedColumns[] = ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA;
		}

	} 
	
	public function setVhdCategoriaDocente($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->vhd_categoria_docente !== $v) {
			$this->vhd_categoria_docente = $v;
			$this->modifiedColumns[] = ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE;
		}

	} 
	
	public function setNombradoBonificado($v)
	{

		if ($this->nombrado_bonificado !== $v) {
			$this->nombrado_bonificado = $v;
			$this->modifiedColumns[] = ValorHoraDocentePeer::NOMBRADO_BONIFICADO;
		}

	} 
	
	public function setNombradoCargaAcademica($v)
	{

		if ($this->nombrado_carga_academica !== $v) {
			$this->nombrado_carga_academica = $v;
			$this->modifiedColumns[] = ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA;
		}

	} 
	
	public function setHoraCatedra($v)
	{

		if ($this->hora_catedra !== $v) {
			$this->hora_catedra = $v;
			$this->modifiedColumns[] = ValorHoraDocentePeer::HORA_CATEDRA;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->vhd_nivel_programa = $rs->getString($startcol + 0);

			$this->vhd_categoria_docente = $rs->getString($startcol + 1);

			$this->nombrado_bonificado = $rs->getFloat($startcol + 2);

			$this->nombrado_carga_academica = $rs->getFloat($startcol + 3);

			$this->hora_catedra = $rs->getFloat($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating ValorHoraDocente object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ValorHoraDocentePeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ValorHoraDocentePeer::doDelete($this, $con);
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
			$con = Propel::getConnection(ValorHoraDocentePeer::DATABASE_NAME);
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
					$pk = ValorHoraDocentePeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += ValorHoraDocentePeer::doUpdate($this, $con);
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


			if (($retval = ValorHoraDocentePeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValorHoraDocentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getVhdNivelPrograma();
				break;
			case 1:
				return $this->getVhdCategoriaDocente();
				break;
			case 2:
				return $this->getNombradoBonificado();
				break;
			case 3:
				return $this->getNombradoCargaAcademica();
				break;
			case 4:
				return $this->getHoraCatedra();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValorHoraDocentePeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getVhdNivelPrograma(),
			$keys[1] => $this->getVhdCategoriaDocente(),
			$keys[2] => $this->getNombradoBonificado(),
			$keys[3] => $this->getNombradoCargaAcademica(),
			$keys[4] => $this->getHoraCatedra(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ValorHoraDocentePeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setVhdNivelPrograma($value);
				break;
			case 1:
				$this->setVhdCategoriaDocente($value);
				break;
			case 2:
				$this->setNombradoBonificado($value);
				break;
			case 3:
				$this->setNombradoCargaAcademica($value);
				break;
			case 4:
				$this->setHoraCatedra($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ValorHoraDocentePeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setVhdNivelPrograma($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setVhdCategoriaDocente($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setNombradoBonificado($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setNombradoCargaAcademica($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setHoraCatedra($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ValorHoraDocentePeer::DATABASE_NAME);

		if ($this->isColumnModified(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA)) $criteria->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $this->vhd_nivel_programa);
		if ($this->isColumnModified(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE)) $criteria->add(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, $this->vhd_categoria_docente);
		if ($this->isColumnModified(ValorHoraDocentePeer::NOMBRADO_BONIFICADO)) $criteria->add(ValorHoraDocentePeer::NOMBRADO_BONIFICADO, $this->nombrado_bonificado);
		if ($this->isColumnModified(ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA)) $criteria->add(ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA, $this->nombrado_carga_academica);
		if ($this->isColumnModified(ValorHoraDocentePeer::HORA_CATEDRA)) $criteria->add(ValorHoraDocentePeer::HORA_CATEDRA, $this->hora_catedra);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ValorHoraDocentePeer::DATABASE_NAME);

		$criteria->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $this->vhd_nivel_programa);
		$criteria->add(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, $this->vhd_categoria_docente);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		$pks = array();

		$pks[0] = $this->getVhdNivelPrograma();

		$pks[1] = $this->getVhdCategoriaDocente();

		return $pks;
	}

	
	public function setPrimaryKey($keys)
	{

		$this->setVhdNivelPrograma($keys[0]);

		$this->setVhdCategoriaDocente($keys[1]);

	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setNombradoBonificado($this->nombrado_bonificado);

		$copyObj->setNombradoCargaAcademica($this->nombrado_carga_academica);

		$copyObj->setHoraCatedra($this->hora_catedra);


		$copyObj->setNew(true);

		$copyObj->setVhdNivelPrograma(NULL); 
		$copyObj->setVhdCategoriaDocente(NULL); 
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
			self::$peer = new ValorHoraDocentePeer();
		}
		return self::$peer;
	}

} 