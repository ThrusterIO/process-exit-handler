<?php

namespace Thruster\Component\ProcessExitHandler;

use Thruster\Component\EventEmitter\AdvanceEventEmitterInterface;
use Thruster\Component\EventEmitter\AdvanceEventEmitterTrait;
use Thruster\Component\EventLoop\EventLoopInterface;

/**
 * Class ExitHandler
 *
 * @package Thruster\Component\ProcessExitHandler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ExitHandler implements AdvanceEventEmitterInterface
{
    use AdvanceEventEmitterTrait;

    /**
     * @var EventLoopInterface
     */
    protected $loop;

    public function __construct(EventLoopInterface $loop)
    {
        $this->loop = $loop;

        $this->loop->addChild([$this, 'handleExit']);
    }

    public function addHandler(callable $handler)
    {
        $this->on('exit', $handler);
    }

    public function handleExit($child, $evChild)
    {
        $event = new ExitEvent($evChild->rpid, $evChild->rstatus);

        $this->emit('exit', $event);
    }
}
