<?php

namespace Map;

use \Animals;
use \AnimalsQuery;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\InstancePoolTrait;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\DataFetcher\DataFetcherInterface;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\RelationMap;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Map\TableMapTrait;


/**
 * This class defines the structure of the 'animals' table.
 *
 *
 *
 * This map class is used by Propel to do runtime db structure discovery.
 * For example, the createSelectSql() method checks the type of a given column used in an
 * ORDER BY clause to know whether it needs to apply SQL to make the ORDER BY case-insensitive
 * (i.e. if it's a text column type).
 *
 */
class AnimalsTableMap extends TableMap
{
    use InstancePoolTrait;
    use TableMapTrait;

    /**
     * The (dot-path) name of this class
     */
    const CLASS_NAME = '.Map.AnimalsTableMap';

    /**
     * The default database name for this class
     */
    const DATABASE_NAME = 'default';

    /**
     * The table name for this class
     */
    const TABLE_NAME = 'animals';

    /**
     * The related Propel class for this table
     */
    const OM_CLASS = '\\Animals';

    /**
     * A class that can be returned by this tableMap
     */
    const CLASS_DEFAULT = 'Animals';

    /**
     * The total number of columns
     */
    const NUM_COLUMNS = 12;

    /**
     * The number of lazy-loaded columns
     */
    const NUM_LAZY_LOAD_COLUMNS = 0;

    /**
     * The number of columns to hydrate (NUM_COLUMNS - NUM_LAZY_LOAD_COLUMNS)
     */
    const NUM_HYDRATE_COLUMNS = 12;

    /**
     * the column name for the animal field
     */
    const COL_ANIMAL = 'animals.animal';

    /**
     * the column name for the name field
     */
    const COL_NAME = 'animals.name';

    /**
     * the column name for the birthDay field
     */
    const COL_BIRTHDAY = 'animals.birthDay';

    /**
     * the column name for the sex field
     */
    const COL_SEX = 'animals.sex';

    /**
     * the column name for the furColour field
     */
    const COL_FURCOLOUR = 'animals.furColour';

    /**
     * the column name for the eyeColour field
     */
    const COL_EYECOLOUR = 'animals.eyeColour';

    /**
     * the column name for the species field
     */
    const COL_SPECIES = 'animals.species';

    /**
     * the column name for the size field
     */
    const COL_SIZE = 'animals.size';

    /**
     * the column name for the specification field
     */
    const COL_SPECIFICATION = 'animals.specification';

    /**
     * the column name for the race field
     */
    const COL_RACE = 'animals.race';

    /**
     * the column name for the test field
     */
    const COL_TEST = 'animals.test';

    /**
     * the column name for the blah field
     */
    const COL_BLAH = 'animals.blah';

    /**
     * The default string format for model objects of the related table
     */
    const DEFAULT_STRING_FORMAT = 'YAML';

    /**
     * holds an array of fieldnames
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldNames[self::TYPE_PHPNAME][0] = 'Id'
     */
    protected static $fieldNames = array (
        self::TYPE_PHPNAME       => array('Animal', 'Name', 'Birthday', 'Sex', 'Furcolour', 'Eyecolour', 'Species', 'Size', 'Specification', 'Race', 'Test', 'Blah', ),
        self::TYPE_CAMELNAME     => array('animal', 'name', 'birthday', 'sex', 'furcolour', 'eyecolour', 'species', 'size', 'specification', 'race', 'test', 'blah', ),
        self::TYPE_COLNAME       => array(AnimalsTableMap::COL_ANIMAL, AnimalsTableMap::COL_NAME, AnimalsTableMap::COL_BIRTHDAY, AnimalsTableMap::COL_SEX, AnimalsTableMap::COL_FURCOLOUR, AnimalsTableMap::COL_EYECOLOUR, AnimalsTableMap::COL_SPECIES, AnimalsTableMap::COL_SIZE, AnimalsTableMap::COL_SPECIFICATION, AnimalsTableMap::COL_RACE, AnimalsTableMap::COL_TEST, AnimalsTableMap::COL_BLAH, ),
        self::TYPE_FIELDNAME     => array('animal', 'name', 'birthDay', 'sex', 'furColour', 'eyeColour', 'species', 'size', 'specification', 'race', 'test', 'blah', ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * holds an array of keys for quick access to the fieldnames array
     *
     * first dimension keys are the type constants
     * e.g. self::$fieldKeys[self::TYPE_PHPNAME]['Id'] = 0
     */
    protected static $fieldKeys = array (
        self::TYPE_PHPNAME       => array('Animal' => 0, 'Name' => 1, 'Birthday' => 2, 'Sex' => 3, 'Furcolour' => 4, 'Eyecolour' => 5, 'Species' => 6, 'Size' => 7, 'Specification' => 8, 'Race' => 9, 'Test' => 10, 'Blah' => 11, ),
        self::TYPE_CAMELNAME     => array('animal' => 0, 'name' => 1, 'birthday' => 2, 'sex' => 3, 'furcolour' => 4, 'eyecolour' => 5, 'species' => 6, 'size' => 7, 'specification' => 8, 'race' => 9, 'test' => 10, 'blah' => 11, ),
        self::TYPE_COLNAME       => array(AnimalsTableMap::COL_ANIMAL => 0, AnimalsTableMap::COL_NAME => 1, AnimalsTableMap::COL_BIRTHDAY => 2, AnimalsTableMap::COL_SEX => 3, AnimalsTableMap::COL_FURCOLOUR => 4, AnimalsTableMap::COL_EYECOLOUR => 5, AnimalsTableMap::COL_SPECIES => 6, AnimalsTableMap::COL_SIZE => 7, AnimalsTableMap::COL_SPECIFICATION => 8, AnimalsTableMap::COL_RACE => 9, AnimalsTableMap::COL_TEST => 10, AnimalsTableMap::COL_BLAH => 11, ),
        self::TYPE_FIELDNAME     => array('animal' => 0, 'name' => 1, 'birthDay' => 2, 'sex' => 3, 'furColour' => 4, 'eyeColour' => 5, 'species' => 6, 'size' => 7, 'specification' => 8, 'race' => 9, 'test' => 10, 'blah' => 11, ),
        self::TYPE_NUM           => array(0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, )
    );

    /**
     * Initialize the table attributes and columns
     * Relations are not initialized by this method since they are lazy loaded
     *
     * @return void
     * @throws PropelException
     */
    public function initialize()
    {
        // attributes
        $this->setName('animals');
        $this->setPhpName('Animals');
        $this->setIdentifierQuoting(false);
        $this->setClassName('\\Animals');
        $this->setPackage('');
        $this->setUseIdGenerator(true);
        // columns
        $this->addPrimaryKey('animal', 'Animal', 'INTEGER', true, null, null);
        $this->addColumn('name', 'Name', 'VARCHAR', true, 45, null);
        $this->addColumn('birthDay', 'Birthday', 'DATE', true, null, null);
        $this->addForeignKey('sex', 'Sex', 'INTEGER', 'sexes', 'sex', true, null, null);
        $this->addColumn('furColour', 'Furcolour', 'INTEGER', true, null, 2);
        $this->addColumn('eyeColour', 'Eyecolour', 'INTEGER', true, null, null);
        $this->addColumn('species', 'Species', 'INTEGER', true, null, null);
        $this->addColumn('size', 'Size', 'INTEGER', true, 10, null);
        $this->addColumn('specification', 'Specification', 'VARCHAR', true, 255, null);
        $this->addColumn('race', 'Race', 'INTEGER', true, null, null);
        $this->addColumn('test', 'Test', 'INTEGER', false, null, null);
        $this->addColumn('blah', 'Blah', 'DATE', false, null, null);
    } // initialize()

    /**
     * Build the RelationMap objects for this table relationships
     */
    public function buildRelations()
    {
        $this->addRelation('Sexes', '\\Sexes', RelationMap::MANY_TO_ONE, array (
  0 =>
  array (
    0 => ':sex',
    1 => ':sex',
  ),
), null, 'CASCADE', null, false);
    } // buildRelations()

    /**
     * Retrieves a string version of the primary key from the DB resultset row that can be used to uniquely identify a row in this table.
     *
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, a serialize()d version of the primary key will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return string The primary key hash of the row
     */
    public static function getPrimaryKeyHashFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        // If the PK cannot be derived from the row, return NULL.
        if ($row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Animal', TableMap::TYPE_PHPNAME, $indexType)] === null) {
            return null;
        }

        return (string) $row[TableMap::TYPE_NUM == $indexType ? 0 + $offset : static::translateFieldName('Animal', TableMap::TYPE_PHPNAME, $indexType)];
    }

    /**
     * Retrieves the primary key from the DB resultset row
     * For tables with a single-column primary key, that simple pkey value will be returned.  For tables with
     * a multi-column primary key, an array of the primary key columns will be returned.
     *
     * @param array  $row       resultset row.
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM
     *
     * @return mixed The primary key of the row
     */
    public static function getPrimaryKeyFromRow($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        return (int) $row[
            $indexType == TableMap::TYPE_NUM
                ? 0 + $offset
                : self::translateFieldName('Animal', TableMap::TYPE_PHPNAME, $indexType)
        ];
    }

    /**
     * The class that the tableMap will make instances of.
     *
     * If $withPrefix is true, the returned path
     * uses a dot-path notation which is translated into a path
     * relative to a location on the PHP include_path.
     * (e.g. path.to.MyClass -> 'path/to/MyClass.php')
     *
     * @param boolean $withPrefix Whether or not to return the path with the class name
     * @return string path.to.ClassName
     */
    public static function getOMClass($withPrefix = true)
    {
        return $withPrefix ? AnimalsTableMap::CLASS_DEFAULT : AnimalsTableMap::OM_CLASS;
    }

    /**
     * Populates an object of the default type or an object that inherit from the default.
     *
     * @param array  $row       row returned by DataFetcher->fetch().
     * @param int    $offset    The 0-based offset for reading from the resultset row.
     * @param string $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                 One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                           TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     * @return array           (Animals object, last column rank)
     */
    public static function populateObject($row, $offset = 0, $indexType = TableMap::TYPE_NUM)
    {
        $key = AnimalsTableMap::getPrimaryKeyHashFromRow($row, $offset, $indexType);
        if (null !== ($obj = AnimalsTableMap::getInstanceFromPool($key))) {
            // We no longer rehydrate the object, since this can cause data loss.
            // See http://www.propelorm.org/ticket/509
            // $obj->hydrate($row, $offset, true); // rehydrate
            $col = $offset + AnimalsTableMap::NUM_HYDRATE_COLUMNS;
        } else {
            $cls = AnimalsTableMap::OM_CLASS;
            /** @var Animals $obj */
            $obj = new $cls();
            $col = $obj->hydrate($row, $offset, false, $indexType);
            AnimalsTableMap::addInstanceToPool($obj, $key);
        }

        return array($obj, $col);
    }

    /**
     * The returned array will contain objects of the default type or
     * objects that inherit from the default.
     *
     * @param DataFetcherInterface $dataFetcher
     * @return array
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function populateObjects(DataFetcherInterface $dataFetcher)
    {
        $results = array();

        // set the class once to avoid overhead in the loop
        $cls = static::getOMClass(false);
        // populate the object(s)
        while ($row = $dataFetcher->fetch()) {
            $key = AnimalsTableMap::getPrimaryKeyHashFromRow($row, 0, $dataFetcher->getIndexType());
            if (null !== ($obj = AnimalsTableMap::getInstanceFromPool($key))) {
                // We no longer rehydrate the object, since this can cause data loss.
                // See http://www.propelorm.org/ticket/509
                // $obj->hydrate($row, 0, true); // rehydrate
                $results[] = $obj;
            } else {
                /** @var Animals $obj */
                $obj = new $cls();
                $obj->hydrate($row);
                $results[] = $obj;
                AnimalsTableMap::addInstanceToPool($obj, $key);
            } // if key exists
        }

        return $results;
    }
    /**
     * Add all the columns needed to create a new object.
     *
     * Note: any columns that were marked with lazyLoad="true" in the
     * XML schema will not be added to the select list and only loaded
     * on demand.
     *
     * @param Criteria $criteria object containing the columns to add.
     * @param string   $alias    optional table alias
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function addSelectColumns(Criteria $criteria, $alias = null)
    {
        if (null === $alias) {
            $criteria->addSelectColumn(AnimalsTableMap::COL_ANIMAL);
            $criteria->addSelectColumn(AnimalsTableMap::COL_NAME);
            $criteria->addSelectColumn(AnimalsTableMap::COL_BIRTHDAY);
            $criteria->addSelectColumn(AnimalsTableMap::COL_SEX);
            $criteria->addSelectColumn(AnimalsTableMap::COL_FURCOLOUR);
            $criteria->addSelectColumn(AnimalsTableMap::COL_EYECOLOUR);
            $criteria->addSelectColumn(AnimalsTableMap::COL_SPECIES);
            $criteria->addSelectColumn(AnimalsTableMap::COL_SIZE);
            $criteria->addSelectColumn(AnimalsTableMap::COL_SPECIFICATION);
            $criteria->addSelectColumn(AnimalsTableMap::COL_RACE);
            $criteria->addSelectColumn(AnimalsTableMap::COL_TEST);
            $criteria->addSelectColumn(AnimalsTableMap::COL_BLAH);
        } else {
            $criteria->addSelectColumn($alias . '.animal');
            $criteria->addSelectColumn($alias . '.name');
            $criteria->addSelectColumn($alias . '.birthDay');
            $criteria->addSelectColumn($alias . '.sex');
            $criteria->addSelectColumn($alias . '.furColour');
            $criteria->addSelectColumn($alias . '.eyeColour');
            $criteria->addSelectColumn($alias . '.species');
            $criteria->addSelectColumn($alias . '.size');
            $criteria->addSelectColumn($alias . '.specification');
            $criteria->addSelectColumn($alias . '.race');
            $criteria->addSelectColumn($alias . '.test');
            $criteria->addSelectColumn($alias . '.blah');
        }
    }

    /**
     * Returns the TableMap related to this object.
     * This method is not needed for general use but a specific application could have a need.
     * @return TableMap
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function getTableMap()
    {
        return Propel::getServiceContainer()->getDatabaseMap(AnimalsTableMap::DATABASE_NAME)->getTable(AnimalsTableMap::TABLE_NAME);
    }

    /**
     * Add a TableMap instance to the database for this tableMap class.
     */
    public static function buildTableMap()
    {
        $dbMap = Propel::getServiceContainer()->getDatabaseMap(AnimalsTableMap::DATABASE_NAME);
        if (!$dbMap->hasTable(AnimalsTableMap::TABLE_NAME)) {
            $dbMap->addTableObject(new AnimalsTableMap());
        }
    }

    /**
     * Performs a DELETE on the database, given a Animals or Criteria object OR a primary key value.
     *
     * @param mixed               $values Criteria or Animals object or primary key or array of primary keys
     *              which is used to create the DELETE statement
     * @param  ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
     public static function doDelete($values, ConnectionInterface $con = null)
     {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        if ($values instanceof Criteria) {
            // rename for clarity
            $criteria = $values;
        } elseif ($values instanceof \Animals) { // it's a model object
            // create criteria based on pk values
            $criteria = $values->buildPkeyCriteria();
        } else { // it's a primary key, or an array of pks
            $criteria = new Criteria(AnimalsTableMap::DATABASE_NAME);
            $criteria->add(AnimalsTableMap::COL_ANIMAL, (array) $values, Criteria::IN);
        }

        $query = AnimalsQuery::create()->mergeWith($criteria);

        if ($values instanceof Criteria) {
            AnimalsTableMap::clearInstancePool();
        } elseif (!is_object($values)) { // it's a primary key, or an array of pks
            foreach ((array) $values as $singleval) {
                AnimalsTableMap::removeInstanceFromPool($singleval);
            }
        }

        return $query->delete($con);
    }

    /**
     * Deletes all rows from the animals table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public static function doDeleteAll(ConnectionInterface $con = null)
    {
        return AnimalsQuery::create()->doDeleteAll($con);
    }

    /**
     * Performs an INSERT on the database, given a Animals or Criteria object.
     *
     * @param mixed               $criteria Criteria or Animals object containing data that is used to create the INSERT statement.
     * @param ConnectionInterface $con the ConnectionInterface connection to use
     * @return mixed           The new primary key.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public static function doInsert($criteria, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        if ($criteria instanceof Criteria) {
            $criteria = clone $criteria; // rename for clarity
        } else {
            $criteria = $criteria->buildCriteria(); // build Criteria from Animals object
        }

        if ($criteria->containsKey(AnimalsTableMap::COL_ANIMAL) && $criteria->keyContainsValue(AnimalsTableMap::COL_ANIMAL) ) {
            throw new PropelException('Cannot insert a value for auto-increment primary key ('.AnimalsTableMap::COL_ANIMAL.')');
        }


        // Set the correct dbName
        $query = AnimalsQuery::create()->mergeWith($criteria);

        // use transaction because $criteria could contain info
        // for more than one table (I guess, conceivably)
        return $con->transaction(function () use ($con, $query) {
            return $query->doInsert($con);
        });
    }

} // AnimalsTableMap
// This is the static code needed to register the TableMap for this table with the main Propel class.
//
AnimalsTableMap::buildTableMap();
