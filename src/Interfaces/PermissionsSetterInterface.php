<?php

namespace Idnan\PermissionHandler\Interfaces;

/**
 * Interface PermissionsSetterInterface
 *
 * @package Idnan\PermissionHandler\Interfaces
 */
interface PermissionsSetterInterface
{
    /**
     * @param string $path
     */
    public function setPermissions($path);
}
