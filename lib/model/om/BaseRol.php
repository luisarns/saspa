<?php


abstract class BaseRol extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $rol_identificador;


	
	protected $rol_nombre;


	
	protected $rol_url_menu;


	
	protected $rol_url_inicio;

	
	protected $collUsuarios;

	
	protected $lastUsuarioCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getRolIdentificador()
	{

		return $this->rol_identificador;
	}

	
	public function getRolNombre()
	{

		return $this->rol_nombre;
	}

	
	public function getRolUrlMenu()
	{

		return $this->rol_url_menu;
	}

	
	public function getRolUrlInicio()
	{

		return $this->rol_url_inicio;
	}

	
	public function setRolIdentificador($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rol_identificador !== $v) {
			$this->rol_identificador = $v;
			$this->modifiedColumns[] = RolPeer::ROL_IDENTIFICADOR;
		}

	} 
	
	public function setRolNombre($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rol_nombre !== $v) {
			$this->rol_nombre = $v;
			$this->modifiedColumns[] = RolPeer::ROL_NOMBRE;
		}

	} 
	
	public function setRolUrlMenu($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rol_url_menu !== $v) {
			$this->rol_url_menu = $v;
			$this->modifiedColumns[] = RolPeer::ROL_URL_MENU;
		}

	} 
	
	public function setRolUrlInicio($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->rol_url_inicio !== $v) {
			$this->rol_url_inicio = $v;
			$this->modifiedColumns[] = RolPeer::ROL_URL_INICIO;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->rol_identificador = $rs->getString($startcol + 0);

			$this->rol_nombre = $rs->getString($startcol + 1);

			$this->rol_url_menu = $rs->getString($startcol + 2);

			$this->rol_url_inicio = $rs->getString($startcol + 3);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 4; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Rol object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			RolPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(RolPeer::DATABASE_NAME);
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
					$pk = RolPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += RolPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collUsuarios !== null) {
				foreach($this->collUsuarios as $referrerFK) {
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


			if (($retval = RolPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collUsuarios !== null) {
					foreach($this->collUsuarios as $referrerFK) {
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
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getRolIdentificador();
				break;
			case 1:
				return $this->getRolNombre();
				break;
			case 2:
				return $this->getRolUrlMenu();
				break;
			case 3:
				return $this->getRolUrlInicio();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getRolIdentificador(),
			$keys[1] => $this->getRolNombre(),
			$keys[2] => $this->getRolUrlMenu(),
			$keys[3] => $this->getRolUrlInicio(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = RolPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setRolIdentificador($value);
				break;
			case 1:
				$this->setRolNombre($value);
				break;
			case 2:
				$this->setRolUrlMenu($value);
				break;
			case 3:
				$this->setRolUrlInicio($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = RolPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setRolIdentificador($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setRolNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setRolUrlMenu($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setRolUrlInicio($arr[$keys[3]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		if ($this->isColumnModified(RolPeer::ROL_IDENTIFICADOR)) $criteria->add(RolPeer::ROL_IDENTIFICADOR, $this->rol_identificador);
		if ($this->isColumnModified(RolPeer::ROL_NOMBRE)) $criteria->add(RolPeer::ROL_NOMBRE, $this->rol_nombre);
		if ($this->isColumnModified(RolPeer::ROL_URL_MENU)) $criteria->add(RolPeer::ROL_URL_MENU, $this->rol_url_menu);
		if ($this->isColumnModified(RolPeer::ROL_URL_INICIO)) $criteria->add(RolPeer::ROL_URL_INICIO, $this->rol_url_inicio);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(RolPeer::DATABASE_NAME);

		$criteria->add(RolPeer::ROL_IDENTIFICADOR, $this->rol_identificador);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getRolIdentificador();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setRolIdentificador($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setRolNombre($this->rol_nombre);

		$copyObj->setRolUrlMenu($this->rol_url_menu);

		$copyObj->setRolUrlInicio($this->rol_url_inicio);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getUsuarios() as $relObj) {
				$copyObj->addUsuario($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setRolIdentificador(NULL); 
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
			self::$peer = new RolPeer();
		}
		return self::$peer;
	}

	
	public function initUsuarios()
	{
		if ($this->collUsuarios === null) {
			$this->collUsuarios = array();
		}
	}

	
	public function getUsuarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collUsuarios === null) {
			if ($this->isNew()) {
			   $this->collUsuarios = array();
			} else {

				$criteria->add(UsuarioPeer::USU_ROL, $this->getRolIdentificador());

				UsuarioPeer::addSelectColumns($criteria);
				$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(UsuarioPeer::USU_ROL, $this->getRolIdentificador());

				UsuarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastUsuarioCriteria) || !$this->lastUsuarioCriteria->equals($criteria)) {
					$this->collUsuarios = UsuarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastUsuarioCriteria = $criteria;
		return $this->collUsuarios;
	}

	
	public function countUsuarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseUsuarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(UsuarioPeer::USU_ROL, $this->getRolIdentificador());

		return UsuarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addUsuario(Usuario $l)
	{
		$this->collUsuarios[] = $l;
		$l->setRol($this);
	}

} 