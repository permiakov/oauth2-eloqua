<?php
namespace Permiakov\OAuth2\Client\Test\Provider;

use League\OAuth2\Client\Token\AccessToken;
use Permiakov\OAuth2\Client\Provider\EloquaResourceOwner;
use PHPUnit\Framework\TestCase;

/**
 * Class EloquaResourceOwnerTest
 * @package Permiakov\OAuth2\Client\Test\Provider
 * @covers \Permiakov\OAuth2\Client\Provider\EloquaResourceOwner
 */
class EloquaResourceOwnerTest extends TestCase
{

    protected $mockParams = array();
    protected $mockEmptyParams = array();

    public function testExchangeArray()
    {
        $mock = $this->getMockBuilder('\Permiakov\OAuth2\Client\Provider\EloquaResourceOwner')
            ->setMethods(array(
                'setId',
                'setUserName',
                'setDisplayName',
                'setFirstName',
                'setLastName',
                'setEmailAddress'
            ))
            ->getMock();
        $mock->expects($this->once())->method('setId')->with(123);
        $mock->expects($this->once())->method('setUserName')->with('login');
        $mock->expects($this->once())->method('setDisplayName')->with('nickname');
        $mock->expects($this->once())->method('setFirstName')->with('name');
        $mock->expects($this->once())->method('setLastName')->with('lastname');
        $mock->expects($this->once())->method('setEmailAddress')->with('email');

        $mock->exchangeArray(
            array(
            'id' => 123,
            'username' => 'login',
            'displayName' => 'nickname',
            'firstName' => 'name',
            'lastName' => 'lastname',
            'emailAddress' => 'email'
            )
        );
    }

    public function testExchangeArrayWithEmptyValues()
    {
        $mock = $this->getMockBuilder('\Permiakov\OAuth2\Client\Provider\EloquaResourceOwner')
            ->setMethods(array(
                'setId',
                'setUserName',
                'setDisplayName',
                'setFirstName',
                'setLastName',
                'setEmailAddress'
            ))
            ->getMock();
        $mock->expects($this->once())->method('setId')->with(null);
        $mock->expects($this->once())->method('setUserName')->with(null);
        $mock->expects($this->once())->method('setDisplayName')->with(null);
        $mock->expects($this->once())->method('setFirstName')->with(null);
        $mock->expects($this->once())->method('setLastName')->with(null);
        $mock->expects($this->once())->method('setEmailAddress')->with(null);

        $mock->exchangeArray(array());
    }

    public function testGettersSetters()
    {
        $owner = new EloquaResourceOwner();
        $owner->setId(1);
        $owner->setUserName('username');
        $owner->setDisplayName('nickname');
        $owner->setFirstName('name');
        $owner->setLastName('lastname');
        $owner->setEmailAddress('email');

        $this->assertEquals(1, $owner->getId());
        $this->assertEquals('username', $owner->getUserName());
        $this->assertEquals('nickname', $owner->getDisplayName());
        $this->assertEquals('name', $owner->getFirstName());
        $this->assertEquals('lastname', $owner->getLastName());
        $this->assertEquals('email', $owner->getEmailAddress());
    }
}
