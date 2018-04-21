<?php

namespace Idnan\ComposerPermission;

use Composer\Script\Event;
use Idnan\ComposerPermission\Exceptions\InvalidConfigurationException;

/**
 * Class Configuration
 *
 * @package Idnan\ComposerPermission
 */
class Configuration
{
    /** @var array $configuration */
    private $configuration;

    /**
     * Configuration constructor.
     *
     * @param \Composer\Script\Event $event
     */
    public function __construct(Event $event)
    {
        $this->configuration = $event->getComposer()
                                     ->getPackage()
                                     ->getExtra();
    }

    /**
     * @return array
     */
    public function getDirectoryPermissions()
    {
        if (!isset($this->configuration['dir_permissions'])) {
            throw new InvalidConfigurationException('The dir_permissions must be specified in composer arbitrary extra data.');
        }

        if (!is_array($this->configuration['dir_permissions'])) {
            throw new InvalidConfigurationException('The writable must be an array.');
        }

        return $this->configuration['dir_permissions'];
    }
}
