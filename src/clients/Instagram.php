<?php

namespace esp4ik\authclient\clients;

use yii\authclient\OAuth2;

/**
 * Instagram allows authentication via Instagram OAuth2.
 *
 * In order to use Instagram OAuth2 you must register an application at <https://www.instagram.com/developer/>
 * and setup its credentials at <https://www.instagram.com/developer/clients/manage/>.
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'instagram' => [
 *                 'class' => 'esp4ik\authclient\clients\Instagram',
 *                 'clientId' => 'instagram_client_id',
 *                 'clientSecret' => 'instagram_client_secret',
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ```
 *
 * @see https://www.instagram.com/developer/
 *
 * @author Evgeny Voronets <voronets.evgeny@gmail.com>
 * @since 1.0
 */
class Instagram extends OAuth2
{
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://api.instagram.com/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.instagram.com/oauth/access_token';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.instagram.com/v1';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        $response = $this->api('users/self', 'GET');
        return $response['data'];
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'instagram';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Instagram';
    }
}