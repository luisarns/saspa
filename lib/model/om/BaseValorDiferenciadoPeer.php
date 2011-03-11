<?php


abstract class BaseValorDiferenciadoPeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'valor_diferenciado';

	
	const CLASS_DEFAULT = 'lib.model.ValorDiferenciado';

	
	const NUM_COLUMNS = 3;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const VAD_ING_ID = 'valor_diferenciado.VAD_ING_ID';

	
	const VAD_PERIODO = 'valor_diferenciado.VAD_PERIODO';

	
	const VAD_VALOR = 'valor_diferenciado.VAD_VALOR';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('VadIngId', 'VadPeriodo', 'VadValor', ),
		BasePeer::TYPE_COLNAME => array (ValorDiferenciadoPeer::VAD_ING_ID, ValorDiferenciadoPeer::VAD_PERIODO, ValorDiferenciadoPeer::VAD_VALOR, ),
		BasePeer::TYPE_FIELDNAME => array ('vad_ing_id', 'vad_periodo', 'vad_valor', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('VadIngId' => 0, 'VadPeriodo' => 1, 'VadValor' => 2, ),
		BasePeer::TYPE_COLNAME => array (ValorDiferenciadoPeer::VAD_ING_ID => 0, ValorDiferenciadoPeer::VAD_PERIODO => 1, ValorDiferenciadoPeer::VAD_VALOR => 2, ),
		BasePeer::TYPE_FIELDNAME => array ('vad_ing_id' => 0, 'vad_periodo' => 1, 'vad_valor' => 2, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ValorDiferenciadoMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ValorDiferenciadoMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ValorDiferenciadoPeer::getTableMap();
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
		return str_replace(ValorDiferenciadoPeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ValorDiferenciadoPeer::VAD_ING_ID);

		$criteria->addSelectColumn(ValorDiferenciadoPeer::VAD_PERIODO);

		$criteria->addSelectColumn(ValorDiferenciadoPeer::VAD_VALOR);

	}

	const COUNT = 'COUNT(valor_diferenciado.VAD_ING_ID)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT valor_diferenciado.VAD_ING_ID)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ValorDiferenciadoPeer::doSelectRS($criteria, $con);
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
		$objects = ValorDiferenciadoPeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ValorDiferenciadoPeer::populateObjects(ValorDiferenciadoPeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ValorDiferenciadoPeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ValorDiferenciadoPeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}

	
	public static function doCountJoinInformacionGeneral(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ValorDiferenciadoPeer::VAD_ING_ID, InformacionGeneralPeer::ING_ID);

		$rs = ValorDiferenciadoPeer::doSelectRS($criteria, $con);
		if ($rs->next()) {
			return $rs->getInt(1);
		} else {
						return 0;
		}
	}


	
	public static function doSelectJoinInformacionGeneral(Criteria $c, $con = null)
	{
		$c = clone $c;

				if ($c->getDbName() == Propel::getDefaultDB()) {
			$c->setDbName(self::DATABASE_NAME);
		}

		ValorDiferenciadoPeer::addSelectColumns($c);
		$startcol = (ValorDiferenciadoPeer::NUM_COLUMNS - ValorDiferenciadoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;
		InformacionGeneralPeer::addSelectColumns($c);

		$c->addJoin(ValorDiferenciadoPeer::VAD_ING_ID, InformacionGeneralPeer::ING_ID);
		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ValorDiferenciadoPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);

			$omClass = InformacionGeneralPeer::getOMClass();

			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol);

			$newObject = true;
			foreach($results as $temp_obj1) {
				$temp_obj2 = $temp_obj1->getInformacionGeneral(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
										$temp_obj2->addValorDiferenciado($obj1); 					break;
				}
			}
			if ($newObject) {
				$obj2->initValorDiferenciados();
				$obj2->addValorDiferenciado($obj1); 			}
			$results[] = $obj1;
		}
		return $results;
	}


	
	public static function doCountJoinAll(Criteria $criteria, $distinct = false, $con = null)
	{
		$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ValorDiferenciadoPeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$criteria->addJoin(ValorDiferenciadoPeer::VAD_ING_ID, InformacionGeneralPeer::ING_ID);

		$rs = ValorDiferenciadoPeer::doSelectRS($criteria, $con);
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

		ValorDiferenciadoPeer::addSelectColumns($c);
		$startcol2 = (ValorDiferenciadoPeer::NUM_COLUMNS - ValorDiferenciadoPeer::NUM_LAZY_LOAD_COLUMNS) + 1;

		InformacionGeneralPeer::addSelectColumns($c);
		$startcol3 = $startcol2 + InformacionGeneralPeer::NUM_COLUMNS;

		$c->addJoin(ValorDiferenciadoPeer::VAD_ING_ID, InformacionGeneralPeer::ING_ID);

		$rs = BasePeer::doSelect($c, $con);
		$results = array();

		while($rs->next()) {

			$omClass = ValorDiferenciadoPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj1 = new $cls();
			$obj1->hydrate($rs);


					
			$omClass = InformacionGeneralPeer::getOMClass();


			$cls = Propel::import($omClass);
			$obj2 = new $cls();
			$obj2->hydrate($rs, $startcol2);

			$newObject = true;
			for ($j=0, $resCount=count($results); $j < $resCount; $j++) {
				$temp_obj1 = $results[$j];
				$temp_obj2 = $temp_obj1->getInformacionGeneral(); 				if ($temp_obj2->getPrimaryKey() === $obj2->getPrimaryKey()) {
					$newObject = false;
					$temp_obj2->addValorDiferenciado($obj1); 					break;
				}
			}

			if ($newObject) {
				$obj2->initValorDiferenciados();
				$obj2->addValorDiferenciado($obj1);
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
		return ValorDiferenciadoPeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ValorDiferenciadoPeer::VAD_ING_ID);
			$selectCriteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $criteria->remove(ValorDiferenciadoPeer::VAD_ING_ID), $comparison);

			$comparison = $criteria->getComparison(ValorDiferenciadoPeer::VAD_PERIODO);
			$selectCriteria->add(ValorDiferenciadoPeer::VAD_PERIODO, $criteria->remove(ValorDiferenciadoPeer::VAD_PERIODO), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ValorDiferenciadoPeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ValorDiferenciadoPeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ValorDiferenciado) {

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
			}

			$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $vals[0], Criteria::IN);
			$criteria->add(ValorDiferenciadoPeer::VAD_PERIODO, $vals[1], Criteria::IN);
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

	
	public static function doValidate(ValorDiferenciado $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ValorDiferenciadoPeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ValorDiferenciadoPeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ValorDiferenciadoPeer::DATABASE_NAME, ValorDiferenciadoPeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ValorDiferenciadoPeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $vad_ing_id, $vad_periodo, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ValorDiferenciadoPeer::VAD_ING_ID, $vad_ing_id);
		$criteria->add(ValorDiferenciadoPeer::VAD_PERIODO, $vad_periodo);
		$v = ValorDiferenciadoPeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseValorDiferenciadoPeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ValorDiferenciadoMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ValorDiferenciadoMapBuilder');
}
