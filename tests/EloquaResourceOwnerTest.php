<?php
namespace Permiakov\OAuth2\Client\Test\Provider;

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
                'setEmailAddress',
                'setSiteName'
            ))
            ->getMock();
        $mock->expects($this->once())->method('setId')->with(123);
        $mock->expects($this->once())->method('setUserName')->with('login');
        $mock->expects($this->once())->method('setDisplayName')->with('nickname');
        $mock->expects($this->once())->method('setFirstName')->with('name');
        $mock->expects($this->once())->method('setLastName')->with('lastname');
        $mock->expects($this->once())->method('setEmailAddress')->with('email');
        $mock->expects($this->once())->method('setSiteName')->with('sitename');

        $mock->exchangeArray(
            array(
                'user' => array(
                    'id' => 123,
                    'username' => 'login',
                    'displayName' => 'nickname',
                    'firstName' => 'name',
                    'lastName' => 'lastname',
                    'emailAddress' => 'email'
                ),
                'site' => array('name' => 'sitename')
            )
        );
    }

    public function testToArray()
    {
        $mock = $this->getMockBuilder('\Permiakov\OAuth2\Client\Provider\EloquaResourceOwner')
            ->setMethods(array(
                'getId',
                'getUserName',
                'getDisplayName',
                'getFirstName',
                'getLastName',
                'getEmailAddress',
                'getSiteName'
            ))
            ->getMock();
        $mock->expects($this->once())->method('getId')->willReturn(123);
        $mock->expects($this->once())->method('getUserName')->willReturn('login');
        $mock->expects($this->once())->method('getDisplayName')->willReturn('nickname');
        $mock->expects($this->once())->method('getFirstName')->willReturn('name');
        $mock->expects($this->once())->method('getLastName')->willReturn('lastname');
        $mock->expects($this->once())->method('getEmailAddress')->willReturn('email');
        $mock->expects($this->once())->method('getSiteName')->willReturn('sitename');

        $this->assertEquals(array(
            'user' => array(
                'id' => 123,
                'username' => 'login',
                'displayName' => 'nickname',
                'firstName' => 'name',
                'lastName' => 'lastname',
                'emailAddress' => 'email'
            ),
            'site' => array('name' => 'sitename')
        ), $mock->toArray());
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
        $owner->setSiteName('sitename');

        $this->assertEquals(1, $owner->getId());
        $this->assertEquals('username', $owner->getUserName());
        $this->assertEquals('nickname', $owner->getDisplayName());
        $this->assertEquals('name', $owner->getFirstName());
        $this->assertEquals('lastname', $owner->getLastName());
        $this->assertEquals('email', $owner->getEmailAddress());
        $this->assertEquals('sitename', $owner->getSiteName());
    }
}
