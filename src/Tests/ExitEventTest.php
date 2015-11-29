<?php

namespace Thruster\Component\ProcessExitHandler\Tests;

use Thruster\Component\ProcessExitHandler\ExitEvent;

/**
 * Class ExitEventTest
 *
 * @package Thruster\Component\ProcessExitHandler\Tests
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ExitEventTest extends \PHPUnit_Framework_TestCase
{
    public function dataTest()
    {
        yield [28302, 7936, 31, -1, true, false];
        yield [28286, 25600, 100, -1, true, false];
        yield [28288, 13056, 51, -1, true, false];
        yield [28290, 5888, 23, -1, true, false];
        yield [28284, 14848, 58, -1, true, false];
        yield [28292, 10496, 41, -1, true, false];
        yield [28296, 15872, 62, -1, true, false];
        yield [28617, 9, 0, 0, false, true];
    }

    /**
     * @dataProvider dataTest
     */
    public function testEvent($pid, $status, $exExitCode, $exExitSignal, $exNormalExit, $exSignalExit)
    {
        $event = new ExitEvent($pid, $status);

        $this->assertSame($pid, $event->getPid());
        $this->assertSame($status, $event->getStatus());
        $this->assertSame($exExitCode, $event->getExitCode());
        $this->assertSame($exExitSignal, $event->getExitSignal());
        $this->assertSame($exNormalExit, $event->isNormalExit());
        $this->assertSame($exSignalExit, $event->isSignalExit());
    }
}
