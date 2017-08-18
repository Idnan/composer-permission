<?php

namespace Idnan\PermissionHandler;

use Composer\Script\Event;
use Exception;
use Idnan\PermissionHandler\Entities\ChmodPermissionsSetter;

/**
 * Class ScriptHandler
 *
 * @package Idnan\PermissionHandler
 */
class PermissionHandler
{
    /**
     * @param \Composer\Script\Event $event
     */
    public static function setPermissions(Event $event)
    {
        if ('WIN' === strtoupper(substr(PHP_OS, 0, 3))) {
            $event->getIO()->write('<info>No permissions setup is required on Windows.</info>');

            return;
        }

        $event->getIO()->write('Setting up permissions');

        try {
            self::setPermissionsChmod($event);
        } catch (Exception $e) {
            $event->getIO()->write(sprintf('<error>%s</error>', $e->getMessage()));
        }
    }

    /**
     * @param \Composer\Script\Event $event
     */
    public static function setPermissionsChmod(Event $event)
    {
        $configuration     = new Configuration($event);
        $permissionsSetter = new ChmodPermissionsSetter();

        $writableDirs = $configuration->getWritableDirs();

        foreach ($writableDirs as $writableDir) {
            $permissionsSetter->setPermissions($writableDir);
        }
    }
}
