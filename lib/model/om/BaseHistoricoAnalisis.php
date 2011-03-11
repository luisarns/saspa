<?php


abstract class BaseHistoricoAnalisis extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $hia_estado;


	
	protected $hia_solicitud;


	
	protected $hia_usuario;


	
	protected $created_at;


	
	protected $id;

	
	protected $aSolicitud;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getHiaEstado()
	{

		return $this->hia_estado;
	}

	
	public function getHiaSolicitud()
	{

		return $this->hia_solicitud;
	}

	
	public function getHiaUsuario()
	{

		return $this->hia_usuario;
	}

	
	public function getCreatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->created_at === null || $this->created_at === '') {
			return null;
		} elseif (!is_int($this->created_at)) {
						$ts = strtotime($this->created_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [created_at] as date/time value: " . var_export($this->created_at, true));
			}
		} else {
			$ts = $this->created_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function getId()
	{

		return $this->id;
	}

	
	public function setHiaEstado($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hia_estado !== $v) {
			$this->hia_estado = $v;
			$this->modifiedColumns[] = HistoricoAnalisisPeer::HIA_ESTADO;
		}

	} 
	
	public function setHiaSolicitud($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->hia_solicitud !== $v) {
			$this->hia_solicitud = $v;
			$this->modifiedColumns[] = HistoricoAnalisisPeer::HIA_SOLICITUD;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setHiaUsuario($v)
	{

		
		
		if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->hia_usuario !== $v) {
			$this->hia_usuario = $v;
			$this->modifiedColumns[] = HistoricoAnalisisPeer::HIA_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getUsuIdentificador() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setCreatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [created_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->created_at !== $ts) {
			$this->created_at = $ts;
			$this->modifiedColumns[] = HistoricoAnalisisPeer::CREATED_AT;
		}

	} 
	
	public function setId($v)
	{

		
		
		if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->id !== $v) {
			$this->id = $v;
			$this->modifiedColumns[] = HistoricoAnalisisPeer::ID;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->hia_estado = $rs->getString($startcol + 0);

			$this->hia_solicitud = $rs->getInt($startcol + 1);

			$this->hia_usuario = $rs->getString($startcol + 2);

			$this->created_at = $rs->getTimestamp($startcol + 3, null);

			$this->id = $rs->getInt($startcol + 4);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 5; 
		} catch (Exception $e) {
			throw new PropelException("Error populating HistoricoAnalisis object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HistoricoAnalisisPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			HistoricoAnalisisPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(HistoricoAnalisisPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(HistoricoAnalisisPeer::DATABASE_NAME);
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


												
			if ($this->aSolicitud !== null) {
				if ($this->aSolicitud->isModified()) {
					$affectedRows += $this->aSolicitud->save($con);
				}
				$this->setSolicitud($this->aSolicitud);
			}

			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = HistoricoAnalisisPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += HistoricoAnalisisPeer::doUpdate($this, $con);
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


												
			if ($this->aSolicitud !== null) {
				if (!$this->aSolicitud->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aSolicitud->getValidationFailures());
				}
			}

			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = HistoricoAnalisisPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HistoricoAnalisisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getHiaEstado();
				break;
			case 1:
				return $this->getHiaSolicitud();
				break;
			case 2:
				return $this->getHiaUsuario();
				break;
			case 3:
				return $this->getCreatedAt();
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
		$keys = HistoricoAnalisisPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getHiaEstado(),
			$keys[1] => $this->getHiaSolicitud(),
			$keys[2] => $this->getHiaUsuario(),
			$keys[3] => $this->getCreatedAt(),
			$keys[4] => $this->getId(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = HistoricoAnalisisPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setHiaEstado($value);
				break;
			case 1:
				$this->setHiaSolicitud($value);
				break;
			case 2:
				$this->setHiaUsuario($value);
				break;
			case 3:
				$this->setCreatedAt($value);
				break;
			case 4:
				$this->setId($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = HistoricoAnalisisPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setHiaEstado($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setHiaSolicitud($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setHiaUsuario($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setCreatedAt($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setId($arr[$keys[4]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(HistoricoAnalisisPeer::DATABASE_NAME);

		if ($this->isColumnModified(HistoricoAnalisisPeer::HIA_ESTADO)) $criteria->add(HistoricoAnalisisPeer::HIA_ESTADO, $this->hia_estado);
		if ($this->isColumnModified(HistoricoAnalisisPeer::HIA_SOLICITUD)) $criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->hia_solicitud);
		if ($this->isColumnModified(HistoricoAnalisisPeer::HIA_USUARIO)) $criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->hia_usuario);
		if ($this->isColumnModified(HistoricoAnalisisPeer::CREATED_AT)) $criteria->add(HistoricoAnalisisPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(HistoricoAnalisisPeer::ID)) $criteria->add(HistoricoAnalisisPeer::ID, $this->id);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(HistoricoAnalisisPeer::DATABASE_NAME);

		$criteria->add(HistoricoAnalisisPeer::ID, $this->id);

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

		$copyObj->setHiaEstado($this->hia_estado);

		$copyObj->setHiaSolicitud($this->hia_solicitud);

		$copyObj->setHiaUsuario($this->hia_usuario);

		$copyObj->setCreatedAt($this->created_at);


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
			self::$peer = new HistoricoAnalisisPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setHiaSolicitud(NULL);
		} else {
			$this->setHiaSolicitud($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->hia_solicitud !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->hia_solicitud, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setHiaUsuario(NULL);
		} else {
			$this->setHiaUsuario($v->getUsuIdentificador());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->hia_usuario !== "" && $this->hia_usuario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->hia_usuario, $con);

			
		}
		return $this->aUsuario;
	}

} 