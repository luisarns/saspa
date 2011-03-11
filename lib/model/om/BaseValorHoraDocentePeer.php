<?php


abstract class BaseValorHoraDocentePeer {

	
	const DATABASE_NAME = 'propel';

	
	const TABLE_NAME = 'valor_hora_docente';

	
	const CLASS_DEFAULT = 'lib.model.ValorHoraDocente';

	
	const NUM_COLUMNS = 5;

	
	const NUM_LAZY_LOAD_COLUMNS = 0;


	
	const VHD_NIVEL_PROGRAMA = 'valor_hora_docente.VHD_NIVEL_PROGRAMA';

	
	const VHD_CATEGORIA_DOCENTE = 'valor_hora_docente.VHD_CATEGORIA_DOCENTE';

	
	const NOMBRADO_BONIFICADO = 'valor_hora_docente.NOMBRADO_BONIFICADO';

	
	const NOMBRADO_CARGA_ACADEMICA = 'valor_hora_docente.NOMBRADO_CARGA_ACADEMICA';

	
	const HORA_CATEDRA = 'valor_hora_docente.HORA_CATEDRA';

	
	private static $phpNameMap = null;


	
	private static $fieldNames = array (
		BasePeer::TYPE_PHPNAME => array ('VhdNivelPrograma', 'VhdCategoriaDocente', 'NombradoBonificado', 'NombradoCargaAcademica', 'HoraCatedra', ),
		BasePeer::TYPE_COLNAME => array (ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, ValorHoraDocentePeer::NOMBRADO_BONIFICADO, ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA, ValorHoraDocentePeer::HORA_CATEDRA, ),
		BasePeer::TYPE_FIELDNAME => array ('vhd_nivel_programa', 'vhd_categoria_docente', 'nombrado_bonificado', 'nombrado_carga_academica', 'hora_catedra', ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	private static $fieldKeys = array (
		BasePeer::TYPE_PHPNAME => array ('VhdNivelPrograma' => 0, 'VhdCategoriaDocente' => 1, 'NombradoBonificado' => 2, 'NombradoCargaAcademica' => 3, 'HoraCatedra' => 4, ),
		BasePeer::TYPE_COLNAME => array (ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA => 0, ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE => 1, ValorHoraDocentePeer::NOMBRADO_BONIFICADO => 2, ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA => 3, ValorHoraDocentePeer::HORA_CATEDRA => 4, ),
		BasePeer::TYPE_FIELDNAME => array ('vhd_nivel_programa' => 0, 'vhd_categoria_docente' => 1, 'nombrado_bonificado' => 2, 'nombrado_carga_academica' => 3, 'hora_catedra' => 4, ),
		BasePeer::TYPE_NUM => array (0, 1, 2, 3, 4, )
	);

	
	public static function getMapBuilder()
	{
		include_once 'lib/model/map/ValorHoraDocenteMapBuilder.php';
		return BasePeer::getMapBuilder('lib.model.map.ValorHoraDocenteMapBuilder');
	}
	
	public static function getPhpNameMap()
	{
		if (self::$phpNameMap === null) {
			$map = ValorHoraDocentePeer::getTableMap();
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
		return str_replace(ValorHoraDocentePeer::TABLE_NAME.'.', $alias.'.', $column);
	}

	
	public static function addSelectColumns(Criteria $criteria)
	{

		$criteria->addSelectColumn(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA);

		$criteria->addSelectColumn(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE);

		$criteria->addSelectColumn(ValorHoraDocentePeer::NOMBRADO_BONIFICADO);

		$criteria->addSelectColumn(ValorHoraDocentePeer::NOMBRADO_CARGA_ACADEMICA);

		$criteria->addSelectColumn(ValorHoraDocentePeer::HORA_CATEDRA);

	}

	const COUNT = 'COUNT(valor_hora_docente.VHD_NIVEL_PROGRAMA)';
	const COUNT_DISTINCT = 'COUNT(DISTINCT valor_hora_docente.VHD_NIVEL_PROGRAMA)';

	
	public static function doCount(Criteria $criteria, $distinct = false, $con = null)
	{
				$criteria = clone $criteria;

				$criteria->clearSelectColumns()->clearOrderByColumns();
		if ($distinct || in_array(Criteria::DISTINCT, $criteria->getSelectModifiers())) {
			$criteria->addSelectColumn(ValorHoraDocentePeer::COUNT_DISTINCT);
		} else {
			$criteria->addSelectColumn(ValorHoraDocentePeer::COUNT);
		}

				foreach($criteria->getGroupByColumns() as $column)
		{
			$criteria->addSelectColumn($column);
		}

		$rs = ValorHoraDocentePeer::doSelectRS($criteria, $con);
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
		$objects = ValorHoraDocentePeer::doSelect($critcopy, $con);
		if ($objects) {
			return $objects[0];
		}
		return null;
	}
	
	public static function doSelect(Criteria $criteria, $con = null)
	{
		return ValorHoraDocentePeer::populateObjects(ValorHoraDocentePeer::doSelectRS($criteria, $con));
	}
	
	public static function doSelectRS(Criteria $criteria, $con = null)
	{
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}

		if (!$criteria->getSelectColumns()) {
			$criteria = clone $criteria;
			ValorHoraDocentePeer::addSelectColumns($criteria);
		}

				$criteria->setDbName(self::DATABASE_NAME);

						return BasePeer::doSelect($criteria, $con);
	}
	
	public static function populateObjects(ResultSet $rs)
	{
		$results = array();
	
				$cls = ValorHoraDocentePeer::getOMClass();
		$cls = Propel::import($cls);
				while($rs->next()) {
		
			$obj = new $cls();
			$obj->hydrate($rs);
			$results[] = $obj;
			
		}
		return $results;
	}
	
	public static function getTableMap()
	{
		return Propel::getDatabaseMap(self::DATABASE_NAME)->getTable(self::TABLE_NAME);
	}

	
	public static function getOMClass()
	{
		return ValorHoraDocentePeer::CLASS_DEFAULT;
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
			$comparison = $criteria->getComparison(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA);
			$selectCriteria->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $criteria->remove(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA), $comparison);

			$comparison = $criteria->getComparison(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE);
			$selectCriteria->add(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, $criteria->remove(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE), $comparison);

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
			$affectedRows += BasePeer::doDeleteAll(ValorHoraDocentePeer::TABLE_NAME, $con);
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
			$con = Propel::getConnection(ValorHoraDocentePeer::DATABASE_NAME);
		}

		if ($values instanceof Criteria) {
			$criteria = clone $values; 		} elseif ($values instanceof ValorHoraDocente) {

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

			$criteria->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $vals[0], Criteria::IN);
			$criteria->add(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, $vals[1], Criteria::IN);
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

	
	public static function doValidate(ValorHoraDocente $obj, $cols = null)
	{
		$columns = array();

		if ($cols) {
			$dbMap = Propel::getDatabaseMap(ValorHoraDocentePeer::DATABASE_NAME);
			$tableMap = $dbMap->getTable(ValorHoraDocentePeer::TABLE_NAME);

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

		$res =  BasePeer::doValidate(ValorHoraDocentePeer::DATABASE_NAME, ValorHoraDocentePeer::TABLE_NAME, $columns);
    if ($res !== true) {
        $request = sfContext::getInstance()->getRequest();
        foreach ($res as $failed) {
            $col = ValorHoraDocentePeer::translateFieldname($failed->getColumn(), BasePeer::TYPE_COLNAME, BasePeer::TYPE_PHPNAME);
            $request->setError($col, $failed->getMessage());
        }
    }

    return $res;
	}

	
	public static function retrieveByPK( $vhd_nivel_programa, $vhd_categoria_docente, $con = null) {
		if ($con === null) {
			$con = Propel::getConnection(self::DATABASE_NAME);
		}
		$criteria = new Criteria();
		$criteria->add(ValorHoraDocentePeer::VHD_NIVEL_PROGRAMA, $vhd_nivel_programa);
		$criteria->add(ValorHoraDocentePeer::VHD_CATEGORIA_DOCENTE, $vhd_categoria_docente);
		$v = ValorHoraDocentePeer::doSelect($criteria, $con);

		return !empty($v) ? $v[0] : null;
	}
} 
if (Propel::isInit()) {
			try {
		BaseValorHoraDocentePeer::getMapBuilder();
	} catch (Exception $e) {
		Propel::log('Could not initialize Peer: ' . $e->getMessage(), Propel::LOG_ERR);
	}
} else {
			require_once 'lib/model/map/ValorHoraDocenteMapBuilder.php';
	Propel::registerMapBuilder('lib.model.map.ValorHoraDocenteMapBuilder');
}
