<?php

namespace Permiakov\OAuth2\Client\Provider;

use League\OAuth2\Client\Provider\Exception\IdentityProviderException;
use League\OAuth2\Client\Tool\BearerAuthorizationTrait;
use Psr\Http\Message\ResponseInterface;
use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Token\AccessToken;

class EloquaProvider extends AbstractProvider
{
    use BearerAuthorizationTrait;

    /**
     * @return string
     */
    public function getBaseAuthorizationUrl()
    {
        return 'https://login.eloqua.com/auth/oauth2/authorize';
    }

    /**
     * @param array $params
     * @return string
     */
    public function getBaseAccessTokenUrl(array $params)
    {
        return 'https://login.eloqua.com/auth/oauth2/token';
    }

    /**
     * @param AccessToken $token
     * @return string
     */
    public function getResourceOwnerDetailsUrl(AccessToken $token)
    {
        return 'https://login.eloqua.com/id';
    }

    /**
     * @return array
     */
    protected function getDefaultScopes()
    {
        return array('full');
    }

    /**
     * Authorization and access tokens requests have to be signed with basic auth header
     * @return array
     */
    protected function getDefaultHeaders()
    {
        return array('Authorization' => 'Basic ' . base64_encode($this->clientId . ':' . $this->clientSecret));
    }

    /**
     * @param ResponseInterface $response
     * @param array|string $data
     * @throws IdentityProviderException
     */
    protected function checkResponse(ResponseInterface $response, $data)
    {
        if (isset($data['error'])) {
            throw new IdentityProviderException(
                sprintf(
                    'Error: %s. Description: %s',
                    $data['error'],
                    $data['error_description']
                ),
                $response->getStatusCode(),
                $response->getBody()
            );
        }
    }

    /**
     * @param array $response
     * @param AccessToken $token
     * @return EloquaResourceOwner
     */
    protected function createResourceOwner(array $response, AccessToken $token)
    {
        $owner = $this->getEloquaResourceOwnerPrototype();

        return $owner->exchangeArray($response['user']);
    }

    /**
     * @return EloquaResourceOwner
     */
    protected function getEloquaResourceOwnerPrototype()
    {
        return new EloquaResourceOwner();
    }
}
