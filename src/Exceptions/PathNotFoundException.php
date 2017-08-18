<?php

namespace Idnan\PermissionHandler\Exceptions;

use InvalidArgumentException;

/**
 * Class PathNotFoundExceptions
 *
 * @package Idnan\PermissionHandler\Exceptions
 */
class PathNotFoundException extends InvalidArgumentException
{
    /**
     * PathNotFoundException constructor.
     *
     * @param string $path
     */
    public function __construct($path)
    {
        parent::__construct(sprintf('Path "%s" not found.', $path));
    }
}
