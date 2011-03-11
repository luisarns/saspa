<?php


abstract class BaseSolicitudPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'solicitud';

	
	const CLASS_DEFAULT = 'lib.model.Solicitud';

	
	const NUM_COLUMNS = 9;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const SOL_ID = 'solicitud.SOL_ID';

	
	const SOL_NOMBRE = 'solicitud.SOL_NOMBRE';

	
	const SOL_ESCUELA = 'solicitud.SOL_ESCUELA';

	
	const SOL_FACULTAD = 'solicitud.SOL_FACULTAD';

	
	const SOL_ARCHIVO = 'solicitud.SOL_ARCHIVO';

	
	const SOL_ESTADO = 'solicitud.SOL_ESTADO';

	
	const SOL_USUARIO = 'solicitud.SOL_USUARIO';

	
	const CREATED_AT = 'solicitud.CREATED_AT';

	
	const UPDATED_AT = 'solicitud.UPDATED_AT';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('SolId', 'SolNombre', 'SolEscuela', 'SolFacultad', 'SolArchivo', 'SolEstado', 'SolUsuario', 'CreatedAt', 'UpdatedAt', ),
		BasePeer::TYPE_COLNAME => array (SolicitudPeer::SOL_ID, SolicitudPeer::SOL_NOMBRE, SolicitudPeer::SOL_ESCUELA, SolicitudPeer::SOL_FACULTAD, SolicitudPeer::SOL_ARCHIVO, SolicitudPeer::SOL_ESTADO, SolicitudPeer::SOL_USUARIO, SolicitudPeer::CREATED_AT, SolicitudPeer::UPDATED_AT, ),
		BasePeer::TYPE_FIELDNAME => array ('sol_id', 'sol_nombre', 'sol_escuela', 'sol_facultad', 'sol_archivo', 'sol_estado', 'sol_usuario', 'created_at', 'updated_at', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('SolId' => 0, 'SolNombre' => 1, 'SolEscuela' => 2, 'SolFacultad' => 3, 'SolArchivo' => 4, 'SolEstado' => 5, 'SolUsuario' => 6, 'CreatedAt' => 7, 'UpdatedAt' => 8, ),
		BasePeer::TYPE_COLNAME => array (SolicitudPeer::SOL_ID => 0, SolicitudPeer::SOL_NOMBRE => 1, SolicitudPeer::SOL_ESCUELA => 2, SolicitudPeer::SOL_FACULTAD => 3, SolicitudPeer::SOL_ARCHIVO => 4, SolicitudPeer::SOL_ESTADO => 5, SolicitudPeer::SOL_USUARIO => 6, SolicitudPeer::CREATED_AT => 7, SolicitudPeer::UPDATED_AT => 8, ),
		BasePeer::TYPE_FIELDNAME => array ('sol_id' => 0, 'sol_nombre' => 1, 'sol_escuela' => 2, 'sol_facultad' => 3, 'sol_archivo' => 4, 'sol_estado' => 5, 'sol_usuario' => 6, 'created_at' => 7, 'updated_at' => 8, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, 5, 6, 7, 8, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/SolicitudMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.SolicitudMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = SolicitudPeer::getTableMap();
			$columns = $map->getColumns();
			$nameMap = array();
			foreach ($columns as $column) {
				$nameMap[$column->getPhpName()] = $column->getColumnName();
			}
			self::$phpNameMap = $nameMap;
		}
		return self::$phpNameMap;
	}
	
	static public function translateFieldName($name, $fromType, $toType)
	{
		$toNames = self::getFieldNames($toType);
		$key = isset(self::$fieldKeys[$fromType][$name]) ? self::$fieldKeys[$fromType][$name] : null;
		if ($key === null) {
			throw new PropelException("'$name' could not be found in the field names of type '$fromType'. These are: " . print_r(self::$fieldKeys[$fromType], true));
		}
		return $toNames[$key];
	}

	

	static public function getFieldNames($type = BasePeer::TYPE_PHPNAME)
	{
		if (!array_key_exists($type, self::$fieldNames)) {
			throw new PropelException('Method getFieldNames() expects the parameter $type to be one of the class constants TYPE_PHPNAME, TYPE_COLNAME, TYPE_FIELDNAME, TYPE_NUM. ' . $type . ' was given.');
		}
		return self::$fieldNames[$type];
	}

	
	public static function alias($alias, $column)
	{
		return str_replace(SolicitudPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(SolicitudPeer::SOL_ID);

		$criteria->addSelectColumn(SolicitudPeer::SOL_NOMBRE);

		$criteria->addSelectColumn(SolicitudPeer::SOL_ESCUELA);

		$criteria->addSelectColumn(SolicitudPeer::SOL_FACULTAD);

		$criteria->addSelectColumn(SolicitudPeer::SOL_ARCHIVO);

		$criteria->addSelectColumn(SolicitudPeer::SOL_ESTADO);

		$criteria->addSelectColumn(SolicitudPeer::SOL_USUARIO);

		$criteria->addSelectColumn(SolicitudPeer::CREATED_AT);

		$criteria->addSelectColumn(SolicitudPeer::UPDATED_AT);

	}

	const COUNT = 'COUNT(solicitud.SOL_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT solicitud.SOL_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SolicitudPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SolicitudPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = SolicitudPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}
	
	public static function doSelectOne(Criteria $criteria, $con = null)
	{
		$critcopy = clone $criteria;
		$critcopy->setLimit(1);
		$objects = SolicitudPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return SolicitudPeer::populateObjects(SolicitudPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			SolicitudPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = SolicitudPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SolicitudPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SolicitudPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SolicitudPeer::SOL_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = SolicitudPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SolicitudPeer::addSelectColumns($c);
		$startcol = (SolicitudPeer::NUM_COLUMNS - SolicitudPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(SolicitudPeer::SOL_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SolicitudPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addSolicitud($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initSolicituds();
				$obj2->addSolicitud($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(SolicitudPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(SolicitudPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(SolicitudPeer::SOL_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = SolicitudPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAll(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		SolicitudPeer::addSelectColumns($c);
		$startcol2 = (SolicitudPeer::NUM_COLUMNS - SolicitudPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(SolicitudPeer::SOL_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = SolicitudPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addSolicitud($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initSolicituds();
				$obj2->addSolicitud($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}

	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return SolicitudPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(SolicitudPeer::SOL_ID); 

				$criteria->setDbName(self::DATABASE_NAME);

		try {
									$con->begin();
			$pk = BasePeer::doInsert($criteria, $con);
			$con->commit();
		} catch(PropelException $e) {
			$con->rollback();
			throw $e;
		}

		return $pk;
	}

	
	public static function doUpdate($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$selectCriteria = new Criteria(self::DATABASE_NAME);

		if ($values instanceof Criteria) {
			$criteria = clone $values; 
			$comparison = $criteria->getComparison(SolicitudPeer::SOL_ID);
			$selectCriteria->add(SolicitudPeer::SOL_ID, $criteria->remove(SolicitudPeer::SOL_ID), $comparison);

		} else { 			$criteria = $values->buildCriteria(); 			$selectCriteria = $values->buildPkeyCriteria(); 		}

				$criteria->setDbName(self::DATABASE_NAME);

		return BasePeer::doUpdate($selectCriteria, $criteria, $con);
	}

	
	public static function doDeleteAll($con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$affectedRows = 0; 		try {
									$con->begin();
			$affectedRows += BasePeer::doDeleteAll(SolicitudPeer::TABLE_NAME, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	 public static function doDelete($values, $con = null)
	 {
		if ($con === null) {
			$con = Propel::getConnection(SolicitudPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Solicitud) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(SolicitudPeer::SOL_ID, (array) $values, Criteria::IN);
		}

				$criteria->setDbName(self::DATABASE_NAME);

		$affectedRows = 0; 
		try {
									$con->begin();
			
			$affectedRows += BasePeer::doDelete($criteria, $con);
			$con->commit();
			return $affectedRows;
		} catch (PropelException $e) {
			$con->rollback();
			throw $e;
		}
	}

	
	public static function doValidate(Solicitud $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(SolicitudPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(SolicitudPeer::TABLE_NAME);

			if (! is_array($cols)) {
				$cols = array($cols);
			}

			foreach($cols as $colName) {
				if ($tableMap->containsColumn($colName)) {
					$get = 'get' . $tableMap->getColumn($colName)->getPhpName();
					$columns[$colName] = $obj->$get();
				}
			}
		} else {

		}

		$res =  BasePeer::doValidate(SolicitudPeer::DATABASE_NAME, SolicitudPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = SolicitudPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK($pk, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$criteria = new Criteria(SolicitudPeer::DATABASE_NAME);

		$criteria->add(SolicitudPeer::SOL_ID, $pk);


		$v = SolicitudPeer::doSelect($criteria, $con);

		return !empty($v) > 0 ? $v[0] : null;
	}

	
	public static function retrieveByPKs($pks, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		$objs = null;
		if (empty($pks)) {
			$objs = array();
		} else {
			$criteria = new Criteria();
			$criteria->add(SolicitudPeer::SOL_ID, $pks, Criteria::IN);
			$objs = SolicitudPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseSolicitudPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/SolicitudMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.SolicitudMapBuilder');
}
