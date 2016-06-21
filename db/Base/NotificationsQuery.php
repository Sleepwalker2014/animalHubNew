<?php

namespace Base;

use \Notifications as ChildNotifications;
use \NotificationsQuery as ChildNotificationsQuery;
use \Exception;
use \PDO;
use Map\NotificationsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\PropelException;

/**
 * Base class that represents a query for the 'notifications' table.
 *
 *
 *
 * @method     ChildNotificationsQuery orderById($order = Criteria::ASC) Order by the id column
 * @method     ChildNotificationsQuery orderByLatitude($order = Criteria::ASC) Order by the latitude column
 * @method     ChildNotificationsQuery orderByNotificationtype($order = Criteria::ASC) Order by the notificationType column
 * @method     ChildNotificationsQuery orderByCreationdate($order = Criteria::ASC) Order by the creationDate column
 * @method     ChildNotificationsQuery orderByDescription($order = Criteria::ASC) Order by the description column
 * @method     ChildNotificationsQuery orderByAnimal($order = Criteria::ASC) Order by the animal column
 * @method     ChildNotificationsQuery orderByLongitude($order = Criteria::ASC) Order by the longitude column
 *
 * @method     ChildNotificationsQuery groupById() Group by the id column
 * @method     ChildNotificationsQuery groupByLatitude() Group by the latitude column
 * @method     ChildNotificationsQuery groupByNotificationtype() Group by the notificationType column
 * @method     ChildNotificationsQuery groupByCreationdate() Group by the creationDate column
 * @method     ChildNotificationsQuery groupByDescription() Group by the description column
 * @method     ChildNotificationsQuery groupByAnimal() Group by the animal column
 * @method     ChildNotificationsQuery groupByLongitude() Group by the longitude column
 *
 * @method     ChildNotificationsQuery leftJoin($relation) Adds a LEFT JOIN clause to the query
 * @method     ChildNotificationsQuery rightJoin($relation) Adds a RIGHT JOIN clause to the query
 * @method     ChildNotificationsQuery innerJoin($relation) Adds a INNER JOIN clause to the query
 *
 * @method     ChildNotificationsQuery leftJoinWith($relation) Adds a LEFT JOIN clause and with to the query
 * @method     ChildNotificationsQuery rightJoinWith($relation) Adds a RIGHT JOIN clause and with to the query
 * @method     ChildNotificationsQuery innerJoinWith($relation) Adds a INNER JOIN clause and with to the query
 *
 * @method     ChildNotifications findOne(ConnectionInterface $con = null) Return the first ChildNotifications matching the query
 * @method     ChildNotifications findOneOrCreate(ConnectionInterface $con = null) Return the first ChildNotifications matching the query, or a new ChildNotifications object populated from the query conditions when no match is found
 *
 * @method     ChildNotifications findOneById(int $id) Return the first ChildNotifications filtered by the id column
 * @method     ChildNotifications findOneByLatitude(double $latitude) Return the first ChildNotifications filtered by the latitude column
 * @method     ChildNotifications findOneByNotificationtype(int $notificationType) Return the first ChildNotifications filtered by the notificationType column
 * @method     ChildNotifications findOneByCreationdate(string $creationDate) Return the first ChildNotifications filtered by the creationDate column
 * @method     ChildNotifications findOneByDescription(string $description) Return the first ChildNotifications filtered by the description column
 * @method     ChildNotifications findOneByAnimal(int $animal) Return the first ChildNotifications filtered by the animal column
 * @method     ChildNotifications findOneByLongitude(double $longitude) Return the first ChildNotifications filtered by the longitude column *

 * @method     ChildNotifications requirePk($key, ConnectionInterface $con = null) Return the ChildNotifications by primary key and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOne(ConnectionInterface $con = null) Return the first ChildNotifications matching the query and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications requireOneById(int $id) Return the first ChildNotifications filtered by the id column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByLatitude(double $latitude) Return the first ChildNotifications filtered by the latitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByNotificationtype(int $notificationType) Return the first ChildNotifications filtered by the notificationType column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByCreationdate(string $creationDate) Return the first ChildNotifications filtered by the creationDate column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByDescription(string $description) Return the first ChildNotifications filtered by the description column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByAnimal(int $animal) Return the first ChildNotifications filtered by the animal column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 * @method     ChildNotifications requireOneByLongitude(double $longitude) Return the first ChildNotifications filtered by the longitude column and throws \Propel\Runtime\Exception\EntityNotFoundException when not found
 *
 * @method     ChildNotifications[]|ObjectCollection find(ConnectionInterface $con = null) Return ChildNotifications objects based on current ModelCriteria
 * @method     ChildNotifications[]|ObjectCollection findById(int $id) Return ChildNotifications objects filtered by the id column
 * @method     ChildNotifications[]|ObjectCollection findByLatitude(double $latitude) Return ChildNotifications objects filtered by the latitude column
 * @method     ChildNotifications[]|ObjectCollection findByNotificationtype(int $notificationType) Return ChildNotifications objects filtered by the notificationType column
 * @method     ChildNotifications[]|ObjectCollection findByCreationdate(string $creationDate) Return ChildNotifications objects filtered by the creationDate column
 * @method     ChildNotifications[]|ObjectCollection findByDescription(string $description) Return ChildNotifications objects filtered by the description column
 * @method     ChildNotifications[]|ObjectCollection findByAnimal(int $animal) Return ChildNotifications objects filtered by the animal column
 * @method     ChildNotifications[]|ObjectCollection findByLongitude(double $longitude) Return ChildNotifications objects filtered by the longitude column
 * @method     ChildNotifications[]|\Propel\Runtime\Util\PropelModelPager paginate($page = 1, $maxPerPage = 10, ConnectionInterface $con = null) Issue a SELECT query based on the current ModelCriteria and uses a page and a maximum number of results per page to compute an offset and a limit
 *
 */
abstract class NotificationsQuery extends ModelCriteria
{
    protected $entityNotFoundExceptionClass = '\\Propel\\Runtime\\Exception\\EntityNotFoundException';

    /**
     * Initializes internal state of \Base\NotificationsQuery object.
     *
     * @param     string $dbName The database name
     * @param     string $modelName The phpName of a model, e.g. 'Book'
     * @param     string $modelAlias The alias for the model in this query, e.g. 'b'
     */
    public function __construct($dbName = 'default', $modelName = '\\Notifications', $modelAlias = null)
    {
        parent::__construct($dbName, $modelName, $modelAlias);
    }

    /**
     * Returns a new ChildNotificationsQuery object.
     *
     * @param     string $modelAlias The alias of a model in the query
     * @param     Criteria $criteria Optional Criteria to build the query from
     *
     * @return ChildNotificationsQuery
     */
    public static function create($modelAlias = null, Criteria $criteria = null)
    {
        if ($criteria instanceof ChildNotificationsQuery) {
            return $criteria;
        }
        $query = new ChildNotificationsQuery();
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
     */
    public function findPk($key, ConnectionInterface $con = null)
    {
        if ($key === null) {
            return null;
        }
        if ((null !== ($obj = NotificationsTableMap::getInstanceFromPool((string) $key))) && !$this->formatter) {
            // the object is already in the instance pool
            return $obj;
        }
        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(NotificationsTableMap::DATABASE_NAME);
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
     * @return ChildNotifications A model object, or null if the key is not found
     */
    protected function findPkSimple($key, ConnectionInterface $con)
    {
        $sql = 'SELECT id, latitude, notificationType, creationDate, description, animal, longitude FROM notifications WHERE id = :p0';
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
            /** @var ChildNotifications $obj */
            $obj = new ChildNotifications();
            $obj->hydrate($row);
            NotificationsTableMap::addInstanceToPool($obj, (string) $key);
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
     * @return ChildNotifications|array|mixed the result, formatted by the current formatter
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKey($key)
    {

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $key, Criteria::EQUAL);
    }

    /**
     * Filter the query by a list of primary keys
     *
     * @param     array $keys The list of primary key to use for the query
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByPrimaryKeys($keys)
    {

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $keys, Criteria::IN);
    }

    /**
     * Filter the query on the id column
     *
     * Example usage:
     * <code>
     * $query->filterById(1234); // WHERE id = 1234
     * $query->filterById(array(12, 34)); // WHERE id IN (12, 34)
     * $query->filterById(array('min' => 12)); // WHERE id > 12
     * </code>
     *
     * @param     mixed $id The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterById($id = null, $comparison = null)
    {
        if (is_array($id)) {
            $useMinMax = false;
            if (isset($id['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID, $id['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($id['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ID, $id['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ID, $id, $comparison);
    }

    /**
     * Filter the query on the latitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLatitude(1234); // WHERE latitude = 1234
     * $query->filterByLatitude(array(12, 34)); // WHERE latitude IN (12, 34)
     * $query->filterByLatitude(array('min' => 12)); // WHERE latitude > 12
     * </code>
     *
     * @param     mixed $latitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByLatitude($latitude = null, $comparison = null)
    {
        if (is_array($latitude)) {
            $useMinMax = false;
            if (isset($latitude['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_LATITUDE, $latitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($latitude['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_LATITUDE, $latitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_LATITUDE, $latitude, $comparison);
    }

    /**
     * Filter the query on the notificationType column
     *
     * Example usage:
     * <code>
     * $query->filterByNotificationtype(1234); // WHERE notificationType = 1234
     * $query->filterByNotificationtype(array(12, 34)); // WHERE notificationType IN (12, 34)
     * $query->filterByNotificationtype(array('min' => 12)); // WHERE notificationType > 12
     * </code>
     *
     * @param     mixed $notificationtype The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByNotificationtype($notificationtype = null, $comparison = null)
    {
        if (is_array($notificationtype)) {
            $useMinMax = false;
            if (isset($notificationtype['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATIONTYPE, $notificationtype['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($notificationtype['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATIONTYPE, $notificationtype['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_NOTIFICATIONTYPE, $notificationtype, $comparison);
    }

    /**
     * Filter the query on the creationDate column
     *
     * Example usage:
     * <code>
     * $query->filterByCreationdate('2011-03-14'); // WHERE creationDate = '2011-03-14'
     * $query->filterByCreationdate('now'); // WHERE creationDate = '2011-03-14'
     * $query->filterByCreationdate(array('max' => 'yesterday')); // WHERE creationDate > '2011-03-13'
     * </code>
     *
     * @param     mixed $creationdate The value to use as filter.
     *              Values can be integers (unix timestamps), DateTime objects, or strings.
     *              Empty strings are treated as NULL.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByCreationdate($creationdate = null, $comparison = null)
    {
        if (is_array($creationdate)) {
            $useMinMax = false;
            if (isset($creationdate['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_CREATIONDATE, $creationdate['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($creationdate['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_CREATIONDATE, $creationdate['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_CREATIONDATE, $creationdate, $comparison);
    }

    /**
     * Filter the query on the description column
     *
     * Example usage:
     * <code>
     * $query->filterByDescription('fooValue');   // WHERE description = 'fooValue'
     * $query->filterByDescription('%fooValue%'); // WHERE description LIKE '%fooValue%'
     * </code>
     *
     * @param     string $description The value to use as filter.
     *              Accepts wildcards (* and % trigger a LIKE)
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByDescription($description = null, $comparison = null)
    {
        if (null === $comparison) {
            if (is_array($description)) {
                $comparison = Criteria::IN;
            } elseif (preg_match('/[\%\*]/', $description)) {
                $description = str_replace('*', '%', $description);
                $comparison = Criteria::LIKE;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_DESCRIPTION, $description, $comparison);
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
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByAnimal($animal = null, $comparison = null)
    {
        if (is_array($animal)) {
            $useMinMax = false;
            if (isset($animal['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ANIMAL, $animal['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($animal['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_ANIMAL, $animal['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_ANIMAL, $animal, $comparison);
    }

    /**
     * Filter the query on the longitude column
     *
     * Example usage:
     * <code>
     * $query->filterByLongitude(1234); // WHERE longitude = 1234
     * $query->filterByLongitude(array(12, 34)); // WHERE longitude IN (12, 34)
     * $query->filterByLongitude(array('min' => 12)); // WHERE longitude > 12
     * </code>
     *
     * @param     mixed $longitude The value to use as filter.
     *              Use scalar values for equality.
     *              Use array values for in_array() equivalent.
     *              Use associative array('min' => $minValue, 'max' => $maxValue) for intervals.
     * @param     string $comparison Operator to use for the column comparison, defaults to Criteria::EQUAL
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function filterByLongitude($longitude = null, $comparison = null)
    {
        if (is_array($longitude)) {
            $useMinMax = false;
            if (isset($longitude['min'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_LONGITUDE, $longitude['min'], Criteria::GREATER_EQUAL);
                $useMinMax = true;
            }
            if (isset($longitude['max'])) {
                $this->addUsingAlias(NotificationsTableMap::COL_LONGITUDE, $longitude['max'], Criteria::LESS_EQUAL);
                $useMinMax = true;
            }
            if ($useMinMax) {
                return $this;
            }
            if (null === $comparison) {
                $comparison = Criteria::IN;
            }
        }

        return $this->addUsingAlias(NotificationsTableMap::COL_LONGITUDE, $longitude, $comparison);
    }

    /**
     * Exclude object from result
     *
     * @param   ChildNotifications $notifications Object to remove from the list of results
     *
     * @return $this|ChildNotificationsQuery The current query, for fluid interface
     */
    public function prune($notifications = null)
    {
        if ($notifications) {
            $this->addUsingAlias(NotificationsTableMap::COL_ID, $notifications->getId(), Criteria::NOT_EQUAL);
        }

        return $this;
    }

    /**
     * Deletes all rows from the notifications table.
     *
     * @param ConnectionInterface $con the connection to use
     * @return int The number of affected rows (if supported by underlying database driver).
     */
    public function doDeleteAll(ConnectionInterface $con = null)
    {
        if (null === $con) {
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con) {
            $affectedRows = 0; // initialize var to track total num of affected rows
            $affectedRows += parent::doDeleteAll($con);
            // Because this db requires some delete cascade/set null emulation, we have to
            // clear the cached instance *after* the emulation has happened (since
            // instances get re-added by the select statement contained therein).
            NotificationsTableMap::clearInstancePool();
            NotificationsTableMap::clearRelatedInstancePool();

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
            $con = Propel::getServiceContainer()->getWriteConnection(NotificationsTableMap::DATABASE_NAME);
        }

        $criteria = $this;

        // Set the correct dbName
        $criteria->setDbName(NotificationsTableMap::DATABASE_NAME);

        // use transaction because $criteria could contain info
        // for more than one table or we could emulating ON DELETE CASCADE, etc.
        return $con->transaction(function () use ($con, $criteria) {
            $affectedRows = 0; // initialize var to track total num of affected rows

            NotificationsTableMap::removeInstanceFromPool($criteria);

            $affectedRows += ModelCriteria::delete($con);
            NotificationsTableMap::clearRelatedInstancePool();

            return $affectedRows;
        });
    }

} // NotificationsQuery
