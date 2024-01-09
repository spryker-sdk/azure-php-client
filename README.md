# Azure Repos Client for PHP
[![Build Status](https://github.com/spryker-sdk/azure-php-client/workflows/CI/badge.svg?branch=master)](https://github.com/spryker-sdk/azure-php-client/actions?query=workflow%3ACI+branch%3Amaster)
[![codecov](https://codecov.io/gh/spryker-sdk/azure-php-client/branch/master/graph/badge.svg)](https://codecov.io/gh/spryker-sdk/azure-php-client)
[![Latest Stable Version](https://poser.pugx.org/spryker-sdk/azure-php-client/v/stable.svg)](https://packagist.org/packages/spryker-sdk/azure-php-client)
[![Minimum PHP Version](https://img.shields.io/badge/php-%3E%3D%208.0-8892BF.svg)](https://php.net/)
[![PHPStan](https://img.shields.io/badge/PHPStan-level%208-brightgreen.svg?style=flat)](https://phpstan.org/)

PHP client for [Azure Repos](https://learn.microsoft.com/en-us/rest/api/azure/devops/git/pull-requests/create).

## Installation

Require the library in your project:

```
composer require spryker-sdk/azure-php-client
```

## Usage

```php
use SprykerAzure\Client\Plugin\Request\PersonalAccessTokenAuthPlugin;
use SprykerAzure\Client\ClientFactory;

$clientFactory = new ClientFactory();

$requestBuilder = $clientFactory->getDefaultRequestBuilder();
$requestBuilder->addRequestPlugin(new PersonalAccessTokenAuthPlugin('Personal Access Token'));

$client = $clientFactory->createClient($requestBuilder);


$response = $this->azureClientFactory->getClient()->getPullRequestApi()->createPullRequest(...);
$response = $this->azureClientFactory->getClient()->getRepositoryApi()->getRepositoryInfo(...);
```
