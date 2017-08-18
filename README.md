# Permissions Handler

Composer script handling directories permissions by making them writable both

## Usage

Add the following in your root composer.json file:

```json
{
    "require": {
        "idnan/permission-handler": "~1.0"
    },
    "scripts": {
        "post-install-cmd": [
            "Idnan\\PermissionHandler\\PermissionHandler::setPermissions"
        ]
    },
    "extra": {
        "writable": ["storage"]
    }
}
```
