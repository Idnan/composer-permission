<?php

namespace Idnan\PermissionHandler\Entities;

use Idnan\PermissionHandler\Exceptions\PathNotFoundException;

/**
 * Class ChmodPermissionsSetter
 *
 * @package Idnan\PermissionHandler\Entities
 */
class ChmodPermissionsSetter extends PermissionsSetter
{
    /**
     * @param string $path
     */
    public function setPermissions($path)
    {
        if (!is_dir($path)) {
            throw new PathNotFoundException($path);
        }

        $this->runCommand('chmod +a "%httpduser% allow delete,write,append,file_inherit,directory_inherit" %path%', $path);
        $this->runCommand('chmod +a "`whoami` allow delete,write,append,file_inherit,directory_inherit" %path%', $path);
    }
}
