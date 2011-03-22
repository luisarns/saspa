<?php


abstract class BaseMatriculaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'matricula_pregrado';

	
	const CLASS_DEFAULT = 'lib.model.Matricula';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const MAT_ID = 'matricula_pregrado.MAT_ID';

	
	const MAT_ANO = 'matricula_pregrado.MAT_ANO';

	
	const MAT_SEDE = 'matricula_pregrado.MAT_SEDE';

	
	const MAT_FACULTAD = 'matricula_pregrado.MAT_FACULTAD';

	
	const MAT_VALOR = 'matricula_pregrado.MAT_VALOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('MatId', 'MatAno', 'MatSede', 'MatFacultad', 'MatValor', ),
		BasePeer::TYPE_COLNAME => array (MatriculaPeer::MAT_ID, MatriculaPeer::MAT_ANO, MatriculaPeer::MAT_SEDE, MatriculaPeer::MAT_FACULTAD, MatriculaPeer::MAT_VALOR, ),
		BasePeer::TYPE_FIELDNAME => array ('mat_id', 'mat_ano', 'mat_sede', 'mat_facultad', 'mat_valor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('MatId' => 0, 'MatAno' => 1, 'MatSede' => 2, 'MatFacultad' => 3, 'MatValor' => 4, ),
		BasePeer::TYPE_COLNAME => array (MatriculaPeer::MAT_ID => 0, MatriculaPeer::MAT_ANO => 1, MatriculaPeer::MAT_SEDE => 2, MatriculaPeer::MAT_FACULTAD => 3, MatriculaPeer::MAT_VALOR => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('mat_id' => 0, 'mat_ano' => 1, 'mat_sede' => 2, 'mat_facultad' => 3, 'mat_valor' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/MatriculaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.MatriculaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = MatriculaPeer::getTableMap();
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
		return str_replace(MatriculaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(MatriculaPeer::MAT_ID);

		$criteria->addSelectColumn(MatriculaPeer::MAT_ANO);

		$criteria->addSelectColumn(MatriculaPeer::MAT_SEDE);

		$criteria->addSelectColumn(MatriculaPeer::MAT_FACULTAD);

		$criteria->addSelectColumn(MatriculaPeer::MAT_VALOR);

	}

	const COUNT = 'COUNT(matricula_pregrado.MAT_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT matricula_pregrado.MAT_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
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
		$objects = MatriculaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return MatriculaPeer::populateObjects(MatriculaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			MatriculaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = MatriculaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinSede(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFacultad(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinSede(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MatriculaPeer::addSelectColumns($c);
		$startcol = (MatriculaPeer::NUM_COLUMNS - MatriculaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		SedePeer::addSelectColumns($c);

		$c->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MatriculaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SedePeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getSede(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMatricula($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMatriculas();
				$obj2->addMatricula($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFacultad(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MatriculaPeer::addSelectColumns($c);
		$startcol = (MatriculaPeer::NUM_COLUMNS - MatriculaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FacultadPeer::addSelectColumns($c);

		$c->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MatriculaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FacultadPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFacultad(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addMatricula($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initMatriculas();
				$obj2->addMatricula($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);

		$criteria->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
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

		MatriculaPeer::addSelectColumns($c);
		$startcol2 = (MatriculaPeer::NUM_COLUMNS - MatriculaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SedePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SedePeer::NUM_COLUMNS;

		FacultadPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FacultadPeer::NUM_COLUMNS;

		$c->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);

		$c->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MatriculaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = SedePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSede(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMatricula($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initMatriculas();
				$obj2->addMatricula($obj1);
			}


					
			$omClass = FacultadPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFacultad(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addMatricula($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initMatriculas();
				$obj3->addMatricula($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptSede(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFacultad(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(MatriculaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(MatriculaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);

		$rs = MatriculaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptSede(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MatriculaPeer::addSelectColumns($c);
		$startcol2 = (MatriculaPeer::NUM_COLUMNS - MatriculaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FacultadPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FacultadPeer::NUM_COLUMNS;

		$c->addJoin(MatriculaPeer::MAT_FACULTAD, FacultadPeer::FAC_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MatriculaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FacultadPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFacultad(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMatricula($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMatriculas();
				$obj2->addMatricula($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFacultad(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		MatriculaPeer::addSelectColumns($c);
		$startcol2 = (MatriculaPeer::NUM_COLUMNS - MatriculaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		SedePeer::addSelectColumns($c);
		$startcol3 = $startcol2 + SedePeer::NUM_COLUMNS;

		$c->addJoin(MatriculaPeer::MAT_SEDE, SedePeer::SED_CODIGO);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = MatriculaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = SedePeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getSede(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addMatricula($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initMatriculas();
				$obj2->addMatricula($obj1);
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
		return MatriculaPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}

		$criteria->remove(MatriculaPeer::MAT_ID); 

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
			$comparison = $criteria->getComparison(MatriculaPeer::MAT_ID);
			$selectCriteria->add(MatriculaPeer::MAT_ID, $criteria->remove(MatriculaPeer::MAT_ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(MatriculaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(MatriculaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof Matricula) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(MatriculaPeer::MAT_ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(Matricula $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(MatriculaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(MatriculaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(MatriculaPeer::DATABASE_NAME, MatriculaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = MatriculaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(MatriculaPeer::DATABASE_NAME);

		$criteria->add(MatriculaPeer::MAT_ID, $pk);


		$v = MatriculaPeer::doSelect($criteria, $con);

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
			$criteria->add(MatriculaPeer::MAT_ID, $pks, Criteria::IN);
			$objs = MatriculaPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseMatriculaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/MatriculaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.MatriculaMapBuilder');
}
