<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use League\OAuth2\Client\Provider\AbstractProvider;
use League\OAuth2\Client\Provider\ResourceOwnerInterface;
use League\OAuth2\Client\Token\AccessToken;

interface ProviderInterface
{
    public function __construct(array $options);

    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function getState();

    /**
     * @param string $state
     * @return $this
     */
    public function setState($state);

    /**
     * @return AbstractProvider
     */
    public function getProvider();

    /**
     * @return string
     */
    public function getAuthorizationUrl();

    /**
     * Requests an access token using a specified grant and option set.
     *
     * @param  mixed $grant
     * @param  array $options
     * @return AccessToken
     */
    public function getAccessToken($grant, array $options = []);

    /**
     * Requests and returns the resource owner of given access token.
     *
     * @param  AccessToken $token
     * @return ResourceOwnerInterface
     */
    public function getResourceOwner(AccessToken $token);

    /**
     * @param ResourceOwnerInterface $user
     * @param AccessToken $token
     * @return array
     */
    public function getUserData($user, $token = null);
}