<?php

namespace Base;

use \AnimalsQuery as ChildAnimalsQuery;
use \Colours as ChildColours;
use \ColoursQuery as ChildColoursQuery;
use \Genuses as ChildGenuses;
use \GenusesQuery as ChildGenusesQuery;
use \Races as ChildRaces;
use \RacesQuery as ChildRacesQuery;
use \Sexes as ChildSexes;
use \SexesQuery as ChildSexesQuery;
use \Users as ChildUsers;
use \UsersQuery as ChildUsersQuery;
use \DateTime;
use \Exception;
use \PDO;
use Map\AnimalsTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;
use Propel\Runtime\Util\PropelDateTime;

/**
 * Base class that represents a row from the 'animals' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Animals implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\AnimalsTableMap';


    /**
     * attribute to determine if this object has previously been saved.
     * @var boolean
     */
    protected $new = true;

    /**
     * attribute to determine whether this object has been deleted.
     * @var boolean
     */
    protected $deleted = false;

    /**
     * The columns that have been modified in current object.
     * Tracking modified columns allows us to only update modified columns.
     * @var array
     */
    protected $modifiedColumns = array();

    /**
     * The (virtual) columns that are added at runtime
     * The formatters can add supplementary columns based on a resultset
     * @var array
     */
    protected $virtualColumns = array();

    /**
     * The value for the animal field.
     * @var        int
     */
    protected $animal;

    /**
     * The value for the name field.
     * @var        string
     */
    protected $name;

    /**
     * The value for the genus field.
     * @var        int
     */
    protected $genus;

    /**
     * The value for the birthday field.
     * @var        \DateTime
     */
    protected $birthday;

    /**
     * The value for the sex field.
     * @var        int
     */
    protected $sex;

    /**
     * The value for the furcolour field.
     * @var        int
     */
    protected $furcolour;

    /**
     * The value for the eyecolour field.
     * @var        int
     */
    protected $eyecolour;

    /**
     * The value for the size field.
     * @var        int
     */
    protected $size;

    /**
     * The value for the specification field.
     * @var        string
     */
    protected $specification;

    /**
     * The value for the user field.
     * @var        int
     */
    protected $user;

    /**
     * The value for the race field.
     * @var        int
     */
    protected $race;

    /**
     * @var        ChildRaces
     */
    protected $aRaces;

    /**
     * @var        ChildColours
     */
    protected $aColoursRelatedByFurcolour;

    /**
     * @var        ChildColours
     */
    protected $aColoursRelatedByEyecolour;

    /**
     * @var        ChildUsers
     */
    protected $aUsers;

    /**
     * @var        ChildGenuses
     */
    protected $aGenuses;

    /**
     * @var        ChildSexes
     */
    protected $aSexes;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * Initializes internal state of Base\Animals object.
     */
    public function __construct()
    {
    }

    /**
     * Returns whether the object has been modified.
     *
     * @return boolean True if the object has been modified.
     */
    public function isModified()
    {
        return !!$this->modifiedColumns;
    }

    /**
     * Has specified column been modified?
     *
     * @param  string  $col column fully qualified name (TableMap::TYPE_COLNAME), e.g. Book::AUTHOR_ID
     * @return boolean True if $col has been modified.
     */
    public function isColumnModified($col)
    {
        return $this->modifiedColumns && isset($this->modifiedColumns[$col]);
    }

    /**
     * Get the columns that have been modified in this object.
     * @return array A unique list of the modified column names for this object.
     */
    public function getModifiedColumns()
    {
        return $this->modifiedColumns ? array_keys($this->modifiedColumns) : [];
    }

    /**
     * Returns whether the object has ever been saved.  This will
     * be false, if the object was retrieved from storage or was created
     * and then saved.
     *
     * @return boolean true, if the object has never been persisted.
     */
    public function isNew()
    {
        return $this->new;
    }

    /**
     * Setter for the isNew attribute.  This method will be called
     * by Propel-generated children and objects.
     *
     * @param boolean $b the state of the object.
     */
    public function setNew($b)
    {
        $this->new = (boolean) $b;
    }

    /**
     * Whether this object has been deleted.
     * @return boolean The deleted state of this object.
     */
    public function isDeleted()
    {
        return $this->deleted;
    }

    /**
     * Specify whether this object has been deleted.
     * @param  boolean $b The deleted state of this object.
     * @return void
     */
    public function setDeleted($b)
    {
        $this->deleted = (boolean) $b;
    }

    /**
     * Sets the modified state for the object to be false.
     * @param  string $col If supplied, only the specified column is reset.
     * @return void
     */
    public function resetModified($col = null)
    {
        if (null !== $col) {
            if (isset($this->modifiedColumns[$col])) {
                unset($this->modifiedColumns[$col]);
            }
        } else {
            $this->modifiedColumns = array();
        }
    }

    /**
     * Compares this with another <code>Animals</code> instance.  If
     * <code>obj</code> is an instance of <code>Animals</code>, delegates to
     * <code>equals(Animals)</code>.  Otherwise, returns <code>false</code>.
     *
     * @param  mixed   $obj The object to compare to.
     * @return boolean Whether equal to the object specified.
     */
    public function equals($obj)
    {
        if (!$obj instanceof static) {
            return false;
        }

        if ($this === $obj) {
            return true;
        }

        if (null === $this->getPrimaryKey() || null === $obj->getPrimaryKey()) {
            return false;
        }

        return $this->getPrimaryKey() === $obj->getPrimaryKey();
    }

    /**
     * Get the associative array of the virtual columns in this object
     *
     * @return array
     */
    public function getVirtualColumns()
    {
        return $this->virtualColumns;
    }

    /**
     * Checks the existence of a virtual column in this object
     *
     * @param  string  $name The virtual column name
     * @return boolean
     */
    public function hasVirtualColumn($name)
    {
        return array_key_exists($name, $this->virtualColumns);
    }

    /**
     * Get the value of a virtual column in this object
     *
     * @param  string $name The virtual column name
     * @return mixed
     *
     * @throws PropelException
     */
    public function getVirtualColumn($name)
    {
        if (!$this->hasVirtualColumn($name)) {
            throw new PropelException(sprintf('Cannot get value of inexistent virtual column %s.', $name));
        }

        return $this->virtualColumns[$name];
    }

    /**
     * Set the value of a virtual column in this object
     *
     * @param string $name  The virtual column name
     * @param mixed  $value The value to give to the virtual column
     *
     * @return $this|Animals The current object, for fluid interface
     */
    public function setVirtualColumn($name, $value)
    {
        $this->virtualColumns[$name] = $value;

        return $this;
    }

    /**
     * Logs a message using Propel::log().
     *
     * @param  string  $msg
     * @param  int     $priority One of the Propel::LOG_* logging levels
     * @return boolean
     */
    protected function log($msg, $priority = Propel::LOG_INFO)
    {
        return Propel::log(get_class($this) . ': ' . $msg, $priority);
    }

    /**
     * Export the current object properties to a string, using a given parser format
     * <code>
     * $book = BookQuery::create()->findPk(9012);
     * echo $book->exportTo('JSON');
     *  => {"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * @param  mixed   $parser                 A AbstractParser instance, or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param  boolean $includeLazyLoadColumns (optional) Whether to include lazy load(ed) columns. Defaults to TRUE.
     * @return string  The exported data
     */
    public function exportTo($parser, $includeLazyLoadColumns = true)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        return $parser->fromArray($this->toArray(TableMap::TYPE_PHPNAME, $includeLazyLoadColumns, array(), true));
    }

    /**
     * Clean up internal collections prior to serializing
     * Avoids recursive loops that turn into segmentation faults when serializing
     */
    public function __sleep()
    {
        $this->clearAllReferences();

        return array_keys(get_object_vars($this));
    }

    /**
     * Get the [animal] column value.
     *
     * @return int
     */
    public function getAnimal()
    {
        return $this->animal;
    }

    /**
     * Get the [name] column value.
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Get the [genus] column value.
     *
     * @return int
     */
    public function getGenus()
    {
        return $this->genus;
    }

    /**
     * Get the [optionally formatted] temporal [birthday] column value.
     *
     *
     * @param      string $format The date/time format string (either date()-style or strftime()-style).
     *                            If format is NULL, then the raw DateTime object will be returned.
     *
     * @return string|DateTime Formatted date/time value as string or DateTime object (if format is NULL), NULL if column is NULL, and 0 if column value is 0000-00-00
     *
     * @throws PropelException - if unable to parse/validate the date/time value.
     */
    public function getBirthday($format = NULL)
    {
        if ($format === null) {
            return $this->birthday;
        } else {
            return $this->birthday instanceof \DateTime ? $this->birthday->format($format) : null;
        }
    }

    /**
     * Get the [sex] column value.
     *
     * @return int
     */
    public function getSex()
    {
        return $this->sex;
    }

    /**
     * Get the [furcolour] column value.
     *
     * @return int
     */
    public function getFurcolour()
    {
        return $this->furcolour;
    }

    /**
     * Get the [eyecolour] column value.
     *
     * @return int
     */
    public function getEyecolour()
    {
        return $this->eyecolour;
    }

    /**
     * Get the [size] column value.
     *
     * @return int
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * Get the [specification] column value.
     *
     * @return string
     */
    public function getSpecification()
    {
        return $this->specification;
    }

    /**
     * Get the [user] column value.
     *
     * @return int
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Get the [race] column value.
     *
     * @return int
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set the value of [animal] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setAnimal($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->animal !== $v) {
            $this->animal = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_ANIMAL] = true;
        }

        return $this;
    } // setAnimal()

    /**
     * Set the value of [name] column.
     *
     * @param string $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setName($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->name !== $v) {
            $this->name = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_NAME] = true;
        }

        return $this;
    } // setName()

    /**
     * Set the value of [genus] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setGenus($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->genus !== $v) {
            $this->genus = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_GENUS] = true;
        }

        if ($this->aGenuses !== null && $this->aGenuses->getGenus() !== $v) {
            $this->aGenuses = null;
        }

        return $this;
    } // setGenus()

    /**
     * Sets the value of [birthday] column to a normalized version of the date/time value specified.
     *
     * @param  mixed $v string, integer (timestamp), or \DateTime value.
     *               Empty strings are treated as NULL.
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setBirthday($v)
    {
        $dt = PropelDateTime::newInstance($v, null, 'DateTime');
        if ($this->birthday !== null || $dt !== null) {
            if ($this->birthday === null || $dt === null || $dt->format("Y-m-d") !== $this->birthday->format("Y-m-d")) {
                $this->birthday = $dt === null ? null : clone $dt;
                $this->modifiedColumns[AnimalsTableMap::COL_BIRTHDAY] = true;
            }
        } // if either are not null

        return $this;
    } // setBirthday()

    /**
     * Set the value of [sex] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setSex($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->sex !== $v) {
            $this->sex = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_SEX] = true;
        }

        if ($this->aSexes !== null && $this->aSexes->getSex() !== $v) {
            $this->aSexes = null;
        }

        return $this;
    } // setSex()

    /**
     * Set the value of [furcolour] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setFurcolour($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->furcolour !== $v) {
            $this->furcolour = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_FURCOLOUR] = true;
        }

        if ($this->aColoursRelatedByFurcolour !== null && $this->aColoursRelatedByFurcolour->getColour() !== $v) {
            $this->aColoursRelatedByFurcolour = null;
        }

        return $this;
    } // setFurcolour()

    /**
     * Set the value of [eyecolour] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setEyecolour($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->eyecolour !== $v) {
            $this->eyecolour = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_EYECOLOUR] = true;
        }

        if ($this->aColoursRelatedByEyecolour !== null && $this->aColoursRelatedByEyecolour->getColour() !== $v) {
            $this->aColoursRelatedByEyecolour = null;
        }

        return $this;
    } // setEyecolour()

    /**
     * Set the value of [size] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setSize($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->size !== $v) {
            $this->size = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_SIZE] = true;
        }

        return $this;
    } // setSize()

    /**
     * Set the value of [specification] column.
     *
     * @param string $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setSpecification($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->specification !== $v) {
            $this->specification = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_SPECIFICATION] = true;
        }

        return $this;
    } // setSpecification()

    /**
     * Set the value of [user] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setUser($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->user !== $v) {
            $this->user = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_USER] = true;
        }

        if ($this->aUsers !== null && $this->aUsers->getUser() !== $v) {
            $this->aUsers = null;
        }

        return $this;
    } // setUser()

    /**
     * Set the value of [race] column.
     *
     * @param int $v new value
     * @return $this|\Animals The current object (for fluent API support)
     */
    public function setRace($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->race !== $v) {
            $this->race = $v;
            $this->modifiedColumns[AnimalsTableMap::COL_RACE] = true;
        }

        if ($this->aRaces !== null && $this->aRaces->getRace() !== $v) {
            $this->aRaces = null;
        }

        return $this;
    } // setRace()

    /**
     * Indicates whether the columns in this object are only set to default values.
     *
     * This method can be used in conjunction with isModified() to indicate whether an object is both
     * modified _and_ has some values set which are non-default.
     *
     * @return boolean Whether the columns in this object are only been set with default values.
     */
    public function hasOnlyDefaultValues()
    {
        // otherwise, everything was equal, so return TRUE
        return true;
    } // hasOnlyDefaultValues()

    /**
     * Hydrates (populates) the object variables with values from the database resultset.
     *
     * An offset (0-based "start column") is specified so that objects can be hydrated
     * with a subset of the columns in the resultset rows.  This is needed, for example,
     * for results of JOIN queries where the resultset row includes columns from two or
     * more tables.
     *
     * @param array   $row       The row returned by DataFetcher->fetch().
     * @param int     $startcol  0-based offset column which indicates which restultset column to start with.
     * @param boolean $rehydrate Whether this object is being re-hydrated from the database.
     * @param string  $indexType The index type of $row. Mostly DataFetcher->getIndexType().
                                  One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                            TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *
     * @return int             next starting column
     * @throws PropelException - Any caught Exception will be rewrapped as a PropelException.
     */
    public function hydrate($row, $startcol = 0, $rehydrate = false, $indexType = TableMap::TYPE_NUM)
    {
        try {

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : AnimalsTableMap::translateFieldName('Animal', TableMap::TYPE_PHPNAME, $indexType)];
            $this->animal = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : AnimalsTableMap::translateFieldName('Name', TableMap::TYPE_PHPNAME, $indexType)];
            $this->name = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 2 + $startcol : AnimalsTableMap::translateFieldName('Genus', TableMap::TYPE_PHPNAME, $indexType)];
            $this->genus = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 3 + $startcol : AnimalsTableMap::translateFieldName('Birthday', TableMap::TYPE_PHPNAME, $indexType)];
            if ($col === '0000-00-00') {
                $col = null;
            }
            $this->birthday = (null !== $col) ? PropelDateTime::newInstance($col, null, 'DateTime') : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 4 + $startcol : AnimalsTableMap::translateFieldName('Sex', TableMap::TYPE_PHPNAME, $indexType)];
            $this->sex = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 5 + $startcol : AnimalsTableMap::translateFieldName('Furcolour', TableMap::TYPE_PHPNAME, $indexType)];
            $this->furcolour = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 6 + $startcol : AnimalsTableMap::translateFieldName('Eyecolour', TableMap::TYPE_PHPNAME, $indexType)];
            $this->eyecolour = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 7 + $startcol : AnimalsTableMap::translateFieldName('Size', TableMap::TYPE_PHPNAME, $indexType)];
            $this->size = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 8 + $startcol : AnimalsTableMap::translateFieldName('Specification', TableMap::TYPE_PHPNAME, $indexType)];
            $this->specification = (null !== $col) ? (string) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 9 + $startcol : AnimalsTableMap::translateFieldName('User', TableMap::TYPE_PHPNAME, $indexType)];
            $this->user = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 10 + $startcol : AnimalsTableMap::translateFieldName('Race', TableMap::TYPE_PHPNAME, $indexType)];
            $this->race = (null !== $col) ? (int) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 11; // 11 = AnimalsTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Animals'), 0, $e);
        }
    }

    /**
     * Checks and repairs the internal consistency of the object.
     *
     * This method is executed after an already-instantiated object is re-hydrated
     * from the database.  It exists to check any foreign keys to make sure that
     * the objects related to the current object are correct based on foreign key.
     *
     * You can override this method in the stub class, but you should always invoke
     * the base method from the overridden method (i.e. parent::ensureConsistency()),
     * in case your model changes.
     *
     * @throws PropelException
     */
    public function ensureConsistency()
    {
        if ($this->aGenuses !== null && $this->genus !== $this->aGenuses->getGenus()) {
            $this->aGenuses = null;
        }
        if ($this->aSexes !== null && $this->sex !== $this->aSexes->getSex()) {
            $this->aSexes = null;
        }
        if ($this->aColoursRelatedByFurcolour !== null && $this->furcolour !== $this->aColoursRelatedByFurcolour->getColour()) {
            $this->aColoursRelatedByFurcolour = null;
        }
        if ($this->aColoursRelatedByEyecolour !== null && $this->eyecolour !== $this->aColoursRelatedByEyecolour->getColour()) {
            $this->aColoursRelatedByEyecolour = null;
        }
        if ($this->aUsers !== null && $this->user !== $this->aUsers->getUser()) {
            $this->aUsers = null;
        }
        if ($this->aRaces !== null && $this->race !== $this->aRaces->getRace()) {
            $this->aRaces = null;
        }
    } // ensureConsistency

    /**
     * Reloads this object from datastore based on primary key and (optionally) resets all associated objects.
     *
     * This will only work if the object has been saved and has a valid primary key set.
     *
     * @param      boolean $deep (optional) Whether to also de-associated any related objects.
     * @param      ConnectionInterface $con (optional) The ConnectionInterface connection to use.
     * @return void
     * @throws PropelException - if this object is deleted, unsaved or doesn't have pk match in db
     */
    public function reload($deep = false, ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("Cannot reload a deleted object.");
        }

        if ($this->isNew()) {
            throw new PropelException("Cannot reload an unsaved object.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getReadConnection(AnimalsTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildAnimalsQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->aRaces = null;
            $this->aColoursRelatedByFurcolour = null;
            $this->aColoursRelatedByEyecolour = null;
            $this->aUsers = null;
            $this->aGenuses = null;
            $this->aSexes = null;
        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Animals::setDeleted()
     * @see Animals::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildAnimalsQuery::create()
                ->filterByPrimaryKey($this->getPrimaryKey());
            $ret = $this->preDelete($con);
            if ($ret) {
                $deleteQuery->delete($con);
                $this->postDelete($con);
                $this->setDeleted(true);
            }
        });
    }

    /**
     * Persists this object to the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All modified related objects will also be persisted in the doSave()
     * method.  This method wraps all precipitate database operations in a
     * single transaction.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see doSave()
     */
    public function save(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("You cannot save an object that has been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(AnimalsTableMap::DATABASE_NAME);
        }

        return $con->transaction(function () use ($con) {
            $isInsert = $this->isNew();
            $ret = $this->preSave($con);
            if ($isInsert) {
                $ret = $ret && $this->preInsert($con);
            } else {
                $ret = $ret && $this->preUpdate($con);
            }
            if ($ret) {
                $affectedRows = $this->doSave($con);
                if ($isInsert) {
                    $this->postInsert($con);
                } else {
                    $this->postUpdate($con);
                }
                $this->postSave($con);
                AnimalsTableMap::addInstanceToPool($this);
            } else {
                $affectedRows = 0;
            }

            return $affectedRows;
        });
    }

    /**
     * Performs the work of inserting or updating the row in the database.
     *
     * If the object is new, it inserts it; otherwise an update is performed.
     * All related objects are also updated in this method.
     *
     * @param      ConnectionInterface $con
     * @return int             The number of rows affected by this insert/update and any referring fk objects' save() operations.
     * @throws PropelException
     * @see save()
     */
    protected function doSave(ConnectionInterface $con)
    {
        $affectedRows = 0; // initialize var to track total num of affected rows
        if (!$this->alreadyInSave) {
            $this->alreadyInSave = true;

            // We call the save method on the following object(s) if they
            // were passed to this object by their corresponding set
            // method.  This object relates to these object(s) by a
            // foreign key reference.

            if ($this->aRaces !== null) {
                if ($this->aRaces->isModified() || $this->aRaces->isNew()) {
                    $affectedRows += $this->aRaces->save($con);
                }
                $this->setRaces($this->aRaces);
            }

            if ($this->aColoursRelatedByFurcolour !== null) {
                if ($this->aColoursRelatedByFurcolour->isModified() || $this->aColoursRelatedByFurcolour->isNew()) {
                    $affectedRows += $this->aColoursRelatedByFurcolour->save($con);
                }
                $this->setColoursRelatedByFurcolour($this->aColoursRelatedByFurcolour);
            }

            if ($this->aColoursRelatedByEyecolour !== null) {
                if ($this->aColoursRelatedByEyecolour->isModified() || $this->aColoursRelatedByEyecolour->isNew()) {
                    $affectedRows += $this->aColoursRelatedByEyecolour->save($con);
                }
                $this->setColoursRelatedByEyecolour($this->aColoursRelatedByEyecolour);
            }

            if ($this->aUsers !== null) {
                if ($this->aUsers->isModified() || $this->aUsers->isNew()) {
                    $affectedRows += $this->aUsers->save($con);
                }
                $this->setUsers($this->aUsers);
            }

            if ($this->aGenuses !== null) {
                if ($this->aGenuses->isModified() || $this->aGenuses->isNew()) {
                    $affectedRows += $this->aGenuses->save($con);
                }
                $this->setGenuses($this->aGenuses);
            }

            if ($this->aSexes !== null) {
                if ($this->aSexes->isModified() || $this->aSexes->isNew()) {
                    $affectedRows += $this->aSexes->save($con);
                }
                $this->setSexes($this->aSexes);
            }

            if ($this->isNew() || $this->isModified()) {
                // persist changes
                if ($this->isNew()) {
                    $this->doInsert($con);
                    $affectedRows += 1;
                } else {
                    $affectedRows += $this->doUpdate($con);
                }
                $this->resetModified();
            }

            $this->alreadyInSave = false;

        }

        return $affectedRows;
    } // doSave()

    /**
     * Insert the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @throws PropelException
     * @see doSave()
     */
    protected function doInsert(ConnectionInterface $con)
    {
        $modifiedColumns = array();
        $index = 0;

        $this->modifiedColumns[AnimalsTableMap::COL_ANIMAL] = true;
        if (null !== $this->animal) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . AnimalsTableMap::COL_ANIMAL . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(AnimalsTableMap::COL_ANIMAL)) {
            $modifiedColumns[':p' . $index++]  = 'animal';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_NAME)) {
            $modifiedColumns[':p' . $index++]  = 'name';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_GENUS)) {
            $modifiedColumns[':p' . $index++]  = 'genus';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_BIRTHDAY)) {
            $modifiedColumns[':p' . $index++]  = 'birthDay';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SEX)) {
            $modifiedColumns[':p' . $index++]  = 'sex';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_FURCOLOUR)) {
            $modifiedColumns[':p' . $index++]  = 'furColour';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_EYECOLOUR)) {
            $modifiedColumns[':p' . $index++]  = 'eyeColour';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SIZE)) {
            $modifiedColumns[':p' . $index++]  = 'size';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SPECIFICATION)) {
            $modifiedColumns[':p' . $index++]  = 'specification';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_USER)) {
            $modifiedColumns[':p' . $index++]  = 'user';
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_RACE)) {
            $modifiedColumns[':p' . $index++]  = 'race';
        }

        $sql = sprintf(
            'INSERT INTO animals (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'animal':
                        $stmt->bindValue($identifier, $this->animal, PDO::PARAM_INT);
                        break;
                    case 'name':
                        $stmt->bindValue($identifier, $this->name, PDO::PARAM_STR);
                        break;
                    case 'genus':
                        $stmt->bindValue($identifier, $this->genus, PDO::PARAM_INT);
                        break;
                    case 'birthDay':
                        $stmt->bindValue($identifier, $this->birthday ? $this->birthday->format("Y-m-d H:i:s") : null, PDO::PARAM_STR);
                        break;
                    case 'sex':
                        $stmt->bindValue($identifier, $this->sex, PDO::PARAM_INT);
                        break;
                    case 'furColour':
                        $stmt->bindValue($identifier, $this->furcolour, PDO::PARAM_INT);
                        break;
                    case 'eyeColour':
                        $stmt->bindValue($identifier, $this->eyecolour, PDO::PARAM_INT);
                        break;
                    case 'size':
                        $stmt->bindValue($identifier, $this->size, PDO::PARAM_INT);
                        break;
                    case 'specification':
                        $stmt->bindValue($identifier, $this->specification, PDO::PARAM_STR);
                        break;
                    case 'user':
                        $stmt->bindValue($identifier, $this->user, PDO::PARAM_INT);
                        break;
                    case 'race':
                        $stmt->bindValue($identifier, $this->race, PDO::PARAM_INT);
                        break;
                }
            }
            $stmt->execute();
        } catch (Exception $e) {
            Propel::log($e->getMessage(), Propel::LOG_ERR);
            throw new PropelException(sprintf('Unable to execute INSERT statement [%s]', $sql), 0, $e);
        }

        try {
            $pk = $con->lastInsertId();
        } catch (Exception $e) {
            throw new PropelException('Unable to get autoincrement id.', 0, $e);
        }
        $this->setAnimal($pk);

        $this->setNew(false);
    }

    /**
     * Update the row in the database.
     *
     * @param      ConnectionInterface $con
     *
     * @return Integer Number of updated rows
     * @see doSave()
     */
    protected function doUpdate(ConnectionInterface $con)
    {
        $selectCriteria = $this->buildPkeyCriteria();
        $valuesCriteria = $this->buildCriteria();

        return $selectCriteria->doUpdate($valuesCriteria, $con);
    }

    /**
     * Retrieves a field from the object by name passed in as a string.
     *
     * @param      string $name name
     * @param      string $type The type of fieldname the $name is of:
     *                     one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                     TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                     Defaults to TableMap::TYPE_PHPNAME.
     * @return mixed Value of field.
     */
    public function getByName($name, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AnimalsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
        $field = $this->getByPosition($pos);

        return $field;
    }

    /**
     * Retrieves a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param      int $pos position in xml schema
     * @return mixed Value of field at $pos
     */
    public function getByPosition($pos)
    {
        switch ($pos) {
            case 0:
                return $this->getAnimal();
                break;
            case 1:
                return $this->getName();
                break;
            case 2:
                return $this->getGenus();
                break;
            case 3:
                return $this->getBirthday();
                break;
            case 4:
                return $this->getSex();
                break;
            case 5:
                return $this->getFurcolour();
                break;
            case 6:
                return $this->getEyecolour();
                break;
            case 7:
                return $this->getSize();
                break;
            case 8:
                return $this->getSpecification();
                break;
            case 9:
                return $this->getUser();
                break;
            case 10:
                return $this->getRace();
                break;
            default:
                return null;
                break;
        } // switch()
    }

    /**
     * Exports the object as an array.
     *
     * You can specify the key type of the array by passing one of the class
     * type constants.
     *
     * @param     string  $keyType (optional) One of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     *                    TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                    Defaults to TableMap::TYPE_PHPNAME.
     * @param     boolean $includeLazyLoadColumns (optional) Whether to include lazy loaded columns. Defaults to TRUE.
     * @param     array $alreadyDumpedObjects List of objects to skip to avoid recursion
     * @param     boolean $includeForeignObjects (optional) Whether to include hydrated related objects. Default to FALSE.
     *
     * @return array an associative array containing the field names (as keys) and field values
     */
    public function toArray($keyType = TableMap::TYPE_PHPNAME, $includeLazyLoadColumns = true, $alreadyDumpedObjects = array(), $includeForeignObjects = false)
    {

        if (isset($alreadyDumpedObjects['Animals'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Animals'][$this->hashCode()] = true;
        $keys = AnimalsTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getAnimal(),
            $keys[1] => $this->getName(),
            $keys[2] => $this->getGenus(),
            $keys[3] => $this->getBirthday(),
            $keys[4] => $this->getSex(),
            $keys[5] => $this->getFurcolour(),
            $keys[6] => $this->getEyecolour(),
            $keys[7] => $this->getSize(),
            $keys[8] => $this->getSpecification(),
            $keys[9] => $this->getUser(),
            $keys[10] => $this->getRace(),
        );

        $utc = new \DateTimeZone('utc');
        if ($result[$keys[3]] instanceof \DateTime) {
            // When changing timezone we don't want to change existing instances
            $dateTime = clone $result[$keys[3]];
            $result[$keys[3]] = $dateTime->setTimezone($utc)->format('Y-m-d\TH:i:s\Z');
        }

        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->aRaces) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'races';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'races';
                        break;
                    default:
                        $key = 'Races';
                }

                $result[$key] = $this->aRaces->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aColoursRelatedByFurcolour) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'colours';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'colours';
                        break;
                    default:
                        $key = 'Colours';
                }

                $result[$key] = $this->aColoursRelatedByFurcolour->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aColoursRelatedByEyecolour) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'colours';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'colours';
                        break;
                    default:
                        $key = 'Colours';
                }

                $result[$key] = $this->aColoursRelatedByEyecolour->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aUsers) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'users';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'users';
                        break;
                    default:
                        $key = 'Users';
                }

                $result[$key] = $this->aUsers->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aGenuses) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'genuses';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'genuses';
                        break;
                    default:
                        $key = 'Genuses';
                }

                $result[$key] = $this->aGenuses->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
            if (null !== $this->aSexes) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'sexes';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'sexes';
                        break;
                    default:
                        $key = 'Sexes';
                }

                $result[$key] = $this->aSexes->toArray($keyType, $includeLazyLoadColumns,  $alreadyDumpedObjects, true);
            }
        }

        return $result;
    }

    /**
     * Sets a field from the object by name passed in as a string.
     *
     * @param  string $name
     * @param  mixed  $value field value
     * @param  string $type The type of fieldname the $name is of:
     *                one of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME
     *                TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     *                Defaults to TableMap::TYPE_PHPNAME.
     * @return $this|\Animals
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = AnimalsTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Animals
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setAnimal($value);
                break;
            case 1:
                $this->setName($value);
                break;
            case 2:
                $this->setGenus($value);
                break;
            case 3:
                $this->setBirthday($value);
                break;
            case 4:
                $this->setSex($value);
                break;
            case 5:
                $this->setFurcolour($value);
                break;
            case 6:
                $this->setEyecolour($value);
                break;
            case 7:
                $this->setSize($value);
                break;
            case 8:
                $this->setSpecification($value);
                break;
            case 9:
                $this->setUser($value);
                break;
            case 10:
                $this->setRace($value);
                break;
        } // switch()

        return $this;
    }

    /**
     * Populates the object using an array.
     *
     * This is particularly useful when populating an object from one of the
     * request arrays (e.g. $_POST).  This method goes through the column
     * names, checking to see whether a matching key exists in populated
     * array. If so the setByName() method is called for that column.
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param      array  $arr     An array to populate the object from.
     * @param      string $keyType The type of keys the array uses.
     * @return void
     */
    public function fromArray($arr, $keyType = TableMap::TYPE_PHPNAME)
    {
        $keys = AnimalsTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setAnimal($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setName($arr[$keys[1]]);
        }
        if (array_key_exists($keys[2], $arr)) {
            $this->setGenus($arr[$keys[2]]);
        }
        if (array_key_exists($keys[3], $arr)) {
            $this->setBirthday($arr[$keys[3]]);
        }
        if (array_key_exists($keys[4], $arr)) {
            $this->setSex($arr[$keys[4]]);
        }
        if (array_key_exists($keys[5], $arr)) {
            $this->setFurcolour($arr[$keys[5]]);
        }
        if (array_key_exists($keys[6], $arr)) {
            $this->setEyecolour($arr[$keys[6]]);
        }
        if (array_key_exists($keys[7], $arr)) {
            $this->setSize($arr[$keys[7]]);
        }
        if (array_key_exists($keys[8], $arr)) {
            $this->setSpecification($arr[$keys[8]]);
        }
        if (array_key_exists($keys[9], $arr)) {
            $this->setUser($arr[$keys[9]]);
        }
        if (array_key_exists($keys[10], $arr)) {
            $this->setRace($arr[$keys[10]]);
        }
    }

     /**
     * Populate the current object from a string, using a given parser format
     * <code>
     * $book = new Book();
     * $book->importFrom('JSON', '{"Id":9012,"Title":"Don Juan","ISBN":"0140422161","Price":12.99,"PublisherId":1234,"AuthorId":5678}');
     * </code>
     *
     * You can specify the key type of the array by additionally passing one
     * of the class type constants TableMap::TYPE_PHPNAME, TableMap::TYPE_CAMELNAME,
     * TableMap::TYPE_COLNAME, TableMap::TYPE_FIELDNAME, TableMap::TYPE_NUM.
     * The default key type is the column's TableMap::TYPE_PHPNAME.
     *
     * @param mixed $parser A AbstractParser instance,
     *                       or a format name ('XML', 'YAML', 'JSON', 'CSV')
     * @param string $data The source data to import from
     * @param string $keyType The type of keys the array uses.
     *
     * @return $this|\Animals The current object, for fluid interface
     */
    public function importFrom($parser, $data, $keyType = TableMap::TYPE_PHPNAME)
    {
        if (!$parser instanceof AbstractParser) {
            $parser = AbstractParser::getParser($parser);
        }

        $this->fromArray($parser->toArray($data), $keyType);

        return $this;
    }

    /**
     * Build a Criteria object containing the values of all modified columns in this object.
     *
     * @return Criteria The Criteria object containing all modified values.
     */
    public function buildCriteria()
    {
        $criteria = new Criteria(AnimalsTableMap::DATABASE_NAME);

        if ($this->isColumnModified(AnimalsTableMap::COL_ANIMAL)) {
            $criteria->add(AnimalsTableMap::COL_ANIMAL, $this->animal);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_NAME)) {
            $criteria->add(AnimalsTableMap::COL_NAME, $this->name);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_GENUS)) {
            $criteria->add(AnimalsTableMap::COL_GENUS, $this->genus);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_BIRTHDAY)) {
            $criteria->add(AnimalsTableMap::COL_BIRTHDAY, $this->birthday);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SEX)) {
            $criteria->add(AnimalsTableMap::COL_SEX, $this->sex);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_FURCOLOUR)) {
            $criteria->add(AnimalsTableMap::COL_FURCOLOUR, $this->furcolour);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_EYECOLOUR)) {
            $criteria->add(AnimalsTableMap::COL_EYECOLOUR, $this->eyecolour);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SIZE)) {
            $criteria->add(AnimalsTableMap::COL_SIZE, $this->size);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_SPECIFICATION)) {
            $criteria->add(AnimalsTableMap::COL_SPECIFICATION, $this->specification);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_USER)) {
            $criteria->add(AnimalsTableMap::COL_USER, $this->user);
        }
        if ($this->isColumnModified(AnimalsTableMap::COL_RACE)) {
            $criteria->add(AnimalsTableMap::COL_RACE, $this->race);
        }

        return $criteria;
    }

    /**
     * Builds a Criteria object containing the primary key for this object.
     *
     * Unlike buildCriteria() this method includes the primary key values regardless
     * of whether or not they have been modified.
     *
     * @throws LogicException if no primary key is defined
     *
     * @return Criteria The Criteria object containing value(s) for primary key(s).
     */
    public function buildPkeyCriteria()
    {
        $criteria = ChildAnimalsQuery::create();
        $criteria->add(AnimalsTableMap::COL_ANIMAL, $this->animal);

        return $criteria;
    }

    /**
     * If the primary key is not null, return the hashcode of the
     * primary key. Otherwise, return the hash code of the object.
     *
     * @return int Hashcode
     */
    public function hashCode()
    {
        $validPk = null !== $this->getAnimal();

        $validPrimaryKeyFKs = 0;
        $primaryKeyFKs = [];

        if ($validPk) {
            return crc32(json_encode($this->getPrimaryKey(), JSON_UNESCAPED_UNICODE));
        } elseif ($validPrimaryKeyFKs) {
            return crc32(json_encode($primaryKeyFKs, JSON_UNESCAPED_UNICODE));
        }

        return spl_object_hash($this);
    }

    /**
     * Returns the primary key for this object (row).
     * @return int
     */
    public function getPrimaryKey()
    {
        return $this->getAnimal();
    }

    /**
     * Generic method to set the primary key (animal column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setAnimal($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getAnimal();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Animals (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setName($this->getName());
        $copyObj->setGenus($this->getGenus());
        $copyObj->setBirthday($this->getBirthday());
        $copyObj->setSex($this->getSex());
        $copyObj->setFurcolour($this->getFurcolour());
        $copyObj->setEyecolour($this->getEyecolour());
        $copyObj->setSize($this->getSize());
        $copyObj->setSpecification($this->getSpecification());
        $copyObj->setUser($this->getUser());
        $copyObj->setRace($this->getRace());
        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setAnimal(NULL); // this is a auto-increment column, so set to default value
        }
    }

    /**
     * Makes a copy of this object that will be inserted as a new row in table when saved.
     * It creates a new object filling in the simple attributes, but skipping any primary
     * keys that are defined for the table.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param  boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @return \Animals Clone of current object.
     * @throws PropelException
     */
    public function copy($deepCopy = false)
    {
        // we use get_class(), because this might be a subclass
        $clazz = get_class($this);
        $copyObj = new $clazz();
        $this->copyInto($copyObj, $deepCopy);

        return $copyObj;
    }

    /**
     * Declares an association between this object and a ChildRaces object.
     *
     * @param  ChildRaces $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setRaces(ChildRaces $v = null)
    {
        if ($v === null) {
            $this->setRace(NULL);
        } else {
            $this->setRace($v->getRace());
        }

        $this->aRaces = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildRaces object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimals($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildRaces object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildRaces The associated ChildRaces object.
     * @throws PropelException
     */
    public function getRaces(ConnectionInterface $con = null)
    {
        if ($this->aRaces === null && ($this->race !== null)) {
            $this->aRaces = ChildRacesQuery::create()->findPk($this->race, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aRaces->addAnimalss($this);
             */
        }

        return $this->aRaces;
    }

    /**
     * Declares an association between this object and a ChildColours object.
     *
     * @param  ChildColours $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setColoursRelatedByFurcolour(ChildColours $v = null)
    {
        if ($v === null) {
            $this->setFurcolour(NULL);
        } else {
            $this->setFurcolour($v->getColour());
        }

        $this->aColoursRelatedByFurcolour = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildColours object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimalsRelatedByFurcolour($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildColours object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildColours The associated ChildColours object.
     * @throws PropelException
     */
    public function getColoursRelatedByFurcolour(ConnectionInterface $con = null)
    {
        if ($this->aColoursRelatedByFurcolour === null && ($this->furcolour !== null)) {
            $this->aColoursRelatedByFurcolour = ChildColoursQuery::create()->findPk($this->furcolour, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aColoursRelatedByFurcolour->addAnimalssRelatedByFurcolour($this);
             */
        }

        return $this->aColoursRelatedByFurcolour;
    }

    /**
     * Declares an association between this object and a ChildColours object.
     *
     * @param  ChildColours $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setColoursRelatedByEyecolour(ChildColours $v = null)
    {
        if ($v === null) {
            $this->setEyecolour(NULL);
        } else {
            $this->setEyecolour($v->getColour());
        }

        $this->aColoursRelatedByEyecolour = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildColours object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimalsRelatedByEyecolour($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildColours object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildColours The associated ChildColours object.
     * @throws PropelException
     */
    public function getColoursRelatedByEyecolour(ConnectionInterface $con = null)
    {
        if ($this->aColoursRelatedByEyecolour === null && ($this->eyecolour !== null)) {
            $this->aColoursRelatedByEyecolour = ChildColoursQuery::create()->findPk($this->eyecolour, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aColoursRelatedByEyecolour->addAnimalssRelatedByEyecolour($this);
             */
        }

        return $this->aColoursRelatedByEyecolour;
    }

    /**
     * Declares an association between this object and a ChildUsers object.
     *
     * @param  ChildUsers $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setUsers(ChildUsers $v = null)
    {
        if ($v === null) {
            $this->setUser(NULL);
        } else {
            $this->setUser($v->getUser());
        }

        $this->aUsers = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildUsers object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimals($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildUsers object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildUsers The associated ChildUsers object.
     * @throws PropelException
     */
    public function getUsers(ConnectionInterface $con = null)
    {
        if ($this->aUsers === null && ($this->user !== null)) {
            $this->aUsers = ChildUsersQuery::create()->findPk($this->user, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aUsers->addAnimalss($this);
             */
        }

        return $this->aUsers;
    }

    /**
     * Declares an association between this object and a ChildGenuses object.
     *
     * @param  ChildGenuses $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setGenuses(ChildGenuses $v = null)
    {
        if ($v === null) {
            $this->setGenus(NULL);
        } else {
            $this->setGenus($v->getGenus());
        }

        $this->aGenuses = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildGenuses object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimals($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildGenuses object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildGenuses The associated ChildGenuses object.
     * @throws PropelException
     */
    public function getGenuses(ConnectionInterface $con = null)
    {
        if ($this->aGenuses === null && ($this->genus !== null)) {
            $this->aGenuses = ChildGenusesQuery::create()->findPk($this->genus, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aGenuses->addAnimalss($this);
             */
        }

        return $this->aGenuses;
    }

    /**
     * Declares an association between this object and a ChildSexes object.
     *
     * @param  ChildSexes $v
     * @return $this|\Animals The current object (for fluent API support)
     * @throws PropelException
     */
    public function setSexes(ChildSexes $v = null)
    {
        if ($v === null) {
            $this->setSex(NULL);
        } else {
            $this->setSex($v->getSex());
        }

        $this->aSexes = $v;

        // Add binding for other direction of this n:n relationship.
        // If this object has already been added to the ChildSexes object, it will not be re-added.
        if ($v !== null) {
            $v->addAnimals($this);
        }


        return $this;
    }


    /**
     * Get the associated ChildSexes object
     *
     * @param  ConnectionInterface $con Optional Connection object.
     * @return ChildSexes The associated ChildSexes object.
     * @throws PropelException
     */
    public function getSexes(ConnectionInterface $con = null)
    {
        if ($this->aSexes === null && ($this->sex !== null)) {
            $this->aSexes = ChildSexesQuery::create()->findPk($this->sex, $con);
            /* The following can be used additionally to
                guarantee the related object contains a reference
                to this object.  This level of coupling may, however, be
                undesirable since it could result in an only partially populated collection
                in the referenced object.
                $this->aSexes->addAnimalss($this);
             */
        }

        return $this->aSexes;
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        if (null !== $this->aRaces) {
            $this->aRaces->removeAnimals($this);
        }
        if (null !== $this->aColoursRelatedByFurcolour) {
            $this->aColoursRelatedByFurcolour->removeAnimalsRelatedByFurcolour($this);
        }
        if (null !== $this->aColoursRelatedByEyecolour) {
            $this->aColoursRelatedByEyecolour->removeAnimalsRelatedByEyecolour($this);
        }
        if (null !== $this->aUsers) {
            $this->aUsers->removeAnimals($this);
        }
        if (null !== $this->aGenuses) {
            $this->aGenuses->removeAnimals($this);
        }
        if (null !== $this->aSexes) {
            $this->aSexes->removeAnimals($this);
        }
        $this->animal = null;
        $this->name = null;
        $this->genus = null;
        $this->birthday = null;
        $this->sex = null;
        $this->furcolour = null;
        $this->eyecolour = null;
        $this->size = null;
        $this->specification = null;
        $this->user = null;
        $this->race = null;
        $this->alreadyInSave = false;
        $this->clearAllReferences();
        $this->resetModified();
        $this->setNew(true);
        $this->setDeleted(false);
    }

    /**
     * Resets all references and back-references to other model objects or collections of model objects.
     *
     * This method is used to reset all php object references (not the actual reference in the database).
     * Necessary for object serialisation.
     *
     * @param      boolean $deep Whether to also clear the references on all referrer objects.
     */
    public function clearAllReferences($deep = false)
    {
        if ($deep) {
        } // if ($deep)

        $this->aRaces = null;
        $this->aColoursRelatedByFurcolour = null;
        $this->aColoursRelatedByEyecolour = null;
        $this->aUsers = null;
        $this->aGenuses = null;
        $this->aSexes = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(AnimalsTableMap::DEFAULT_STRING_FORMAT);
    }

    /**
     * Code to be run before persisting the object
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preSave(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after persisting the object
     * @param ConnectionInterface $con
     */
    public function postSave(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before inserting to database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preInsert(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after inserting to database
     * @param ConnectionInterface $con
     */
    public function postInsert(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before updating the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preUpdate(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after updating the object in database
     * @param ConnectionInterface $con
     */
    public function postUpdate(ConnectionInterface $con = null)
    {

    }

    /**
     * Code to be run before deleting the object in database
     * @param  ConnectionInterface $con
     * @return boolean
     */
    public function preDelete(ConnectionInterface $con = null)
    {
        return true;
    }

    /**
     * Code to be run after deleting the object in database
     * @param ConnectionInterface $con
     */
    public function postDelete(ConnectionInterface $con = null)
    {

    }


    /**
     * Derived method to catches calls to undefined methods.
     *
     * Provides magic import/export method support (fromXML()/toXML(), fromYAML()/toYAML(), etc.).
     * Allows to define default __call() behavior if you overwrite __call()
     *
     * @param string $name
     * @param mixed  $params
     *
     * @return array|string
     */
    public function __call($name, $params)
    {
        if (0 === strpos($name, 'get')) {
            $virtualColumn = substr($name, 3);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }

            $virtualColumn = lcfirst($virtualColumn);
            if ($this->hasVirtualColumn($virtualColumn)) {
                return $this->getVirtualColumn($virtualColumn);
            }
        }

        if (0 === strpos($name, 'from')) {
            $format = substr($name, 4);

            return $this->importFrom($format, reset($params));
        }

        if (0 === strpos($name, 'to')) {
            $format = substr($name, 2);
            $includeLazyLoadColumns = isset($params[0]) ? $params[0] : true;

            return $this->exportTo($format, $includeLazyLoadColumns);
        }

        throw new BadMethodCallException(sprintf('Call to undefined method: %s.', $name));
    }

}
