<?php

namespace Permiakov\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\ResourceOwnerInterface;

class EloquaResourceOwner implements ResourceOwnerInterface
{
    protected $id;
    protected $userName;
    protected $displayName;
    protected $firstName;
    protected $lastName;
    protected $emailAddress;

    /**
     * @return array
     */
    public function toArray()
    {
        return array(
            'id' => $this->getId(),
            'username' => $this->getUserName(),
            'displayName' => $this->getDisplayName(),
            'firstName' => $this->getFirstName(),
            'lastName' => $this->getLastName(),
            'emailAddress' => $this->getEmailAddress()
        );
    }

    /**
     * @param $params
     * @return $this
     */
    public function exchangeArray($params)
    {
        $this->setId($params['id']);
        $this->setUserName($params['username']);
        $this->setDisplayName($params['displayName']);
        $this->setFirstName($params['firstName']);
        $this->setLastName($params['lastName']);
        $this->setEmailAddress($params['emailAddress']);

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
