<?php


abstract class BaseUsuario extends BaseObject  implements Persistent {


	
	protected static $peer;


	
	protected $usu_identificador;


	
	protected $usu_contrasena;


	
	protected $usu_nombre;


	
	protected $usu_apellidos;


	
	protected $usu_estado;


	
	protected $usu_rol;

	
	protected $aRol;

	
	protected $collSolicituds;

	
	protected $lastSolicitudCriteria = null;

	
	protected $collComentarios;

	
	protected $lastComentarioCriteria = null;

	
	protected $collHistoricoAnalisiss;

	
	protected $lastHistoricoAnalisisCriteria = null;

	
	protected $alreadyInSave = false;

	
	protected $alreadyInValidation = false;

	
	public function getUsuIdentificador()
	{

		return $this->usu_identificador;
	}

	
	public function getUsuContrasena()
	{

		return $this->usu_contrasena;
	}

	
	public function getUsuNombre()
	{

		return $this->usu_nombre;
	}

	
	public function getUsuApellidos()
	{

		return $this->usu_apellidos;
	}

	
	public function getUsuEstado()
	{

		return $this->usu_estado;
	}

	
	public function getUsuRol()
	{

		return $this->usu_rol;
	}

	
	public function setUsuIdentificador($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_identificador !== $v) {
			$this->usu_identificador = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_IDENTIFICADOR;
		}

	} 
	
	public function setUsuContrasena($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_contrasena !== $v) {
			$this->usu_contrasena = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_CONTRASENA;
		}

	} 
	
	public function setUsuNombre($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_nombre !== $v) {
			$this->usu_nombre = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_NOMBRE;
		}

	} 
	
	public function setUsuApellidos($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_apellidos !== $v) {
			$this->usu_apellidos = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_APELLIDOS;
		}

	} 
	
	public function setUsuEstado($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_estado !== $v) {
			$this->usu_estado = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_ESTADO;
		}

	} 
	
	public function setUsuRol($v)
	{

						if ($v !== null && !is_string($v)) {
			$v = (string) $v; 
		}

		if ($this->usu_rol !== $v) {
			$this->usu_rol = $v;
			$this->modifiedColumns[] = UsuarioPeer::USU_ROL;
		}

		if ($this->aRol !== null && $this->aRol->getRolIdentificador() !== $v) {
			$this->aRol = null;
		}

	} 
	
	public function hydrate(ResultSet $rs, $startcol = 1)
	{
		try {

			$this->usu_identificador = $rs->getString($startcol + 0);

			$this->usu_contrasena = $rs->getString($startcol + 1);

			$this->usu_nombre = $rs->getString($startcol + 2);

			$this->usu_apellidos = $rs->getString($startcol + 3);

			$this->usu_estado = $rs->getString($startcol + 4);

			$this->usu_rol = $rs->getString($startcol + 5);

			$this->resetModified();

			$this->setNew(false);

						return $startcol + 6; 
		} catch (Exception $e) {
			throw new PropelException("Error populating Usuario object", $e);
		}
	}

	
	public function delete($con = null)
	{
		if ($this->isDeleted()) {
			throw new PropelException("This object has already been deleted.");
		}

		if ($con === null) {
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
		}

		try {
			$con->begin();
			UsuarioPeer::doDelete($this, $con);
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
			$con = Propel::getConnection(UsuarioPeer::DATABASE_NAME);
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


												
			if ($this->aRol !== null) {
				if ($this->aRol->isModified()) {
					$affectedRows += $this->aRol->save($con);
				}
				$this->setRol($this->aRol);
			}


						if ($this->isModified()) {
				if ($this->isNew()) {
					$pk = UsuarioPeer::doInsert($this, $con);
					$affectedRows += 1; 										 										 
					$this->setNew(false);
				} else {
					$affectedRows += UsuarioPeer::doUpdate($this, $con);
				}
				$this->resetModified(); 			}

			if ($this->collSolicituds !== null) {
				foreach($this->collSolicituds as $referrerFK) {
					if (!$referrerFK->isDeleted()) {
						$affectedRows += $referrerFK->save($con);
					}
				}
			}

			if ($this->collComentarios !== null) {
				foreach($this->collComentarios as $referrerFK) {
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


												
			if ($this->aRol !== null) {
				if (!$this->aRol->validate($columns)) {
					$failureMap = array_merge($failureMap, $this->aRol->getValidationFailures());
				}
			}


			if (($retval = UsuarioPeer::doValidate($this, $columns)) !== true) {
				$failureMap = array_merge($failureMap, $retval);
			}


				if ($this->collSolicituds !== null) {
					foreach($this->collSolicituds as $referrerFK) {
						if (!$referrerFK->validate($columns)) {
							$failureMap = array_merge($failureMap, $referrerFK->getValidationFailures());
						}
					}
				}

				if ($this->collComentarios !== null) {
					foreach($this->collComentarios as $referrerFK) {
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
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->getByPosition($pos);
	}

	
	public function getByPosition($pos)
	{
		switch($pos) {
			case 0:
				return $this->getUsuIdentificador();
				break;
			case 1:
				return $this->getUsuContrasena();
				break;
			case 2:
				return $this->getUsuNombre();
				break;
			case 3:
				return $this->getUsuApellidos();
				break;
			case 4:
				return $this->getUsuEstado();
				break;
			case 5:
				return $this->getUsuRol();
				break;
			default:
				return null;
				break;
		} 	}

	
	public function toArray($keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);
		$result = array(
			$keys[0] => $this->getUsuIdentificador(),
			$keys[1] => $this->getUsuContrasena(),
			$keys[2] => $this->getUsuNombre(),
			$keys[3] => $this->getUsuApellidos(),
			$keys[4] => $this->getUsuEstado(),
			$keys[5] => $this->getUsuRol(),
		);
		return $result;
	}

	
	public function setByName($name, $value, $type = BasePeer::TYPE_PHPNAME)
	{
		$pos = UsuarioPeer::translateFieldName($name, $type, BasePeer::TYPE_NUM);
		return $this->setByPosition($pos, $value);
	}

	
	public function setByPosition($pos, $value)
	{
		switch($pos) {
			case 0:
				$this->setUsuIdentificador($value);
				break;
			case 1:
				$this->setUsuContrasena($value);
				break;
			case 2:
				$this->setUsuNombre($value);
				break;
			case 3:
				$this->setUsuApellidos($value);
				break;
			case 4:
				$this->setUsuEstado($value);
				break;
			case 5:
				$this->setUsuRol($value);
				break;
		} 	}

	
	public function fromArray($arr, $keyType = BasePeer::TYPE_PHPNAME)
	{
		$keys = UsuarioPeer::getFieldNames($keyType);

		if (array_key_exists($keys[0], $arr)) $this->setUsuIdentificador($arr[$keys[0]]);
		if (array_key_exists($keys[1], $arr)) $this->setUsuContrasena($arr[$keys[1]]);
		if (array_key_exists($keys[2], $arr)) $this->setUsuNombre($arr[$keys[2]]);
		if (array_key_exists($keys[3], $arr)) $this->setUsuApellidos($arr[$keys[3]]);
		if (array_key_exists($keys[4], $arr)) $this->setUsuEstado($arr[$keys[4]]);
		if (array_key_exists($keys[5], $arr)) $this->setUsuRol($arr[$keys[5]]);
	}

	
	public function buildCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		if ($this->isColumnModified(UsuarioPeer::USU_IDENTIFICADOR)) $criteria->add(UsuarioPeer::USU_IDENTIFICADOR, $this->usu_identificador);
		if ($this->isColumnModified(UsuarioPeer::USU_CONTRASENA)) $criteria->add(UsuarioPeer::USU_CONTRASENA, $this->usu_contrasena);
		if ($this->isColumnModified(UsuarioPeer::USU_NOMBRE)) $criteria->add(UsuarioPeer::USU_NOMBRE, $this->usu_nombre);
		if ($this->isColumnModified(UsuarioPeer::USU_APELLIDOS)) $criteria->add(UsuarioPeer::USU_APELLIDOS, $this->usu_apellidos);
		if ($this->isColumnModified(UsuarioPeer::USU_ESTADO)) $criteria->add(UsuarioPeer::USU_ESTADO, $this->usu_estado);
		if ($this->isColumnModified(UsuarioPeer::USU_ROL)) $criteria->add(UsuarioPeer::USU_ROL, $this->usu_rol);

		return $criteria;
	}

	
	public function buildPkeyCriteria()
	{
		$criteria = new Criteria(UsuarioPeer::DATABASE_NAME);

		$criteria->add(UsuarioPeer::USU_IDENTIFICADOR, $this->usu_identificador);

		return $criteria;
	}

	
	public function getPrimaryKey()
	{
		return $this->getUsuIdentificador();
	}

	
	public function setPrimaryKey($key)
	{
		$this->setUsuIdentificador($key);
	}

	
	public function copyInto($copyObj, $deepCopy = false)
	{

		$copyObj->setUsuContrasena($this->usu_contrasena);

		$copyObj->setUsuNombre($this->usu_nombre);

		$copyObj->setUsuApellidos($this->usu_apellidos);

		$copyObj->setUsuEstado($this->usu_estado);

		$copyObj->setUsuRol($this->usu_rol);


		if ($deepCopy) {
									$copyObj->setNew(false);

			foreach($this->getSolicituds() as $relObj) {
				$copyObj->addSolicitud($relObj->copy($deepCopy));
			}

			foreach($this->getComentarios() as $relObj) {
				$copyObj->addComentario($relObj->copy($deepCopy));
			}

			foreach($this->getHistoricoAnalisiss() as $relObj) {
				$copyObj->addHistoricoAnalisis($relObj->copy($deepCopy));
			}

		} 

		$copyObj->setNew(true);

		$copyObj->setUsuIdentificador(NULL); 
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
			self::$peer = new UsuarioPeer();
		}
		return self::$peer;
	}

	
	public function setRol($v)
	{


		if ($v === null) {
			$this->setUsuRol(NULL);
		} else {
			$this->setUsuRol($v->getRolIdentificador());
		}


		$this->aRol = $v;
	}


	
	public function getRol($con = null)
	{
		if ($this->aRol === null && (($this->usu_rol !== "" && $this->usu_rol !== null))) {
						include_once 'lib/model/om/BaseRolPeer.php';

			$this->aRol = RolPeer::retrieveByPK($this->usu_rol, $con);

			
		}
		return $this->aRol;
	}

	
	public function initSolicituds()
	{
		if ($this->collSolicituds === null) {
			$this->collSolicituds = array();
		}
	}

	
	public function getSolicituds($criteria = null, $con = null)
	{
				include_once 'lib/model/om/BaseSolicitudPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		if ($this->collSolicituds === null) {
			if ($this->isNew()) {
			   $this->collSolicituds = array();
			} else {

				$criteria->add(SolicitudPeer::SOL_USUARIO, $this->getUsuIdentificador());

				SolicitudPeer::addSelectColumns($criteria);
				$this->collSolicituds = SolicitudPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(SolicitudPeer::SOL_USUARIO, $this->getUsuIdentificador());

				SolicitudPeer::addSelectColumns($criteria);
				if (!isset($this->lastSolicitudCriteria) || !$this->lastSolicitudCriteria->equals($criteria)) {
					$this->collSolicituds = SolicitudPeer::doSelect($criteria, $con);
				}
			}
		}
		$this->lastSolicitudCriteria = $criteria;
		return $this->collSolicituds;
	}

	
	public function countSolicituds($criteria = null, $distinct = false, $con = null)
	{
				include_once 'lib/model/om/BaseSolicitudPeer.php';
		if ($criteria === null) {
			$criteria = new Criteria();
		}
		elseif ($criteria instanceof Criteria)
		{
			$criteria = clone $criteria;
		}

		$criteria->add(SolicitudPeer::SOL_USUARIO, $this->getUsuIdentificador());

		return SolicitudPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addSolicitud(Solicitud $l)
	{
		$this->collSolicituds[] = $l;
		$l->setUsuario($this);
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

				$criteria->add(ComentarioPeer::COM_USUARIO, $this->getUsuIdentificador());

				ComentarioPeer::addSelectColumns($criteria);
				$this->collComentarios = ComentarioPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(ComentarioPeer::COM_USUARIO, $this->getUsuIdentificador());

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

		$criteria->add(ComentarioPeer::COM_USUARIO, $this->getUsuIdentificador());

		return ComentarioPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addComentario(Comentario $l)
	{
		$this->collComentarios[] = $l;
		$l->setUsuario($this);
	}


	
	public function getComentariosJoinSolicitud($criteria = null, $con = null)
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

				$criteria->add(ComentarioPeer::COM_USUARIO, $this->getUsuIdentificador());

				$this->collComentarios = ComentarioPeer::doSelectJoinSolicitud($criteria, $con);
			}
		} else {
									
			$criteria->add(ComentarioPeer::COM_USUARIO, $this->getUsuIdentificador());

			if (!isset($this->lastComentarioCriteria) || !$this->lastComentarioCriteria->equals($criteria)) {
				$this->collComentarios = ComentarioPeer::doSelectJoinSolicitud($criteria, $con);
			}
		}
		$this->lastComentarioCriteria = $criteria;

		return $this->collComentarios;
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

				$criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->getUsuIdentificador());

				HistoricoAnalisisPeer::addSelectColumns($criteria);
				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelect($criteria, $con);
			}
		} else {
						if (!$this->isNew()) {
												

				$criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->getUsuIdentificador());

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

		$criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->getUsuIdentificador());

		return HistoricoAnalisisPeer::doCount($criteria, $distinct, $con);
	}

	
	public function addHistoricoAnalisis(HistoricoAnalisis $l)
	{
		$this->collHistoricoAnalisiss[] = $l;
		$l->setUsuario($this);
	}


	
	public function getHistoricoAnalisissJoinSolicitud($criteria = null, $con = null)
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

				$criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->getUsuIdentificador());

				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelectJoinSolicitud($criteria, $con);
			}
		} else {
									
			$criteria->add(HistoricoAnalisisPeer::HIA_USUARIO, $this->getUsuIdentificador());

			if (!isset($this->lastHistoricoAnalisisCriteria) || !$this->lastHistoricoAnalisisCriteria->equals($criteria)) {
				$this->collHistoricoAnalisiss = HistoricoAnalisisPeer::doSelectJoinSolicitud($criteria, $con);
			}
		}
		$this->lastHistoricoAnalisisCriteria = $criteria;

		return $this->collHistoricoAnalisiss;
	}

} 