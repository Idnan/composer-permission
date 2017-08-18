# Composer Permission

Composer script handling directories permissions by making them writable

## Usage

Run the below command to install the plugin

```
composer require idnan/composer-permission:~1.0
```
And then put the below configuration in your composer.json file

Add the following in your root composer.json file:

```json
{
    ...
    "scripts": {
        "post-install-cmd": [
            "Idnan\\ComposerPermission\\Handler::setPermissions"
        ]
    },
    "extra": {
        "writable": ["relative_path/to_make_writable"]
    }
}
```

e.g. if you are using laravel and want to make `storage` directory writable, it should be

```
"extra": {
    "writable": ["storage"]
}
```

## Contribution

* Report issues
* Open pull request with improvements
* Features Suggestions
* Reach out to me directly at mahradnan@hotmail.com or [![Twitter URL](https://img.shields.io/twitter/url/https/twitter.com/idnan_se.svg?style=social&label=Follow%20%40idnan_se)](https://twitter.com/idnan_se)

## License

MIT © [Adnan Ahmed](mailto:mahradnan@hotmail.com)