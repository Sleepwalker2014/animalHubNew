<?php

namespace Base;

use \Animals as ChildAnimals;
use \AnimalsQuery as ChildAnimalsQuery;
use \Exception;
use \PDO;
use Map\AnimalsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveQuery\ModelJoin;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'animals' table.
 *
 *
 *
 * @method     ChildAnimalsQuery orderByAnimal($order = Criteria::ASC) Order by the animal column
 * @method     ChildAnimalsQuery orderByName($order = Criteria::ASC) Order by the name column
 * @method     ChildAnimalsQuery orderByBirthday($order = Criteria::ASC) Order by the birthDay column
 * @method     ChildAnimalsQuery orderBySex($order = Criteria::ASC) Order by the sex column
 * @method     ChildAnimalsQuery orderByFurcolour($order = Criteria::ASC) Order by the furColour column
 * @method     ChildAnimalsQuery orderByEyecolour($order = Criteria::ASC) Order by the eyeColour column
 * @method     ChildAnimalsQuery orderBySpecies($order = Criteria::ASC) Order by the species column
 * @method     ChildAnimalsQuery orderBySize($order = Criteria::ASC) Order by the size column
 * @method     ChildAnimalsQuery orderBySpecification($order = Criteria::ASC) Order by the specification column
 * @method     ChildAnimalsQuery orderByRace($order = Criteria::ASC) Order by the race column
 * @method     ChildAnimalsQuery orderByTest($order = Criteria::ASC) Order by the test column
 * @method     ChildAnimalsQuery orderByBlah($order = Criteria::ASC) Order by the blah column
 * @method     ChildAnimalsQuery orderByUser($order = Criteria::ASC) Order by the user column
 *
 * @method     ChildAnimalsQuery groupByAnimal() Group by the animal column
 * @method     ChildAnimalsQuery groupByName() Group by the name column
 * @method     ChildAnimalsQuery groupByBirthday() Group by the birthDay column
 * @method     ChildAnimalsQuery groupBySex() Group by the sex column
 * @method     ChildAnimalsQuery groupByFurcolour() Group by the furColour column
 * @method     ChildAnimalsQuery groupByEyecolour() Group by the eyeColour column
 * @method     ChildAnimalsQuery groupBySpecies() Group by the species column
 * @method     ChildAnimalsQuery groupBySize() Group by the size column
 * @method     ChildAnimalsQuery groupBySpecification() Group by the specification column
 * @method     ChildAnimalsQuery groupByRace() Group by the race column
 * @method     ChildAnimalsQuery groupByTest() Group by the test column
 * @method     ChildAnimalsQuery groupByBlah() Group by the blah column
 * @method     ChildAnimalsQuery groupByUser() Group by the user column
 *
 * @method     ChildAnimalsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildAnimalsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildAnimalsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildAnimalsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildAnimalsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildAnimalsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildAnimalsQuery leftJoinUsers($relationAlias = null) Adds a LEFT JOIN clause to the query using the Users relation
 * @method     ChildAnimalsQuery rightJoinUsers($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Users relation
 * @method     ChildAnimalsQuery innerJoinUsers($relationAlias = null) Adds a INNER JOIN clause to the query using the Users relation
 *
 * @method     ChildAnimalsQuery joinWithUsers($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Users relation
 *
 * @method     ChildAnimalsQuery leftJoinWithUsers() Adds a LEFT JOIN clause and with to the query using the Users relation
 * @method     ChildAnimalsQuery rightJoinWithUsers() Adds a RIGHT JOIN clause and with to the query using the Users relation
 * @method     ChildAnimalsQuery innerJoinWithUsers() Adds a INNER JOIN clause and with to the query using the Users relation
 *
 * @method     ChildAnimalsQuery leftJoinColoursRelatedByFurcolour($relationAlias = null) Adds a LEFT JOIN clause to the query using the ColoursRelatedByFurcolour relation
 * @method     ChildAnimalsQuery rightJoinColoursRelatedByFurcolour($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ColoursRelatedByFurcolour relation
 * @method     ChildAnimalsQuery innerJoinColoursRelatedByFurcolour($relationAlias = null) Adds a INNER JOIN clause to the query using the ColoursRelatedByFurcolour relation
 *
 * @method     ChildAnimalsQuery joinWithColoursRelatedByFurcolour($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ColoursRelatedByFurcolour relation
 *
 * @method     ChildAnimalsQuery leftJoinWithColoursRelatedByFurcolour() Adds a LEFT JOIN clause and with to the query using the ColoursRelatedByFurcolour relation
 * @method     ChildAnimalsQuery rightJoinWithColoursRelatedByFurcolour() Adds a RIGHT JOIN clause and with to the query using the ColoursRelatedByFurcolour relation
 * @method     ChildAnimalsQuery innerJoinWithColoursRelatedByFurcolour() Adds a INNER JOIN clause and with to the query using the ColoursRelatedByFurcolour relation
 *
 * @method     ChildAnimalsQuery leftJoinColoursRelatedByEyecolour($relationAlias = null) Adds a LEFT JOIN clause to the query using the ColoursRelatedByEyecolour relation
 * @method     ChildAnimalsQuery rightJoinColoursRelatedByEyecolour($relationAlias = null) Adds a RIGHT JOIN clause to the query using the ColoursRelatedByEyecolour relation
 * @method     ChildAnimalsQuery innerJoinColoursRelatedByEyecolour($relationAlias = null) Adds a INNER JOIN clause to the query using the ColoursRelatedByEyecolour relation
 *
 * @method     ChildAnimalsQuery joinWithColoursRelatedByEyecolour($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the ColoursRelatedByEyecolour relation
 *
 * @method     ChildAnimalsQuery leftJoinWithColoursRelatedByEyecolour() Adds a LEFT JOIN clause and with to the query using the ColoursRelatedByEyecolour relation
 * @method     ChildAnimalsQuery rightJoinWithColoursRelatedByEyecolour() Adds a RIGHT JOIN clause and with to the query using the ColoursRelatedByEyecolour relation
 * @method     ChildAnimalsQuery innerJoinWithColoursRelatedByEyecolour() Adds a INNER JOIN clause and with to the query using the ColoursRelatedByEyecolour relation
 *
 * @method     ChildAnimalsQuery leftJoinSexes($relationAlias = null) Adds a LEFT JOIN clause to the query using the Sexes relation
 * @method     ChildAnimalsQuery rightJoinSexes($relationAlias = null) Adds a RIGHT JOIN clause to the query using the Sexes relation
 * @method     ChildAnimalsQuery innerJoinSexes($relationAlias = null) Adds a INNER JOIN clause to the query using the Sexes relation
 *
 * @method     ChildAnimalsQuery joinWithSexes($joinType = Criteria::INNER_JOIN) Adds a join clause and with to the query using the Sexes relation
 *
 * @method     ChildAnimalsQuery leftJoinWithSexes() Adds a LEFT JOIN clause and with to the query using the Sexes relation
 * @method     ChildAnimalsQuery rightJoinWithSexes() Adds a RIGHT JOIN clause and with to the query using the Sexes relation
 * @method     ChildAnimalsQuery innerJoinWithSexes() Adds a INNER JOIN clause and with to the query using the Sexes relation
 *
 * @method     \UsersQuery|\ColoursQuery|\SexesQuery endUse() Finalizes a secondary criteria and merges it with its primary Criteria
 *
 * @method     ChildAnimals findOne(ConnectionInterface $con = null) Return the first ChildAnimals matching the query
 * @method     ChildAnimals findOneOrCreate(ConnectionInterface $con = null) Return the first ChildAnimals matching the query, or a new ChildAnimals object populated from the query conditions when no match is found
 *
 * @method     ChildAnimals findOneByAnimal(int $animal) Return the first ChildAnimals filtered by the animal column
 * @method     ChildAnimals findOneByName(string $name) Return the first ChildAnimals filtered by the name column
 * @method     ChildAnimals findOneByBirthday(string $birthDay) Return the first ChildAnimals filtered by the birthDay column
 * @method     ChildAnimals findOneBySex(int $sex) Return the first ChildAnimals filtered by the sex column
 * @method     ChildAnimals findOneByFurcolour(int $furColour) Return the first ChildAnimals filtered by the furColour column
 * @method     ChildAnimals findOneByEyecolour(int $eyeColour) Return the first ChildAnimals filtered by the eyeColour column
 * @method     ChildAnimals findOneBySpecies(int $species) Return the first ChildAnimals filtered by the species column
 * @method     ChildAnimals findOneBySize(int $size) Return the first ChildAnimals filtered by the size column
 * @method     ChildAnimals findOneBySpecification(string $specification) Return the first ChildAnimals filtered by the specification column
 * @method     ChildAnimals findOneByRace(int $race) Return the first ChildAnimals filtered by the race column
 * @method     ChildAnimals findOneByTest(int $test) Return the first ChildAnimals filtered by the test column
 * @method     ChildAnimals findOneByBlah(string $blah) Return the first ChildAnimals filtered by the blah column
 * @method     ChildAnimals findOneByUser(int $user) Return the first ChildAnimals filtered by the user column *

 * @method     ChildAnimals requirePk($key, ConnectionInterface $con = null) Return the ChildAnimals by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOne(ConnectionInterface $con = null) Return the first ChildAnimals matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnimals requireOneByAnimal(int $animal) Return the first ChildAnimals filtered by the animal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByName(string $name) Return the first ChildAnimals filtered by the name column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByBirthday(string $birthDay) Return the first ChildAnimals filtered by the birthDay column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneBySex(int $sex) Return the first ChildAnimals filtered by the sex column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByFurcolour(int $furColour) Return the first ChildAnimals filtered by the furColour column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByEyecolour(int $eyeColour) Return the first ChildAnimals filtered by the eyeColour column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneBySpecies(int $species) Return the first ChildAnimals filtered by the species column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneBySize(int $size) Return the first ChildAnimals filtered by the size column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneBySpecification(string $specification) Return the first ChildAnimals filtered by the specification column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByRace(int $race) Return the first ChildAnimals filtered by the race column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByTest(int $test) Return the first ChildAnimals filtered by the test column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByBlah(string $blah) Return the first ChildAnimals filtered by the blah column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildAnimals requireOneByUser(int $user) Return the first ChildAnimals filtered by the user column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildAnimals[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildAnimals objects based on current ModelCriteria
 * @method     ChildAnimals[]|ObjectCollection findByAnimal(int $animal) Return ChildAnimals objects filtered by the animal column
 * @method     ChildAnimals[]|ObjectCollection findByName(string $name) Return ChildAnimals objects filtered by the name column
 * @method     ChildAnimals[]|ObjectCollection findByBirthday(string $birthDay) Return ChildAnimals objects filtered by the birthDay column
 * @method     ChildAnimals[]|ObjectCollection findBySex(int $sex) Return ChildAnimals objects filtered by the sex column
 * @method     ChildAnimals[]|ObjectCollection findByFurcolour(int $furColour) Return ChildAnimals objects filtered by the furColour column
 * @method     ChildAnimals[]|ObjectCollection findByEyecolour(int $eyeColour) Return ChildAnimals objects filtered by the eyeColour column
 * @method     ChildAnimals[]|ObjectCollection findBySpecies(int $species) Return ChildAnimals objects filtered by the species column
 * @method     ChildAnimals[]|ObjectCollection findBySize(int $size) Return ChildAnimals objects filtered by the size column
 * @method     ChildAnimals[]|ObjectCollection findBySpecification(string $specification) Return ChildAnimals objects filtered by the specification column
 * @method     ChildAnimals[]|ObjectCollection findByRace(int $race) Return ChildAnimals objects filtered by the race column
 * @method     ChildAnimals[]|ObjectCollection findByTest(int $test) Return ChildAnimals objects filtered by the test column
 * @method     ChildAnimals[]|ObjectCollection findByBlah(string $blah) Return ChildAnimals objects filtered by the blah column
 * @method     ChildAnimals[]|ObjectCollection findByUser(int $user) Return ChildAnimals objects filtered by the user column
 * @method     ChildAnimals[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class AnimalsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\AnimalsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Animals', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildAnimalsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildAnimalsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildAnimalsQuery) {
            return $criteria;
        }
        $query = new ChildAnimalsQuery();
        if (null !== $modelAlias) {
            $query->setModelAlias($modelAlias);
        }
        if ($criteria instanceof Criteria) {
            $query->mergeWith($criteria);
        }

        return $query;
    }

    /**
     * Find object by primary key.
     * Propel uses the instance pool to skip the database if the object exists.
     * Go fast if the query is untouched.
     *
     * <code>
     * $obj  = $c->findPk(12, $con);
     * </code>
     *
     * @param mixed $key Primary key to use for the query
     * @param ConnectionInterface $con an optional connection object
     *
     * @return ChildAnimals|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = AnimalsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AnimalsTableMap::DATABASE_NAME);
        }
        $this->basePreSelect($con);
        if ($this->formatter || $this->modelAlias || $this->with || $this->select
         || $this->selectColumns || $this->asColumns || $this->selectModifiers
         || $this->map || $this->having || $this->joins) {
            return $this->findPkComplex($key, $con);
        } else {
            return $this->findPkSimple($key, $con);
        }
    }

    /**
     * Find object by primary key using raw SQL to go fast.
     * Bypass doSelect() and the object formatter by using generated code.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnimals A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT animal, name, birthDay, sex, furColour, eyeColour, species, size, specification, race, test, blah, user FROM animals WHERE animal = :p0';
        try {
            $stmt = $con->prepare($sql);
            $stmt->bindValue(':p0', $key, PDO::PARAM_INT);
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute SELECT statement [%s]', $sql), 0, $e);
        }
        $obj = null;
        if ($row = $stmt->fetch(\PDO::FETCH_NUM)) {
            /** @var ChildAnimals $obj */
            $obj = new ChildAnimals();
            $obj->hydrate($row);
            AnimalsTableMap::addInstanceToPool($obj, (string) $key);
        }
        $stmt->closeCursor();

        return $obj;
    }

    /**
     * Find object by primary key.
     *
     * @param     mixed $key Primary key to use for the query
     * @param     ConnectionInterface $con A connection object
     *
     * @return ChildAnimals|array|mixed the result, formatted by the current formatter
     */
    protected function findPkComplex($key, ConnectionInterface $con)
    {
        // As the query uses a PK condition, no limit(1) is necessary.
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKey($key)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->formatOne($dataFetcher);
    }

    /**
     * Find objects by primary key
     * <code>
     * $objs = $c->findPks(array(12, 56, 832), $con);
     * </code>
     * @param     array $keys Primary keys to use for the query
     * @param     ConnectionInterface $con an optional connection object
     *
     * @return ObjectCollection|array|mixed the list of results, formatted by the current formatter
     */
    public function findPks($keys, ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getReadConnection($this->getDbName());
        }
        $this->basePreSelect($con);
        $criteria = $this->isKeepQuery() ? clone $this : $this;
        $dataFetcher = $criteria
            ->filterByPrimaryKeys($keys)
            ->doSelect($con);

        return $criteria->getFormatter()->init($criteria)->format($dataFetcher);
    }

    /**
     * Filter the query by primary key
     *
     * @param     mixed $key Primary key to use for the query
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the animal column
     *
     * Example usage:
     * <code>
     * $query->filterByAnimal(1234); // WHERE animal = 1234
     * $query->filterByAnimal(array(12, 34)); // WHERE animal IN (12, 34)
     * $query->filterByAnimal(array('min' => 12)); // WHERE animal > 12
     * </code>
     *
     * @param     mixed $animal The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByAnimal($animal = null, $comparison = null)
    {
        if (is_array($animal)) {
            $useMinMax = false;
            if (isset($animal['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $animal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($animal['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $animal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $animal, $comparison);
    }

    /**
     * Filter the query on the name column
     *
     * Example usage:
     * <code>
     * $query->filterByName('fooValue');   // WHERE name = 'fooValue'
     * $query->filterByName('%fooValue%'); // WHERE name LIKE '%fooValue%'
     * </code>
     *
     * @param     string $name The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByName($name = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($name)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $name)) {
                $name = str_replace('*', '%', $name);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_NAME, $name, $comparison);
    }

    /**
     * Filter the query on the birthDay column
     *
     * Example usage:
     * <code>
     * $query->filterByBirthday('2011-03-14'); // WHERE birthDay = '2011-03-14'
     * $query->filterByBirthday('now'); // WHERE birthDay = '2011-03-14'
     * $query->filterByBirthday(array('max' => 'yesterday')); // WHERE birthDay > '2011-03-13'
     * </code>
     *
     * @param     mixed $birthday The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByBirthday($birthday = null, $comparison = null)
    {
        if (is_array($birthday)) {
            $useMinMax = false;
            if (isset($birthday['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_BIRTHDAY, $birthday['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($birthday['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_BIRTHDAY, $birthday['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_BIRTHDAY, $birthday, $comparison);
    }

    /**
     * Filter the query on the sex column
     *
     * Example usage:
     * <code>
     * $query->filterBySex(1234); // WHERE sex = 1234
     * $query->filterBySex(array(12, 34)); // WHERE sex IN (12, 34)
     * $query->filterBySex(array('min' => 12)); // WHERE sex > 12
     * </code>
     *
     * @see       filterBySexes()
     *
     * @param     mixed $sex The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterBySex($sex = null, $comparison = null)
    {
        if (is_array($sex)) {
            $useMinMax = false;
            if (isset($sex['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SEX, $sex['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($sex['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SEX, $sex['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_SEX, $sex, $comparison);
    }

    /**
     * Filter the query on the furColour column
     *
     * Example usage:
     * <code>
     * $query->filterByFurcolour(1234); // WHERE furColour = 1234
     * $query->filterByFurcolour(array(12, 34)); // WHERE furColour IN (12, 34)
     * $query->filterByFurcolour(array('min' => 12)); // WHERE furColour > 12
     * </code>
     *
     * @see       filterByColoursRelatedByFurcolour()
     *
     * @param     mixed $furcolour The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByFurcolour($furcolour = null, $comparison = null)
    {
        if (is_array($furcolour)) {
            $useMinMax = false;
            if (isset($furcolour['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_FURCOLOUR, $furcolour['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($furcolour['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_FURCOLOUR, $furcolour['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_FURCOLOUR, $furcolour, $comparison);
    }

    /**
     * Filter the query on the eyeColour column
     *
     * Example usage:
     * <code>
     * $query->filterByEyecolour(1234); // WHERE eyeColour = 1234
     * $query->filterByEyecolour(array(12, 34)); // WHERE eyeColour IN (12, 34)
     * $query->filterByEyecolour(array('min' => 12)); // WHERE eyeColour > 12
     * </code>
     *
     * @see       filterByColoursRelatedByEyecolour()
     *
     * @param     mixed $eyecolour The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByEyecolour($eyecolour = null, $comparison = null)
    {
        if (is_array($eyecolour)) {
            $useMinMax = false;
            if (isset($eyecolour['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_EYECOLOUR, $eyecolour['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($eyecolour['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_EYECOLOUR, $eyecolour['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_EYECOLOUR, $eyecolour, $comparison);
    }

    /**
     * Filter the query on the species column
     *
     * Example usage:
     * <code>
     * $query->filterBySpecies(1234); // WHERE species = 1234
     * $query->filterBySpecies(array(12, 34)); // WHERE species IN (12, 34)
     * $query->filterBySpecies(array('min' => 12)); // WHERE species > 12
     * </code>
     *
     * @param     mixed $species The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterBySpecies($species = null, $comparison = null)
    {
        if (is_array($species)) {
            $useMinMax = false;
            if (isset($species['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SPECIES, $species['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($species['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SPECIES, $species['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_SPECIES, $species, $comparison);
    }

    /**
     * Filter the query on the size column
     *
     * Example usage:
     * <code>
     * $query->filterBySize(1234); // WHERE size = 1234
     * $query->filterBySize(array(12, 34)); // WHERE size IN (12, 34)
     * $query->filterBySize(array('min' => 12)); // WHERE size > 12
     * </code>
     *
     * @param     mixed $size The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterBySize($size = null, $comparison = null)
    {
        if (is_array($size)) {
            $useMinMax = false;
            if (isset($size['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SIZE, $size['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($size['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_SIZE, $size['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_SIZE, $size, $comparison);
    }

    /**
     * Filter the query on the specification column
     *
     * Example usage:
     * <code>
     * $query->filterBySpecification('fooValue');   // WHERE specification = 'fooValue'
     * $query->filterBySpecification('%fooValue%'); // WHERE specification LIKE '%fooValue%'
     * </code>
     *
     * @param     string $specification The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterBySpecification($specification = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($specification)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $specification)) {
                $specification = str_replace('*', '%', $specification);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_SPECIFICATION, $specification, $comparison);
    }

    /**
     * Filter the query on the race column
     *
     * Example usage:
     * <code>
     * $query->filterByRace(1234); // WHERE race = 1234
     * $query->filterByRace(array(12, 34)); // WHERE race IN (12, 34)
     * $query->filterByRace(array('min' => 12)); // WHERE race > 12
     * </code>
     *
     * @param     mixed $race The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByRace($race = null, $comparison = null)
    {
        if (is_array($race)) {
            $useMinMax = false;
            if (isset($race['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_RACE, $race['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($race['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_RACE, $race['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_RACE, $race, $comparison);
    }

    /**
     * Filter the query on the test column
     *
     * Example usage:
     * <code>
     * $query->filterByTest(1234); // WHERE test = 1234
     * $query->filterByTest(array(12, 34)); // WHERE test IN (12, 34)
     * $query->filterByTest(array('min' => 12)); // WHERE test > 12
     * </code>
     *
     * @param     mixed $test The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByTest($test = null, $comparison = null)
    {
        if (is_array($test)) {
            $useMinMax = false;
            if (isset($test['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_TEST, $test['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($test['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_TEST, $test['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_TEST, $test, $comparison);
    }

    /**
     * Filter the query on the blah column
     *
     * Example usage:
     * <code>
     * $query->filterByBlah('2011-03-14'); // WHERE blah = '2011-03-14'
     * $query->filterByBlah('now'); // WHERE blah = '2011-03-14'
     * $query->filterByBlah(array('max' => 'yesterday')); // WHERE blah > '2011-03-13'
     * </code>
     *
     * @param     mixed $blah The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByBlah($blah = null, $comparison = null)
    {
        if (is_array($blah)) {
            $useMinMax = false;
            if (isset($blah['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_BLAH, $blah['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($blah['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_BLAH, $blah['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_BLAH, $blah, $comparison);
    }

    /**
     * Filter the query on the user column
     *
     * Example usage:
     * <code>
     * $query->filterByUser(1234); // WHERE user = 1234
     * $query->filterByUser(array(12, 34)); // WHERE user IN (12, 34)
     * $query->filterByUser(array('min' => 12)); // WHERE user > 12
     * </code>
     *
     * @see       filterByUsers()
     *
     * @param     mixed $user The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByUser($user = null, $comparison = null)
    {
        if (is_array($user)) {
            $useMinMax = false;
            if (isset($user['min'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_USER, $user['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($user['max'])) {
                $this->addUsingAlias(AnimalsTableMap::COL_USER, $user['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(AnimalsTableMap::COL_USER, $user, $comparison);
    }

    /**
     * Filter the query by a related \Users object
     *
     * @param \Users|ObjectCollection $users The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByUsers($users, $comparison = null)
    {
        if ($users instanceof \Users) {
            return $this
                ->addUsingAlias(AnimalsTableMap::COL_USER, $users->getUser(), $comparison);
        } elseif ($users instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AnimalsTableMap::COL_USER, $users->toKeyValue('PrimaryKey', 'User'), $comparison);
        } else {
            throw new PropelException('filterByUsers() only accepts arguments of type \Users or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Users relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function joinUsers($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Users');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Users');
        }

        return $this;
    }

    /**
     * Use the Users relation Users object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \UsersQuery A secondary query class using the current class as primary query
     */
    public function useUsersQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinUsers($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Users', '\UsersQuery');
    }

    /**
     * Filter the query by a related \Colours object
     *
     * @param \Colours|ObjectCollection $colours The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByColoursRelatedByFurcolour($colours, $comparison = null)
    {
        if ($colours instanceof \Colours) {
            return $this
                ->addUsingAlias(AnimalsTableMap::COL_FURCOLOUR, $colours->getColour(), $comparison);
        } elseif ($colours instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AnimalsTableMap::COL_FURCOLOUR, $colours->toKeyValue('PrimaryKey', 'Colour'), $comparison);
        } else {
            throw new PropelException('filterByColoursRelatedByFurcolour() only accepts arguments of type \Colours or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ColoursRelatedByFurcolour relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function joinColoursRelatedByFurcolour($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ColoursRelatedByFurcolour');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ColoursRelatedByFurcolour');
        }

        return $this;
    }

    /**
     * Use the ColoursRelatedByFurcolour relation Colours object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ColoursQuery A secondary query class using the current class as primary query
     */
    public function useColoursRelatedByFurcolourQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinColoursRelatedByFurcolour($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ColoursRelatedByFurcolour', '\ColoursQuery');
    }

    /**
     * Filter the query by a related \Colours object
     *
     * @param \Colours|ObjectCollection $colours The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterByColoursRelatedByEyecolour($colours, $comparison = null)
    {
        if ($colours instanceof \Colours) {
            return $this
                ->addUsingAlias(AnimalsTableMap::COL_EYECOLOUR, $colours->getColour(), $comparison);
        } elseif ($colours instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AnimalsTableMap::COL_EYECOLOUR, $colours->toKeyValue('PrimaryKey', 'Colour'), $comparison);
        } else {
            throw new PropelException('filterByColoursRelatedByEyecolour() only accepts arguments of type \Colours or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the ColoursRelatedByEyecolour relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function joinColoursRelatedByEyecolour($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('ColoursRelatedByEyecolour');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'ColoursRelatedByEyecolour');
        }

        return $this;
    }

    /**
     * Use the ColoursRelatedByEyecolour relation Colours object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \ColoursQuery A secondary query class using the current class as primary query
     */
    public function useColoursRelatedByEyecolourQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinColoursRelatedByEyecolour($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'ColoursRelatedByEyecolour', '\ColoursQuery');
    }

    /**
     * Filter the query by a related \Sexes object
     *
     * @param \Sexes|ObjectCollection $sexes The related object(s) to use as filter
     * @param string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @throws \Propel\Runtime\Exception\PropelException
     *
     * @return ChildAnimalsQuery The current query, for fluid interface
     */
    public function filterBySexes($sexes, $comparison = null)
    {
        if ($sexes instanceof \Sexes) {
            return $this
                ->addUsingAlias(AnimalsTableMap::COL_SEX, $sexes->getSex(), $comparison);
        } elseif ($sexes instanceof ObjectCollection) {
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }

            return $this
                ->addUsingAlias(AnimalsTableMap::COL_SEX, $sexes->toKeyValue('PrimaryKey', 'Sex'), $comparison);
        } else {
            throw new PropelException('filterBySexes() only accepts arguments of type \Sexes or Collection');
        }
    }

    /**
     * Adds a JOIN clause to the query using the Sexes relation
     *
     * @param     string $relationAlias optional alias for the relation
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function joinSexes($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        $tableMap = $this->getTableMap();
        $relationMap = $tableMap->getRelation('Sexes');

        // create a ModelJoin object for this join
        $join = new ModelJoin();
        $join->setJoinType($joinType);
        $join->setRelationMap($relationMap, $this->useAliasInSQL ? $this->getModelAlias() : null, $relationAlias);
        if ($previousJoin = $this->getPreviousJoin()) {
            $join->setPreviousJoin($previousJoin);
        }

        // add the ModelJoin to the current object
        if ($relationAlias) {
            $this->addAlias($relationAlias, $relationMap->getRightTable()->getName());
            $this->addJoinObject($join, $relationAlias);
        } else {
            $this->addJoinObject($join, 'Sexes');
        }

        return $this;
    }

    /**
     * Use the Sexes relation Sexes object
     *
     * @see useQuery()
     *
     * @param     string $relationAlias optional alias for the relation,
     *                                   to be used as main alias in the secondary query
     * @param     string $joinType Accepted values are null, 'left join', 'right join', 'inner join'
     *
     * @return \SexesQuery A secondary query class using the current class as primary query
     */
    public function useSexesQuery($relationAlias = null, $joinType = Criteria::INNER_JOIN)
    {
        return $this
            ->joinSexes($relationAlias, $joinType)
            ->useQuery($relationAlias ? $relationAlias : 'Sexes', '\SexesQuery');
    }

    /**
     * Exclude object from result
     *
     * @param   ChildAnimals $animals Object to remove from the list of results
     *
     * @return $this|ChildAnimalsQuery The current query, for fluid interface
     */
    public function prune($animals = null)
    {
        if ($animals) {
            $this->addUsingAlias(AnimalsTableMap::COL_ANIMAL, $animals->getAnimal(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the animals table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            AnimalsTableMap::clearInstancePool();
            AnimalsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

    /**
     * Performs a DELETE on the database based on the current ModelCriteria
     *
     * @param ConnectionInterface $con the connection to use
     * @return int             The number of affected rows (if supported by underlying database driver).  This includes CASCADE-related rows
     *                         if supported by native driver or if emulated using Propel.
     * @throws PropelException Any exceptions caught during processing will be
     *                         rethrown wrapped into a PropelException.
     */
    public function delete(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(AnimalsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            AnimalsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            AnimalsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // AnimalsQuery
