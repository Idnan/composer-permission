<?php

namespace Idnan\PermissionHandler;

use Composer\Script\Event;
use Exception;
use Idnan\PermissionHandler\Exceptions\PathNotFoundException;

/**
 * Class Handler
 *
 * @package Idnan\PermissionHandler
 */
class Handler
{
    const PERMISSION_WRITABLE = 0777;

    /**
     * @param \Composer\Script\Event $event
     */
    public static function setPermissions(Event $event)
    {
        $permission    = static::PERMISSION_WRITABLE;
        $configuration = new Configuration($event);

        $event->getIO()->write('Setting up permissions');

        foreach ($configuration->getWritableDirs() as $writableDir) {

            $event->getIO()->write("{$writableDir} => {$permission}...");

            if (!is_dir($writableDir) || !is_file($writableDir)) {
                throw new PathNotFoundException('Invalid writable path ' . $writableDir);
            }

            try {
                if (chmod($writableDir, octdec(static::PERMISSION_WRITABLE))) {
                    $event->getIO()->write("Done");
                }
            } catch (Exception $e) {
                $event->getIO()->writeError($e->getMessage());
            }
        }
    }
}