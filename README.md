# coffeescript
[![Latest Stable Version](https://poser.pugx.org/nodejs-php-fallback/coffeescript/v/stable.png)](https://packagist.org/packages/nodejs-php-fallback/coffeescript)
[![Build Status](https://travis-ci.org/kylekatarnls/coffeescript.svg?branch=master)](https://travis-ci.org/kylekatarnls/coffeescript)
[![StyleCI](https://styleci.io/repos/64147249/shield?style=flat)](https://styleci.io/repos/64147249)
[![Test Coverage](https://codeclimate.com/github/kylekatarnls/coffeescript/badges/coverage.svg)](https://codecov.io/github/kylekatarnls/coffeescript?branch=master)
[![Code Climate](https://codeclimate.com/github/kylekatarnls/coffeescript/badges/gpa.svg)](https://codeclimate.com/github/kylekatarnls/coffeescript)

PHP wrapper to execute coffee-script node package or fallback to a PHP alternative.

## Usage

First you need [composer](https://getcomposer.org/) if you have not already. Then get the package with ```composer require nodejs-php-fallback/coffeescript``` then require the composer autload in your PHP file if it's not already:
```php
<?php

use NodejsPhpFallback\CoffeeScript;

// Require the composer autload in your PHP file if it's not already.
// You do not need to if you use a framework with composer like Symfony, Laravel, etc.
require 'vendor/autoload.php';

$coffee = new CoffeeScript('path/to/my-coffee-script-file.coffee');

// Output to a file:
$coffee->write('path/to/my-js-file.js');

// Get JS contents:
$jsContents = $coffee->getResult();

// Output to the browser:
header('Content-type: text/javascript');
echo $coffee;

// You can also get Coffee-Script code from a string:
$coffee = new CoffeeScript('
alert "Foo"
');
// Then write JS with:
$coffee->write('path/to/my-js-file.js');
// or get it with:
$jsContents = $coffee->getResult();

// Pass false to the CoffeeScript constructor to wrap the rendered JS in a function, (else, the bare option is used):
$coffee = new CoffeeScript('path/to/my-coffee-script-file.coffee', false);
```

## Security contact information

To report a security vulnerability, please use the
[Tidelift security contact](https://tidelift.com/security).
Tidelift will coordinate the fix and disclosure.
