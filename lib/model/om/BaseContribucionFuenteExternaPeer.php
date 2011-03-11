<?php


abstract class BaseContribucionFuenteExternaPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'contribucion_fuente_externa';

	
	const CLASS_DEFAULT = 'lib.model.ContribucionFuenteExterna';

	
	const NUM_COLUMNS = 4;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const CFE_PIN_ID = 'contribucion_fuente_externa.CFE_PIN_ID';

	
	const CFE_FUE_ID = 'contribucion_fuente_externa.CFE_FUE_ID';

	
	const CFE_PERIODO = 'contribucion_fuente_externa.CFE_PERIODO';

	
	const CFE_VALOR = 'contribucion_fuente_externa.CFE_VALOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('CfePinId', 'CfeFueId', 'CfePeriodo', 'CfeValor', ),
		BasePeer::TYPE_COLNAME => array (ContribucionFuenteExternaPeer::CFE_PIN_ID, ContribucionFuenteExternaPeer::CFE_FUE_ID, ContribucionFuenteExternaPeer::CFE_PERIODO, ContribucionFuenteExternaPeer::CFE_VALOR, ),
		BasePeer::TYPE_FIELDNAME => array ('cfe_pin_id', 'cfe_fue_id', 'cfe_periodo', 'cfe_valor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('CfePinId' => 0, 'CfeFueId' => 1, 'CfePeriodo' => 2, 'CfeValor' => 3, ),
		BasePeer::TYPE_COLNAME => array (ContribucionFuenteExternaPeer::CFE_PIN_ID => 0, ContribucionFuenteExternaPeer::CFE_FUE_ID => 1, ContribucionFuenteExternaPeer::CFE_PERIODO => 2, ContribucionFuenteExternaPeer::CFE_VALOR => 3, ),
		BasePeer::TYPE_FIELDNAME => array ('cfe_pin_id' => 0, 'cfe_fue_id' => 1, 'cfe_periodo' => 2, 'cfe_valor' => 3, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ContribucionFuenteExternaMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ContribucionFuenteExternaMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ContribucionFuenteExternaPeer::getTableMap();
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
		return str_replace(ContribucionFuenteExternaPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ContribucionFuenteExternaPeer::CFE_PIN_ID);

		$criteria->addSelectColumn(ContribucionFuenteExternaPeer::CFE_FUE_ID);

		$criteria->addSelectColumn(ContribucionFuenteExternaPeer::CFE_PERIODO);

		$criteria->addSelectColumn(ContribucionFuenteExternaPeer::CFE_VALOR);

	}

	const COUNT = 'COUNT(contribucion_fuente_externa.CFE_PIN_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT contribucion_fuente_externa.CFE_PIN_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
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
		$objects = ContribucionFuenteExternaPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ContribucionFuenteExternaPeer::populateObjects(ContribucionFuenteExternaPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ContribucionFuenteExternaPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ContribucionFuenteExternaPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinPresupuestoIngresos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinFuentesExternas(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinPresupuestoIngresos(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContribucionFuenteExternaPeer::addSelectColumns($c);
		$startcol = (ContribucionFuenteExternaPeer::NUM_COLUMNS - ContribucionFuenteExternaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		PresupuestoIngresosPeer::addSelectColumns($c);

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContribucionFuenteExternaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PresupuestoIngresosPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getPresupuestoIngresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addContribucionFuenteExterna($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initContribucionFuenteExternas();
				$obj2->addContribucionFuenteExterna($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinFuentesExternas(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContribucionFuenteExternaPeer::addSelectColumns($c);
		$startcol = (ContribucionFuenteExternaPeer::NUM_COLUMNS - ContribucionFuenteExternaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		FuentesExternasPeer::addSelectColumns($c);

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContribucionFuenteExternaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FuentesExternasPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getFuentesExternas(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addContribucionFuenteExterna($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initContribucionFuenteExternas();
				$obj2->addContribucionFuenteExterna($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
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

		ContribucionFuenteExternaPeer::addSelectColumns($c);
		$startcol2 = (ContribucionFuenteExternaPeer::NUM_COLUMNS - ContribucionFuenteExternaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PresupuestoIngresosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PresupuestoIngresosPeer::NUM_COLUMNS;

		FuentesExternasPeer::addSelectColumns($c);
		$startcol4 = $startcol3 + FuentesExternasPeer::NUM_COLUMNS;

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContribucionFuenteExternaPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = PresupuestoIngresosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPresupuestoIngresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addContribucionFuenteExterna($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initContribucionFuenteExternas();
				$obj2->addContribucionFuenteExterna($obj1);
			}


					
			$omClass = FuentesExternasPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj3 = new $cls();
			$obj3->hydrate($rs, $startcol3);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj3 = $temp_obj1->getFuentesExternas(); 				if ($temp_obj3->getPrimaryKey() === $obj3->getPrimaryKey()) {
					$newObject = false;
					$temp_obj3->addContribucionFuenteExterna($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj3->initContribucionFuenteExternas();
				$obj3->addContribucionFuenteExterna($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAllExceptPresupuestoIngresos(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doCountJoinAllExceptFuentesExternas(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ContribucionFuenteExternaPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);

		$rs = ContribucionFuenteExternaPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinAllExceptPresupuestoIngresos(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContribucionFuenteExternaPeer::addSelectColumns($c);
		$startcol2 = (ContribucionFuenteExternaPeer::NUM_COLUMNS - ContribucionFuenteExternaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		FuentesExternasPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + FuentesExternasPeer::NUM_COLUMNS;

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_FUE_ID, FuentesExternasPeer::FUE_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContribucionFuenteExternaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = FuentesExternasPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getFuentesExternas(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addContribucionFuenteExterna($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initContribucionFuenteExternas();
				$obj2->addContribucionFuenteExterna($obj1);
			}

			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doSelectJoinAllExceptFuentesExternas(Criteria $c, $con = null)
	{
		$c = clone $c;

								if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ContribucionFuenteExternaPeer::addSelectColumns($c);
		$startcol2 = (ContribucionFuenteExternaPeer::NUM_COLUMNS - ContribucionFuenteExternaPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		PresupuestoIngresosPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + PresupuestoIngresosPeer::NUM_COLUMNS;

		$c->addJoin(ContribucionFuenteExternaPeer::CFE_PIN_ID, PresupuestoIngresosPeer::PIN_ID);


		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ContribucionFuenteExternaPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = PresupuestoIngresosPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2  = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getPresupuestoIngresos(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addContribucionFuenteExterna($obj1);
					break;
				}
			}

			if ($newObject) {
				$obj2->initContribucionFuenteExternas();
				$obj2->addContribucionFuenteExterna($obj1);
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
		return ContribucionFuenteExternaPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ContribucionFuenteExternaPeer::CFE_PIN_ID);
			$selectCriteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $criteria->remove(ContribucionFuenteExternaPeer::CFE_PIN_ID), $comparison);

			$comparison = $criteria->getComparison(ContribucionFuenteExternaPeer::CFE_FUE_ID);
			$selectCriteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $criteria->remove(ContribucionFuenteExternaPeer::CFE_FUE_ID), $comparison);

			$comparison = $criteria->getComparison(ContribucionFuenteExternaPeer::CFE_PERIODO);
			$selectCriteria->add(ContribucionFuenteExternaPeer::CFE_PERIODO, $criteria->remove(ContribucionFuenteExternaPeer::CFE_PERIODO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ContribucionFuenteExternaPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ContribucionFuenteExternaPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ContribucionFuenteExterna) {

			$criteria = $values->buildPkeyCriteria();
		} else {
						$criteria = new Criteria(self::DATABASE_NAME);
												if(count($values) == count($values, COUNT_RECURSIVE))
			{
								$values = array($values);
			}
			$vals = array();
			foreach($values as $value)
			{

				$vals[0][] = $value[0];
				$vals[1][] = $value[1];
				$vals[2][] = $value[2];
			}

			$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $vals[0], Criteria::IN);
			$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $vals[1], Criteria::IN);
			$criteria->add(ContribucionFuenteExternaPeer::CFE_PERIODO, $vals[2], Criteria::IN);
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

	
	public static function doValidate(ContribucionFuenteExterna $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ContribucionFuenteExternaPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ContribucionFuenteExternaPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ContribucionFuenteExternaPeer::DATABASE_NAME, ContribucionFuenteExternaPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ContribucionFuenteExternaPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $cfe_pin_id, $cfe_fue_id, $cfe_periodo, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ContribucionFuenteExternaPeer::CFE_PIN_ID, $cfe_pin_id);
		$criteria->add(ContribucionFuenteExternaPeer::CFE_FUE_ID, $cfe_fue_id);
		$criteria->add(ContribucionFuenteExternaPeer::CFE_PERIODO, $cfe_periodo);
		$v = ContribucionFuenteExternaPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseContribucionFuenteExternaPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ContribucionFuenteExternaMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ContribucionFuenteExternaMapBuilder');
}
