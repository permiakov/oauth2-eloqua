<?php
namespace Permiakov\OAuth2\Client\Test\Provider;

use League\OAuth2\Client\Token\AccessToken;
use Permiakov\OAuth2\Client\Provider\EloquaProvider;
use Permiakov\OAuth2\Client\Provider\EloquaResourceOwner;
use PHPUnit\Framework\TestCase;
use League\OAuth2\Client\Provider\Exception\IdentityProviderException;

/**
 * Class EloquaProviderTest
 * @package Permiakov\OAuth2\Client\Test\Provider
 * @covers \Permiakov\OAuth2\Client\Provider\EloquaProvider
 */
class EloquaProviderTest extends TestCase
{

    public function testGetBaseAuthorizationUrl()
    {
        $this->assertEquals(
            'https://login.eloqua.com/auth/oauth2/authorize',
            $this->getProvider()->getBaseAuthorizationUrl()
        );
    }

    public function testGetBaseAccessTokenUrl()
    {
        $this->assertEquals(
            'https://login.eloqua.com/auth/oauth2/token',
            $this->getProvider()->getBaseAccessTokenUrl(array())
        );
    }

    public function testGetResourceOwnerDetailsUrl()
    {
        $this->assertEquals(
            'https://login.eloqua.com/id',
            $this->getProvider()->getResourceOwnerDetailsUrl(new AccessToken(array('access_token' => 'xxx')))
        );
    }

    public function testGetDefaultScopes()
    {
        $provider = $this->getProvider();
        $reflection = new \ReflectionClass(get_class($provider));
        $method = $reflection->getMethod('getDefaultScopes');
        $method->setAccessible(true);
        $this->assertEquals(array('full'), $method->invoke($provider));
    }

    public function testGetDefaultHeaders()
    {
        $options = array('clientId' => 'yyy', 'clientSecret' => 'zzz');
        $provider = $this->getProvider($options);
        $expected = array('Authorization' => 'Basic ' . base64_encode('yyy:zzz'));

        $reflection = new \ReflectionClass(get_class($provider));
        $method = $reflection->getMethod('getDefaultHeaders');
        $method->setAccessible(true);
        $this->assertEquals($expected, $method->invoke($provider));
    }

    public function testCheckResponseShouldThrowExceptionWhenErrorReceived()
    {
        $responseMock = $this->getMockBuilder('Psr\Http\Message\ResponseInterface')
            ->setMethods(array('getStatusCode'))->getMockForAbstractClass();
        $responseMock->expects($this->once())->method('getStatusCode');
        $data = array('error' => 'some error', 'error_description' => 'bad happened');

        $provider = $this->getProvider();
        $reflection = new \ReflectionClass(get_class($provider));
        $method = $reflection->getMethod('checkResponse');
        $method->setAccessible(true);

        $this->expectException(IdentityProviderException::class);

        $method->invokeArgs($provider, array($responseMock, $data));
    }

    public function testCreateResourceOwner()
    {
        $provider = $this->getMockBuilder('Permiakov\OAuth2\Client\Provider\EloquaProvider')
            ->setMethods(array('getEloquaResourceOwnerPrototype', 'createResourceOwner'))
            ->getMock();
        $prototype = new EloquaResourceOwner();
        $provider->expects($this->once())->method('getEloquaResourceOwnerPrototype')->willReturn($prototype);

        $reflection = new \ReflectionClass('\Permiakov\OAuth2\Client\Provider\EloquaProvider');
        $method = $reflection->getMethod('createResourceOwner');
        $method->setAccessible(true);

        $this->assertEquals(
            $prototype,
            $method->invokeArgs(
                $provider,
                array(array('user' => 'something'), new AccessToken(array('access_token' => 'xxx')))
            )
        );
    }

    public function testGetEloquaResourceOwnerPrototype()
    {
        $provider = $this->getProvider();

        $reflection = new \ReflectionClass('\Permiakov\OAuth2\Client\Provider\EloquaProvider');
        $method = $reflection->getMethod('getEloquaResourceOwnerPrototype');
        $method->setAccessible(true);
        $this->assertInstanceOf('\Permiakov\OAuth2\Client\Provider\EloquaResourceOwner', $method->invoke($provider));
    }

    public function testGetAuthorizationHeaders()
    {
        $provider = $this->getProvider();
        $reflection = new \ReflectionClass('\Permiakov\OAuth2\Client\Provider\EloquaProvider');
        $method = $reflection->getMethod('getAuthorizationHeaders');
        $method->setAccessible(true);
        $method->invokeArgs($provider, array('token'));
        $this->assertEquals(array('Authorization' => 'Bearer token'), $method->invokeArgs($provider, array('token')));
    }

    protected function getProvider($options = array())
    {
        $params = array_merge(array(
            'clientId' => 'xxx',
            'clientSecret' => 'xxx',
            'redirectUri' => 'https://eloqua-redirect-url.com',
        ), $options);

        return new EloquaProvider($params);
    }
}
