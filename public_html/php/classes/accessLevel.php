<?php

/**
 * Class for access level of a user
 * This class helps identify what user group out of 3 groups a user falls into
 *
 * @author Charles Sandidge sandidgec@gmail.com
 **/
class accessLevel implements JsonSerializable {


        /**
         * access level int representing 3 levels of users
         * @var int of accessLevelId
         **/
        private $accessLevelId;
        /**
         * description of the access level that a user has
         * @var string for description of access level
         **/
        private $description;


    /**
     * accessLevel constructor.
     * @param $newAccessLevelId
     * @param $newDescription
     **/
        public function __construct($newAccessLevelId, $newDescription)

        {
            try {
                $this->setAccesslevelId($newAccessLevelId);
                $this->setDescription($newDescription);
            } catch (InvalidArgumentException $invalidArgument) {
                //rethrow the exception to the caller
                throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
            } catch (RangeException $range) {
                // rethrow the exception to the caller
                throw (new RangeException($range->getMessage(), 0, $range));
            } catch (Exception $exception) {
                // rethrow generic exceptionthrow(new Exception($exception->getMessage(), 0, $exception));
            }
        }

    /**
     * accessor method for accessLevelId
     *
     * @return int value of accessLevelId
     **/
    public function getAccessLevelId() {
        return ($this->accessLevelId);
    }

    /**
     * mutator method for the accessLevelId
     *
     * @param intvalue to represent a users accessLevelId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setUserId($newAccessLevelId) {
        // base case: if the accessLevelId is null,
        if($newAccessLevelId === null) {
            $this->accessLevelId = null;
            return;
        }
        //verify the accessLevel is valid
        $newAccessLevelId = filter_var($newAccessLevelId, FILTER_VALIDATE_INT);
        if(empty($newAccessLevelId) === true) {
            throw (new InvalidArgumentException ("accessLevelId invalid"));
        }
        $this->accessLevelId = $newAccessLevelId;
    }

    /**
     * accessor method for Description
     *
     * @return string for description
     **/
    public function getDescription() {
        return ($this->description);
    }

    /**
     * Mutator method for description of access level
     *
     * @param string for access level description $newDescription
     */
    public function setDescription($newDescription) {
        // verify description is valid
        $newDescription = filter_var($newDescription, FILTER_SANITIZE_STRING);
        if(empty($newDescription) === true) {
            throw new InvalidArgumentException("description is invalid");
        }
        if(strlen($newDescription) > 32) {
            throw (new RangeException ("description too large"));
        }
        $this->description = $newDescription;
    }

    /**
     * Inserts User into mySQL
     *
     * Inserts this userId into mySQL in intervals
     * @param PDO $pdo connection to
     **/
    public function insert(PDO &$pdo) {

        //create query template
        $query
            = "INSERT INTO accessLevel(description)
        VALUES (:description)";
        $statement = $pdo->prepare($query);

        // bind the variables to the place holders in the template
        $parameters = array("description" => $this->description);
        $statement->execute($parameters);

    }


}
