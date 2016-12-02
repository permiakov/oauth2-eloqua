<?php

namespace Permiakov\OAuth2\Client\Provider;

class EloquaResourceOwner
{
    protected $id;
    protected $userName;
    protected $displayName;
    protected $firstName;
    protected $lastName;
    protected $emailAddress;

    public function exchangeArray($params)
    {
        $this->setId(isset($params['id']) ?$params['id']: null);
        $this->setUserName(isset($params['username']) ?$params['username']: null);
        $this->setDisplayName(isset($params['displayName']) ?$params['displayName']: null);
        $this->setFirstName(isset($params['firstName']) ?$params['firstName']: null);
        $this->setLastName(isset($params['lastName']) ?$params['lastName']: null);
        $this->setEmailAddress(isset($params['emailAddress']) ?$params['emailAddress']: null);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getUserName()
    {
        return $this->userName;
    }

    /**
     * @param mixed $userName
     */
    public function setUserName($userName)
    {
        $this->userName = $userName;
    }

    /**
     * @return mixed
     */
    public function getDisplayName()
    {
        return $this->displayName;
    }

    /**
     * @param mixed $displayName
     */
    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

    /**
     * @return mixed
     */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

    /**
     * @param mixed $emailAddress
     */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }
}
