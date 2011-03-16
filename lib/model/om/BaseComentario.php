<?php


abstract class BaseComentario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $com_id;


	
	protected $com_solicitud;


	
	protected $com_descripcion;


	
	protected $com_usuario;


	
	protected $com_sol_estado;


	
	protected $created_at;

	
	protected $aSolicitud;

	
	protected $aUsuario;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getComId()
	{

		return $this->com_id;
	}

	
	public function getComSolicitud()
	{

		return $this->com_solicitud;
	}

	
	public function getComDescripcion()
	{

		return $this->com_descripcion;
	}

	
	public function getComUsuario()
	{

		return $this->com_usuario;
	}

	
	public function getComSolEstado()
	{

		return $this->com_sol_estado;
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

	
	public function setComId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->com_id !== $v) {
			$this->com_id = $v;
			$this->modifiedColumns[] = ComentarioPeer::COM_ID;
		}

	} 
	
	public function setComSolicitud($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->com_solicitud !== $v) {
			$this->com_solicitud = $v;
			$this->modifiedColumns[] = ComentarioPeer::COM_SOLICITUD;
		}

		if ($this->aSolicitud !== null && $this->aSolicitud->getSolId() !== $v) {
			$this->aSolicitud = null;
		}

	} 
	
	public function setComDescripcion($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->com_descripcion !== $v) {
			$this->com_descripcion = $v;
			$this->modifiedColumns[] = ComentarioPeer::COM_DESCRIPCION;
		}

	} 
	
	public function setComUsuario($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->com_usuario !== $v) {
			$this->com_usuario = $v;
			$this->modifiedColumns[] = ComentarioPeer::COM_USUARIO;
		}

		if ($this->aUsuario !== null && $this->aUsuario->getUsuIdentificador() !== $v) {
			$this->aUsuario = null;
		}

	} 
	
	public function setComSolEstado($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->com_sol_estado !== $v) {
			$this->com_sol_estado = $v;
			$this->modifiedColumns[] = ComentarioPeer::COM_SOL_ESTADO;
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
			$this->modifiedColumns[] = ComentarioPeer::CREATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->com_id = $rs->getInt($startcol + 0);

			$this->com_solicitud = $rs->getInt($startcol + 1);

			$this->com_descripcion = $rs->getString($startcol + 2);

			$this->com_usuario = $rs->getString($startcol + 3);

			$this->com_sol_estado = $rs->getString($startcol + 4);

			$this->created_at = $rs->getTimestamp($startcol + 5, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Comentario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ComentarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			ComentarioPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(ComentarioPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(ComentarioPeer::DATABASE_NAME);
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
					$pk = ComentarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setComId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += ComentarioPeer::doUpdate($this, $con);
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


			if (($retval = ComentarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}



			$this->alreadyInValidation = false;
		}

		return (!empty($failureMap) ? $failureMap : true);
	}

	
	public function getByName($name, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ComentarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getComId();
				break;
			case 1:
				return $this->getComSolicitud();
				break;
			case 2:
				return $this->getComDescripcion();
				break;
			case 3:
				return $this->getComUsuario();
				break;
			case 4:
				return $this->getComSolEstado();
				break;
			case 5:
				return $this->getCreatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ComentarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getComId(),
			$keys[1] => $this->getComSolicitud(),
			$keys[2] => $this->getComDescripcion(),
			$keys[3] => $this->getComUsuario(),
			$keys[4] => $this->getComSolEstado(),
			$keys[5] => $this->getCreatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = ComentarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setComId($value);
				break;
			case 1:
				$this->setComSolicitud($value);
				break;
			case 2:
				$this->setComDescripcion($value);
				break;
			case 3:
				$this->setComUsuario($value);
				break;
			case 4:
				$this->setComSolEstado($value);
				break;
			case 5:
				$this->setCreatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = ComentarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setComId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setComSolicitud($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setComDescripcion($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setComUsuario($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setComSolEstado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setCreatedAt($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(ComentarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(ComentarioPeer::COM_ID)) $criteria->add(ComentarioPeer::COM_ID, $this->com_id);
		if ($this->isColumnModified(ComentarioPeer::COM_SOLICITUD)) $criteria->add(ComentarioPeer::COM_SOLICITUD, $this->com_solicitud);
		if ($this->isColumnModified(ComentarioPeer::COM_DESCRIPCION)) $criteria->add(ComentarioPeer::COM_DESCRIPCION, $this->com_descripcion);
		if ($this->isColumnModified(ComentarioPeer::COM_USUARIO)) $criteria->add(ComentarioPeer::COM_USUARIO, $this->com_usuario);
		if ($this->isColumnModified(ComentarioPeer::COM_SOL_ESTADO)) $criteria->add(ComentarioPeer::COM_SOL_ESTADO, $this->com_sol_estado);
		if ($this->isColumnModified(ComentarioPeer::CREATED_AT)) $criteria->add(ComentarioPeer::CREATED_AT, $this->created_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(ComentarioPeer::DATABASE_NAME);

		$criteria->add(ComentarioPeer::COM_ID, $this->com_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getComId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setComId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setComSolicitud($this->com_solicitud);

		$copyObj->setComDescripcion($this->com_descripcion);

		$copyObj->setComUsuario($this->com_usuario);

		$copyObj->setComSolEstado($this->com_sol_estado);

		$copyObj->setCreatedAt($this->created_at);


		$copyObj->setNew(true);

		$copyObj->setComId(NULL); 
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
			self::$peer = new ComentarioPeer();
		}
		return self::$peer;
	}

	
	public function setSolicitud($v)
	{


		if ($v === null) {
			$this->setComSolicitud(NULL);
		} else {
			$this->setComSolicitud($v->getSolId());
		}


		$this->aSolicitud = $v;
	}


	
	public function getSolicitud($con = null)
	{
		if ($this->aSolicitud === null && ($this->com_solicitud !== null)) {
						include_once 'lib/model/om/BaseSolicitudPeer.php';

			$this->aSolicitud = SolicitudPeer::retrieveByPK($this->com_solicitud, $con);

			
		}
		return $this->aSolicitud;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setComUsuario(NULL);
		} else {
			$this->setComUsuario($v->getUsuIdentificador());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->com_usuario !== "" && $this->com_usuario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->com_usuario, $con);

			
		}
		return $this->aUsuario;
	}

} 