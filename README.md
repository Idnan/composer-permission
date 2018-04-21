# Composer Permission

Composer script handling directories permissions

## Usage

Run the below command to install the plugin

```
composer require idnan/composer-permission:~1.0
```
And then put the below configuration in your composer.json file

```json
{
    ...
    "scripts": {
        "post-install-cmd": [
            "Idnan\\ComposerPermission\\Handler::setPermissions"
        ]
    },
    "extra": {
		"dir_permissions": ["app/strorage:0777"]
    }
}
```

You can pass any permission as long as it is accepted by [chmod](http://php.net/manual/en/function.chmod.php).

## Contribution

* Report issues
* Open pull request with improvements
* Features Suggestions
* Reach out to me directly at idnan.se@gmail.com or [![Twitter URL](https://img.shields.io/twitter/url/https/twitter.com/idnan_se.svg?style=social&label=Follow%20%40idnan_se)](https://twitter.com/idnan_se)

## License

MIT © [Adnan Ahmed](mailto:idnan.se@gmail.com)