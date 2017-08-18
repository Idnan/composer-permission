<?php

namespace Idnan\PermissionHandler\Entities;

use Idnan\PermissionHandler\Interfaces\PermissionsSetterInterface;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

/**
 * Class PermissionsSetter
 *
 * @package Idnan\PermissionHandler\Entities
 */
abstract class PermissionsSetter implements PermissionsSetterInterface
{
    /** @var \Symfony\Component\Process\Process $process */
    private $process;

    /**
     * PermissionsSetter constructor.
     *
     * @param \Symfony\Component\Process\Process|null $process
     */
    public function __construct(Process $process = null)
    {
        $this->process = $process;
    }

    /**
     * @return string
     */
    protected function getHttpdUser()
    {
        return $this->runProcess(
            "ps aux | grep -E '[a]pache|[h]ttpd|[_]www|[w]ww-data|[n]ginx' | grep -v root | head -1 | cut -d\  -f1"
        );
    }

    /**
     * @param $command
     * @param $path
     */
    protected function runCommand($command, $path)
    {
        $this->runProcess(str_replace(
            ['%httpduser%', '%path%'],
            [$this->getHttpdUser(), $path],
            $command
        ));
    }

    /**
     * @param $commandline
     *
     * @return string
     */
    protected function runProcess($commandline)
    {
        if (null === $this->process) {
            $this->process = new Process(null);
        }

        $this->process->setCommandLine($commandline);
        $this->process->run();
        if (!$this->process->isSuccessful()) {
            throw new ProcessFailedException($this->process);
        }

        return trim($this->process->getOutput());
    }
}
