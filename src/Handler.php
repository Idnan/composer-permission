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
        $permission = static::PERMISSION_WRITABLE;

        $configuration = new Configuration($event);

        $event->getIO()->write('Setting up permissions');

        foreach ($configuration->getWritableDirs() as $writableDir) {

            $event->getIO()->write("{$writableDir} => {$permission}");

            if (!is_dir($writableDir) && !is_file($writableDir)) {
                $event->getIO()->writeError("<error>Invalid writable path {$writableDir}</error>");
            }

            try {
                if (chmod($writableDir, octdec(static::PERMISSION_WRITABLE))) {
                    $event->getIO()->write("Done");
                }
            } catch (Exception $e) {
                $event->getIO()->writeError("<error>" . $e->getMessage() . "</error>");
            }
        }
    }
}