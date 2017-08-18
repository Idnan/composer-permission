<?php

namespace Idnan\PermissionHandler;

use Composer\Script\Event;
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
        $event->getIO()->write('Setting up permissions');

        $configuration = new Configuration($event);

        $writableDirs = $configuration->getWritableDirs();

        foreach ($writableDirs as $writableDir) {

            $event->getIO()->write("chmod('" . $writableDir . "', " . static::PERMISSION_WRITABLE . ")...");

            if (!is_dir($writableDir) || !is_file($writableDir)) {
                throw new PathNotFoundException('Invalid writable path ' . $writableDir);
            }

            try {
                if (chmod($writableDir, octdec(static::PERMISSION_WRITABLE))) {
                    $event->getIO()->write("Done");
                }
            } catch (\Exception $e) {
                $event->getIO()->write(sprintf('<error>%s</error>', $e->getMessage()));
            }
        }
    }
}