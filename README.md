# Github Webhook

> Laravel package to create github's webhook route, authorize and logs incoming requests.

## Install and configure

Install this package using `composer` in root directory of your laravel app and publish the configuration file.

```bash
$ composer require tj/ghwebhook

$ php artisan vendor:publish --provider="Tj\Ghwebhook\PackageServiceProvider" --tag="config"

```


## Features

Implemented and planned features are as follow

- [x] Logs on Incoming requests, actions completed and exception occured, `channel` name to write these logs on can be defined through the config file.
