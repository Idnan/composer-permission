<?php

namespace Idnan\ComposerPermission;

use Composer\Script\Event;
use Exception;

/**
 * Class Handler
 *
 * @package Idnan\ComposerPermission
 */
class Handler
{
    const PERMISSION_WRITABLE = '0777';

    /**
     * @param \Composer\Script\Event $event
     */
    public static function setPermissions(Event $event)
    {
        $configuration = new Configuration($event);

        $event->getIO()->write('Setting up permissions');

        foreach ($configuration->getDirectoryPermissions() as $writableDir) {

            $parts = explode(":", $writableDir);

            // default permission is writable
            $permission = static::PERMISSION_WRITABLE;
            if (!empty($parts[1])) {
                $permission = $parts[1];
            }

            $dir = $parts[0];

            $event->getIO()->write("{$dir} => {$permission}");

            if (!is_dir($dir) && !is_file($dir)) {
                $event->getIO()->writeError("<error>Invalid writable path {$dir}</error>");
            }

            try {
                if (chmod($dir, $permission)) {
                    $event->getIO()->write("Done");
                }
            } catch (Exception $e) {
                $event->getIO()->writeError("<error>" . $e->getMessage() . "</error>");
            }
        }
    }
}