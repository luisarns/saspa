<?php


abstract class BaseInversionesGastosGeneralesPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'inversiones_gastos_generales';

	
	const CLASS_DEFAULT = 'lib.model.InversionesGastosGenerales';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const IGG_PEG_ID = 'inversiones_gastos_generales.IGG_PEG_ID';

	
	const IGG_CONCEPTO = 'inversiones_gastos_generales.IGG_CONCEPTO';

	
	const IGG_PERIODO = 'inversiones_gastos_generales.IGG_PERIODO';

	
	const IGG_COSTO = 'inversiones_gastos_generales.IGG_COSTO';

	
	const ID = 'inversiones_gastos_generales.ID';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('IggPegId', 'IggConcepto', 'IggPeriodo', 'IggCosto', 'Id', ),
		BasePeer::TYPE_COLNAME => array (InversionesGastosGeneralesPeer::IGG_PEG_ID, InversionesGastosGeneralesPeer::IGG_CONCEPTO, InversionesGastosGeneralesPeer::IGG_PERIODO, InversionesGastosGeneralesPeer::IGG_COSTO, InversionesGastosGeneralesPeer::ID, ),
		BasePeer::TYPE_FIELDNAME => array ('igg_peg_id', 'igg_concepto', 'igg_periodo', 'igg_costo', 'id', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('IggPegId' => 0, 'IggConcepto' => 1, 'IggPeriodo' => 2, 'IggCosto' => 3, 'Id' => 4, ),
		BasePeer::TYPE_COLNAME => array (InversionesGastosGeneralesPeer::IGG_PEG_ID => 0, InversionesGastosGeneralesPeer::IGG_CONCEPTO => 1, InversionesGastosGeneralesPeer::IGG_PERIODO => 2, InversionesGastosGeneralesPeer::IGG_COSTO => 3, InversionesGastosGeneralesPeer::ID => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('igg_peg_id' => 0, 'igg_concepto' => 1, 'igg_periodo' => 2, 'igg_costo' => 3, 'id' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/InversionesGastosGeneralesMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.InversionesGastosGeneralesMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = InversionesGastosGeneralesPeer::getTableMap();
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
		return str_replace(InversionesGastosGeneralesPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(InversionesGastosGeneralesPeer::IGG_PEG_ID);

		$criteria->addSelectColumn(InversionesGastosGeneralesPeer::IGG_CONCEPTO);

		$criteria->addSelectColumn(InversionesGastosGeneralesPeer::IGG_PERIODO);

		$criteria->addSelectColumn(InversionesGastosGeneralesPeer::IGG_COSTO);

		$criteria->addSelectColumn(InversionesGastosGeneralesPeer::ID);

	}

	const COUNT = 'COUNT(inversiones_gastos_generales.ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT inversiones_gastos_generales.ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
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
		$objects = InversionesGastosGeneralesPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return InversionesGastosGeneralesPeer::populateObjects(InversionesGastosGeneralesPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			InversionesGastosGeneralesPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = InversionesGastosGeneralesPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPresupuestoEgresos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinConceptoGastos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPresupuestoEgresos(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InversionesGastosGeneralesPeer::addSelectColumns($c);
		$startcol = (InversionesGastosGeneralesPeer::NUM_COLUMNS - InversionesGastosGeneralesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PresupuestoEgresosPeer::addSelectColumns($c);

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InversionesGastosGeneralesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PresupuestoEgresosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPresupuestoEgresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInversionesGastosGenerales($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInversionesGastosGeneraless();
				$obj2->addInversionesGastosGenerales($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinConceptoGastos(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InversionesGastosGeneralesPeer::addSelectColumns($c);
		$startcol = (InversionesGastosGeneralesPeer::NUM_COLUMNS - InversionesGastosGeneralesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		ConceptoGastosPeer::addSelectColumns($c);

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InversionesGastosGeneralesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoGastosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getConceptoGastos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addInversionesGastosGenerales($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initInversionesGastosGeneraless();
				$obj2->addInversionesGastosGenerales($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
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

		InversionesGastosGeneralesPeer::addSelectColumns($c);
		$startcol2 = (InversionesGastosGeneralesPeer::NUM_COLUMNS - InversionesGastosGeneralesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PresupuestoEgresosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PresupuestoEgresosPeer::NUM_COLUMNS;

		ConceptoGastosPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + ConceptoGastosPeer::NUM_COLUMNS;

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InversionesGastosGeneralesPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PresupuestoEgresosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPresupuestoEgresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInversionesGastosGenerales($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initInversionesGastosGeneraless();
				$obj2->addInversionesGastosGenerales($obj1);
			}


					
			$omClass = ConceptoGastosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getConceptoGastos(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addInversionesGastosGenerales($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initInversionesGastosGeneraless();
				$obj3->addInversionesGastosGenerales($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPresupuestoEgresos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptConceptoGastos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(InversionesGastosGeneralesPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);

		$rs = InversionesGastosGeneralesPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPresupuestoEgresos(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InversionesGastosGeneralesPeer::addSelectColumns($c);
		$startcol2 = (InversionesGastosGeneralesPeer::NUM_COLUMNS - InversionesGastosGeneralesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		ConceptoGastosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + ConceptoGastosPeer::NUM_COLUMNS;

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_CONCEPTO, ConceptoGastosPeer::COG_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InversionesGastosGeneralesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = ConceptoGastosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getConceptoGastos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInversionesGastosGenerales($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInversionesGastosGeneraless();
				$obj2->addInversionesGastosGenerales($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptConceptoGastos(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		InversionesGastosGeneralesPeer::addSelectColumns($c);
		$startcol2 = (InversionesGastosGeneralesPeer::NUM_COLUMNS - InversionesGastosGeneralesPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PresupuestoEgresosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PresupuestoEgresosPeer::NUM_COLUMNS;

		$c->addJoin(InversionesGastosGeneralesPeer::IGG_PEG_ID, PresupuestoEgresosPeer::PEG_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = InversionesGastosGeneralesPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PresupuestoEgresosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPresupuestoEgresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addInversionesGastosGenerales($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initInversionesGastosGeneraless();
				$obj2->addInversionesGastosGenerales($obj1);
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
		return InversionesGastosGeneralesPeer::CLASS_DEFAULT;
	}

	
	public static function doInsert($values, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} else {
			$criteria = $values->buildCriteria(); 		}


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
			$comparison = $criteria->getComparison(InversionesGastosGeneralesPeer::ID);
			$selectCriteria->add(InversionesGastosGeneralesPeer::ID, $criteria->remove(InversionesGastosGeneralesPeer::ID), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(InversionesGastosGeneralesPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(InversionesGastosGeneralesPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof InversionesGastosGenerales) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
			$criteria->add(InversionesGastosGeneralesPeer::ID, (array) $values, Criteria::IN);
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

	
	public static function doValidate(InversionesGastosGenerales $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(InversionesGastosGeneralesPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(InversionesGastosGeneralesPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(InversionesGastosGeneralesPeer::DATABASE_NAME, InversionesGastosGeneralesPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = InversionesGastosGeneralesPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
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

		$criteria = new Criteria(InversionesGastosGeneralesPeer::DATABASE_NAME);

		$criteria->add(InversionesGastosGeneralesPeer::ID, $pk);


		$v = InversionesGastosGeneralesPeer::doSelect($criteria, $con);

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
			$criteria->add(InversionesGastosGeneralesPeer::ID, $pks, Criteria::IN);
			$objs = InversionesGastosGeneralesPeer::doSelect($criteria, $con);
		}
		return $objs;
	}

} 
if (Propel::isInit()) {
			try {
		BaseInversionesGastosGeneralesPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/InversionesGastosGeneralesMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.InversionesGastosGeneralesMapBuilder');
}
