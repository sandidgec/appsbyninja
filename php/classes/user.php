<?php

class User
{

    /**
     * id for this user; this is the primary key
     * @var int $userId
     **/
    private $userId;
    /**
     * access level id to identify user groups
     * @var
     **/
    private $accessLevel;
    /**
     * email for the user
     * @var string for $email
     **/
    private $email;
    /**
     * first name of the user
     * @var string for $firstName
     **/
    private $firstName;
    /**
     * hash of password w/ salt
     * @var string for password hash
     **/
    private $hash;
    /**
     * last name of the user
     * @var string for $lastName
     **/
    private $lastName;
    /**
     * phone number of user
     * @var int $phone
     **/
    private $phone;
    /**
     * path for a profile pic
     * @var string of profile picture path
     **/
    private $profilePath;
    /**
     * salt of password w/ hash
     * @var string for pasword salt
     **/
    private $salt;


    /**
     * User constructor.
     * @param $newUserId
     * @param $newAccessLevel
     * @param $newEmail
     * @param $newFirstName
     * @param $newHash
     * @param $newLastName
     * @param $newPhone
     * @param $newProfilePath
     * @param $newSalt
     **/
    public function __construct($newUserId, $newAccessLevel, $newEmail, $newFirstName, $newHash, $newLastName,
                                $newPhone, $newProfilePath, $newSalt)
    {
        try {
            $this->setUserId($newUserId);
            $this->setAccessLevel($newAccessLevel);
            $this->setEmail($newEmail);
            $this->setFirstName($newFirstName);
            $this->setHash($newHash);
            $this->setLastName($newLastName);
            $this->setPhone($newPhone);
            $this->setProfilePath($newProfilePath);
            $this->setSalt($newSalt);
        } catch (InvalidArgumentException $invalidArgument) {
            //rethrow the exception to the caller
            throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
        } catch (RangeException $range) {
            // rethrow the exception to the caller
            throw (new RangeException($range->getMessage(), 0, $range));
        } catch (Exception $exception) {
            // rethrow generic exception
            throw(new Exception($exception->getMessage(), 0, $exception));
        }
    }

    /**
     * accessor method for userId
     *
     * @return int value of unique userId
     **/
    public function getUserId() {
        return ($this->userId);
    }

    /**
     * mutator method for the userId
     *
     * @param int unique value to represent a user $newUserId
     * @throws InvalidArgumentException for invalid content
     **/
    public function setUserId($newUserId) {
        // base case: if the userId is null,
        // this is a new user without a mySQL assigned id (yet)
        if($newUserId === null) {
            $this->userId = null;
            return;
        }
        //verify the User is valid
        $newUserId = filter_var($newUserId, FILTER_VALIDATE_INT);
        if(empty($newUserId) === true) {
            throw (new InvalidArgumentException ("userId invalid"));
        }
        $this->userId = $newUserId;
    }

    /**
     * accessor method for access level of user
     *
     * @return mixed
     **/
    public function getAccessLevel() {
        return ($this->accessLevel);
    }

    /**
     * Mutator for access level of a user
     *
     **/
    public function setAccessLevel() {}



    /**
     * accessor method for email
     *
     * @return string of email for user
     **/
    public function getEmail() {
        return ($this->email);
    }

    /**
     * Mutator method for Email
     *
     * @param string of users' email $newEmail
     * @throws InvalidArgumentException if email does not pass sanitization
     * @throws RangeException if email is longer than 64 characters
     **/
    public function setEmail($newEmail) {
        // verify email is valid
        $newEmail = filter_var($newEmail, FILTER_SANITIZE_EMAIL);
        if(empty($newEmail) === true) {
            throw new InvalidArgumentException ("user email invalid");
        }
        if(strlen($newEmail) > 64) {
            throw(new RangeException ("Email content too large"));
        }
        $this->email = $newEmail;
    }

    /**
     * accessor method for First Name
     *
     * @return string for first name
     **/
    public function getFirstName() {
        return ($this->firstName);
    }

    /**
     * Mutator method for First Name
     *
     * @param string for user first name $newFirstName
     */
    public function setFirstName($newFirstName) {
        // verify first name is valid
        $newFirstName = filter_var($newFirstName, FILTER_SANITIZE_STRING);
        if(empty($newFirstName) === true) {
            throw new InvalidArgumentException("first name invalid");
        }
        if(strlen($newFirstName) > 32) {
            throw (new RangeException ("First Name content too large"));
        }
        $this->firstName = $newFirstName;
    }


    /**
     * accessor method for Hash
     * @return string of users password Hash
     **/
    public function getHash() {
        return ($this->hash);
    }

    /**
     * Mutator for Hash -insure it is 128 length string
     *
     * @param string of users $newHash
     * @throws InvalidArgumentException if newHash is not valid int
     * @throws RangeException if newHash is not exactly 128 xdigits
     **/

    public function setHash($newHash) {
        // verify Hash is exactly string of 128
        if((ctype_xdigit($newHash)) === false) {
            if(empty($newHash) === true) {
                throw new InvalidArgumentException ("hash invalid");
            }
            if(strlen($newHash) !== 128) {
                throw new RangeException ("hash not valid");
            }
        }
        $this->hash = $newHash;
    }

    /**
     * accessor method for Last Name
     *
     * @return string for last name
     **/
    public function getLastName() {
        return ($this->lastName);
    }

    /**
     * Mutator method for last name sanitation
     *
     * @param string for user last name $newLastName
     **/
    public function setLastName($newLastName) {
        //verify last name is valid
        $newLastName = filter_var($newLastName, FILTER_SANITIZE_STRING);
        if(empty($newLastName) === true) {
            throw new InvalidArgumentException("last name invalid");
        }
        if(strlen($newLastName) > 32) {
            throw (new RangeException("Last Name content too large"));
        }
        $this->lastName = $newLastName;
    }

    /**
     * Accessor method for Phone Number
     *
     * @return int for phone number
     **/
    public function getPhoneNumber() {
        return ($this->phoneNumber);
    }

    /**
     * Mutator method for Phone Number
     *
     * @param int of user phone number $newPhoneNumber
     * @throws InvalidArgumentException if phoneNumber is not ctype digits
     * @throws RangeException if int is not 10 digits
     **/
    public function setPhone($newPhone) {
        //verify phone number is valid and digits only
        if((ctype_digit($newPhone)) === false) {
            throw new InvalidArgumentException ("phoneNumber invalid");
        }
        if(strlen($newPhone) > 10) {
            throw (new RangeException ("Phone Number should be formatted 5055558787"));
        }
        $this->phone = $newPhone;
    }


    /**
     * accessor for profile path of profile pic
     *
     * @return string
     **/
    public function getProfilePath() {
        return ($this->profilePath);
    }

    /**
     * Mutator for profile path of profile pic
     *
     * @param $newProfilePath
     **/
    public function setProfilePath($newProfilePath) {

    }



    /**
     * accessor method for Salt
     *
     * @return string of Salt for user password
     **/
    public function getSalt() {
        return ($this->salt);
    }

    /**
     * mutator method for Salt
     *
     * @param string of users password salt $newSalt
     * @throw InvalidArgumentException if salt is not valid int
     * @throw RangeException if salt is not exactly 64 xdigits
     **/
    public function setSalt($newSalt) {
        // verify salt is exactly string of 64
        if((ctype_xdigit($newSalt)) === false) {
            if(empty($newSalt) === true) {
                throw new InvalidArgumentException ("salt invalid");
            }
            if(strlen($newSalt) !== 64) {
                throw (new RangeException ("salt not valid"));
            }
        }
        $this->salt = $newSalt;
    }

}
