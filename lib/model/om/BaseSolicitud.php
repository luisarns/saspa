<?php


abstract class BaseSolicitud extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $sol_id;


	
	protected $sol_nombre;


	
	protected $sol_escuela;


	
	protected $sol_facultad;


	
	protected $sol_archivo;


	
	protected $sol_estado;


	
	protected $sol_usuario;


	
	protected $created_at;


	
	protected $updated_at;

	
	protected $aUsuario;

	
	protected $collComentarios;

	
	protected $lastComentarioCriteria = null;

	
	protected $collInformacionGenerals;

	
	protected $lastInformacionGeneralCriteria = null;

	
	protected $collExtructuraCurriculars;

	
	protected $lastExtructuraCurricularCriteria = null;

	
	protected $collPresupuestoIngresoss;

	
	protected $lastPresupuestoIngresosCriteria = null;

	
	protected $collFuentesExternass;

	
	protected $lastFuentesExternasCriteria = null;

	
	protected $collPresupuestoEgresoss;

	
	protected $lastPresupuestoEgresosCriteria = null;

	
	protected $collConceptoGastoss;

	
	protected $lastConceptoGastosCriteria = null;

	
	protected $collHistoricoAnalisiss;

	
	protected $lastHistoricoAnalisisCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getSolId()
	{

		return $this->sol_id;
	}

	
	public function getSolNombre()
	{

		return $this->sol_nombre;
	}

	
	public function getSolEscuela()
	{

		return $this->sol_escuela;
	}

	
	public function getSolFacultad()
	{

		return $this->sol_facultad;
	}

	
	public function getSolArchivo()
	{

		return $this->sol_archivo;
	}

	
	public function getSolEstado()
	{

		return $this->sol_estado;
	}

	
	public function getSolUsuario()
	{

		return $this->sol_usuario;
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

	
	public function getUpdatedAt($format = 'Y-m-d H:i:s')
	{

		if ($this->updated_at === null || $this->updated_at === '') {
			return null;
		} elseif (!is_int($this->updated_at)) {
						$ts = strtotime($this->updated_at);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse value of [updated_at] as date/time value: " . var_export($this->updated_at, true));
			}
		} else {
			$ts = $this->updated_at;
		}
		if ($format === null) {
			return $ts;
		} elseif (strpos($format, '%') !== false) {
			return strftime($format, $ts);
		} else {
			return date($format, $ts);
		}
	}

	
	public function setSolId($v)
	{

						if ($v !== null && !is_int($v) && is_numeric($v)) {
			$v = (int) $v;
		}

		if ($this->sol_id !== $v) {
			$this->sol_id = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_ID;
		}

	} 
	
	public function setSolNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_nombre !== $v) {
			$this->sol_nombre = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_NOMBRE;
		}

	} 
	
	public function setSolEscuela($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_escuela !== $v) {
			$this->sol_escuela = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_ESCUELA;
		}

	} 
	
	public function setSolFacultad($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_facultad !== $v) {
			$this->sol_facultad = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_FACULTAD;
		}

	} 
	
	public function setSolArchivo($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_archivo !== $v) {
			$this->sol_archivo = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_ARCHIVO;
		}

	} 
	
	public function setSolEstado($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_estado !== $v) {
			$this->sol_estado = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_ESTADO;
		}

	} 
	
	public function setSolUsuario($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->sol_usuario !== $v) {
			$this->sol_usuario = $v;
			$this->modifiedColumns[] = SolicitudPeer::SOL_USUARIO;
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
			$this->modifiedColumns[] = SolicitudPeer::CREATED_AT;
		}

	} 
	
	public function setUpdatedAt($v)
	{

		if ($v !== null && !is_int($v)) {
			$ts = strtotime($v);
			if ($ts === -1 || $ts === false) { 				throw new PropelException("Unable to parse date/time value for [updated_at] from input: " . var_export($v, true));
			}
		} else {
			$ts = $v;
		}
		if ($this->updated_at !== $ts) {
			$this->updated_at = $ts;
			$this->modifiedColumns[] = SolicitudPeer::UPDATED_AT;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->sol_id = $rs->getInt($startcol + 0);

			$this->sol_nombre = $rs->getString($startcol + 1);

			$this->sol_escuela = $rs->getString($startcol + 2);

			$this->sol_facultad = $rs->getString($startcol + 3);

			$this->sol_archivo = $rs->getString($startcol + 4);

			$this->sol_estado = $rs->getString($startcol + 5);

			$this->sol_usuario = $rs->getString($startcol + 6);

			$this->created_at = $rs->getTimestamp($startcol + 7, null);

			$this->updated_at = $rs->getTimestamp($startcol + 8, null);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 9; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Solicitud object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SolicitudPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			SolicitudPeer::doDelete($this, $con);
			$this->setDeleted(true);
			$con->commit();
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public function save($con = null)
	{
    if ($this->isNew() && !$this->isColumnModified(SolicitudPeer::CREATED_AT))
    {
      $this->setCreatedAt(time());
    }

    if ($this->isModified() && !$this->isColumnModified(SolicitudPeer::UPDATED_AT))
    {
      $this->setUpdatedAt(time());
    }

		if ($this->isDeleted()) {
			throw new PropelException("You cannot save an object that has been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(SolicitudPeer::DATABASE_NAME);
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


												
			if ($this->aUsuario !== null) {
				if ($this->aUsuario->isModified()) {
					$affectedRows += $this->aUsuario->save($con);
				}
				$this->setUsuario($this->aUsuario);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = SolicitudPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setSolId($pk);  
					$this->setNew(false);
				} else {
					$affectedRows += SolicitudPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collComentarios !== null) {
				foreach($this->collComentarios as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collInformacionGenerals !== null) {
				foreach($this->collInformacionGenerals as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collExtructuraCurriculars !== null) {
				foreach($this->collExtructuraCurriculars as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPresupuestoIngresoss !== null) {
				foreach($this->collPresupuestoIngresoss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collFuentesExternass !== null) {
				foreach($this->collFuentesExternass as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collPresupuestoEgresoss !== null) {
				foreach($this->collPresupuestoEgresoss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collConceptoGastoss !== null) {
				foreach($this->collConceptoGastoss as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collHistoricoAnalisiss !== null) {
				foreach($this->collHistoricoAnalisiss as $referrerFK) {
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


												
			if ($this->aUsuario !== null) {
				if (!$this->aUsuario->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aUsuario->getValidationFailures());
				}
			}


			if (($retval = SolicitudPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collComentarios !== null) {
					foreach($this->collComentarios as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collInformacionGenerals !== null) {
					foreach($this->collInformacionGenerals as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collExtructuraCurriculars !== null) {
					foreach($this->collExtructuraCurriculars as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPresupuestoIngresoss !== null) {
					foreach($this->collPresupuestoIngresoss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collFuentesExternass !== null) {
					foreach($this->collFuentesExternass as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collPresupuestoEgresoss !== null) {
					foreach($this->collPresupuestoEgresoss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collConceptoGastoss !== null) {
					foreach($this->collConceptoGastoss as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collHistoricoAnalisiss !== null) {
					foreach($this->collHistoricoAnalisiss as $referrerFK) {
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
		$pos = SolicitudPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getSolId();
				break;
			case 1:
				return $this->getSolNombre();
				break;
			case 2:
				return $this->getSolEscuela();
				break;
			case 3:
				return $this->getSolFacultad();
				break;
			case 4:
				return $this->getSolArchivo();
				break;
			case 5:
				return $this->getSolEstado();
				break;
			case 6:
				return $this->getSolUsuario();
				break;
			case 7:
				return $this->getCreatedAt();
				break;
			case 8:
				return $this->getUpdatedAt();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SolicitudPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getSolId(),
			$keys[1] => $this->getSolNombre(),
			$keys[2] => $this->getSolEscuela(),
			$keys[3] => $this->getSolFacultad(),
			$keys[4] => $this->getSolArchivo(),
			$keys[5] => $this->getSolEstado(),
			$keys[6] => $this->getSolUsuario(),
			$keys[7] => $this->getCreatedAt(),
			$keys[8] => $this->getUpdatedAt(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = SolicitudPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setSolId($value);
				break;
			case 1:
				$this->setSolNombre($value);
				break;
			case 2:
				$this->setSolEscuela($value);
				break;
			case 3:
				$this->setSolFacultad($value);
				break;
			case 4:
				$this->setSolArchivo($value);
				break;
			case 5:
				$this->setSolEstado($value);
				break;
			case 6:
				$this->setSolUsuario($value);
				break;
			case 7:
				$this->setCreatedAt($value);
				break;
			case 8:
				$this->setUpdatedAt($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = SolicitudPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setSolId($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setSolNombre($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setSolEscuela($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setSolFacultad($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setSolArchivo($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setSolEstado($arr[$keys[5]]);
		if (array_key_exists($keys[6], $arr)) $this->setSolUsuario($arr[$keys[6]]);
		if (array_key_exists($keys[7], $arr)) $this->setCreatedAt($arr[$keys[7]]);
		if (array_key_exists($keys[8], $arr)) $this->setUpdatedAt($arr[$keys[8]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(SolicitudPeer::DATABASE_NAME);

		if ($this->isColumnModified(SolicitudPeer::SOL_ID)) $criteria->add(SolicitudPeer::SOL_ID, $this->sol_id);
		if ($this->isColumnModified(SolicitudPeer::SOL_NOMBRE)) $criteria->add(SolicitudPeer::SOL_NOMBRE, $this->sol_nombre);
		if ($this->isColumnModified(SolicitudPeer::SOL_ESCUELA)) $criteria->add(SolicitudPeer::SOL_ESCUELA, $this->sol_escuela);
		if ($this->isColumnModified(SolicitudPeer::SOL_FACULTAD)) $criteria->add(SolicitudPeer::SOL_FACULTAD, $this->sol_facultad);
		if ($this->isColumnModified(SolicitudPeer::SOL_ARCHIVO)) $criteria->add(SolicitudPeer::SOL_ARCHIVO, $this->sol_archivo);
		if ($this->isColumnModified(SolicitudPeer::SOL_ESTADO)) $criteria->add(SolicitudPeer::SOL_ESTADO, $this->sol_estado);
		if ($this->isColumnModified(SolicitudPeer::SOL_USUARIO)) $criteria->add(SolicitudPeer::SOL_USUARIO, $this->sol_usuario);
		if ($this->isColumnModified(SolicitudPeer::CREATED_AT)) $criteria->add(SolicitudPeer::CREATED_AT, $this->created_at);
		if ($this->isColumnModified(SolicitudPeer::UPDATED_AT)) $criteria->add(SolicitudPeer::UPDATED_AT, $this->updated_at);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(SolicitudPeer::DATABASE_NAME);

		$criteria->add(SolicitudPeer::SOL_ID, $this->sol_id);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getSolId();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setSolId($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setSolNombre($this->sol_nombre);

		$copyObj->setSolEscuela($this->sol_escuela);

		$copyObj->setSolFacultad($this->sol_facultad);

		$copyObj->setSolArchivo($this->sol_archivo);

		$copyObj->setSolEstado($this->sol_estado);

		$copyObj->setSolUsuario($this->sol_usuario);

		$copyObj->setCreatedAt($this->created_at);

		$copyObj->setUpdatedAt($this->updated_at);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getComentarios() as $relObj) {
				$copyObj->addComentario($relObj->copy($deepCopy));
			}

			foreach($this->getInformacionGenerals() as $relObj) {
				$copyObj->addInformacionGeneral($relObj->copy($deepCopy));
			}

			foreach($this->getExtructuraCurriculars() as $relObj) {
				$copyObj->addExtructuraCurricular($relObj->copy($deepCopy));
			}

			foreach($this->getPresupuestoIngresoss() as $relObj) {
				$copyObj->addPresupuestoIngresos($relObj->copy($deepCopy));
			}

			foreach($this->getFuentesExternass() as $relObj) {
				$copyObj->addFuentesExternas($relObj->copy($deepCopy));
			}

			foreach($this->getPresupuestoEgresoss() as $relObj) {
				$copyObj->addPresupuestoEgresos($relObj->copy($deepCopy));
			}

			foreach($this->getConceptoGastoss() as $relObj) {
				$copyObj->addConceptoGastos($relObj->copy($deepCopy));
			}

			foreach($this->getHistoricoAnalisiss() as $relObj) {
				$copyObj->addHistoricoAnalisis($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setSolId(NULL); 
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
			self::$peer = new SolicitudPeer();
		}
		return self::$peer;
	}

	
	public function setUsuario($v)
	{


		if ($v === null) {
			$this->setSolUsuario(NULL);
		} else {
			$this->setSolUsuario($v->getUsuIdentificador());
		}


		$this->aUsuario = $v;
	}


	
	public function getUsuario($con = null)
	{
		if ($this->aUsuario === null && (($this->sol_usuario !== "" && $this->sol_usuario !== null))) {
						include_once 'lib/model/om/BaseUsuarioPeer.php';

			$this->aUsuario = UsuarioPeer::retrieveByPK($this->sol_usuario, $con);

			
		}
		return $this->aUsuario;
	}

	
	public function initComentarios()
	{
		if ($this->collComentarios === null) {
			$this->collComentarios = array();
		}
	}

	
	public function getComentarios($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComentarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComentarios === null) {
			if ($this->isNew()) {
			   $this->collComentarios = array();
			} else {

				$criteria->add(ComentarioPeer::COM_SOLICITUD, $this->getSolId());

				ComentarioPeer::addSelectColumns($criteria);
				$this->collComentarios = ComentarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ComentarioPeer::COM_SOLICITUD, $this->getSolId());

				ComentarioPeer::addSelectColumns($criteria);
				if (!isset($this->lastComentarioCriteria) || !$this->lastComentarioCriteria->equals($criteria)) {
					$this->collComentarios = ComentarioPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastComentarioCriteria = $criteria;
		return $this->collComentarios;
	}

	
	public function countComentarios($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseComentarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ComentarioPeer::COM_SOLICITUD, $this->getSolId());

		return ComentarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComentario(Comentario $l)
	{
		$this->collComentarios[] = $l;
		$l->setSolicitud($this);
	}


	
	public function getComentariosJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseComentarioPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collComentarios === null) {
			if ($this->isNew()) {
				$this->collComentarios = array();
			} else {

				$criteria->add(ComentarioPeer::COM_SOLICITUD, $this->getSolId());

				$this->collComentarios = ComentarioPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(ComentarioPeer::COM_SOLICITUD, $this->getSolId());

			if (!isset($this->lastComentarioCriteria) || !$this->lastComentarioCriteria->equals($criteria)) {
				$this->collComentarios = ComentarioPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastComentarioCriteria = $criteria;

		return $this->collComentarios;
	}

	
	public function initInformacionGenerals()
	{
		if ($this->collInformacionGenerals === null) {
			$this->collInformacionGenerals = array();
		}
	}

	
	public function getInformacionGenerals($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseInformacionGeneralPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collInformacionGenerals === null) {
			if ($this->isNew()) {
			   $this->collInformacionGenerals = array();
			} else {

				$criteria->add(InformacionGeneralPeer::ING_SOL_ID, $this->getSolId());

				InformacionGeneralPeer::addSelectColumns($criteria);
				$this->collInformacionGenerals = InformacionGeneralPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(InformacionGeneralPeer::ING_SOL_ID, $this->getSolId());

				InformacionGeneralPeer::addSelectColumns($criteria);
				if (!isset($this->lastInformacionGeneralCriteria) || !$this->lastInformacionGeneralCriteria->equals($criteria)) {
					$this->collInformacionGenerals = InformacionGeneralPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastInformacionGeneralCriteria = $criteria;
		return $this->collInformacionGenerals;
	}

	
	public function countInformacionGenerals($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseInformacionGeneralPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(InformacionGeneralPeer::ING_SOL_ID, $this->getSolId());

		return InformacionGeneralPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addInformacionGeneral(InformacionGeneral $l)
	{
		$this->collInformacionGenerals[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initExtructuraCurriculars()
	{
		if ($this->collExtructuraCurriculars === null) {
			$this->collExtructuraCurriculars = array();
		}
	}

	
	public function getExtructuraCurriculars($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseExtructuraCurricularPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collExtructuraCurriculars === null) {
			if ($this->isNew()) {
			   $this->collExtructuraCurriculars = array();
			} else {

				$criteria->add(ExtructuraCurricularPeer::ECU_SOL_ID, $this->getSolId());

				ExtructuraCurricularPeer::addSelectColumns($criteria);
				$this->collExtructuraCurriculars = ExtructuraCurricularPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ExtructuraCurricularPeer::ECU_SOL_ID, $this->getSolId());

				ExtructuraCurricularPeer::addSelectColumns($criteria);
				if (!isset($this->lastExtructuraCurricularCriteria) || !$this->lastExtructuraCurricularCriteria->equals($criteria)) {
					$this->collExtructuraCurriculars = ExtructuraCurricularPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastExtructuraCurricularCriteria = $criteria;
		return $this->collExtructuraCurriculars;
	}

	
	public function countExtructuraCurriculars($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseExtructuraCurricularPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ExtructuraCurricularPeer::ECU_SOL_ID, $this->getSolId());

		return ExtructuraCurricularPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addExtructuraCurricular(ExtructuraCurricular $l)
	{
		$this->collExtructuraCurriculars[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initPresupuestoIngresoss()
	{
		if ($this->collPresupuestoIngresoss === null) {
			$this->collPresupuestoIngresoss = array();
		}
	}

	
	public function getPresupuestoIngresoss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePresupuestoIngresosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPresupuestoIngresoss === null) {
			if ($this->isNew()) {
			   $this->collPresupuestoIngresoss = array();
			} else {

				$criteria->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->getSolId());

				PresupuestoIngresosPeer::addSelectColumns($criteria);
				$this->collPresupuestoIngresoss = PresupuestoIngresosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->getSolId());

				PresupuestoIngresosPeer::addSelectColumns($criteria);
				if (!isset($this->lastPresupuestoIngresosCriteria) || !$this->lastPresupuestoIngresosCriteria->equals($criteria)) {
					$this->collPresupuestoIngresoss = PresupuestoIngresosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPresupuestoIngresosCriteria = $criteria;
		return $this->collPresupuestoIngresoss;
	}

	
	public function countPresupuestoIngresoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePresupuestoIngresosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PresupuestoIngresosPeer::PIN_SOL_ID, $this->getSolId());

		return PresupuestoIngresosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPresupuestoIngresos(PresupuestoIngresos $l)
	{
		$this->collPresupuestoIngresoss[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initFuentesExternass()
	{
		if ($this->collFuentesExternass === null) {
			$this->collFuentesExternass = array();
		}
	}

	
	public function getFuentesExternass($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseFuentesExternasPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collFuentesExternass === null) {
			if ($this->isNew()) {
			   $this->collFuentesExternass = array();
			} else {

				$criteria->add(FuentesExternasPeer::FUE_SOL_ID, $this->getSolId());

				FuentesExternasPeer::addSelectColumns($criteria);
				$this->collFuentesExternass = FuentesExternasPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(FuentesExternasPeer::FUE_SOL_ID, $this->getSolId());

				FuentesExternasPeer::addSelectColumns($criteria);
				if (!isset($this->lastFuentesExternasCriteria) || !$this->lastFuentesExternasCriteria->equals($criteria)) {
					$this->collFuentesExternass = FuentesExternasPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastFuentesExternasCriteria = $criteria;
		return $this->collFuentesExternass;
	}

	
	public function countFuentesExternass($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseFuentesExternasPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(FuentesExternasPeer::FUE_SOL_ID, $this->getSolId());

		return FuentesExternasPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addFuentesExternas(FuentesExternas $l)
	{
		$this->collFuentesExternass[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initPresupuestoEgresoss()
	{
		if ($this->collPresupuestoEgresoss === null) {
			$this->collPresupuestoEgresoss = array();
		}
	}

	
	public function getPresupuestoEgresoss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BasePresupuestoEgresosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collPresupuestoEgresoss === null) {
			if ($this->isNew()) {
			   $this->collPresupuestoEgresoss = array();
			} else {

				$criteria->add(PresupuestoEgresosPeer::PEG_SOL_ID, $this->getSolId());

				PresupuestoEgresosPeer::addSelectColumns($criteria);
				$this->collPresupuestoEgresoss = PresupuestoEgresosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(PresupuestoEgresosPeer::PEG_SOL_ID, $this->getSolId());

				PresupuestoEgresosPeer::addSelectColumns($criteria);
				if (!isset($this->lastPresupuestoEgresosCriteria) || !$this->lastPresupuestoEgresosCriteria->equals($criteria)) {
					$this->collPresupuestoEgresoss = PresupuestoEgresosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastPresupuestoEgresosCriteria = $criteria;
		return $this->collPresupuestoEgresoss;
	}

	
	public function countPresupuestoEgresoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BasePresupuestoEgresosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(PresupuestoEgresosPeer::PEG_SOL_ID, $this->getSolId());

		return PresupuestoEgresosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addPresupuestoEgresos(PresupuestoEgresos $l)
	{
		$this->collPresupuestoEgresoss[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initConceptoGastoss()
	{
		if ($this->collConceptoGastoss === null) {
			$this->collConceptoGastoss = array();
		}
	}

	
	public function getConceptoGastoss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseConceptoGastosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collConceptoGastoss === null) {
			if ($this->isNew()) {
			   $this->collConceptoGastoss = array();
			} else {

				$criteria->add(ConceptoGastosPeer::COG_SOL_ID, $this->getSolId());

				ConceptoGastosPeer::addSelectColumns($criteria);
				$this->collConceptoGastoss = ConceptoGastosPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ConceptoGastosPeer::COG_SOL_ID, $this->getSolId());

				ConceptoGastosPeer::addSelectColumns($criteria);
				if (!isset($this->lastConceptoGastosCriteria) || !$this->lastConceptoGastosCriteria->equals($criteria)) {
					$this->collConceptoGastoss = ConceptoGastosPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastConceptoGastosCriteria = $criteria;
		return $this->collConceptoGastoss;
	}

	
	public function countConceptoGastoss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseConceptoGastosPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(ConceptoGastosPeer::COG_SOL_ID, $this->getSolId());

		return ConceptoGastosPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addConceptoGastos(ConceptoGastos $l)
	{
		$this->collConceptoGastoss[] = $l;
		$l->setSolicitud($this);
	}

	
	public function initHistoricoAnalisiss()
	{
		if ($this->collHistoricoAnalisiss === null) {
			$this->collHistoricoAnalisiss = array();
		}
	}

	
	public function getHistoricoAnalisiss($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricoAnalisisPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistoricoAnalisiss === null) {
			if ($this->isNew()) {
			   $this->collHistoricoAnalisiss = array();
			} else {

				$criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->getSolId());

				HistoricoAnalisisPeer::addSelectColumns($criteria);
				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->getSolId());

				HistoricoAnalisisPeer::addSelectColumns($criteria);
				if (!isset($this->lastHistoricoAnalisisCriteria) || !$this->lastHistoricoAnalisisCriteria->equals($criteria)) {
					$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastHistoricoAnalisisCriteria = $criteria;
		return $this->collHistoricoAnalisiss;
	}

	
	public function countHistoricoAnalisiss($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricoAnalisisPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->getSolId());

		return HistoricoAnalisisPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHistoricoAnalisis(HistoricoAnalisis $l)
	{
		$this->collHistoricoAnalisiss[] = $l;
		$l->setSolicitud($this);
	}


	
	public function getHistoricoAnalisissJoinUsuario($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseHistoricoAnalisisPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collHistoricoAnalisiss === null) {
			if ($this->isNew()) {
				$this->collHistoricoAnalisiss = array();
			} else {

				$criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->getSolId());

				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelectJoinUsuario($criteria, $con);
			}
		} else {
									
			$criteria->add(HistoricoAnalisisPeer::HIA_SOLICITUD, $this->getSolId());

			if (!isset($this->lastHistoricoAnalisisCriteria) || !$this->lastHistoricoAnalisisCriteria->equals($criteria)) {
				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelectJoinUsuario($criteria, $con);
			}
		}
		$this->lastHistoricoAnalisisCriteria = $criteria;

		return $this->collHistoricoAnalisiss;
	}

} 