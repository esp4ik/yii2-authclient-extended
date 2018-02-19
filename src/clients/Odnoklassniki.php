<?php

namespace esp4ik\authclient\clients;

use yii\authclient\OAuth2;

/**
 * Odnoklassniki allows authentication via Odnoklassniki OAuth2.
 *
 * In order to use Odnoklassniki OAuth2 you must register an application at <https://ok.ru/devaccess>.
 *
 * Example application configuration:
 *
 * ```php
 * 'components' => [
 *     'authClientCollection' => [
 *         'class' => 'yii\authclient\Collection',
 *         'clients' => [
 *             'odnoklassniki' => [
 *                 'class' => 'esp4ik\authclient\clients\Odnoklassniki',
 *                 'clientId' => 'odnoklassniki_application_id',
 *                 'clientSecret' => 'odnoklassniki_secret_key',
 *                 'applicationId' => 'odnoklassniki_public_key'
 *             ],
 *         ],
 *     ]
 *     ...
 * ]
 * ```
 *
 * @see https://apiok.ru/dev/
 *
 * @author Evgeny Voronets <voronets.evgeny@gmail.com>
 * @since 1.1
 */
class Odnoklassniki extends OAuth2
{
    /**
     * @var string
     */
    public $applicationId;
    /**
     * @inheritdoc
     */
    public $authUrl = 'https://connect.ok.ru/oauth/authorize';
    /**
     * @inheritdoc
     */
    public $tokenUrl = 'https://api.ok.ru/oauth/token.do';
    /**
     * @inheritdoc
     */
    public $apiBaseUrl = 'https://api.ok.ru';

    /**
     * @inheritdoc
     */
    protected function initUserAttributes()
    {
        return $this->api('api/users/getCurrentUser', 'GET');
    }

    /**
     * @inheritdoc
     */
    public function applyAccessTokenToRequest($request, $accessToken)
    {
        $params['application_key'] = $this->applicationId;
        $params['sig'] = $this->generateSignature($params);
        $params['access_token'] = $accessToken->getToken();

        $request->setData($params);
    }

    /**
     * @param array $params
     * @return string
     */
    protected function generateSignature($params)
    {
        ksort($params);

        $query = '';
        foreach ($params as $key => $param) {
            $query .= sprintf('%s=%s', $key, $param);
        }

        return md5($query . md5($this->accessToken->getToken() . $this->clientSecret));
    }

    /**
     * @inheritdoc
     */
    protected function defaultName()
    {
        return 'odnoklassniki';
    }

    /**
     * @inheritdoc
     */
    protected function defaultTitle()
    {
        return 'Odnoklassniki';
    }

    /**
     * @inheritdoc
     */
    protected function defaultNormalizeUserAttributeMap()
    {
        return [
            'id' => 'uid',
        ];
    }
}