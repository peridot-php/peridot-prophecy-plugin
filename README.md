Peridot Prophecy Plugin
=======================

[![Build Status](https://travis-ci.org/peridot-php/peridot-prophecy-plugin.png)](https://travis-ci.org/peridot-php/peridot-prophecy-plugin) [![HHVM Status](http://hhvm.h4cc.de/badge/peridot-php/peridot-prophecy-plugin.svg)](http://hhvm.h4cc.de/package/peridot-php/peridot-prophecy-plugin)

Use Peridot with the amazing mocking framework [Prophecy](https://github.com/phpspec/prophecy)

##Usage

We recommend installing this plugin to your project via composer:

```
$ composer require --dev peridot-php/peridot-prophecy-plugin:~1.0
```

You can register the plugin via your [peridot.php](http://peridot-php.github.io/#plugins) file.

```php
<?php
use Evenement\EventEmitterInterface;
use Peridot\Plugin\Prophecy\Plugin;

return function(EventEmitterInterface $emitter) {
    $plugin = new ProphecyPlugin($emitter);
};
```

Registering this plugin will add a `ProphecyScope` as a child scope to all of your tests. This will allow you
to get a prophet object in all of your tests.

```php
<?php
describe('Bird', function() {
    it('should fly', function() {
        $mock = $this->getProphet()->prophesize('Bird');
        //do stuff with the mock
    });
});
```

###Automatic injection of mock

If a test suite's description is an existing class, the prophecy plugin will automatically inject a `$subject` instance
variable into your tests that is a mock of the class.

```php
describe('Vendor\Namespace\Klass', function() {
    it('should have a subject', function() {
        $instance = $this->subject->reveal();
        assert($instance instanceof Klass, 'should be instance of Klass');
    });
});
```

###Using the scope on a test by test basis

Like any other peridot [scope](http://peridot-php.github.io/#scopes), you can mix the `ProphecyScope` provided by this plugin
on a test by test, or suite by suite basis.

```php
<?php
use Peridot\Plugin\Prophecy\ProphecyScope;

describe('Bird', function() {
    //here we manually mixin the http kernel scope
    $scope = new ProphecyScope();
    $this->peridotAddChildScope($scope);

    it('should fly', function() {
        $mock = $this->getProphet()->prophesize('Bird');
        //do stuff with the mock
    });
});
```

##Example specs

To test examples that are using the plugin, run the following:

```
$ vendor/bin/peridot example/bird.spec.php
```

##Running plugin tests

```
$ vendor/bin/peridot specs/
```
