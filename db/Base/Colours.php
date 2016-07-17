<?php

namespace Base;

use \Animals as ChildAnimals;
use \AnimalsQuery as ChildAnimalsQuery;
use \Colours as ChildColours;
use \ColoursQuery as ChildColoursQuery;
use \Exception;
use \PDO;
use Map\ColoursTableMap;
use Propel\Runtime\Propel;
use Propel\Runtime\ActiveQuery\Criteria;
use Propel\Runtime\ActiveQuery\ModelCriteria;
use Propel\Runtime\ActiveRecord\ActiveRecordInterface;
use Propel\Runtime\Collection\Collection;
use Propel\Runtime\Collection\ObjectCollection;
use Propel\Runtime\Connection\ConnectionInterface;
use Propel\Runtime\Exception\BadMethodCallException;
use Propel\Runtime\Exception\LogicException;
use Propel\Runtime\Exception\PropelException;
use Propel\Runtime\Map\TableMap;
use Propel\Runtime\Parser\AbstractParser;

/**
 * Base class that represents a row from the 'colours' table.
 *
 *
 *
* @package    propel.generator..Base
*/
abstract class Colours implements ActiveRecordInterface
{
    /**
     * TableMap class name
     */
    const TABLE_MAP = '\\Map\\ColoursTableMap';


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
     * The value for the colour field.
     * @var        int
     */
    protected $colour;

    /**
     * The value for the code field.
     * @var        string
     */
    protected $code;

    /**
     * @var        ObjectCollection|ChildAnimals[] Collection to store aggregation of ChildAnimals objects.
     */
    protected $collAnimalssRelatedByFurcolour;
    protected $collAnimalssRelatedByFurcolourPartial;

    /**
     * @var        ObjectCollection|ChildAnimals[] Collection to store aggregation of ChildAnimals objects.
     */
    protected $collAnimalssRelatedByEyecolour;
    protected $collAnimalssRelatedByEyecolourPartial;

    /**
     * Flag to prevent endless save loop, if this object is referenced
     * by another object which falls in this transaction.
     *
     * @var boolean
     */
    protected $alreadyInSave = false;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAnimals[]
     */
    protected $animalssRelatedByFurcolourScheduledForDeletion = null;

    /**
     * An array of objects scheduled for deletion.
     * @var ObjectCollection|ChildAnimals[]
     */
    protected $animalssRelatedByEyecolourScheduledForDeletion = null;

    /**
     * Initializes internal state of Base\Colours object.
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
     * Compares this with another <code>Colours</code> instance.  If
     * <code>obj</code> is an instance of <code>Colours</code>, delegates to
     * <code>equals(Colours)</code>.  Otherwise, returns <code>false</code>.
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
     * @return $this|Colours The current object, for fluid interface
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
     * Get the [colour] column value.
     *
     * @return int
     */
    public function getColour()
    {
        return $this->colour;
    }

    /**
     * Get the [code] column value.
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set the value of [colour] column.
     *
     * @param int $v new value
     * @return $this|\Colours The current object (for fluent API support)
     */
    public function setColour($v)
    {
        if ($v !== null) {
            $v = (int) $v;
        }

        if ($this->colour !== $v) {
            $this->colour = $v;
            $this->modifiedColumns[ColoursTableMap::COL_COLOUR] = true;
        }

        return $this;
    } // setColour()

    /**
     * Set the value of [code] column.
     *
     * @param string $v new value
     * @return $this|\Colours The current object (for fluent API support)
     */
    public function setCode($v)
    {
        if ($v !== null) {
            $v = (string) $v;
        }

        if ($this->code !== $v) {
            $this->code = $v;
            $this->modifiedColumns[ColoursTableMap::COL_CODE] = true;
        }

        return $this;
    } // setCode()

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

            $col = $row[TableMap::TYPE_NUM == $indexType ? 0 + $startcol : ColoursTableMap::translateFieldName('Colour', TableMap::TYPE_PHPNAME, $indexType)];
            $this->colour = (null !== $col) ? (int) $col : null;

            $col = $row[TableMap::TYPE_NUM == $indexType ? 1 + $startcol : ColoursTableMap::translateFieldName('Code', TableMap::TYPE_PHPNAME, $indexType)];
            $this->code = (null !== $col) ? (string) $col : null;
            $this->resetModified();

            $this->setNew(false);

            if ($rehydrate) {
                $this->ensureConsistency();
            }

            return $startcol + 2; // 2 = ColoursTableMap::NUM_HYDRATE_COLUMNS.

        } catch (Exception $e) {
            throw new PropelException(sprintf('Error populating %s object', '\\Colours'), 0, $e);
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
            $con = Propel::getServiceContainer()->getReadConnection(ColoursTableMap::DATABASE_NAME);
        }

        // We don't need to alter the object instance pool; we're just modifying this instance
        // already in the pool.

        $dataFetcher = ChildColoursQuery::create(null, $this->buildPkeyCriteria())->setFormatter(ModelCriteria::FORMAT_STATEMENT)->find($con);
        $row = $dataFetcher->fetch();
        $dataFetcher->close();
        if (!$row) {
            throw new PropelException('Cannot find matching row in the database to reload object values.');
        }
        $this->hydrate($row, 0, true, $dataFetcher->getIndexType()); // rehydrate

        if ($deep) {  // also de-associate any related objects?

            $this->collAnimalssRelatedByFurcolour = null;

            $this->collAnimalssRelatedByEyecolour = null;

        } // if (deep)
    }

    /**
     * Removes this object from datastore and sets delete attribute.
     *
     * @param      ConnectionInterface $con
     * @return void
     * @throws PropelException
     * @see Colours::setDeleted()
     * @see Colours::isDeleted()
     */
    public function delete(ConnectionInterface $con = null)
    {
        if ($this->isDeleted()) {
            throw new PropelException("This object has already been deleted.");
        }

        if ($con === null) {
            $con = Propel::getServiceContainer()->getWriteConnection(ColoursTableMap::DATABASE_NAME);
        }

        $con->transaction(function () use ($con) {
            $deleteQuery = ChildColoursQuery::create()
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
            $con = Propel::getServiceContainer()->getWriteConnection(ColoursTableMap::DATABASE_NAME);
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
                ColoursTableMap::addInstanceToPool($this);
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

            if ($this->animalssRelatedByFurcolourScheduledForDeletion !== null) {
                if (!$this->animalssRelatedByFurcolourScheduledForDeletion->isEmpty()) {
                    \AnimalsQuery::create()
                        ->filterByPrimaryKeys($this->animalssRelatedByFurcolourScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->animalssRelatedByFurcolourScheduledForDeletion = null;
                }
            }

            if ($this->collAnimalssRelatedByFurcolour !== null) {
                foreach ($this->collAnimalssRelatedByFurcolour as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
            }

            if ($this->animalssRelatedByEyecolourScheduledForDeletion !== null) {
                if (!$this->animalssRelatedByEyecolourScheduledForDeletion->isEmpty()) {
                    \AnimalsQuery::create()
                        ->filterByPrimaryKeys($this->animalssRelatedByEyecolourScheduledForDeletion->getPrimaryKeys(false))
                        ->delete($con);
                    $this->animalssRelatedByEyecolourScheduledForDeletion = null;
                }
            }

            if ($this->collAnimalssRelatedByEyecolour !== null) {
                foreach ($this->collAnimalssRelatedByEyecolour as $referrerFK) {
                    if (!$referrerFK->isDeleted() && ($referrerFK->isNew() || $referrerFK->isModified())) {
                        $affectedRows += $referrerFK->save($con);
                    }
                }
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

        $this->modifiedColumns[ColoursTableMap::COL_COLOUR] = true;
        if (null !== $this->colour) {
            throw new PropelException('Cannot insert a value for auto-increment primary key (' . ColoursTableMap::COL_COLOUR . ')');
        }

         // check the columns in natural order for more readable SQL queries
        if ($this->isColumnModified(ColoursTableMap::COL_COLOUR)) {
            $modifiedColumns[':p' . $index++]  = 'colour';
        }
        if ($this->isColumnModified(ColoursTableMap::COL_CODE)) {
            $modifiedColumns[':p' . $index++]  = 'code';
        }

        $sql = sprintf(
            'INSERT INTO colours (%s) VALUES (%s)',
            implode(', ', $modifiedColumns),
            implode(', ', array_keys($modifiedColumns))
        );

        try {
            $stmt = $con->prepare($sql);
            foreach ($modifiedColumns as $identifier => $columnName) {
                switch ($columnName) {
                    case 'colour':
                        $stmt->bindValue($identifier, $this->colour, PDO::PARAM_INT);
                        break;
                    case 'code':
                        $stmt->bindValue($identifier, $this->code, PDO::PARAM_STR);
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
        $this->setColour($pk);

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
        $pos = ColoursTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);
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
                return $this->getColour();
                break;
            case 1:
                return $this->getCode();
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

        if (isset($alreadyDumpedObjects['Colours'][$this->hashCode()])) {
            return '*RECURSION*';
        }
        $alreadyDumpedObjects['Colours'][$this->hashCode()] = true;
        $keys = ColoursTableMap::getFieldNames($keyType);
        $result = array(
            $keys[0] => $this->getColour(),
            $keys[1] => $this->getCode(),
        );
        $virtualColumns = $this->virtualColumns;
        foreach ($virtualColumns as $key => $virtualColumn) {
            $result[$key] = $virtualColumn;
        }

        if ($includeForeignObjects) {
            if (null !== $this->collAnimalssRelatedByFurcolour) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'animalss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'animalss';
                        break;
                    default:
                        $key = 'Animalss';
                }

                $result[$key] = $this->collAnimalssRelatedByFurcolour->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
            }
            if (null !== $this->collAnimalssRelatedByEyecolour) {

                switch ($keyType) {
                    case TableMap::TYPE_CAMELNAME:
                        $key = 'animalss';
                        break;
                    case TableMap::TYPE_FIELDNAME:
                        $key = 'animalss';
                        break;
                    default:
                        $key = 'Animalss';
                }

                $result[$key] = $this->collAnimalssRelatedByEyecolour->toArray(null, false, $keyType, $includeLazyLoadColumns, $alreadyDumpedObjects);
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
     * @return $this|\Colours
     */
    public function setByName($name, $value, $type = TableMap::TYPE_PHPNAME)
    {
        $pos = ColoursTableMap::translateFieldName($name, $type, TableMap::TYPE_NUM);

        return $this->setByPosition($pos, $value);
    }

    /**
     * Sets a field from the object by Position as specified in the xml schema.
     * Zero-based.
     *
     * @param  int $pos position in xml schema
     * @param  mixed $value field value
     * @return $this|\Colours
     */
    public function setByPosition($pos, $value)
    {
        switch ($pos) {
            case 0:
                $this->setColour($value);
                break;
            case 1:
                $this->setCode($value);
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
        $keys = ColoursTableMap::getFieldNames($keyType);

        if (array_key_exists($keys[0], $arr)) {
            $this->setColour($arr[$keys[0]]);
        }
        if (array_key_exists($keys[1], $arr)) {
            $this->setCode($arr[$keys[1]]);
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
     * @return $this|\Colours The current object, for fluid interface
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
        $criteria = new Criteria(ColoursTableMap::DATABASE_NAME);

        if ($this->isColumnModified(ColoursTableMap::COL_COLOUR)) {
            $criteria->add(ColoursTableMap::COL_COLOUR, $this->colour);
        }
        if ($this->isColumnModified(ColoursTableMap::COL_CODE)) {
            $criteria->add(ColoursTableMap::COL_CODE, $this->code);
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
        $criteria = ChildColoursQuery::create();
        $criteria->add(ColoursTableMap::COL_COLOUR, $this->colour);

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
        $validPk = null !== $this->getColour();

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
        return $this->getColour();
    }

    /**
     * Generic method to set the primary key (colour column).
     *
     * @param       int $key Primary key.
     * @return void
     */
    public function setPrimaryKey($key)
    {
        $this->setColour($key);
    }

    /**
     * Returns true if the primary key for this object is null.
     * @return boolean
     */
    public function isPrimaryKeyNull()
    {
        return null === $this->getColour();
    }

    /**
     * Sets contents of passed object to values from current object.
     *
     * If desired, this method can also make copies of all associated (fkey referrers)
     * objects.
     *
     * @param      object $copyObj An object of \Colours (or compatible) type.
     * @param      boolean $deepCopy Whether to also copy all rows that refer (by fkey) to the current row.
     * @param      boolean $makeNew Whether to reset autoincrement PKs and make the object new.
     * @throws PropelException
     */
    public function copyInto($copyObj, $deepCopy = false, $makeNew = true)
    {
        $copyObj->setCode($this->getCode());

        if ($deepCopy) {
            // important: temporarily setNew(false) because this affects the behavior of
            // the getter/setter methods for fkey referrer objects.
            $copyObj->setNew(false);

            foreach ($this->getAnimalssRelatedByFurcolour() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAnimalsRelatedByFurcolour($relObj->copy($deepCopy));
                }
            }

            foreach ($this->getAnimalssRelatedByEyecolour() as $relObj) {
                if ($relObj !== $this) {  // ensure that we don't try to copy a reference to ourselves
                    $copyObj->addAnimalsRelatedByEyecolour($relObj->copy($deepCopy));
                }
            }

        } // if ($deepCopy)

        if ($makeNew) {
            $copyObj->setNew(true);
            $copyObj->setColour(NULL); // this is a auto-increment column, so set to default value
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
     * @return \Colours Clone of current object.
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
     * Initializes a collection based on the name of a relation.
     * Avoids crafting an 'init[$relationName]s' method name
     * that wouldn't work when StandardEnglishPluralizer is used.
     *
     * @param      string $relationName The name of the relation to initialize
     * @return void
     */
    public function initRelation($relationName)
    {
        if ('AnimalsRelatedByFurcolour' == $relationName) {
            return $this->initAnimalssRelatedByFurcolour();
        }
        if ('AnimalsRelatedByEyecolour' == $relationName) {
            return $this->initAnimalssRelatedByEyecolour();
        }
    }

    /**
     * Clears out the collAnimalssRelatedByFurcolour collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAnimalssRelatedByFurcolour()
     */
    public function clearAnimalssRelatedByFurcolour()
    {
        $this->collAnimalssRelatedByFurcolour = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAnimalssRelatedByFurcolour collection loaded partially.
     */
    public function resetPartialAnimalssRelatedByFurcolour($v = true)
    {
        $this->collAnimalssRelatedByFurcolourPartial = $v;
    }

    /**
     * Initializes the collAnimalssRelatedByFurcolour collection.
     *
     * By default this just sets the collAnimalssRelatedByFurcolour collection to an empty array (like clearcollAnimalssRelatedByFurcolour());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAnimalssRelatedByFurcolour($overrideExisting = true)
    {
        if (null !== $this->collAnimalssRelatedByFurcolour && !$overrideExisting) {
            return;
        }
        $this->collAnimalssRelatedByFurcolour = new ObjectCollection();
        $this->collAnimalssRelatedByFurcolour->setModel('\Animals');
    }

    /**
     * Gets an array of ChildAnimals objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildColours is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     * @throws PropelException
     */
    public function getAnimalssRelatedByFurcolour(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAnimalssRelatedByFurcolourPartial && !$this->isNew();
        if (null === $this->collAnimalssRelatedByFurcolour || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAnimalssRelatedByFurcolour) {
                // return empty collection
                $this->initAnimalssRelatedByFurcolour();
            } else {
                $collAnimalssRelatedByFurcolour = ChildAnimalsQuery::create(null, $criteria)
                    ->filterByColoursRelatedByFurcolour($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAnimalssRelatedByFurcolourPartial && count($collAnimalssRelatedByFurcolour)) {
                        $this->initAnimalssRelatedByFurcolour(false);

                        foreach ($collAnimalssRelatedByFurcolour as $obj) {
                            if (false == $this->collAnimalssRelatedByFurcolour->contains($obj)) {
                                $this->collAnimalssRelatedByFurcolour->append($obj);
                            }
                        }

                        $this->collAnimalssRelatedByFurcolourPartial = true;
                    }

                    return $collAnimalssRelatedByFurcolour;
                }

                if ($partial && $this->collAnimalssRelatedByFurcolour) {
                    foreach ($this->collAnimalssRelatedByFurcolour as $obj) {
                        if ($obj->isNew()) {
                            $collAnimalssRelatedByFurcolour[] = $obj;
                        }
                    }
                }

                $this->collAnimalssRelatedByFurcolour = $collAnimalssRelatedByFurcolour;
                $this->collAnimalssRelatedByFurcolourPartial = false;
            }
        }

        return $this->collAnimalssRelatedByFurcolour;
    }

    /**
     * Sets a collection of ChildAnimals objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $animalssRelatedByFurcolour A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildColours The current object (for fluent API support)
     */
    public function setAnimalssRelatedByFurcolour(Collection $animalssRelatedByFurcolour, ConnectionInterface $con = null)
    {
        /** @var ChildAnimals[] $animalssRelatedByFurcolourToDelete */
        $animalssRelatedByFurcolourToDelete = $this->getAnimalssRelatedByFurcolour(new Criteria(), $con)->diff($animalssRelatedByFurcolour);


        $this->animalssRelatedByFurcolourScheduledForDeletion = $animalssRelatedByFurcolourToDelete;

        foreach ($animalssRelatedByFurcolourToDelete as $animalsRelatedByFurcolourRemoved) {
            $animalsRelatedByFurcolourRemoved->setColoursRelatedByFurcolour(null);
        }

        $this->collAnimalssRelatedByFurcolour = null;
        foreach ($animalssRelatedByFurcolour as $animalsRelatedByFurcolour) {
            $this->addAnimalsRelatedByFurcolour($animalsRelatedByFurcolour);
        }

        $this->collAnimalssRelatedByFurcolour = $animalssRelatedByFurcolour;
        $this->collAnimalssRelatedByFurcolourPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Animals objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Animals objects.
     * @throws PropelException
     */
    public function countAnimalssRelatedByFurcolour(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAnimalssRelatedByFurcolourPartial && !$this->isNew();
        if (null === $this->collAnimalssRelatedByFurcolour || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAnimalssRelatedByFurcolour) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAnimalssRelatedByFurcolour());
            }

            $query = ChildAnimalsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByColoursRelatedByFurcolour($this)
                ->count($con);
        }

        return count($this->collAnimalssRelatedByFurcolour);
    }

    /**
     * Method called to associate a ChildAnimals object to this object
     * through the ChildAnimals foreign key attribute.
     *
     * @param  ChildAnimals $l ChildAnimals
     * @return $this|\Colours The current object (for fluent API support)
     */
    public function addAnimalsRelatedByFurcolour(ChildAnimals $l)
    {
        if ($this->collAnimalssRelatedByFurcolour === null) {
            $this->initAnimalssRelatedByFurcolour();
            $this->collAnimalssRelatedByFurcolourPartial = true;
        }

        if (!$this->collAnimalssRelatedByFurcolour->contains($l)) {
            $this->doAddAnimalsRelatedByFurcolour($l);
        }

        return $this;
    }

    /**
     * @param ChildAnimals $animalsRelatedByFurcolour The ChildAnimals object to add.
     */
    protected function doAddAnimalsRelatedByFurcolour(ChildAnimals $animalsRelatedByFurcolour)
    {
        $this->collAnimalssRelatedByFurcolour[]= $animalsRelatedByFurcolour;
        $animalsRelatedByFurcolour->setColoursRelatedByFurcolour($this);
    }

    /**
     * @param  ChildAnimals $animalsRelatedByFurcolour The ChildAnimals object to remove.
     * @return $this|ChildColours The current object (for fluent API support)
     */
    public function removeAnimalsRelatedByFurcolour(ChildAnimals $animalsRelatedByFurcolour)
    {
        if ($this->getAnimalssRelatedByFurcolour()->contains($animalsRelatedByFurcolour)) {
            $pos = $this->collAnimalssRelatedByFurcolour->search($animalsRelatedByFurcolour);
            $this->collAnimalssRelatedByFurcolour->remove($pos);
            if (null === $this->animalssRelatedByFurcolourScheduledForDeletion) {
                $this->animalssRelatedByFurcolourScheduledForDeletion = clone $this->collAnimalssRelatedByFurcolour;
                $this->animalssRelatedByFurcolourScheduledForDeletion->clear();
            }
            $this->animalssRelatedByFurcolourScheduledForDeletion[]= clone $animalsRelatedByFurcolour;
            $animalsRelatedByFurcolour->setColoursRelatedByFurcolour(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Colours is new, it will return
     * an empty collection; or if this Colours has previously
     * been saved, it will retrieve related AnimalssRelatedByFurcolour from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Colours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     */
    public function getAnimalssRelatedByFurcolourJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnimalsQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getAnimalssRelatedByFurcolour($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Colours is new, it will return
     * an empty collection; or if this Colours has previously
     * been saved, it will retrieve related AnimalssRelatedByFurcolour from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Colours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     */
    public function getAnimalssRelatedByFurcolourJoinSexes(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnimalsQuery::create(null, $criteria);
        $query->joinWith('Sexes', $joinBehavior);

        return $this->getAnimalssRelatedByFurcolour($query, $con);
    }

    /**
     * Clears out the collAnimalssRelatedByEyecolour collection
     *
     * This does not modify the database; however, it will remove any associated objects, causing
     * them to be refetched by subsequent calls to accessor method.
     *
     * @return void
     * @see        addAnimalssRelatedByEyecolour()
     */
    public function clearAnimalssRelatedByEyecolour()
    {
        $this->collAnimalssRelatedByEyecolour = null; // important to set this to NULL since that means it is uninitialized
    }

    /**
     * Reset is the collAnimalssRelatedByEyecolour collection loaded partially.
     */
    public function resetPartialAnimalssRelatedByEyecolour($v = true)
    {
        $this->collAnimalssRelatedByEyecolourPartial = $v;
    }

    /**
     * Initializes the collAnimalssRelatedByEyecolour collection.
     *
     * By default this just sets the collAnimalssRelatedByEyecolour collection to an empty array (like clearcollAnimalssRelatedByEyecolour());
     * however, you may wish to override this method in your stub class to provide setting appropriate
     * to your application -- for example, setting the initial array to the values stored in database.
     *
     * @param      boolean $overrideExisting If set to true, the method call initializes
     *                                        the collection even if it is not empty
     *
     * @return void
     */
    public function initAnimalssRelatedByEyecolour($overrideExisting = true)
    {
        if (null !== $this->collAnimalssRelatedByEyecolour && !$overrideExisting) {
            return;
        }
        $this->collAnimalssRelatedByEyecolour = new ObjectCollection();
        $this->collAnimalssRelatedByEyecolour->setModel('\Animals');
    }

    /**
     * Gets an array of ChildAnimals objects which contain a foreign key that references this object.
     *
     * If the $criteria is not null, it is used to always fetch the results from the database.
     * Otherwise the results are fetched from the database the first time, then cached.
     * Next time the same method is called without $criteria, the cached collection is returned.
     * If this ChildColours is new, it will return
     * an empty collection or the current collection; the criteria is ignored on a new object.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     * @throws PropelException
     */
    public function getAnimalssRelatedByEyecolour(Criteria $criteria = null, ConnectionInterface $con = null)
    {
        $partial = $this->collAnimalssRelatedByEyecolourPartial && !$this->isNew();
        if (null === $this->collAnimalssRelatedByEyecolour || null !== $criteria  || $partial) {
            if ($this->isNew() && null === $this->collAnimalssRelatedByEyecolour) {
                // return empty collection
                $this->initAnimalssRelatedByEyecolour();
            } else {
                $collAnimalssRelatedByEyecolour = ChildAnimalsQuery::create(null, $criteria)
                    ->filterByColoursRelatedByEyecolour($this)
                    ->find($con);

                if (null !== $criteria) {
                    if (false !== $this->collAnimalssRelatedByEyecolourPartial && count($collAnimalssRelatedByEyecolour)) {
                        $this->initAnimalssRelatedByEyecolour(false);

                        foreach ($collAnimalssRelatedByEyecolour as $obj) {
                            if (false == $this->collAnimalssRelatedByEyecolour->contains($obj)) {
                                $this->collAnimalssRelatedByEyecolour->append($obj);
                            }
                        }

                        $this->collAnimalssRelatedByEyecolourPartial = true;
                    }

                    return $collAnimalssRelatedByEyecolour;
                }

                if ($partial && $this->collAnimalssRelatedByEyecolour) {
                    foreach ($this->collAnimalssRelatedByEyecolour as $obj) {
                        if ($obj->isNew()) {
                            $collAnimalssRelatedByEyecolour[] = $obj;
                        }
                    }
                }

                $this->collAnimalssRelatedByEyecolour = $collAnimalssRelatedByEyecolour;
                $this->collAnimalssRelatedByEyecolourPartial = false;
            }
        }

        return $this->collAnimalssRelatedByEyecolour;
    }

    /**
     * Sets a collection of ChildAnimals objects related by a one-to-many relationship
     * to the current object.
     * It will also schedule objects for deletion based on a diff between old objects (aka persisted)
     * and new objects from the given Propel collection.
     *
     * @param      Collection $animalssRelatedByEyecolour A Propel collection.
     * @param      ConnectionInterface $con Optional connection object
     * @return $this|ChildColours The current object (for fluent API support)
     */
    public function setAnimalssRelatedByEyecolour(Collection $animalssRelatedByEyecolour, ConnectionInterface $con = null)
    {
        /** @var ChildAnimals[] $animalssRelatedByEyecolourToDelete */
        $animalssRelatedByEyecolourToDelete = $this->getAnimalssRelatedByEyecolour(new Criteria(), $con)->diff($animalssRelatedByEyecolour);


        $this->animalssRelatedByEyecolourScheduledForDeletion = $animalssRelatedByEyecolourToDelete;

        foreach ($animalssRelatedByEyecolourToDelete as $animalsRelatedByEyecolourRemoved) {
            $animalsRelatedByEyecolourRemoved->setColoursRelatedByEyecolour(null);
        }

        $this->collAnimalssRelatedByEyecolour = null;
        foreach ($animalssRelatedByEyecolour as $animalsRelatedByEyecolour) {
            $this->addAnimalsRelatedByEyecolour($animalsRelatedByEyecolour);
        }

        $this->collAnimalssRelatedByEyecolour = $animalssRelatedByEyecolour;
        $this->collAnimalssRelatedByEyecolourPartial = false;

        return $this;
    }

    /**
     * Returns the number of related Animals objects.
     *
     * @param      Criteria $criteria
     * @param      boolean $distinct
     * @param      ConnectionInterface $con
     * @return int             Count of related Animals objects.
     * @throws PropelException
     */
    public function countAnimalssRelatedByEyecolour(Criteria $criteria = null, $distinct = false, ConnectionInterface $con = null)
    {
        $partial = $this->collAnimalssRelatedByEyecolourPartial && !$this->isNew();
        if (null === $this->collAnimalssRelatedByEyecolour || null !== $criteria || $partial) {
            if ($this->isNew() && null === $this->collAnimalssRelatedByEyecolour) {
                return 0;
            }

            if ($partial && !$criteria) {
                return count($this->getAnimalssRelatedByEyecolour());
            }

            $query = ChildAnimalsQuery::create(null, $criteria);
            if ($distinct) {
                $query->distinct();
            }

            return $query
                ->filterByColoursRelatedByEyecolour($this)
                ->count($con);
        }

        return count($this->collAnimalssRelatedByEyecolour);
    }

    /**
     * Method called to associate a ChildAnimals object to this object
     * through the ChildAnimals foreign key attribute.
     *
     * @param  ChildAnimals $l ChildAnimals
     * @return $this|\Colours The current object (for fluent API support)
     */
    public function addAnimalsRelatedByEyecolour(ChildAnimals $l)
    {
        if ($this->collAnimalssRelatedByEyecolour === null) {
            $this->initAnimalssRelatedByEyecolour();
            $this->collAnimalssRelatedByEyecolourPartial = true;
        }

        if (!$this->collAnimalssRelatedByEyecolour->contains($l)) {
            $this->doAddAnimalsRelatedByEyecolour($l);
        }

        return $this;
    }

    /**
     * @param ChildAnimals $animalsRelatedByEyecolour The ChildAnimals object to add.
     */
    protected function doAddAnimalsRelatedByEyecolour(ChildAnimals $animalsRelatedByEyecolour)
    {
        $this->collAnimalssRelatedByEyecolour[]= $animalsRelatedByEyecolour;
        $animalsRelatedByEyecolour->setColoursRelatedByEyecolour($this);
    }

    /**
     * @param  ChildAnimals $animalsRelatedByEyecolour The ChildAnimals object to remove.
     * @return $this|ChildColours The current object (for fluent API support)
     */
    public function removeAnimalsRelatedByEyecolour(ChildAnimals $animalsRelatedByEyecolour)
    {
        if ($this->getAnimalssRelatedByEyecolour()->contains($animalsRelatedByEyecolour)) {
            $pos = $this->collAnimalssRelatedByEyecolour->search($animalsRelatedByEyecolour);
            $this->collAnimalssRelatedByEyecolour->remove($pos);
            if (null === $this->animalssRelatedByEyecolourScheduledForDeletion) {
                $this->animalssRelatedByEyecolourScheduledForDeletion = clone $this->collAnimalssRelatedByEyecolour;
                $this->animalssRelatedByEyecolourScheduledForDeletion->clear();
            }
            $this->animalssRelatedByEyecolourScheduledForDeletion[]= clone $animalsRelatedByEyecolour;
            $animalsRelatedByEyecolour->setColoursRelatedByEyecolour(null);
        }

        return $this;
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Colours is new, it will return
     * an empty collection; or if this Colours has previously
     * been saved, it will retrieve related AnimalssRelatedByEyecolour from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Colours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     */
    public function getAnimalssRelatedByEyecolourJoinUsers(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnimalsQuery::create(null, $criteria);
        $query->joinWith('Users', $joinBehavior);

        return $this->getAnimalssRelatedByEyecolour($query, $con);
    }


    /**
     * If this collection has already been initialized with
     * an identical criteria, it returns the collection.
     * Otherwise if this Colours is new, it will return
     * an empty collection; or if this Colours has previously
     * been saved, it will retrieve related AnimalssRelatedByEyecolour from storage.
     *
     * This method is protected by default in order to keep the public
     * api reasonable.  You can provide public methods for those you
     * actually need in Colours.
     *
     * @param      Criteria $criteria optional Criteria object to narrow the query
     * @param      ConnectionInterface $con optional connection object
     * @param      string $joinBehavior optional join type to use (defaults to Criteria::LEFT_JOIN)
     * @return ObjectCollection|ChildAnimals[] List of ChildAnimals objects
     */
    public function getAnimalssRelatedByEyecolourJoinSexes(Criteria $criteria = null, ConnectionInterface $con = null, $joinBehavior = Criteria::LEFT_JOIN)
    {
        $query = ChildAnimalsQuery::create(null, $criteria);
        $query->joinWith('Sexes', $joinBehavior);

        return $this->getAnimalssRelatedByEyecolour($query, $con);
    }

    /**
     * Clears the current object, sets all attributes to their default values and removes
     * outgoing references as well as back-references (from other objects to this one. Results probably in a database
     * change of those foreign objects when you call `save` there).
     */
    public function clear()
    {
        $this->colour = null;
        $this->code = null;
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
            if ($this->collAnimalssRelatedByFurcolour) {
                foreach ($this->collAnimalssRelatedByFurcolour as $o) {
                    $o->clearAllReferences($deep);
                }
            }
            if ($this->collAnimalssRelatedByEyecolour) {
                foreach ($this->collAnimalssRelatedByEyecolour as $o) {
                    $o->clearAllReferences($deep);
                }
            }
        } // if ($deep)

        $this->collAnimalssRelatedByFurcolour = null;
        $this->collAnimalssRelatedByEyecolour = null;
    }

    /**
     * Return the string representation of this object
     *
     * @return string
     */
    public function __toString()
    {
        return (string) $this->exportTo(ColoursTableMap::DEFAULT_STRING_FORMAT);
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
