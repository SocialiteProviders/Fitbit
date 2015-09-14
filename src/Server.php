<?php

namespace SocialiteProviders\Fitbit;

use Laravel\Socialite\One\User;
use League\OAuth1\Client\Credentials\TokenCredentials;
use League\OAuth1\Client\Server\Server as BaseServer;

class Server extends BaseServer
{
    /**
     * {@inheritdoc}
     */
    public function urlTemporaryCredentials()
    {
        return 'https://api.fitbit.com/oauth/request_token';
    }

    /**
     * {@inheritdoc}
     */
    public function urlAuthorization()
    {
        return 'https://api.fitbit.com/oauth/authorize';
    }

    /**
     * {@inheritdoc}
     */
    public function urlTokenCredentials()
    {
        return 'https://api.fitbit.com/oauth/access_token';
    }

    /**
     * {@inheritdoc}
     */
    public function urlUserDetails()
    {
        return 'https://api.fitbit.com/1/user/-/profile.json';
    }

    /**
     * {@inheritdoc}
     */
    public function userDetails($data, TokenCredentials $tokenCredentials)
    {
        $data = $data['user'];

        $user = new User();
        $user->id = $data['encodedId'];
        $user->name = $data['displayName'];
        $user->avatar = $data['avatar150'];
        $user->extra = array_diff_key($data, array_flip([
            'encodedId', 'displayName', 'avatar150',
        ]));

        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function userUid($data, TokenCredentials $tokenCredentials)
    {
        return $data['user']['encodedId'];
    }

    /**
     * {@inheritdoc}
     */
    public function userEmail($data, TokenCredentials $tokenCredentials)
    {
        return;
    }

    /**
     * {@inheritdoc}
     */
    public function userScreenName($data, TokenCredentials $tokenCredentials)
    {
        return $data['user']['displayName'];
    }
}
