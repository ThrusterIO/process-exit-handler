<?php

namespace Thruster\Component\ProcessExitHandler\Tests;

use Thruster\Component\ProcessExitHandler\ExitEvent;
use Thruster\Component\ProcessExitHandler\ExitHandler;

/**
 * Class ExitHandlerTest
 *
 * @package Thruster\Component\ProcessExitHandler\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ExitHandlerTest extends \PHPUnit_Framework_TestCase
{
    protected $loop;

    protected $handler;

    public function setUp()
    {
        $this->loop = $this->getMockForAbstractClass('\Thruster\Component\EventLoop\EventLoopInterface');

        $this->loop->expects($this->once())->method('addChild')->with($this->callback(function ($argument) {
            $this->assertSame('handleExit', $argument[1]);

            $this->handler = $argument;

            return $this->getMockBuilder('\Thruster\Component\EventLoop\Child')
                ->disableOriginalConstructor()
                ->getMock();
        }));
    }

    public function testExitHandler()
    {
        $handler = new ExitHandler($this->loop);

        $expected = ['a', 'b'];
        $given = [];

        $handler->addHandler(function ($event) use (&$given) {
            $given[] = 'a';
        });

        $handler->addHandler(function ($event) use (&$given) {
            $given[] = 'b';
        });

        $params = new \stdClass();
        $params->rstatus = 100;
        $params->rpid = 100;

        call_user_func($this->handler, null, $params);

        $this->assertEquals($expected, $given);
    }

    public function testExitHandlerStopPropagation()
    {
        $handler = new ExitHandler($this->loop);

        $expected = ['a'];
        $given = [];

        $handler->addHandler(function (ExitEvent $event) use (&$given) {
            $given[] = 'a';

            $event->stopPropagation();
        });

        $handler->addHandler(function ($event) use (&$given) {
            $given[] = 'b';
        });

        $params = new \stdClass();
        $params->rstatus = 100;
        $params->rpid = 100;

        call_user_func($this->handler, null, $params);

        $this->assertEquals($expected, $given);
    }
}
