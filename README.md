# ProcessExitHandler Component

[![Latest Version](https://img.shields.io/github/release/ThrusterIO/process-exit-handler.svg?style=flat-square)]
(https://github.com/ThrusterIO/process-exit-handler/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)]
(LICENSE)
[![Build Status](https://img.shields.io/travis/ThrusterIO/process-exit-handler.svg?style=flat-square)]
(https://travis-ci.org/ThrusterIO/process-exit-handler)
[![Code Coverage](https://img.shields.io/scrutinizer/coverage/g/ThrusterIO/process-exit-handler.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/process-exit-handler)
[![Quality Score](https://img.shields.io/scrutinizer/g/ThrusterIO/process-exit-handler.svg?style=flat-square)]
(https://scrutinizer-ci.com/g/ThrusterIO/process-exit-handler)
[![Total Downloads](https://img.shields.io/packagist/dt/thruster/process-exit-handler.svg?style=flat-square)]
(https://packagist.org/packages/thruster/process-exit-handler)

[![Email](https://img.shields.io/badge/email-team@thruster.io-blue.svg?style=flat-square)]
(mailto:team@thruster.io)

The Thruster ProcessExitHandler Component. Handles all sub-process exits


## Install

Via Composer

``` bash
$ composer require thruster/process-exit-handler
```

## Usage

```php
use Thruster\Component\EventLoop\EventLoop;
use Thruster\Component\ProcessExitHandler\ExitHandler;
use Thruster\Component\ProcessExitHandler\ExitEvent;

$loop = new EventLoop();
$exitHandler = new ExitHandler($loop);

$exitHandler->addHandler(function (ExitEvent $event) {
    // ... Handle event
});

$loop->run();
```


## Testing

``` bash
$ composer test
```


## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) and [CONDUCT](CONDUCT.md) for details.


## License

Please see [License File](LICENSE) for more information.
