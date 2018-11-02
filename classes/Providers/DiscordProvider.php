<?php
namespace Grav\Plugin\Login\OAuth2\Providers;

use Grav\Common\Grav;
use League\OAuth2\Client\Provider\AbstractProvider;
use Wohali\OAuth2\Client\Provider\Discord;


class DiscordProvider extends BaseProvider
{
    protected $name = 'Discord';
    protected $classname = 'Wohali\\OAuth2\\Client\\Provider\\Discord';
    protected $config;

    /** @var AbstractProvider|Discord */
    protected $provider;
	
    public function __construct(array $options)
    {
        $this->config = Grav::instance()['config'];

        $options += [
            'clientId'      => $this->config->get('plugins.login-oauth2.providers.discord.client_id'),
            'clientSecret'  => $this->config->get('plugins.login-oauth2.providers.discord.client_secret'),
            'redirectUri'   => $this->getCallbackUri(),
        ];


        parent::__construct($options);
    }

    public function getAuthorizationUrl()
    {
		$options = ['state' => $this->state];
        $options['scope'] = $this->config->get('plugins.login-oauth2.providers.discord.options.scope');
		
        return $this->provider->getAuthorizationUrl($options);
    }
    public function getUserData($user)
	{
		$data = $user->toArray();
						
		 $data_user = [
			'id'         => $user->getId(),
			'username'   => $user->getUsername(),
			'email'      => $user->getEmail(),
			'discord'     => [
				'discriminator'    	=> $user->getDiscriminator(),
				'avatar' 	 		=> $user->getAvatarHash(),
			]
		];

		return $data_user;
    }

}