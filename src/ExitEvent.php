<?php

namespace Thruster\Component\ProcessExitHandler;

use Thruster\Component\EventEmitter\Event;

/**
 * Class ExitEvent
 *
 * @package Thruster\Component\ProcessExitHandler
 * @author  Aurimas Niekis <aurimas@niekis.lt>
 */
class ExitEvent extends Event
{
    /**
     * @var int
     */
    protected $pid;

    /**
     * @var int
     */
    protected $status;

    public function __construct(int $pid, int $status)
    {
        $this->pid = $pid;
        $this->status = $status;

        parent::__construct();
    }

    public function getPid() : int
    {
        return $this->pid;
    }

    public function getStatus() : int
    {
        return $this->status;
    }

    public function getExitCode() : int
    {
        return pcntl_wexitstatus($this->getStatus());
    }

    public function getExitSignal() : int
    {
        if ($this->isSignalExit()) {
            return pcntl_wstopsig($this->getStatus());
        }

        return -1;
    }

    public function isNormalExit() : bool
    {
        return pcntl_wifexited($this->getStatus());
    }

    public function isSignalExit() : bool
    {
        return pcntl_wifsignaled($this->getStatus());
    }
}
