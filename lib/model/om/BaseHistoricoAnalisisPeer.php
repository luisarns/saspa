<?php


abstract class BaseHistoricoAnalisisPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'historico_analisis';

	
	const CLASS_DEFAULT = 'lib.model.HistoricoAnalisis';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const HIA_ESTADO = 'historico_analisis.HIA_ESTADO';

	
	const HIA_SOLICITUD = 'historico_analisis.HIA_SOLICITUD';

	
	const HIA_USUARIO = 'historico_analisis.HIA_USUARIO';

	
	const CREATED_AT = 'historico_analisis.CREATED_AT';

	
	const ID = 'historico_analisis.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('HiaEstado', 'HiaSolicitud', 'HiaUsuario', 'CreatedAt', 'Id', ),
		BasePeer::TYPE_COLNAME => array (HistoricoAnalisisPeer::HIA_ESTADO, HistoricoAnalisisPeer::HIA_SOLICITUD, HistoricoAnalisisPeer::HIA_USUARIO, HistoricoAnalisisPeer::CREATED_AT, HistoricoAnalisisPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('hia_estado', 'hia_solicitud', 'hia_usuario', 'created_at', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('HiaEstado' => 0, 'HiaSolicitud' => 1, 'HiaUsuario' => 2, 'CreatedAt' => 3, 'Id' => 4, ),
		BasePeer::TYPE_COLNAME => array (HistoricoAnalisisPeer::HIA_ESTADO => 0, HistoricoAnalisisPeer::HIA_SOLICITUD => 1, HistoricoAnalisisPeer::HIA_USUARIO => 2, HistoricoAnalisisPeer::CREATED_AT => 3, HistoricoAnalisisPeer::ID => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('hia_estado' => 0, 'hia_solicitud' => 1, 'hia_usuario' => 2, 'created_at' => 3, 'id' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/HistoricoAnalisisMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.HistoricoAnalisisMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = HistoricoAnalisisPeer::getTableMap();
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
		return str_replace(HistoricoAnalisisPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(HistoricoAnalisisPeer::HIA_ESTADO);

		$criteria->addSelectColumn(HistoricoAnalisisPeer::HIA_SOLICITUD);

		$criteria->addSelectColumn(HistoricoAnalisisPeer::HIA_USUARIO);

		$criteria->addSelectColumn(HistoricoAnalisisPeer::CREATED_AT);

		$criteria->addSelectColumn(HistoricoAnalisisPeer::ID);

	}

	const COUNT = 'COUNT(historico_analisis.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT historico_analisis.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
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
		$objects = HistoricoAnalisisPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return HistoricoAnalisisPeer::populateObjects(HistoricoAnalisisPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			HistoricoAnalisisPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = HistoricoAnalisisPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSolicitud(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSolicitud(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HistoricoAnalisisPeer::addSelectColumns($c);
		$startcol = (HistoricoAnalisisPeer::NUM_COLUMNS - HistoricoAnalisisPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SolicitudPeer::addSelectColumns($c);

		$c->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HistoricoAnalisisPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SolicitudPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSolicitud(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addHistoricoAnalisis($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHistoricoAnalisiss();
				$obj2->addHistoricoAnalisis($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HistoricoAnalisisPeer::addSelectColumns($c);
		$startcol = (HistoricoAnalisisPeer::NUM_COLUMNS - HistoricoAnalisisPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		UsuarioPeer::addSelectColumns($c);

		$c->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HistoricoAnalisisPeer::getOMClass();

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
										$temp_obj2->addHistoricoAnalisis($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initHistoricoAnalisiss();
				$obj2->addHistoricoAnalisis($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
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

		HistoricoAnalisisPeer::addSelectColumns($c);
		$startcol2 = (HistoricoAnalisisPeer::NUM_COLUMNS - HistoricoAnalisisPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		UsuarioPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);

		$c->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HistoricoAnalisisPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SolicitudPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSolicitud(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHistoricoAnalisis($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initHistoricoAnalisiss();
				$obj2->addHistoricoAnalisis($obj1);
			}


					
			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getUsuario(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addHistoricoAnalisis($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initHistoricoAnalisiss();
				$obj3->addHistoricoAnalisis($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSolicitud(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptUsuario(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(HistoricoAnalisisPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);

		$rs = HistoricoAnalisisPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSolicitud(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HistoricoAnalisisPeer::addSelectColumns($c);
		$startcol2 = (HistoricoAnalisisPeer::NUM_COLUMNS - HistoricoAnalisisPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		UsuarioPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + UsuarioPeer::NUM_COLUMNS;

		$c->addJoin(HistoricoAnalisisPeer::HIA_USUARIO, UsuarioPeer::USU_IDENTIFICADOR);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HistoricoAnalisisPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = UsuarioPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getUsuario(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHistoricoAnalisis($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHistoricoAnalisiss();
				$obj2->addHistoricoAnalisis($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptUsuario(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		HistoricoAnalisisPeer::addSelectColumns($c);
		$startcol2 = (HistoricoAnalisisPeer::NUM_COLUMNS - HistoricoAnalisisPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SolicitudPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SolicitudPeer::NUM_COLUMNS;

		$c->addJoin(HistoricoAnalisisPeer::HIA_SOLICITUD, SolicitudPeer::SOL_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = HistoricoAnalisisPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SolicitudPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSolicitud(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addHistoricoAnalisis($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initHistoricoAnalisiss();
				$obj2->addHistoricoAnalisis($obj1);
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
		return HistoricoAnalisisPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(HistoricoAnalisisPeer::ID); 

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
			$comparison = $criteria->getComparison(HistoricoAnalisisPeer::ID);
			$selectCriteria->add(HistoricoAnalisisPeer::ID, $criteria->remove(HistoricoAnalisisPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(HistoricoAnalisisPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(HistoricoAnalisisPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof HistoricoAnalisis) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(HistoricoAnalisisPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(HistoricoAnalisis $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(HistoricoAnalisisPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(HistoricoAnalisisPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(HistoricoAnalisisPeer::DATABASE_NAME, HistoricoAnalisisPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = HistoricoAnalisisPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(HistoricoAnalisisPeer::DATABASE_NAME);

		$criteria->add(HistoricoAnalisisPeer::ID, $pk);


		$v = HistoricoAnalisisPeer::doSelect($criteria, $con);

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
			$criteria->add(HistoricoAnalisisPeer::ID, $pks, Criteria::IN);
			$objs = HistoricoAnalisisPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseHistoricoAnalisisPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/HistoricoAnalisisMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.HistoricoAnalisisMapBuilder');
}
