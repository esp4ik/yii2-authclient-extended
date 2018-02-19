<p align="center">
    <a href="https://github.com/yiisoft" target="_blank">
        <img src="https://avatars0.githubusercontent.com/u/993323" height="50px">
    </a>
    <h1 align="center">Additional clients for Yii2 authclient: Instagram, Odnoklassniki and etc</h1>
    <br>
</p>

This repository contains an additional clients for [Yii2 Auth Client](https://github.com/yiisoft/yii2-authclient).

For license information check the [LICENSE](LICENSE.md)-file.


List of additional clients:
- Instagram
- Odnoklassniki

## Installation

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist esp4ik/yii2-authclient-extended
```

or add

```
"esp4ik/yii2-authclient-extended": "~1.0.0"
```

to the require section of your composer.json.

## Configuring application

Full documentation see at [Yii2 Auth Client](https://github.com/yiisoft/yii2-authclient/blob/master/docs/guide/README.md)

After extension is installed you need to setup auth client collection application component:

```php
return [
    'components' => [
        'authClientCollection' => [
            'class' => 'yii\authclient\Collection',
            'clients' => [
                'instagram' => [
                    'class' => 'esp4ik\authclient\clients\Instagram',
                    'clientId' => 'instagram_client_id',
                    'clientSecret' => 'instagram_client_secret',
                ],
                'odnoklassniki' => [
                    'class' => 'esp4ik\authclient\clients\Odnoklassniki',
                    'clientId' => 'odnoklassniki_application_id',
                    'clientSecret' => 'odnoklassniki_secret_key',
                    'applicationId' => 'odnoklassniki_public_key',
                ],
                // ...
            ],
        ]
        // ...
    ],
    // ...
];
```